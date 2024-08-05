<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

   function __construct(){
        parent::__construct();

        $this->load->model('product_model','productObj');
        $this->load->model('cart_model','cartObj');

          
   }
      



  public function index(){

    $userCookies=getCookies('customer');

    // $orderSumery=$this->customlibrary->getCartSummery();

    // print_r($orderSumery);

    // exit();

     // $cartItems= $this->cart->contents();
     // echo'<pre>';
     // print_r($cartItems);

     // $rowRecord=getCookiesRowId($cartItems,2,3);

     // print_r($rowRecord);
      //exit();

   // $this->load->view("frontend/cart/cart");  

    if(isset($userCookies['isCustomerLogin']) && $userCookies['isCustomerLogin']==1){

        $data['products'] = $this->cartObj->getCartList($userCookies['customer_id']);

        $data['saveProducts'] = $this->cartObj->getSaveLaterProducts($userCookies['customer_id']);


        $data['beforeCheckProducts'] = $this->cartObj->getBeforeCheckout();

        $data['isdelivered'] = $this->customlibrary->chkDeliveryLocation($this->customlibrary->getDefaultAddressPincode());

        $this->load->view("frontend/cart/index",$data);

    }else{
        $this->load->view("frontend/notlogin");  
    }

  }

  public function addToCart(){
    
    //print_r($this->input);

    if($this->input->is_ajax_request()){

        $userCookies=getCookies('customer');

        $product_id=$this->input->post('product_id');
        $variant_id = $this->input->post('variant_id');
        $qty = $this->input->post('qty');
        $cartType = $this->input->post('cartType');
        
        if($product_id!="" && $variant_id!="" && $qty!=0){
         
            $itemDetail=$this->productObj->getItemDetailByProductAndItemId($product_id,$variant_id);

            if(count($itemDetail)>0){

              if($itemDetail['stock'] > 0){

                if($itemDetail['stock'] > $qty){

                  if(isset($userCookies['isCustomerLogin']) && $userCookies['isCustomerLogin']==1){

                    $cartItem=$this->cartObj->getCartItem($userCookies['customer_id'],$product_id,$variant_id);

                    if(count($cartItem)>0){

                        if($cartType==2){    // 2  update 1=> remove
                            $qty=$cartItem['qty']+$qty;
                        }else{
                           $qty=$cartItem['qty']-$qty; 
                        }

                        if($qty==0){
                            $this->cartObj->deleteItemByCartId($userCookies['customer_id'],$cartItem['cart_id']);
                        }else{
                          $this->cartObj->updateItemQty($userCookies['customer_id'],$product_id,$variant_id,array('qty'=>$qty));
                        }
                        
                        $data['message']=$this->config->item('update_cart_success');

                    }else{

                      $cartProduct = array(
                      'user_id'       =>$userCookies['customer_id'],
                      'product_id'    =>$product_id,
                      'variant_id'    => $variant_id,
                       'qty'          => $qty,
                      );
                      $this->cartObj->itemSave($cartProduct);

                      $data['message']=$this->config->item('added_cart_success');
                    }

                    $itemCount=$this->customlibrary->total_items($userCookies['customer_id']);

                    $totalresponse=$this->cartObj->getTotalAmountWithSaving($userCookies['customer_id']);


                  }else{

                        $cartItems= $this->cart->contents();

                        if(count($cartItems)>0){

                            $rowRecord=getCookiesRowId($cartItems,$product_id,$variant_id);

                            if(count($rowRecord)>0){
                                if($cartType==2){    // 2  update 1=> remove
                                    $qty=$rowRecord['qty']+$qty;
                                }else{
                                   $qty=$rowRecord['qty']-$qty;

                                }

                                $data['message']=$this->config->item('update_cart_success');

                            }else{
                                 $cartProduct = array(
                                    'id'=>$product_id,
                                    'qty' =>$qty,
                                    'price' =>200,
                                    'name'=>"pname",
                                    'variant_id'=>$variant_id,
                                    'options' => array('variant_id' =>$variant_id)
                                );
                                $resopnse = $this->cart->insert($cartProduct);

                                $data['message']=$this->config->item('added_cart_success');
                            }

                        }else{
                            $cartProduct = array(
                                'id'=>$product_id,
                                'qty' =>$qty,
                                'price' =>200,
                                'name'=>"pname",
                                'variant_id'=>$variant_id,
                                'options' => array('variant_id' =>$variant_id)
                            );

                            $resopnse = $this->cart->insert($cartProduct);

                            $data['message']=$this->config->item('added_cart_success');

                        }
     
                    $itemCount=$this->cart->total_items();
                  }


                  // echo $this->cart->total_items();

                  $data['status']=1;
                  $data['saveTotalAmt']=isset($totalresponse['saveTotalAmt']) ? $totalresponse['saveTotalAmt'] : 0;
                  $data['totalPrice']=isset($totalresponse['totalPrice']) ? $totalresponse['totalPrice'] : 0;
                  $data['total_items']=$itemCount;
                  
                }else{
                  $data['status']=0;
                  $data['message']="Item insufficient";
                }


              }else{
                $data['status']=0;
                $data['message']=$this->config->item('out_of_stock');
                
              }

            }else{
                $data['status']=0;
                $data['message']="Item not exist";
            }
        }else{
            $data['status']=0;
            $data['message']="Some parameter missing";
        }
    }else{
        $data['status']=0;
        $data['message']="Method not allowed";
    }

    echo json_encode($data);
    exit();
  }

 
//
// Delevery Address
//    
public function deliveryAddress(){
    $userCookies=getCookies('customer');
    $customer_id = $userCookies['customer_id'];
    $data['addressList']=$this->customlibrary->getAllCustomerList($userCookies['customer_id']);
    $data['orderSumery']=$this->customlibrary->getCartSummery($customer_id);
    $data['customer_id']=$userCookies['customer_id'];
    $this->load->view("frontend/cart/address",$data); 
}
//
// Delevery Option
//  
public function checkout(){
    
    $userCookies=getCookies('customer');
  
    $customer_id = $userCookies['customer_id'];
    
    $data['products'] = $this->cartObj->getCartList($userCookies['customer_id']);

    if(count($data['products'])>0){

        $data['address_id'] = $this->customlibrary->getDefaultAddressId($userCookies['customer_id']);

        $data['orderSumery']=$this->customlibrary->getCartSummery($customer_id);

        $data['timeSlot'] = $this->cartObj->getTimeSlot();

        $data['customer_id']=$customer_id;

        $this->load->view("frontend/cart/delivery_option",$data);
    }else{
        return redirect('cart');    
    }

  
  }


public function paymentOption(){
    $userCookies=getCookies('customer');
    
    $customer_id = $userCookies['customer_id'];
    $data['customer_id']=$customer_id;

    $products = $this->cartObj->getCartList($userCookies['customer_id']);
    if(count($products)>0){
        $data['gstDetail']=$this->customlibrary->getCustomerGstDetailId();
        $data['order_no']='ORD'.date('Ymdhis');
        $data['couponList']=$this->cartObj->getCouponList();

        $data['orderSummery']=$this->orderSummeryForCart();



        $this->load->view("frontend/cart/paymentOption",$data);

    }else{
        return redirect('cart');  
    }
    
}

//
// Save To later
//
public function saveToLater() {
    if ($this->input->is_ajax_request()) {
        $userCookies = getCookies('customer');
        $customer_id = $userCookies['customer_id'];

        $cart_id = $this->input->post('cart_id');
        $product_id = $this->input->post('product_id');
        $variant_id = $this->input->post('variant_id');
        $data = array('status' => 0, 'message' => 'Some parameters are missing');

        if ($cart_id) {
            $itemDetail = $this->cartObj->getCartDetailByCartId($customer_id, $cart_id);

            if ($itemDetail) {
                if ($this->cartObj->saveTolaterItem(array('user_id' => $customer_id, 'product_id' => $itemDetail['product_id'], 'variant_id' => $itemDetail['variant_id']))) {
                    $this->cartObj->deleteItemByCartId($customer_id, $cart_id);
                    $data = array('status' => 1, 'message' => 'Product saved for later');
                } else {
                    $data['message'] = 'Failed to save product for later';
                }
            } else {
                $data['message'] = 'Item not found in cart';
            }
        } elseif ($product_id) {
            if ($this->cartObj->saveTolaterItem(array('user_id' => $customer_id, 'product_id' => $product_id, 'variant_id' => $variant_id))) {
                $data = array('status' => 1, 'message' => 'Product saved for later');
            } else {
                $data['message'] = 'Failed to save product for later';
            }
        }
        ob_clean();

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    } else {
        $data = array('status' => 0, 'message' => 'Method not allowed');
        ob_clean();

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}

public function deleteItem(){

       if($this->input->is_ajax_request()){

        $userCookies=getCookies('customer');

        $cart_id=$this->input->post('cart_id');
        $customer_id = $userCookies['customer_id'];
        
        
        if($cart_id!=""){
            if($this->cartObj->deleteItemByCartId($customer_id,$cart_id)){
                $data['status']=1;
                $data['message']='Prduct to save to later';
            }else{
                $data['status']=0;
                $data['message']='Not delete item';
            }

        }else{
            $data['status']=0;
            $data['message']="Some parameter missing";
        }
    }else{
        $data['status']=0;
        $data['message']="Method not allowed";
    }
    echo json_encode($data);
    exit();
    }



// public function deliveryOption(){
//    $this->load->view("frontend/cart/delivery_option");  
// }

//
// Apply Coupon code
//   
public function applyCouponCode(){
    $currentDate=date('Y-m-d');
    $userCookies=getCookies('customer');
   
    $coupon_code=$this->input->post('couponcode');

    if($coupon_code!=''){
        $couponCodeDetail=$this->cartObj->getCouponCodeDetail($coupon_code);
        
        if(count($couponCodeDetail) > 0){
            
            if($currentDate > $couponCodeDetail['start_date'] && $currentDate < $couponCodeDetail['end_date']){

                $AmountDetail=$this->customlibrary->getTotalCartAmount($userCookies['customer_id']);
                if($AmountDetail['totalPrice']> $couponCodeDetail['min']){
                    $couponDiscoutAmt=$this->customlibrary->getCouponDiscount($AmountDetail['totalPrice'],$coupon_code);

                    $cardSummery=$this->customlibrary->getCartSummery($customer_id);
                    $data['orderSumery']=$cardSummery;
                    $data['status']=1;
                    $data['message']="succes";  
                }else{
                    $data['status']=0;
                    $data['message']="Not applicable on this amount";  
                }
            }else{
              $data['status']=0;  
              $data['message']="Coupon code expired";  
            }
        }else{
            $data['status']=0;
            $data['message']="Invalid coupon code";
        }
    }else{
        $data['status']=0;
        $data['message']="Some parameter missing";
    }
   
    echo json_encode($data);
    exit();
}

//
//Order Submmer
//

public function orderSummeryForCart(){
   $userCookies=getCookies('customer');
   $customer_id = $userCookies['customer_id'];

   
    $shipingCharg=30;
    $totalSellingPrice=0;
    $totalMrpPrice=0;
    $totalSave=0;
    $totalPayAmout=0;
    $couponDisc=0;

    $cartProduct = $this->cartObj->getCartList($customer_id);

    if(count($cartProduct)){
         foreach($cartProduct as $record){
                // echo'<pre>';
                // print_r($record);
                // echo'</pre>';

                if($record['before_off_price']>$record['price']){

                   $totalSellingPrice=$totalSellingPrice+($record['price']*$record['cart_qty']);
                   
                    $totalMrpPrice=$totalMrpPrice+($record['before_off_price']*$record['cart_qty']);

                }else{
                  $totalSellingPrice=$totalSellingPrice+$record['price']*$record['cart_qty'];  
                }

               
            }

            $totalSave=$totalMrpPrice-$totalSellingPrice;

            $totalPayAmout=$totalSellingPrice+$shipingCharg;

        }
        
        return array('totalSellingPrice'=>$totalSellingPrice,'totalMrpPrice'=>$totalMrpPrice,'totalSave'=>$totalSave,'totalPayAmout'=>$totalPayAmout,'shipingcharge'=>$shipingCharg,'couponDisc'=>$couponDisc);
    }

    public function delete() {
        $addr_id = $this->input->post('addr_id');
        if ($addr_id && $this->cartObj->delete_address($addr_id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    
    public function cancel_order() {
        $order_id = $this->input->post('order_id');
    
        if ($this->cartObj->cancelOrder($order_id)) {
            echo 'Order cancelled successfully';
        } else {
            echo 'Failed to cancel order';
        }
    }



}
?>