<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('my_libraries');
    date_default_timezone_set('Asia/Kolkata');
    $this->load->model('admin/user_model');
    $this->load->library('form_validation');
    $this->load->helper(array('form', 'url'));
    $this->load->library('pagination');

    $session = $this->session->userdata('admin');

    $_SERVER['REQUEST_URI'] = "admin";

    if (basename($_SERVER['REQUEST_URI']) != 'admin') {
      if (!isset($session) && $session['is_login'] != 1) {
        // redirect(base_url('login'));
        redirect(base_url('admin'));
      }
    }
  }




  public function index()
  {
    $session = $this->session->userdata('admin');

    if ($session == "") {
      $this->load->view('admin/index');
    } else {
      redirect(base_url('admin/dashboard'));
    }
  }

  public function dashboard()
  {

    $menuIdAsKey = 15;
    // $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $data['countOrderToday'] = $this->my_libraries->getTotalOrder('today');
    $data['countOrderWeek'] = $this->my_libraries->getTotalOrder('week');
    $data['countOrderMonth'] = $this->my_libraries->getTotalOrder('month');
    $data['countOrderYear'] = $this->my_libraries->getTotalOrder('year');


    $data['countCustomerToday'] = $this->my_libraries->getTotalCustomer('today');
    $data['countCustomerWeek'] = $this->my_libraries->getTotalCustomer('week');
    $data['countCustomerMonth'] = $this->my_libraries->getTotalCustomer('month');
    $data['countCustomerYear'] = $this->my_libraries->getTotalCustomer('year');


    $data['totalSaleToday'] = $this->my_libraries->getTotalSale('today');
    $data['totalSaleWeek'] = $this->my_libraries->getTotalSale('week');
    $data['totalSaleMonth'] = $this->my_libraries->getTotalSale('month');
    $data['totalSaleYear'] = $this->my_libraries->getTotalSale('year');

    $data['totalProduct'] = $this->my_libraries->totalProduct();

    $data['mostSoldProductToday'] = $this->my_libraries->mostSoldProducts('today');
    $data['mostSoldProductWeek'] = $this->my_libraries->mostSoldProducts('week');
    $data['mostSoldProductMonth'] = $this->my_libraries->mostSoldProducts('month');
    $data['mostSoldProductYear'] = $this->my_libraries->mostSoldProducts('year');

    // ====================Today Order =============================
    $querys = "SELECT * FROM tbl_order_manager WHERE date(order_add_date) = CURDATE();";
    $pr_list_count = $this->sqlQuery_model->sql_query($querys);
    $url_link = base_url('admin/dashboard');
    $limit_per_page = 10;
    $getVariable = $this->input->get('per_page');
    $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0) : 0;

    $total_records = ($pr_list_count != 0) ? count($pr_list_count) : 0;
    $config = createPagination($total_records, $url_link, $limit_per_page);
    $this->pagination->initialize($config);

    $sql_limit = 'LIMIT ' . $page * $limit_per_page . ',' . $limit_per_page;
    $querys = "SELECT * FROM tbl_order_manager WHERE date(order_add_date) = CURDATE() ORDER BY order_id DESC $sql_limit";
    $data['order_list'] = $this->sqlQuery_model->sql_query($querys);
    $data["links"] = $this->pagination->create_links();


    $querys_total_amount = "SELECT SUM(order_total_final_amt) as total_amount FROM tbl_order_manager WHERE ord_status=1 AND date(order_add_date) = CURDATE()";
    $data['order_amount'] = $this->sqlQuery_model->sql_query($querys_total_amount);
    // ================End Total Order===========================================






    $data['content'] = 'admin/containerPage/dashboard';
    $this->load->view('admin/template', $data);
  }

  public function logout()
  {

    $session = $this->session->userdata('admin');
    if (isset($session) && $session['is_login'] == 1) {
      $this->session->sess_destroy();
    }
    redirect(base_url('admin'));
  }


  // public function add_category(){
  //        $data['content']='admin/containerPage/add-category';
  // 	    $this->load->view('admin/template',$data);
  // }


  public function message()
  {
    $menuIdAsKey = 12;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $getCatId = $this->uri->segment(3);
    $data['ads_detaials'] = 0;
    if ($getCatId != "") {
      $data['ads_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_ads_message', array('ads_id' => $getCatId));
    }

    $data['ads_list'] = $this->sqlQuery_model->sql_select('tbl_ads_message', 'position');
    // $data['category_list']=$this->sqlQuery_model->sql_select('tbl_category','cat_id');
    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_ads_message', 'primary_key' => 'ads_id', 'update_target_column' => 'status');

    $data['deleteActionArr'] = array('table' => 'tbl_ads_message', 'primary_key' => 'ads_id');

    $data['content'] = 'admin/containerPage/message';
    $this->load->view('admin/template', $data);
  }


  public function order_status_manager()
  {
    $menuIdAsKey = 13;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $data['orderStatus_list'] = $this->sqlQuery_model->sql_select('tbl_order_status', 'position');
    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_order_status', 'primary_key' => 'status_id', 'update_target_column' => 'status');

    $data['content'] = 'admin/containerPage/order_status_manager';
    $this->load->view('admin/template', $data);
  }




  public function user_list()
  {
    $menuIdAsKey = 14;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $config = array();
    $config["base_url"] = base_url() . "admin/user_list";
    $config["total_rows"] = $this->user_model->get_user_count();
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
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['users_list'] = $this->user_model->get_users($config["per_page"], $page);

    //     echo "<pre>";
    //     print_r($data['user_list']);
    // echo "</pre>";
    //     die();
    $data['pagination'] = $this->pagination->create_links();

    // Fetch other necessary data
    $data['user_list'] = $this->sqlQuery_model->sql_select_where('tbl_admin', array('admin_type' => 'U'));

    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_admin', 'primary_key' => 'admin_id', 'update_target_column' => 'status');
    $data['deleteActionArr'] = array('table' => 'tbl_admin', 'primary_key' => 'admin_id');

    $data['content'] = 'admin/containerPage/user_list';
    $this->load->view('admin/template', $data);
  }







  //new code
  public function add_user()
  {

    if ($this->input->is_ajax_request()) {

      $email = $this->input->post('email');
      $existing_user = $this->sqlQuery_model->get_user_by_email($email);
      if ($existing_user) {
        $response = array('success' => false, 'errors' => 'This email already exists.');
        echo json_encode($response);
        return;
      }

      $upload_path = realpath(APPPATH . '../uploads');
      if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, TRUE);
      }

      $config['upload_path'] = $upload_path;
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = 2048;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('image')) {
        $error = $this->upload->display_errors();
        $response = array('success' => false, 'errors' => $error);
        echo json_encode($response);
        return;
      } else {
        // Get the uploaded file data
        $upload_data = $this->upload->data();
        $user_data = array(
          'admin_name' => $this->input->post('c_fname'),
          'admin_username' => $this->input->post('username'),
          'admin_mobile' => $this->input->post('mobile'),
          'admin_email' => $this->input->post('email'),
          'admin_designation' => $this->input->post('designation'),
          'admin_password' => md5($this->input->post('password')),
          'admin_image' => $upload_data['file_name']
        );

        // echo "<pre>"; print_r($user_data); die();"</pre>";

        $insert = $this->user_model->insert_user($user_data);
        if ($insert) {
          $response = array('success' => true, 'message' => 'User added successfully');
          echo json_encode($response);
        } else {
          $response = array('success' => false, 'message' => 'Failed to add user');
          echo json_encode($response);
        }
      }
    } else {
      $data['content'] = 'admin/containerPage/add_user';
      $this->load->view('admin/template', $data);
    }
  }



  public function update_user()
  {
    $user_id = $this->input->post('editv');
    $email = $this->input->post('email');
    $Old_email = $this->input->post('oldemail');

    if ($email != $Old_email) {

      $existing_user = $this->sqlQuery_model->get_user_by_email($email);
      if ($existing_user) {
        $response = array('success' => false, 'errors' => 'This email already exists.');
        echo json_encode($response);
        return;
      }
    }

    $user_data = array(
      'admin_name' => $this->input->post('c_fname'),
      'admin_username' => $this->input->post('username'),
      'admin_mobile' => $this->input->post('mobile'),
      'admin_email' => $this->input->post('email'),
      'admin_designation' => $this->input->post('designation'),
      'admin_password' => md5($this->input->post('password'))
    );
    $where = array('admin_id' => $user_id);

    $update = $this->sqlQuery_model->sql_update('tbl_admin', $user_data, $where);
    if ($update) {
      $response = array('success' => true, 'message' => 'User updated successfully');
    } else {
      $response = array('success' => false, 'message' => 'Failed to update user');
    }
    echo json_encode($response);
  }


  public function updateuserStatus()
  {
    $status = $this->input->post('status');
    $user_id = $this->input->post('user_id');
    $updateStatus = $this->sqlQuery_model->updateuserStatus($user_id, $status);
    if ($updateStatus) {
      echo json_encode('True');
    } else {
      $this->load->view('admin\containerPage\user_list', $data);
      echo json_encode('False');
    }
  }







  public function user_setting()
  {
    $menuIdAsKey = 14;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $data['getuserId'] = $this->uri->segment(3);
    $data['menus_list'] = $this->sqlQuery_model->sql_select_where_desc('tbl_sidebar_menus', 'position', array('sub_menu_id' => 0, 'status' => 1));
    $data['content'] = 'admin/containerPage/user_setting';
    $this->load->view('admin/template', $data);
  }


  public function category1()
  {
    $menuIdAsKey = 1;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $getCatId = $this->uri->segment(3);
    $data['category_detaials'] = 0;
    if ($getCatId != "") {
      $data['category_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_category', array('cat_id' => $getCatId));
    }

    $data['category_list'] = $this->sqlQuery_model->sql_select('tbl_category', 'position');

    // $data['category_list']=$this->sqlQuery_model->sql_select('tbl_category','cat_id');

    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_category', 'primary_key' => 'cat_id', 'update_target_column' => 'status');

    $data['in_stock_active_inactive'] = array('table' => 'tbl_category', 'primary_key' => 'cat_id', 'update_target_column' => 'in_stock_status');

    $data['deleteActionArr'] = array('table' => 'tbl_category', 'primary_key' => 'cat_id');
    $data['content'] = 'admin/containerPage/category-list';
    $this->load->view('admin/template', $data);
  }

  public function add_product()
  {

    $menuIdAsKey = 2;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $getproductId = $this->uri->segment(3);
    $data['product_list'] = 0;
    $data['product_disc_list'] = 0;
    if ($getproductId != "") {
      $data['product_list'] = $this->sqlQuery_model->sql_select_where('tbl_product', array('unique_number' => $getproductId));
      $data['product_disc_list'] = $this->sqlQuery_model->sql_select_where('tbl_product_description', array('desc_unique_number' => $getproductId));
    }
    // $sql_limit='LIMIT '.$page*$limit_per_page.','.$limit_per_page;
    // $querys="SELECT * FROM tbl_hsn_code ORDER BY hsn_code_id DESC $sql_limit";
    // $querys="SELECT * FROM tbl_hsn_code WHERE status=1 ORDER BY hsn_code_id DESC LIMIT 20";
    // $data['hsn_list']=$this->sqlQuery_model->sql_query($querys);
    $data['cat_and_sub_catlist'] = $this->my_libraries->getMenus();
    // $data['category_list']=$this->sqlQuery_model->sql_select_where('tbl_category',array('status'=>1));
    $data['units_list'] = $this->sqlQuery_model->sql_select_where('tbl_units', array('status' => 1));
    $data['period_list'] = $this->sqlQuery_model->sql_select_where('period_type', array('status' => 1));
    // $data['delivery_place_list']=$this->sqlQuery_model->sql_select_where('tbl_delivery_place',array('status'=>1));
    $data['werehouse_list'] = $this->sqlQuery_model->sql_select_where('tbl_werehouse', array('status' => 1));
    $data['food_habitats_list'] = $this->sqlQuery_model->sql_select_where('tbl_food_habitats', array('status' => 1));
    $data['deleteActionArr_variants'] = array('table' => 'tbl_product_variants', 'primary_key' => 'variant_id');
    $data['content'] = 'admin/containerPage/add-product';
    $this->load->view('admin/template', $data);
  }

  public function product_list()
  {
    $menuIdAsKey = 2;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_product', 'primary_key' => 'product_id', 'update_target_column' => 'status');
    $data['in_stock_active_inactive'] = array('table' => 'tbl_product', 'primary_key' => 'product_id', 'update_target_column' => 'in_stock_status');
    $data['ActiveInactive_ActionArr_varient'] = array('table' => 'tbl_product_variants', 'primary_key' => 'variant_id', 'update_target_column' => 'variants_status');

    $data['in_stock_active_inactive_variant'] = array('table' => 'tbl_product_variants', 'primary_key' => 'variant_id', 'update_target_column' => 'variants_in_stock_status');

    $stockKey = $this->input->get('st');
    $acttiveProductKey = $this->input->get('act');

    $catProductKey = $this->input->get('cat');
    $subCatProductKey = $this->input->get('subcat');


    // $stockStatus=(isset($stockKey) && $stockKey!='') ? 'WHERE in_stock_status='.$stockKey :'';
    // $actStatus=(isset($acttiveProductKey) && $acttiveProductKey!='') ? 'WHERE status='.$acttiveProductKey :'';
    $stockStatus = (isset($stockKey) && $stockKey != '') ? 'WHERE pro.in_stock_status=' . $stockKey : '';
    $actStatus = (isset($acttiveProductKey) && $acttiveProductKey != '') ? 'WHERE pro.status=' . $acttiveProductKey : '';
    // $proCat=(isset($catProductKey) && $catProductKey!='') ? "WHERE pro_ci_cat_name='".$catProductKey."'" :'';
    // $proSubCat=(isset($subCatProductKey) && $subCatProductKey!='') ? "WHERE pro_ci_sub_cat_name='".$subCatProductKey."'" :'';

    $proCat = (isset($catProductKey) && $catProductKey != '') ? "WHERE mapp.pro_ci_cat_name='" . $catProductKey . "'" : '';
    $proSubCat = (isset($subCatProductKey) && $subCatProductKey != '') ? "WHERE mapp.pro_ci_sub_cat_name='" . $subCatProductKey . "'" : '';

    // $querys="SELECT * FROM tbl_product $stockStatus $actStatus $proCat $proSubCat";
    $querys = "SELECT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number $stockStatus $actStatus $proCat $proSubCat GROUP BY mapp.unique_number";
    // $pr_list_count=$this->sqlQuery_model->sql_query('tbl_product','product_id');
    $pr_list_count = $this->sqlQuery_model->sql_query($querys);

    $data['product_count'] = ($pr_list_count != 0) ? count($pr_list_count) : 0;
    $url_link = base_url('admin/product_list');
    $limit_per_page = 10;
    $getVariable = $this->input->get('per_page');
    $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0) : 0;

    $total_records = ($pr_list_count != 0) ? count($pr_list_count) : 0;
    $config = createPagination($total_records, $url_link, $limit_per_page);
    $this->pagination->initialize($config);

    $sql_limit = 'LIMIT ' . $page * $limit_per_page . ',' . $limit_per_page;
    // $querys="SELECT * FROM tbl_product $stockStatus $actStatus $proCat $proSubCat $sql_limit";
    // $querys="SELECT *,mapp.cat_id,mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number $stockStatus $actStatus $proCat $proSubCat GROUP BY mapp.unique_number $sql_limit";


    $querys = "SELECT * FROM tbl_product WHERE 1 $sql_limit";


    //$data['product_list']=$this->sqlQuery_model->sql_query($querys);

    exit();


    $data["links"] = $this->pagination->create_links();

    $data['countCategory'] = $this->sqlQuery_model->sql_select_where('tbl_category', array('status' => 1));
    $data['countSubCategory'] = $this->sqlQuery_model->sql_select_where('tbl_sub_category', array('status' => 1));
    $data['product_list_in_stock'] = $this->sqlQuery_model->sql_select_where('tbl_product', array('in_stock_status' => 1));
    $data['product_list_out_of_stock'] = $this->sqlQuery_model->sql_select_where('tbl_product', array('in_stock_status' => 0));

    $data['product_list_active'] = $this->sqlQuery_model->sql_select_where('tbl_product', array('status' => 1));
    $data['product_list_in_active'] = $this->sqlQuery_model->sql_select_where('tbl_product', array('status' => 0));
    $data['dropdownProduct_list'] = $this->sqlQuery_model->sql_select_where('tbl_product', array('status' => 1));
    $data['deleteActionArr_variants'] = array('table' => 'tbl_product_variants', 'primary_key' => 'variant_id');
    $data['units_list'] = $this->sqlQuery_model->sql_select_where('tbl_units', array('status' => 1));
    $data['content'] = 'admin/containerPage/product-list';
    $this->load->view('admin/template', $data);
  }


  public function exportCSV()
  {
    while (ob_get_level()) {
      ob_end_clean();
    }
    // file name
    $filename = 'product_' . date('Y-m-d_h-i') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    // get data
    // $usersData = $this->Main_model->getUserDetails();
    $product_list = $this->sqlQuery_model->sql_select('tbl_product', 'product_id');
    // $product_list=$this->sqlQuery_model->sql_select_where('tbl_product',array('status'=>0));
    $dd = array();
    $d = array();

    if ($product_list != 0) {

      foreach ($product_list as $value) {
        $getVarients = $this->sqlQuery_model->sql_select_where('tbl_product_variants', array('variants_unique_number' => trim($value->unique_number)));

        $getDescription = $this->sqlQuery_model->sql_select_where('tbl_product_description', array('desc_unique_number' => trim($value->unique_number)));
        // $value->variants=$getVarients;

        $dd['pro'] = $value;
        $dd['variants'] = $getVarients;
        $dd['description'] = $getDescription;

        $d[] = $dd;
      }
    }


    $file = fopen('php://output', 'w');
    $headerTop = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "categoryID1::SubCategoryID1___ categoryID2::SubCategoryID2", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
    fputcsv($file, $headerTop);



    $header = array(

      "Item Code",
      "Werehouse Code",
      "Product Name",
      "Product Status",
      "Product In Stock Status",

      "Variants for item code",
      "SKU ID",
      "Pack Size",
      "Units",
      "Price",
      "Before Off Price",
      "Variants Stock",
      "Variants Status",
      "Variants In Stock Status",

      "Category Id",
      "category",
      "Sub Category Id",
      "Sub Category name",
      "Child Category Id",
      "Child Category name",

      "HSN Code",
      "IGST",
      "CGST",
      "SGST",

      // "Ingredients",
      // "Shelf life Period",
      // "Shelf life Period Type",
      // "Storage Condition",

      // "International Delivery",
      // "National Delivery",
      // "Excluding Local & Hyperlocal (Within Maharashtra)",
      // "Hyperlocal Delivery",
      // "Local Delivery",
      // "Pick-up from store",

      // "Food Habitats",
      // "Quick Description",
      // "Tags",
      "Image1",
      "Image2",
      "Image3",
      "Image4",
      "Image5",
      "Image6",

      "Description for Item code",
      "Description header name",
      "Description Details",
      "Description Status",
      "Discription Id",

      "Variants Updated By",
      "Variants Id",

      "Product Updated by",
      "Product Id",

      "Add date"
    );


    fputcsv($file, $header);
    $l = array();



    foreach ($d as $key => $line) {

      // echo "<pre>";
      // print_r($line);
      // echo "<pre>";


      $l['unique_number'] = 'A' . str_pad($line['pro']->unique_number, 4, '0', STR_PAD_LEFT);
      $l['werehouse'] = $this->my_libraries->getWerehouseCode($line['pro']->unique_number);
      $l['product_name'] = $line['pro']->product_name;
      $l['status'] = $line['pro']->status;
      $l['in_stock_status'] = $line['pro']->in_stock_status;

      $l['variants_unique_number'] = ($line['variants'] != 0) ? 'A' . str_pad($line['pro']->unique_number, 4, '0', STR_PAD_LEFT) : '';

      $l['sku_id'] = ($line['variants'] != 0) ? $line['variants'][0]->sku_id : '';
      $l['pack_size'] = ($line['variants'] != 0) ? $line['variants'][0]->pack_size : '';

      $l['units'] = ($line['variants'] != 0) ? $line['variants'][0]->units : '';
      $l['price'] = ($line['variants'] != 0) ? $line['variants'][0]->price : '';
      $l['before_off_price'] = ($line['variants'] != 0) ? $line['variants'][0]->before_off_price : '';
      $l['stock'] = ($line['variants'] != 0) ? $line['variants'][0]->stock : '';
      // $l['conversion_factor'] = ($line['variants']!=0)? $line['variants'][0]->conversion_factor:'';
      $l['variants_status'] = ($line['variants'] != 0) ? $line['variants'][0]->variants_status : '';
      $l['variants_in_stock_status'] = ($line['variants'] != 0) ? $line['variants'][0]->variants_in_stock_status : '';

      $getMappingCate = $this->my_libraries->getCategoryIDForExport($line['pro']->unique_number);
      $getMappingSubCate = $this->my_libraries->getSubCategoryIDForExport($line['pro']->unique_number);
      $getMappingSubChildCate = $this->my_libraries->getSubChildCategoryIDForExport($line['pro']->unique_number);


      $l['cat_id'] = $getMappingCate[0];
      $l['category'] = $getMappingCate[1];
      $l['sub_cat_id'] = $getMappingSubCate[0];
      $l['sub_category'] = $getMappingSubCate[1];
      $l['child_cat_id'] = $getMappingSubChildCate[0];
      $l['childCat_name'] = $getMappingSubChildCate[1];





      $l['hsn_code'] = $line['pro']->hsn_code;
      $l['igst'] = $line['pro']->igst;
      $l['cgst'] = $line['pro']->cgst;
      $l['sgst'] = $line['pro']->sgst;

      // $l['ingredients'] = $line['pro']->ingredients;
      // $l['shelf_life_period'] = $line['pro']->shelf_life_period;
      // $l['shelf_life_period_type'] = $line['pro']->shelf_life_period_type;
      // $l['storage_condition'] = $line['pro']->storage_condition;

      // $l['international_delivery'] = $line['pro']->international_delivery;
      // $l['national_delivery'] = $line['pro']->national_delivery;
      // $l['excluding_local_hyperlocal'] = $line['pro']->excluding_local_hyperlocal;
      // $l['hyperlocal_delivery'] = $line['pro']->hyperlocal_delivery;
      // $l['local_delivery'] = $line['pro']->local_delivery;
      // $l['pick_up_store'] = $line['pro']->pick_up_store;

      // $l['food_habitats'] = $line['pro']->food_habitats;
      // $l['quick_description'] = $line['pro']->quick_description;
      // $l['tags'] = $line['pro']->tags;
      $l['image1'] = $line['pro']->image1;
      $l['image2'] = $line['pro']->image2;
      $l['image3'] = $line['pro']->image3;
      $l['image4'] = $line['pro']->image4;
      $l['image5'] = $line['pro']->image5;
      $l['image6'] = $line['pro']->image6;

      $arr_header = array();
      $arr_description = array();
      $arr_status = array();
      $arr_desc_id = array();


      if ($line['description'] != 0) {

        $l['desc_unique_number'] = 'A' . str_pad($line['pro']->unique_number, 4, '0', STR_PAD_LEFT);
        foreach ($line['description'] as $dvalue) {

          if ($dvalue->desc_unique_number == $line['pro']->unique_number) {
            array_push($arr_header, '[' . $dvalue->desc_header . ']');
            array_push($arr_description, '[' . $dvalue->description . ']');
            array_push($arr_status, '[' . $dvalue->status . ']');
            array_push($arr_desc_id, '[' . $dvalue->desc_id . ']');
          }
        }

        $l['desc_header'] = implode(',', $arr_header);
        $l['description'] = implode(',', $arr_description);
        $l['desc_status'] =  implode(',', $arr_status);
        $l['desc_id'] =  implode(',', $arr_desc_id);
      } else {
        $l['desc_unique_number'] = '';
        $l['desc_header'] = '';
        $l['description'] = '';
        $l['desc_status'] =  '';
        $l['desc_id'] =  '';
      }


      $l['variants_updated_by'] = ($line['variants'] != 0) ? $line['variants'][0]->updated_by : '';
      $l['variant_id'] = ($line['variants'] != 0) ? $line['variants'][0]->variant_id : '';

      $l['updated_by'] = $line['pro']->updated_by;
      $l['product_id'] = $line['pro']->product_id;

      $l['add_date'] = $line['pro']->add_date;



      fputcsv($file, $l);

      if ($line['variants'] != 0) {

        foreach (array_slice($line['variants'], 1) as $key => $value) {

          $l['unique_number'] = '';
          $l['werehouse'] = '';
          $l['product_name'] = '';
          $l['status'] = '';
          $l['in_stock_status'] = '';

          $l['variants_unique_number'] = 'A' . str_pad($value->variants_unique_number, 4, '0', STR_PAD_LEFT);
          // $l['variants_product_id'] = $line['variants'][0]->variants_product_id;
          $l['sku_id'] = $value->sku_id;
          $l['pack_size'] = $value->pack_size;
          // $l['units_id'] = $value->units_id;
          $l['units'] = $value->units;
          $l['price'] = $value->price;
          $l['before_off_price'] = $value->before_off_price;
          $l['stock'] = $value->stock;
          // $l['conversion_factor'] = $value->conversion_factor;
          $l['variants_status'] = $value->variants_status;
          $l['variants_in_stock_status'] = $value->variants_in_stock_status;

          $l['cat_id'] = '';
          $l['category'] = '';
          $l['sub_cat_id'] = '';
          $l['sub_category'] = '';
          $l['child_cat_id'] = '';
          $l['childCat_name'] = '';

          $l['hsn_code'] = '';
          $l['cgst'] = '';
          $l['igst'] = '';
          $l['sgst'] = '';

          // $l['ingredients'] = '';
          // $l['shelf_life_period'] = '';
          // $l['shelf_life_period_type'] = '';
          // $l['storage_condition'] = '';

          // $l['international_delivery'] = '';
          // $l['national_delivery'] = '';
          // $l['excluding_local_hyperlocal'] = '';
          // $l['hyperlocal_delivery'] = '';
          // $l['local_delivery'] = '';
          // $l['pick_up_store'] = '';

          // $l['food_habitats'] = '';
          // $l['quick_description'] = '';
          // $l['tags'] = '';
          $l['image1'] = '';
          $l['image2'] = '';
          $l['image3'] = '';
          $l['image4'] = '';
          $l['image5'] = '';
          $l['image6'] = '';

          $l['desc_unique_number'] = '';
          $l['desc_header'] = '';
          $l['description'] = '';
          $l['desc_status'] =  '';
          $l['desc_id'] = '';

          $l['variants_updated_by'] = $value->updated_by;
          $l['variant_id'] = $value->variant_id;

          $l['updated_by'] = '';
          $l['product_id'] = '';


          $l['add_date'] = '';

          // $l['product_gen_id'] = '';

          fputcsv($file, $l);
        }
      }
    }


    // exit;

    fclose($file);
    exit;
  }




  public function importSVC()
  {
    $session = $this->session->userdata('admin');
    // echo 'hiiii';
    // exit;
    // if($this->input->post('submit') != NULL ){ 

    $data = array();
    if (!empty($_FILES['fileupload']['name'])) {
      // Set preference 
      $config['upload_path'] = 'uploads/csvProduct/';
      $config['allowed_types'] = 'csv';
      $config['max_size'] = '200000'; // max_size in kb 
      $config['file_name'] = $_FILES['fileupload']['name'];
      // Load upload library 
      $this->load->library('upload', $config);
      // File upload
      if ($this->upload->do_upload('fileupload')) {
        // Get data about the file
        $uploadData = $this->upload->data();
        $filename = $uploadData['file_name'];
        // Reading file
        $file = fopen("uploads/csvProduct/" . $filename, "r");
        $i = 0;
        $numberOfFields = 40; // Total number of fields
        $importData_arr = array();

        $tableHeader = array(
          'unique_number',
          'werehouse',
          'product_name',
          'status',
          'in_stock_status',

          'variants_unique_number',
          'sku_id',
          'pack_size',
          'units',
          'price',
          'before_off_price',
          'stock',
          // 'conversion_factor',
          'variants_status',
          'variants_in_stock_status',

          'cat_id',
          'category',
          'sub_cat_id',
          'sub_category',
          'child_cat_id',
          'childCat_name',

          'hsn_code',
          'igst',
          'cgst',
          'sgst',

          // 'ingredients',
          // 'shelf_life_period',
          // 'shelf_life_period_type',
          // 'storage_condition',

          // 'international_delivery',
          // 'national_delivery',
          // 'excluding_local_hyperlocal',
          // 'hyperlocal_delivery',
          // 'local_delivery',
          // 'pick_up_store',

          // 'food_habitats',
          // 'quick_description',
          // 'tags',
          'image1',
          'image2',
          'image3',
          'image4',
          'image5',
          'image6',

          'desc_unique_number',
          'desc_header',
          'description',
          'desc_status',
          'desc_id',

          'variants_updated_by',
          'variant_id',

          'updated_by',
          'product_id',

          'add_date',

          'product_gen_id'


        );





        while (($filedata = fgetcsv($file, 2000, ",")) !== FALSE) {


          // echo $num;
          $num = count($filedata);

          if ($numberOfFields == $num) {
            for ($c = 0; $c < $num; $c++) {
              $importData_arr[$i][$tableHeader[$c]] = $filedata[$c];
              $rowArr[$i][$c] = $filedata[$c];
            }
          }
          $i++;
        }



        $rowDataArr = array_slice($rowArr, 2);
        $arrayFiler = array_filter($rowDataArr);

        $arrCategory = array();
        $arrSubCategory = array();

        $arrayProductUniqueNumber = array();
        $arrWerehouse = array();
        $collectSKU_id_duplicate_validation = array();
        $arrayPacksize = array();
        $arrayUnits = array();
        $arrayPrice = array();
        $arrayBefore_off_price = array();

        $arrayStock = array();
        // $arrayConversionType=array();

        $arrayVariantStatus = array();
        $arrayVariantsInStockStatus = array();

        $arrayHSN = array();
        $arrIgst = array();
        $arrCgst = array();
        $arrSgst = array();

        // $selfLife=array();
        // $arrperiodType=array();

        // $arrInternationalDelivery=array();
        // $arrNationalDelivery=array();
        // $arrExcludingLocalHyperlocal=array();
        // $arrHyperlocalDelivery=array();
        // $arrLocalDelivery=array();
        // $arrPickupfromstore=array();

        // $arrFoodHabitat=array();

        $arrImage1 = array();
        $arrImage2 = array();
        $arrImage3 = array();
        $arrImage4 = array();
        $arrImage5 = array();
        $arrImage6 = array();

        $arrDescriHeader = array();
        $arrDescription = array();
        $arrDescStatus = array();

        $arrayVariantId = array();

        $validaArr = array();


        foreach ($arrayFiler as $keys => $f) {


          array_push($arrayProductUniqueNumber, $f[0]);
          array_push($arrWerehouse, $f[1]);

          array_push($collectSKU_id_duplicate_validation, $f[6]);
          array_push($arrayPacksize, $f[7]);
          array_push($arrayUnits, $f[8]);
          array_push($arrayPrice, $f[9]);
          array_push($arrayBefore_off_price, $f[10]);

          array_push($arrayStock, $f[11]);
          // array_push($arrayConversionType,$f[10]);
          array_push($arrayVariantStatus, $f[12]);
          array_push($arrayVariantsInStockStatus, $f[13]);

          array_push($arrayHSN, $f[20]);
          array_push($arrIgst, $f[21]);
          array_push($arrCgst, $f[22]);
          array_push($arrSgst, $f[23]);

          // array_push($selfLife,$f[22]);
          // array_push($arrperiodType,$f[23]);

          // array_push($arrInternationalDelivery,$f[25]);
          // array_push($arrNationalDelivery,$f[26]);
          // array_push($arrExcludingLocalHyperlocal,$f[27]);
          // array_push($arrHyperlocalDelivery,$f[28]);
          // array_push($arrLocalDelivery,$f[29]);
          // array_push($arrPickupfromstore,$f[30]);

          // array_push($arrFoodHabitat,$f[31]);

          array_push($arrImage1, $f[24]);
          array_push($arrImage2, $f[25]);
          array_push($arrImage3, $f[26]);
          array_push($arrImage4, $f[27]);
          array_push($arrImage5, $f[28]);
          array_push($arrImage6, $f[29]);

          array_push($arrDescriHeader, $f[31]);
          array_push($arrDescription, $f[32]);
          array_push($arrDescStatus, $f[33]);

          array_push($arrayVariantId, $f[36]);
          array_push($validaArr, array_filter($f));



          if (($f[0] != "") || ($f[14] != "" && $f[15] != "")) {


            $explodeCategory = explode('::', $f[14]);
            $expCatName = explode('::', $f[15]);



            if (isset($f[14]) && $f[14] != "") {

              foreach ($explodeCategory as $key => $value) {

                $replaceCate = $this->my_libraries->replaceAll($expCatName[$key]);
                $sqlQuery = "SELECT * FROM tbl_category WHERE cat_id=$value";
                $checkExitCategory = $this->sqlQuery_model->sql_query($sqlQuery);

                if ($checkExitCategory == 0) {
                  array_push($arrCategory, array('itemCode' => $f[0], 'status' => 0, 'SheetCategory' => $expCatName[$key]));
                } else {
                  array_push($arrCategory, array('itemCode' => $f[0], 'status' => 1, 'SheetCategory' => $expCatName[$key]));
                }
              }
            } else {
              $data['response'] = 'Your category fields are empty. Line no ( Item code. ' . $f[0] . ')';
              $data['status'] = 0;
              echo json_encode($data);
              exit;
            }
          }





          if (($f[0] != "") || ($f[16] != "" && $f[17] != "")) {




            $expSubCategory = explode('___', $f[16]);
            $expSubCatName = explode('___', $f[17]);

            if (isset($f[16]) && $f[16] != "") {

              foreach ($expSubCategory as $sKey => $subvalue) {


                $expSub_ = explode('::', $subvalue);
                $expSubCatValue = end($expSub_);


                $expSubCat_ = explode('::', $expSubCatName[$sKey]);
                $expSubCatValueName = end($expSubCat_);



                $replaceSubCate = $this->my_libraries->replaceAll($expSubCatValueName);
                $checkExitSubCategory = $this->sqlQuery_model->sql_query("SELECT * FROM tbl_sub_category WHERE sub_cat_id=$expSubCatValue");

                if ($checkExitSubCategory == 0) {
                  array_push($arrSubCategory, array('itemCode' => $f[0], 'status' => 0, 'SheetSubCategory' => $expSubCatValueName));
                } else {
                  array_push($arrSubCategory, array('itemCode' => $f[0], 'status' => 1, 'SheetSubCategory' => $expSubCatValueName));
                }
              } //foreach end

            } else {
              $data['response'] = 'Your sub category fields are empty. Line no ( Item code. ' . $f[0] . ')';
              $data['status'] = 0;
              echo json_encode($data);
              exit;
            }
          }
        } //foreach loop end


        foreach ($arrCategory as $getCatVal) {
          if ($getCatVal['status'] == 0) {
            $data['response'] = 'Your category name And category Id invalid ( Item code. ' . $getCatVal['itemCode'] . ')';
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }


        foreach ($arrSubCategory as $getSubCatVal) {
          if ($getSubCatVal['status'] == 0) {
            $data['response'] = 'Your Subcategory name And Subcategory Id invalid ( Item code. ' . $getSubCatVal['itemCode'] . ')';
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }



        if ($arrWerehouse != array()) {

          $werehouse_list = $this->sqlQuery_model->sql_select('tbl_werehouse', 'werehouse_id');
          $wh_code = array_column($werehouse_list, 'werehouse_code');
          $whcode = array();
          if ($werehouse_list != 0) {
            foreach ($wh_code as $key => $coluKey) {
              $whcode[] = end(explode('_', $coluKey));
            }
          }


          foreach ($arrWerehouse as $key => $wvalue) {
            if ($wvalue != "") {
              $whcode_field3 = explode(',', $wvalue);
              $diffValue =  array_diff(array_map('trim', $whcode_field3), $whcode);
              if ($diffValue != array()) {
                $data['status'] = 0;
                $data['response'] = 'Invalid werehouse code. line number : ' . ($key + 3);
                echo json_encode($data);
                exit;
              }
            }
          }
        }



        if (array_filter($validaArr) == array()) {
          $data['response'] = 'Oops! Something went wrong.';
          $data['status'] = 0;
          echo json_encode($data);
          exit;
        }


        // ==============================================================================
        $collect_uniqValue = array();
        foreach (array_filter($arrayProductUniqueNumber) as $key => $uniqValue) {

          $unique_no = preg_replace("/[^0-9]/", "", $uniqValue);
          $uniqeValues = str_pad($unique_no, 4, '0', STR_PAD_LEFT);
          array_push($collect_uniqValue, $uniqeValues);
        }

        $uniquShowArr = array_unique($collect_uniqValue);
        $valueWithDouplicate = $collect_uniqValue;




        $duplicatesItemCode = $this->my_libraries->duplicationFind($valueWithDouplicate, $uniquShowArr);
        if ($duplicatesItemCode != array()) {
          $dhtmlVal = '<h4><b>Duplicate Item code not allowed.</b></h4><br><ul style="text-align: initial;margin-left: auto;margin-right: auto;display: inline-block;">';
          foreach ($duplicatesItemCode as $keyno1 => $duitemsValue) {
            $dhtmlVal .= '<li>Items Code: ' . $duitemsValue . '</li>';
          }
          $dhtmlVal .= '</ul>';

          $data['response'] = $dhtmlVal;
          $data['status'] = 0;
          echo json_encode($data);
          exit;
        }



        // ===========================================================
        $arraySku_id_uniq_arr = array_unique($collectSKU_id_duplicate_validation);
        $arraySku_id_arr = $collectSKU_id_duplicate_validation;

        $duplicates = $this->my_libraries->duplicationFind($arraySku_id_arr, $arraySku_id_uniq_arr);
        if ($duplicates != array()) {
          $htmlVal = '<h4><b>Duplicate SKU ID Not allowed.</b></h4><br><ul style="text-align: initial;margin-left: auto;margin-right: auto;display: inline-block;">';
          foreach ($duplicates as $keyno => $duValue) {
            $htmlVal .= '<li>Line No : ' . ($keyno + 3) . ' SKY ID: ' . $duValue . '</li>';
          }
          $htmlVal .= '</ul>';

          $data['response'] = $htmlVal;
          $data['status'] = 0;
          echo json_encode($data);
          exit;
        }



        // ===============================================

        foreach ($arrayPacksize as $keysz => $v) {

          if (!is_numeric($v)) {
            $data['response'] = 'Invalid packsize.Pls check line Number : ' . ($keysz + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }



        // ================================================================================
        $getUnits = $this->sqlQuery_model->sql_select('tbl_units', 'units_id');
        $arrUnits = array();
        if ($getUnits != 0) {
          foreach ($getUnits as $uniValue) {
            $arrUnits[] = $uniValue->units_name;
          }
        }



        $arrUnissVal = array();
        foreach ($arrayUnits as $kyeUni => $vUnits) {

          if (!in_array($vUnits, $arrUnits)) {

            $data['response'] = 'Invalid units name. Not match with master table.Pls check line Number : ' . ($kyeUni + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }




        // =========================================================================

        $arrPriceVal = array();
        foreach ($arrayPrice as $kyePri => $vp) {

          if (!is_numeric($vp)) {
            $data['response'] = 'Invalid price. Pls check line Number : ' . ($kyePri + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }



        // ==========================================================================

        $arrStockVal = array();
        foreach ($arrayStock as $kyeSto => $vs) {


          if (!is_numeric($vs)) {
            $data['response'] = 'Invalid stock. Pls check line Number : ' . ($kyeSto + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }



        // ================================================================


        // foreach($arrayConversionType as $keyCon=>$vc){
        //  if(!is_numeric($vc)){
        //      $data['response'] = 'Invalid conversion factor. Pls check line Number : '.($keyCon+3); 
        //      $data['status'] = 0;
        //      echo json_encode($data);
        //      exit;
        //    }
        // }



        // ===================================================================

        foreach ($arrayVariantsInStockStatus as $keyss => $stockval) {

          if (!is_numeric($stockval) && ($stockval != '0' || $stockval != '1')) {
            $data['response'] = 'Invalid variant Instock status value. Pls check line Number : ' . ($keyss + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }


        //==================================================================================

        // $arrayVarStatus=array();
        foreach ($arrayVariantStatus as $kyest => $Vstatusval) {


          if (!is_numeric($Vstatusval) && ($Vstatusval != '0' || $Vstatusval != '1')) {
            $data['response'] = 'Invalid variant status value. Pls check line Number : ' . ($kyest + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }




        //========================================================================


        foreach ($arrayVariantId as $keyvids => $vid) {

          if (!is_numeric($vid) && $vid != "") {
            $data['response'] = 'Invalid variants ID. Pls check line Number : ' . ($keyvids + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }


        // =====================================================================================
        // $arrHSNVal=array();
        foreach (array_filter($arrayHSN) as $ku => $vhsn) {

          if (!is_numeric($vhsn)) {
            $data['response'] = 'Invalid HSN Code. Pls check line Number : ' . ($ku + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }



        //==============================================================================




        foreach (array_filter($arrIgst) as $kugst => $vIgst) {


          if (!is_numeric($vIgst)) {
            $data['response'] = 'Invalid IGST Number. Pls check line Number : ' . ($kugst + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }



        // ======================================================
        // $arrCGSTVal=array();
        foreach (array_filter($arrCgst) as $kyCGs => $vCgst) {


          if (!is_numeric($vCgst)) {
            $data['response'] = 'Invalid CGST Number. Pls check line Number : ' . ($kyCGs + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }


        // ==================================================

        foreach (array_filter($arrSgst) as $kysg => $vSgst) {


          if (!is_numeric($vSgst)) {
            $data['response'] = 'Invalid SGST Number. Pls check line Number : ' . ($kysg + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }


        // =========================================================


        // foreach(array_filter($selfLife) as $kyf=>$vSelfLife){
        //      if(!is_numeric($vSelfLife)){
        //        $data['response'] = 'Invalid Self Life Number. Pls check line Number : '.($kyf+3); 
        //        $data['status'] = 0;
        //        echo json_encode($data);
        //        exit;
        //     }
        // }




        // =================================================================

        // $getPtype=$this->sqlQuery_model->sql_select('period_type','ptype_id');
        //  $arrPeriod=array();
        //  if($getPtype!=0){
        //     foreach($getPtype as $pValue){
        //       $arrPeriod[]=$pValue->period_type;
        //     }
        //  }



        // foreach(array_filter($arrperiodType) as $kys=>$vType){
        //      if(!in_array($vType,$arrPeriod) && !in_array(ucfirst($vType),$arrPeriod)){
        //         $data['response'] = 'Invalid Shelf life Period Type.Not match with master table. Pls check line Number : '.($kys+3);
        //         $data['status'] = 0;
        //         echo json_encode($data);
        //         exit;
        //     }
        // }



        // ==============================================================

        // $getFoodHabitats=$this->sqlQuery_model->sql_select('tbl_food_habitats','fh_id');
        //  $arrFoodH=array();
        //  if($getFoodHabitats!=0){
        //     foreach($getFoodHabitats as $fValue){
        //       $arrFoodH[]=$fValue->fh_unique_name;
        //     }
        //  }

        // foreach (array_filter($arrFoodHabitat) as $key => $fvalue) {
        //         $explodeValue=explode(',', $fvalue);
        //         foreach($explodeValue as $exValue){

        //            if(!in_array($exValue,$arrFoodH)){
        //                $data['response'] = 'Same Food Habitats keywords not match with master table. Pls check line Number : '.($key+3); 

        //                $data['status'] = 0;
        //                echo json_encode($data);
        //                exit;
        //            }
        //      }
        // }


        // =========================================================


        // foreach(array_filter($arrInternationalDelivery) as $kuint=>$InterDelval){

        //       if(!is_numeric($InterDelval) && ($InterDelval!='0' || $InterDelval!='1')){
        //         $data['response'] = 'International Delivery not allowed unwanted characters. Pls check line Number : '.($kuint+3); 
        //         $data['status'] = 0;
        //         echo json_encode($data);
        //         exit;
        //       }
        // }


        // ===========================================================================



        // foreach(array_filter($arrNationalDelivery) as $natKey=>$natioDelival){
        //     if(!is_numeric($natioDelival) && ($natioDelival!='0' || $natioDelival!='1')){
        //       $data['response'] = 'National Delivery not allowed unwanted characters. Pls check line Number : '.($natKey+3); 
        //       $data['status'] = 0;
        //       echo json_encode($data);
        //       exit;
        //     }
        // }


        // =======================================================================

        // foreach(array_filter($arrExcludingLocalHyperlocal) as $eKey=>$Excval){
        //      if(!is_numeric($Excval) && ($Excval!='0' || $Excval!='1')){
        //       $data['response'] = 'Excluding Local & Hyperlocal (Within Maharashtra) not allowed unwanted characters. Pls check line Number : '.($eKey+3); 
        //       $data['status'] = 0;
        //       echo json_encode($data);
        //       exit;
        //     }
        // }




        // =========================================================================


        // foreach(array_filter($arrHyperlocalDelivery) as $hykey=>$Hypcval){
        //      if(!is_numeric($Hypcval) && ($Hypcval!='0' || $Hypcval!='1')){
        //       $data['response'] = 'Hyperlocal Delivery not allowed unwanted characters. Pls check line Number : '.($hykey+3); 
        //       $data['status'] = 0;
        //       echo json_encode($data);
        //       exit;
        //     }
        //  }



        // ======================================================================




        // foreach(array_filter($arrLocalDelivery) as $locKey=>$Locacval){
        //      if(!is_numeric($Locacval) && ($Locacval!='0' || $Locacval!='1')){
        //       $data['response'] = 'Local Delivery not allowed unwanted characters. Pls check line Number : '.($locKey+3); 
        //       $data['status'] = 0;
        //       echo json_encode($data);
        //       exit;
        //     }
        //  }



        // ====================================================================

        // foreach(array_filter($arrPickupfromstore) as $picKey=>$Piccval){
        //      if(!is_numeric($Piccval) && ($Piccval!='0' || $Piccval!='1')){
        //         $data['response'] = 'Pick-up from store not allowed unwanted characters. Pls check line Number : '.($picKey+3); 
        //         $data['status'] = 0;
        //         echo json_encode($data);
        //         exit;
        //     }
        //  }




        $arrIma = array();
        foreach ($arrayProductUniqueNumber as $keys => $vProductId) {
          if ($vProductId != "") {
            $arrIma[] = array(
              'productUniqueId' => $vProductId,
              'image1' => $arrImage1[$keys],
              'image2' => $arrImage2[$keys],
              'image3' => $arrImage3[$keys],
              'image4' => $arrImage4[$keys],
              'image5' => $arrImage5[$keys],
              'image6' => $arrImage6[$keys],
            );
          }
        }

        foreach ($arrIma as $images1_val) {
          if ($images1_val['productUniqueId'] != "") {


            $extension = array('jpg', 'jpeg', 'png');
            $spliImage1 = explode('.', $images1_val['image1']);
            $spliImage2 = explode('.', $images1_val['image2']);
            $spliImage3 = explode('.', $images1_val['image3']);
            $spliImage4 = explode('.', $images1_val['image4']);
            $spliImage5 = explode('.', $images1_val['image5']);
            $spliImage6 = explode('.', $images1_val['image6']);

            $extensionValue1 = strtolower(end($spliImage1));
            $extensionValue2 = strtolower(end($spliImage2));
            $extensionValue3 = strtolower(end($spliImage3));
            $extensionValue4 = strtolower(end($spliImage4));
            $extensionValue5 = strtolower(end($spliImage5));
            $extensionValue6 = strtolower(end($spliImage6));




            if ($images1_val['image1'] != "") {
              if (!in_array($extensionValue1, $extension)) {
                $data['response'] = 'Only allowed jpg, jpeg and png image-1 formate. Item code : ' . $images1_val['productUniqueId'];
                $data['status'] = 0;
                echo json_encode($data);
                exit;
              }
            }

            if ($images1_val['image2'] != "") {
              if (!in_array($extensionValue2, $extension)) {
                $data['response'] = 'Only allowed jpg, jpeg and png image-2 formate. Item code : ' . $images1_val['productUniqueId'];
                $data['status'] = 0;
                echo json_encode($data);
                exit;
              }
            }

            if ($images1_val['image3'] != "") {
              if (!in_array($extensionValue3, $extension)) {
                $data['response'] = 'Only allowed jpg, jpeg and png image-3 formate. Item code : ' . $images1_val['productUniqueId'];
                $data['status'] = 0;
                echo json_encode($data);
                exit;
              }
            }

            if ($images1_val['image4'] != "") {
              if (!in_array($extensionValue4, $extension)) {
                $data['response'] = 'Only allowed jpg, jpeg and png image-4 formate. Item code : ' . $images1_val['productUniqueId'];
                $data['status'] = 0;
                echo json_encode($data);
                exit;
              }
            }

            if ($images1_val['image5'] != "") {
              if (!in_array($extensionValue5, $extension)) {
                $data['response'] = 'Only allowed jpg, jpeg and png image-5 formate. Item code : ' . $images1_val['productUniqueId'];
                $data['status'] = 0;
                echo json_encode($data);
                exit;
              }
            }

            if ($images1_val['image6'] != "") {
              if (!in_array($extensionValue6, $extension)) {
                $data['response'] = 'Only allowed jpg, jpeg and png image-6 formate. Item code : ' . $images1_val['productUniqueId'];
                $data['status'] = 0;
                echo json_encode($data);
                exit;
              }
            }
          }
        }


        // ====================================================================

        foreach (array_filter($arrDescriHeader) as $headerValue) {
          $explode_disc = explode(',', $headerValue);
          foreach ($explode_disc as $exValue) {

            $firstBracket = substr($exValue, 0, 1);
            $lastBracket = substr($exValue, strlen($exValue) - 1);

            if ($firstBracket != '[' || $lastBracket != ']') {
              $data['response'] = 'Some brackets are missing in [Description header]. Pls check it.';
              $data['status'] = 0;
              echo json_encode($data);
              exit;
            }
          }
        }





        // ======================================================
        $arraydcStatus_ = array();
        $arrayDEsStatus = array();
        foreach (array_filter($arrDescStatus) as $statusValue) {
          $explode_discStatus = explode(',', $statusValue);
          foreach ($explode_discStatus as $exValue) {

            $firstBracket_status = substr($exValue, 0, 1);
            $lastBracket_status = substr($exValue, strlen($exValue) - 1);

            $strRepFirst = substr($exValue, 1);
            $strRepLast = substr($strRepFirst, 0, -1);

            array_push($arrayDEsStatus, $strRepLast);

            if ($firstBracket_status != '[' || $lastBracket_status != ']') {
              $data['response'] = 'Some brackets are missing in [Description Status]. Pls check it.';
              $data['status'] = 0;
              echo json_encode($data);
              exit;
            }
          }
        }



        foreach ($arrayDEsStatus as $diskey => $vDiscsval) {

          if (!is_numeric($vDiscsval) && ($vDiscsval != '0' || $vDiscsval != '1')) {
            $data['response'] = 'Invalid description status value. Pls check line Number : ' . ($diskey + 3);
            $data['status'] = 0;
            echo json_encode($data);
            exit;
          }
        }



        // ======================================================================================

        fclose($file);
        $skip = 0;
        // exit;

        $arrayVariants = array();
        $arrayProduct = array();
        $arrayDescription = array();

        $getMappingCate = array();
        $arrayWerehouse = array();
        // insert import data



        foreach ($importData_arr as $ky => $userdata) {

          $variants_unique_no = preg_replace("/[^0-9]/", "", $userdata['variants_unique_number']);

          if ($skip != 0) {

            if ($userdata['variants_unique_number'] != "") {

              $variantArr = array(
                'variant_id' => $userdata['variant_id'],
                'variants_unique_number' => str_pad($variants_unique_no, 4, '0', STR_PAD_LEFT),
                'sku_id' => $userdata['sku_id'],
                'pack_size' => $userdata['pack_size'],
                'units' => $userdata['units'],
                'price' => $userdata['price'],
                'before_off_price' => $userdata['before_off_price'],
                'stock' => $userdata['stock'],
                'conversion_factor' => 0, //$userdata['conversion_factor'],
                'variants_in_stock_status' => $userdata['variants_in_stock_status'],
                'updated_by' => $userdata['variants_updated_by'],
                'variants_status' => $userdata['variants_status']
              );

              array_push($arrayVariants, $variantArr);
            }





            if ($userdata['unique_number'] != "") {
              $getC1 = array();
              $aa = array();
              $_itemsCode = preg_replace("/[^0-9]/", "", $userdata['unique_number']);
              $expoCat = explode('::', $userdata['cat_id']);
              $d = array();
              $final = array();
              foreach ($expoCat as $key => $ctvalue) {
                $d['cat_id'] = $ctvalue;
                $expoCatelog = explode('___', $userdata['sub_cat_id']);
                $getsC1 = array();

                foreach ($expoCatelog as $key => $catvalue) {

                  $getC = explode('::', $catvalue);
                  if ($getC[0] == $ctvalue) {
                    $getsC1[] = $getC[1];
                  } // if end

                } // foreach end

                $d['subCate_id'] = $getsC1;
                $final[] = (object)$d;
              }  //foreach end



              $aa['collectArr'] = $final;
              $aa['childCategory'] = explode('___', $userdata['child_cat_id']);

              $finl['unique_number'] = $_itemsCode;
              $finl['product_id'] = $userdata['product_id'];

              $finl['lastArr'] = $aa;
              array_push($getMappingCate, $finl);
            }





            if ($userdata['unique_number'] != "") {

              $unique_number_no = preg_replace("/[^0-9]/", "", $userdata['unique_number']);
              array_push($arrayWerehouse, array(
                'werehouse' => explode(',', $userdata['werehouse']),
                'unique_number' => $unique_number_no,
                'product_id' => $userdata['product_id']
              ));



              // $userdata['product_gen_id']
              $prodArray = array(
                'product_id' => $userdata['product_id'],
                'product_gen_id' => null,
                'unique_number' => str_pad($unique_number_no, 4, '0', STR_PAD_LEFT),
                'product_name' => $userdata['product_name'],
                'status' => $userdata['status'],
                'in_stock_status' => $userdata['in_stock_status'],

                'cat_id' => 0, //$userdata['cat_id'],
                'category' => '', // $userdata['category'],
                'pro_ci_cat_name' => '', //$this->my_libraries->getCate_name_ci($userdata['cat_id']),
                'sub_cat_id' => 0, // $userdata['sub_cat_id'],
                'sub_category' => '', // $userdata['sub_category'],
                'pro_ci_sub_cat_name' => '', //$this->my_libraries->getSubCate_name_ci($userdata['sub_cat_id']),


                'hsn_code' => $userdata['hsn_code'],
                'igst' => $userdata['igst'],
                'cgst' => $userdata['cgst'],
                'sgst' => $userdata['sgst'],

                'shelf_life_period' => null, //$userdata['shelf_life_period'],
                'shelf_life_period_type' => null, //$userdata['shelf_life_period_type'],
                'ingredients' => null, //$userdata['ingredients'],
                'storage_condition' => null, //$userdata['storage_condition'],
                'food_habitats' => null, //$userdata['food_habitats'],

                'delivery_palce' => null, //implode(',', $arrDelivPlace),
                'international_delivery' => null, //$userdata['international_delivery'],
                'national_delivery' => null, //$userdata['national_delivery'],
                'excluding_local_hyperlocal' => null, //$userdata['excluding_local_hyperlocal'],
                'hyperlocal_delivery' => null, //$userdata['hyperlocal_delivery'],
                'local_delivery' => null, //$userdata['local_delivery'],
                'pick_up_store' => null, //$userdata['pick_up_store'],

                'tags' => null, //$userdata['tags'],
                'quick_description' => null, //$userdata['quick_description'],
                'image1' => $userdata['image1'],
                'image2' => $userdata['image2'],
                'image3' => $userdata['image3'],
                'image4' => $userdata['image4'],
                'image5' => $userdata['image5'],
                'image6' => $userdata['image6'],
                'in_stock_status' => $userdata['in_stock_status'],
                'status' => $userdata['status'],
                'updated_by' => $userdata['updated_by']

              );

              array_push($arrayProduct, $prodArray);
            }


            $strRepLast_header = substr($userdata['desc_header'], 1, -1);
            $strRepLast_description = substr($userdata['description'], 1, -1);
            $strRepLast_status = substr($userdata['desc_status'], 1, -1);
            $strRepLast_desc_id = substr($userdata['desc_id'], 1, -1);


            $explorValue_header = explode('],[', $strRepLast_header);
            $explorValue_description = explode('],[', $strRepLast_description);
            $explorValue_status = explode('],[', $strRepLast_status);
            $explorValue_desc_id = explode('],[', $strRepLast_desc_id);



            foreach ($explorValue_header as $keys => $valDesc) {

              $desc_unique_no = preg_replace("/[^0-9]/", "", $userdata['desc_unique_number']);
              if ($userdata['desc_unique_number'] != "") {
                $arrDes = array(
                  'desc_id' => (isset($explorValue_desc_id[$keys])) ? $explorValue_desc_id[$keys] : '',
                  'desc_unique_number' => str_pad($desc_unique_no, 4, '0', STR_PAD_LEFT),
                  'desc_header' => $explorValue_header[$keys],
                  'description' => $explorValue_description[$keys],
                  'status' => $explorValue_status[$keys]
                );

                array_push($arrayDescription, $arrDes);
              }
            }
          }
          $skip++;
        }





        foreach (array_slice($arrayProduct, 1) as $pfVlaue) {

          if ($pfVlaue['product_id'] == "") {
            $sqlQuery_p = $this->sqlQuery_model->sql_insert('tbl_product', array_slice($pfVlaue, 1));
          } else {
            $sqlQuery_p = $this->sqlQuery_model->sql_update('tbl_product', array_slice($pfVlaue, 1), array('product_id' => $pfVlaue['product_id']));
          }
        }




        foreach (array_slice($arrayWerehouse, 1) as $wereHlaue) {
          if (array_filter($wereHlaue['werehouse']) != array()) {
            $this->my_libraries->mappingWerehouseWithProduct($wereHlaue['werehouse'], $wereHlaue['unique_number'], $wereHlaue['product_id'], $session);
          }
        }


        foreach (array_slice($getMappingCate, 1) as $mappingVlaue) {
          $this->my_libraries->categoryMappingWithProduct($mappingVlaue['lastArr'], $mappingVlaue['unique_number'], $mappingVlaue['product_id']);
        }


        foreach (array_slice($arrayVariants, 1) as $vfVlaue) {

          if ($vfVlaue['variant_id'] == "") {
            $sqlQuery_v = $this->sqlQuery_model->sql_insert('tbl_product_variants', array_slice($vfVlaue, 1));
          } else {
            $sqlQuery_v = $this->sqlQuery_model->sql_update('tbl_product_variants', array_slice($vfVlaue, 1), array('variant_id' => $vfVlaue['variant_id']));
          }
        }


        foreach (array_slice($arrayDescription, 1) as $dfVlaue) {

          if ($dfVlaue['desc_id'] == "") {
            $sqlQuery_d = $this->sqlQuery_model->sql_insert('tbl_product_description', array_slice($dfVlaue, 1));
          } else {
            $sqlQuery_d = $this->sqlQuery_model->sql_update('tbl_product_description', array_slice($dfVlaue, 1), array('desc_id' => $dfVlaue['desc_id']));
          }
        }


        $data['response'] = 'Successfully uploaded ' . $filename;
        $data['status'] = 1;
      } else {
        $data['response'] = 'Failed to upload data.';
        $data['status'] = 0;
      }
    } else {
      $data['response'] = 'Failed to upload data.';
      $data['status'] = 0;
    }



    echo json_encode($data);
    exit;
  }





  public function units_manage()
  {
    $menuIdAsKey = 9;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $getUnitId = $this->uri->segment(3);
    $data['units_detaials'] = 0;
    if ($getUnitId != "") {
      $data['units_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_units', array('units_id' => $getUnitId));
    }

    $data['units_list'] = $this->sqlQuery_model->sql_select('tbl_units', 'units_id');
    $data['deleteActionArr'] = array('table' => 'tbl_units', 'primary_key' => 'units_id');
    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_units', 'primary_key' => 'units_id', 'update_target_column' => 'status');
    $data['content'] = 'admin/containerPage/units-manage';
    $this->load->view('admin/template', $data);
  }

  public function food_habitats()
  {
    $menuIdAsKey = 10;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $getfooId = $this->uri->segment(3);
    $data['food_detaials'] = 0;
    if ($getfooId != "") {
      $data['food_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_food_habitats', array('fh_id' => $getfooId));
    }

    $data['food_habitats_list'] = $this->sqlQuery_model->sql_select('tbl_food_habitats', 'fh_id');
    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_food_habitats', 'primary_key' => 'fh_id', 'update_target_column' => 'status');
    $data['deleteActionArr'] = array('table' => 'tbl_food_habitats', 'primary_key' => 'fh_id');

    $data['content'] = 'admin/containerPage/food_habitats';
    $this->load->view('admin/template', $data);
  }

  public function product_order()
  {

    $customer_id = $this->input->get('custo');

    // echo $customer_id;
    // die();

    $menuIdAsKey = 3;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $pr_list_count = $this->sqlQuery_model->getOrderDetails($customer_id);

    $url_link = base_url('admin/product_order');
    $limit_per_page = 1;
    $getVariable = $this->input->get('per_page');
    $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0) : 0;
    $total_records = ($pr_list_count != 0) ? count($pr_list_count) : 0;
    $config = createPagination($total_records, $url_link, $limit_per_page);
    $this->pagination->initialize($config);

    // $sql_limit = 'LIMIT ' . $page * $limit_per_page . ',' . $limit_per_page;
    $data['order_list'] = $this->sqlQuery_model->getOrderDetails($customer_id);

    // echo '<pre>';
    // print_r($data['order_list'] );
    // die();

    $data["links"] = $this->pagination->create_links();

    //$data['order_amount'] = $this->sqlQuery_model->getOrderAmount();  // Assuming this method returns the total amount
    $data['content'] = 'admin/containerPage/product-orders';
    $this->load->view('admin/template', $data);
  }






  public function search_order_list()
  {
    $menuIdAsKey = 3;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $keywords = $this->input->post('searchText');
    $fromDate = $this->input->post('fromDate');
    $toDate = $this->input->post('toDate');
    // Pass the search parameters to the model method
    $data['order_list'] = $this->sqlQuery_model->getOrderSearchDetails($keywords, $fromDate, $toDate);

    // echo "<pre>";
    // print_r($data['order_list']);
    // die();

    $this->load->view('admin/containerPage/product_order_searchlist', $data);
  }





  public function order_details()
  {
    $menuIdAsKey = 3;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $getOrderId = $this->uri->segment(3);

    // get custid  from the menu item list and return 

    // echo "<pre>";
    // print_r($order_details);
    // die();
    $data['order_details'] = $this->sqlQuery_model->sql_select_where_orderdetails($getOrderId);

    // echo "<pre>";
    // print_r( $data['order_details'] );
    // die();

    //$data['order_product_details'] = $this->sqlQuery_model->sql_select_where('tbl_order_products', array('pro_generated_order_id' => $getOrderId));


    //$data['order_status'] = $this->sqlQuery_model->sql_select_where_desc('tbl_order_status', 'position', array('status' => 1));

    $data['content'] = 'admin/containerPage/order-details';
    $this->load->view('admin/template', $data);
  }




  public function export_OrderList()
  {
    // Get date parameters from input (assuming you're using GET method)
    $fromDate = $this->input->post('fromDate');
    $toDate = $this->input->post('toDate');
    $orderNumber = $this->input->post('getKeywords');




    // echo "<pre>";
    // print_r($orderNumber);


    // die();

    $order_list = $this->sqlQuery_model->getOrderSearchDetails($orderNumber, $fromDate, $toDate);
    // echo '<pre>';
    // print_r($order_list);
    // die();
    // $order_list = $this->sqlQuery_model->getOrderDetailsByDateOrOrderNumber($fromDate, $toDate, $orderNumber);

    // Uncomment the following line for debugging


    // Set headers to force download the CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="order_list.csv"');

    // Open output stream for CSV
    $file = fopen('php://output', 'w');

    // CSV header
    $header = array(
      "ORDER ID",
      "CUSTOMER NAME",
      "LOCATION",
      "ORDER AMOUNT",
      "STATUS",
      "PAY STATUS",
      "ORDER DATE",
    );

    fputcsv($file, $header);

    // Write order details to CSV
    // foreach ($order_list as $line) {
    //     $data = array(
    //         $line['order_no'],
    //         $line['customer_name'],
    //         $line['location'],
    //         $line['order_amount'],
    //         // isset($line['status']) ? $line['status'] : '', 
    //         isset($line['Pending']) ? $line['Pending'] : '', 
    //         // isset($line['pay_status']) ? $line['pay_status'] : '',
    //         isset($line['Pending']) ? $line['Pending'] : '',
    //         $line['order_date'],
    //     );

    //     fputcsv($file, $data);
    // }


    foreach ($order_list as $line) {
      $data = array(
        $line['order_no'],
        $line['customer_name'],
        $line['location'],
        $line['order_amount'],
        'Pending', // Hardcoded status
        'Pending', // Hardcoded pay_status
        $line['order_date'],
      );

      fputcsv($file, $data);
    }


    // Close the file handle
    fclose($file);
    exit;
  }





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




  public function add_customer()
  {
    $menuIdAsKey = 4;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $getcustId = $this->uri->segment(3);
    $data['customer_detaials'] = 0;
    if ($getcustId != "") {
      $data['customer_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_customer', array('customer_id' => $getcustId));
    }

    // $data['customer_list']=$this->sqlQuery_model->sql_select('tbl_customer','customer_id');
    $data['content'] = 'admin/containerPage/add_customer';
    $this->load->view('admin/template', $data);
  }


  public function coupon_list()
  {
    $menuIdAsKey = 8;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $querys = "SELECT * FROM tbl_coupon";
    $pr_list_count = $this->sqlQuery_model->sql_query($querys);
    $url_link = base_url('admin/coupon_list');
    $limit_per_page = 10;
    $getVariable = $this->input->get('per_page');
    $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0) : 0;

    $total_records = ($pr_list_count != 0) ? count($pr_list_count) : 0;
    $config = createPagination($total_records, $url_link, $limit_per_page);
    $this->pagination->initialize($config);

    $sql_limit = 'LIMIT ' . $page * $limit_per_page . ',' . $limit_per_page;
    $querys = "SELECT * FROM tbl_coupon ORDER BY coupon_id DESC $sql_limit";
    $data['coupon_list'] = $this->sqlQuery_model->sql_query($querys);
    $data["links"] = $this->pagination->create_links();


    // $data['coupon_list']=$this->sqlQuery_model->sql_select('tbl_coupon','coupon_id');
    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_coupon', 'primary_key' => 'coupon_id', 'update_target_column' => 'coupons_status');

    $data['deleteActionArr'] = array('table' => 'tbl_coupon', 'primary_key' => 'coupon_id');
    $data['content'] = 'admin/containerPage/coupon-list';
    $this->load->view('admin/template', $data);
  }

  public function add_coupon()
  {
    $menuIdAsKey = 8;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $getcouponId = $this->uri->segment(3);
    $data['coupon_detaials'] = 0;
    if ($getcouponId != "") {
      $data['coupon_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_coupon', array('coupon_id' => $getcouponId));
    }


    $data['content'] = 'admin/containerPage/add-coupon';
    $this->load->view('admin/template', $data);
  }

  public function stock_list()
  {

    $data['content'] = 'admin/containerPage/stock-list';
    $this->load->view('admin/template', $data);
  }

  public function return()
  {

    $data['content'] = 'admin/containerPage/return';
    $this->load->view('admin/template', $data);
  }

  // public function delivery_slot(){

  //        $getslotId=$this->uri->segment(3);
  //        $data['slot_detaials']=0;
  //      if($getslotId!=""){
  //        $data['slot_detaials']=$this->sqlQuery_model->sql_select_where('tbl_delivery_slot',array('slot_id'=>$getslotId));
  //       }
  //   $data['delivery_slot']=$this->sqlQuery_model->sql_select('tbl_delivery_slot','slot_id');
  //   $data['ActiveInactive_ActionArr']=array('table'=>'tbl_delivery_slot','primary_key'=>'slot_id','update_target_column'=>'status');

  //   $data['ActiveInactive_ActionArr_default']=array('table'=>'tbl_delivery_slot','primary_key'=>'slot_id','update_target_column'=>'default_set');

  //   $data['deleteActionArr']=array('table'=>'tbl_delivery_slot','primary_key'=>'slot_id');
  //   $data['content']='admin/containerPage/delivery-slot';
  //   $this->load->view('admin/template',$data);

  // }



  public function period_type()
  { // Not Using anywhere
    $menuIdAsKey = 11;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $getPeriodId = $this->uri->segment(3);
    $data['period_detaials'] = 0;
    if ($getPeriodId != "") {
      $data['period_detaials'] = $this->sqlQuery_model->sql_select_where('period_type', array('ptype_id' => $getPeriodId));
    }

    $data['period_list'] = $this->sqlQuery_model->sql_select('period_type', 'position');

    $data['deleteActionArr'] = array('table' => 'period_type', 'primary_key' => 'ptype_id');
    $data['ActiveInactive_ActionArr'] = array('table' => 'period_type', 'primary_key' => 'ptype_id', 'update_target_column' => 'status');

    $data['content'] = 'admin/containerPage/period_type';
    $this->load->view('admin/template', $data);
  }


  // public function blogs(){
  //         $menuIdAsKey=6;
  //         $data['getAccess']=$this->my_libraries->userAthorizetion($menuIdAsKey);
  //         $data['page_menu_id']=$menuIdAsKey;

  //       $querys="SELECT * FROM tbl_blog";
  //        $pr_list_count=$this->sqlQuery_model->sql_query($querys);
  //        $url_link=base_url('admin/blogs'); 
  //        $limit_per_page = 10;
  //        $getVariable=$this->input->get('per_page');
  //        $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0 ) : 0;

  //        $total_records = ($pr_list_count!=0) ? count($pr_list_count) : 0;
  //        $config=createPagination($total_records,$url_link,$limit_per_page);
  //          $this->pagination->initialize($config);

  //        $sql_limit='LIMIT '.$page*$limit_per_page.','.$limit_per_page;
  //        $querys="SELECT * FROM tbl_blog ORDER BY blog_id DESC $sql_limit";
  //        $data['blogs_list']=$this->sqlQuery_model->sql_query($querys);
  //        $data["links"] = $this->pagination->create_links();

  //         $data['ActiveInactive_ActionArr']=array('table'=>'tbl_blog','primary_key'=>'blog_id','update_target_column'=>'blog_status');
  //         $data['deleteActionArr']=array('table'=>'tbl_blog','primary_key'=>'blog_id');



  //     $data['content']='admin/containerPage/blogs';
  //     $this->load->view('admin/template',$data);
  // }














  public function add_blogs()
  {
    $menuIdAsKey = 6;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $getproductId = $this->uri->segment(3);
    $data['product_list'] = 0;
    if ($getproductId != "") {
      $data['product_list'] = $this->sqlQuery_model->sql_select_where('tbl_blog', array('blog_id' => $getproductId));
      // $data['product_disc_list']=$this->sqlQuery_model->sql_select_where('tbl_product_description',array('desc_unique_number'=>$getproductId));

    }


    $getproductId = $this->uri->segment(3);
    $data['category_list'] = $this->sqlQuery_model->sql_select_where('tbl_category', array('status' => 1));
    $data['fileName'] = 'add_blogs';
    $data['content'] = 'admin/containerPage/add-blogs';
    $this->load->view('admin/template', $data);
  }



  public function shipping_manage()
  {
    $menuIdAsKey = 7;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $getshiId = $this->uri->segment(3);
    $data['shipping_detaials'] = 0;
    if ($getshiId != "") {
      $data['shipping_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_shipping_charges_manage', array('ship_charge_id' => $getshiId));
    }

    $data['shipping_list'] = $this->sqlQuery_model->sql_select('tbl_shipping_charges_manage', 'position');

    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_shipping_charges_manage', 'primary_key' => 'ship_charge_id', 'update_target_column' => 'status');


    // $data['in_stock_active_inactive']=array('table'=>'tbl_category','primary_key'=>'cat_id','update_target_column'=>'in_stock_status');
    $data['deleteActionArr'] = array('table' => 'tbl_shipping_charges_manage', 'primary_key' => 'ship_charge_id');


    $data['delveryType'] = $this->sqlQuery_model->sql_select_where_desc('tbl_delivery_place', 'position', array('status' => 1));



    $data['content'] = 'admin/containerPage/shipping_manage';
    $this->load->view('admin/template', $data);
  }


  public function hsn_code()
  {
    $menuIdAsKey = 5;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $querys = "SELECT * FROM tbl_hsn_code";

    $pr_list_count = $this->sqlQuery_model->sql_query($querys);
    $url_link = base_url('admin/hsn_code');
    $limit_per_page = 10;
    $getVariable = $this->input->get('per_page');
    $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0) : 0;

    $total_records = ($pr_list_count != 0) ? count($pr_list_count) : 0;
    $config = createPagination($total_records, $url_link, $limit_per_page);
    $this->pagination->initialize($config);

    $sql_limit = 'LIMIT ' . $page * $limit_per_page . ',' . $limit_per_page;
    $querys = "SELECT * FROM tbl_hsn_code ORDER BY hsn_code_id DESC $sql_limit";
    $data['hsn_list'] = $this->sqlQuery_model->sql_query($querys);
    $data["links"] = $this->pagination->create_links();
    // $data['hsn_list']=$this->sqlQuery_model->sql_select('tbl_hsn_code','hsn_code_id');

    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_hsn_code', 'primary_key' => 'hsn_code_id', 'update_target_column' => 'status');

    $data['deleteActionArr'] = array('table' => 'tbl_hsn_code', 'primary_key' => 'hsn_code_id');
    $data['content'] = 'admin/containerPage/hsn_code';
    $this->load->view('admin/template', $data);
  }

  public function add_hsn()
  {
    $menuIdAsKey = 5;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $gethsnId = $this->uri->segment(3);
    $data['hsn_detaials'] = 0;
    if ($gethsnId != "") {
      $data['hsn_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_hsn_code', array('hsn_code_id' => $gethsnId));
    }
    $data['content'] = 'admin/containerPage/add_hsn';
    $this->load->view('admin/template', $data);
  }
  // ========





  public function importHSN_SVC()
  {

    $session = $this->session->userdata('admin');
    $data = array();
    if (!empty($_FILES['fileupload']['name'])) {
      // Set preference 
      $config['upload_path'] = 'uploads/hsnCode/';
      $config['allowed_types'] = 'csv';
      $config['max_size'] = '100000'; // max_size in kb 
      $config['file_name'] = $_FILES['fileupload']['name'];
      // Load upload library 
      $this->load->library('upload', $config);
      // File upload

      if ($this->upload->do_upload('fileupload')) {
        // Get data about the file
        $uploadData = $this->upload->data();
        $filename = $uploadData['file_name'];
        // Reading file
        $file = fopen("uploads/hsnCode/" . $filename, "r");
        $i = 0;
        $numberOfFields = 4; // Total number of fields
        // $importData_arr = array();

        $tableHeader = array(
          'hsn_code_id',
          'hsn_code',
          'description',
          'status',
          'updated_by'
        );
        $arrPost = array();
        $counter = 0;
        while (($filedata = fgetcsv($file, 21500, ",")) !== FALSE) {

          $counter++;
          if ($counter != 1) {

            $arrPost['hsn_code'] = $filedata[1];
            $arrPost['description'] = $filedata[2];
            $arrPost['status'] = 1;
            $arrPost['updated_by'] = $session['admin_name'];


            // if($filedata!=''){
            // $arrPost=array('hsn_code'=>$filedata[1],'description'=>$filedata[2],'status'=>1,'updated_by'=>$session['admin_name']);
            if ($filedata[0] == "") {
              $this->sqlQuery_model->sql_insert('tbl_hsn_code', $arrPost);
            } else {
              $this->sqlQuery_model->sql_update('tbl_hsn_code', $arrPost, array('hsn_code_id' => $filedata[0]));
            }
            // }

          }
        }
        // exit;
        fclose($file);
        $data['response'] = 'Successfully uploaded ' . $filename;
        $data['status'] = 1;
      } else {
        $data['response'] = 'Failed to upload data.';
        $data['status'] = 0;
      }
    } else {
      $data['response'] = 'Failed to upload data.';
      $data['status'] = 0;
    }


    echo json_encode($data);
    exit;
  }


  // ====
  public function export_HSN_CSV()
  {
    while (ob_get_level()) {
      ob_end_clean();
    }
    // file name
    $filename = 'hsncode_' . date('Y-m-d_h-i') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    $hsn_list = $this->sqlQuery_model->sql_select('tbl_hsn_code', 'hsn_code_id');
    $file = fopen('php://output', 'w');

    $header = array(
      "Hsn Id",
      "HSN Code",
      "HSN Description",
      "Updated By",
      "Status",
      "Date"
    );
    fputcsv($file, $header);
    $l = array();

    foreach (array_reverse($hsn_list) as $key => $line) {
      $l['hsn_code_id'] = $line->hsn_code_id;
      $l['hsn_code'] = $line->hsn_code;
      $l['description'] = $line->description;
      $l['updated_by'] = $line->updated_by;
      $l['status'] = $line->status;
      $l['add_date'] = $line->add_date;
      fputcsv($file, $l);
    }

    fclose($file);
    exit;
  }



  public function export_CustomerList()
  {
    while (ob_get_level()) {
      ob_end_clean();
    }
    // file name
    $filename = 'customerList_' . date('Y-m-d_h-i') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    $custo_list = $this->sqlQuery_model->sql_select('tbl_customer', 'customer_id');
    $file = fopen('php://output', 'w');

    $header = array(
      "Cust Id",
      "Name",
      "Email",
      "Mobile",
      "Registration No",
      "Company Name",
      "Company Address",
      "Created By",
      "Register Type",
      "Status",
      "Add Date"
    );
    fputcsv($file, $header);
    $l = array();

    foreach (array_reverse($custo_list) as $key => $line) {
      $l['customer_id'] = $line->customer_id;
      $l['name'] = ucfirst($line->c_fname) . ' ' . ucfirst($line->c_lname);
      $l['email'] = $line->email;
      $l['mobile'] = $line->mobile;
      $l['registration_no'] = $line->registration_no;
      $l['company_name'] = $line->company_name;
      $l['company_address'] = $line->company_address;
      $l['updated_by'] = $line->updated_by;
      $l['registered_type'] = $line->registered_type;
      $l['status'] = $line->status;
      $l['add_date'] = $line->add_date;
      fputcsv($file, $l);
    }

    fclose($file);
    exit;
  }






  public function packing_slip()
  {


    $productValie = $this->input->get('d');
    if ($productValie == "") {
      $data['status'] = 0;
      $data['message'] = "Something went wrong.";
      echo json_encode($data);
      exit;
    }

    // order_cust_id=".$user[0]->customer_id." AND
    $sql_manage_order = "SELECT * FROM tbl_order_manager WHERE order_generated_order_id='" . $productValie . "'";
    $getMOrder = $this->sqlQuery_model->sql_query($sql_manage_order);

    // pro_cust_id=".$user[0]->customer_id." AND
    $sql_order = "SELECT * FROM tbl_order_products WHERE pro_generated_order_id='" . $productValie . "'";
    $getOrder = $this->sqlQuery_model->sql_query($sql_order);

    $d['ordManage'] = $getMOrder;
    $d['order'] = $getOrder;

    // header("Content-Type", "application/pdf");
    $mpdf = new Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => 16, 'margin_right' => 16, 'margin_top' => 16, 'margin_bottom' => 16, 'margin_header' => 16, 'margin_footer' => 16]);
    $footer = '';
    $mpdf->defaultheaderfontsize = 12;
    $mpdf->defaultheaderfontstyle = 'B';
    $mpdf->defaultheaderline = 0;
    $mpdf->setFooter($footer);
    // $mpdf->SetHeader('Bill | | <strong>Pages {PAGENO} of {nb}</strong>');
    // foreach($arrCllect as $value){
    $html = $this->load->view('admin/containerPage/packing-slip', $d, true);
    $mpdf->AddPage();
    $mpdf->WriteHTML($html);
    // }
    $mpdf->defaultfooterline = 0;
    $mpdf->Output('packing-slip.pdf', 'D');
    // $this->load->view('admin/containerPage/packing-slip',$d);
  }


  public function shipping_label()
  {

    $productValie = $this->input->get('d');
    if ($productValie == "") {
      $data['status'] = 0;
      $data['message'] = "Something went wrong.";
      echo json_encode($data);
      exit;
    }

    $sql_manage_order = "SELECT * FROM tbl_order_manager WHERE order_generated_order_id='" . $productValie . "'";
    $getMOrder = $this->sqlQuery_model->sql_query($sql_manage_order);

    // pro_cust_id=".$user[0]->customer_id." AND
    $sql_order = "SELECT * FROM tbl_order_products WHERE pro_generated_order_id='" . $productValie . "'";
    $getOrder = $this->sqlQuery_model->sql_query($sql_order);

    $d['ordManage'] = $getMOrder;
    $d['order'] = $getOrder;

    $mpdf = new Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => 16, 'margin_right' => 16, 'margin_top' => 16, 'margin_bottom' => 16, 'margin_header' => 16, 'margin_footer' => 16]);
    $footer = '';
    $mpdf->defaultheaderfontsize = 12;
    $mpdf->defaultheaderfontstyle = 'B';
    $mpdf->defaultheaderline = 0;
    $mpdf->setFooter($footer);
    // $mpdf->SetHeader('Bill | | <strong>Pages {PAGENO} of {nb}</strong>');
    // foreach($arrCllect as $value){
    $html = $this->load->view('admin/containerPage/shipping-label', $d, true);
    $mpdf->AddPage();
    $mpdf->WriteHTML($html);
    // }
    $mpdf->defaultfooterline = 0;
    $mpdf->Output('shipping-label.pdf', 'D');

    // $this->load->view('admin/containerPage/shipping-label',$d);
  }


  public function gallery_tag_list()
  {
    $menuIdAsKey = 25;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $gettagId = $this->uri->segment(3);
    $data['tag_detaials'] = 0;
    if ($gettagId != "") {
      $data['tag_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_gallery_type', array('gallery_id' => $gettagId));
    }

    // $data['tag_list']=$this->sqlQuery_model->sql_select('tbl_gallery_type','gallery_id');
    $data['tag_list'] = $this->sqlQuery_model->sql_select('tbl_gallery_type', 'position');
    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_gallery_type', 'primary_key' => 'gallery_id', 'update_target_column' => 'status');
    $data['deleteActionArr'] = array('table' => 'tbl_gallery_type', 'primary_key' => 'gallery_id');

    $data['content'] = 'admin/containerPage/gallery_tag_list';
    $this->load->view('admin/template', $data);
  }


  public function gallery_images()
  {
    $menuIdAsKey = 25;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $galleryId = $this->uri->segment(3);
    $data['imageList_list'] = 0;
    if ($galleryId != "") {
      $data['imageList_list'] = $this->sqlQuery_model->sql_select_where_desc('tbl_gallery_images', 'position', array('gallery_id' => $galleryId));
    }



    // $querys="SELECT * FROM tbl_gallery_images";
    //  $pr_list_count=$this->sqlQuery_model->sql_query($querys);
    //  $url_link=base_url('admin/gallery_images'); 
    //  $limit_per_page = 10;
    //  $getVariable=$this->input->get('per_page');
    //  $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0 ) : 0;
    //  $total_records = ($pr_list_count!=0) ? count($pr_list_count) : 0;
    //  $config=createPagination($total_records,$url_link,$limit_per_page);
    //    $this->pagination->initialize($config);
    //  $sql_limit='LIMIT '.$page*$limit_per_page.','.$limit_per_page;
    //  $querys="SELECT * FROM tbl_hsn_code ORDER BY hsn_code_id DESC $sql_limit";
    //  $data['hsn_list']=$this->sqlQuery_model->sql_query($querys);
    //  $data["links"] = $this->pagination->create_links();







    $gallImaId = $this->uri->segment(4);
    $data['gallDetails_detaials'] = 0;
    if ($gallImaId != "") {
      $data['gallDetails_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_gallery_images', array('gallimg_id' => $gallImaId));
    }


    $data['deleteActionArr'] = array('table' => 'tbl_gallery_images', 'primary_key' => 'gallimg_id');
    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_gallery_images', 'primary_key' => 'gallimg_id', 'update_target_column' => 'status');

    $data['content'] = 'admin/containerPage/gallery_images';
    $this->load->view('admin/template', $data);
  }


  public function contact_manager()
  {
    $menuIdAsKey = 28;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $data['contactdetaials'] = $this->sqlQuery_model->sql_select_where('tbl_contact_details', array('status' => 1));

    $data['fileName'] = 'contact_manager';
    $data['content'] = 'admin/containerPage/contact_manager';
    $this->load->view('admin/template', $data);
  }

  public function team_manager()
  {
    $menuIdAsKey = 29;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $data['team_list'] = $this->sqlQuery_model->sql_select('tbl_teams', 'position');


    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_teams', 'primary_key' => 'team_id', 'update_target_column' => 'status');
    $data['deleteActionArr'] = array('table' => 'tbl_teams', 'primary_key' => 'team_id');

    $data['content'] = 'admin/containerPage/team_manager';
    $this->load->view('admin/template', $data);
  }



  public function add_team()
  {
    $menuIdAsKey = 29;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $getuserId = $this->uri->segment(3);
    $data['team_details'] = 0;
    if ($getuserId != "") {
      $data['team_details'] = $this->sqlQuery_model->sql_select_where('tbl_teams', array('team_id' => $getuserId));
    }


    $data['content'] = 'admin/containerPage/add_team';
    $this->load->view('admin/template', $data);
  }


  public function testimonial()
  {
    $menuIdAsKey = 30;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $data['testinonial_list'] = $this->sqlQuery_model->sql_select('tbl_testinonial', 'position');


    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_testinonial', 'primary_key' => 'testi_id', 'update_target_column' => 'status');
    $data['deleteActionArr'] = array('table' => 'tbl_testinonial', 'primary_key' => 'testi_id');

    $data['content'] = 'admin/containerPage/testimonial';
    $this->load->view('admin/template', $data);
  }

  public function add_testinonial()
  {
    $menuIdAsKey = 30;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $getuserId = $this->uri->segment(3);
    $data['testi_details'] = 0;
    if ($getuserId != "") {
      $data['testi_details'] = $this->sqlQuery_model->sql_select_where('tbl_testinonial', array('testi_id' => $getuserId));
    }


    $data['content'] = 'admin/containerPage/add_testinonial';
    $this->load->view('admin/template', $data);
  }


  // public function kyf(){
  //     $menuIdAsKey=31;
  //    $data['getAccess']=$this->my_libraries->userAthorizetion($menuIdAsKey);
  //    $data['page_menu_id']=$menuIdAsKey;

  //      $data['kyf_list']=$this->sqlQuery_model->sql_select('tbl_kyf','position');


  //      $data['ActiveInactive_ActionArr']=array('table'=>'tbl_kyf','primary_key'=>'kyf_id','update_target_column'=>'status');
  //      $data['deleteActionArr']=array('table'=>'tbl_kyf','primary_key'=>'kyf_id');

  //   $data['content']='admin/containerPage/kyf';
  //   $this->load->view('admin/template',$data);
  // }

  // public function add_kyf(){
  //     $menuIdAsKey=31;
  //     $data['getAccess']= $this->my_libraries->userAthorizetion($menuIdAsKey);
  //     $data['page_menu_id']=$menuIdAsKey;


  //   $getuserId=$this->uri->segment(3);
  //   $data['kyf_details']=0;
  //    if($getuserId!=""){
  //      $data['kyf_details']=$this->sqlQuery_model->sql_select_where('tbl_kyf',array('kyf_id'=>$getuserId));
  //     }

  //    $data['fileName']='add_kyf';
  //   $data['content']='admin/containerPage/add_kyf';
  //   $this->load->view('admin/template',$data);
  // }






  public function banner()
  {
    $config = array();
    $config["base_url"] = base_url() . "admin/banner";
    $config["total_rows"] = $this->sqlQuery_model->get_user_count_banner_list();
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;
    // Pagination tags customization
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li class="paginate_button page-item page-link">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li class="paginate_button page-item page-link">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = 'Next';
    $config['next_tag_open'] = '<li class="paginate_button page-item page-link">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = 'Previous';
    $config['prev_tag_open'] = '<li class="paginate_button page-item page-link">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="paginate_button page-item page-link">';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['banner_list'] = $this->sqlQuery_model->get_users_banner_list($config["per_page"], $page);
    $data['pagination'] = $this->pagination->create_links();
    $data['content'] = 'admin/containerPage/banner';
    $data['page'] = (!empty($page) ? ($page + 1) : '1');
    $this->load->view('admin/template', $data);
  }


  public function banner_Delete()
  {

    //    $menuIdAsKey=31;
    //    $data['getAccess']=$this->my_libraries->userAthorizetion($menuIdAsKey);
    //    $data['page_menu_id']=$menuIdAsKey;

    //    $getBannerId=$this->uri->segment(3);

    // $getuserId=$this->uri->segment(3);
    //    print_r($getBannerId);
    //    die('');
    //    $this->sqlQuery_model->sql_delete('tbl_banner',array('banner_id'=>$getBannerId));

    //    redirect('admin/banner');


    $menuIdAsKey = 34;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $value = $this->input->post('value');
    $Responce = $this->sqlQuery_model->sql_delete('tbl_banner', array('banner_id' => $value));

    echo $Responce;
    exit();
  }


  public  function banner_edit_action($banner_id)
  {
    $data['banner'] = $this->sqlQuery_model->get_banner_by_id($banner_id);
    $this->load->view('admin/containerPage/edit_banner', $data);
  }

  
  public function updatebannerStatus()
  {
    $banner_id = $this->input->post('banner_id');
    $status = $this->input->post('status');
    $updateStatus = $this->sqlQuery_model->toggle_banner_status($banner_id, $status);
    if ($updateStatus) {
      echo json_encode('True');
    } else {
      $this->load->view('admin\containerPage\banner', $updateStatus);
      echo json_encode('False');
    }
  }




  public function banner_update()
  {
    $banner_id = $this->input->post('banner_id');
    $text1 = $this->input->post('text1');
    $description = $this->input->post('description');
    $button_link = $this->input->post('button_link');
    $status = $this->input->post('status');
    $config['upload_path'] = './uploads/banner/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 2048;
    $this->load->library('upload', $config);
    $desk_image = '';
    $existing_banner = $this->sqlQuery_model->get_banner_by_id($banner_id);
    if ($existing_banner) {
      $desk_image = $existing_banner->desk_image; // Access object property correctly
    }
    if ($this->upload->do_upload('desk_image')) {
      $upload_data = $this->upload->data();
      $desk_image = $upload_data['file_name']; // Update with new image name
    }
    // Prepare data for update
    $update_data = array(
      'text1' => $text1,
      'description' => $description,
      'button_link' => $button_link,
      'desk_image' => $desk_image,
      'status' => $status
    );

    if ($this->sqlQuery_model->update_banner($banner_id, $update_data)) {
      $response['success'] = true;
      $response['message'] = 'Banner updated successfully';
    } else {
      $response['success'] = false;
      $response['message'] = 'Failed to update banner';
    }

    echo json_encode($response);
  }










  public function create()
  {
    $this->load->view('admin/containerPage/add_banner_list');
  }

  public function banner_add_action()
  {
    // Retrieve POST data
    $header = $this->input->post('header');
    $description = $this->input->post('description');
    $link = $this->input->post('link');

    // Configure file upload settings
    $config['upload_path'] = 'uploads/banner';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 1000;
    $this->load->library('upload', $config);

    // Attempt file upload
    if ($this->upload->do_upload('image')) {
      $upload_data = $this->upload->data();
      $image = $upload_data['file_name'];
    } else {
      $image = ''; // Default image or handle the error as needed
    }

    // Prepare data for insertion
    $data = array(
      'text1' => $header,
      'description' => $description,
      'button_link' => $link,
      'desk_image' => $image,
      'add_date' => date('Y-m-d H:i:s'),
      'type' => 'banner'
    );

    // Insert data into database
    $result = $this->sqlQuery_model->insert_banner_list($data);

    // Return response
    if ($result) {
      echo json_encode(array('status' => 'success', 'message' => 'Banner added successfully.'));
    } else {
      echo json_encode(array('status' => 'error', 'message' => 'Failed to add banner.'));
    }
  }











  public function update_banner_Status()
  {
    $status = $this->input->post('status_value');
    $bannnerId = $this->input->post('baner_id');

    // print_r($status);
    // // echo '--';
    // print_r($bannnerId);
    // die();

    $updateStatus = $this->sqlQuery_model->update_banner_Status1($bannnerId, $status);
    if ($updateStatus) {
      echo json_encode('True');
    } else {

      $this->load->view('admin/containerPage/add_ads_banner', $data);
      echo json_encode('False');
    }
  }










  public function ads_banner()
  {



    $menuIdAsKey = 33;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $config = array();
    $config["base_url"] = base_url() . "admin/ads_banner";
    $config["total_rows"] = $this->user_model->get_user_count_banner();
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
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['ads_banner_list'] = $this->user_model->get_users_banner($config["per_page"], $page);
    $data['pagination'] = $this->pagination->create_links();
    $data['ads_banner_list'] = $this->sqlQuery_model->sql_select_where_desc('tbl_banner', 'position', array('type' => 'ads'));
    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_banner', 'primary_key' => 'banner_id', 'update_target_column' => 'status');
    $data['deleteActionArr'] = array('table' => 'tbl_banner', 'primary_key' => 'banner_id');

    $data['content'] = 'admin/containerPage/ads';
    $this->load->view('admin/template', $data);
  }




  public function add_ads_banner($bannnerId = null)
  {
    $menuIdAsKey = 31;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    // Retrieve banner details if editing
    $getuserId = $this->input->post('editv');

    $data['banner_details'] = 0;
    if (!empty($bannnerId)) {
      $data['banner_details'] = $this->sqlQuery_model->sql_select_where('tbl_banner', array('banner_id' => $bannnerId, 'type' => 'ads'));
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Validate and sanitize inputs (you should implement validation)
      $text1 = $this->input->post('text1');
      $text2 = ''; // Example if you have another field
      $link = $this->input->post('link');
      $btn_status = $this->input->post('btn-status') ? 1 : 0; // Checkbox value

      if (!empty($_FILES['userfile']['name'])) {
        // Handle file upload
        $upload_path = 'uploads/banner';
        if (!is_dir($upload_path)) {
          mkdir($upload_path, 0777, TRUE);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);
        $desk_imgPath = '';

        // Attempt file  upload
        if ($this->upload->do_upload('userfile')) {
          $upload_data = $this->upload->data();
          $desk_imgPath = $upload_data['file_name'];
        } else {
          $data['upload_error'] = $this->upload->display_errors();
        }
      }


      // Prepare data to insert/update
      $dataToSave = array(
        'text1' => $text1,
        'text2' => $text2,
        'button_link' => $link,
        'btn_status' => $btn_status,
        'type' => 'ads'
      );

      if (!empty($_FILES['userfile']['name'])) {
        $dataToSave['desk_image'] = $desk_imgPath;
      }


      if (!empty($getuserId)) {
        $this->sqlQuery_model->sql_update('tbl_banner', $dataToSave, array('banner_id' => $getuserId));
      } else {
        // Insert new record
        $this->sqlQuery_model->sql_insert('tbl_banner', $dataToSave);
      }

      // Redirect after saving
      redirect(base_url('admin/ads_banner'));
    }

    // Load view with data
    $data['content'] = 'admin/containerPage/add_ads_banner';
    $this->load->view('admin/template', $data);
  }




  public function deleteRowtable()
  {
    $menuIdAsKey = 34;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $value = $this->input->post('value');
    $Responce = $this->sqlQuery_model->sql_delete('tbl_banner', array('banner_id' => $value));

    echo $Responce;
    exit();
  }













  public function home_testimonial()
  {
    $menuIdAsKey = 34;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $data['testinonial_list'] = $this->sqlQuery_model->sql_select('tbl_home_testimonial', 'position');


    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_home_testimonial', 'primary_key' => 'home_testi_id', 'update_target_column' => 'status');
    $data['deleteActionArr'] = array('table' => 'tbl_home_testimonial', 'primary_key' => 'home_testi_id');

    $data['content'] = 'admin/containerPage/home_testimonial';
    $this->load->view('admin/template', $data);
  }


  public function add_home_testinonial()
  {
    $menuIdAsKey = 34;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $getuserId = $this->uri->segment(3);
    $data['testi_details'] = 0;
    if ($getuserId != "") {
      $data['testi_details'] = $this->sqlQuery_model->sql_select_where('tbl_home_testimonial', array('home_testi_id' => $getuserId));
    }


    $data['content'] = 'admin/containerPage/add_home_testinonial';
    $this->load->view('admin/template', $data);
  }


  // terms_and_conditions
  // Terms of Service
  public function terms_of_service()
  {
    $menuIdAsKey = 35;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $data['policy_details'] = $this->sqlQuery_model->sql_select_where('tbl_policy', array('status' => 1));

    $data['fileName'] = 'terms_of_service';
    $data['content'] = 'admin/containerPage/terms_and_conditions';
    $this->load->view('admin/template', $data);
  }



  public function refund_and_cancelation_policy()
  {
    $menuIdAsKey = 36;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $data['policy_details'] = $this->sqlQuery_model->sql_select_where('tbl_policy', array('status' => 1));

    $data['fileName'] = 'refund_and_cancelation_policy';
    $data['content'] = 'admin/containerPage/refund_and_cancelation_policy';
    $this->load->view('admin/template', $data);
  }

  public function privacy_policy()
  {
    $menuIdAsKey = 37;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $data['policy_details'] = $this->sqlQuery_model->sql_select_where('tbl_policy', array('status' => 1));
    $data['fileName'] = 'privacy_policy';
    $data['content'] = 'admin/containerPage/privacy_policy';
    $this->load->view('admin/template', $data);
  }

  public function shipping_policy()
  {
    $menuIdAsKey = 38;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $data['policy_details'] = $this->sqlQuery_model->sql_select_where('tbl_policy', array('status' => 1));
    $data['fileName'] = 'shipping_policy';

    $data['content'] = 'admin/containerPage/shipping_policy';
    $this->load->view('admin/template', $data);
  }


  public function offer_banner()
  {

    $menuIdAsKey = 39;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $data['policy_details'] = $this->sqlQuery_model->sql_select_where('tbl_policy', array('status' => 1));
    // $data['fileName']='ads_banner';

    $data['ads_Banner'] = $this->sqlQuery_model->sql_select_where('tbl_ads_banner', array('status' => 1));

    $data['content'] = 'admin/containerPage/ads_banner';
    $this->load->view('admin/template', $data);
  }


  // public function add_coupon(){
  //  $data['content']='admin/containerPage/add_coupon';
  //  $this->load->view('admin/template',$data);
  // }


  public function child_category()
  {

    $menuIdAsKey = 1;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $getCatId = $this->uri->segment(3);
    $getSubCatId = $this->uri->segment(4);
    $data['subcategory_list'] = 0;

    if ($getSubCatId != "") {
      $data['subcategory_list'] = $this->sqlQuery_model->sql_select_where_desc('tbl_child_category', 'position', array('cat_id' => $getCatId, 'sub_cat_id' => $getSubCatId));
    }


    $getchildCatId = $this->uri->segment(5);
    $data['subCat_detaials'] = 0;

    if ($getSubCatId != "") {
      $data['childCat_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_child_category', array('child_cat_id' => $getchildCatId));
    }




    $data['deleteActionArr'] = array('table' => 'tbl_child_category', 'primary_key' => 'child_cat_id');
    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_child_category', 'primary_key' => 'child_cat_id', 'update_target_column' => 'status');

    $data['in_stock_active_inactive'] = array('table' => 'tbl_child_category', 'primary_key' => 'child_cat_id', 'update_target_column' => 'in_stock_status');

    $data['content'] = 'admin/containerPage/child_category';
    $this->load->view('admin/template', $data);
  }


  public function newsletter()
  {

    $menuIdAsKey = 40;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;



    $querys = "SELECT * FROM tbl_newsletter";
    $pr_list_count = $this->sqlQuery_model->sql_query($querys);
    $url_link = base_url('admin/newsletter');
    $limit_per_page = 10;
    $getVariable = $this->input->get('per_page');
    $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0) : 0;

    $total_records = ($pr_list_count != 0) ? count($pr_list_count) : 0;
    $config = createPagination($total_records, $url_link, $limit_per_page);
    $this->pagination->initialize($config);

    $sql_limit = 'LIMIT ' . $page * $limit_per_page . ',' . $limit_per_page;
    $querys = "SELECT * FROM tbl_newsletter ORDER BY newsletter_id DESC $sql_limit";
    $data['newSletter_list'] = $this->sqlQuery_model->sql_query($querys);
    $data["links"] = $this->pagination->create_links();


    // $data['ActiveInactive_ActionArr']=array('table'=>'tbl_newsletter','primary_key'=>'newsletter_id','update_target_column'=>'status');
    $data['deleteActionArr'] = array('table' => 'tbl_newsletter', 'primary_key' => 'newsletter_id');

    $data['content'] = 'admin/containerPage/newsletter';
    $this->load->view('admin/template', $data);
  }


  public function export_NewsletterList()
  {

    // file name
    $filename = 'newsletterSubscriptList_' . date('Y-m-d_h-i') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    $news_list = $this->sqlQuery_model->sql_select('tbl_newsletter', ' newsletter_id');
    $file = fopen('php://output', 'w');
    $header = array(
      "SerId",
      "Email",
      "Add Date"
    );
    fputcsv($file, $header);
    $l = array();
    foreach (array_reverse($news_list) as $key => $line) {
      $l['Ser_id'] = ($key + 1);
      $l['email'] = $line->email;
      $l['add_date'] = $line->add_date;
      fputcsv($file, $l);
    }

    fclose($file);
    exit;
  }


  public function faq()
  {

    $menuIdAsKey = 10;

    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $data['policy_details'] = $this->sqlQuery_model->sql_select_where('tbl_policy', array('status' => 1));
    $data['fileName'] = 'faq';

    $data['content'] = 'admin/containerPage/faq';
    $this->load->view('admin/template', $data);
  }

  public function disclaimer()
  {

    $menuIdAsKey = 12;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $data['policy_details'] = $this->sqlQuery_model->sql_select_where('tbl_policy', array('status' => 1));
    $data['fileName'] = 'disclaimer';

    $data['content'] = 'admin/containerPage/disclaimer';
    $this->load->view('admin/template', $data);
  }

  public function report()
  {

    $menuIdAsKey = 11;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $data['category_list'] = $this->sqlQuery_model->sql_select_where_desc('tbl_category', 'position', array('status' => 1));

    $data['customer_list'] = $this->sqlQuery_model->sql_select('tbl_customer', 'customer_id');
    $data['product_list'] = $this->sqlQuery_model->sql_select('tbl_product', 'product_id');

    $data['order_status'] = $this->sqlQuery_model->sql_select_where_desc('tbl_order_status', 'position', array('status' => 1));


    $querys = "SELECT * FROM tbl_reports_list WHERE status=1";
    $pr_list_count = $this->sqlQuery_model->sql_query($querys);
    $url_link = base_url('admin/report');
    $limit_per_page = 6;
    $getVariable = $this->input->get('per_page');
    $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0) : 0;

    $total_records = ($pr_list_count != 0) ? count($pr_list_count) : 0;
    $config = createPagination($total_records, $url_link, $limit_per_page);
    $this->pagination->initialize($config);

    $sql_limit = 'LIMIT ' . $page * $limit_per_page . ',' . $limit_per_page;
    $querys = "SELECT * FROM tbl_reports_list WHERE status=1 ORDER BY add_date DESC $sql_limit";
    $data['report_list'] = $this->sqlQuery_model->sql_query($querys);
    $data["links"] = $this->pagination->create_links();


    $data['deleteActionArr'] = array('table' => 'tbl_reports_list', 'primary_key' => 'report_id');
    $data['content'] = 'admin/containerPage/report';
    $this->load->view('admin/template', $data);
  }

  public function reportDownload()
  {
    $report_name = base64_decode(trim($this->input->get('rf')));
    $filename = $report_name . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    $session = $this->session->userdata('admin');

    $category_id = base64_decode(trim($this->input->get('c')));
    $sub_category_id = base64_decode(trim($this->input->get('sc')));
    $customer = base64_decode(trim($this->input->get('cus')));
    $product = base64_decode(trim($this->input->get('p')));
    $fromDate = base64_decode(trim($this->input->get('fd')));
    $toDate = base64_decode(trim($this->input->get('td')));
    $order_status = base64_decode(trim($this->input->get('os')));


    $where = "";
    if ($category_id != "") {
      $where .= " AND pro_cat_id =" . $category_id . "";
    }

    if ($sub_category_id != "") {
      $where .= " AND pro_sub_cat_id =" . $sub_category_id . "";
    }

    if ($customer != "") {
      $where .= " AND pro_cust_id =" . $customer . "";
    }

    if ($product != "") {
      $where .= " AND pro_sys_product_id =" . $product . "";
    }

    if ($fromDate != "" && $toDate != "") {
      $where .= " AND (pro_add_date >= '" . $fromDate . "' AND pro_add_date <='" . $toDate . "')";
    }

    if ($order_status != "") {
      $where .= " AND pro_order_status ='" . $order_status . "'";
    }


    $querys = "SELECT * FROM tbl_order_products WHERE pro_status=1 $where ORDER BY pro_add_date DESC";
    $order_product_list = $this->sqlQuery_model->sql_query($querys);


    $file = fopen('php://output', 'w');
    $header = array(
      "Ser No",
      "Order ID",
      "Customer Name",
      "Selling Price",
      "Quantity",
      "Sub Total",
      "IGST Rate",
      "IGST Amount",
      "CGST Rate",
      "CGST Amount",
      "SGST Rate",
      "SGST Amount",
      "Taxable Amount",

      "SKU ID",
      "Product Name",
      "Pack Size",
      "Units",
      "Weight(KG)",

      "Category Name",
      "Sub Category Name",

      "HSN Code",
      "Order Status",
      "Cancelled Reason",

      "Order Date"
    );


    fputcsv($file, $header);
    $l = array();
    $sellingAmount = 0;
    $subTotal = 0;
    $totalIGSTAmount = 0;
    $totalCGSTAmount = 0;
    $totalSGSTAmount = 0;
    $taxableAmount = 0;
    foreach ($order_product_list as $key => $line) {
      $custoD = $this->sqlQuery_model->sql_select_where('tbl_customer', array('customer_id' => $line->pro_cust_id));
      $nameCusr = getCustDetailsName($custoD[0]);

      $l['Ser_id'] = ($key + 1);
      $l['pro_generated_order_id'] = $line->pro_generated_order_id;
      $l['pro_cust_id'] = $nameCusr['name'];

      $l['pro_product_selling_price'] = $line->pro_product_selling_price;
      $l['pro_product_qty'] = $line->pro_product_qty;
      $l['pro_subtotal'] = $line->pro_subtotal;
      $l['pro_igst_rate'] = $line->pro_igst_rate;
      $l['pro_igst_amount'] = $line->pro_igst_amount;
      $l['pro_cgst_rate'] = $line->pro_cgst_rate;
      $l['pro_cgst_amount'] = $line->pro_cgst_amount;
      $l['pro_sgst_rate'] = $line->pro_sgst_rate;
      $l['pro_sgst_amount'] = $line->pro_sgst_amount;
      $l['pro_taxable_amount'] = $line->pro_taxable_amount;

      $l['pro_sku_id'] = $line->pro_sku_id;
      $l['pro_product_name'] = $line->pro_product_name;
      $l['packsize'] = $line->packsize;
      $l['units'] = $line->units;
      $l['pro_conversion_factor_kg'] = $line->pro_conversion_factor_kg;

      $l['pro_cat_name'] = $line->pro_cat_name;
      $l['pro_sub_cat_name'] = $line->pro_sub_cat_name;

      $l['pro_hsn_code'] = $line->pro_hsn_code;
      $l['pro_order_status'] = $line->pro_order_status;
      $l['pro_reason_disc'] = $line->pro_reason_disc;

      $l['pro_add_date'] = $line->pro_add_date;


      $sellingAmount += $line->pro_product_selling_price;
      $subTotal += $line->pro_subtotal;
      $totalIGSTAmount += $line->pro_igst_amount;
      $totalCGSTAmount += $line->pro_cgst_amount;
      $totalSGSTAmount += $line->pro_sgst_amount;
      $taxableAmount += $line->pro_taxable_amount;

      fputcsv($file, $l);
    }



    $final = array("", "Total : ", "", $sellingAmount, "", $subTotal, "", $totalIGSTAmount, "", $totalCGSTAmount, "", $totalSGSTAmount, $taxableAmount, "", "", "", "", "", "", "", "", "", "", "");

    fputcsv($file, $final);
    fclose($file);
    exit;
  }


  public function werehouse()
  {

    $menuIdAsKey = 42;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $getWHId = $this->uri->segment(3);
    $data['werehouse_detaials'] = 0;
    if ($getWHId != "") {
      $data['werehouse_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_werehouse', array('werehouse_id' => $getWHId));
    }

    $data['werehouse_list'] = $this->sqlQuery_model->sql_select('tbl_werehouse', 'position');

    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_werehouse', 'primary_key' => 'werehouse_id', 'update_target_column' => 'status');

    $data['in_stock_active_inactive'] = array('table' => 'tbl_werehouse', 'primary_key' => 'werehouse_id', 'update_target_column' => 'in_stock_status');

    $data['deleteActionArr'] = array('table' => 'tbl_werehouse', 'primary_key' => 'werehouse_id');

    $data['content'] = 'admin/containerPage/werehouse';
    $this->load->view('admin/template', $data);
  }


  public function pincode()
  {
    $menuIdAsKey = 41;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $querys = "SELECT * FROM tbl_delivery_pincode WHERE courier_type ='dtdc'";

    $pr_list_count = $this->sqlQuery_model->sql_query($querys);
    $url_link = base_url('admin/pincode');
    $limit_per_page = 10;
    $getVariable = $this->input->get('per_page');
    $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0) : 0;

    $total_records = ($pr_list_count != 0) ? count($pr_list_count) : 0;
    $config = createPagination($total_records, $url_link, $limit_per_page);
    $this->pagination->initialize($config);

    $sql_limit = 'LIMIT ' . $page * $limit_per_page . ',' . $limit_per_page;
    $querys = "SELECT * FROM tbl_delivery_pincode WHERE courier_type ='dtdc' ORDER BY pincode_id DESC $sql_limit";
    $data['pincode_list'] = $this->sqlQuery_model->sql_query($querys);
    $data["links"] = $this->pagination->create_links();


    $data['werehouse_list'] = $this->sqlQuery_model->sql_select_where('tbl_werehouse', array('status' => 1));

    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_delivery_pincode', 'primary_key' => 'pincode_id', 'update_target_column' => 'status');

    $data['deleteActionArr'] = array('table' => 'tbl_delivery_pincode', 'primary_key' => 'pincode_id');


    $data['content'] = 'admin/containerPage/pincode';
    $this->load->view('admin/template', $data);
  }


  public function add_pincode()
  {

    $menuIdAsKey = 41;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;


    $getPinId = $this->uri->segment(3);
    $data['pin_detaials'] = 0;
    if ($getPinId != "") {
      $data['pin_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_delivery_pincode', array('pincode_id' => $getPinId));
    }


    $data['werehouse_list'] = $this->sqlQuery_model->sql_select_where('tbl_werehouse', array('status' => 1));
    $data['courier_type'] = $this->sqlQuery_model->sql_select_where('courier_type', array('status' => 1));





    $data['content'] = 'admin/containerPage/add_pincode';
    $this->load->view('admin/template', $data);
  }


  public function werehouse_details()
  {
    $menuIdAsKey = 43;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    $getPinId = $this->uri->segment(3);
    $data['wh_detaials'] = 0;
    if ($getPinId != "") {
      $data['wh_detaials'] = $this->sqlQuery_model->sql_select_where('tbl_werehouse_details', array('wh_id' => $getPinId));
    }


    $data['werehouse_list'] = $this->sqlQuery_model->sql_select_where('tbl_werehouse', array('status' => 1));
    $data['statelist'] = $this->sqlQuery_model->sql_select_where('states', array('country_id' => 101));

    $data['wh_list'] = $this->sqlQuery_model->sql_select('tbl_werehouse_details', 'wh_id');

    $data['ActiveInactive_ActionArr'] = array('table' => 'tbl_werehouse_details', 'primary_key' => 'wh_id', 'update_target_column' => 'status');

    $data['deleteActionArr'] = array('table' => 'tbl_werehouse_details', 'primary_key' => 'wh_id');

    $data['content'] = 'admin/containerPage/werehouse_details';
    $this->load->view('admin/template', $data);
  }


  public function export_Pincode_CSV()
  {
    while (ob_get_level()) {
      ob_end_clean();
    }

    $file = fopen('php://output', 'w');
    // file name
    $filename = 'pincode_' . date('Y-m-d_h-i') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    $querys = "SELECT * FROM tbl_delivery_pincode WHERE courier_type ='dtdc'";
    $pincode_list = $this->sqlQuery_model->sql_query($querys);
    $header = array(
      "Pincode_Id",
      "Pincode",
      "City",
      "Werehouse Code",
      "Updated By",
      "Date",
      "Status"
    );
    fputcsv($file, $header);
    $l = array();

    foreach ($pincode_list as $key => $line) {

      $l['pincode_id'] = $line->pincode_id;
      $l['pincode'] = $line->pincode;
      $l['delivery_city'] = $line->delivery_city;
      $l['werehouse'] = $line->werehouse;
      $l['updated_by'] = $line->updated_by;
      $l['add_date'] = $line->add_date;
      $l['status'] = $line->status;

      fputcsv($file, $l);
    }

    fclose($file);
    exit;
  }


  public function importPincode_SVC()
  {

    $session = $this->session->userdata('admin');
    $data = array();
    if (!empty($_FILES['fileupload']['name'])) {
      // Set preference 
      $config['upload_path'] = 'uploads/pincode_csv/';
      $config['allowed_types'] = 'csv';
      $config['max_size'] = '1000000'; // max_size in kb 
      $config['file_name'] = $_FILES['fileupload']['name'];
      // Load upload library 
      $this->load->library('upload', $config);
      // File upload

      $werehouse_list = $this->sqlQuery_model->sql_select('tbl_werehouse', 'werehouse_id');
      $wh_code = array_column($werehouse_list, 'werehouse_code');

      $whcode = array();
      if ($werehouse_list != 0) {
        foreach ($wh_code as $key => $coluKey) {
          $whcode[] = end(explode('_', $coluKey));
        }
      }
      if ($this->upload->do_upload('fileupload')) {
        // Get data about the file
        $uploadData = $this->upload->data();
        $filename = $uploadData['file_name'];
        // Reading file
        $file = fopen("uploads/pincode_csv/" . $filename, "r");
        $i = 0;
        $numberOfFields = 7; // Total number of fields
        // $importData_arr = array();

        $tableHeader = array(
          'pincode',
          'delivery_city',
          'werehouse',
          'updated_by',
          'add_date',
          'status'
        );

        $getarrPost = array();
        $counter = 0;
        while (($filedata = fgetcsv($file, 21500, ",")) !== FALSE) {

          $counter++;
          if ($counter != 1) {


            $whcode_field3 = explode(',', $filedata[3]);
            $diffValue =  array_diff(array_map('trim', $whcode_field3), $whcode);



            if ($diffValue != array()) {
              $data['status'] = 0;
              $data['response'] = 'Invalid werehouse code. Pincode ID : ' . $filedata[0];
              echo json_encode($data);
              exit;
            }


            $arr['pincode_id'] = $filedata[0];
            $arr['pincode'] = trim($filedata[1]);
            $arr['delivery_city'] = trim($filedata[2]);
            $arr['werehouse'] = trim($filedata[3]);
            $arr['updated_by'] = trim($session['admin_name']);
            $arr['add_date'] = trim($filedata[5]);
            $arr['status'] = trim($filedata[6]);
            array_push($getarrPost, $arr);
          }
        }

        fclose($file);

        if ($getarrPost != array()) {

          foreach ($getarrPost as $key => $vvalue) {

            $arrPost['pincode'] = trim($vvalue['pincode']);
            $arrPost['delivery_city'] = trim($vvalue['delivery_city']);
            $arrPost['werehouse'] = trim($vvalue['werehouse']);
            $arrPost['updated_by'] = trim($vvalue['updated_by']);
            $arrPost['add_date'] = ($vvalue['add_date'] != "") ? date('Y-m-d h:i:s', strtotime($vvalue['add_date'])) : date('Y-m-d h:i:s');
            $arrPost['status'] = trim($vvalue['status']);


            if ($vvalue['pincode_id'] == "") {
              $this->sqlQuery_model->sql_insert('tbl_delivery_pincode', $arrPost);
            } else {
              $this->sqlQuery_model->sql_update('tbl_delivery_pincode', $arrPost, array('courier_type' => 'dtdc', 'pincode_id' => $vvalue['pincode_id']));
            }
          }

          $data['response'] = 'Successfully uploaded.';
          $data['status'] = 1;
          echo json_encode($data);
          exit;
        } else {
          $data['response'] = 'Failed to upload data.';
          $data['status'] = 0;
          echo json_encode($data);
          exit;
        }
      } else {
        $data['response'] = 'Failed to upload data.';
        $data['status'] = 0;
        echo json_encode($data);
        exit;
      }
    } else {
      $data['response'] = 'Select your uploading file.';
      $data['status'] = 0;
      echo json_encode($data);
      exit;
    }
  }


  //Mamange Other Product

  public function otherProduct()
  {
    $this->load->library('pagination');

    $menuIdAsKey = 44;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    // Count total records
    $query = "SELECT COUNT(*) as count FROM tbl_other_product";
    $pr_list_count = $this->sqlQuery_model->sql_query($query);
    $total_records = ($pr_list_count) ? $pr_list_count[0]->count : 0;

    // Pagination configuration
    $limit_per_page = 10;
    $url_link = base_url('admin/otherProduct');

    $config = [
      "base_url" => $url_link,
      "total_rows" => $total_records,
      "per_page" => $limit_per_page,
      "uri_segment" => 3,
      "num_links" => 5, // Number of links to show in pagination
      "full_tag_open" => '<ul class="pagination">',
      "full_tag_close" => '</ul>',
      "first_link" => 'First',
      "first_tag_open" => '<li class="paginate_button page-item page-link"><a href="#">',
      "first_tag_close" => '</a></li>',
      "last_link" => 'Last',
      "last_tag_open" => '<li class="paginate_button page-item page-link"><a href="#">',
      "last_tag_close" => '</a></li>',
      "next_link" => 'Next',
      "next_tag_open" => '<li class="paginate_button page-item page-link"><a href="#">',
      "next_tag_close" => '</a></li>',
      "prev_link" => 'Previous',
      "prev_tag_open" => '<li class="paginate_button page-item page-link"><a href="#">',
      "prev_tag_close" => '</a></li>',
      "cur_tag_open" => '<li class="paginate_button page-item active"><a href="#" class="page-link">',
      "cur_tag_close" => '</a></li>',
      "num_tag_open" => '<li class="paginate_button page-item page-link">',
      "num_tag_close" => '</li>'
    ];

    $this->pagination->initialize($config);

    // Get current page number
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    // SQL limit for pagination
    $offset = $page;
    $query = "SELECT P.product_id, P.product_name, OP.other_product_id, OP.product_type_id
              FROM tbl_product AS P
              INNER JOIN tbl_other_product AS OP ON P.product_id = OP.product_id
              ORDER BY P.product_id DESC
              LIMIT $offset, $limit_per_page";

    $data['productList'] = $this->sqlQuery_model->sql_query($query);
    $data['pagination'] = $this->pagination->create_links();
    $data['content'] = 'admin/other_product/index';

    $this->load->view('admin/template', $data);
  }








  public function Edit_other_product()
  {

    $this->load->view('admin/other_product/edit');
  }










  public function delete_Other_Product()
  {

    $menuIdAsKey = 44;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;
    $id = $this->input->post('id');

    $response = $this->sqlQuery_model->sql_delete('tbl_other_product', array('product_id' => $id));
    if ($response == '1') {

      $Flag = 'True';
    } else {
      $Flag = 'False';
    }
    echo json_encode($Flag);
    exit();
    redirect('admin/other-product');
  }










  public function addOtherProduct()
  {
    // Check user authorization
    $menuIdAsKey = 44;
    $data['getAccess'] = $this->my_libraries->userAthorizetion($menuIdAsKey);
    $data['page_menu_id'] = $menuIdAsKey;

    // Load product list for the form
    $querys = "SELECT product_id, product_name FROM tbl_product WHERE status=1";
    $data['productList'] = $this->sqlQuery_model->sql_query($querys);

    // Check if the form is submitted
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
      // Get form data
      $product_type_id = $this->input->post('product_type_id');
      $product_ids = $this->input->post('product_id');

      // Validate the inputs
      if (empty($product_type_id) || empty($product_ids)) {
        $this->session->set_flashdata('error', 'All fields are required.');
        redirect('admin/other-product');
        return;
      }

      // Insert each product ID into the database
      foreach ($product_ids as $product_id) {
        $insert_data = [
          'product_type_id' => $product_type_id,
          'product_id' => $product_id,
          'add_date' => date('Y-m-d H:i:s'),
          'updated_by' => $this->session->userdata('admin_id')
        ];

        // Insert the data
        $this->db->insert('tbl_other_product', $insert_data);
      }

      // Set success message and redirect
      $this->session->set_flashdata('success', 'Products added successfully.');
      redirect('admin/other-product');
      return;
    }
    $data['content'] = 'admin/other_product/add';
    $this->load->view('admin/template', $data);
  }
}
