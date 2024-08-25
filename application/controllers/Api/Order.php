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
        $arrayOrder=array();
        //
        $customer_id=$this->authorization_token->userData()->customer_id;

        // 
        $orders = $this->orderObj->getAllOrder(1,10,$customer_id);
       
        if(count($orders)>0){
            foreach($orders as $record){
                $record['order_payment_status']="Not Paid";
                $record['order_items']=$this->orderObj->getOrderItemByOrderId($record['id']);
                //
                $record['address']=$this->customlibrary->getAddresDetailByAddressById($record['customer_id'],$record['address_id']);
                //
                $record['orderSummery']=$this->getOrderSummery($record,$record['order_items']);
                //
                $record['delivery_steps']=array();
                
                $arrayOrder[]=$record;
            }

        }
        $this->response(array('error' =>0,'msg'=>'Success',"data"=>array('order'=>$arrayOrder)));
    }


public function getOrderSummery($order,$orderItem){
    $totalSellingPrice=0;
    $totalMrpPrice=0;
    $totalSave=0;
    $shipingCharg=0;
    $couponDisc=0;
    foreach($orderItem as $record){
        
        if($record['mrp_price']==0){
             
            $totalMrpPrice=$totalMrpPrice+($record['price']*$record['qty']);
             $totalSellingPrice=$totalSellingPrice+($record['price']*$record['qty']);
           
            }else{
               
            $totalSellingPrice=$totalSellingPrice+($record['price']*$record['qty']);
           
            $totalMrpPrice=$totalMrpPrice+($record['mrp_price']*$record['qty']);
        }
    }
    
      
        $totalSave=$totalMrpPrice-$totalSellingPrice;

        $totalPayAmout=$totalSellingPrice+$shipingCharg-$couponDisc;

        return array('totalSellingPrice'=>$totalSellingPrice,'totalMrpPrice'=>$totalMrpPrice,'totalSave'=>$totalSave,'totalPayAmout'=>$totalPayAmout,'shipingcharge'=>$shipingCharg,'couponDisc'=>$couponDisc);

    }  


}

?>