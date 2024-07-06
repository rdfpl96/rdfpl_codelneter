<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>include/frontend/assets/img/home-2/mahalaxmi-logo_new.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Royal Dryfruit</title>
    <link rel="icon" href="<?php echo base_url();?>include/favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="<?php echo base_url();?>include/assets/css/ebazar.style.min.css">
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <style>
         .lds-ring {
      display: inline-block;
      position: relative;
      width: 40px;
      height: 40px;
    }
    .lds-ring div {
      box-sizing: border-box;
      display: block;
      position: absolute;
      width: 30px;
      height: 30px;
      margin: 7px;
      border: 4px solid #ee161f;
      border-radius: 50%;
      animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
      border-color: #ee161f transparent transparent transparent;
    }
    .lds-ring div:nth-child(1) {
      animation-delay: -0.45s;
    }
    .lds-ring div:nth-child(2) {
      animation-delay: -0.3s;
    }
    .lds-ring div:nth-child(3) {
      animation-delay: -0.15s;
    }
    @keyframes lds-ring {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
     </style>

</head>
<body>
    <div id="ebazar-layout" class="theme-blue">
   <input type="hidden" value="<?php echo base_url();?>" class="base_url">
        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5 ">
            
            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">

                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                            <div style="max-width: 25rem;">
                                <div class="text-center mb-5">
                                    <i class="bi bi-bag-check-fill  text-primary" style="font-size: 90px;"></i>
                                </div>
                                <div class="mb-5">
                                    <h2 class="color-900 text-center">A few clicks is all it takes.</h2>
                                </div>
                                <!-- Image block -->
                                <div class="">
                                    <img src="<?php echo base_url();?>include/assets/images/login-img.svg" alt="login-img">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">
                                 <a href="#"><img src="<?php echo base_url();?>include/frontend/assets/imgs/mahalaxmi-logo_new.png" style="margin-left: auto;width: 30%;margin-right: auto;display: block;"></a>
                                <!-- Form -->
                                
                                    <form class="row g-1 p-3 p-md-4" id="loginform" action="<?php echo  base_url('admin/login')?>" method="post">
                                   <?php echo $this->session->flashdata('msg'); ?>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Username</label>
                                            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="User name" required>
                                            <span class="help-block" style="color:red"><?php echo strip_tags(form_error('username')); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <div class="form-label">
                                                <span class="d-flex justify-content-between align-items-center">Password</span>
                                            </div>
                                            <input type="password" id="userpassword" name="password" class="form-control form-control-lg" placeholder="Password" required>
                                            <span class="help-block" style="color:red"><?php echo strip_tags(form_error('password')); ?></span>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12 text-center mt-4 ship_ad_btn_css">

                                      <button type="submit" name="login_submit" class="btn custom_top_btn_css btn-primary py-2 px-5 text-uppercase btn-set-tas w-sm-100 log-cl login-admin" atl="signin" value="login">SIGN IN</button>

                                    </div>
                                    <!-- <div class="loaderdiv"></div> -->
                                   
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div> <!-- End Row -->
                    
                </div>
            </div>

        </div>

    </div>

    
</body>
</html>

