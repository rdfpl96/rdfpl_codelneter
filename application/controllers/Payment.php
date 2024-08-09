<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Payment extends CI_Controller {

    function __construct(){
         parent::__construct();

        $this->load->model('product_model','productObj');
        $this->load->model('payment_model','paymentObj');  
        $this->load->model('cart_model','cartObj');  
    }
   
    public function index(){

    }
    public function cod(){

        if($this->input->is_ajax_request()){
        $userCookies=getCookies('customer');
        $buyTypeCookies=getCookies('buynowDetail');
        $buyType=$buyTypeCookies['buytype'];
        $customer_id = $userCookies['customer_id'];

        $address_id=isset($_POST['address_id']) & $_POST['address_id']!='' ? $_POST['address_id'] : '';
        $delivery_date =isset($_POST['sdate']) & $_POST['sdate']!='' ? $_POST['sdate'] : '';
        $delivery_time=isset($_POST['stime']) & $_POST['stime']!='' ? $_POST['stime'] : '';
        $gst_id=isset($_POST['gst_id']) & $_POST['gst_id']!='' ? $_POST['gst_id'] : 0;
        $order_no=isset($_POST['order_no']) & $_POST['order_no']!='' ? $_POST['order_no'] : '';
        $couponId=isset($_SESSION['coupon_id']) & $_SESSION['coupon_id']!='' ? $_SESSION['coupon_id'] : 0;
        $delivery_charge=0;
        if($address_id!="" && $delivery_date!="" && $delivery_time!="" ){

            if(!$this->paymentObj->orderExist($order_no)){

                $orderData=array(
                "customer_id"=>$customer_id,
                "order_no"=>$order_no,
                "address_id"=>$address_id,
                "gst_id"=>$gst_id,
                "delivery_date"=>$delivery_date,
                "delivery_time"=>$delivery_time,
                "delivery_charge"=>$delivery_charge,
                "coupon_id"=>$couponId,

                );

                    if($buyType==1){
                        $products = $this->cartObj->getProductBy($customer_id,$buyTypeCookies['product_id'],$buyTypeCookies['variant_id'],$buyTypeCookies['qty']);
                    }else{
                        $products = $this->cartObj->getCartList($customer_id);
                    }
                    
                    if($this->paymentObj->orderSave($orderData,$products)){
                        unset($_SESSION["coupon_id"]);
                        $data['status']=0;
                        $date['message']="Order Placed succesfully";
                        $data['order_no']=$order_no;

                    }else{
                        $data['status']=1;
                        $data['message']="Something wrong try again";
                    }
                }else{
                    $data['status']=1;
                    $data['message']="Order already placed";
                }
            }else{
                $data['status']=1;
                $data['message']="Some parameter missing";
            }
        }else{
            $data['status']=1;
            $data['message']="Some parameter missing";
        }
        echo json_encode($data);
        exit();
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