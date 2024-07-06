

<?php
 
   function generateAccessToken(){

        	$liveUrl="https://api.instamojo.com";
			$testUrl="https://test.instamojo.com";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $testUrl.'/oauth2/token/');     
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        // Live
		// $payload = Array(
		//     'grant_type' => 'client_credentials',
		//     'client_id' => 'pp0fIltn97YCx0RQ4sMmoMCuz1qrmE0Dhn0uuhtx',
		//     'client_secret' => '2wYKYOdrc0Kag0EaLO6JTXXABnk2XHfniM8id6CFG17IDZHBuxTYp5sx1nOjiPcPVtAp90JyaFjZtNwPGMqiFNGicMSxUwYy2HLKop2DJo1fNSLIRFl7jdr4dXUvt3EW'
		//   );
        
        //Test
		$payload = Array(
		    'grant_type' => 'client_credentials',
		    'client_id' => 'test_UiDNFk4NQjyfrwx8vK1q5pinQyTYdrQRP0R',
		    'client_secret' => 'test_xHZnahJXB9sZA8gm4SNX3IC5KyDV55xgb4z6UqtULu4Vc1mnejzLYczPgMFhIPxxXMEqfRcDgRnfCbVymkXhEUUprDgOd81FciPhK7JQiIZY7t5CaOGa7ANmGY3'
		  );

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
		curl_close($ch); 

       $request=json_decode($response);
        return $request->access_token;

   }


   function createPaymentRequest($payload=array()){
     
			$ch = curl_init();
			$liveUrl="https://api.instamojo.com";
			$testUrl="https://test.instamojo.com";

			curl_setopt($ch, CURLOPT_URL, $testUrl.'/v2/payment_requests/');
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer '.generateAccessToken()));
			
		   // 'Content-Type: application/x-www-form-urlencoded'
			$payload['send_email']=false;
			$payload['allow_repeated_payments']=false;
			$payload['redirect_url']=base_url('order-place-success');
			$payload['webhook'] = base_url('place-final-order-instamojo');




			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
			$response = curl_exec($ch);
			curl_close($ch); 

			return json_decode($response);

   }


   function getPaymentDetails($instamojo_id=''){

   	        $liveUrl="https://api.instamojo.com";
			$testUrl="https://test.instamojo.com";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $testUrl.'/v2/payments/'.$instamojo_id.'/');
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

			curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer '.generateAccessToken()));

			$response = curl_exec($ch);
			curl_close($ch);

			return json_decode($response); 
   }

function getPaymentRequest($payment_request_id){

	$liveUrl="https://api.instamojo.com";
	$testUrl="https://test.instamojo.com";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $testUrl.'/v2/payment_requests/'.$payment_request_id.'/');
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

	curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer '.generateAccessToken()));

	$response = curl_exec($ch);
	curl_close($ch); 
	return json_decode($response); 

}


function createRefundAmount($instamojo_id='',$payload=array()){

	$liveUrl="https://api.instamojo.com";
	$testUrl="https://test.instamojo.com";

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $testUrl.'/v2/payments/'.$instamojo_id.'/refund/');
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer '.generateAccessToken()));

    
    $payload['type']='TNR';
    $payload['body']='Need to refund to the buyer.';
    $payload['refund_amount']='100';

    $payload['transaction_id']='partial_refund_1';

	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
	$response = curl_exec($ch);
	curl_close($ch); 
	return json_decode($response); 

}

 
?>