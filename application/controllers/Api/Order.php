<?php
require(APPPATH.'/libraries/REST_Controller.php');
 
 
class Order extends REST_Controller{



  public function __construct() {
    parent::__construct();
    
        $this->load->model('api/order_model','orderObj');
      
    
        // $validation=$this->authorization_token->validateToken();
    
        // if($validation['status']!=0){

        // $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
        // echo json_encode($res);
        // exit();
        // }
    }

    public function index_get(){
        $cartProduct=array();
        $saveProduct=array();
        $total_save=0;
        $customer_id=$this->authorization_token->userData()->customer_id;

        $orders = $this->orderObj->getAllOrder(1,10,$customer_id=45);
        
       $this->response(array('error' =>0,'msg'=>'Success',"data"=>array('order'=>$orders)));
        
    }  


    public function getCouponList_get(){
    
     $orders = $this->orderObj->getCouponList();
        
    $this->response(array('error' =>0,'msg'=>'Success',"data"=>$orders));
    }


    public function applyCouponCode_post(){
      $customer_id=$this->authorization_token->userData()->customer_id;
      //
      $post = json_decode($this->input->raw_input_stream, true);
      //
      $cartId=isset($post['cart_id']) ? $post['cart_id'] : "" ; 
      $couponCode=isset($post['coupon_code']) ? $post['coupon_code'] : "" ;

      $totalAmount=$this->customlibrary->getCheckoutSummery(45);
      print_r($totalAmount);
      exit();

      if($cartId!="" && $couponCode!=""){

        if($this->customlibrary->chkValideCode($couponCode)){
          if($this->customlibrary->chkValidityCouponCode($couponCode)){
            if($this->customlibrary->chkCouponCodeApplicable($totalAmount,$couponCode)){
                  $this->customlibrary->getCheckoutSummery($customerId,$couponCode);
            }else{
              $this->response(array('error' =>1,'msg'=>"Coupon not applicable for this anount"));
            }
          }else{
            $this->response(array('error' =>1,'msg'=>"Coupon Code expired"));
          }
        }else{
           $this->response(array('error' =>1,'msg'=>"Entered code is invalid"));
        }
        $this->response(array('error' =>1,'msg'=>$couponCode));
      }else{
        $this->response(array('error' =>1,'msg'=>'Some parameter missing'));
      }

    
    }
  

}

?>