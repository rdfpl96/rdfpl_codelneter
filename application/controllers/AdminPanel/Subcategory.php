
<?php
 defined('BASEPATH') OR exit('No direct script access allowe');

class Subcategory extends CI_Controller{   
  
    public function __construct() {
    	
	    parent::__construct();
		
		 date_default_timezone_set('Asia/Kolkata');

		  $this->load->library('my_libraries');
		  $this->load->model('admin/category_model','category');
          $this->load->model('admin/subcategory_model','subcategory');
		  $session=$this->session->userdata('admin');
          $this->load->library('pagination');
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

       public function index($page='') {
        $name = isset($_POST['name']) && $_POST['name'] != '' ? $_POST['name'] : '';
        $page = empty($page) ? 0 : intval($page);
        
        $menuIdAsKey = 2;
        $getAccess = $this->my_libraries->userAthorizetion($menuIdAsKey);
        $page_menu_id = $menuIdAsKey;
        
        
        $config = array();
        $config["base_url"] = base_url() . "admin/subcategory";
        $config["total_rows"] = $this->subcategory->get_user_count_subcategory($name);
        $config["per_page"] = 10; // Number of records per page
        $config["uri_segment"] = 3; // Position of the page number in the URL
        // Customizing pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
        $config['first_tag_close'] = '</a></li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
        $config['last_tag_close'] = '</a></li>';

        $config['next_link'] = 'Next'; //'Next Page';
        $config['next_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
        $config['next_tag_close'] = '</a></li>';

        $config['prev_link'] = 'Previous'; //'Prev Page';
        $config['prev_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
        $config['prev_tag_close'] = '</a></li>';

        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="paginate_button page-item page-link">';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$data['users_list'] = $this->subcategory->get_users_category($config["per_page"], $page);
        $data['pagination'] = $this->pagination->create_links();
    
        
        $array_data = $this->subcategory->get_subcategories($page, $config["per_page"], $name);
      
        // print_r($array_data);
        // die();


        $option = '';
        $i =1;
        if (is_array($array_data) && count($array_data) > 0) {
            foreach ($array_data as $record) {
                $status = isset($record['status']) && $record['status'] == 1 ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>';
        
                $option .= '<tr> 
                                <td>' . ($i+$page) . '</td>
                                <td>' . $record['category'] . '</td>
                                <td>' . $record['subCat_name'] . '</td>
                                <td>' . $record['subcategory_slug'] . '</td>
                                <td>' . $status . '</td>
                                <td>' . date('d-m-Y', strtotime($record['update_date'])) . '</td>
                                <td></td>
                                <td>
                                    <a href="' . base_url() . 'admin/subcategory/edit/' . $record['sub_cat_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="javascript:deleteRowtablesub('.$record['sub_cat_id'].')" class="btn btn-danger btn-xs deletesubbtn" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                        </tr>';
                $i++;
            }
        } else {
            $option .= '<tr><td colspan="7" style="color:red;text-align:center">No record</td></tr>';
        }
        
        $output = array('array_data' => $option, 'page_menu_id' => $page_menu_id, 'getAccess' => $getAccess, 'pagination' => $data['pagination']);
        if ($this->input->post('method') == "changepage") {
            echo json_encode($output);
            exit();
        } else {
            $this->load->view('admin/subcategory/index', $output);
        }
    }
    
    
    public function deleteSubcategory() {
        $menuIdAsKey = 34;
        $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
        $data['page_menu_id'] = $menuIdAsKey;

        $sub_cat_id = $this->input->post('sub_cat_id');
        $response = $this->sqlQuery_model->sql_delete('tbl_sub_category', array('sub_cat_id' => $sub_cat_id));

        if($response=='1'){
            $Flag= 'True';
        }else{
            $Flag= 'False';
        }

        echo json_encode($Flag);
        exit();
    }
    













    

    public function search_subcat_list()
{

    $keywords = $this->input->post('searchText');
       
    $Cat_Html = $this->subcategory->SearchCategory($keywords);


    // echo '<pre>';
    // print_r($Cat_Html);
    // die();

    $html.='';  
    foreach ($Cat_Html as $val) {
        $html.='<tr>
         <td>'.$val['sub_cat_id'].'</td>
           <td>'.$val['category'].'</td>
            <td>'.$val['subCat_name'].'</td>
            <td>'.$val['status'].'</td>
            <td>'.$val['update_date'].'</td>
            <td>'.$val['action'].'</td>
            <td><a href="' . base_url() . 'admin/category/edit/' . $record['cat_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
            <td><a href="javascript:deleteRowtablesub('.$record['sub_cat_id'].')" class="btn btn-danger btn-xs deletesubbtn" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i> Delete</a></td>
        </tr>';
    }


    // $data['categories']

    print_r($html);
    die();





}







    public function create() {
        $data['categories'] = $this->category->get_categories();
        // print_r($data);
        // exit;
        $this->load->view('admin/subcategory/create', $data);
    }

    public function store() {
        $data = array(
            'cat_id' => $this->input->post('cat_id'),
            'subCat_name' => $this->input->post('subcategory_name'),
            'slug' => $this->input->post('slug')
        );

        // Insert data into the database
        if ($this->subcategory->insert_subcategory($data)) {
            $this->session->set_flashdata('success_message', 'Data Inserted Successfully!');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to insert data!');
        }
        redirect('admin/subcategory');
    }


public function edit($id) {
        $data['subcategory'] = $this->subcategory->get_subcategory($id);
        $data['categories'] = $this->category->get_categories();
        $this->load->view('admin/subcategory/edit', $data);
    }

    public function update($id) {
        $data = array(
            'cat_id' => $this->input->post('cat_id'),
            'subCat_name' => $this->input->post('subcategory_name'),
            'slug' => $this->input->post('slug'),
        );
        $this->subcategory->update_subcategory($id, $data);
        $this->session->set_flashdata('success_message', 'Subcategory updated successfully');
        redirect('admin/subcategory');
    }


}
?>