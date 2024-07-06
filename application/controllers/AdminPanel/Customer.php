<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{




    // public function customer_list()

    // {
    //     $this->load->view('admin/containerPage/customer-list');
    // }

    public function customer_list()
{
    $menuIdAsKey = 4;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;



    $querys = "SELECT * FROM tbl_customer";
    $pr_list_count = $this->sqlQuery_model->sql_query($querys);
    $url_link = base_url('admin/customer_list');
    $limit_per_page = 10;
    $getVariable = $this->input->get('per_page');
    $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0) : 0;

    $total_records = ($pr_list_count != 0) ? count($pr_list_count) : 0;
    $config = createPagination($total_records, $url_link, $limit_per_page);
    $this->pagination->initialize($config);

    $sql_limit = 'LIMIT ' . $page * $limit_per_page . ',' . $limit_per_page;
    $querys = "SELECT * FROM tbl_customer ORDER BY customer_id DESC $sql_limit";
    $data['customer_list'] = $this->sqlQuery_model->sql_query($querys);
    $data["links"] = $this->pagination->create_links();



    // $data['customer_list']=$this->sqlQuery_model->sql_select('tbl_customer','customer_id');

    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_customer', 'primary_key' => 'customer_id', 'update_target_column' => 'status');

    $data['deleteActionArr'] = array('table' => 'tbl_customer', 'primary_key' => 'customer_id');

    $data['content'] = 'admin/containerPage/customer-list';
    $this->load->view('admin/template', $data);
}






    



}


?>