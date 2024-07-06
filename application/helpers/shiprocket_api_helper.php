<?php
 
 function createTocken(){

 	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
	    "email": "softcoresolutions39@gmail.com",
	    "password": "softcoresolutions39@2024"
	}',
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);
	$result = json_decode($response);
	$res="";
	if($result!="" && $result!=array()){
		$res =$result->token;
	}

   return $res;
 }



function createOrder($orderData=array()){

$curl = curl_init();

 curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($orderData),

  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.createTocken()
  ),
));

$response = curl_exec($curl);
curl_close($curl);

 return $response;
}



function updateOrder($orderData=array()){

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/update/adhoc',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($orderData),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.createTocken()
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

}


function getCourierList(){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/courierListWithCounts',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.createTocken()
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

}

function generateAWBForShipment($json=array()){

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/assign/awb',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($json),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.createTocken()
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

}


function checkCourierServiceability($json=array()){

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/serviceability/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS =>json_encode($json),  


  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.createTocken()
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

}

function requestForShipmentPickup($json=array()){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/generate/pickup',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>json_encode($json),
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json',
	    'Authorization: Bearer '.createTocken()
	  ),
	));

	$response = curl_exec($curl);

curl_close($curl);
return $response;

}

function generateManifest($json=array()){

	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/manifests/generate',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>json_encode($json),
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json',
	    'Authorization: Bearer '.createTocken()
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;
}


function printManifest($json=array()){

    $curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/manifests/print',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>json_encode($json),

	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json',
	    'Authorization: Bearer '.createTocken()
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;

}


function generateLabel($json=array()){

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/generate/label',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($json),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.createTocken()
  ),
));

$response = curl_exec($curl);
curl_close($curl);
return $response;


}

function downloadInvoice($json=array()){

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/print/invoice',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($json),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.createTocken()
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

}

function cancelShipment($json=array()){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/cancel/shipment/awbs',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($json),
//   '{
// "awbs": ["19041211125783"]
// }',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.createTocken()
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

}

function cancelOrder($json=array()){
 
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/cancel',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>json_encode($json),
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Bearer '.createTocken()
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
  }


  function walletBalance(){

		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/account/details/wallet-balance',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Bearer '.createTocken()
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return json_decode($response);
  }

?>