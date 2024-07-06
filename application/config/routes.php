<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';

// ======================Start Admin Route======================


$route['period_type']='admin/period_type';


$route['admin/other-product']='AdminPanel/otherProduct';
$route['admin/other-product/add']='AdminPanel/addOtherProduct';

$route['admin']='AdminPanel/home/index';
$route['admin/login']='AdminPanel/login/index';
$route['admin/product']='AdminPanel/product/index';
$route['admin/product/create']='AdminPanel/product/create';
$route['admin/product/save']='AdminPanel/product/save';
$route['admin/product/edit/(:num)']='AdminPanel/product/edit/$1';
$route['admin/product/update/(:num)']='AdminPanel/product/update/$1';

//category
$route['admin/category']='AdminPanel/category/index';
$route['admin/category/create'] = 'AdminPanel/category/create';
$route['admin/category/store'] = 'AdminPanel/category/store';
$route['admin/category/edit/(:num)']='AdminPanel/category/update/$1';

//subcategory
$route['admin/subcategory']='AdminPanel/subcategory/index';
$route['admin/subcategory/create'] = 'AdminPanel/subcategory/create';
$route['admin/subcategory/store'] = 'AdminPanel/subcategory/store';
$route['admin/subcategory/edit/(:num)'] = 'AdminPanel/subcategory/edit/$1';
$route['admin/subcategory/update/(:num)'] = 'AdminPanel/subcategory/update/$1';

//child category
$route['admin/childcategory']='AdminPanel/childcategory/index';
$route['admin/childcategory/create'] = 'AdminPanel/childcategory/create';
$route['admin/childcategory/insert_child_category'] = 'AdminPanel/childcategory/insert_child_category';
$route['admin/childcategory/edit/(:num)'] = 'AdminPanel/childcategory/edit/$1';
$route['admin/childcategory/update/(:num)'] = 'AdminPanel/childcategory/update/$1';

//Offers
$route['admin/offers']='AdminPanel/offers/index';
$route['admin/offers/create'] = 'AdminPanel/offers/create';
$route['admin/offers/store'] = 'AdminPanel/offers/store';
$route['admin/offers/edit/(:num)'] = 'AdminPanel/offers/edit/$1';
$route['admin/offers/update/(:num)'] = 'AdminPanel/offers/update/$1';

//Coupon
$route['admin/coupon']='AdminPanel/coupon/index';
$route['admin/coupon/create'] = 'AdminPanel/coupon/create';
$route['admin/coupon/store'] = 'AdminPanel/coupon/store';
$route['admin/coupon/edit/(:num)'] = 'AdminPanel/coupon/edit/$1';
$route['admin/coupon/update/(:num)'] = 'AdminPanel/coupon/update/$1';

//user
$route['admin/user']='AdminPanel/user/index';
$route['admin/user/create'] = 'AdminPanel/user/create';
$route['admin/user/store'] = 'AdminPanel/user/store';
$route['admin/user/edit/(:num)'] = 'AdminPanel/user/edit/$1';
$route['admin/user/update/(:num)'] = 'AdminPanel/user/update/$1';


//user
// $route['admin/basic_details']='AdminPanel/user/index';
// $route['admin/user/create'] = 'AdminPanel/user/create';
// $route['admin/user/store'] = 'AdminPanel/user/store';
$route['admin/basic_details/edit'] = 'AdminPanel/basic_details/edit';
$route['admin/basic_details/update/(:num)'] = 'AdminPanel/basic_details/update/$1';
// $route['packing-slip']='admin/packing_slip';


//blogs
$route['admin/blogs']='AdminPanel/blogs/index';
$route['admin/blogs/create'] = 'AdminPanel/blogs/create';
$route['admin/blogs/store'] = 'AdminPanel/blogs/store';
$route['admin/blogs/edit/(:num)'] = 'AdminPanel/blogs/edit/$1';
$route['admin/blogs/update/(:num)'] = 'AdminPanel/blogs/update/$1';

//terms and conditions
$route['admin/terms_conditions']='AdminPanel/blogs/index';
//$route['admin/blogs/create'] = 'AdminPanel/blogs/create';

// $route['packing-slip']='admin/packing_slip';

// =========================End Admin Route==================


// ====================Fronted ===============================


// $route['facebook-login']='facebook_login';
// $route['facebook-logout']='facebook_login/logout';
$route['fblogin']='frontend/fblogin';
$route['fbcallback']='frontend/fbcallback';

//p
$route['login']='login/index';
$route['logout']='login/logout'; 

$route['otpVerification']='login/otpVerification';

//
$route['product-search']='common/productSearch';


$route['shop']='product/shop';
$route['pc/(:any)']='product/index/$1';
$route['pc/(:any)/(:any)']='product/index/$1/$2';
$route['pc/(:any)/(:any)/(:any)']='product/index/$1/$2/$3';

$route['product-filter']='product/search';

$route['product/(:any)']='product/detail/$1';
$route['rating-review-details'] = 'product/review_rating'; 
$route['getSubCategoryTopId/(:num)']='common/getSubCategoryTopId/$1';
$route['getChildDataBySubCatId/(:num)/(:num)']='common/getChildDataBySubCatId/$1/$2';

//Cart
$route['cart']='cart/index';
$route['cart/save-to-later']='cart/saveToLater';
$route['cart/delete-item']='cart/deleteItem';
$route['cart/addToCart']='cart/addToCart';
$route['checkout']='cart/checkout';
$route['address']='cart/address';
$route['delivery-option']='cart/deliveryOption';
$route['delivery-address']='cart/deliveryAddress';
$route['payment-option']='cart/paymentOption';
$route['apply-coupon-code']='cart/applyCouponCode';

//

//Wish list
$route['add-to-wishlist']='wishlist/addToWishList';

//add new address

$route['add-neww-address']='common/addNewAddress';
$route['set-default-address']='customer/setDefaultAddress';
$route['save-gst']='customer/saveGst';

//Company Pages By Aarti
$route['about-us']='company_pages/about_us';
$route['contact']='company_pages/contact';
$route['blog']='company_pages/blog';
$route['terms-and-conditions']='company_pages/terms_and_conditions';
$route['refund-and-cancelation-policy']='company_pages/refund_cancelation_policy';
$route['privacy-policy']='company_pages/privacy_policy';
$route['shipping-policy']='company_pages/shipping_policy';
$route['faq']='company_pages/faq';
$route['disclaimer']='company_pages/disclaimer';

$route['account']='common/my_account';
$route['alert-notification'] = 'common/alert_notification';
//$route['my-wallet'] = 'frontend/my_wallet';
$route['my-payments'] = 'common/my_payments';
$route['my-gift-cards'] = 'common/my_gift_cards';
$route['customer-service'] = 'common/customer_service';
$route['my-order']='common/my_order';
$route['my-past-orders'] = 'common/my_past_oders';
$route['my-address']='common/my_address';
$route['add-address']='common/add_address';
$route['billing-address']='common/billing_address';
$route['email-addresses'] = 'common/email_addresses';
$route['smart-basket'] = 'common/smart_basket';
// ====================End Fronted ===========================


// ==================API========================================
  
  $route['api/send-otp']='ApiAuth/send_otp_for_login';
  $route['api/resend-otp']='ApiAuth/resendOtp';
  $route['api/login']='ApiAuth/login';

  $route['api/dashboard']='Api/home/index';
  $route['api/get-category-list']='Api/product/index';
  $route['api/productListBySubCatId']='Api/product/productListBySubCatId';


  $route['api/customer-details']='ApiController/update_customer_details';
  $route['api/get-customer-details']='ApiController/get_customer_details';
  // $route['api/get-category-list']='ApiController/category_list';
  $route['api/get-product-list']='ApiController/product_list';
  $route['api/add-wishlist']='ApiController/add_wishlist';
  $route['api/wishlist']='ApiController/wishlist';
  $route['api/product-details']='ApiController/product_details';
  $route['api/search-product']='ApiController/search_product';
  $route['api/address']='ApiController/address';
  $route['api/delete-address']='ApiController/delete_address';
  $route['api/get-shipping-address']='ApiController/get_shipping_address_list';
  $route['api/state-list']='ApiController/state_list';
  $route['api/city-list']='ApiController/get_city_list';

  $route['api/add-cart']='ApiController/add_basket_cart';
  
  $route['api/size-list']='ApiController/size_list';
  $route['api/remove-cart-item']='ApiController/remove_cart_item';
  $route['api/cart-list']='ApiController/cart_list';
  $route['api/banner-list']='ApiController/banner_list';
  $route['api/place-order']='ApiController/place_order';
  $route['api/set-default-address']='ApiController/set_default_address';
  $route['api/get-default-address']='ApiController/get_default_address';
  $route['api/apply-coupon']='ApiController/apply_coupon';
  $route['api/add-gst-details']='ApiController/add_gst_details';
  $route['api/order-list']='ApiController/order_list';
  $route['api/order-cancel-by-customer']='ApiController/order_cancel_by_customer';
  $route['api/product-rating']='ApiController/product_rating';
  $route['api/get-rating']='ApiController/get_rating';
  $route['api/review-rating-list']='ApiController/review_rating_list'; 

  //
  $route['api/coupon-list']='ApiController/getCouponList';



//Apoorv Route

$route['customer_list']='AdminPanel/Customer/customer_list';
$route['admin/category-with-prodct']='AdminPanel/Categoryproduct/index';
// ===================End API===================================
  


//$route['default_controller'] = 'frontend';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = FALSE;
