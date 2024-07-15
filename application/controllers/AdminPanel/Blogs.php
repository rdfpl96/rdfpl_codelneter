
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

        $adjacents = 2;
        $records_per_page = 25;
        $page = (int)(isset($_POST['page']) ? $_POST['page'] : 1);
        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $records_per_page;

        $name = isset($_POST['name']) && $_POST['name'] != '' ? $_POST['name'] : '';

        $array_data = $this->blogs->get_blogs($start, $records_per_page, $name);
        $count = $this->blogs->record_count($name);

        $next = $page + 1;
        $prev = $page - 1;
        $last_page = ceil($count / $records_per_page);
        $second_last = $last_page - 1;

        $i = (($page * $records_per_page) - ($records_per_page - 1));
        $pagination = "";

        if ($last_page > 1) {
            $pagination .= "<div class='pagination'>";
            if ($page > 1) {
                $pagination .= "<a href='javascript:void(0);' onClick='change_page(" . ($prev) . ");'>&laquo; Previous&nbsp;&nbsp;</a>";
            } else {
                $pagination .= "<span class='disabled'>&laquo; Previous&nbsp;&nbsp;</span>";
            }

            if ($last_page < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $last_page; $counter++) {
                    if ($counter == $page) {
                        $pagination .= "<span class='current'>$counter</span>";
                    } else {
                        $pagination .= "<a href='javascript:void(0);' onClick='change_page(" . ($counter) . ");'>$counter</a>";
                    }
                }
            } elseif ($last_page > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page) {
                            $pagination .= "<span class='current'>$counter</span>";
                        } else {
                            $pagination .= "<a href='javascript:void(0);' onClick='change_page(" . ($counter) . ");'>$counter</a>";
                        }
                    }
                    $pagination .= "...";
                    $pagination .= "<a href='javascript:void(0);' onClick='change_page(" . ($second_last) . ");'>$second_last</a>";
                    $pagination .= "<a href='javascript:void(0);' onClick='change_page(" . ($last_page) . ");'>$last_page</a>";
                } elseif ($last_page - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination .= "<a href='javascript:void(0);' onClick='change_page(1);'>1</a>";
                    $pagination .= "<a href='javascript:void(0);' onClick='change_page(2);'>2</a>";
                    $pagination .= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page) {
                            $pagination .= "<span class='current'>$counter</span>";
                        } else {
                            $pagination .= "<a href='javascript:void(0);' onClick='change_page(" . ($counter) . ");'>$counter</a>";
                        }
                    }
                    $pagination .= "..";
                    $pagination .= "<a href='javascript:void(0);' onClick='change_page(" . ($second_last) . ");'>$second_last</a>";
                    $pagination .= "<a href='javascript:void(0);' onClick='change_page(" . ($last_page) . ");'>$last_page</a>";
                } else {
                    $pagination .= "<a href='javascript:void(0);' onClick='change_page(1);'>1</a>";
                    $pagination .= "<a href='javascript:void(0);' onClick='change_page(2);'>2</a>";
                    $pagination .= "..";
                    for ($counter = $last_page - (2 + ($adjacents * 2)); $counter <= $last_page; $counter++) {
                        if ($counter == $page) {
                            $pagination .= "<span class='current'>$counter</span>";
                        } else {
                            $pagination .= "<a href='javascript:void(0);' onClick='change_page(" . ($counter) . ");'>$counter</a>";
                        }
                    }
                }
            }
            if ($page < $counter - 1) {
                $pagination .= "<a href='javascript:void(0);' onClick='change_page(" . ($next) . ");'>Next &raquo;</a>";
            } else {
                $pagination .= "<span class='disabled'>Next &raquo;</span>";
            }
            $pagination .= "</div>";
        }



        // echo "</pre>";
        // print_r($array_data);
        // die();

        $option = '';

        if (is_array($array_data) && count($array_data) > 0) {
            foreach ($array_data as $record) {
                $status = isset($record['status']) && $record['status'] == 1 ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>';

                $option .= '<tr> 
                                <td>' . $i . '</td>
                                <td>' . $record['blog_header'] . '</td>
                                <td>' . $record['category'] . '</td>
                                <td>' . $record['blog_image']. '</td>
                                <td>' . $record['updated_by']. '</td>
                                <td>' . date('d-m-Y', strtotime($record['blog_add_date'])) . '</td>
                                <td>' . $status . '</td>
                                
                                <td></td>
                                <td><a href="' . base_url() . 'admin/blogs/edit/' . $record['blog_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
                        </tr>';
                $i++;
            }
        } else {
            $option .= '<tr><td colspan="7" style="color:red;text-align:center">No record</td></tr>';
        }

        $output = array('array_data' => $option, 'pagination' => $pagination, 'page_menu_id' => $page_menu_id, 'getAccess' => $getAccess);
        if ($this->input->post('method') == "changepage") {
            echo json_encode($output);
            exit();
        } else {
            $this->load->view('admin/blogs/index', $output);
        }
    }





    // public function create() {


    //     // print_r($data);
    //     // exit;
    //     $this->load->view('admin/blogs/create', $data);
    // }



    // public function create() {

    //     $data['categories'] = $this->category->get_categories();
    //     $data['product_list'] = 0;

    //     $upload_path = realpath(APPPATH . '../uploads');
    //     if (!is_dir($upload_path)) {
    //       mkdir($upload_path, 0777, TRUE);
    //     }

    //     $config['upload_path'] = $upload_path;
    //     $config['allowed_types'] = 'gif|jpg|jpeg|png';
    //     $config['max_size'] = 2048;

    //     $this->load->library('upload', $config);
    //     if (!$this->upload->do_upload('blog_image')) {
    //         $error = $this->upload->display_errors();
    //         $this->session->set_flashdata('error', $error);
    //         $data['content'] = 'admin/containerPage/add_user';
    //         $this->load->view('admin/template', $data);
    //       } 


    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    //         $blog_data = array(
    //             'blog_header' => $this->input->post('blog_header'),
    //             'blog_category' => $this->input->post('blog_category'),
    //             'blog_description' => $this->input->post('blog_description'),
    //             'admin_image' => $upload_data['blog_image']
    //         );





















    //         // Insert the blog data into the database
    //         if ($this->blogs->insert_blog($blog_data)) {

    //             $this->session->set_flashdata('success_message', 'Blog added successfully.');
    //             redirect('admin/blogs');
    //         } else {

    //             $this->session->set_flashdata('error_message', 'An error occurred while adding the blog. Please try again.');
    //             redirect('admin/blogs/create');
    //         }
    //     } else {
    //         // Load the form view if not a POST request
    //         $this->load->view('admin/blogs/create', $data);
    //     }
    // }



    public function create1()
    {
        $data['categories'] = $this->category->get_categories();
        $data['product_list'] = 0;

        $upload_path = realpath(APPPATH . '../uploads/blogs_image/');
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            
            if (!$this->upload->do_upload('image')) {

                die('Error uploading');
                $error = $this->upload->display_errors();
                return  $error;
            }

            $upload_data = $this->upload->data();

            $blog_data = array(
                'blog_header' => $this->input->post('blog_header'),
                'blog_category' => $this->input->post('blog_category'),
                'blog_description' => $this->input->post('blog_description'),
                'blog_image' => $upload_data['blog_image']
            );

            if ($this->blogs->insert_blog($blog_data)) {
                $this->session->set_flashdata('success_message',
                    'Blog added successfully.'
                );
                redirect('admin/blogs');
            } else {
                $this->session->set_flashdata('error_message', 'An error occurred while adding the blog. Please try again.');
                redirect('admin/blogs/create');
            }
        } else {
            
            $this->load->view('admin/blogs/create', $data);
        }
    }
    
    


    public function searchBlog() {
        // Get the search keywords from the POST request
        $keywords = $this->input->post('searchText');
        
      
        $Cat_Html  = $this->blogs->getBlogSearchDetails($keywords);
        
       
        $html = '';
        foreach ($Cat_Html as $val) {
            $html .= '<tr>
             <td>' . $val['blog_id'] . '</td>
                <td>' . $val['blog_header'] . '</td>
                <td>' . $val['category'] . '</td>
              <td>' . $val['blog_image'].'</td>
                 <td>' . $val['updated_by'] . '</td>
                <td>'.date('d-m-Y', strtotime($val['blog_add_date'])).'</td>
                <td>' . $val['blog_status'] . '</td>
                <td>' . $val['action'] . '</td>
                <td><a href="' . base_url() . 'admin/blogs/edit/' . $val['blog_id'] . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> Edit</a></td>
            </tr>';
        }
        
        
        print_r($html);
        die();
    

    
       

        // Load the view with the data
        $this->load->view('admin/blogs/index', $data);
    }
    








    public function create()
{
    $data['categories'] = $this->category->get_categories();
    $data['product_list'] = 0;

    // $upload_path = realpath(APPPATH . '../uploads/blogs_image/');
    // if (!is_dir($upload_path)) {
    //     mkdir($upload_path, 0777, TRUE);
    // }

    // $config['upload_path'] = $upload_path;
    // $config['allowed_types'] = 'gif|jpg|jpeg|png';
    // $config['max_size'] = 2048;
    // $this->load->library('upload', $config);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // if (!$this->upload->do_upload('image')) {
        //     $error = $this->upload->display_errors();
        //     echo json_encode(['status' => 'error', 'message' => $error]);
        //     return;
        // }

        // $upload_data = $this->upload->data();

        $blog_data = array(
            'blog_header' => $this->input->post('blog_header'),
            'blog_category' => $this->input->post('blog_category'),
            'blog_description' => $this->input->post('blog_description'),
            //'blog_image' => $upload_data['blog_image']
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