
<?php
 defined('BASEPATH') OR exit('No direct script access allowe');

class Blogs extends CI_Controller{   
  
    public function __construct() {
    	
	    parent::__construct();
		
		 date_default_timezone_set('Asia/Kolkata');

		  $this->load->library('my_libraries');
		  $this->load->model('admin/category_model','category');
          $this->load->model('admin/blogs_model','blogs');
		  $session=$this->session->userdata('admin');
          $this->load->library('pagination');
          $this->load->helper(array('form', 'url'));
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

    // public function index() {
    //     $menuIdAsKey = 2;
    //     $getAccess = $this->my_libraries->userAthorizetion($menuIdAsKey);
    //     $page_menu_id = $menuIdAsKey;
    
    //     // Pagination configuration
    //     $config = array();
    //     $config["base_url"] = base_url() . "admin/blogs";
    //     $config["total_rows"] = $this->blogs->get_blog_count_category();
    //     $config["per_page"] = 5;
    //     $config["uri_segment"] = 3;
    
    //     // echo "<pre>";
    //     // print_r($config);
    //     // die();
    //     // Customizing pagination
    //     $config['full_tag_open'] = '<ul class="pagination">';
    //     $config['full_tag_close'] = '</ul>';
    //     $config['first_link'] = 'First';
    //     $config['first_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
    //     $config['first_tag_close'] = '</a></li>';
    //     $config['last_link'] = 'Last';
    //     $config['last_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
    //     $config['last_tag_close'] = '</a></li>';
    //     $config['next_link'] = 'Next';
    //     $config['next_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
    //     $config['next_tag_close'] = '</a></li>';
    //     $config['prev_link'] = 'Previous';
    //     $config['prev_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
    //     $config['prev_tag_close'] = '</a></li>';
    //     $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
    //     $config['cur_tag_close'] = '</a></li>';
    //     $config['num_tag_open'] = '<li class="paginate_button page-item page-link">';
    //     $config['num_tag_close'] = '</li>';
    
    //     $this->pagination->initialize($config);
    
    //     $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    //     $data['blog_list'] = $this->blogs->get_users_blogs($config["per_page"], $page);

    //     $data['pagination'] = $this->pagination->create_links();
    
    //     $name = $this->input->post('name') ? $this->input->post('name') : '';
    //     $start = $page;
    //     $array_data = $this->blogs->get_blogs($start, $config["per_page"], $name);



    //     // print_r($array_data);
    //     // die();

    //     $count = $this->blogs->record_count($name);
    
    //     // echo '<pre>';
    //     // print_r($array_data);
    //     // print_r($start);
    //     // print_r($config["per_page"]);
    //     // die();
    //     $i = ($page) ? $page : 1;
    
    //     $option = '';
    
    //     if (is_array($array_data) && count($array_data) > 0) {
    //         foreach ($array_data as $record) {
             
    
               
    //             $checked = ($record['blog_status'] == 1) ? 'checked' : '';
    //             $option .= '<tr> 
    //                             <td>' . $i . '</td>
    //                             <td>' . $record['blog_header'] . '</td>
    //                             <td>' . $record['category'] . '</td>
    //                             <td>' . $record['blog_image'] . '</td>
                               
    //                             <td>' . $record['updated_by'] . '</td>
    //                             <td>' . date('d-m-Y', strtotime($record['blog_add_date'])) . '</td>
    //                             <td> 
    //                             <a href="javascript:void(0)"> 
    //                             <label class="switch">
    //                                <input type="checkbox" id="Status'.$record['blog_id'].'" name="Status[]" value="'.$record['blog_status'].'" onclick="UpdateBlogStatus('.$record['blog_id'].')" '.$checked.'>
    //                             <span class="slider round"></span>
    //                             </label> 
    //                             </a>
    //                             </td>
    //                             <td><a href="' . base_url() . 'admin/blogs/edit/' . $record['blog_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i>Edit</a></td>
    //                             <td><a href="javascript:deleteRowtablesub(' . $record['blog_id'] . ')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title=""  title="Delete"><i class="fa fa-trash"></i>Delete</a></td>
    //                         </tr>';
    //             $i++;
    //         }
    //     } else {
    //         $option .= '<tr><td colspan="9" style="color:red;text-align:center">No record</td></tr>';
    //     }
    
    //     $output = array('array_data' => $option, 'page_menu_id' => $page_menu_id, 'getAccess' => $getAccess,'pagination' => $data['pagination']);
    
    //     if ($this->input->post('method') == "changepage") {
    //         echo json_encode($output);
    //         exit();
    //     } else {
    //         $this->load->view('admin/blogs/index', $output);
    //     }
    // }
    



    public function index() {
        $name = $this->input->post('name') ? $this->input->post('name') : '';
        $menuIdAsKey = 2;
        $getAccess = $this->my_libraries->userAthorizetion($menuIdAsKey);
        $page_menu_id = $menuIdAsKey;
        // Pagination configuration
        $config = array();
        $config["base_url"] = base_url() . "admin/blogs";
        $config["total_rows"] = $this->blogs->get_blog_count_category($name);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        // Customizing pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
        $config['first_tag_close'] = '</a></li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
        $config['last_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
        $config['next_tag_close'] = '</a></li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
        $config['prev_tag_close'] = '</a></li>';
        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="paginate_button page-item page-link">';
        $config['num_tag_close'] = '</li>';
    
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    
    
        $data['blog_list'] = $this->blogs->get_users_blogs($config["per_page"], $page);
    
        $data['pagination'] = $this->pagination->create_links();
        $start = $page;
        $array_data = $this->blogs->get_blogs($start, $config["per_page"], $name);

        // $count = $this->blogs->record_count($name);
        $i = $page + 1;

        $option = '';

         if (is_array($array_data) && count($array_data) > 0) {
            foreach ($array_data as $record) {
                $checked = ($record['blog_status'] == 1) ? 'checked' : '';
                $option .= '<tr> 
                                <td>' . $i . '</td>
                                <td>' . $record['blog_header'] . '</td>
                                <td>' . $record['category'] . '</td>';
                                if(!empty($record['blog_image'])){                                    
                                    $option .= '<td><img src="' . base_url().'uploads/blogs_image/'.$record['blog_image']. '" style="width:37px;height: 37px;"></td>';
                                }else{
                                    $option .= '<td></td>';
                                }
                                $option .= '<td>' . $record['updated_by'] . '</td>
                                <td>' . date('d-m-Y', strtotime($record['blog_add_date'])) . '</td>
                                
                                <td> 
                                <a href="javascript:void(0)"> 
                                <label class="switch">
                                   <input type="checkbox" id="Status'.$record['blog_id'].'" name="Status[]" value="'.$record['blog_status'].'" onclick="UpdateBlogStatus('.$record['blog_id'].')" '.$checked.'>
                                <span class="slider round"></span>
                                </label> 
                                </a>
                                </td>

                                <td><a href="' . base_url() . 'admin/blogs/edit/' . $record['blog_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i>Edit</a></td>

                                <td><a href="javascript:deleteRowtablesub(' . $record['blog_id'] . ')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" title="Delete"><i class="fa fa-trash"></i>Delete</a></td>

                            </tr>';
                       $i++;
            }
        } else {
            $option .= '<tr><td colspan="9" style="color:red;text-align:center">No record</td></tr>';
        }
    
        $output = array('array_data' => $option, 'page_menu_id' => $page_menu_id, 'getAccess' => $getAccess, 'pagination' => $data['pagination']);
    
        if ($this->input->post('method') == "changepage") {
            echo json_encode($output);
            exit();
        } else {
            $this->load->view('admin/blogs/index', $output);
        }
    }


    
    public function searchBlog() {
        // Get the search keywords from the POST request
        $keywords = $this->input->post('searchText');
        $Cat_Html  = $this->blogs->getBlogSearchDetails($keywords);
        $html = '';
        $counter = 0;
    
        foreach ($Cat_Html as $val) {
            $counter++;
            $checked = ($val['blog_status'] == 1) ? 'checked' : '';
            $imgHtml = '';
    
            if (!empty($val['blog_image'])) {                                    
                $imgHtml = '<td><img src="' . base_url() . 'uploads/blogs_image/' . $val['blog_image'] . '" style="width:37px;height:37px;"></td>';
            } else {
                $imgHtml = '<td>No Image found</td>';
            }
    
            $html .= '<tr>
                <td>' . $counter . '</td>
                <td>' . $val['blog_header'] . '</td>
                <td>' . $val['category'] . '</td>
                ' . $imgHtml . '
                <td>' . $val['updated_by'] . '</td>
                <td>' . date('d-m-Y', strtotime($val['blog_add_date'])) . '</td>
                <td>
                    <a href="javascript:void(0)">
                        <label class="switch">
                            <input type="checkbox" id="Status' . $val['blog_id'] . '" name="Status[]" value="' . $val['blog_status'] . '" onclick="UpdateBlogStatus(' . $val['blog_id'] . ')" ' . $checked . '>
                            <span class="slider round"></span>
                        </label>
                    </a>
                </td>
                <td>' . $val['action'] . '</td>
                <td><a href="' . base_url() . 'admin/blogs/edit/' . $val['blog_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> Edit</a></td>
                <td><a href="javascript:deleteRowtablesub(' . $val['blog_id'] . ')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i>Delete</a></td>
            </tr>';
        }
    
        print_r($html);
        die();
    
        // Load the view with the data
        $this->load->view('admin/blogs/index', ['html' => $html]);
    }
    
    






public function create()
{
    $data['categories'] = $this->blogs->blog_get_categories();

    $upload_path = realpath(APPPATH . '../uploads/blogs_image/');
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, TRUE);
    }

    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = '*'; 
    $config['max_size'] = 0; 
    $this->load->library('upload', $config);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $bb=$this->upload->do_upload('image');
        // print_r('upload result',$bb);


        if (!$this->upload->do_upload('blog_image')) {
            $error = $this->upload->display_errors();
            echo json_encode(['status' => 'error', 'message' => $error, 'flag' => '']);
            return;
        }


        // die("testing upload");
        $upload_data = $this->upload->data();

       

        $blog_data = array(
            'blog_header' => $this->input->post('blog_header'),
            'blog_category' => $this->input->post('blog_category'),
            'blog_description' => $this->input->post('blog_description'),
            'blog_image' => $upload_data['file_name']
        );

        if ($this->blogs->insert_blog($blog_data)) {

            echo json_encode(['status' => 'success', 'message' => 'Blog added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'An error occurred while adding the blog. Please try again.']);
        }
    } else {
        $this->load->view('admin/blogs/create', $data);
    }
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
        $data['blog'] = $this->blogs->edit($id);
        $data['categories'] = $this->category->get_categories();

        
        $this->load->view('admin/blogs/edit', $data);
    }


    

    public function update() {
        $id = $this->input->post('blog_id');
    
        $blog_data = array(
            'blog_header' => $this->input->post('blog_header'),
            'blog_category' => $this->input->post('blog_category'),
            'blog_description' => $this->input->post('blog_description')
        );

        // Upload path configuration
        $upload_path = realpath(APPPATH . '../uploads/blogs_image/');

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);
    
        // echo '<pre>';
        // print_r($blog_data);
        // die();
        if (!empty($_POST['blog_image']['name'])) {


            // die('Upload');

            if (!$this->upload->do_upload('blog_image')) {

                $error = $this->upload->display_errors();

                echo json_encode(['status' => 'error', 'message' => $error]);

                return;
            } else {
              // Get uploaded file data
                $upload_data = $this->upload->data();

                $blog_data['blog_image'] = $upload_data['file_name'];
            }
        } else {
            // $blog_data['blog_image'] = $this->input->post('blogImage');
        }
        if ($this->blogs->update_blogs($id, $blog_data)) {

            echo json_encode(['status' => 'success', 'message' => 'Blog updated successfully']);
        } else {

            echo json_encode(['status' => 'error', 'message' => 'Failed to update the blog']);
        }
    }
    





    

    





    


    public function deleteblog() {

        $blog_id = $this->input->post('blog_id');

        // print_r($blog_id);
        // die();

        $response =$this->blogs->deleteblog($blog_id);

        if($response=='1'){

            $Flag= 'True';
        }else{
            $Flag= 'False';
        }

        echo json_encode($Flag);
        exit();
        redirect('admin/blogs');
    }


    
    
    public function updateBlogStatus(){
        $status = $this->input->post('status');
        $blog_id = $this->input->post('blog_id');
        $updateStatus = $this->blogs->updateBlogStatus($blog_id, $status);
        if ($updateStatus) {
            echo json_encode('True');
        } else {
            
            $this->load->view('admin/blogs/create', $data);
            echo json_encode('False');
        }
    }

}

?>