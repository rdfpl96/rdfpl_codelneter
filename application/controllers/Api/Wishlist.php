<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class WishList extends REST_Controller {

   function __construct(){
        parent::__construct();

        $this->load->model('product_model','productObj');
        $this->load->model('wishlist_model','wishlistObj');

       $validation=$this->authorization_token->validateToken();
    
        if($validation['status']!=0){

        $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
        echo json_encode($res);
        exit();
        }    
   }
      
public function index_get(){

    $customer_id=$this->authorization_token->userData()->customer_id;
    
    $products = $this->wishlistObj->getWishList($customer_id);
    
    $wishlistProduct=array();

    if(count($products)>0){
        foreach ($products as $product) {
                $wishlistProduct[]=array(
                    'product_id'=>$product['product_id'],
                    'product_name'=>stripslashes($product['product_name']),
                    'feature_img'=>base_url('uploads/'.$product['feature_img']),
                    "items"=>$this->customlibrary->getProductItemByproductId($product['product_id'])
                );
            }
        $this->response(array('error' =>1,'msg'=>'Success',"data"=>$wishlistProduct));     
    }else{
         $this->response(array('error' =>1,'msg'=>'Your wishlist is empty',"data"=>[])); 
    }
    
    }

    public function addToWishList_post(){

    $customer_id=$this->authorization_token->userData()->customer_id;
    
    $post = json_decode($this->input->raw_input_stream, true);

    $product_id=isset($post['product_id']) ? $post['product_id'] : "" ; 
    
    if($product_id!=""){
        
        if(!$this->wishlistObj->chkItemAlreaddyPresent($product_id, $customer_id)){

            if($this->wishlistObj->itemSave(array('product_id'=>$product_id,'cust_id'=>$customer_id))){
            
            $pcount=$this->customlibrary->getWishListCount($customer_id);
            
            $this->response(array('error' =>0,'msg'=>'Item add to wish list','data'=>array('pcount'=>$pcount))); 

           }else{
            
            $this->response(array('error' =>1,'msg'=>'Something went wrong')); 
           } 

        }else{
            $this->response(array('error' =>1,'msg'=>'Product already parent')); 
        }
    }else{
        
        
        $this->response(array('error' =>1,'msg'=>'Some parameter missing')); 
    }
    }


    public function delteWishItem_get($product_id=""){

        $customer_id=$this->authorization_token->userData()->customer_id;

        if($customer_id!="" && $product_id!="" ){
            
            if($this->wishlistObj->removeProductFromWilist($customer_id,$product_id)){}
            $this->response(array('error' =>0,'msg'=>'Removed Item from wishlist.'));

        }else{

            $this->response(array('error' =>1,'msg'=>'Some parameter missing'));
        } 
    }
}

?>