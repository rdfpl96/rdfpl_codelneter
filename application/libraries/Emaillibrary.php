<?php
class Emaillibrary
   {
   var $CI;
    public function __construct($params = array()){
       $this->CI =& get_instance();
    }


  public function sendOtpMail($email_mobi,$otp){
    
      $mail = $this->CI->phpmailer_lib->load();
      $config['mailUsername']=$this->CI->config->item('mailUsername');
      $config['mailPassword']=$this->CI->config->item('mailPassword');
      $config['setFrom']=$this->CI->config->item('setFrom');
      // Add a recipient
      $config['addAddress']=trim($email_mobi);
      $config['title']='Login OTP';
      $config['subject']='Royal Dryfruit Login OTP';
      $config['mailContent']='<p>Dear customer,<br>
        <h1>'.$otp.'</h1> Please do not share the OTP with others.<br>
        Regards,<br>
        Royal Dryfruit</p>';
      
     return smtpSend($mail,$config);
  
  } 

public function sendOtpOnMobile($email_mobi,$otp){
    $tdata=array();
    $tdata['SenderId']=trim("RDFPLA");
    $tdata['Is_Unicode']=false;
    $tdata['Is_Flash']=false;
    $tdata['Message']=trim("Hi Customer,\n".$otp." is your OTP for verification.\nThank you\nROYAL DRYFRUIT PRIVATE LIMITED");
    $tdata['MobileNumbers']="91".trim($email_mobi);
    $tdata['ApiKey']=trim("eswmUBTXQADip5sSjH27qQzQYHFaMtpmnCJTmfO89m4=");
    $tdata['ClientId']=trim("5ae83d26-c14a-42c5-9253-d2ab5ff7e60f");

    $payload=json_encode($tdata);
    // print_r($payload);
    // exit;

   $curl = curl_init();

   curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://smppapi.theitmatic.com/api/v2/SendSMS',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>$payload,
      CURLOPT_HTTPHEADER => array(
         'Content-Type: application/json'
      ),
   ));

   // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // bypass SSL TO 0 command
   // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

   $response = curl_exec($curl);
   return $response;
   //echo curl_error($curl);
   curl_close($curl);
   // echo $response;
   // echo '<pre>';
   // print_r(json_decode($response));
    }

}

?>