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

}