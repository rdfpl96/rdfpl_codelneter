
<?php
 defined('BASEPATH') OR exit('No direct script access allowe');

class Product extends CI_Controller{   
  
    public function __construct() {
    	
	    parent::__construct();
		
		 date_default_timezone_set('Asia/Kolkata');

		  $this->load->library('my_libraries');
		  $this->load->model('admin/product_model','product');
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
        
        $array_data=$this->product->getList($start, $records_per_page,$name); 



        $count=$this->product->record_count($name);
        
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
	                            <td>'.$record['hsn_code'].'</td>
	                            <td>'.$status.'</td>
	                            <td>'.date('d-m-Y',strtotime($record['add_date'])).'</td>
	                            <td></td>
	                            <td><a href="'.base_url().'admin/product/edit/'.$record['product_id'].'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
                        </tr>'; 
                    $i++;                                                     
                } 
            }

            else{
                $option.='<tr><td colspan="15" style="color:red;text-align:center">No record</d></tr>';
            }
            //

            $output=array('array_data'=>$option,'pagination'=>$pagination,'page_menu_id'=>$page_menu_id,'getAccess'=>$getAccess);    
            if($this->input->post('method') == "changepage"){
                echo json_encode($output); 
                exit();
            }
            else
                {
                 $this->load->view('admin/product/index',$output);
            }  
   	}

    public function create(){
    	$menuIdAsKey=2;
        $data['getAccess']=$this->my_libraries->userAthorizetion($menuIdAsKey);
        $data['page_menu_id']=$menuIdAsKey;

        $data['topCategory']=$this->customlibrary->getTopCatInOption();
		
		$this->load->view('admin/product/create',$data);
        
	}

	public function save(){

        if($this->input->is_ajax_request()) {
        	
        	$otherInfo=array();

  			$session=$this->session->userdata('admin');

  			$productName=isset($_POST['product_name']) ? addslashes($_POST['product_name']) : "" ;
  			$productSlug=isset($_POST['slug']) ? addslashes($_POST['slug']) : "" ;
   			$hsn_code=isset($_POST['hsn_code']) ? addslashes($_POST['hsn_code']) : "" ;

   			$igst=isset($_POST['igst']) ? addslashes($_POST['igst']) : 0 ;
   			$cgst=isset($_POST['cgst']) ? addslashes($_POST['cgst']) : 0;
            $sgst=isset($_POST['sgst']) ? addslashes($_POST['sgst']) : 0 ;

   			$headingArray=isset($_POST['heading']) && count($_POST['heading'])>0 ? $_POST['heading'] : array() ;
   			$descriptionArray=isset($_POST['description']) && count($_POST['description'])>0 ? $_POST['description'] : array() ;

   			if($this->product->chkUniqueProductName($productName)){
   				$error=1;
				$err_msg="Product already exist";
   			}
   			else if($this->product->chkUniqueProductURL($productSlug)){
   				$error=1;
				$err_msg="Product slug already exist";
   			}
   			else{
   				if(count($headingArray)>0){
   				
   				for($i=0; $i < count($headingArray); $i++) { 
   					$otherInfo[]=array(
   						'heading'=>isset($headingArray[$i]) ? $headingArray[$i] : "" ,
   						'description'=>isset($descriptionArray[$i]) ? $descriptionArray[$i] : "" ,
   					);
   				}
			}

			$array_data=array(
				'product_name'=>$productName,
				'slug'=>$productSlug,
				'hsn_code'=>$hsn_code,
				'cgst'=>$cgst,
				'igst'=>$igst,
				'sgst'=>$sgst,
				'other_info'=>serialize($otherInfo),
				'updated_by'=>$session['admin_name']
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

public function edit($id){
	$detail=$this->product->getViewByID($id);

	$form_data['tdata']=$detail;
	$this->load->view('admin/product/edit',$form_data);  
} 

public function update($id){

	 if($this->input->is_ajax_request()) {
        	
        	$otherInfo=array();

  			$session=$this->session->userdata('admin');

  			$productName=isset($_POST['product_name']) ? addslashes($_POST['product_name']) : "" ;
  			$productSlug=isset($_POST['slug']) ? addslashes($_POST['slug']) : "" ;
   			$hsn_code=isset($_POST['hsn_code']) ? addslashes($_POST['hsn_code']) : "" ;

   			$igst=isset($_POST['igst']) ? addslashes($_POST['igst']) : 0 ;
   			$cgst=isset($_POST['cgst']) ? addslashes($_POST['cgst']) : 0;
            $sgst=isset($_POST['sgst']) ? addslashes($_POST['sgst']) : 0 ;

   			$headingArray=isset($_POST['heading']) && count($_POST['heading'])>0 ? $_POST['heading'] : array() ;
   			$descriptionArray=isset($_POST['description']) && count($_POST['description'])>0 ? $_POST['description'] : array() ;

   			if($this->product->chkUniqueProductName($productName,$id)){
   				$error=1;
				$err_msg="Product already exist";
   			}
   			else if($this->product->chkUniqueProductURL($productSlug,$id)){
   				$error=1;
				$err_msg="Product slug already exist";
   			}
   			else{
   				if(count($headingArray)>0){
   				
   				for($i=0; $i < count($headingArray); $i++) { 
   					$otherInfo[]=array(
   						'heading'=>isset($headingArray[$i]) ? $headingArray[$i] : "" ,
   						'description'=>isset($descriptionArray[$i]) ? $descriptionArray[$i] : "" ,
   					);
   				}
			}

			$array_data=array(
				'product_name'=>$productName,
				'slug'=>$productSlug,
				'hsn_code'=>$hsn_code,
				'cgst'=>$cgst,
				'igst'=>$igst,
				'sgst'=>$sgst,
				'other_info'=>serialize($otherInfo),
				'updated_by'=>$session['admin_name']
			);

			if($this->product->Edit($id,$array_data)){
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

function productitem(){
    
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
        
        $array_data=$this->product->getProductWithVariants($start, $records_per_page,$name); 
        // echo '<pre>';
        // print_r($array_data);
        // exit();

        $count=$this->product->record_count($name);
        
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
                    //$status=isset($record['status']) && $record['status']==1 ?'<span style="color:green">Active</span>' :'<span style="color:red">Inactive</span>' ;
                   
                    $imgFile1 = base_url() . 'uploads/' . $record['feature_img'];
                    $option.='<tr> 
                                <td>'.$i.'</td>
                                <td><img src="' . $imgFile1 . '" alt="Product Image" style="width:30%; height:auto;"></td>
                                <td>'.$record['product_name'].'</td>
                                <td>'.$record['pack_size'].'</td>
                                <td>'.$record['price'].'</td>
                                <td>'.$record['units'].'</td>
                            </tr>'; 
                    $i++;                                                     
                } 
            }

            else{
                $option.='<tr><td colspan="15" style="color:red;text-align:center">No record</d></tr>';
            }
            //

            $output=array('array_data'=>$option,'pagination'=>$pagination,'page_menu_id'=>$page_menu_id,'getAccess'=>$getAccess);    
            if($this->input->post('method') == "changepage"){
                echo json_encode($output); 
                exit();
            }
            else
                {
                 $this->load->view('admin/product/productitem',$output);
            }  
    }

}
?>