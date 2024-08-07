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
    ?>     

</head>
<body>
    <div id="ebazar-layout" class="theme-blue">
         <?php  $this->load->view('admin/sidemenubar'); ?>
            <!-- Body: Header -->
            <div class="header">
                <input type="hidden" value="<?php echo base_url();?>" class="base_url">
                <nav class="navbar">  <!-- py-4 -->
                    <div class="container-xxl">
                        <!-- <?php // $walletAmount = walletBalance();?>
                       <div class="walletDiv" style="float:right;"><b>Wallet : </b><span style="font-weight:bold;font-size: 16px;">₹ <?php // echo sprintf("%0.2f",$walletAmount->data->balance_amount);?></span></div> -->
                        <!-- header rightbar icon -->
                        <div class="h-right d-flex align-items-center mr-lg-0 order-1">

                            
                             
                            <div class="admin_mob_logo width_70">
                                <a href="<?php echo base_url('admin/dashboard');?>"><img src="<?php echo base_url();?>include/frontend/assets/img/home-2/mahalaxmi-logo_new.png"></a>
                            </div>   

                            <div class="width_30">
                            <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                                <div class="u-info me-2">
                                    <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold"><?php echo getShortData($session['admin_name'],20);?></span></p>
                                    <small><?php echo getShortData($session['admin_designation'],20);?></small>
                                </div>
                                <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                        <?php
                                        // Retrieve the session data for the admin image
                                        $adminImage = $this->session->userdata('admin_image');
                                        $defaultImageUrl = base_url() . 'include/assets/images/profile_av.svg';
                                       
                                        $imageUrl = (!empty($adminImage)) ? base_url() . 'uploads/' . $adminImage : $defaultImageUrl;

                                        //  echo "<pre>"; print_r($imageUrl); die();

                                        ?>
                                        
                                        <img class="avatar lg rounded-circle img-thumbnail" src="<?php echo $imageUrl; ?>" alt="profile">  
                                        <h6>Welcome, <?php echo $this->session->userdata('name'); ?>!</h6>
                                    </a>
                                <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                    <div class="card border-0 w280">
                                        <div class="card-body">
                                            <div class="">
                                                <div class="flex-fill">
                                                    <a href="<?php echo base_url('admin/logout');?>" class="font-weight-bold">Ḷogout</a>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                          
                        </div>
        
                        <!-- menu toggler -->
                        <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                            <span class="fa fa-bars"></span>
                        </button>

                        </div>
        
                        <!-- main menu Search-->
                        <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">
                          
                        </div>
        
                    </div>
                </nav>
            </div>