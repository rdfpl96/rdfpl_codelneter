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
    }

    public function test(){
        echo'Tessting by Pramod';
    }
}

?>