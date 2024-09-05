<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Payment extends CI_Controller {

    function __construct(){
         parent::__construct();

        $this->load->model('product_model','productObj');
        $this->load->model('payment_model','paymentObj');  
        $this->load->model('cart_model','cartObj'); 
        
        $this->load->library('payment/transactionRequestBean');
         $this->load->library('payment/transactionResponseBean');
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
    
        $strNo = rand(1, 1000000);     

    
        $this->transactionrequestbean->merchantCode = 'T1040192';
        $this->transactionrequestbean->ITC ='email:demo@demo.com';
        $this->transactionrequestbean->customerName = 'pramod';
        $this->transactionrequestbean->requestType ='T';
        $this->transactionrequestbean->merchantTxnRefNumber = $strNo;
        $this->transactionrequestbean->amount = 1;
        $this->transactionrequestbean->currencyCode = "INR";
        $this->transactionrequestbean->returnURL =base_url('payment/Response');
        $this->transactionrequestbean->shoppingCartDetails = 'FIRST_1.0_0.0';
        $this->transactionrequestbean->TPSLTxnID ="";
        $this->transactionrequestbean->mobileNumber = "9004649745";
        $this->transactionrequestbean->txnDate = date('Y-m-d');
        $this->transactionrequestbean->bankCode = 470;
        $this->transactionrequestbean->custId = '19872627';
        $this->transactionrequestbean->key ='7117036559RRVMUJ';
        $this->transactionrequestbean->iv ='1764062627XUSNOS';
        $this->transactionrequestbean->accountNo = '';
        $this->transactionrequestbean->webServiceLocator ='https://www.tpsl-india.in/PaymentGateway/TransactionDetailsNew.wsdl';
        $this->transactionrequestbean->timeOut =60;

        $responseDetails = $this->transactionrequestbean->getTransactionToken();
        $responseDetails = (array)$responseDetails;
        $response = $responseDetails[0];
        
        //$this->load->view('frontend/payment/pay',array('response'=>$response));
        
        echo "<script>window.location = '" . $response . "'</script>";
        ob_flush();
        // print_r($response);
        // exit();
    }

    public function Response(){
        $response = $_POST;

         if (is_array($response)) {
            $str = $response['msg'];
        } else if (is_string($response) && strstr($response, 'msg=')) {
            $outputstr = str_replace('msg=', '', $response);
            $outputArr = explode('&', $outputstr);
            $str = $outputArr[0];
        } else {
            $str = $response;
        }
       
        $this->transactionresponsebean->setResponsePayload($str);
        $this->transactionresponsebean->key ='7117036559RRVMUJ';
        $this->transactionresponsebean->iv ='1764062627XUSNOS';
        $response = $this->transactionresponsebean->getResponsePayload();

        $responseArr= explode("|", $response);
        $resArray=convertArrayFormate($responseArr);

        if(is_array($resArray) && count($resArray)>0){
            $insertArray=array(
                "order_no"=>$resArray['order_no'],
                "order_id"=>$resArray['order_id'],
                "txn_status"=>$resArray['txn_status'],
                "txn_msg"=>$resArray['txn_msg'],
                "txn_err_msg"=>$resArray['txn_err_msg'],
                "clnt_txn_ref"=>$resArray['clnt_txn_ref'],
                "tpsl_bank_cd"=>$resArray['tpsl_bank_cd'],
                "tpsl_txn_id"=>$resArray['tpsl_txn_id'],
                "txn_amt"=>$resArray['txn_amt'],
                "tpsl_rfnd_id"=>$resArray['tpsl_rfnd_id'],
                "bal_amt"=>$resArray['bal_amt'],
                "rqst_token"=>$resArray['rqst_token'],
                "hash"=>$resArray['hash'],
                "tpsl_txn_time"=>date('Y-m-d H:i:s',strtotime($resArray['tpsl_txn_time'])),
            );

            //print_r($insertArray);
          
            $this->paymentObj->insertPaymentResp($insertArray);
            
            if($insertArray['txn_msg']=='success'){
              
                 redirect(base_url('payment/success/'.$insertArray['order_no']));
                
            }else{
                redirect(base_url('payment/success/'.$insertArray['order_no']));
            }   

        }else{
            $this->load->view('frontend/404page'); 
        }
       
    }


    public function success($order_no=""){
       
        if($this->paymentObj->orderExist($order_no)){
            $data['order_no']=$order_no;
          $this->load->view('frontend/payment/success',$data);  
        }else{
            $this->load->view('frontend/404page'); 
        }
        
    }
}

?>