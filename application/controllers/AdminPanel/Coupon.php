
<?php
defined('BASEPATH') or exit('No direct script access allowe');

class Coupon extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        date_default_timezone_set('Asia/Kolkata');

        $this->load->library('my_libraries');
        $this->load->library('Customlibrary');
        $this->load->model('admin/coupon_model', 'coupon');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->library('session');
        $session = $this->session->userdata('admin');


        $_SERVER['REQUEST_URI'] = "admin";

        if (basename($_SERVER['REQUEST_URI']) != 'admin') {
            if (!isset($session) && $session['is_login'] != 1) {
                // redirect(base_url('login'));
                redirect(base_url('admin'));
            }
        }
    }



    // public function index1()
    // {
    //     $menuIdAsKey = 2;
    //     $getAccess = $this->my_libraries->userAthorizetion($menuIdAsKey);
    //     $page_menu_id = $menuIdAsKey;
    
    //     $config = array();
    //     $config["base_url"] = base_url() . "admin/coupon";
    //     $config["total_rows"] = $this->coupon->record_count();
    //     $config["per_page"] = 10;
    //     $config["uri_segment"] = 3;
    
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
    //     $data['copun_list'] = $this->coupon->get_all_coupons($config["per_page"], $page);
    //     $data['pagination'] = $this->pagination->create_links();
    
    //     $start = $page;
    //     $array_data = $this->coupon->get_all_coupons($config["per_page"], $start);
        
    //     $i = $page + 1;
    
    //     $option = '';
    
    //     if (is_array($array_data) && count($array_data) > 0) {
    //         foreach ($array_data as $keyval) {
    //             // Convert disc_type to human-readable format
    //      $disc_type_display = ($keyval->disc_type === 'fixed_amt') ? 'Fixed Amount' : 
    //                                  (($keyval->disc_type === 'percentage') ? 'Percentage' : 'Unknown');
                
    //             $discountVal = ($keyval->disc_amt == '0.00') ? $keyval->disc_per : $keyval->disc_amt;
    //             $coupon_flag =$this->coupon->CheckCouponsPresentInOrderTable($keyval->coupon_id);
    //             $option .= '<tr> 
    //                     <td>' . $i++ . '</td>
    //                     <td>' . $keyval->coupon_code . '</td>
    //                     <td>' . $disc_type_display . '</td>
    //                     <td>' . $discountVal . '</td>';
    //                     if($coupon_flag == 1){
    //                         $option .= '<td></td>
    //                         <td></td>';
    //                     }else{
    //                         $option .= '<td><a href="' . base_url() . 'admin/coupon/edit/' . $keyval->coupon_id . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
    //                         <td><a href="javascript:deleteRowtablesub(' . $keyval->coupon_id . ')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" title="Delete"><i class="fa fa-trash"></i>Delete</a></td>';
    //                     }
    //                 $option .= '</tr>';
    //         }
    //     } else {
    //         $option .= '<tr><td colspan="7" style="color:red;text-align:center">No record</td></tr>';
    //     }
    
    //     $output = array(
    //         'array_data' => $option,
    //         'page_menu_id' => $page_menu_id,
    //         'getAccess' => $getAccess,
    //         'pagination' => $data['pagination']
    //     );
    
    //     if ($this->input->post('method') == "changepage") {
    //         echo json_encode($output);
    //         exit();
    //     } else {
    //         $this->load->view('admin/coupon/index', $output);
    //     }
    // }
    

    public function index() {
        $query = $this->input->get('q');
        $ajaxFlag = $this->input->request_headers()['X-Ajax'];
        $menuIdAsKey = 2;
        $getAccess = $this->my_libraries->userAthorizetion($menuIdAsKey);
        $config = array();
        $config['reuse_query_string'] = TRUE;
        $config["base_url"] = base_url() . "admin/coupon";
        $config["total_rows"] = $this->coupon->record_count($query);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
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
        $coupons = $this->coupon->get_all_coupons($config["per_page"], $page, $query);
        $i = $page + 1;
        $option = '';
        if (is_array($coupons) && count($coupons) > 0) {
            foreach ($coupons as $keyval) {
                // Convert disc_type to human-readable format
                $disc_type_display = ($keyval->disc_type === 'fixed_amt') ? 'Fixed Amount' : 
                                     (($keyval->disc_type === 'percentage') ? 'Percentage' : 'Unknown');                
                $discountVal = ($keyval->disc_amt == '0.00') ? $keyval->disc_per : $keyval->disc_amt;
                $coupon_flag = $this->coupon->CheckCouponsPresentInOrderTable($keyval->coupon_id);

                $option .= '<tr> 
                        <td>' . $i++ . '</td>
                        <td>' . $keyval->coupon_code . '</td>
                        <td>' . $disc_type_display . '</td>
                        <td>' . $discountVal . '</td>';
                if($coupon_flag == 1){
                    $option .= '<td></td>
                    <td></td>';
                }else{
                    $option .= '<td><a href="' . base_url() . 'admin/coupon/edit/' . $keyval->coupon_id . '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="edit"><i class="fa fa-pencil"></i>Edit</a></td>
                    <td><a href="javascript:deleteRowtablesub(' . $keyval->coupon_id . ')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" title="Delete"><i class="fa fa-trash"></i>Delete</a></td>';
                }
                $option .= '</tr>';
            }
        } else {
            $option .= '<tr><td colspan="7" style="color:red;text-align:center">No record</td></tr>';
        }

        $output = [
            'getAccess' => $getAccess,
            'array_data' => $option,
            'pagination' => $this->pagination->create_links(),
        ];

        if ($this->input->is_ajax_request()) {
            echo json_encode($output);
        } else {
            $this->load->view('admin/coupon/list', $output);    
        }        
    }


 
    


    public function create()
    {
        $this->load->view('admin/coupon/create');
    }

    public function store()
    {
        // $product_id_array = $this->input->post('product_id');
        // $product_ids = is_array($product_id_array) ? implode(',', $product_id_array) : '';
        $data = array(
            'coupon_code' => $this->input->post('coupon_code'),
            'disc_type' => $this->input->post('disc_type'),
            // 'disc_amt' => $this->input->post('disc_amt'),
            'disc_amt' => ($this->input->post('disc_type')=='fixed_amt') ? $this->input->post('disc_amt') : $this->input->post('disc_per'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'status' => $this->input->post('coupon_status'),
            //'coupon_time_uses' => $this->input->post('coupon_time_uses')
        );


        // echo "<pre>";

        // print_r($data);

        // die();

        if ($this->coupon->store($data)) {
            $this->session->set_flashdata('msg', 'coupon inserted successfully.');
            redirect('admin/coupon');
        } else {
            $this->session->set_flashdata('msg', 'coupon  insert failed.');
        }

        redirect('admin/coupon/create');
    }






    public function edit($id)
    {
        $data['coupon'] = $this->coupon->edit($id);
        $this->load->view('admin/coupon/edit', $data);
    }

    




    public function update()
    {
        $coupon_id = $this->input->post('coupon_id');
        $coupon_data = array(
            'coupon_code' => $this->input->post('coupon_code'),
            'disc_type' => $this->input->post('disc_type'),
            'disc_amt' => ($this->input->post('disc_type')=='fixed_amt') ? $this->input->post('disc_amt') : $this->input->post('disc_per'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'status' => $this->input->post('coupon_status'),
            //'coupon_time_uses' => $this->input->post('coupon_time_uses'),
            'updated_by' => $this->session->userdata('admin_id')
        );

        $update_status = $this->coupon->update_coupon($coupon_id, $coupon_data);
        if ($update_status) {
            $this->session->set_flashdata('success_message', 'Coupon updated successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to update coupon. Please try again.');
        }

        redirect('admin/coupon');
    }







    public function delete_coupon()
    {

        $coupon_id = $this->input->post('coupon_id');

        // print_r($blog_id);
        // die();

        $response = $this->coupon->deletecoupon($coupon_id);

        if ($response == '1') {

            $Flag = 'True';
        } else {
            $Flag = 'False';
        }

        echo json_encode($Flag);
        exit();
        redirect('admin/blogs');
    }
}



?>