<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Login extends REST_Controller{

	public function __construct() {
        parent::__construct();
        $this->load->model('api/login_model','login');
        
    }

    
    public function loginWithMobile_post(){

        // print_r($this->request->getPost());

        $post = json_decode($this->input->raw_input_stream, true);

        $mobile=isset($post['mobile']) ? $post['mobile'] : "" ; 

        if($mobile!=''){

            if(validateMobile($mobile)){

                $otp = sprintf("%06d", mt_rand(1, 999999));
               
                $this->session->set_userdata(array('time'=>$_SERVER["REQUEST_TIME"]));
                
                if($this->login->chkMobileExist($mobile)){

                    $array_data=array('is_otp_verify'=>0,'otp'=>$otp);

                    if($this->login->updateOpt(array('colname'=>"mobile","value"=>$mobile),$array_data)){

                       $this->emaillibrary->sendOtpOnMobile($mobile,$otp);

                       $this->response(array('error' =>0,'msg'=>'Otp send on registered mobile number')); 

                    }else{

                        $this->response(array('error' =>1,'msg'=>'something wrong'));   
                    }

                }else{
                    $arrPost['updated_by']='customer';
                    $arrPost['registered_type']='Manual';
                    $arrPost['otp']=$otp;
                    $arrPost['mobile']=$mobile;

                    if($this->login->insertNewUser($arrPost)){

                        $this->emaillibrary->sendOtpOnMobile($mobile,$otp);

                        $this->response(array('error' =>0,'msg'=>'Otp send on registered mobile number')); 

                    }else{
                        $this->response(array('error' =>1,'msg'=>'There some problem. Please try again')); 
                    }
                }
            }else{
                $this->response(array('error' =>1,'msg'=>'Enter valid mobile number'));
            }    
        }else{
            $this->response(array('error' =>1,'msg'=>'Parameter value is blank'));
        }
    }

    public function verifyOtpByMobile_post(){

        $time=$this->session->userdata('time');

        $post = json_decode($this->input->raw_input_stream, true);
       
        $mobile=isset($post['mobile']) ? $post['mobile'] : "" ; 
        
        $otp=isset($post['otp']) ? $post['otp'] : "" ; 

        $date = new DateTime();

        $timestamp =  $_SERVER["REQUEST_TIME"];  // record the current time stamp 

        if($mobile!='' && $otp!=''){

            if(($timestamp-$time) < 300 ){    // 300 refers to 3000seconds (5 minut)

                if($this->login->getChkValieOtp(array('colname'=>"mobile","value"=>$mobile),$otp)){
                    
                    if($this->login->updateOtpStatus(array('colname'=>"mobile","value"=>$mobile),array('is_otp_verify'=>1))){

                        $detail=$this->login->getUserDetail(array('colname'=>"mobile","value"=>$mobile));

                        $token['customer_id']=$detail['customer_id'];
                        $token['code']=sprintf("%06d", mt_rand(1, 999999));;
                        $token['time']=$date->getTimestamp()+60*60*24*365;
                        $user_token = $this->authorization_token->generateToken($token);
                        
                       
                        $userDetail['detail']=array('email'=>$detail['email'],"mobile"=>$detail['mobile'],"name"=>$detail['c_fname']);
                        $userDetail['token']=$user_token;
                        
                        $this->response(array('error' =>0,'msg'=>'Success','userDetail'=>$userDetail));
                    
                    }else{
                    $this->response(array('error' =>1,'msg'=>'Invalid OTP. Please try again.'));
                    }
                }else{
                    $this->response(array('error' =>1,'msg'=>'Invalid OTP. Please try again.'));
                }
            }else{
                $this->response(array('error' =>1,'msg'=>'OTP expired. Pls. try again'));
            }
        }else{
            $this->response(array('error' =>1,'msg'=>'Some parameter missing'));
        }
    }

    //
    //Login with email Id
    //
    public function loginWithEmail_post(){

        $post = json_decode($this->input->raw_input_stream, true);

        $email=isset($post['email']) ? $post['email'] : "" ; 

        if($email!='' ){

            if(validateEmail($email)){

                $otp = sprintf("%06d", mt_rand(1, 999999));
               
                $this->session->set_userdata(array('time'=>$_SERVER["REQUEST_TIME"]));

                if($this->login->chkEmailExist($email)){ 

                    $array_data=array('is_otp_verify'=>0,'otp'=>$otp);

                    if($this->login->updateOpt(array('colname'=>"email","value"=>$email),$array_data)){

                       $this->emaillibrary->sendOtpMail($email,$otp);

                       $this->response(array('error' =>0,'msg'=>'Otp send on registered mobile number')); 

                    }else{

                        $this->response(array('error' =>1,'msg'=>'something wrong'));   
                    }

                }else{
                    $arrPost['updated_by']='customer';
                    $arrPost['registered_type']='Manual';
                    $arrPost['otp']=$otp;
                    $arrPost['email']=$email;

                    if($this->login->insertNewUser($arrPost)){

                        $this->emaillibrary->sendOtpMail($email,$otp);

                        $this->response(array('error' =>0,'msg'=>'Otp send on registered Email Id')); 

                    }else{
                        $this->response(array('error' =>1,'msg'=>'There some problem. Please try again')); 
                    }
                }
            }else{
                $this->response(array('error' =>1,'msg'=>'Enter valid Email Id'));
            }    
        }else{
            $this->response(array('error' =>1,'msg'=>'parameter value is blank'));
        }
    }

    //
    // Verify otp by mobile
    //

    public function verifyOtpByEmail_post(){
       
        $time=$this->session->userdata('time');

        $post = json_decode($this->input->raw_input_stream, true);
       
        $email=isset($post['email']) ? $post['email'] : "" ; 
        
        $otp=isset($post['otp']) ? $post['otp'] : "" ; 

        $date = new DateTime();

        $timestamp =  $_SERVER["REQUEST_TIME"];  // record the current time stamp 

        if($email!='' && $otp!=''){

            if(($timestamp-$time) < 300 ){    // 300 refers to 3000seconds (5 minut)

                if($this->login->getChkValieOtp(array('colname'=>"email","value"=>$email),$otp)){
                    
                    if($this->login->updateOtpStatus(array('colname'=>"email","value"=>$email),array('is_otp_verify'=>1))){

                        $detail=$this->login->getUserDetail(array('colname'=>"email","value"=>$email));

                        $token['customer_id']=$detail['customer_id'];
                        $token['code']=sprintf("%06d", mt_rand(1, 999999));;
                        $token['time']=$date->getTimestamp()+60*60*24*365;
                        $user_token = $this->authorization_token->generateToken($token);
                        
                       
                        $userDetail['detail']=array('email'=>$detail['email'],"mobile"=>$detail['mobile'],"name"=>$detail['c_fname']);
                        $userDetail['token']=$user_token;
                        
                        $this->response(array('error' =>0,'msg'=>'Success','userDetail'=>$userDetail));
                    
                    }else{
                    $this->response(array('error' =>1,'msg'=>'Invalid OTP. Please try again.'));
                    }
                }else{
                    $this->response(array('error' =>1,'msg'=>'Invalid OTP. Please try again.'));
                }
            }else{
                $this->response(array('error' =>1,'msg'=>'OTP expired. Pls. try again'));
            }
        }else{
            $this->response(array('error' =>1,'msg'=>'Some parameter missing'));
        }
    }
    
  
     
    
}
?>