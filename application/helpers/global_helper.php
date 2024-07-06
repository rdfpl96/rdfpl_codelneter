<?php

function sendSMS($massage='',$mobile_to=''){

  $response = 1;
return $response;
}

function setCookies($name="",$sql=""){
      $cookie= array(
           'name'   => $name,
           'value'  => serialize($sql),
           'expire' => time() + 24 * 3600
         );
    set_cookie($cookie);

  }

function getCookies($name=""){
    $cookies=get_cookie($name,true); 
    $getArr="";
    if($cookies!=""){
      $getArr=unserialize($cookies);
    }
    return  $getArr;
 }


 function getCookiesRowId($products,$pid,$itemId){

     $filtered_array = array_filter($products, function($val) use($pid, $itemId){

              return ($val['id']==$pid and $val['variant_id']==$itemId);
          });

    if(count($filtered_array)==1){
        foreach($filtered_array as $record){
          return array('rowid'=>$record['rowid'],'qty'=>$record['qty']);
        }
    }

    return array();

 }


// function sendSMS($massage='',$mobile_to=''){

// $KALEYRA_URL='https://api.kaleyra.io';
// $KALEYRA_SID='HXIN1753249964IN';
// $KALEYRA_SENDER_ID='MHLXMI';
// $KALEYRA_API_KEY_ID='A9f51c41fa8133efa09a965803072a791';
// $KALEYRA_TYPE='TXN';

//   $curl = curl_init();
//   curl_setopt_array($curl, array(
//   CURLOPT_URL => $KALEYRA_URL.'/v1/'.$KALEYRA_SID.'/messages',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS => 'to=91'.$mobile_to.'&sender='.$KALEYRA_SENDER_ID.'&body='.$massage.'&type='.$KALEYRA_TYPE,
//   CURLOPT_HTTPHEADER => array(
//     'api-key: '.$KALEYRA_API_KEY_ID,
//     'Content-Type: application/x-www-form-urlencoded'
//   ),
// ));

// $response = curl_exec($curl);
// curl_close($curl);
//   return $response;
// }



function checkemail($str) {
return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}


function checkMobile($phone) {
return (!preg_match('/^[0-9]{10}+$/', $phone)) ? FALSE : TRUE;
}


function getWeekName($num=''){

  if($num!=""){
    if($num==1){
      $w = 'Sunday';
    }else if($num==2){
      $w = 'Monday';
    }else if($num==3){
      $w = 'Tuesday';
    }else if($num==4){
      $w = 'Wednesday';
    }else if($num==5){
      $w = 'Thursday';
    }else if($num==6){
      $w = 'Friday';
    }elseif($num==7){
      $w = 'Saturday';
    }else{
      $w = '';
    }
  }else{
    $w = '';
  }  
  return $w;
}

function getName($name=""){

$firstSpacePosition = strpos($name, ' ');

if ($firstSpacePosition !== false) {
    $firstPart = substr($name, 0, $firstSpacePosition);
    $secondPart = substr($name, $firstSpacePosition + 1);
    $result = array($firstPart, $secondPart);
} else {
    $result = array($name);
}

return $result;

}




function productOfferPercantage($price=0,$beforOffprice=0){
   $perce=0;
   if($price!=0 && $beforOffprice!=0){
      $sbstr=$beforOffprice - $price;
      $perce= ($sbstr * 100)/$beforOffprice;
    }
    return $perce;
}


function getCustDetailsName($value=array()){
   $r['customer_id']=$value->customer_id;
   if($value->c_fname!="" && $value->c_lname!="" && $value->email=="" && $value->mobile==""){
      $r['name'] = ucfirst($value->c_fname). ' ' .ucfirst($value->c_lname);
   }else if($value->c_fname=="" && $value->c_lname=="" && $value->email!="" && $value->mobile==""){
      $r['name']= $value->email;
   }else if($value->c_fname=="" && $value->c_lname=="" && $value->email=="" && $value->mobile!=""){
    $r['name']= $value->mobile;
   }else if($value->c_fname=="" && $value->c_lname=="" && $value->email!="" && $value->mobile!=""){
      $r['name']= $value->email;
   }else{
     $r['name'] = ucfirst($value->c_fname). ' ' .ucfirst($value->c_lname);
   }
  
  return $r;
}




// if(preg_match('/^[0-9]{10}+$/', $phone)) {
// echo "Valid Phone Number";
// } else {
// echo "Invalid Phone Number";
// }


// if(preg_match('/^[0-9]{10}+$/', $phone)) {
// echo "Valid Phone Number";
// } else {
// echo "Invalid Phone Number";
// }


function ImageDimensionValidation($tmp_name='',$img_width=0,$img_height=0,$mesKey=''){
  $data=array();
  $image_info = getimagesize($tmp_name);
  $image_width = $image_info[0];
  $image_height = $image_info[1];
  if($image_width!=$img_width || $image_height!=$img_height){
      $data[$mesKey]='Image should be '.$img_width.' X '.$img_height.' px.';
      $data['status']=0;
      echo json_encode($data);
      exit;
   }
   return $data;

}


  function imageFileValidation($fileimage1){

     $extension=array('jpg','jpeg','png');
     $file_arr=explode('.',$fileimage1);
     $get_end_arr_value=strtolower(end($file_arr));
       if(!in_array($get_end_arr_value,$extension)){
          $data['message']='Only Allowed jpg, jpeg and png file.';
          $data['status']=0;
          echo json_encode($data);
          exit;
       }
return $data;
}



function generateCouponCode($length = 8) {
  $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $ret = '';
  for($i = 0; $i < $length; ++$i) {
    $random = str_shuffle($chars);
    $ret .= $random[0];
  }
  return $ret;
}


function getShortData($data="",$length=""){

  if($data!="" && $length !=""){
      $value=(strlen($data)<=$length) ? $data : substr($data,0,$length).'...' ;
   }else{
     $value=$data;
   }
return $value;
}

function generateNumericOTP($n) {
    $generator = "1357902468";
    $result = "";
    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
    return $result;
}

function encrypt_decrypt($string, $action = 'encrypt')
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
    $secret_iv = '5fgf5HJ5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
function getEmailHidden($data="",$length="",$hidden){
  if($data!="" && $length !=""){
      $value=(strlen($data)<=$length) ? $data : substr($data,0,$length).$hidden ;
   }else{
     $value=$data;
   }
return $value;
}

function generateRandomColor()
{
    $color = '#';
    $colorHexLighter = array("9","a","b","c","d","e","f" );
    for($x=0; $x < 6; $x++):
        $color .= $colorHexLighter[array_rand($colorHexLighter, 1)]  ;
    endfor;
    return substr($color, 0, 7);
}

  function encrypt($string)
  {
      $key = hash('sha256', $this->encryptKey);
      $iv = substr(hash('sha256', $this->secretIV), 0, 16);
      $encryptedText = openssl_encrypt($string, $this->encryptionMethod, $key, 0, $iv);
      return $encryptedText;
  }

  function generateToken($userId)
  {
      $tokenString = base64_encode(random_bytes(64));
      $token = strtr($tokenString, '+/', '-_');
      $mainToken = hash('sha256', $token);
      $bearerToken =$mainToken.'.'.$this->encrypt($userId);
      return $bearerToken;
  }


function getTakeAwaySlot($date=''){
 
// $period_today = new DatePeriod(
//      new DateTime(date('Y-m-d').' 09:00:00'),
//      new DateInterval('PT1H'),
//      new DateTime(date('Y-m-d').' 21:00:00')
// );

$period_today = new DatePeriod(
     new DateTime($date.' 09:00:00'),
     new DateInterval('PT3H'),
     new DateTime($date.' 21:00:00')
);

// echo "<pre>";
// print_r($date);
// echo "<pre>";
// exit;
$arrayDateToday=array();
foreach ($period_today as $key => $value) {
  $intervalDate=strtotime($value->format('Y-m-d H:i:s'));
   // if(($key%3)==0){
      if(strtotime(date('Y-m-d H:i:s')) <= $intervalDate){
         $arrayDateToday[]=$value->format('Y-m-d h:i:A') .'-'. date('h:i:A', strtotime('+3 hours',strtotime($value->format('H:i:s'))));
      // }
   }
           
}


$period_tomorrw = new DatePeriod(
     new DateTime(date('Y-m-d',strtotime(' +1 day')).' 09:00:00'),
     new DateInterval('PT3H'),
     new DateTime(date('Y-m-d',strtotime(' +1 day')).' 21:00:00')
);


$arrayDateTomarrow=array();
foreach ($period_tomorrw as $keytmo => $toMvalue) {
  $intervalTomDate=strtotime($toMvalue->format('Y-m-d H:i:s'));

   // if(($keytmo%3)==0){
      if(strtotime(date('Y-m-d H:i:s')) <= $intervalTomDate){
        $arrayDateTomarrow[]=$toMvalue->format('Y-m-d h:i:A') .'-'. date('h:i:A', strtotime('+3 hours',strtotime($toMvalue->format('H:i:s'))));
 
      // }
   }

}

$arrayMergerStop=array_merge($arrayDateToday,$arrayDateTomarrow);
$splitArray=array_slice($arrayMergerStop, 0, 4);

return $splitArray;
}




  function getAddDateOfMonth(){
  
      $period_today = new DatePeriod(
          new DateTime(date('Y-m-d').' 12:00:00'),
          new DateInterval('P1D'),
          new DateTime(date('Y-m-t').' 23:59:00')
      );

      foreach ($period_today as $key => $value) {
        $intervalDate=$value->format('d');
        $getDate[$intervalDate]='javascript:void(0);'; 
     }

   return $getDate;
}


function queryChain($where=array()){
  if($where!=array()){
       $mWhere="";
        foreach($where as $key=>$wValue){
          $valu=(is_numeric($wValue)) ? $wValue : '\''.$wValue.'\'';
          $mWhere .= $key.'= '.$valu.' AND ';
        }
        $sql_chain = chop($mWhere," AND ");
    }else{
      $sql_chain="";
    }

    return $sql_chain;
}


function collectIds($arrr){
   
   if(is_array($arrr)){
    $implode=implode(',', $arrr);
   }else{
     $implode=$arrr;
   }

   return $implode;

}



  function getArrayToStr($string){
   $foodhab_param=explode(',',$string);
       $bv=array();
       foreach($foodhab_param as $kye=>$b_value){
         $bv[]= ($b_value!="") ? '\''.$b_value.'\'' :'';
       }
        // $str=collectIds($bv);
       return $bv;
   }


function getArrayToStr_shelflife($string){
   $shelflife_param=explode(',',$string);
       $bv=array();
       foreach($shelflife_param as $kye=>$b_value){
         $bv[]= ($b_value!="") ? $b_value :'';
       }
        $str=collectIds($bv);
       return $bv;
   }

// function searchByBrandANDQuery($brnd){
//  $brands_str=getArrayToStr($brnd);
// if($brnd!='false' && $brnd!=""){
//       $brands_name=' AND brand_name IN ('.$brands_str.')';
//        }else{
//       $brands_name='';
//        }
//   return $brands_name;
// }


function searchByFoodHabitatsANDQuery($foodhab){
 $foodhab_str=getArrayToStr($foodhab);

    if($foodhab!='false' && $foodhab!=""){

             $opening=(count($foodhab_str) >1) ? '(' :'';
             $Closing=(count($foodhab_str) >1) ? ')' :'';

             $foodhab_name=' AND  '.$opening.'FIND_IN_SET ('.$foodhab_str[0].',food_habitats)';
               foreach (array_slice($foodhab_str, 1) as $key => $value) {
                  $foodhab_name .=' OR FIND_IN_SET ('.$value.',food_habitats)';
               }  

               $foodhab_name .=$Closing;
     }else{

      $foodhab_name='';
     }
  return $foodhab_name;
}



function searchByShelfLifeANDQuery($shelfhab){

    $shelfhab_str=getArrayToStr_shelflife($shelfhab);
    if($shelfhab!='false' && $shelfhab!=""){

               $opening=(count($shelfhab_str) >1) ? '(' :'';
               $closing=(count($shelfhab_str) >1) ? ')' :'';

                   $expoVa=explode('-', $shelfhab_str[0]);
                   $selectV ='AND '.$opening.'(shelf_life_period='.$expoVa[0].' AND (shelf_life_period_type="'.$expoVa[1].'" OR shelf_life_period_type="'.strtolower($expoVa[1]).'"))';

                   foreach (array_slice($shelfhab_str,1) as $key => $value) {
                       $expoVa=explode('-', $value);
                       $selectV .='OR (shelf_life_period='.$expoVa[0].' AND (shelf_life_period_type="'.$expoVa[1].'" OR shelf_life_period_type="'.strtolower($expoVa[1]).'"))';
                   }

                 $selectV .=$closing;
     }else{

        $selectV='';
     }
  return $selectV;
}



function switchSortBy($sortby=null){
   switch ($sortby) {

           // case 'low_to_high':
           //     $lowToHighPrice=" ORDER BY `price` ASC,RAND()";
           //   break;
             //  case 'high_to_low':
             // $lowToHighPrice=" ORDER BY `price` DESC,RAND()";
             // break;

              case 'best_selling':
              $query=" ORDER BY pro.topSelling DESC,RAND()";
             break;
               case 'latest':
              $query=" ORDER BY pro.unique_number DESC";
               // $query="AND pro.add_date >= DATE_FORMAT(CURDATE(), '%Y-%m-01') - INTERVAL 3 MONTH ";
             break;
             case 'A_Z':
               $query=" ORDER BY pro.product_name ASC";
             break;
              case 'Z_A':
              $query=" ORDER BY pro.product_name DESC";
             break;

           default:
             $query="ORDER BY RAND()";
             break;
         }

         return $query;
}

function createPagination($total_records=null,$url_link=null,$limit_per_page=null){

            $config['base_url'] =$url_link;
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
             
            // custom paging configuration
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
             
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
             
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
            $config['first_tag_close'] = '</a></li>';
             
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
            $config['last_tag_close'] = '</a></li>';
             
            $config['next_link'] = 'Next';//'Next Page';
            $config['next_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
            $config['next_tag_close'] = '</a></li>';
 
            $config['prev_link'] = 'Previous';//'Prev Page';
            $config['prev_tag_open'] = '<li class="paginate_button page-item page-link"><a href="#">';
            $config['prev_tag_close'] = '</a></li>';
 
            $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
 
            $config['num_tag_open'] = '<li class="paginate_button page-item page-link">';
            $config['num_tag_close'] = '</li>';
            $config['page_query_string']=true;
           
           return $config;
           
}


function createPaginationProduct($total_records=null,$url_link=null,$limit_per_page=null){

            $config['base_url'] =$url_link;
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
             
            // custom paging configuration
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
             
            $config['full_tag_open'] = '<ul class="pagination justify-content-start">';
            $config['full_tag_close'] = '</ul>';
             
            $config['first_link'] = 'F';
            $config['first_tag_open'] = '<li class="page-item page-link"><a href="#">';
            $config['first_tag_close'] = '</a></li>';
             
            $config['last_link'] = 'L';
            $config['last_tag_open'] = '<li class="page-item page-link"><a href="#">';
            $config['last_tag_close'] = '</a></li>';
             
            $config['next_link'] = '<i class="fi-rs-arrow-small-right"></i>';//'Next Page';
            $config['next_tag_open'] = '<li class="page-item page-link">';
            $config['next_tag_close'] = '</li>';
 
            $config['prev_link'] = '<i class="fi-rs-arrow-small-left"></i>';//'Prev Page';
            $config['prev_tag_open'] = '<li class="page-item page-link">';
            $config['prev_tag_close'] = '</li>';
 
            $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
 
            $config['num_tag_open'] = '<li class="page-item page-link">';
            $config['num_tag_close'] = '</li>';
            $config['page_query_string']=true;
           
           return $config;
           
}







function getOrderStatusColor($status=null){  // Not used
 
   switch ($status) {
      case 'Pending':
        $status='style="background-color:#F49832;color:white;border:white;"';
       break;
       case 'Received':
        $status='style="background-color:#33cc33;color:white;border:white;"';
       break;
       case 'Confirmed':
        $status='style="background-color:#009900;color:white;border:white;"';
       break;
       case 'Processing':
        $status='style="background-color:#ff9999;color:white;border:white;"';
       break;
       case 'Shipped':
        $status='style="background-color:#cc6600;color:white;border:white;"';
       break;
       case 'Delivered':
        $status='style="background-color:#339933;color:white;border:white;"';
       break;
       case 'On Holed':
        $status='style="background-color:#999933;color:white;border:white;"';
       break;
       case 'Canceled':
        $status='style="background-color:#ff0066;color:white;border:white;"';
       break;
       case 'Failed payment':
        $status='style="background-color:#ff3300;color:white;border:white;"';
       break;
     default:
       $status='';
       break;
   }

   return $status;
}


function getOrderStatusColor_wareIq($status=null){
// "SHORTAGE", \'DELIVERED", "LOST", "NEW", "READY TO SHIP", "PICKUP REQUESTED", "OPEN", "DTO", "NOT SHIPPED", "DESTROYED", "PENDING", "RTO", "CLOSED", "DISPATCHED", "CANCELED", "IN TRANSIT", "DAMAGED", "DELETED", "SCHEDULED", "SHIPPED"

   switch ($status) {
      case 'Pending':
        $status='style="background-color:#F49832;color:white;border:white;"';
       break;
       case 'Received':
        $status='style="background-color:#33cc33;color:white;border:white;"';
       break;
       case 'Shortage':
        $status='style="background-color:#009900;color:white;border:white;"';
       break;
       case 'Lost':
         $status='style="background-color:#cc6699;color:white;border:white;"';
       break;

       case 'Pickup requested':
        $status='style="background-color:#ff9999;color:white;border:white;"';
       break;
       case 'Shipped':
        $status='style="background-color:#cc6600;color:white;border:white;"';
       break;

       case 'Not shipped':
        $status='style="background-color:#804000;color:white;border:white;"';
       break;

       case 'Destroyed':
        $status='style="background-color:#993399;color:white;border:white;"';
       break;

       case 'Rto':
        $status='style="background-color:#ff6600;color:white;border:white;"';
       break;

       case 'Dto':
        $status='style="background-color:#86b300;color:white;border:white;"';
       break;

       case 'Closed':
        $status='style="background-color:#3366ff;color:white;border:white;"';
       break;

        case 'Open':
        $status='style="background-color:#9900cc;color:white;border:white;"';
       break;

        case 'Dispatched':
        $status='style="background-color:#0033cc;color:white;border:white;"';
       break;

       case 'In transit':
         $status='style="background-color:#009999;color:white;border:white;"';
       break;
      
       case 'Damaged':
         $status='style="background-color:#ff3300;color:white;border:white;"';
       break;

        case 'Deleted':
         $status='style="background-color:#ff33cc;color:white;border:white;"';
       break;

        case 'Scheduled':
         $status='style="background-color:#669999;color:white;border:white;"';
       break;

       case 'Delivered': 
        $status='style="background-color:#339933;color:white;border:white;"';
       break;
       case 'Ready to ship':
        $status='style="background-color:#999933;color:white;border:white;"';
       break;
       case 'Canceled': 
        $status='style="background-color:#ff0066;color:white;border:white;"';
       break;
       case 'Failed payment':
        $status='style="background-color:#ff3300;color:white;border:white;"';
       break;
     default:
       $status='style="background-color:#8c8c8c;color:white;border:white;"';
       break;
   }

   return $status;
}



function smtpConfig($mail,$config){
  
    // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        // $mail->Host     = 'smtpout.secureserver.net';
        
        $mail->SMTPAuth = true;
        $mail->Username = $config['mailUsername'];
        $mail->Password = $config['mailPassword'];
     
        $mail->SMTPSecure = 'ssl';
        // $mail->SMTPSecure = 'tls';
        $mail->Port     = 465;
        // $mail->Port     = 587;

        $mail->charset='iso-8859-1';
        $mail->wordwrap= TRUE;
        $mail->mailtype = 'html';
        // echo "<pre>";
        // print_r($mail);
        // echo "</pre>";
        // exit;

         return $mail;
}

function smtpSend($mail,$config){
    // echo "<pre>";
    // print_r($config);
    // echo "</pre>";
    // exit;
        smtpConfig($mail,$config);
        $mail->setFrom($config['setFrom'], $config['title']);
        // $mail->addReplyTo('info@example.com', 'CodexWorld');
        // Add a recipient
        $mail->addAddress($config['addAddress']);
        // Add cc or bcc 
        $mail->addCC($config['addCC']);
        $mail->addBCC($config['addBCC']);
        // Email subject
        $mail->Subject = $config['subject'];
        // Set email format to HTML
        $mail->isHTML(true);
        // Email body content
        $mailContent = $config['mailContent'];
        $mail->Body = $mailContent;
        // Send email
        if(!$mail->send()){
            // echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
          return false;  
        }else{
            // echo 'Message has been sent';
            return true;
        }

        // exit;
  
    }

function orderArray($send=array(),$orders=array(),$orders_manger=array()){
              // echo "<pre>";
              // print_r($orders_manger);
              // print_r($orders);
              // echo "</pre>";
              // exit;

              $send['total_details']=$orders_manger;
              $order_items=array();
              if($orders!=array()){

                foreach($orders as $value){

                    $arrItems=array(
                           'order_Id'=>$value->pro_generated_order_id,
                           'image'=>$value->pro_product_img,
                           'product_title'=>$value->pro_product_name,
                           'sku_id'=>$value->pro_sku_id,
                           'product_id'=>$value->pro_own_product_id,
                           'pro_product_qty'=>$value->pro_product_qty,
                           'units'=>$value->units,
                           'packsize'=>$value->packsize,
                           'selling_price'=>$value->pro_product_selling_price,
                           'pro_subtotal'=>$value->pro_subtotal,
                           'pro_cat_name'=>$value->pro_cat_name,
                           'pro_sub_cat_name'=>$value->pro_sub_cat_name,
                           'pro_order_status'=>$value->pro_order_status
                         );

                     array_push($order_items, $arrItems);
                  }
             }



            $send['orderItems']=$order_items;
            
            // $send['total_details']=array(
            //   'pro_subtotal'=>$orders_manger[0]->order_total_purchase_amount,
            //   'pro_shipping_charges'=>0.00,
            //   'total'=>$orders_manger[0]->order_total_purchase_amount+0
            // );

            // $send['delivery_address']=array(
            //   'order_address'=>$orders_manger[0]->order_address,
            //   'order_locality'=>$orders_manger[0]->order_locality,
            //   'order_district'=>$orders_manger[0]->order_district,
            //   'order_state'=>$orders_manger[0]->order_state,
            //   'order_pincode'=>$orders_manger[0]->order_pincode,
            //   'order_country'=>$orders_manger[0]->order_country,
            // );

            // pre($orders_manger,1);
            // pre($send);

            return $send;

    }


function strip_param_from_url( $url, $param ) {
    $base_url = strtok($url, '?');              // Get the base url
    $parsed_url = parse_url($url);              // Parse it 
    $query = $parsed_url['query'];              // Get the query string
    parse_str( $query, $parameters );           // Convert Parameters into array
    unset( $parameters[$param] );               // Delete the one you want
    $new_query = http_build_query($parameters); // Rebuilt query string
    return $base_url.'?'.$new_query;            // Finally url is ready
}



function convertNumberToWordsForIndia($number){
    //A function to convert numbers into Indian readable words with Cores, Lakhs and Thousands.
    $words = array(
    '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
    '6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
    '11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
    '16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
    '30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
    '80' => 'eighty','90' => 'ninty');
    
    //First find the length of the number
    $number_length = strlen($number);
    //Initialize an empty array
    $number_array = array(0,0,0,0,0,0,0,0,0);        
    $received_number_array = array();
    
    //Store all received numbers into an array
    for($i=0;$i<$number_length;$i++){    
      $received_number_array[$i] = substr($number,$i,1);    
    }

    //Populate the empty array with the numbers received - most critical operation
    for($i=9-$number_length,$j=0;$i<9;$i++,$j++){ 
        $number_array[$i] = $received_number_array[$j]; 
    }

    $number_to_words_string = "";
    //Finding out whether it is teen ? and then multiply by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
    for($i=0,$j=1;$i<9;$i++,$j++){
        //"01,23,45,6,78"
        //"00,10,06,7,42"
        //"00,01,90,0,00"
        if($i==0 || $i==2 || $i==4 || $i==7){
            if($number_array[$j]==0 || $number_array[$i] == "1"){
                $number_array[$j] = intval($number_array[$i])*10+$number_array[$j];
                $number_array[$i] = 0;
            }
               
        }
    }

    $value = "";
    for($i=0;$i<9;$i++){
        if($i==0 || $i==2 || $i==4 || $i==7){    
            $value = $number_array[$i]*10; 
        }
        else{ 
            $value = $number_array[$i];    
        }            
        if($value!=0)         {    $number_to_words_string.= $words["$value"]." "; }
        if($i==1 && $value!=0){    $number_to_words_string.= "Crores "; }
        if($i==3 && $value!=0){    $number_to_words_string.= "Lakhs ";    }
        if($i==5 && $value!=0){    $number_to_words_string.= "Thousand "; }
        if($i==6 && $value!=0){    $number_to_words_string.= "Hundred &amp; "; }            

    }
    if($number_length>9){ $number_to_words_string = "Sorry This does not support more than 99 Crores"; }
    return ucwords(strtolower($number_to_words_string)." Only.");
}


function email_validation($str) {
    return (!preg_match(
"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str))
        ? FALSE : TRUE;
}

function checkedCouponValidity($startDate='',$enddate=''){
       $currentDate=date('Y-m-d');
       $startDate=date($startDate);
       $endDate=date($enddate);

       $numberCurrent=strtotime($currentDate);
       $numberstart=strtotime($startDate);
       $numberend=strtotime($endDate);

       if($numberstart <= $numberCurrent && $numberend >= $numberCurrent){
       $result='<span class="badge" style="background-color:#009900;color:white;border:white;">Valid</span>';
       }else{
        $result='<span class="badge" style="background-color:#689F39;color:white;border:white;">Expired</span>';
       }

       return $result;

}

function priceRangeFilter($rangePrice=''){
   
   $expoVa = array_filter(explode(',',$rangePrice));

   $query='';
   if($expoVa!=array()){
        
      if($expoVa[0]!='false'){
        $getAr=array();
        foreach($expoVa as $val){
          $exporeDess=explode('__',$val);
          $getAr[]=$exporeDess[0];
        }

        foreach($expoVa as $key=>$value){

            $exporeDess=explode('__',$value);

            $OR1=(count($expoVa)>1) ? ' OR ':'';

            if($exporeDess[0]=='LessThan'){
               $query .= ' `price`<='.$exporeDess[1] . $OR1;
            }


             if($exporeDess[0]!='LessThan' && $exporeDess[0]!='MoreThan'){
               $OR=(($key+1) < count($expoVa)) ? ' OR ':'';
                
               $query .= ' (`price`>='.$exporeDess[0]. ' AND `price`<=' .$exporeDess[1].') '.$OR ;
             }

            if($exporeDess[0]=='MoreThan'){

               $query .= ' `price`>='.$exporeDess[1] ;

             }
           
           }
            $query .=' AND ';
         }

      }

   return $query;
}


function ratingFilter($rating=''){

  $expoVa = array_filter(explode(',',$rating));
    $query='';
  if($expoVa!=array()){

     if($expoVa[0]!='false'){
        $query=' cust_rate IN ('.implode(',', $expoVa).')' ;
     }
  }

   return $query;
}


// searchByFoodHabitatsANDQuery

// // Usage
// echo strip_param_from_url( 'http://url.com/search/?location=london&page_number=1', 
//   'location' )

// function addToCartButton($value){
  
//    if($value->in_stock_status==1){

//        $adClick=($value->variants!=array()) ? ((($value->variants[0]->stock!=0) && ($value->variants[0]->variants_in_stock_status!=0)) ? 'add-to-cart' :'') :'';
       
//        $adheader=($value->variants!=array()) ? ((($value->variants[0]->stock!=0) && ($value->variants[0]->variants_in_stock_status!=0)) ? 'Add to cart' :'Out of Stock') :'Out of Stock';
       
//        $adCss=($value->variants!=array()) ? ((($value->variants[0]->stock!=0) && ($value->variants[0]->variants_in_stock_status!=0)) ? '' :'style="background-color:#5c636a;"') :'||style="background-color:#5c636a;"';
//  }else{

//       $adClick='';
//       $adheader='Out of Stock';
//       $adCss='style="background-color:#5c636a;"';
//    }


//        $sessionType=$this->session->userdata('valueType');
//       if($sessionType==""){

//           $data_toggle='data-toggle="modal"';
//           $data_target='data-target="#myModal'.$value->unique_number.'"';
//           $adClick='';
//       }else{
//           $data_toggle='';
//           $data_target='';
//           $adClick='add-to-cart';
//       }







//   $html=' <a href="javascript:void(0);" '.$data_toggle.' '.$data_target.' class="btn btn-secondary shop-black-btn uptos'.$value->unique_number.' '.$adClick.'" data-id="'.$value->unique_number.'" '.$adCss.'>'.$adheader.'</a>';
// }



?>