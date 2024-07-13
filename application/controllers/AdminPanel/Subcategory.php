
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

       public function index() {

        $menuIdAsKey = 2;
        $getAccess = $this->my_libraries->userAthorizetion($menuIdAsKey);
        $page_menu_id = $menuIdAsKey;
        
        
        $config = array();
        $config["base_url"] = base_url() . "admin/subcategory";
        $config["total_rows"] = $this->subcategory->get_user_count_subcategory();
        $config["per_page"] = 10; // Number of records per page
        $config["uri_segment"] = 3; // Position of the page number in the URL
        
        // Customizing pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="paginate_button page-item"><a class="page-link" href="#">';
        $config['first_tag_close'] = '</a></li>';
        
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="paginate_button page-item"><a class="page-link" href="#">';
        $config['last_tag_close'] = '</a></li>';
        
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="paginate_button page-item"><a class="page-link" href="#">';
        $config['next_tag_close'] = '</a></li>';
        
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="paginate_button page-item"><a class="page-link" href="#">';
        $config['prev_tag_close'] = '</a></li>';
        
        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li class="paginate_button page-item"><a class="page-link" href="#">';
        $config['num_tag_close'] = '</a></li>';
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['users_list'] = $this->subcategory->get_users_category($config["per_page"], $page);
        $data['pagination'] = $this->pagination->create_links();
        
        $records_per_page = 25;
        $page = (int)(isset($_POST['page']) ? $_POST['page'] : 1);
        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $records_per_page;    
        $name = isset($_POST['name']) && $_POST['name'] != '' ? $_POST['name'] : '';
        $array_data = $this->subcategory->get_subcategories($start, $records_per_page, $name);
        $count = $this->subcategory->record_count($name);   
        $i = (($page * $records_per_page) - ($records_per_page - 1));      
        $option = '';
        if (is_array($array_data) && count($array_data) > 0) {
            foreach ($array_data as $record) {
                $status = isset($record['status']) && $record['status'] == 1 ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>';
        
                $option .= '<tr> 
                                <td>' . $i . '</td>
                                <td>' . $record['category'] . '</td>
                                <td>' . $record['subcategory_slug'] . '</td>
                                <td>' . $status . '</td>
                                <td>' . date('d-m-Y', strtotime($record['add_date'])) . '</td>
                                <td></td>
                                <td><a href="' . base_url() . 'admin/subcategory/edit/' . $record['sub_cat_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
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
        redirect('admin/subcategory/index');
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