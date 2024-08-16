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
     
      public function getProductItemList(){

       $client = new Client();

        try {
            // Send a GET request
            $response = $client->request('GET', 'http://122.176.162.235:4223/API/SAP/MasterWith_2P?HanaDBName=TEST_20240410&SPName=SCS_ITEM_INVENTORY_DATA&P1=FG002434&P2=Eco-MIDC');

            // Get the response body
            $body = $response->getBody();
            $data = json_decode($body, true);

            // Use the response data as needed
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle request exceptions
            echo 'Request failed: ' . $e->getMessage();
        }
      }

      public function getStockList(){

       $client = new Client();

        try {
            // Send a GET request
            $response = $client->request('GET', 'http://122.176.162.235:4223/API/SAP/MasterWith_2P?HanaDBName=TEST_20240410&SPName=SCS_ITEM_INVENTORY_DATA&P1=FG002434&P2=Eco-MIDC');

            // Get the response body
            $body = $response->getBody();
            $data = json_decode($body, true);

            // Use the response data as needed
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle request exceptions
            echo 'Request failed: ' . $e->getMessage();
        }
      }


   }
?> 
