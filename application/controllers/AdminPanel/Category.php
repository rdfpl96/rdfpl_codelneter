
<?php
defined('BASEPATH') or exit('No direct script access allowe');

class Category extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        date_default_timezone_set('Asia/Kolkata');

        $this->load->library('my_libraries');
        $this->load->model('admin/category_model', 'category');
        $session = $this->session->userdata('admin');
        $this->load->library('upload');
        $this->load->library('pagination');
        $_SERVER['REQUEST_URI'] = "admin";
        if (basename($_SERVER['REQUEST_URI']) != 'admin') {
            if (!isset($session) && $session['is_login'] != 1) {
                // redirect(base_url('login'));
                redirect(base_url('admin'));
            }
        }
    }



    public function index($page = '')
    {
        $searchText = $this->input->post('searchText'); // Search Keywords

        $page = empty($page) ? 0 : intval($page);
        $menuIdAsKey = 2;
        $getAccess = $this->my_libraries->userAthorizetion($menuIdAsKey);
        $page_menu_id = $menuIdAsKey;
        $adjacents = 2;
        $config = array();
        $config["base_url"] = base_url() . "admin/category";
        $config["total_rows"] = $this->category->get_user_count_category();
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
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['category_list'] = $this->category->get_users_category($config["per_page"], $page);
        $data['pagination'] = $this->pagination->create_links();
        

        $name = $this->input->post('name');

        $array_data = $this->category->getList($page, $config["per_page"], $name,$searchText);

    
        $option = '';
        if (is_array($array_data) && count($array_data) > 0) {
            foreach ($array_data as $i => $record) {
                $status = isset($record['status']) && $record['status'] == 1 ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>';
                $image_url = base_url('uploads/category/' . $record['cat_image']);
                $option .= '<tr> 
                                <td>' . ($i + 1 + $page) . '</td>
                                <td>' . $record['category'] . '</td>
                                <td>' . $record['slug'] . '</td>
                                <td><img src="' . $image_url . '" alt="image not found" style="width:100px; height:auto;"></td>
                                <td>' . $status . '</td>
                                <td>' . date('d-m-Y', strtotime($record['add_date'])) . '</td>
                                <td></td>
                                <td><a href="' . base_url() . 'admin/category/edit/' . $record['cat_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a>
                                  <a href="javascript:deleteRowtablecat('.$record['cat_id'].')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title=""  title="Delete"><i class="fa fa-trash"></i> Delete</a>
                                  </td>
                            </tr>';
            }
        } else {
            $option .= '<tr><td colspan="15" style="color:red;text-align:center">No record</td></tr>';
        }

        $data['array_data'] = $option;
        $data['page_menu_id'] = $page_menu_id;
        $data['getAccess'] = $getAccess;

        if ($this->input->post('method') == "changepage") {
            echo json_encode($data);
            exit();
        } else {
            $this->load->view('admin/category/index', $data);
        }
    }

    public function deleteCategory() {
        $menuIdAsKey = 34;
        $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
        $data['page_menu_id'] = $menuIdAsKey;

        $cat_id = $this->input->post('cat_id');

        
        $response = $this->sqlQuery_model->sql_delete('tbl_category', array('cat_id' => $cat_id));

        if($response=='1'){
            $Flag= 'True';
        }else{
            $Flag= 'False';
        }

        echo json_encode($Flag);
        exit();
    }
    
    public function SearchCategory() {
        $searchText = $this->input->post('searchText');
        $Cat_Html = $this->category->category_search($searchText,);
        
        $counter=1;
        $html = '';
        foreach ($Cat_Html as $val) {
            $status = isset($val['status']) && $val['status'] == 1 ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>';
            $image_url = base_url('/uploads/category/' . $val['cat_image']);
            $html .= '<tr>
                <td>' . $counter++ . '</td>
                <td>' . $val['category'] . '</td>
                <td>' . $val['slug'] . '</td>
                <td><img src="' . $image_url . '" alt="image not found" style="width:100px; height:auto;"></td>
                <td>' . $status . '</td>
                <td>' . date('d-m-Y', strtotime($val['add_date'])) . '</td>
                <td>
                    <a href="' . base_url() . 'admin/category/edit/' . $val['cat_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i>Edit</a>
                    <a href="javascript:deleteRowtablecat(' . $val['cat_id'] . ')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>';
        }
        
        print_r($html);
        die();
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

    public function create()
    {
        $this->load->view('admin/category/create');
    }



    public function store()
    {
        $this->load->library('upload');
        
        // Configuration for file upload
        $config['upload_path'] = './uploads/category';
        $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
        $config['max_size'] = 2048; 
        $config['encrypt_name'] = TRUE;   
        $this->upload->initialize($config);
        // Get category data from POST
        $category_name = $this->input->post('category_name');
        $category_slug = $this->input->post('slug');    
    
        // Check if the category already exists
        if ($this->category->category_exists($category_name, $category_slug)) {
            $this->session->set_flashdata('error_message', 'This category already exists.');
            redirect('admin/category');
            return;
        }
    
        // Handle file upload
        if (!$this->upload->do_upload('cat_image')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error_message', 'Failed to upload file: ' . $error);
            redirect('admin/category');
            return;
        }
    
        $upload_data = $this->upload->data();
        $file_path = $upload_data['file_name'];
        
        // Insert category data
        if ($this->category->insert_category($category_name, $category_slug, $file_path)) {
            $this->session->set_flashdata('success_message', 'Category added successfully.');
            redirect('admin/category');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to insert data');
            redirect('admin/category');
        }
    }
    


        

    public function edit($id)
    {

        // Get category details by ID
        $data['category'] = $this->category->get_category_by_id($id);
        // Load the edit view
        $this->load->view('admin/category/edit', $data);
    }




public function update($id)
{
    // Configuration for file upload
    $config['upload_path'] = './uploads/category';
    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
    $config['max_size'] = 2048; 
    $config['encrypt_name'] = TRUE;   
    $this->upload->initialize($config);

 
    $desk_image = '';

  
    if ($this->upload->do_upload('cat_image')) {
        $upload_data = $this->upload->data();
        $desk_image = $upload_data['file_name'];
    } else {
        // If upload fails, get the error and set desk_image to existing file name
        $error = $this->upload->display_errors();
        echo "Failed to upload file: " . $error;

        // Get existing category details
        $existing_category = $this->category->get_category_by_id($id);
        if ($existing_category) {
            $desk_image = $existing_category->cat_image; 
        }
    }

    $data = array(
        'category' => $this->input->post('category'),
        'slug' => $this->input->post('slug'),
        'cat_image' => $desk_image,
    );


    if ($this->category->update_category($id, $data)) {
        $this->session->set_flashdata('success_message', 'Data Updated Successfully!');
    } else {
        $this->session->set_flashdata('error_message', 'Failed to update data!');
    }

    // Redirect to category list
    redirect('admin/category');
}


    
}

?>