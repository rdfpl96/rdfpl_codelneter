<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Royal Dryfruits</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>include/frontend/assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>include/frontend/assets/css/main2cc5.css?v=5.6" />
    <link rel="stylesheet" href="<?php echo base_url();?>include/frontend/assets/css/custom-css.css" />


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

    <body style="<?php echo (($urlcnd=='checkout') ? 'background-color: #f4f4f4;' : '');?>">
    <div class="loading_full" style="display: none;">Loading&#8230;</div>
    <input type="hidden" value="<?php echo base_url();?>" id="base-url-f">
    <div id="snackbar"></div>
    