
<?php
defined('BASEPATH') or exit('No direct script access allowe');

class Subcategory extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        date_default_timezone_set('Asia/Kolkata');

        $this->load->library('my_libraries');
        $this->load->model('admin/category_model', 'category');
        $this->load->model('admin/subcategory_model', 'subcategory');
        $session = $this->session->userdata('admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $_SERVER['REQUEST_URI'] = "admin";

        if (basename($_SERVER['REQUEST_URI']) != 'admin') {
            if (!isset($session) && $session['is_login'] != 1) {
                // redirect(base_url('login'));
                redirect(base_url('admin'));
            }
        }
    }

    // function index(){

    //      $this->load->view('admin/category/index');


    // }

    public function index($page = '')
    {

        $name = isset($_POST['name']) && $_POST['name'] != '' ? $_POST['name'] : '';
        $page = empty($page) ? 0 : intval($page);

        $menuIdAsKey = 2;
        $getAccess = $this->my_libraries->userAthorizetion($menuIdAsKey);
        $page_menu_id = $menuIdAsKey;

        $config = array();
        $config["base_url"] = base_url() . "admin/subcategory";
        $config["total_rows"] = $this->subcategory->get_user_count_subcategory($name);
        $config["per_page"] = 20; // Number of records per page
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
        $data['pagination'] = $this->pagination->create_links();

        $array_data = $this->subcategory->get_subcategories($page, $config["per_page"], $name);

        $option = '';
        $i = 1;

        if (is_array($array_data) && count($array_data) > 0) {
            foreach ($array_data as $record) {
                $status = isset($record['status']) && $record['status'] == 1 ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>';

                $option .= '<tr> 
                        <td>' . ($i + $page) . '</td>
                        <td>' . $record['category'] . '</td>
                        <td>' . $record['subCat_name'] . '</td>  
                        <td>' . $status . '</td>
                        <td>' . date('d-m-Y', strtotime($record['update_date'])) . '</td>';
                if (!empty($record['subcat_image'])) {
                    $option .= '<td><img src="' . base_url() . 'uploads/category/' . $record['subcat_image'] . '" style="width:47px;height: 47px;"></td>';
                } else {
                    $option .= '<td >No image found</td>';
                }
                $option .= '<td>
                            <a href="' . base_url() . 'admin/subcategory/edit/' . $record['sub_cat_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit</a>
                            <a href="javascript:deleteRowtablesub(' . $record['sub_cat_id'] . ')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" title="Delete"><i class="fa fa-trash"></i>&nbsp;&nbsp; Delete</a>
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


    public function search_subcat_list()
    {
        $keywords = $this->input->post('searchText');
        $Cat_Html = $this->subcategory->SearchCategory($keywords);
        $counter = 1;
        $html = '';

        foreach ($Cat_Html as $val) {
            $status = isset($val['status']) && $val['status'] == 1 ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>';
            $html .= '<tr>
                            <td>' . $counter++ . '</td>
                            <td>' . $val['category'] . '</td>
                            <td>' . $val['subCat_name'] . '</td>
                            <td>' . $status . '</td>
                            <td>' . date('d-m-Y', strtotime($val['update_date'])) . '</td>';
            if (!empty($val['subcat_image'])) {
                $html .= '<td><img src="' . base_url() . 'uploads/category/' . $val['subcat_image'] . '" style="width:47px;height: 47px;"></td>';
            } else {
                $html .= '<td >No image found</td>';
            }
            $html .= 
                            '<td><a href="' . base_url() . 'admin/category/edit/' . $val['cat_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit</a>
                            <a href="javascript:deleteRowtablesub(' . $val['sub_cat_id'] . ')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" title="Delete"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete</a></td>
                        </tr>';
        }
        // $data['categories']
        print_r($html);
        die();
    }

    public function deleteSubcategory()
    {
        $menuIdAsKey = 34;
        $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
        $data['page_menu_id'] = $menuIdAsKey;

        $sub_cat_id = $this->input->post('sub_cat_id');
        $response = $this->sqlQuery_model->sql_delete('tbl_sub_category', array('sub_cat_id' => $sub_cat_id));

        if ($response == '1') {
            $Flag = 'True';
        } else {
            $Flag = 'False';
        }

        echo json_encode($Flag);
        exit();
    }





    public function create()
    {
        $data['categories'] = $this->category->get_categories();
        // print_r($data);
        // exit;
        $this->load->view('admin/subcategory/create', $data);
    }


    public function store()
    {

        $upload_path = realpath(APPPATH . '../uploads/category/');
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('cat_image')) {
            $error = $this->upload->display_errors();
            echo json_encode(['status' => 'error', 'message' => $error]);
            return;
        }

        $upload_data = $this->upload->data();
        $data = array(
            'cat_id' => $this->input->post('cat_id'),
            'subCat_name' => $this->input->post('subcategory_name'),
            'slug' => $this->input->post('slug'),
            'subcat_image' => $upload_data['file_name']
        );

        // echo "<pre>"; print_r($data); die();"</pre>";

        if ($this->subcategory->insert_subcategory($data)) {
            $this->session->set_flashdata('success_message', 'Data Inserted Successfully!');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to insert data!');
        }

        redirect('admin/subcategory');
    }






    public function edit($id)
    {
        $data['subcategory'] = $this->subcategory->get_subcategory($id);
        $data['categories'] = $this->category->get_categories();

        $this->load->view('admin/subcategory/edit', $data);
    }




    public function update($id)
    {

        $upload_path = realpath(APPPATH . '../uploads/category/');

        // Create the directory if it doesn't exist
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }

        // Configure the upload settings
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);

        // Fetch the existing subcategory image
        $existing_subcat = $this->subcategory->get_Sub_Cat_Id($id);

        $desk_image = $existing_subcat ? $existing_subcat->subcat_image : '';

        // Handle image upload
        if ($this->upload->do_upload('cat_image')) {
            $upload_data = $this->upload->data();
            $desk_image = $upload_data['file_name'];
        }
        // Prepare data for updating
        $data = array(
            'cat_id' => $this->input->post('cat_id'),
            'subCat_name' => $this->input->post('subcategory_name'),
            'slug' => $this->input->post('slug'),
            'subcat_image' => $desk_image
        );
        $this->subcategory->update_subcategory($id, $data);
        $this->session->set_flashdata('success_message', 'Subcategory updated successfully');
        // Redirect to the subcategory list page
        redirect('admin/subcategory');
    }
}

?>