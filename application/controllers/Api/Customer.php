<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Customer extends REST_Controller {

   function __construct(){
        parent::__construct();

        $this->load->model('api/customer_model','custObj');
        $this->load->model('api/login_model','login');

       $validation=$this->authorization_token->validateToken();
    
        if($validation['status']!=0){

        $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
        echo json_encode($res);
        exit();
        }    
   }
      
    public function getCustomerDetail_get(){

        $customer_id=$this->authorization_token->userData()->customer_id;
        
        $detail = $this->custObj->getCustomerDetail($customer_id);

        if(count($detail)>0){
            $detail['defaultAddress']=$this->custObj->getDefuldAddress($customer_id);
            $this->response(array('error' =>1,'msg'=>'Success',"data"=>$detail));     
        }else{
            $this->response(array('error' =>1,'msg'=>'Your wishlist is empty',"data"=>[])); 
        }
    }


    public function updateProfile_post(){
        $customer_id=$this->authorization_token->userData()->customer_id;

        $detail = $this->custObj->getCustomerDetail($customer_id);

        $post = json_decode($this->input->raw_input_stream, true);
        //
        $fname=isset($post['fname']) ? $post['fname'] : "" ; 
        $lname=isset($post['lname']) ? $post['lname'] : "" ; 
        $email=isset($post['email']) ? $post['email'] : "" ; 
        $mobile=isset($post['mobile']) ? $post['mobile'] : "" ;
        $fieldType=isset($post['field_type']) ? $post['field_type'] : "" ;
        
        if($fname!="" && $email!="" && $mobile!="" && $fieldType!=""){
            if($fieldType==1){
                $this->custObj->updateProfile($customer_id,array('c_fname'=>$fname,'c_lname'=>$lname));

                $this->response(array('error' =>0,'msg'=>'Success'));  
            }
            elseif($fieldType==2){
                if(validateEmail($email)){
                    if($this->login->chkEmailExist($email)){ 
                        
                        $otp = sprintf("%06d", mt_rand(1, 999999));

                        $this->custObj->updateProfile($customer_id,array('email'=>$email,'c_fname'=>$fname,'c_lname'=>$lname,'is_otp_verify'=>0,'otp'=>$otp));

                        $this->emaillibrary->sendOtpMail($email,$otp);

                        $this->response(array('error' =>0,'msg'=>'Otp Send'));  

                    }else{
                        $this->response(array('error' =>1,'msg'=>'Email already exist'));    
                    }
                    
                }else{
                   $this->response(array('error' =>1,'msg'=>'Invalid email'));  
                }
            }
            elseif($fieldType==3){
                if(validateMobile($mobile)){
                    if(!$this->login->chkMobileExist($mobile)){
                        
                        $otp = sprintf("%06d", mt_rand(1, 999999));

                        $this->custObj->updateProfile($customer_id,array('mobile'=>$mobile,'c_fname'=>$fname,'c_lname'=>$lname,'is_otp_verify'=>0,'otp'=>$otp));

                        $this->emaillibrary->sendOtpOnMobile($mobile,$otp);

                         $this->response(array('error' =>0,'msg'=>'Otp Send'));  

                    }else{
                        $this->response(array('error' =>1,'msg'=>'Mobile number already exist'));    
                    }
                    
                }else{
                   $this->response(array('error' =>1,'msg'=>'Invalid mobile number'));  
                }
                
            }
        }else{
            $this->response(array('error' =>1,'msg'=>'Some parameter or value is missing'));
        }
       

    }

    public function rateReviewList_get(){
        
        $customer_id=$this->authorization_token->userData()->customer_id;

        $list= $this->custObj->getCustomerRateReviewList($customer_id);
         $this->response(array('error' =>0,'msg'=>'Success',"data"=>$list));
    }

  
}

?>