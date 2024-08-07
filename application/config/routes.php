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


$route['admin/other-product']='Admin/otherProduct';
$route['admin/other-product/add']='Admin/addOtherProduct';
$route['admin']='AdminPanel/home/index';
$route['admin/login']='AdminPanel/login/index';
$route['admin/logout'] = 'AdminPanel/login/logout';
$route['admin/product']='AdminPanel/product/index';
$route['admin/product/create']='AdminPanel/product/create';
$route['admin/product/save']='AdminPanel/product/save';
$route['admin/other-product/edit/(:num)']='Admin/Edit_other_product/$1';

$route['admin/product/update/(:num)']='AdminPanel/product/update/$1';
$route['admin/productItem']='AdminPanel/product/productitem';
$route['admin/productItem/(:num)']='AdminPanel/product/productitem/$1';


$route['admin/categorywithproduct']='AdminPanel/categorywithproduct/index';
$route['admin/categorywithproduct/save']='AdminPanel/categorywithproduct/save';
$route['admin/categorywithproduct/delete/(:num)']='AdminPanel/categorywithproduct/deletRecord/$1';

$route['subCategory/(:num)']='common/getSubCategoryInOption/$1';

$route['childcategoryn/(:num)/(:num)']='common/getChildCategoryInOption/$1/$2';

// print_r($route);
// exit();
//category
$route['admin/category']='AdminPanel/category/index';
$route['admin/category/(:num)']='AdminPanel/category/index/$1';
$route['admin/category/create'] = 'AdminPanel/category/create';
$route['admin/category/store'] = 'AdminPanel/category/store';
$route['admin/category/edit/(:num)']='AdminPanel/category/edit/$1';
$route['admin/category/update/(:num)']='AdminPanel/category/update/$1';

//subcategory
$route['admin/subcategory']='AdminPanel/subcategory/index';
$route['admin/subcategory/(:num)']='AdminPanel/subcategory/index/$1';
$route['admin/subcategory/create'] = 'AdminPanel/subcategory/create';
$route['admin/subcategory/store'] = 'AdminPanel/subcategory/store';
$route['admin/subcategory/edit/(:num)'] = 'AdminPanel/subcategory/edit/$1';
$route['admin/subcategory/update/(:num)'] = 'AdminPanel/subcategory/update/$1';
$route['AdminPanel/subcategory/index'] = 'AdminPanel/subcategory/deleteSubcategory';

//child category
$route['admin/childcategory']='AdminPanel/Childcategory/index';
$route['admin/childcategory/(:num)']='AdminPanel/Childcategory/index/$1';
$route['admin/childcategory/create'] = 'AdminPanel/childcategory/create';
$route['admin/childcategory/insert_child_category'] = 'AdminPanel/childcategory/insert_child_category';
$route['admin/childcategory/edit/(:num)'] = 'AdminPanel/childcategory/edit/$1';
$route['admin/childcategory/update/(:num)'] = 'AdminPanel/childcategory/update/$1';

//Offers
$route['admin/offers']='AdminPanel/offers/index';
$route['admin/offers/(:num)']='AdminPanel/offers/index/$1';
$route['admin/offers/create'] = 'AdminPanel/offers/create';
$route['admin/offers/store'] = 'AdminPanel/offers/store';
$route['admin/offers/edit/(:num)'] = 'AdminPanel/offers/edit/$1';
$route['admin/offers/update/(:num)'] = 'AdminPanel/Offers/update/$1';


//Coupon
$route['admin/coupon']='AdminPanel/coupon/index';
$route['admin/coupon/(:num)']='AdminPanel/coupon/index/$1';
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


///blogs 
$route['admin/blogs']='AdminPanel/blogs/index';
$route['admin/blogs/(:num)']='AdminPanel/blogs/index/$1';
$route['admin/blogs/create'] = 'AdminPanel/blogs/create';
$route['admin/blogs/store'] = 'AdminPanel/blogs/store';
$route['admin/blogs/edit/(:num)'] = 'AdminPanel/blogs/edit/$1';
$route['admin/blogs/update/(:num)'] = 'AdminPanel/blogs/update/$1';

//terms and conditions
$route['common/policy_save'] = 'common/policy_save';
$route['admin/terms_conditions']='AdminPanel/terms_and_conditions/index';
//shipping policy
$route['admin/shipping-policy'] = 'AdminPanel/shipping_policy/index';
//privacy policy
$route['admin/privacy-policy'] = 'AdminPanel/privacy_policy/index';
//refund & cancellation Policy
$route['admin/refund-and-cancelation-policy'] = 'AdminPanel/refund_cancellation_policy/index';
//faq
$route['admin/faq'] = 'AdminPanel/faq/index';
//desclimer
$route['admin/disclaimer'] = 'AdminPanel/disclaimer/index';

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
$route['shop/(:num)']='Product/shop/$1';
$route['pc/(:any)']='product/index/$1';
$route['pc/(:any)/(:any)']='product/index/$1/$2';
$route['pc/(:any)/(:any)/(:any)']='product/index/$1/$2/$3';
$route['product-filter']='product/search';
$route['product/(:any)']='product/detail/$1';
$route['rating-review-details'] = 'product/review_rating'; 
$route['getSubCategoryTopId/(:num)']='common/getSubCategoryTopId/$1';
$route['getChildDataBySubCatId/(:num)/(:num)']='common/getChildDataBySubCatId/$1/$2';
$route['rating-details/(:num)'] = 'common/ratingReviewDetails/$1';

//cart
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
$route['delete-address'] = 'cart/delete';
$route['buynow'] = 'cart/buyNow';
$route['get_address_details'] = 'cart/get_address_details';
$route['update-address'] = 'cart/update_address';

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
$route['save-gst-details']='common/save_gst_details';
$route['order-details/(:any)'] = 'common/order_details/$1';
$route['rating-review-details'] = 'common/rating_review_details';
$route['rating-review/(:any)/(:num)'] = 'common/rating_review/$1/$2';
// ====================End Fronted ===========================


// ==================API========================================
  
  $route['api/auth/login-with-mobile']='Api/login/loginWithMobile';
  $route['api/auth/otp-verity-by-mobile']='Api/login/verifyOtpByMobile';
  $route['api/auth/login-with-email']='Api/login/loginWithEmail';
  $route['api/auth/otp-verity-by-email']='Api/login/verifyOtpByEmail';

  //Home
  $route['api/home']='Api/home/index';

  //Cart
  $route['api/cart']='Api/cart/index';
  $route['api/cart/add-to-cart']='Api/cart/addToCart';
  $route['api/cart/delete/(:num)']='Api/cart/delteCartItem/$1';
  $route['api/cart/save-to-later']='Api/cart/saveLater';
  $route['api/cart/delete-from-saveforlater/(:num)']='Api/cart/delteSavedItem/$1';
  $route['api/cart/move-to-cart']='Api/cart/moveToCart';

  //Wishlist
  $route['api/wishlist']='Api/wishlist/index';
  $route['api/wishlist/add-to-wishlist']='Api/wishlist/addToWishList';
  $route['api/wishlist/delete/(:num)']='Api/wishlist/delteWishItem/$1';

  //order
  $route['api/coupon/list']='Api/order/getCouponList';
  $route['api/coupon/apply-code']='Api/order/applyCouponCode';

  //Customer
  $route['api/customer/address-list']='Api/customeraddress/index';
  $route['api/customer/address_save']='Api/customeraddress/save';
  $route['api/customer/address_update']='Api/customeraddress/update';
  $route['api/customer/setdefault']='Api/customeraddress/setdefault';   
  $route['api/customer/save-gst']='Api/customeraddress/saveGst';
  $route['api/customer/slote-list']='Api/customeraddress/sloteList'; 
  $route['api/customer/rate-reviews']='Api/product/rateAndReview'; 
  $route['api/customer/stateList']='Api/customeraddress/getStatelist';
  $route['api/customer/order-list']='Api/order/index';
  $route['api/customer/detail']='Api/customer/getCustomerDetail';
   

  //Product
  $route['api/product/list']='Api/product/index';
  $route['api/product/categories']='Api/product/categoryList';
  $route['api/product/detail/(:num)/(:num)/(:num)/(:num)']='Api/product/detail/$1/$2/$3/$4';

// ===================End API===================================


//Apoorv Route
$route['banner_edit_action/edit_banner/(:num)']='Admin/banner_edit_action/$1';
$route['admin/edit_banner/(:num)']='Admin/banner_edit_action/$1';
$route['admin/add_banner_list']='Admin/create';
$route['customer_list']='AdminPanel/Customer/customer_list';
$route['admin/category-with-prodct']='AdminPanel/Categoryproduct/index';
// ===================End API===================================
  


//$route['default_controller'] = 'frontend';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = FALSE;
