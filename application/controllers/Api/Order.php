<?php
require(APPPATH.'/libraries/REST_Controller.php');
 
 
class Order extends REST_Controller{



  public function __construct() {
    parent::__construct();
    
        $this->load->model('api/order_model','orderObj');
      
    
        $validation=$this->authorization_token->validateToken();
    
        if($validation['status']!=0){

        $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
        echo json_encode($res);
        exit();
        }
    }

    public function index_get(){
        $cartProduct=array();
        $saveProduct=array();
        $total_save=0;
        $customer_id=$this->authorization_token->userData()->customer_id;

        $orders = $this->orderObj->getAllOrder(1,10,$customer_id);
        
       $this->response(array('error' =>0,'msg'=>'Success',"data"=>array('order'=>$orders)));
        
    }  


    
  

}

?>