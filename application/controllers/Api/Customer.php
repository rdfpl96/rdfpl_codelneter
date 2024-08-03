<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Customer extends REST_Controller {

   function __construct(){
        parent::__construct();

        $this->load->model('api/customer_model','custObj');
      

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

  
}

?>