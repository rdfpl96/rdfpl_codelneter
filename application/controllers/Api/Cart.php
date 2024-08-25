<?php
require(APPPATH.'/libraries/REST_Controller.php');
 
 
class Cart extends REST_Controller{

   public function __construct() {
    parent::__construct();
    
        $this->load->model('api/product_model','productObj');
        $this->load->model('cart_model','cartObj');
        $this->load->model('api/order_model','orderObj');
    
        $validation=$this->authorization_token->validateToken();
    
        if($validation['status']!=0){

        $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
        echo json_encode($res);
        exit();
        }
    }

    public function index_get(){
        $cartProduct=array();
        $saveProduct=array();
        $total_save=0;
        $customer_id=$this->authorization_token->userData()->customer_id;

        $products = $this->cartObj->getCartList($customer_id);
        
        $saveLaterProducts = $this->cartObj->getSaveLaterProducts($customer_id);

        if(count($products)>0){
            foreach ($products as $product) {
                $cartProduct[]=array(
                    'product_id'=>$product['product_id'],
                    'product_name'=>stripslashes($product['product_name']),
                    'feature_img'=>base_url('uploads/'.$product['feature_img']),
                    'pack_size'=>stripslashes($product['pack_size']).$product['units'],
                    'price'=>$product['price'],
                    'before_off_price'=>$product['before_off_price'],
                    'cart_qty'=>$product['cart_qty'],
                    'cart_id'=>$product['cart_id'],
                    'variant_id'=>$product['variant_id'],

                );
                
                $saveAmt=$product['before_off_price'] > $product['price'] ? ($product['before_off_price']*$product['cart_qty']-$product['price']*$product['cart_qty']) : 0;
                $total_save=$total_save+$saveAmt;
            }
        }

        if(count($saveLaterProducts)>0){
            foreach ($saveLaterProducts as $product) {
                $saveProduct[]=array(
                    'product_id'=>$product['product_id'],
                    'product_name'=>stripslashes($product['product_name']),
                    'feature_img'=>base_url('uploads/'.$product['feature_img']),
                    'pack_size'=>stripslashes($product['pack_size']).$product['units'],
                    'price'=>$product['price'],
                    'before_off_price'=>$product['before_off_price'],
                    'save_id'=>$product['id'],
                    'variant_id'=>$product['variant_id'],

                );
            }
        }

        if(count($cartProduct)>0 || count($saveProduct)>0){
            $this->response(array('error' =>0,'msg'=>'Success',"data"=>array('products'=>$cartProduct,'total_save'=>$total_save,'saveLaterProduct'=>$saveProduct)));
        }
        else{
           $this->response(array('error' =>1,'msg'=>'Your cart is empty',"data"=>[])); 
        }
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

    public function delteCartItem_get($cart_id=""){

        $customer_id=$this->authorization_token->userData()->customer_id;

        $post = json_decode($this->input->raw_input_stream, true);

        if($customer_id!="" && $cart_id!="" ){
            
            $itemDetail = $this->cartObj->getCartDetailByCartId($customer_id, $cart_id);
            if($itemDetail){
                if($this->cartObj->deleteItemByCartId($customer_id,$cart_id)){
              $this->response(array('error' =>0,'msg'=>'Removed Item from cart.'));  
              }else{
                 $this->response(array('error' =>1,'msg'=>'Not delted item')); 
              }
          }else{
             $this->response(array('error' =>1,'msg'=>'Product not present')); 
          }
           
        }else{

            $this->response(array('error' =>1,'msg'=>'Some parameter missing'));
        } 
    }

    public function saveLater_post(){

        $post = json_decode($this->input->raw_input_stream, true);

        $customer_id=$this->authorization_token->userData()->customer_id;

        $cart_id=isset($post['cart_id']) ? $post['cart_id'] : "" ; 
        $product_id=isset($post['product_id']) ? $post['product_id'] : "" ; 
        $variant_id=isset($post['variant_id']) ? $post['variant_id'] : "" ; 

        if($cart_id!="" && $product_id!="" && $variant_id!=""){

            $itemDetail = $this->cartObj->getCartDetailByCartId($customer_id, $cart_id);

            if ($itemDetail) {
                if ($this->cartObj->saveTolaterItem(array('user_id' => $customer_id, 'product_id' => $itemDetail['product_id'], 'variant_id' => $itemDetail['variant_id']))) {
                    $this->cartObj->deleteItemByCartId($customer_id, $cart_id);
                    $this->response(array('error' =>1,'msg'=>'Product saved for later'));
                    
                } else {
                   $this->response(array('error' =>1,'msg'=>'Failed to save product for later'));
                }
            } else {
                $this->response(array('error' =>1,'msg'=>'Item not found in cart'));
            }

        }else{
             $this->response(array('error' =>1,'msg'=>'Some parameter missing'));
        }
    }

    public function delteSavedItem_get($save_id=""){

        $customer_id=$this->authorization_token->userData()->customer_id;

        $post = json_decode($this->input->raw_input_stream, true);

        if($customer_id!="" && $save_id!="" ){
            if($this->cartObj->deleteItemBySaveId($customer_id,$save_id)){}
            $this->response(array('error' =>0,'msg'=>'Removed Item.'));
        }else{

            $this->response(array('error' =>1,'msg'=>'Some parameter missing'));
        } 
    }

    public function moveToCart_post(){

        $post = json_decode($this->input->raw_input_stream, true);

        $customer_id=$this->authorization_token->userData()->customer_id;

        $save_id=isset($post['save_id']) ? $post['save_id'] : "" ; 
        

        if($save_id!="" && $customer_id!=""){

            $itemDetail = $this->cartObj->getSaveDetailBySaveId($customer_id, $save_id);

            if ($itemDetail) {
                if ($this->cartObj->itemSave(array('user_id' => $customer_id, 'product_id' => $itemDetail['product_id'], 'variant_id' => $itemDetail['variant_id'],'qty'=>1))) {
                    $this->cartObj->deleteItemBySaveId($customer_id, $save_id);
                    $this->response(array('error' =>1,'msg'=>'Product moved to cart'));
                    
                } else {
                   $this->response(array('error' =>1,'msg'=>'Failed to moved to cart'));
                }
            } else {
                $this->response(array('error' =>1,'msg'=>'Item not found in cart'));
            }

        }else{
             $this->response(array('error' =>1,'msg'=>'Some parameter missing'));
        }
    }
    
    public function checkout_get(){

        $customer_id=$this->authorization_token->userData()->customer_id;

        $products = $this->cartObj->getCartList($customer_id);
        if(count($products)>0){
            $cartSummery=$this->customlibrary->getCartSummery($customer_id);
            $order_no="ORD".date('YmdmHis');
            $this->response(array('error' =>0,'msg'=>'Success',"data"=>$cartSummery,'order_no'=>$order_no));
        }else{
            $this->response(array('error' =>1,'msg'=>'Cart empty'));
        }
    }


    public function getCouponList_get(){
    
        $orders = $this->orderObj->getCouponList();
        
        $this->response(array('error' =>0,'msg'=>'Success',"data"=>$orders));
    }
    
    public function applyCouponCode_post(){
        $currentDate=date('Y-m-d');
        $customer_id=$this->authorization_token->userData()->customer_id;
        //
        $post = json_decode($this->input->raw_input_stream, true);
        //
       
        $couponCode=isset($post['coupon_code']) ? $post['coupon_code'] : "" ;
      
        if($couponCode!=""){

            $couponCodeDetail=$this->cartObj->getCouponCodeDetail($couponCode);
            if(count($couponCodeDetail) > 0){
                if($currentDate > $couponCodeDetail['start_date'] && $currentDate < $couponCodeDetail['end_date']){
                    $AmountDetail=$this->customlibrary->getTotalCartAmount($customer_id);

                    if($AmountDetail['totalPrice'] > $couponCodeDetail['min_purch_amt']){

                        $couponDiscoutAmt=$this->customlibrary->getCouponDiscount($AmountDetail['totalPrice'],$coupon_code);
                        
                        $cartSummery=$this->customlibrary->getCartSummery($customer_id,$couponDiscoutAmt);
                        
                        $this->response(array('error' =>0,'msg'=>'Success',"data"=>$cartSummery));

                    }else{
                        $this->response(array('error' =>1,'msg'=>"Coupon not applicable for this anount"));
                    }

                }else{
                    $this->response(array('error' =>1,'msg'=>"Coupon Code expired"));
                }

        
        }else{
           $this->response(array('error' =>1,'msg'=>"Entered code is invalid"));
        }
      
      }else{
        $this->response(array('error' =>1,'msg'=>'Please enter coupon code'));
      }
    }



}

?>