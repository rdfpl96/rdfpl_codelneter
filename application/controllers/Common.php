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

    // Log the retrieved customer ID
    log_message('debug', 'Customer ID: ' . print_r($customer_id, true));

    // Check if customer ID is being retrieved correctly
    if (empty($customer_id)) {
        echo json_encode(array('status' => 'fail', 'message' => 'Customer ID not found'));
        return;
    }

    $address_type = 'shippingAddress';
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
        'address_type' => $address_type,
        'others' => $this->input->post('other_loc')
    );

    // print_r($data);
    // exit();
    // Log incoming data for debugging
    log_message('debug', 'Incoming address data: ' . print_r($data, true));

    // Insert data into the database
    $insert = $this->common_model->insert_address($data);

    // Check insert result
    if ($insert) {
        $result = array('status' => 'success');
    } else {
        // Log the error if insert fails
        log_message('error', 'Database insert failed: ' . $this->db->last_query());
        $result = array('status' => 'fail', 'message' => 'Database insert failed');
    }

    echo json_encode($result);
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



public function my_account() {
    $user = $this->my_libraries->mh_getCookies('customer');
    // print_r($data);
    // exit();

    $customer_id = $user['customer_id'];
    if ($user && isset($user['customer_id']) && !empty($user['customer_id'])){
        $data['customer_details'] = $this->sqlQuery_model->sql_select_where('tbl_customer', array('customer_id' => $customer_id));
        // print_r($data);
        // exit();
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

public function offers_module(){
        $offers_module=$this->home->getoffersModule(1);
        //print_r($smartBasketProdct);
        $data['offers'] = $offers_module;
        // print_r($data);
        // exit();
        $data['content']='frontend/component/offers_module';
        $this->load->view('frontend/template',$data);
    } 

public function my_order() {
    $user = $this->my_libraries->mh_getCookies('customer');
    
    if ($user && isset($user['customer_id']) && !empty($user['customer_id'])) {
        $customer_id = (int)$user['customer_id'];
        $this->load->model('Common_model');
        //$data['getOrders'] = $this->common_model->getCustomerOrders($customer_id);
        $year = $this->input->post('year');
        $data['selected_year'] = $year;
        if ($year) {
            $data['getOrders'] = $this->common_model->getCustomerOrdersByYear($customer_id, $year);
        } else {
            $data['getOrders'] = $this->common_model->getCustomerOrders($customer_id);
        }

        $data['order_count'] = ($data['getOrders'] != 0) ? count($data['getOrders']) : 0;
        $data['content'] = 'frontend/component/my-order';
        $this->load->view('frontend/template', $data);

    } else {
        redirect(base_url(), 'refresh');
    }
}

public function getOrderDetails() {
    $order_no = $this->input->get('order_no');
    $order_details = $this->common_model->getOrderDetailsFun($order_no);

    $html = '<table style="width:100%">
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Pack size</th>
            <th>Product Qty</th>
            <th>Price</th>
            <th>Total</th>
          </tr>';

    if (!empty($order_details)) {
        foreach ($order_details as $key => $value) {
            $imgFile1 = base_url() . 'uploads/' . $value['feature_img'];
            $total_price = $value['qty'] * $value['price'];
            $html .= '<tr>
                <td><img src="' . $imgFile1 . '" alt="Product Image" style="width:100px; height:auto;"></td>
                <td>' . $value['product_name'] . '</td>
                <td>' . $value['pack_size'] .$value['units']. '</td>
                <td>' . $value['qty'] . '</td>
                <td>' . $value['price'] . '</td>
                <td>' . $total_price . '</td>
              </tr>';
        }
    } else {
        $html .= '<tr>
                <td colspan="5">No data</td>
            </tr>';
    }
    $html .= '</table>';

    echo json_encode($html);
    exit();
}


public function my_address(){
    $user=$this->my_libraries->mh_getCookies('customer');
    if ($user && isset($user['customer_id']) && !empty($user['customer_id'])){
        $customer_id = $user['customer_id'];
       
       $data['billingAddress']=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id' => $customer_id,'address_type'=>'billingAddress'));

// echo '<pre>';
// print_r($data);
// die(); 
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
    // if ($oldmobilename != $mobilename) {
    //     $getExitMobile = $this->sqlQuery_model->sql_select_where('tbl_customer', array('mobile' => $mobilename));
    //     if ($getExitMobile != 0) {
    //         $data['status'] = 0;
    //         $data['message'] = "Mobile Number Already exists. Please choose another mobile number.";
    //         echo json_encode($data);
    //         return;
    //     }
    // }

    $postArr = array(
        'c_fname' => $firstname,
        'c_lname' => $lastname,
        'mobile' => $mobilename,
        'email' => $emailAddress
        // 'password' => (!empty($password)) ? md5($password) : $old_password,
        // 'city' => $city,
        // 'state' => $state,
        // 'country' => $country
    );

    $customer_id = $user['customer_id'];
    $post_sql = $this->sqlQuery_model->sql_update('tbl_customer', $postArr, array('customer_id' => $customer_id));

    if ($post_sql) {
        $sapUser=array(
            "CardCode"=>"ECO10013",
            "CardName"=>$firstname,
            "CardType"=>"cCustomer",
            "Cellular"=>$mobilename,
            "EmailAddress"=>$emailAddress,
        );
        $this->sapservice->updateCustomer($sapUser);
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
    
    // echo "<pre>";
    // print_r($data['getAddr']);
    // echo "<pre>";
    $data['pageType']='billing-address';
    $data['content']='frontend/component/billing_address_form';
    $this->load->view('frontend/template',$data);

    }else{
        redirect(base_url(), 'refresh');
    }
}

public function add_or_update_address() {
    $user = $this->my_libraries->mh_getCookies('customer'); 
    $customer_id = $user['customer_id'];
    $fname = $this->input->post('fname');
    $lname = $this->input->post('lname');
    $mobile = $this->input->post('mobile');
    $apart_house = $this->input->post('apart_house');
    $apart_name = $this->input->post('apart_name');
    $area = $this->input->post('area');
    $street_landmark = $this->input->post('street_landmark');
    $city = $this->input->post('city');
    $state = $this->input->post('state');
    $address_type = 'billingAddress';
    // $city = 'pune';
    // $state = 'MH';
    $pincode = $this->input->post('pincode');
    $data = array(
        'fname' => $fname,
        'lname' => $lname,
        'mobile' => $mobile,
        'address1' => $apart_house,
        'address2' => $apart_name,
        'area' => $area,
        'landmark' => $street_landmark,
        'state' => $state,
        'city' => $city,
        'pincode' => $pincode,
        'customer_id' =>$customer_id,
        'address_type' =>$address_type
    );

    $sapAddress='{
    
    "BPAddresses": [
        {   
            "BPCode":"ECO10006",
            "AddressName": '.$fname.',
            "Street": '.$area.',
            "Block": '.$apart_name.',
            "ZipCode": '.$pincode.',
            "City": '. $citys.',
            "Country": "IN",
            "State": "KT",
            "FederalTaxID": null,
            "BuildingFloorRoom": '.$apart_house.',
            "AddressType": "bo_BillTo",
            "AddressName2": null,
            "AddressName3": null,
            "TypeOfAddress": "Home",
            "StreetNo": null,
            "GlobalLocationNumber": null,
            "GSTIN": "123456789012345",
            "GstType": "gstRegularTDSISD",
            "TaasEnabled": "tYES",
            "U_EmailID": "",
            "U_MobileNo": '.$mobile.'
        }
    ]

    }';

    if ($this->input->post('addr_id')) {
        $this->common_model->update_billingaddress($this->input->post('addr_id'), $data);
        $this->sapservice->updateCustomer($sapAddress);
        $response = ['error' => 0];
    } else {
        $this->common_model->insert_billingaddress($data);
        //
        $this->sapservice->updateCustomer($sapAddress);
        //
        $response = ['error' => 0];
    }
    echo json_encode($response);
}



public function add_billingaddress(){        
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

// public function policy_ajax(){

//     $session=$this->session->userdata('admin');
//     $designation=trim($this->input->post('designation'));
//     $editv=trim($this->input->post('editv'));
//     $field_type=trim($this->input->post('field_type'));


//     if($field_type=='terms-condition'){
//       $postArr['terms_and_conditions_policy']=$designation;
//     }else if($field_type=='refund-cancelation'){
//       $postArr['refund_and_cancelation_policy']=$designation;
//     }else if($field_type=='Privacy-policy'){
//       $postArr['privacy_policy']=$designation;
//     }else if($field_type=='shipping-policy'){
//       $postArr['shipping_policy']=$designation;
//     }else if($field_type=='faq'){
//       $postArr['faq']=$designation;
//     }else if($field_type=='disclaimer'){
//       $postArr['disclaimer']=$designation;
//     }


//    $postArr['updated_by']=$session['admin_name'];

//     if($editv==""){
//           $sqlQuery=$this->sqlQuery_model->sql_insert('tbl_policy',$postArr);
//           $data['message']='Successfully added.';
//     }else{
//           $sqlQuery=$this->sqlQuery_model->sql_update('tbl_policy',$postArr,array('policy_id'=>$editv));
//           $data['message']='Successfully updated.';
//     }
//     if($sqlQuery){
//           $data['status']=1;
//           echo json_encode($data);
//           exit;
//     }else{    
//       $data['status']=0;
//       $data['message']='Failed to updated.';
//       echo json_encode($data);
//       exit;
//     }
// }

public function policy_save() {
    $session = $this->session->userdata('admin');
    $designation = trim($this->input->post('designation'));
    $editv = trim($this->input->post('edits_id')); // Make sure the input name matches
    $field_type = trim($this->input->post('field_type'));
    $postArr = array();

    if (empty($designation)) {
        $this->session->set_flashdata('message', 'Field is required.');
        $this->redirect_based_on_field_type($field_type);
        return;
    }

    switch ($field_type) {
        case 'admin/terms_conditions':
            $postArr['terms_and_conditions_policy'] = $designation;
            break;
        case 'admin/refund-and-cancelation-policy':
            $postArr['refund_and_cancelation_policy'] = $designation;
            break;
        case 'admin/privacy-policy':
            $postArr['privacy_policy'] = $designation;
            break;
        case 'admin/shipping-policy':
            $postArr['shipping_policy'] = $designation;
            break;
        case 'admin/faq':
            $postArr['faq'] = $designation;
            break;
        case 'admin/disclaimer':
            $postArr['disclaimer'] = $designation;
            break;
        default:
            $this->session->set_flashdata('message', 'Invalid policy type.');
            $this->redirect_based_on_field_type($field_type);
            return;
    }

    $postArr['updated_by'] = $session['admin_name'];

    if (empty($editv)) {
        $sqlQuery = $this->sqlQuery_model->sql_insert('tbl_policy', $postArr);
        $message = 'Successfully added.';
    } else {
        $sqlQuery = $this->sqlQuery_model->sql_update('tbl_policy', $postArr, array('policy_id' => $editv));
        $message = 'Successfully updated.';
    }

    if ($sqlQuery) {
        $this->session->set_flashdata('message', $message);
    } else {
        $this->session->set_flashdata('message', 'Failed to update.');
    }

    $this->redirect_based_on_field_type($field_type);
}

private function redirect_based_on_field_type($field_type) {
    switch ($field_type) {
        case 'admin/terms_conditions':
            redirect('admin/terms_conditions');
            break;
        case 'admin/refund-and-cancelation-policy':
            redirect('admin/refund-and-cancelation-policy');
            break;
        case 'admin/privacy-policy':
            redirect('admin/privacy-policy');
            break;
        case 'admin/shipping-policy':
            redirect('admin/shipping-policy');
            break;
        case 'admin/faq':
            redirect('admin/faq');
            break;
        case 'admin/disclaimer':
            redirect('admin/disclaimer');
            break;
        // default:
        //     redirect('admin/terms_conditions'); // Redirect to a generic policy page
        //     break;
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

public function getSubCategoryInOption($top_cat_id=""){

    $subcategory=$this->customlibrary->getSubCatInOption($top_cat_id);

    echo json_encode(array('subcategories'=>$subcategory));
    exit();
    
  }

  public function getChildCategoryInOption($top_cat_id="",$sub_cat_id=""){

    $subcategory=$this->customlibrary->getChilCategoryInOption($top_cat_id,$sub_cat_id);

    echo json_encode(array('chilcategories'=>$subcategory));
    exit();
    
  }

public function order_details($order_no){
    // $data['content'] = 'frontend/component/order_details';
    // $this->load->view('frontend/template', $data);
  
    $user = $this->my_libraries->mh_getCookies('customer');
    if ($user && isset($user['customer_id']) && !empty($user['customer_id'])) {
        $customer_id = (int)$user['customer_id'];
        //$order_id=base64_decode($_GET['ord_id']);
        $data['order_details'] = $this->common_model->getOrderDetailsFun($order_no);
        $data['getOrders'] = $this->common_model->getCustomerOrdersDetailsByOrderId($customer_id,$order_no);
        $data['order_count'] = ($data['getOrders'] != 0) ? count($data['getOrders']) : 0;
        $data['content'] = 'frontend/component/order_details';
        $this->load->view('frontend/template', $data);

    } else {
        redirect(base_url(), 'refresh');
    }
}  

public function rating_review($order_no,$product_id){
    $user = $this->my_libraries->mh_getCookies('customer');
    if ($user && isset($user['customer_id']) && !empty($user['customer_id'])) {
        $customer_id = (int)$user['customer_id'];
        $data['content']='frontend/component/rating_review';
        $this->load->view('frontend/template',$data);
    } else {
        redirect(base_url(), 'refresh');
    }
}    

// public function rating_review_submit() {
//         $user = $this->my_libraries->mh_getCookies('customer');
//         if ($user && isset($user['customer_id']) && !empty($user['customer_id'])) {
//             $customer_id = (int)$user['customer_id'];
//             $this->load->library('form_validation');
//             $this->form_validation->set_rules('comment', 'Comment', 'required');

//             if ($this->form_validation->run() == FALSE) {
//                 $data['content'] = 'frontend/component/rating_review';
//                 $this->load->view('frontend/template', $data);
//             } else {
//                 $rate_id = $this->input->post('rate_id');
//                 $order_id = $this->input->post('order_id');
//                 $product_id = $this->input->post('pro_id');
//                 $star_rate = $this->input->post('rating');
//                 $comment = $this->input->post('comment');

//                 $data = array(
//                     'cust_id' => $customer_id,
//                     'product_id' => $product_id,
//                     'order_id' => $order_id,
//                     'cust_rate' => $star_rate,
//                     'comment' => $comment,
//                     'add_date' => date('Y-m-d H:i:s'),
//                     'status' => 1
//                 );
//                 // print_r($data);
//                 // exit();
//                 $this->common_model->save_review($data, $rate_id);
//                 //redirect(base_url('order-details?ord_id=' . $order_id));
//                 redirect(base_url('my-order'));
//             }
//         } else {
//             redirect(base_url(), 'refresh');
//         }
// }   

public function rating_review_submit() {
    $user = $this->my_libraries->mh_getCookies('customer');
    if ($user && isset($user['customer_id']) && !empty($user['customer_id'])) {
        $customer_id = (int)$user['customer_id'];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('comment', 'Comment', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['content'] = 'frontend/component/rating_review';
            $this->load->view('frontend/template', $data);
        } else {
            $product_id = $this->input->post('pro_id');

            // Check if the user has already submitted a review for this product
            $this->load->model('common_model');
            $existing_review = $this->common_model->get_user_review($customer_id, $product_id);

            if ($existing_review) {
                // User has already submitted a review for this product
                $this->session->set_flashdata('message', 'You have already submitted a review for this product.');
                // Fetch product slug
                $product_slug = $this->common_model->get_product_slug_by_id($product_id);
                redirect(base_url('product/' . $product_slug));
            } else {
                // Proceed with saving the review
                $rate_id = $this->input->post('rate_id');
                $order_id = $this->input->post('order_id');
                $star_rate = $this->input->post('rating');
                $comment = $this->input->post('comment');

                $data = array(
                    'cust_id' => $customer_id,
                    'product_id' => $product_id,
                    'order_id' => $order_id,
                    'cust_rate' => $star_rate,
                    'comment' => $comment,
                    'add_date' => date('Y-m-d H:i:s'),
                    'status' => 1
                );
                // Save the review
                $this->common_model->save_review($data, $rate_id);
                // Fetch product slug
                $product_slug = $this->common_model->get_product_slug_by_id($product_id);
                redirect(base_url('product/' . $product_slug));
            }
        }
    } else {
        redirect(base_url(), 'refresh');
    }
}

public function newletter(){
    $email = $this->input->post('email');
    $postarr = array(
        'email'=>$email
    );
        $insert=$this->sqlQuery_model->sql_insert('tbl_newsletter',$postarr);
        if($insert){
              $mail = $this->phpmailer_lib->load();
              $config['mailUsername']=$this->config->item('mailUsername');
              $config['mailPassword']=$this->config->item('mailPassword');
              $config['setFrom']=$this->config->item('setFrom');
              $config['addCC']=$this->config->item('setFrom');
              // Add a recipient
              // $config['addAddress']=trim($email);
              $config['title']='Royal Dryfruit';
              $config['subject']='Royal Dryfruit Subscribing customer';
              $config['mailContent']='<div>Email : '.$email.'</div>';
              if(smtpSend($mail,$config)){
                 $data['status']=1;
                 $data['message']="Thank you for subscribing";
                 $data['url']=base_url();
                 echo json_encode($data);
                  exit;
              }
          
        }else{
           $data['status']=0;
           $data['message']="Failed to subscribe";
           echo json_encode($data);
           exit;
         }
}

public function rating_review_details($product_id){
    $userCookies = getCookies('customer');
    $data['reviews'] = $this->common_model->getReviewsByProductId($product_id);
    //$data['productRate'] = $this->customlibrary->getProductRatingSummary($product_id);
    $productRatings = $this->productObj->getProductRatingSummary($product_id);
    $data['productRate'] = $productRatings;
    $data['content']='frontend/component/rating_review_details';
    $this->load->view('frontend/template',$data);
}     
}

?>