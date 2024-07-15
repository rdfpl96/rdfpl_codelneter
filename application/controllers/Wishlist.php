<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WishList extends CI_Controller {

   function __construct(){
        parent::__construct();

        $this->load->model('product_model','productObj');
        $this->load->model('wishlist_model','wishlistObj');

          
   }
      
public function index(){

    $userCookies=getCookies('customer');

     $cartItems= $this->cart->contents();

   // $this->load->view("frontend/cart/cart");  

    if(isset($userCookies['isCustomerLogin']) && $userCookies['isCustomerLogin']==1){
        $data['itemDisplyNummber'] = 4;
        $data['unique'] = 'tab-slide';
        $data['products'] = $this->wishlistObj->getWishList($userCookies['customer_id']);
        // print_r($data);
        // exit;
        $this->load->view("frontend/wishlist/index",$data);

    }else{
       $this->load->view("frontend/notlogin");
    }

  }

// public function addToWishList(){
//     if ($this->input->is_ajax_request()) {
//         $userCookies = getCookies('customer');
//         $product_id = $this->input->post('product_id');

//         if (!empty($product_id)) {
//             if (isset($userCookies['isCustomerLogin']) && $userCookies['isCustomerLogin'] == 1) {
//                 if (!$this->wishlistObj->chkItemAlreaddyPresent($product_id, $userCookies['customer_id'])) {
//                     if ($this->wishlistObj->itemSave(['product_id' => $product_id, 'cust_id' => $userCookies['customer_id']])) {
//                         $data['status'] = 1;
//                         $data['pcount'] = $this->customlibrary->getWishListCount($userCookies['customer_id']);
//                         $data['message'] = "Item added to wishlist";
//                     } else {
//                         $data['status'] = 0;
//                         $data['message'] = "Something went wrong";
//                     }
//                 } else {
//                     $data['status'] = 0;
//                     $data['message'] = "Product already in wishlist";
//                 }
//             } else {
//                 $data['status'] = 0;
//                 $data['message'] = "You are not logged in. Please log in.";
//             }
//         } else {
//             $data['status'] = 0;
//             $data['message'] = "Product ID is missing";
//         }
//     } else {
//         $data['status'] = 0;
//         $data['message'] = "Method not allowed";
//     }

//     echo json_encode($data);
//     exit();
// }

public function addToWishList() {
    if ($this->input->is_ajax_request()) {
        $userCookies = getCookies('customer');
        $product_id = $this->input->post('product_id');
        $action = $this->input->post('action');

        if (!empty($product_id)) {
            if (isset($userCookies['isCustomerLogin']) && $userCookies['isCustomerLogin'] == 1) {
                if ($action == 'remove') {
                    // Remove from wishlist
                    if ($this->wishlistObj->removeItem(['product_id' => $product_id, 'cust_id' => $userCookies['customer_id']])) {
                        $data['status'] = 1;
                        $data['pcount'] = $this->customlibrary->getWishListCount($userCookies['customer_id']);
                        $data['message'] = "Item removed from wishlist";
                    } else {
                        $data['status'] = 0;
                        $data['message'] = "Something went wrong";
                    }
                } else {
                    // Add to wishlist
                    if ($this->wishlistObj->itemSave(['product_id' => $product_id, 'cust_id' => $userCookies['customer_id']])) {
                        $data['status'] = 1;
                        $data['pcount'] = $this->customlibrary->getWishListCount($userCookies['customer_id']);
                        $data['message'] = "Item added to wishlist";
                    } else {
                        $data['status'] = 0;
                        $data['message'] = "Something went wrong";
                    }
                }
            } else {
                $data['status'] = 0;
                $data['message'] = "You are not logged in. Please log in.";
            }
        } else {
            $data['status'] = 0;
            $data['message'] = "Product ID is missing";
        }
    } else {
        $data['status'] = 0;
        $data['message'] = "Method not allowed";
    }

    echo json_encode($data);
    exit();
}




}

?>