
<?php
 defined('BASEPATH') OR exit('No direct script access allowe');

class Categorywithproduct extends CI_Controller{   
  
    public function __construct() {
    	
	    parent::__construct();
		
		 date_default_timezone_set('Asia/Kolkata');

        
		  $this->load->library('my_libraries');  
		  $this->load->model('admin/categorywithproduct_model','product');
		  $session=$this->session->userdata('admin');
		  
		  $_SERVER['REQUEST_URI']="admin";

		  if(basename($_SERVER['REQUEST_URI'])!='admin'){
		       if(!isset($session) && $session['is_login']!=1){
		          // redirect(base_url('login'));
		           redirect(base_url('admin'));
		       }
		  }
  
  	}

    function index(){
  	 
		$menuIdAsKey=2;
        $getAccess=$this->my_libraries->userAthorizetion($menuIdAsKey);
        $page_menu_id=$menuIdAsKey;


        $adjacents = 2;
        $records_per_page =25;
        $page = (int)(isset($_POST['page']) ? $_POST['page'] : 1);
        $page = ($page == 0 ? 1 : $page);
        $start = ($page-1) * $records_per_page;
        //
        $name=isset($_POST['name']) && $_POST['name']!='' ? $_POST['name'] : '' ;
        
        $top_cat_id = isset($_POST['top_cat_id']) ? $_POST['top_cat_id'] : "";
        $sub_id = isset($_POST['sub_id']) ? $_POST['sub_id'] : "";
        $child_cat_id = isset($_POST['child_cat_id']) ? $_POST['child_cat_id'] : "";

        $array_data=$this->product->getAllProduct($start, $records_per_page,$top_cat_id,$sub_id, $child_cat_id); 
        //
        $count=$this->product->record_count($top_cat_id,$sub_id, $child_cat_id);
        
        $topcat=$this->customlibrary->getTopCatInOption($top_cat_id);
        $next = $page + 1;    
        $prev = $page - 1;

        $last_page = ceil($count/$records_per_page);
        $second_last = $last_page - 1;

        $i = (($page * $records_per_page) - ($records_per_page - 1));
        $pagination = "";    
        
        if($last_page > 1)
            {
            $pagination .= "<div class='pagination'>";
            if($page > 1)
                $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($prev).");'>&laquo; Previous&nbsp;&nbsp;</a>";
            else
            $pagination.= "<spn class='disabled'>&laquo; Previous&nbsp;&nbsp;</spn>";   
            if($last_page < 7 + ($adjacents * 2))
                {   
                for ($counter = 1; $counter <= $last_page; $counter++)
                    {
                    if ($counter == $page)
                        $pagination.= "<spn class='current'>$counter</spn>";
                    else
                        $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
                    }
                }
            elseif($last_page > 5 + ($adjacents * 2))
                {
                if($page < 1 + ($adjacents * 2))
                    {
                    for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                        {
                        if($counter == $page)
                            $pagination.= "<spn class='current'>$counter</spn>";
                        else
                            $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
                        }
                        $pagination.= "...";
                        $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($second_last).");'> $second_last</a>";
                        $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($last_page).");'>$last_page</a>";   
                   
                    }
               elseif($last_page - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                    {
                   $pagination.= "<a href='javascript:void(0);' onClick='change_page(1);'>1</a>";
                   $pagination.= "<a href='javascript:void(0);' onClick='change_page(2);'>2</a>";
                   $pagination.= "...";
                   for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                        {
                       if($counter == $page)
                           $pagination.= "<spn class='current'>$counter</spn>";
                       else
                           $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
                        }
                   $pagination.= "..";
                   $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($second_last).");'>$second_last</a>";
                   $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($last_page).");'>$last_page</a>";   
                    }
               else
                    {
                   $pagination.= "<a href='javascript:void(0);' onClick='change_page(1);'>1</a>";
                   $pagination.= "<a href='javascript:void(0);' onClick='change_page(2);'>2</a>";
                   $pagination.= "..";
                   for($counter = $last_page - (2 + ($adjacents * 2)); $counter <= $last_page; $counter++)
                   {
                       if($counter == $page)
                            $pagination.= "<spn class='current'>$counter</spn>";
                       else
                            $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
                   }
                }
            }
            if($page < $counter - 1)
                $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($next).");'>Next &raquo;</a>";
            else
                $pagination.= "<spn class='disabled'>Next &raquo;</spn>";
            $pagination.= "</div>";       
            }

            
        $option='';
            if(is_array($array_data) && count($array_data)>0){

                foreach($array_data as $record){
                    $status=isset($record['status']) && $record['status']==1 ?'<span style="color:green">Active</span>' :'<span style="color:red">Inactive</span>' ;
                   
                  
                    $option.='<tr> 
	                            <td>'.$i.'</td>
	                            <td>'.$record['product_name'].'</td>
                                <td>'.$record['top_cat_name'].'</td>
                                <td>'.$record['sub_cat_name'].'</td>
                                <td>'.$record['child_cat_name'].'</td>
	                            <td>'.date('d-m-Y',strtotime($record['add_date'])).'</td>
	                            <td></td>
	                            <td><a href="javascript:void(0);" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit" onClick="deletRecord('.$record['mapping_id'].');"><i class="fa fa-trash"></i></a></td>
                        </tr>'; 
                    $i++;                                                     
                } 
            }

            else{
                $option.='<tr><td colspan="15" style="color:red;text-align:center">No record</d></tr>';
            }
        
            
            $output=array('array_data'=>$option,'pagination'=>$pagination,'page_menu_id'=>$page_menu_id,'getAccess'=>$getAccess,'topcat'=>$topcat);    
            if($this->input->post('method') == "changepage"){
                echo json_encode($output); 
                exit();
            }
            else{
                $this->load->view('admin/catwithproduct/index',$output);
            }  
   	}

   
	public function save(){

        if($this->input->is_ajax_request()) {
        	
        	$session=$this->session->userdata('admin');

  			 
   			$mapping_product_id=isset($_POST['mapping_product_id']) ? addslashes($_POST['mapping_product_id']) : 0 ;
   			$cat_id=isset($_POST['cat_id']) ? addslashes($_POST['cat_id']) : 0;
            $sub_cat_id=isset($_POST['sub_cat_id']) ? addslashes($_POST['sub_cat_id']) : 0 ;
            $child_cat_id=isset($_POST['child_cat_id']) ? addslashes($_POST['child_cat_id']) : 0 ;

   		

   			if($this->product->chkUniqueMapping($mapping_product_id,$cat_id,$sub_cat_id,$child_cat_id)){
   				$error=1;
				$err_msg="Alreaddy maped";
   			}else{

                $array_data=array(
                    'mapping_product_id'=>$mapping_product_id,
                    'cat_id'=>$cat_id,
                    'sub_cat_id'=>$sub_cat_id,
                    'child_cat_id'=>$child_cat_id,
                );
       			if($this->product->add($array_data)){
                    $error=0;
                    $err_msg="Data insert succesfully";
                }else{
                    $error=0;
                    $err_msg="There are some problem try again";
                }
			}

		}else{
			$error=1;
			$err_msg="No direct script access allowed";
			
		}
		
		$response= array('error' => $error, 'err_msg' => $err_msg);
	    echo json_encode($response);
	    exit();      
        
	}



public function deletRecord($id){

     if($this->input->is_ajax_request()) {
        if($this->product->deleteMapingRecord($id)){

            $error=0;
            $err_msg="Delete Record";

        }else{
            $error=1;
            $err_msg="No direct script access allowed";
        }    
        
            
    }else{
        $error=1;
        $err_msg="No direct script access allowed";
        
    }
        
        $response= array('error' => $error, 'err_msg' => $err_msg);
        echo json_encode($response);
        exit();      
}

}
?>