<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shiprocket_libraries extends CI_Model {

    
    public function shipRokt_orderCreate_payload($orders_manger=array(),$orders=array(),$length=0,$breadth=0,$height=0,$weight=0){

          $orderArr=array();
    	  if($orders_manger!=0 && $orders!=0){

    	  	  $order_m=$orders_manger[0];

              $billing_custName = getName($order_m->bill_order_name);
              $custName = getName($order_m->order_name);

              $getAddrArr=array(
                   'address1' =>$order_m->order_address,
                   'apartment'=>$order_m->order_alt_address,
                   'landmark'=>$order_m->order_landmark,
                   'area'=>$order_m->order_area);

               $addrValue=implode(', ', array_filter($getAddrArr));

               $getArr_bill=array(
                           'address1' =>$order_m->bill_order_address,
                           'apartment'=>$order_m->bill_order_alt_address,
                           'landmark'=>$order_m->bill_order_landmark,
                           'area'=>$order_m->bill_order_area) ;
               $importValue_bill=implode(', ', array_filter($getArr_bill));

               // $sql_wh_type="SELECT * FROM tbl_werehouse_details WHERE werehouse_code='".$order_m->order_werehouse."'";
               // $getWhtype = $this->sqlQuery_model->sql_query($sql_wh_type);

			  $orderArr['order_id']= $order_m->order_generated_order_id;
			  $orderArr['order_date']= $order_m->order_add_date;
			  $orderArr['pickup_location']='Primary'; //$getWhtype[0]->state;
			  $orderArr['channel_id']= "";
			  $orderArr['comment']= "Roray Dryfruit";
			  $orderArr['billing_customer_name']= empty($order_m->bill_order_name) ? $order_m->order_name :$order_m->bill_order_name ;
			  $orderArr['billing_last_name']= "" ;
			
			  $orderArr['billing_address']= (empty($importValue_bill)) ? $addrValue : $importValue_bill;

			  $orderArr['billing_address_2']= null;
			  $orderArr['billing_city']= empty($order_m->bill_order_city) ? $order_m->order_city :$order_m->bill_order_city ;
			  $orderArr['billing_pincode']= empty($order_m->bill_order_pincode) ? $order_m->order_pincode : $order_m->bill_order_pincode;
			  $orderArr['billing_state']= empty($order_m->bill_order_state) ? $order_m->order_state : $order_m->bill_order_state;
			  $orderArr['billing_country']= empty($order_m->bill_order_country) ? $order_m->order_country : $order_m->bill_order_country;
			  $orderArr['billing_email']= empty($order_m->bill_order_email) ? $order_m->order_email : $order_m->bill_order_email;
			  $orderArr['billing_phone']= empty($order_m->bill_order_mobile_no) ? $order_m->order_mobile_no : $order_m->bill_order_mobile_no;
			  $orderArr['shipping_is_billing']= true;
			  $orderArr['shipping_customer_name']= $order_m->order_name ;
			  $orderArr['shipping_last_name']= "" ;

			  $orderArr['shipping_address']= $addrValue;

			  $orderArr['shipping_address_2']= null;
			  $orderArr['shipping_city']= $order_m->order_city;
			  $orderArr['shipping_pincode']= $order_m->order_pincode;
			  $orderArr['shipping_country']= $order_m->order_country;
			  $orderArr['shipping_state']= $order_m->order_state;
			  $orderArr['shipping_email']= $order_m->order_email;
			  $orderArr['shipping_phone']= $order_m->order_mobile_no;

               $items=array();
              if($orders!=0){
              	   foreach ($orders as $key => $value) {
              	       	$items[]=array(
						      "name"=> $value->pro_product_name,
						      "sku"=> $value->pro_sku_id,
						      "units"=> $value->pro_product_qty,
						      "selling_price"=> $value->pro_product_selling_price,
						      "discount"=> 0,
						      "tax"=> 0,
						      "hsn"=> $value->pro_hsn_code
						     );
              	       }
              }

              $orderArr['order_items']= $items;
			  $orderArr['payment_method']= "Prepaid";
			  $orderArr['shipping_charges']= 0;
			  $orderArr['giftwrap_charges']= 0;
			  $orderArr['transaction_charges']= 0;
			  $orderArr['total_discount']= 0;
			  $orderArr['sub_total']= $order_m->order_total_final_amt;
			  $orderArr['length']= $length;
			  $orderArr['breadth']= $breadth;
			  $orderArr['height']= $height;
			  $orderArr['weight']= $weight;

    	  }
          // echo "<pre>";
          //       print_r($orderArr);
          //       echo "</pre>";
           
         return $orderArr;
          
    }


   // public function shipRokt_orderUpdatePayload($orders_manger=array(),$orders=array(),$length=0,$breadth=0,$height=0,$weight=0){

 

   // 	$orderArr=array();
   //  	  if($orders_manger!=0 && $orders!=0){

   //  	  	  $order_m=$orders_manger[0];

   //            $billing_custName = getName($order_m->bill_order_name);
   //            $custName = getName($order_m->order_name);

   //            $getAddrArr=array(
   //                 'address1' =>$order_m->order_address,
   //                 'apartment'=>$order_m->order_alt_address,
   //                 'landmark'=>$order_m->order_landmark,
   //                 'area'=>$order_m->order_area);

   //             $addrValue=implode(', ', array_filter($getAddrArr));

   //             $getArr_bill=array(
   //                         'address1' =>$order_m->bill_order_address,
   //                         'apartment'=>$order_m->bill_order_alt_address,
   //                         'landmark'=>$order_m->bill_order_landmark,
   //                         'area'=>$order_m->bill_order_area) ;
   //             $importValue_bill=implode(', ', array_filter($getArr_bill));


// 			  $orderArr['order_id']=$order_m->shiprocket_order_id;
// 			  // $orderArr['order_date']= $order_m->order_add_date;
// 			  // $orderArr['pickup_location']='Primary'; 
// 			  // $orderArr['channel_id']= "";
// 			  // $orderArr['comment']= "Roray Dryfruit";
// 			  // $orderArr['billing_customer_name']= empty($order_m->bill_order_name) ? $order_m->order_name :$order_m->bill_order_name ;
// 			  // $orderArr['billing_last_name']= "" ;
			
// 			  // $orderArr['billing_address']= (empty($importValue_bill)) ? $addrValue : $importValue_bill;

// 			  // $orderArr['billing_address_2']= null;
// 			  // $orderArr['billing_city']= empty($order_m->bill_order_city) ? $order_m->order_city :$order_m->bill_order_city ;
// 			  // $orderArr['billing_pincode']= empty($order_m->bill_order_pincode) ? $order_m->order_pincode : $order_m->bill_order_pincode;
// 			  // $orderArr['billing_state']= empty($order_m->bill_order_state) ? $order_m->order_state : $order_m->bill_order_state;
// 			  // $orderArr['billing_country']= empty($order_m->bill_order_country) ? $order_m->order_country : $order_m->bill_order_country;
// 			  // $orderArr['billing_email']= empty($order_m->bill_order_email) ? $order_m->order_email : $order_m->bill_order_email;
// 			  // $orderArr['billing_phone']= empty($order_m->bill_order_mobile_no) ? $order_m->order_mobile_no : $order_m->bill_order_mobile_no;
// 			  // $orderArr['shipping_is_billing']= true;
// 			  // $orderArr['shipping_customer_name']= $order_m->order_name ;
// 			  // $orderArr['shipping_last_name']= "" ;

// 			  // $orderArr['shipping_address']= $addrValue;

// 			  // $orderArr['shipping_address_2']= null;
// 			  // $orderArr['shipping_city']= $order_m->order_city;
// 			  // $orderArr['shipping_pincode']= $order_m->order_pincode;
// 			  // $orderArr['shipping_country']= $order_m->order_country;
// 			  // $orderArr['shipping_state']= $order_m->order_state;
// 			  // $orderArr['shipping_email']= $order_m->order_email;
// 			  // $orderArr['shipping_phone']= $order_m->order_mobile_no;

   //             $items=array();
   //            if($orders!=0){
   //            	   foreach ($orders as $key => $value) {
   //            	       	$items[]=array(
// 						      "name"=> $value->pro_product_name,
// 						      "sku"=> $value->pro_sku_id,
// 						      "units"=> $value->pro_product_qty,
// 						      "selling_price"=> $value->pro_product_selling_price,
// 						      "discount"=> 0,
// 						      "tax"=> 0,
// 						      "hsn"=> $value->pro_hsn_code
// 						     );
   //            	       }
   //            }

   //            // $orderArr['order_items']= $items;
// 			  // $orderArr['payment_method']= "Prepaid";
// 			  // $orderArr['shipping_charges']= 0;
// 			  // $orderArr['giftwrap_charges']= 0;
// 			  // $orderArr['transaction_charges']= 0;
// 			  // $orderArr['total_discount']= 0;
// 			  // $orderArr['sub_total']= $order_m->order_total_final_amt;
// 			  // $orderArr['length']= $length;
// 			  // $orderArr['breadth']= $breadth;
// 			  // $orderArr['height']= $height;
// 			  // $orderArr['weight']= $weight;
// 			  // $orderArr['ewaybill_no']="";
   //            // $orderArr['customer_gstin']="";

   //  	  }
   //        // echo "<pre>";
   //        //       print_r($orderArr);
   //        //       echo "</pre>";
           
   //       return $orderArr;

   // }
    

}


?>