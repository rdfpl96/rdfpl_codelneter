<?php
require(APPPATH.'/libraries/REST_Controller.php');
 
 
class CustomerAddress extends REST_Controller{



  public function __construct() {
    parent::__construct();
    
    $this->load->model('api/product_model','productObj');
    $this->load->model('cart_model','cartObj');
    
    $validation=$this->authorization_token->validateToken();
    
    if($validation['status']!=0){

        $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
        echo json_encode($res);
        exit();
        }

    }

    public function index_get(){
        $cartProduct=array();
        $total_save=0;
        $customer_id=$this->authorization_token->userData()->customer_id;
        
        $products = $this->cartObj->getCartList($customer_id);
        
        $this->response(array('error' =>0,'msg'=>'Success',"data"=>array('products'=>$cartProduct,'total_save'=>$total_save)));
    }  
  
    public function addToCart_post(){

        $customer_id=$this->authorization_token->userData()->customer_id;

        $post = json_decode($this->input->raw_input_stream, true);

        $product_id=isset($post['product_id']) ? $post['product_id'] : "" ; 
        $variant_id=isset($post['variant_id']) ? $post['variant_id'] : "" ; 
        $qty=isset($post['qty']) ? $post['qty'] : 0 ; 
        $actionType=isset($post['action_type']) ? $post['action_type'] : "" ;

        'customer_id' => $customer_id,
        'fname' => $this->input->post('fname'),
        'lname' => $this->input->post('lname'),
        'mobile' => $this->input->post('mobile'),
        'address1' => $this->input->post('apart_house'),
        'address2' => $this->input->post('apart_name'),
        'area' => $this->input->post('area'),
        'landmark' => $this->input->post('street_landmark'),
        'state' => $this->input->post('state'),
        'city' => $this->input->post('city'),
        'pincode' => $this->input->post('pincode'),
        'address_type' => $this->input->post('loc_type'),
        'others' => $this->input->post('other_loc')
    }

}

?>