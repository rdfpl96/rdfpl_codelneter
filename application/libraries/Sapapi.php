<?php

use GuzzleHttp\Client;

class Sapapi{
   var $CI;
    public function __construct($params = array()){

       $this->CI =& get_instance();

       $custDetail=getCookies('customer');

       $this->customerId=isset($custDetail['customer_id']) ? $custDetail['customer_id'] : '' ;

       $this->CI->load->model('cart_model','cartObj');
       $this->CI->load->model('common_model');
    }

    function login(){
        $client = new Client(['verify' => false]);
        $headers = ['Content-Type' => 'application/json'];
        $body = '{"CompanyDB": "TEST_20240410","Password": "1234","UserName": "Sales01"}';
        $request = new \GuzzleHttp\Psr7\Request('POST', 'https://122.176.162.235:50000/b1s/v1/Login', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        $responseBody=$res->getBody()->getContents();
         return json_decode($responseBody, true); 
    }
    
    //
    //getAll Product ItemList
    // 
    public function getProductItemList(){
        //$this->login();
        $client = new Client();

        try {
            $request = new \GuzzleHttp\Psr7\Request('GET', 'http://122.176.162.235:7279/API/SAP/MasterWith_2P?HanaDBName=TEST_20240410&SPName=SCS_BARCODE_MASTER_DATA&P1=&P2=Vki');
            $res = $client->sendAsync($request)->wait();

            $res->getStatusCode();

           $responseBody=$res->getBody()->getContents();
            return json_decode($responseBody, true); 
        
              
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle request exceptions
            echo 'Request failed: ' . $e->getMessage();
        }
    }

    //
    //get Sengle product Item
    // 
    public function getProductItem($item_code){
        //$this->login();
        $client = new Client();

        try {
            $request = new \GuzzleHttp\Psr7\Request('GET', 'http://122.176.162.235:7279/API/SAP/MasterWith_2P?HanaDBName=TEST_20240410&SPName=SCS_BARCODE_MASTER_DATA&P1='.$item_code.'&P2=JOD');
            $res = $client->sendAsync($request)->wait();
            $responseBody=$res->getBody()->getContents();
            $body=son_decode($responseBody, true);
            return is_array($body) ? $body[0] : array(); 
              
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle request exceptions
            echo 'Request failed: ' . $e->getMessage();
        }
    }

    //
    // get Stock list
    //
    public function getStockList(){

       $client = new Client();

        try {
            // Send a GET request
            $response = $client->request('GET', 'http://122.176.162.235:4223/API/SAP/MasterWith_2P?HanaDBName=TEST_20240410&SPName=SCS_ITEM_INVENTORY_DATA&P1=&P2=JOD');


            // Get the response body
            $body = $response->getBody();
            return json_decode($body, true);

            
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle request exceptions
            echo 'Request failed: ' . $e->getMessage();
        }
      }

    //
    // get Stock list
    //
    public function getSingleStock($item_code){
        $client = new Client();
        try {
            // Send a GET request
            $response = $client->request('GET', 'http://122.176.162.235:4223/API/SAP/MasterWith_2P?HanaDBName=TEST_20240410&SPName=SCS_ITEM_INVENTORY_DATA&P1='.$item_code.'&P2=JOD');
            // Get the response body
            $body=json_decode($response->getBody(), true);

            return is_array($body) ? $body[0] : array();

           
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle request exceptions
            echo 'Request failed: ' . $e->getMessage();
        }
      }
    
    //
    // get All Customer Address
    //

    public function getAllCustomerAdddressList($code){
        $res=$this->login();
        // print_r($res['SessionId']);
        // exit();
        $client = new Client(['verify' => false]);
        try {
        $headers = ['Content-Type' => 'application/json','Cookie' => 'B1SESSION='.$res['SessionId'].''];
        //ECO10006;
        $request = new \GuzzleHttp\Psr7\Request('GET', "https://122.176.162.235:50000/b1s/v1/BusinessPartners('".$code."')",$headers);
        $res = $client->sendAsync($request)->wait();
        $responseBody=$res->getBody()->getContents();
        return json_decode($responseBody, true); 
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle request exceptions
            echo 'Request failed: ' . $e->getMessage();
        }

    }
}


?>