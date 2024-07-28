  
            <!-- Body: Header -->
            <div class="header">
                <input type="hidden" value="<?php echo base_url();?>" class="base_url">
                <nav class="navbar">  <!-- py-4 -->
                    <div class="container-xxl">
                        <?php //$walletAmount = walletBalance();?>
                       <!-- <div class="walletDiv" style="float:right;"><b>Wallet : </b><span style="font-weight:bold;font-size: 16px;">₹ <?php //echo sprintf("%0.2f",$walletAmount->data->balance_amount);?></span></div> -->
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
                                    $imageUrl=($session['admin_image']!="") ? base_url().'/uploads/user/'.$session['admin_image'] : base_url().'/include/assets/images/profile_av.svg';
                                    ?>
                                    <img class="avatar lg rounded-circle img-thumbnail" src="<?php echo $imageUrl;?>" alt="profile">
                                    <!-- include/assets/images/profile_av.svg -->
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