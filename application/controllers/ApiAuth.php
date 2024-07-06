<?php
defined('BASEPATH') OR exit('No direct script access allowed');


  class ApiAuth extends CI_Controller {
      
     public function __construct(){
     	
        parent::__construct();

        $this->load->library('my_libraries');
        $this->load->library('api_auth');
        
     }

     public function response($array=array(),$httpType=''){
            $array['status']=$httpType;
     	      echo $this->output
	        ->set_status_header($httpType)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
            exit;
      }

      
     public function send_otp_for_login(){

          $post = json_decode($this->input->raw_input_stream, true);

          $email_mobi=$post['email_mobi'];
         
         if($email_mobi==""){
         	$this->response([
                'message' => 'Enter your mobile or email Id.',
             ], 400);
          }


              $sql=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_customer WHERE mobile='".trim($email_mobi)."' OR email='".trim($email_mobi)."'");
                $status=false;
              	 if($sql==0){

                  if(checkemail($email_mobi)){
                       $arrayPost=array('email'=>trim($email_mobi),'updated_by'=>'customer','registered_type'=>'App');
                    }else if(preg_match('/^[0-9]{10}+$/', $email_mobi)){
                       $arrayPost=array('mobile'=>trim($email_mobi),'updated_by'=>'customer','registered_type'=>'App');
                    }else{
                       $data['message']='Invalid input.';
                       $this->response($data, 400);
                    }
                  
                   $inserCusto=$this->sqlQuery_model->sql_insert('tbl_customer',$arrayPost);
                   $status = true; 

                 }else{

                       if($sql[0]->status!=1){
                          $data['message']='Your account has been blocked please contact to adminstrator.';
                          $this->response($data, 400);
                        }

                      $status = true; 
                 }


              
              if($status==true){
                 
                   $sqldata=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_customer WHERE (mobile='".trim($email_mobi)."' OR email='".trim($email_mobi)."') AND status=1");

                    if($sqldata!=0){

                                $otp = sprintf("%06d", mt_rand(1, 999999));
                               $sql_update=$this->sqlQuery_model->sql_queryUpdate("UPDATE tbl_customer SET otp='".$otp."' WHERE mobile='".trim($email_mobi)."' OR email='".trim($email_mobi)."'");

                                  if(checkemail($email_mobi)){
                               
                                      $mail = $this->phpmailer_lib->load();
                                      $config['mailUsername']=$this->config->item('mailUsername');
                                      $config['mailPassword']=$this->config->item('mailPassword');
                                      $config['setFrom']=$this->config->item('setFrom');
                                      // Add a recipient
                                      $config['addAddress']=trim($email_mobi);
                                      $config['title']='Login OTP';
                                      $config['subject']='Royal Dryfruit Login OTP';
                                      $config['mailContent']='<p>Dear customer,<br>
                                        <h1>'.$otp.'</h1> Please do not share the OTP with others.<br>
                                        Regards,<br>
                                        Royal Dryfruit</p>';
                                      
                                         smtpSend($mail,$config);
                                }

                           //       else if(preg_match('/^[0-9]{10}+$/', $email_mobi)) {
                           //       $massage=$this->config->item('KALEYRA_SMS_LOGIN_OTP');
                           //       $new_sentence = str_replace('%OTP_VALUE%', $otp, $massage);
                           //       sendSMS($new_sentence,$email_mobi);
                           //  }

                                     $getResponse=array(
                                         'customer_id'=>$sqldata[0]->customer_id,
                                         'fname'=>$sqldata[0]->c_fname,
                                         'lname'=>$sqldata[0]->c_lname,
                                         'email'=>$sqldata[0]->email,
                                         'mobile'=>$sqldata[0]->mobile,
                                         'status'=>$sqldata[0]->status,
                                         'add_date'=>$sqldata[0]->add_date,
                                         'otp'=>$otp
                                     );

                             $data['message']='Your OTP send successfully.';
                             $data['response']=$getResponse;
                             $this->response($data, 200);


                      }else{
                          $data['message']='Customer not register.';
                          $this->response($data, 400);
                         
                      }
                  

              }else{
                 $data['message']='Whoop!,Something went wrong.';
                 $this->response($data, 400);
              }

   
     }



		public function login(){
            $post = json_decode($this->input->raw_input_stream, true);
            $email_mobi=$post['email_mobi'];
            $otp=$post['otp'];

	         if($email_mobi==""){
	         	$this->response([
	                'message' => 'Enter your mobile or email Id.',
	             ], 400);
	         }

	         if($otp==""){
	         	$this->response([
	                'message' => 'Enter your OTP.',
	             ], 400);
	         }


	          $sql_checked=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_customer WHERE mobile='".trim($email_mobi)."' OR email='".trim($email_mobi)."'");
		       if($sql_checked==0){
		         $data['message']='Customer not found. Invalid credentials';
		         $this->response($data, 400);
		       }


		        $sql_checked_bloc=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_customer WHERE (mobile='".trim($email_mobi)."' OR email='".trim($email_mobi)."') AND status=1");

		        if($sql_checked_bloc!=0){
                    

                     $otpValue=$otp;
                     
                     $sql=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_customer WHERE (mobile='".trim($email_mobi)."' OR email='".trim($email_mobi)."') AND otp='".$otpValue."'");
                    
	                  if($sql==0){
	                      $data['message']='OTP invalid. Please try again.';
	                       $this->response($data, 400);
	                   }else{

                         $checkTokenExits=$this->sqlQuery_model->sql_query("SELECT * FROM `tbl_user_keys` WHERE user_id='".trim($sql[0]->customer_id)."'");
                          $arrayKey=array('user_key'=>$this->api_auth->generateToken($sql[0]->customer_id));
                         if($checkTokenExits!=0){
                          $postSql=$this->sqlQuery_model->sql_update('tbl_user_keys',$arrayKey,array('user_id'=>$sql[0]->customer_id));
                         }else{
                           $arrayKey['user_id']=$sql[0]->customer_id;
                           $postSql=$this->sqlQuery_model->sql_insert('tbl_user_keys',$arrayKey);
                         }

                          
                          $getResponse=array(
                           'customer_id'=>$sql[0]->customer_id,
                           'fname'=>$sql[0]->c_fname,
                           'lname'=>$sql[0]->c_lname,
                           'email'=>$sql[0]->email,
                           'mobile'=>$sql[0]->mobile,
                           'status'=>$sql[0]->status,
                           'add_date'=>$sql[0]->add_date,
                           'otp'=>$otp,
                           'token'=>$arrayKey['user_key']
                          );

                           if(checkemail($email_mobi)){
                               $updateArr['verify_email']=1;
                               $getResponse['login_type']='email';
                            }else if(preg_match('/^[0-9]{10}+$/', $email_mobi)){
                               $updateArr['verify_mobile']=1;
                               $getResponse['login_type']='number';
                            }
                            $updateArr['otp']=null;
                           $this->sqlQuery_model->sql_update('tbl_customer',$updateArr,array('customer_id'=>$sql[0]->customer_id));
                           $data['message']=$this->config->item('login_success');
                           $data['response']=$getResponse;
                           $this->response($data, 200);

                         
                     }

		             
		        }else{
                      $data['message']='User Not found. Please sign up your account.';
                      $this->response($data, 400);
                 }
        }

        public function resendOtp(){
             $post = json_decode($this->input->raw_input_stream, true);

            $email_mobi=$post['email_mobi'];
         
            if($email_mobi==""){
                $this->response([
                'message' => 'Enter your mobile or email Id.',
                ], 400);
            }

            $sql=$this->sqlQuery_model->sql_single_query("SELECT * FROM tbl_customer WHERE mobile='".trim($email_mobi)."' OR email='".trim($email_mobi)."'");

            if(is_array($sql) && count($sql)>0){

                if(checkemail($email_mobi)){
                               
                  $mail = $this->phpmailer_lib->load();
                  $config['mailUsername']=$this->config->item('mailUsername');
                  $config['mailPassword']=$this->config->item('mailPassword');
                  $config['setFrom']=$this->config->item('setFrom');
                  // Add a recipient
                  $config['addAddress']=trim($email_mobi);
                  $config['title']='Login OTP';
                  $config['subject']='Royal Dryfruit Login OTP';
                  $config['mailContent']='<p>Dear customer,<br>
                    <h1>'.$otp.'</h1> Please do not share the OTP with others.<br>
                    Regards,<br>
                    Royal Dryfruit</p>';
                  
                     smtpSend($mail,$config);
            }

            

            $data['message']='Your OTP send successfully.';
            $data['response']=array();
            $this->response($data, 200);

            }

            else{
                $this->response([
                'message' => 'Invalid entered mobile or email id',
                ], 400);
            }
        }



  }

?>