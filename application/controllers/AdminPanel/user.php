
<?php
 defined('BASEPATH') OR exit('No direct script access allowe');

class User extends CI_Controller{   
  
    public function __construct() {
    	
	    parent::__construct();
		
		 date_default_timezone_set('Asia/Kolkata');

		  $this->load->library('my_libraries');
          $this->load->library('Customlibrary');
		  $this->load->model('admin/coupon_model','coupon');
          $this->load->helper(array('form', 'url'));
          $this->load->library('session'); 
		  $session=$this->session->userdata('admin');
		  
		  $_SERVER['REQUEST_URI']="admin";

		  if(basename($_SERVER['REQUEST_URI'])!='admin'){
		       if(!isset($session) && $session['is_login']!=1){
		          // redirect(base_url('login'));
		           redirect(base_url('admin'));
		       }
		  }
  
  	}

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

    $array_data = $this->coupon->get_all_coupons($start, $records_per_page, $name);
    $count = $this->coupon->record_count($name);

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

    $option = '';
    if (is_array($array_data) && count($array_data) > 0) {
        foreach ($array_data as $keyval) {
            // $status = isset($keyval->status) && $keyval->status == 1 ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>';

            $option .= '<tr> 
                            <td>' . $i . '</td>
                            <td>' . $keyval->coupon_code . '</td>
                            <td>' . $keyval->disc_type . '</td>
                            <td>' . $keyval->disc_per . '</td>
                            <td><a href="' . base_url() . 'admin/coupon/edit/' . $keyval->coupon_id . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
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
        $this->load->view('admin/coupon/index', $output);
    }
}



    public function create() {
        $this->load->view('admin/user/create');
    }

    public function store() {
        // $product_id_array = $this->input->post('product_id');
        // $product_ids = is_array($product_id_array) ? implode(',', $product_id_array) : '';
        $data = array(
            'coupon_code' => $this->input->post('coupon_code'),
            'disc_type' => $this->input->post('disc_type'),
            'disc_per' => $this->input->post('disc_per'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'coupons_status' => $this->input->post('coupon_status'),
            'coupon_time_uses' => $this->input->post('coupon_time_uses')
        );
        if ($this->coupon->store($data)) {
            $this->session->set_flashdata('msg', 'Offers inserted successfully.');
        } else {
            $this->session->set_flashdata('msg', 'Failed to insert Offers.');
        }

        redirect('admin/coupon/create');
    }


    // public function edit($id) {
    //     $data['subcategory'] = $this->subcategory->get_subcategory($id);
    //     $data['categories'] = $this->category->get_categories();
    //     $this->load->view('admin/subcategory/edit', $data);
    // }

    // public function update($id) {
    //     $data = array(
    //         'cat_id' => $this->input->post('cat_id'),
    //         'subCat_name' => $this->input->post('subcategory_name'),
    //         'slug' => $this->input->post('slug'),
    //     );
    //     $this->subcategory->update_subcategory($id, $data);
    //     $this->session->set_flashdata('success_message', 'Subcategory updated successfully');
    //     redirect('admin/subcategory');
    // }


}
?>