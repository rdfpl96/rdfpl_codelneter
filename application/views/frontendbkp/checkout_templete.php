<?php

  $exportUrl=array();
   $arrBurl=explode('/', $_SERVER['REQUEST_URI']);
   if(in_array('checkout',$arrBurl)){
       array_push($exportUrl,'checkout');
   }

    $pageName=end($arrBurl);
    $data['urlcnd']=$pageName;
 
  $this->load->view('frontend/head',$data);
   $this->load->view($content);

    $user=$this->my_libraries->mh_getCookies('customer');
    $d['customer']=$user;
  $this->load->view('frontend/script',$d);
?>