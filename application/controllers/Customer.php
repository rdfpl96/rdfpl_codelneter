<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

   function __construct(){
        parent::__construct();

          $this->load->model('customer_model','custObject');
   }
      



  public function saveGst(){
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
         if($this->custObject->isGstNumberUnigue($nv['registration_no'])){
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
            
            if($this->custObject->chkGSTPresent($userCookies['customer_id'])){

                $this->custObject->updateCustomerGst($nv);
                $error=0;
                $error_array['error_tag']='';
                $error_array['err_msg']="GST detail updated";

            }else{

                $this->custObject->saveCustomerGst($nv);

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

  public function setDefaultAddress(){

    if($this->input->is_ajax_request()){

        $address_id=isset($_POST['address_id']) && $_POST['address_id']!="" ? $_POST['address_id'] : 0;
        $userCookies=getCookies('customer');
        
        if($address_id!=0){
            $this->custObject->setDefaultAddressByCust($address_id,$userCookies['customer_id']); 
            $response= array('error' =>0, 'err_msg' =>"Success");

        }else{
            $response= array('error' =>1, 'err_msg' =>"Some parameter missing");
        }

    }else{
        $response= array('error' =>1, 'err_msg' =>"Method not allowed");
    }

    echo json_encode($response);
    exit();

  }

  //new code by Aarti
public function addNewAddress() {
    $error = 0;
    if ($this->input->is_ajax_request()) {

        $form_detail = $_POST;
        $userCookies = getCookies('customer');

        // Get the address type and handle "Other" case
        //$address_type = isset($form_detail['address_type']) && $form_detail['address_type'] == 'Other' ? $form_detail['other_address_type'] : $form_detail['address_type'];
        $address_type =$form_detail['address_type']; 

        $nv = array(
            'customer_id' => $userCookies['customer_id'],
            'fname' => isset($form_detail['fname']) && $form_detail['fname'] != '' ? addslashes($form_detail['fname']) : "",
            'lname' => isset($form_detail['lname']) && $form_detail['lname'] != '' ? addslashes($form_detail['lname']) : "",
            'mobile' => isset($form_detail['mobile']) && $form_detail['mobile'] != '' ? addslashes($form_detail['mobile']) : "",
            'email' => isset($form_detail['email']) && $form_detail['email'] != '' ? addslashes($form_detail['email']) : "",
            'address1' => isset($form_detail['address1']) && $form_detail['address1'] != '' ? addslashes($form_detail['address1']) : "",
            'address2' => isset($form_detail['address2']) && $form_detail['address2'] != '' ? addslashes($form_detail['address2']) : "",
            'landmark' => isset($form_detail['landmark']) && $form_detail['landmark'] != '' ? addslashes($form_detail['landmark']) : "",
            'area' => isset($form_detail['area']) && $form_detail['area'] != '' ? addslashes($form_detail['area']) : "",
            'state_id' => isset($form_detail['state_id']) && $form_detail['state_id'] != '' ? addslashes($form_detail['state_id']) : "",
            'city' => isset($form_detail['city']) && $form_detail['city'] != '' ? addslashes($form_detail['city']) : "",
            'location_type' => isset($form_detail['location_type']) && $form_detail['location_type'] != '' ? addslashes($form_detail['location_type']) : "",
            'address_type' => $address_type,
            'setAddressDefault' => isset($form_detail['setAddressDefault']) && $form_detail['setAddressDefault'] != '' ? addslashes($form_detail['setAddressDefault']) : 0,
            'pincode' => isset($form_detail['pincode']) && $form_detail['pincode'] != '' ? addslashes($form_detail['pincode']) : "",
        );

         $sapAddress='{
    
    "BPAddresses": [
        {   
            "BPCode":"ECO10006",
            "AddressName": '.$nv['fname'].',
            "Street": '.$nv['area'].',
            "Block": '.$nv['address2'].',
            "ZipCode": '.$nv['pincode'].',
            "City": '.$nv['city'].',
            "Country": "IN",
            "State": "KT",
            "FederalTaxID": null,
            "BuildingFloorRoom": '.$nv['address1'].',
            "AddressType": "bo_ShipTo",
            "AddressName2": null,
            "AddressName3": null,
            "TypeOfAddress": "Home",
            "StreetNo": null,
            "GlobalLocationNumber": null,
            "GSTIN": "123456789012345",
            "GstType": "gstRegularTDSISD",
            "TaasEnabled": "tYES",
            "U_EmailID": '.$nv['email'].',
            "U_MobileNo": '.$nv['mobile'].'
        }
    ]

    }';


        // Validation checks
        if ($nv['fname'] == '') {
            $error = '1';
            $error_tag = 'er_fname';
            $err_msg = "Please enter your name.";
        } else if (!preg_match('/^[\p{L} ]+$/u', $nv['fname'])) {
            $error = '1';
            $error_tag = 'er_name';
            $err_msg = "Name must contain letters and spaces only";
        }else if ($nv['lname'] == '') {
            $error = '1';
            $error_tag = 'er_name';
            $err_msg = "Please enter mobile";
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
         } 
        //  else if ($this->custObject->addressPincodeAlreadyExist($nv['pincode'], $userCookies['customer_id'])) {
        //     $error = '1';
        //     $error_tag = 'er_pincode';
        //     $err_msg = "Pincode already exists";
        // } 
        else {
            $lastId=$this->custObject->addressSave($nv);
            if($lastId) {
                if($nv['setAddressDefault']==1){
                   $this->custObject->setDefaultAddressByCust($lastId,$userCookies['customer_id']); 
                   $this->sapservice->updateCustomer($sapAddress);
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

}