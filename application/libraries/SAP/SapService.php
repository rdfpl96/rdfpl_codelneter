<?php
class SapService 
   {
   var $CI;
    public function __construct($params = array()){

       $this->CI =& get_instance();

       $custDetail=getCookies('customer');

       $this->customerId=isset($custDetail['customer_id']) ? $custDetail['customer_id'] : '' ;

       $this->CI->load->model('cart_model','cartObj');
       $this->CI->load->model('common_model');
       $this->CI->load->model('frontlogin_model','loginObj');
    }

    public function getProductItemList(){
        
        return getProductItemList();
    }

    public function getProductItem($item_code){
        
        return getProductItem($item_code);
    }

    public function getSingleStock($item_code){
        return getSingleStock($item_code);
    }

    public function getStockList(){
        return getStockList();
    }


    //
    // Insert New Customer
    //

    public function createCustomer($custId,$array_data){
        $object=(object)$array_data;
        $body=json_encode($object);
        $res=createCustomer($body);
       
        $cardCode=isset($res['CardCode']) && $res['CardCode']!="" ? $res['CardCode'] : "";
        
        $this->CI->loginObj->updateUserDataByUserId($custId, ['card_code' => $cardCode]);
    }

    public function updateCustomer($body){
        // $object=(object)$array_data;
        // $body=json_encode($object);
        $res=updateCustomer($body);
        //print_r($res);
       
    }

}

?>