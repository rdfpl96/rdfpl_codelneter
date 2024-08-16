<?php
require(APPPATH.'/libraries/REST_Controller.php');
 
 
class Payment extends REST_Controller{


    function __construct(){
         parent::__construct();

     
        $this->load->model('payment_model','paymentObj');  
        $this->load->model('cart_model','cartObj');

       // $validation=$this->authorization_token->validateToken();
    
        // if($validation['status']!=0){

        // $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
        // echo json_encode($res);
        // exit();
        // }  
    }
   
    public function index(){
    }

    public function placeOrder_post(){

       $customer_id=$this->authorization_token->userData()->customer_id;
       $post = json_decode($this->input->raw_input_stream, true);

        $address_id=isset($post['address_id']) & $post['address_id']!='' ? $post['address_id'] : '';
        $delivery_date =isset($post['delivery_date']) & $post['delivery_date']!='' ? $post['delivery_date'] : '';
        $delivery_time=isset($post['delivery_time']) & $post['delivery_time']!='' ? $post['delivery_time'] : '';
        $gst_id=isset($post['gst_id']) & $post['gst_id']!='' ? $post['gst_id'] : 0;
        $order_no=isset($post['order_no']) & $post['order_no']!='' ? $post['order_no'] : '';
        $coupon_code=isset($post['coupon_code']) & $post['coupon_code']!='' ? $post['coupon_code'] : '';
        $delivery_charge=0;

        $couponId=0;

        if($address_id!="" && $delivery_date!="" && $delivery_time!="" && $order_no!=""){

            if(!$this->paymentObj->orderExist($order_no)){

                $orderData=array(
                "customer_id"=>1,
                "order_no"=>$order_no,
                "address_id"=>$address_id,
                "gst_id"=>$gst_id,
                "delivery_date"=>$delivery_date,
                "delivery_time"=>$delivery_time,
                "delivery_charge"=>$delivery_charge,
                "coupon_id"=>$couponId,

                );
                $products = $this->cartObj->getCartList(1);

                    if($this->paymentObj->orderSave($orderData,$products)){
                        
                        $data['status']=0;
                        $date['message']="Order Placed succesfully";
                        $data['order_no']=$order_no;

                    }else{
                       
                        $this->response(array('error' =>1,'msg'=>'Something wrong try again'));
                    }
                }else{
                    
                    $this->response(array('error' =>1,'msg'=>'Order already placed'));
                }
            }else{
                $this->response(array('error' =>1,'msg'=>'Some parameter missing'));
            }
    }

    public function online(){

    }


    public function success($order_no){

        if($this->paymentObj->orderExist($order_no)){
            $data['order_no']=$order_no;
          $this->load->view('frontend/payment/success',$data);  
        }else{
            $this->load->view('frontend/404page'); 
        }
        
    }
}

?>