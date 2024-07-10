
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

        $array_data = $this->category->getList($page, $config["per_page"], $name);


        $option = '';
        if (is_array($array_data) && count($array_data) > 0) {
            foreach ($array_data as $i => $record) {
                $status = isset($record['status']) && $record['status'] == 1 ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>';
                $option .= '<tr> 
                                <td>' . ($i + 1 + $page) . '</td>
                                <td>' . $record['category'] . '</td>
                                <td>' . $record['slug'] . '</td>
                                <td>' . $status . '</td>
                                <td>' . date('d-m-Y', strtotime($record['add_date'])) . '</td>
                                <td></td>
                                <td><a href="' . base_url() . 'admin/category/edit/' . $record['cat_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
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


    public function edit($id)
    {

        // Get category details by ID
        $data['category'] = $this->category->get_category_by_id($id);
        // Load the edit view
        $this->load->view('admin/category/edit', $data);
    }



    public function update($id)
    {
        $data = array(
            'category' => $this->input->post('category'),
            'slug' => $this->input->post('slug')
        );

        // Update the category
        if ($this->category->update_category($id, $data)) {
            $this->session->set_flashdata('success_message', 'Data Updated Successfully!');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to update data!');
        }
        redirect('admin/category');
    }
}


?>