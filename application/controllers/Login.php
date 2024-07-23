<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

   function __construct(){
        parent::__construct();

          $this->load->model('frontlogin_model','loginObj');
          $this->load->library('my_libraries');
   }
      


   public function index() {
    $email_mobi = $this->input->post('email_mobi');
    $error = 1;

    if (empty($email_mobi)) {
        $error = 0;
        $data['status'] = 0;
        $data['message'] = 'Enter your mobile or email Id.';
    } else if (is_numeric($email_mobi)) {
        // Check if the mobile number starts with 6, 7, 8, or 9 and is 10 digits long
        if (!preg_match('/^[6-9][0-9]{9}$/', $email_mobi)) {
            $error = 0;
            $data['status'] = 0;
            $data['message'] = 'Enter valid mobile number';
        }
    } else if (is_string($email_mobi)) {
        if (!filter_var($email_mobi, FILTER_VALIDATE_EMAIL)) {
            $error = 0;
            $data['status'] = 0;
            $data['message'] = 'Enter valid email Id';
        }
    }

    if ($error == 1) {
        $userDetail = $this->loginObj->getUserDetailByEmailOrMobile($email_mobi);

        $otp = sprintf("%06d", mt_rand(1, 999999));

        if (is_array($userDetail) && count($userDetail) > 0) {
            if ($userDetail['email'] != "") {
                $this->emaillibrary->sendOtpMail($userDetail['email'], $otp);
            }
            if ($userDetail['mobile'] != "") {
                $this->emaillibrary->sendOtpOnMobile($userDetail['mobile'], $otp);
            }

            $this->loginObj->updateUserDataByUserId($userDetail['customer_id'], ['otp' => $otp]);
            $data['status'] = 1;
            $data['message'] = 'Your OTP sent successfully';
            echo json_encode($data);
            exit;
        } else {
            if (checkemail($email_mobi)) {
                $this->emaillibrary->sendOtpMail($email_mobi, $otp);
                $arrPost['email'] = trim($email_mobi);
            } else if (preg_match('/^[6-9][0-9]{9}$/', $email_mobi)) {
                $this->emaillibrary->sendOtpOnMobile($email_mobi, $otp);
                $arrPost['mobile'] = trim($email_mobi);
            }
            $arrPost['updated_by'] = 'customer';
            $arrPost['registered_type'] = 'Manual';
            $arrPost['otp'] = $otp;
            $this->loginObj->insertNewUser($arrPost);
            $data['status'] = 1;
            $data['message'] = 'Your OTP sent successfully.';
            echo json_encode($data);
            exit;
        }
    } else {
        echo json_encode($data);
        exit;
    }
}


public function otpVerification() {
    $email_mobi = $this->input->post('email_mobi');
    $otpArray = $this->input->post('otp');

    if (empty($email_mobi)) {
        $data['status'] = 0;
        $data['message'] = 'Enter your mobile or email Id.';
        echo json_encode($data);
        exit;
    } else {
        $userDetail = $this->loginObj->getUserDetailByEmailOrMobile($email_mobi);

        if (count($userDetail) > 0) {
            $otp = implode("", $otpArray);

            if ($this->loginObj->getChkValieOtp($userDetail['customer_id'], $otp)) {
                $this->loginObj->updateOtpVerification($userDetail['customer_id'], array('is_otp_verify' => 1));

                // Set cookies
                setCookies("customer", array("customer_id" => $userDetail['customer_id'], 'name' => $userDetail['c_fname'], 'isCustomerLogin' => 1));
                $cart_contents = $_SESSION['cart_contents'];
                
                // Insert cart data into cart_manager table
                foreach ($cart_contents as $key => $cart_item) {
                    if (in_array($key, ['cart_total', 'total_items'])) {
                        continue;
                    }
                    if (is_array($cart_item)) {
                        $cart_data = array(
                            'user_id' => $userDetail['customer_id'],
                            'product_id' => isset($cart_item['id']) ? $cart_item['id'] : NULL,
                            'qty' => isset($cart_item['qty']) ? $cart_item['qty'] : NULL,
                            'price' => isset($cart_item['price']) ? $cart_item['price'] : NULL,
                            'variant_id' => isset($cart_item['variant_id']) ? $cart_item['variant_id'] : NULL,
                            'name' => isset($cart_item['name']) ? $cart_item['name'] : NULL,
                            'options' => isset($cart_item['options']) ? json_encode($cart_item['options']) : NULL,
                        );

                        if ($cart_data['product_id'] !== NULL && $cart_data['qty'] !== NULL && $cart_data['price'] !== NULL) {
                            $this->loginObj->insertCartData($cart_data);
                        } else {
                            log_message('error', 'Missing cart item data: ' . print_r($cart_item, true));
                        }
                    }
                }

                $data['status'] = 1;
                $data['message'] = 'OTP verified successfully';
                echo json_encode($data);
            } else {
                $data['status'] = 0;
                $data['message'] = 'Entered OTP is invalid';
                echo json_encode($data);
            }
        } else {
            $data['status'] = 0;
            $data['message'] = 'User not registered. Please register';
            echo json_encode($data);
        }
    }
    exit;
}


   
   public function logout() {
        $user = $this->my_libraries->mh_getCookies('customer');

        if ($user != "") {
            delete_cookie('customer');
            $this->session->unset_userdata('access_token');
            $this->cart->destroy();
        }
        $this->session->set_flashdata('msg', $this->config->item('logout_success'));
        // redirect('login');
        redirect(base_url(''));
        
    }

// public function otpVerification(){
//     $email_mobi=$this->input->post('email_mobi');
//     $optArray=array_filter($this->input->post('otp'));
    
//     if(empty($email_mobi)){
//           $data['status']=0;
//           $data['message']='Enter your mobile or email Id.';
//           echo json_encode($data);
//           exit;
//     }
//     elseif(count($optArray)!=6){
//       $data['status']=0;
//       $data['message']='Enter valid otp';
//       echo json_encode($data);
//       exit;
//     }else{
//         $userDetail=$this->loginObj->getUserDetailByEmailOrMobile($email_mobi);

//         if(count($userDetail)>0){

//             $otp=implode("",$optArray);
            
//             if($this->loginObj->getChkValieOtp($userDetail['customer_id'],$otp)){
                
//                 $this->loginObj->updateOtpVerification($userDetail['customer_id'],array('is_otp_verify'=>1));

//                 setCookies("customer",array("customer_id"=>$userDetail['customer_id'],'name'=>$userDetail['c_fname'],'isCustomerLogin'=>1));

//                 $data['status']=1;
//                 $data['message']='successfully';
//                 echo json_encode($data);

//             }else{
//                 $data['status']=0;
//                 $data['message']='Entered otp is invalid';
//                 echo json_encode($data);
//             }


//         }else{
//             $data['status']=0;
//             $data['message']='User not registered.Please register';
//             echo json_encode($data);
//         }
//     }

    
//     //echo json_encode($data);
//     exit;

// } 

}

?>