 <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>ALert & Notification
                </div>
            </div>
        </div>
        <div class="page-content pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 my_account_main m-auto">
                        <div class="row">
                            <div class="col-md-2">
                               <?php 
                                 $p['pageType'] = 'account';
                                 $this->load->view('frontend/component/my_account_side_bar',$p); 
                               ?>
                            </div>

                            <div class="col-md-10">
                                <div class="alert_notification dashboard-content mt-30">
                                    
                                       <h3>Notification</h3>

                                        <div class="alert alert-success mt-20" role="alert">
                                            Fresh Produce Alert! Enjoy seasonal fruits and vegetables now available at great prices. Stock up your kitchen today!
                                        </div>

                                        <div class="alert alert-primary mt-20" role="alert">
                                            Limited Time Offer: Get 20% off on select organic products. Hurry, offer ends soon!
                                        </div>


                                    
                                </div>
                            </div><!--col-10-->

                        </div><!--row close-->
                    </div><!--col-lg-12-->
                </div><!--row close-->
            </div><!--container close-->
        </div><!--page-content close-->
    </main>