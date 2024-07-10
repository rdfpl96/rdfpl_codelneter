<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Common extends CI_Controller {

    function __construct(){
         parent::__construct();

        $this->load->model('product_model','productObj');
        $this->load->model('customer_model','custObj');  
        $this->load->model('sqlQuery_model');
        $this->load->model('common_model');
        $this->load->model('home_model','home');
        $this->load->library('my_libraries');
        $this->load->library('customlibrary');
    }

public function shipping_address_save() {
    $customer = $this->my_libraries->mh_getCookies('customer');
    $customer_id = $customer['customer_id'];
 
    // Check if customer ID is being retrieved correctly
    if (empty($customer_id)) {
        echo json_encode(array('status' => 'fail', 'message' => 'Customer ID not found'));
        return;
    }
 
    $data = array(
        'customer_id' => $customer_id,
        'fname' => $this->input->post('fname'),
        'lname' => $this->input->post('lname'),
        'mobile' => $this->input->post('mobile'),
        'address1' => $this->input->post('apart_house'),
        'address2' => $this->input->post('apart_name'),
        'area' => $this->input->post('area'),
        'landmark' => $this->input->post('street_landmark'),
        'state' => $this->input->post('state'),
        'city' => $this->input->post('city'),
        'pincode' => $this->input->post('pincode'),
        'address_type' => $this->input->post('loc_type'),
        'others' => $this->input->post('other_loc')
    );
 
    // Log data for debugging
    log_message('debug', 'Shipping address data: ' . print_r($data, true));
 
    $insert = $this->common_model->insert_address($data);
 
    if ($insert) {
        $response = array('status' => 'success');
    } else {
        $response = array('status' => 'fail', 'message' => 'Database insert failed');
    }
 
    echo json_encode($response);
}

  public function getSubCategoryTopId($top_cat_id=""){

    $subcategory=$this->customlibrary->getSubCategoryByCatId($top_cat_id);

    echo json_encode(array('subcategories'=>$subcategory));
    exit();
    
  }

  public function getChildDataBySubCatId($top_cat_id="",$sub_cat_id=""){

    $subcategory=$this->customlibrary->getChilCategory($top_cat_id,$sub_cat_id);

    echo json_encode(array('chilcategories'=>$subcategory));
    exit();
    
  }

  public function productSearch(){
    $pkeyword=isset($_POST['pkeyword']) && $_POST['pkeyword']!='' ? $_POST['pkeyword'] : "nodata" ;

    $products=$this->productObj->searchProductByKeyword($pkeyword);

    $phrml=$this->load->view('frontend/component/header_search_bar',array('products'=>$products),true);
    
    echo json_encode(array('data'=>$phrml));
    exit();
    }

    public function selectAddress(){
        $address_id=isset($_POST['address_id']) && $_POST['address_id']!='' ? $_POST['address_id'] : "" ;

    }
//previous code
//   public function addNewAddress(){
//     $error =0;
//     if($this->input->is_ajax_request()){

//         $form_detail=$_POST;
//         $userCookies=getCookies('customer');
//         //$userCookies['customer_id']

//           $nv = array(
           
//             'customer_id'           => $userCookies['customer_id'],
//             'fname'                 => isset($form_detail['fname'])                 && $form_detail['fname'] != ''                   ? addslashes($form_detail['fname'])                :  "",
//             'mobile'                => isset($form_detail['mobile'])                && $form_detail['mobile'] != ''                  ? addslashes($form_detail['mobile'])               :  "",
//             'email'                 => isset($form_detail['email'])                 && $form_detail['email'] != ''                   ? addslashes($form_detail['email'])                :  "",
//             'address1'              => isset($form_detail['address1'])              && $form_detail['address1'] != ''                ? addslashes($form_detail['address1'])             :  "",
//             'address2'              => isset($form_detail['address2'])              && $form_detail['address2'] != ''                ? addslashes($form_detail['address2'])             :  "",
//             'landmark'              => isset($form_detail['landmark'])              && $form_detail['landmark'] != ''                ? addslashes($form_detail['landmark'])             :  "",
//             'area'                  => isset($form_detail['area'])                  && $form_detail['area'] != ''                    ? addslashes($form_detail['area'])                 :  "",
//             'state_id'              => isset($form_detail['state_id'])              && $form_detail['state_id'] != ''                ? addslashes($form_detail['state_id'])             :  "",
//             'city'                  => isset($form_detail['city'])                  && $form_detail['city'] != ''                    ? addslashes($form_detail['city'])                 :  "",
//             'address_type'          => isset($form_detail['address_type'])          && $form_detail['address_type'] != ''            ? addslashes($form_detail['address_type'])         :  "",
//             'setAddressDefault'     => isset($form_detail['setAddressDefault'])     && $form_detail['setAddressDefault'] != ''       ? addslashes($form_detail['setAddressDefault'])    :  0,
//             'pincode'               => isset($form_detail['pincode'])               && $form_detail['pincode'] != ''                 ? addslashes($form_detail['pincode'])              :  "",
//             );

//         if ($nv['fname'] == ''){
//             $error = '1';
//             $error_tag='er_fname';
//             $err_msg = "Please enter your name.";
//         }
//         else if(!preg_match('/^[\p{L} ]+$/u', $nv['fname'])){
//             $error = '1';
//             $error_tag='er_name';
//             $err_msg = "Name must contain letters and spaces only";
//         }
//         else if($nv['mobile'] == ''){
//             $error = '1';
//             $error_tag='er_name';
//             $err_msg = "Please enter mobile";
//         }
       
//         else if ( strlen($nv['mobile'])!==10) { 
//             $error = '1';
//             $error_tag='er_mobile';
//             $err_msg = "Mobile must have 10 digits";
//         }
//         else if($nv['email'] == ''){
//             $error = '1';
//             $error_tag='er_email';
//             $err_msg = "Please enter valid email";
//         }

//         else if ($nv['email'] != '' && !filter_var($nv['email'], FILTER_VALIDATE_EMAIL) ){
//             $error = '1';
//             $error_tag='er_email';
//             $err_msg = "Please enter valid email Id";
//         }
//         else if ($nv['address1'] == ''){
//             $error = '1';
//             $error_tag='er_address1';
//             $err_msg = "Please enter house no.";
//         }
//         else if ($nv['address2'] == ''){
//             $error = '1';
//             $error_tag='er_address2';
//             $err_msg = "Please enter Apartment name";
//         }
//         else if ($nv['landmark'] == ''){
//             $error = '1';
//             $error_tag='er_landmark';
//             $err_msg = "Please enter landmark";
//         }
//         else if ($nv['area'] == ''){
//             $error = '1';
//             $error_tag='er_area';
//             $err_msg = "Please enter area";
//         }
//         else if ($nv['state_id'] == ''){
//             $error = '1';
//             $error_tag='er_state_id';
//             $err_msg = "Please select state";
//         }
//         else if ($nv['city'] == ''){
//             $error = '1';
//             $error_tag='er_city';
//             $err_msg = "Please enter city name";
//         }
//         else if ($nv['address_type'] == ''){
//             $error = '1';
//             $error_tag='er_address_type';
//             $err_msg = "Please select address type";
//         }
//         else if ($nv['pincode'] == ''){
//             $error = '1';
//             $error_tag='er_pincode';
//             $err_msg = "Please select address type";
//         }
//         else if (strlen($nv['pincode'])!==6){
//             $error = '1';
//             $error_tag='er_pincode';
//             $err_msg = "Pincod must have 6 digits";
//         }

//         else if($this->custObj->addressPincodeAlreadyExist($nv['pincode'],$userCookies['customer_id'])){
//             $error = '1';
//             $error_tag='er_pincode';
//             $err_msg = "Pincod must have 6 digits";
//         }

//         else{
            
//             if($this->custObj->addressSave($nv)) {
               
//                 $error=0;
//                 $err_msg="succes";
//             }   
//         }

//         $response= array('error' => $error, 'err_msg' => $err_msg);
//     }else{
//         $response= array('error' =>2, 'err_msg' =>"Method not allowed");
//     }

//     echo json_encode($response);
//     exit();

//   }

//new code by Aarti
public function addNewAddress() {
    $error = 0;
    if ($this->input->is_ajax_request()) {

        $form_detail = $_POST;
        $userCookies = getCookies('customer');

        // Get the address type and handle "Other" case
        $address_type = isset($form_detail['address_type']) && $form_detail['address_type'] == 'Other' ? $form_detail['other_address_type'] : $form_detail['address_type'];

        $nv = array(
            'customer_id'           => $userCookies['customer_id'],
            'fname'                 => isset($form_detail['fname']) && $form_detail['fname'] != '' ? addslashes($form_detail['fname']) : "",
            'mobile'                => isset($form_detail['mobile']) && $form_detail['mobile'] != '' ? addslashes($form_detail['mobile']) : "",
            'email'                 => isset($form_detail['email']) && $form_detail['email'] != '' ? addslashes($form_detail['email']) : "",
            'address1'              => isset($form_detail['address1']) && $form_detail['address1'] != '' ? addslashes($form_detail['address1']) : "",
            'address2'              => isset($form_detail['address2']) && $form_detail['address2'] != '' ? addslashes($form_detail['address2']) : "",
            'landmark'              => isset($form_detail['landmark']) && $form_detail['landmark'] != '' ? addslashes($form_detail['landmark']) : "",
            'area'                  => isset($form_detail['area']) && $form_detail['area'] != '' ? addslashes($form_detail['area']) : "",
            'state_id'              => isset($form_detail['state_id']) && $form_detail['state_id'] != '' ? addslashes($form_detail['state_id']) : "",
            'city'                  => isset($form_detail['city']) && $form_detail['city'] != '' ? addslashes($form_detail['city']) : "",
            'address_type'          => $address_type,
            'setAddressDefault'     => isset($form_detail['setAddressDefault']) && $form_detail['setAddressDefault'] != '' ? addslashes($form_detail['setAddressDefault']) : 0,
            'pincode'               => isset($form_detail['pincode']) && $form_detail['pincode'] != '' ? addslashes($form_detail['pincode']) : "",
        );

        // Validation checks
        if ($nv['fname'] == '') {
            $error = '1';
            $error_tag = 'er_fname';
            $err_msg = "Please enter your name.";
        } else if (!preg_match('/^[\p{L} ]+$/u', $nv['fname'])) {
            $error = '1';
            $error_tag = 'er_name';
            $err_msg = "Name must contain letters and spaces only";
        } else if ($nv['mobile'] == '') {
            $error = '1';
            $error_tag = 'er_name';
            $err_msg = "Please enter mobile";
        } else if (strlen($nv['mobile']) !== 10) {
            $error = '1';
            $error_tag = 'er_mobile';
            $err_msg = "Mobile must have 10 digits";
        } else if ($nv['email'] == '') {
            $error = '1';
            $error_tag = 'er_email';
            $err_msg = "Please enter valid email";
        } else if ($nv['email'] != '' && !filter_var($nv['email'], FILTER_VALIDATE_EMAIL)) {
            $error = '1';
            $error_tag = 'er_email';
            $err_msg = "Please enter valid email Id";
        } else if ($nv['address1'] == '') {
            $error = '1';
            $error_tag = 'er_address1';
            $err_msg = "Please enter house no.";
        } else if ($nv['address2'] == '') {
            $error = '1';
            $error_tag = 'er_address2';
            $err_msg = "Please enter Apartment name";
        } else if ($nv['landmark'] == '') {
            $error = '1';
            $error_tag = 'er_landmark';
            $err_msg = "Please enter landmark";
        } else if ($nv['area'] == '') {
            $error = '1';
            $error_tag = 'er_area';
            $err_msg = "Please enter area";
        } else if ($nv['state_id'] == '') {
            $error = '1';
            $error_tag = 'er_state_id';
            $err_msg = "Please select state";
        } else if ($nv['city'] == '') {
            $error = '1';
            $error_tag = 'er_city';
            $err_msg = "Please enter city name";
        } else if ($nv['pincode'] == '') {
            $error = '1';
            $error_tag = 'er_pincode';
            $err_msg = "Please enter pincode";
        } else if (strlen($nv['pincode']) !== 6) {
            $error = '1';
            $error_tag = 'er_pincode';
            $err_msg = "Pincode must have 6 digits";
        } else if ($this->custObj->addressPincodeAlreadyExist($nv['pincode'], $userCookies['customer_id'])) {
            $error = '1';
            $error_tag = 'er_pincode';
            $err_msg = "Pincode already exists";
        } else {
            $lastId=$this->custObj->addressSave($nv);
            if($lastId) {
                if($nv['setAddressDefault']==1){

                   $this->custObj->setDefaultAddressByCust($lastId,$userCookies['customer_id']); 
                }
                $error = 0;
                $err_msg = "Address saved successfully";
            }
        }

        $response = array('error' => $error, 'err_msg' => $err_msg);
    } else {
        $response = array('error' => 2, 'err_msg' => "Method not allowed");
    }

    echo json_encode($response);
    exit();
}

public function my_account() {
    $user = $this->my_libraries->mh_getCookies('customer');
    if (!empty($user) && isset($user['customer_id'])) {
        $customer_id = $user['customer_id'];
        $data['customer_details'] = $this->sqlQuery_model->sql_select_where('tbl_customer', array('customer_id' => $customer_id));
        //print_r($data);
        $data['content'] = 'frontend/component/my_account';
        $this->load->view('frontend/template', $data);
    } else {
        redirect(base_url(), 'refresh');
    }
}

public function alert_notification(){
        $data['content']='frontend/component/alert_notification';
        $this->load->view('frontend/template',$data);

    }  

public function my_payments(){
        $data['content']='frontend/component/my_payments';
        $this->load->view('frontend/template',$data);
    }

public function my_gift_cards(){
        $data['content']='frontend/component/my_gift_cards';
        $this->load->view('frontend/template',$data);
    }  
    
public function customer_service(){
        $data['content']='frontend/component/customer_service';
        $this->load->view('frontend/template',$data);
    }
    
public function my_past_oders(){
        $data['content']='frontend/component/my_past_oders';
        $this->load->view('frontend/template',$data);
    }    
    
public function smart_basket(){
        $smartBasketProdct=$this->home->getProductType(1);
        //print_r($smartBasketProdct);
        $data['smartBasketProdct'] = $smartBasketProdct;
        $data['content']='frontend/component/smart_basket';
        $this->load->view('frontend/template',$data);
    }     
public function my_order() {
    // Fetch customer data from session
    $user = $this->my_libraries->mh_getCookies('customer');
    
    if ($user && isset($user['customer_id']) && !empty($user['customer_id'])) {
        $customer_id = (int)$user['customer_id'];

        // Load the model
        $this->load->model('Common_model');
        $data['getOrders'] = $this->common_model->getCustomerOrders($customer_id);
        // echo '<pre>';
        // print_r($data);
        // exit;
        $data['order_count'] = ($data['getOrders'] != 0) ? count($data['getOrders']) : 0;

        // Load the view with the order data
        $data['content'] = 'frontend/component/my-order';
        $this->load->view('frontend/template', $data);

    } else {
        // If user is not logged in, redirect to the home page
        redirect(base_url(), 'refresh');
    }
}

public function my_address(){
    $user=$this->my_libraries->mh_getCookies('customer');
    if ($user && isset($user['customer_id']) && !empty($user['customer_id'])){
        $customer_id = $user['customer_id'];
       
       $data['billingAddress']=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id' => $customer_id,'address_type'=>'billingAddress'));


         $shipAddr=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id' => $customer_id));
         $where['status']=1;
         $where['customer_id']=$customer_id;
         $where_and_chain=queryChain($where);

         // $pr_list_count=$shipAddr;
         // $url_link=base_url('my-address/'); 
         // $limit_per_page = 6;
         // $getVariable=$this->input->get('per_page');
         // $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0 ) : 0;
         // $total_records = ($pr_list_count!=0) ? count($pr_list_count) : 0;
         // $config=createPaginationProduct($total_records,$url_link,$limit_per_page);
         // $this->pagination->initialize($config);
         // $sql_limit='LIMIT '.$page*$limit_per_page.','.$limit_per_page;
         $sql_limit='LIMIT 6';
         $data['address']=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_address WHERE $where_and_chain ORDER BY `addr_id` DESC $sql_limit");
         // $data["links"] = $this->pagination->create_links();

         
          if($data['billingAddress']!=0){

                foreach($data['billingAddress'] as $value){

                     $name = ucfirst($value->fname).' '.ucfirst($value->lname);
                     $getArr=array(
                           'address1' =>$value->address1,
                           'address2' =>$value->address2,
                           'area'=>$value->area,
                           'landmark'=>$value->landmark,
                           'city'   =>$value->city,
                           'state'  =>$value->state,
                           'pincode' =>$value->pincode
                      ) ;

                     $importValue=implode(', ', $getArr);
                     $data['getAddr']=(($value->nick_name !="") ? (($value->nick_name=='Other') ? $value->others : $value->nick_name).' - ' :'').$importValue;

                     $data['delnames']=$name;
                }

          }else{
            $data['getAddr']='';
            $data['delnames']='';
          }

      
      $data['shippingAddress_defualt']=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id' => $customer_id,'setAddressDefault'=>1));


            if($data['shippingAddress_defualt']!=0){

                foreach($data['shippingAddress_defualt'] as $value){

                     $getArr=array(
                           'address1' =>$value->address1,
                           'address2' =>$value->address2,
                           'area'=>$value->area,
                           'landmark'=>$value->landmark,
                           'city'   =>$value->city,
                           'state'  =>$value->state,
                           'pincode' =>$value->pincode
                      ) ;

                     $importValue=implode(', ', $getArr);
                     $data['getshippAddr']=(($value->nick_name !="") ? (($value->nick_name=='Other') ? $value->others : $value->nick_name).' - ' :'').$importValue;
                }
          }else{
            $data['getshippAddr']='';
          }



        $data['gstDetail']=$this->customlibrary->getCustomerGstDetailId();  
        $data['cusotmer_details']=$this->sqlQuery_model->sql_select_where('tbl_customer',array('customer_id' => $customer_id));
         //print_r($data); 
        $data['content']='frontend/component/my_address';
        $this->load->view('frontend/template',$data);

    }else{
       redirect(base_url(), 'refresh');
    }

 }
 
public function add_address(){
         $user=$this->my_libraries->mh_getCookies('customer');
         if($user!=""){

          $conutry=101;
          $data['shipp_address']=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$user[0]->customer_id,'addr_id'=>$this->input->get('adr')));
            
          $data['pageType']='add-address';  
          $data['status']=$this->sqlQuery_model->sql_select_where('states',array('country_id'=>$conutry));
          $querys ="select name from cities where state_id=2";
          $data['cities'] = $this->sqlQuery_model->sql_query($querys);
          $data['content']='frontend/component/add_address';
           $this->load->view('frontend/template',$data);

        }else{
        redirect(base_url(), 'refresh');
         }

    }
    
// add new changes related to bug sheet
public function add_user_details() {
    $user = $this->my_libraries->mh_getCookies('customer');
    $firstname = $this->input->post('firstname');
    $lastname = $this->input->post('lastname');
    $mobilename = $this->input->post('mobilename');
    $emailAddress = $this->input->post('emailAddress');
    $password = $this->input->post('password');
    $city = $this->input->post('city');
    $state = $this->input->post('state');
    $country = $this->input->post('country');
    $oldmobilename = $this->input->post('oldmobilename');
    $oldemailAddress = $this->input->post('oldemailAddress');
    $old_password = $this->input->post('old_password');

    // Check if email address is being changed and if it already exists
    // if ($oldemailAddress != $emailAddress) {
    //     $getExitEmail = $this->sqlQuery_model->sql_select_where('tbl_customer', array('email' => $emailAddress));
    //     if ($getExitEmail != 0) {
    //         $data['status'] = 0;
    //         $data['message'] = "Email ID Already exists. Please choose another email id.";
    //         echo json_encode($data);
    //         return;
    //     }
    // }

    // Check if mobile number is being changed and if it already exists
    if ($oldmobilename != $mobilename) {
        $getExitMobile = $this->sqlQuery_model->sql_select_where('tbl_customer', array('mobile' => $mobilename));
        if ($getExitMobile != 0) {
            $data['status'] = 0;
            $data['message'] = "Mobile Number Already exists. Please choose another mobile number.";
            echo json_encode($data);
            return;
        }
    }

    $postArr = array(
        'c_fname' => $firstname,
        'c_lname' => $lastname,
        'mobile' => $mobilename,
        'email' => $emailAddress,
        'password' => (!empty($password)) ? md5($password) : $old_password,
        'city' => $city,
        'state' => $state,
        'country' => $country
    );

    $customer_id = $user['customer_id'];
    $post_sql = $this->sqlQuery_model->sql_update('tbl_customer', $postArr, array('customer_id' => $customer_id));

    if ($post_sql) {
        $data['status'] = 1;
        $data['message'] = "Data updated successfully";
    } else {
        $data['status'] = 0;
        $data['message'] = "Failed to Update";
    }

    echo json_encode($data);
}

public function billing_address(){
    $user=$this->my_libraries->mh_getCookies('customer');
    if ($user && isset($user['customer_id']) && !empty($user['customer_id'])){
    $customer_id = $user['customer_id'];
    $conutry=101;
    $data['status']=$this->sqlQuery_model->sql_select_where('states',array('country_id'=>$conutry)); 
      
       $data['billingAddress']=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id' => $customer_id,'address_type'=>'billingAddress'));

       // echo "<pre>";
       // print_r($data['billingAddress']);
       // echo "<pre>";

       if($data['billingAddress']!=0){

                foreach($data['billingAddress'] as $value){

                     $name = ucfirst($value->fname).' '.ucfirst($value->lname);
                     $getArr=array(
                           'address1' =>$value->address1,
                           'address2' =>$value->address2,
                           'area'=>$value->area,
                           'landmark'=>$value->landmark,
                           'city'   =>$value->city,
                           'state'  =>$value->state,
                           'pincode' =>$value->pincode
                      ) ;

                     $importValue=implode(', ', $getArr);
                     $data['getAddr']=(($value->nick_name !="") ? (($value->nick_name=='Other') ? $value->others : $value->nick_name).' - ' :'').$importValue;

                     $data['delnames']=$name;
                }
          }else{
            $data['getAddr']='';
            $data['delnames']='';
          }
    
    
    $data['pageType']='billing-address';
    $data['content']='frontend/component/billing_address';
    $this->load->view('frontend/template',$data);

    }else{
        redirect(base_url(), 'refresh');
    }
}

public function add_billingaddress(){
//echo "hjahskjd";
        
    $user=$this->my_libraries->mh_getCookies('customer');
    $customer_id = $user['customer_id'];
    if ($user && isset($user['customer_id']) && !empty($user['customer_id'])){
       $data['status']=0;
       $data['message']="Please Login your account.";
       echo json_encode($data);
       exit;
     }

     $apart_house=$this->input->post('apart_house');
     $apart_name=$this->input->post('apart_name');
     $area=$this->input->post('area');
     $street_landmark=$this->input->post('street_landmark');
     $fname=$this->input->post('fname');
     $lname=$this->input->post('lname');
     $mobile1=$this->input->post('mobile');

     // $conutry=$this->input->post('conutry');
     $state=$this->input->post('state');
     $city=$this->input->post('city');
     $pincode=$this->input->post('pincode');
     // $address1=$this->input->post('address1');

     // $address2=$this->input->post('address2');
     // $landmark=$this->input->post('landmark');
     // $company=$this->input->post('company');
     // $fname=$this->input->post('fname');
     // $lname=$this->input->post('lname');
     // $mobile1=$this->input->post('mobile1');
     // $mobile2=$this->input->post('mobile2');

     // $email=$this->input->post('email');
     $loc_type=$this->input->post('loc_type');
     $other_loc=$this->input->post('other_loc');
   
    $address_id=$this->input->post('addre_id');

     // if($loc_type=="Other"){
     //   $nickname_n=$input_nick_name;
     //   $nickname=$nick_name;
     // }else{
     //   $nickname=$nick_name;
     //   $nickname_n="";
     // }


       // $takeWay='';
       // $actionType=1;
       // $columsName=$this->my_libraries->deliveryTypeDisplayProduct($pincode,$takeWay,$actionType);
    
       //  if($columsName[0]==""){
       //     $data['status']=0;
       //     $data['message']=$this->config->item('pincode_not_found');
       //     echo json_encode($data);
       //     exit;
       // }else{
       //   $session = array('value' =>$pincode,'location'=>$columsName[1]);
       //   $this->my_libraries->setLocationPinforUser($session,$user);
       //   $this->session->set_userdata('dlivetype',1);
       //   $this->session->set_userdata('valueType',$session);
       // }
       
     $conutry=101;
      $postArr=array(
                    'country_id'=>$conutry,
                    'country' =>$this->my_libraries->getCountry_name($conutry),
                    'state_id' =>$state,
                    'state' =>$this->my_libraries->getState_name($state),
                    'city_id' =>$city,
                    'city' =>$this->my_libraries->getCity_name($city),
                    'address1' =>$apart_house,
                    'address2' =>$apart_name,
                    'area'=>$area,
                    'pincode' =>$pincode,
                    'landmark' =>$street_landmark,
                    // 'company_name' =>$company,
                    'fname' =>$fname,
                    'lname' =>$lname,
                    'mobile1' =>$mobile1,
                    // 'mobile2' =>$mobile2,
                    // 'email'  =>$email,
                    'nick_name'  =>$loc_type,
                    'others'=>$other_loc
                    );
       // print_r($postArr);            

             if($address_id==""){

                $postArr['customer_id']=array('customer_id' => $customer_id);
                $postArr['address_type']=$this->input->post('add_type');
                $postSql=$this->sqlQuery_model->sql_insert('tbl_address',$postArr);

                 $getinsertId=$this->sqlQuery_model->get_last_inset_id('tbl_address');
                 $row_sql_update=$this->my_libraries->setDefaultAddressOnupdate(array('customer_id' => $customer_id,$getinsertId));

                      if($postSql){
                          $data['status']=1;
                          $data['message']="Address added successfully";
                          echo json_encode($data);
                          exit;
                       }else{
                          $data['status']=0;
                          $data['message']="Failed to added";
                          echo json_encode($data);
                          exit;
                       }
               
             }else{

               
                  $updateSql=$this->sqlQuery_model->sql_update('tbl_address',$postArr,array('addr_id'=>$address_id));

                   if($updateSql){
                      $data['status']=1;
                      $data['message']="Address updated successfully";
                      echo json_encode($data);
                      exit;
                   }else{
                      $data['status']=0;
                      $data['message']="Failed to update";
                      echo json_encode($data);
                      exit;
                   }
             }
           
}




public function email_addresses() {
    $user = $this->my_libraries->mh_getCookies('customer');
    $customer_id = !empty($user) && isset($user['customer_id']) ? $user['customer_id'] : null;

    if ($customer_id) {
        $data['querys'] = $this->common_model->get_email_addresses($customer_id);
        // print_r($data);
        // exit();
        $data['content'] = 'frontend/component/email_addresses';
        $this->load->view('frontend/template', $data);
    } 
}

// public function add_account_email() {
//     $response = array('status' => 0, 'message' => 'An error occurred');
//     $email = $this->input->post('email');
//     $user = $this->my_libraries->mh_getCookies('customer');
//     $customer_id = !empty($user) && isset($user['customer_id']) ? $user['customer_id'] : null;

//     if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) && $customer_id) {
//         $data = array(
//             'customer_id' => $customer_id,
//             'email' => $email
//         );

//         $inserted = $this->common_model->insert_user_details($data);

//         if ($inserted) {
//             $response['status'] = 1;
//             $response['message'] = 'Email address saved successfully';
//             $response['data'] = $data;
//         } else {
//             $response['message'] = 'Failed to save email address';
//         }
//     } else {
//         $response['message'] = 'Invalid email address or customer ID';
//     }

//     echo json_encode($response);
// }

public function add_account_email() {
    $response = array('status' => 0, 'message' => 'An error occurred');
    $email = $this->input->post('email');
    $user = $this->my_libraries->mh_getCookies('customer');
    $customer_id = !empty($user) && isset($user['customer_id']) ? $user['customer_id'] : null;

    if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) && $customer_id) {
        // Check if email already exists for this customer
        $existing_email = $this->common_model->check_existing_email($customer_id, $email);
        if ($existing_email) {
            $response['message'] = 'Email address already exists';
        } else {
            $data = array(
                'customer_id' => $customer_id,
                'email' => $email
            );

            $inserted = $this->common_model->insert_user_details($data);

            if ($inserted) {
                $response['status'] = 1;
                $response['message'] = 'Email address saved successfully';
                $response['data'] = $data;
            } else {
                $response['message'] = 'Failed to save email address';
            }
        }
    } else {
        $response['message'] = 'Invalid email address or customer ID';
    }

    echo json_encode($response);
}
public function remove_account_email() {
    $response = array('status' => 0, 'message' => 'An error occurred');
    $id = $this->input->post('id');

    if ($id) {
        $deleted = $this->common_model->delete_user_details($id);

        if ($deleted) {
            $response['status'] = 1;
            $response['message'] = 'Email address removed successfully';
        } else {
            $response['message'] = 'Failed to remove email address';
        }
    } else {
        $response['message'] = 'Invalid ID';
    }

    echo json_encode($response);
}
public function policy_ajax(){

    $session=$this->session->userdata('admin');
    $designation=trim($this->input->post('designation'));
    $editv=trim($this->input->post('editv'));
    $field_type=trim($this->input->post('field_type'));


    if($field_type=='terms-condition'){
      $postArr['terms_and_conditions_policy']=$designation;
    }else if($field_type=='refund-cancelation'){
      $postArr['refund_and_cancelation_policy']=$designation;
    }else if($field_type=='Privacy-policy'){
      $postArr['privacy_policy']=$designation;
    }else if($field_type=='shipping-policy'){
      $postArr['shipping_policy']=$designation;
    }else if($field_type=='faq'){
      $postArr['faq']=$designation;
    }else if($field_type=='disclaimer'){
      $postArr['disclaimer']=$designation;
    }


   $postArr['updated_by']=$session['admin_name'];

    if($editv==""){
          $sqlQuery=$this->sqlQuery_model->sql_insert('tbl_policy',$postArr);
          $data['message']='Successfully added.';
    }else{
          $sqlQuery=$this->sqlQuery_model->sql_update('tbl_policy',$postArr,array('policy_id'=>$editv));
          $data['message']='Successfully updated.';
    }
    if($sqlQuery){
          $data['status']=1;
          echo json_encode($data);
          exit;
    }else{    
      $data['status']=0;
      $data['message']='Failed to updated.';
      echo json_encode($data);
      exit;
    }
}

public function save_gst_details(){
    $error =0;
    $error_array=array();
    if($this->input->is_ajax_request()){

      $form_detail=$_POST;
      $userCookies=getCookies('customer');
      //$userCookies['customer_id']

      $nv = array(
         
          'customer_id'           => $userCookies['customer_id'],
          'registration_no'       => isset($form_detail['registration_no'])             && $form_detail['registration_no'] != ''               ? addslashes($form_detail['registration_no'])            :  "",
          'company_name'          => isset($form_detail['company_name'])                && $form_detail['company_name'] != ''                  ? addslashes($form_detail['company_name'])               :  "",
          'company_address'       => isset($form_detail['company_address'])             && $form_detail['company_address'] != ''               ? addslashes($form_detail['company_address'])            :  "",
          'pincode'              => isset($form_detail['pincode'])                     && $form_detail['pincode'] != ''                       ? addslashes($form_detail['pincode'])                    :  "",
          'fssai_no'              => isset($form_detail['fssai_no'])                    && $form_detail['fssai_no'] != ''                      ? addslashes($form_detail['fssai_no'])                   :  "",
       );

        

       if($nv['registration_no'] == ''){
          $error=1;
          $errorArr['error_tag'] ='er_registration_no';
          $errorArr['err_msg'] = "Please enter registration no.";
          $error_array[]=$errorArr;
       }
       if($this->common_model->isGstNumberUnigue($nv['registration_no'])){
          $error=1;
          $errorArr['error_tag']='er_registration_no';
          $errorArr['err_msg']= "Gst number already present";
          $error_array[]=$errorArr;
       }
       if($nv['company_name'] == ''){
          $error=1;
          $errorArr['error_tag']='er_company_name';
          $errorArr['err_msg']= "Please enter company name";
          $error_array[]=$errorArr;
       }
       if(!preg_match('/^[\p{L} ]+$/u', $nv['company_name'])){
          $error=1;
          $errorArr['error_tag']='er_company_name';
          $errorArr['err_msg']= "Name must contain letters and spaces only";
          $error_array[]=$errorArr;
       }
       if ($nv['company_address'] == ''){
          $error=1;
          $errorArr['error_tag']='er_company_address';
          $errorArr['err_msg']= "Name must contain letters and spaces only";
          $error_array[]=$errorArr;
       }
       if($nv['pincode']==''){
           $error=1;
          $errorArr['error_tag']='er_pincode';
          $errorArr['err_msg']= "Please enter pincode";
          $error_array[]=$errorArr;
       }
       if($nv['pincode']!= '' && strlen($nv['pincode'])!=6){
          $error=1;
          $errorArr['error_tag']='er_pincode';
          $errorArr['err_msg']="Pincod must have 6 digits";
          $error_array[]=$errorArr;
        }

        if($nv['fssai_no'] == ''){
           $error=1;
          $errorArr['error_tag']='er_fssai_no';
          $errorArr['err_msg']= "Please enter fssai no";
          $error_array[]=$errorArr;
       }

      if($error==0){
          
          if($this->common_model->chkGSTPresent($userCookies['customer_id'])){

              $this->common_model->updateCustomerGst($nv);
              $error=0;
              $error_array['error_tag']='';
              $error_array['err_msg']="GST detail updated";

          }else{

              $this->common_model->saveCustomerGst($nv);

              $error=0;
              $error_array['error_tag']='';
              $error_array['err_msg']="GST detail save";
          }
           
      }

      $response= array('error' => $error, 'err_msg' => $error_array);
  }else{
      $response= array('error' =>2, 'err_msg' =>"Method not allowed");
  }

  echo json_encode($response);
  exit();
   
}
    
}

?>