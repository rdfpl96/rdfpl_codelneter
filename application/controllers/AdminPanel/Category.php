
<?php
 defined('BASEPATH') OR exit('No direct script access allowe');

class Category extends CI_Controller{   
  
    public function __construct() {
    	
	    parent::__construct();
		
		 date_default_timezone_set('Asia/Kolkata');

		  $this->load->library('my_libraries');
		  $this->load->model('admin/category_model','category');
		  $session=$this->session->userdata('admin');
		  
		  $_SERVER['REQUEST_URI']="admin";

		  if(basename($_SERVER['REQUEST_URI'])!='admin'){
		       if(!isset($session) && $session['is_login']!=1){
		          // redirect(base_url('login'));
		           redirect(base_url('admin'));
		       }
		  }
  
  	}

    // function index(){
            
    //      $this->load->view('admin/category/index');
             
   	// }

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
        
        $array_data=$this->category->getList($start, $records_per_page,$name); 



        $count=$this->category->record_count($name);
        
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
                                <td>'.$record['category'].'</td>
                                <td>'.$record['slug'].'</td>
                                <td>'.$status.'</td>
                                <td>'.date('d-m-Y',strtotime($record['add_date'])).'</td>
                                <td></td>
                                <td><a href="'.base_url().'admin/category/edit/'.$record['cat_id'].'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
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
                 $this->load->view('admin/category/index',$output);
            }  
    }

    // public function create(){
    // 	$menuIdAsKey=2;
    //     $data['getAccess']=$this->my_libraries->userAthorizetion($menuIdAsKey);
    //     $data['page_menu_id']=$menuIdAsKey;

    //     if($this->input->is_ajax_request()) {
            
    //         $otherInfo=array();

    //         $session=$this->session->userdata('admin');

    //         $categoryName=isset($_POST['category_name']) ? addslashes($_POST['category_name']) : "" ;
    //         $categorySlug=isset($_POST['slug']) ? addslashes($_POST['slug']) : "" ;
    //         //$cat_image=isset($_POST['cat_image']) ? addslashes($_POST['cat_image']) : "" ;


    //         if($this->category->chkUniqueCategoryName($categoryName)){
    //             $error=1;
    //             $err_msg="Category already exist";
    //         }
    //         else if($this->category->chkUniqueCategoryURL($categorySlug)){
    //             $error=1;
    //             $err_msg="Category slug already exist";
    //         }

    //         $array_data=array(
    //             'category_name'=>$categoryName,
    //             'slug'=>$categorySlug
    
    //         );
            
    //         if($this->category->add($array_data)){
    //             $error=0;
    //             $err_msg="Data insert succesfully";
    //         }else{
    //             $error=0;
    //             $err_msg="There are some problem try again";
    //         }
    //     }else{
    //       $this->load->view('admin/category/create',$data);  
    //     }
    // }
   
   // public function create() {
   //      $this->load->view('admin/category/create');
   //  }

    public function create() {
        $this->load->view('admin/category/create');
    }

        public function store() {
        $category_name = $this->input->post('category_name');
        $category_slug = $this->input->post('slug');

        // Insert data into the database
        if ($this->category->insert_category($category_name, $category_slug)) {
            //echo "Data inserted successfully"; // Display success message
            redirect('admin/category?success=true');
        } else {
            echo "Failed to insert data"; // Display error message
        }
    }


public function edit($id) {
        // Get category details by ID
        $data['category'] = $this->category->get_category_by_id($id);
        // Load the edit view
        $this->load->view('admin/category/edit', $data);
    } 

public function update($id) {
        $data = array(
            'category' => $this->input->post('category_name'),
            'slug' => $this->input->post('slug')
        );

        // Update the category
        if ($this->category->update_category($id, $data)) {
            $this->session->set_flashdata('success_message', 'Data Updated Successfully!');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to update data!');
        }
        redirect('admin/category/index');
    }

}
?>