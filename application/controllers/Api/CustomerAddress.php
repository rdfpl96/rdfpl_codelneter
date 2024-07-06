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

        if($customer_id!="" && $product_id!="" && $variant_id!="" && $qty!=0 && $actionType!=""){
            
            $itemDetail=$this->productObj->getItemDetailByProductAndItemId($product_id,$variant_id);

            if(count($itemDetail)>0){
                
                if($itemDetail['stock'] > 0){

                    if($itemDetail['stock'] > $qty){
                        
                        $cartItem=$this->cartObj->getCartItem($customer_id,$product_id,$variant_id);

                        if(count($cartItem)>0){

                            if($actionType==2){    // 2 =>update 1=> remove
                                $qty=$cartItem['qty']+$qty;
                            }else{
                               $qty=$cartItem['qty']-$qty; 
                            }

                            if($qty==0){
                                $this->cartObj->deleteItemByCartId($customer_id,$cartItem['cart_id']);
                            }else{
                              $this->cartObj->updateItemQty($customer_id,$product_id,$variant_id,array('qty'=>$qty));
                            }
                            
                            $message=$this->config->item('update_cart_success');

                        }else{

                          $cartProduct = array(
                          'user_id'       =>$customer_id,
                          'product_id'    =>$product_id,
                          'variant_id'    => $variant_id,
                           'qty'          => $qty,
                          );
                          $this->cartObj->itemSave($cartProduct);

                          $message=$this->config->item('added_cart_success');
                        }

                        $itemCount=$this->customlibrary->total_items($customer_id);

                        $this->response(array('error' =>0,'msg'=>$message,'total_items'=>$itemCount));

                    }else{

                        $this->response(array('error' =>1,'msg'=>'Item insufficient'));
                    }

                }else{
                    $this->response(array('error' =>1,'msg'=>$this->config->item('out_of_stock')));
                }

            }else{
                $this->response(array('error' =>1,'msg'=>'Item not exist'));
            }

        }else{

            $this->response(array('error' =>1,'msg'=>'Some parameter missing'));
        } 
    }

}

?>