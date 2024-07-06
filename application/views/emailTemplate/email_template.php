<?php 
$d['bodyContent']=$content;
$this->load->view('emailTemplate/head');
$this->load->view('emailTemplate/body',$d);
$this->load->view('emailTemplate/footer');
?>