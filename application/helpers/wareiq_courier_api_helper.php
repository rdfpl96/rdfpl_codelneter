<?php

 // define(TRACK_WAREIQ_URL, 'https://track.wareiq.com');

 function tokenKey(){
 	$tokenKey='f79c915dedbd40bbb650bfbc872deb74';
 	return $tokenKey;
 }

 function wareiqurl(){
   $TRACK_WAREIQ_URL='https://track.wareiq.com';
   return $TRACK_WAREIQ_URL;
 }

 function getOrdersList($type='all'){
    $urlwareiq=wareiqurl();
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => $urlwareiq.'/orders/b2c/'.$type,
	  CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{}',
	 
	 ));

	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
 }

function addOrder_PostDataJSON($orders_manger=0,$orders=0,$length=0,$breadth=0,$height=0,$weight=0){
 

 if($orders_manger!=0){
   
   foreach ($orders_manger as $key => $value) {

   	            $ord["order_id"]= $value->order_generated_order_id;
			    $ord["full_name"]= $value->order_name;
			    $ord["address1"]= $value->order_address .''.$value->order_locality;
			    $ord["address2"]= $value->order_alt_address;
			    $ord["city"]= $value->order_city;
			    $ord["pincode"]= $value->order_pincode;
			    $ord["state"]= $value->order_state;
			    $ord["country"]= $value->order_country;
			    $ord["customer_phone"]= $value->order_mobile_no;
			    $ord["customer_email"]= $value->order_email;
			    $ord["billing_address"]= array(
			        "first_name"=> $value->bill_order_name,
			        "last_name"=> "",
			        "address1"=> $value->bill_order_address,
			        "address2"=> $value->bill_order_alt_address,
			        "city"=> $value->bill_order_city,
			        "pincode"=> $value->bill_order_pincode,
			        "state"=> $value->bill_order_state,
			        "country"=> $value->bill_order_country,
			        "phone"=> $value->bill_order_mobile_no 
			    );

			    $ord["warehouse"]= "333"; 
			    $ord["weight"]= ""; 
			    $ord["order_date"]= $value->order_add_date; 
			    $ord["total"]= $value->order_total_final_amt; 
			    $ord["shipping_charges"]= ""; 
                
                if($value->order_payment_status=="Paid"){
                  $ord["payment_method"]= "paid"; 	
                }else if($value->order_payment_status=="cod"){
                  $ord["payment_method"]= "cod"; 	
                }else{
                  $ord["payment_method"]= "unknown"; 
                }

			    
      }

   $product=array();
   if($orders!=0){
   	  foreach ($orders as $key1 => $val) {
                     
                    // $pro["id"]= $val->order_products_id;
		            $pro["sku"]= $val->pro_sku_id;
		            $pro["name"]= $val->pro_product_name;
		            $pro["price"]= $val->pro_product_selling_price;
		            $pro["client_prefix"]= "";
		            $pro["weight"]= 2.500;
		            $pro["length"]= 10; //$val->pro_package_length;
		            $pro["breadth"]= 10; //$val->pro_package_breadth;
		            $pro["height"]=  18; //$val->pro_package_height;

                    if($val->pro_type_of_tax=='In_state_GST'){

                    	 $array_tex=array(
                    	 	     array(
				                    "title"=> "CGST", 
				                    "rate"=> $val->pro_cgst_rate
				                    ),
                    	 	      array(
				                    "title"=> "SGST", 
				                    "rate"=> $val->pro_sgst_rate 
				                    ),
                    	        );
                    }else{
                    	 $array_tex=array(
                    	 	     array(
				                    "title"=> "IGST", 
				                    "rate"=> $val->pro_igst_rate
				                    )
                    	 	 );
                      }


		            $pro["tax_lines"]= $array_tex;
		            $pro["amount"]= $val->pro_subtotal;
		            $pro["quantity"]= $val->pro_product_qty;
        
          array_push($product, $pro);
  
   	    }

   }
    $ord["products"]= $product;
 }


// echo "<pre>";
// print_r($ord);
// echo "</pre>";

// exit;

   return $ord;

}

function addOrder($orderData=array()){
$urlwareiq=wareiqurl();
 $curl = curl_init();
 curl_setopt_array($curl, array(
 CURLOPT_URL => $urlwareiq.'/orders/add',
 CURLOPT_HTTPHEADER=>array(
  	'Authorization: Token '.tokenKey(),
  	'Content-Type: application/json'
  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($orderData),
));

$response = curl_exec($curl);
curl_close($curl);

return $response;

}

function getOrderDetails($order_id){
$urlwareiq=wareiqurl();
	$curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/order/'.$order_id,
  CURLOPT_HTTPHEADER=>array(
  	'Authorization: Token '.tokenKey(),
  	'Content-Type: application/json'
  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
 ));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

}





function updateOrder($unique_id='',$json=array()){

$urlwareiq=wareiqurl();
  
    $curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $urlwareiq.'/orders/v1/order/'.$unique_id,
	  CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'PATCH',
	  CURLOPT_POSTFIELDS =>json_encode($json),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	echo "<pre>";
	print_r($response);
	echo "</pre>";
	return $response;

}


function trackOrder($awb=''){
$urlwareiq=wareiqurl();
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/track/'.$awb,
   CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

}


function cancelOrder($unique_id_json){
$urlwareiq=wareiqurl();
$curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/cancel',
  CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($unique_id_json),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

}


function downloadWareIQShipLabel($unique_id_json){
 $urlwareiq=wareiqurl();
 $getArr=array('order_ids'=>array($unique_id_json));
 // echo "<pre>";
 // print_r(json_encode($getArr));
 // echo "</pre>";
 // exit;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/download/shiplabels',
  CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($getArr),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

}


function downloadWareIQinvoice($unique_id_json){
  $urlwareiq=wareiqurl();
$getArr=array('order_ids'=>array($unique_id_json));
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/download/invoice',
   CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($getArr),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);


}



function downloadWareIQPickList($unique_id_json){
 $urlwareiq=wareiqurl();
$getArr=array('order_ids'=>array($unique_id_json));
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/download/picklist',
  CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($getArr),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

}

function downloadWareIQPackList($unique_id_json){
 $urlwareiq=wareiqurl();
$getArr=array('order_ids'=>array($unique_id_json));

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/download/packlist',
   CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($getArr),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

}


function downloadWareIQManifest($unique_id_json){
 $urlwareiq=wareiqurl();
$getArr=array('order_ids'=>array($unique_id_json));
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/download/manifest',
  CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($getArr),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

}


function orderShip($unique_id_json){
  $urlwareiq=wareiqurl();
  $getArr=array('order_ids'=>array($unique_id_json),'courier'=>'');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/ship_orders',
  CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($getArr),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);


}


function shipmentOrder($unique_id_json){
$urlwareiq=wareiqurl();
$getArr=array('order_nos'=>array($unique_id_json));


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/shipments',
  CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($getArr),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

}


function pickupPointDetails(){
$urlwareiq=wareiqurl();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlwareiq.'/orders/v1/getPickupPointsDetails?child_client_prefix=abc&pickup_point=def',
   CURLOPT_HTTPHEADER=>array(
	  	'Authorization: Token '.tokenKey(),
	  	'Content-Type: application/json'
	  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

}



?>