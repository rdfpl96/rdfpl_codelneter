<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Royal Dryfruit</title>
    <!-- <link rel="icon" href="../favicon.ico" type="image/x-icon"> -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>include/frontend/assets/img/footer-logo.png">
    <!-- project css file  -->
     <link rel="stylesheet" href="<?php echo base_url();?>include/assets/plugin/datatables/responsive.dataTables.min.css">
     <link rel="stylesheet" href="<?php echo base_url();?>include/assets/plugin/datatables/dataTables.bootstrap5.min.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="<?php echo base_url();?>include/assets/css/ebazar.style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
    <link rel="stylesheet" href="<?php echo base_url();?>include/assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?php echo base_url();?>include/assets/css/style.css">
  
    <link href="<?php echo base_url();?>include/assets/css/datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
<link href="<?php echo base_url();?>include/assets/css/select2.min.css" rel="stylesheet" />
    <?php
      $exportUrl=explode('/', $_SERVER['REQUEST_URI']);
     
     $getFilename=(in_array($fileName,$exportUrl)) ? $fileName:'';
     echo $this->my_libraries->summernoteLibraryCss($getFilename,$fileName);
     if(empty($this->session->userdata('name'))){
        redirect('admin/login','refresh');
        exit();
    }

    ?>     

</head>
<body>
    <div id="ebazar-layout" class="theme-blue">