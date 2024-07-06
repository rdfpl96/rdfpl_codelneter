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
                                <div class="dashboard-content gift_card_main_sec mt-30">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Redeem Gift Card</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row  create_new_email_address mt-0 mb-0">
                                                    <div class="form-group col-lg-5">
                                                        <label for="inputPassword5" class="form-label">Your gift card code <span class="text-danger">*</span></label>
                                                        <input type="text" placeholder="Enter gift card code">
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <label for="inputPassword5" class="form-label">Your gift card PIN </label>
                                                         <input type="text" placeholder="Enter gift card PIN">
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                         <a href="#" class="btn btn-md w-100 add-shi-sa shipping-address-save">Redeem</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Active Cards</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <?php for ($i=0; $i < 10 ; $i++) { ?>
                                                       <div class="col-md-6">
                                                           <div class="gift_code_list d-flex justify-content-between align-items-center">
                                                               <div class="gift_code_left_content">
                                                                   <p class="text-muted">Rs 500.00</p>
                                                                   <p class="text-muted">Gift Code: 100227772222</p>
                                                               </div>
                                                               <div class="gift_code_right_button">
                                                                   <a href="#" class="btn btn-md w-100 add-shi-sa shipping-address-save disabled">Redeemed</a>
                                                               </div>
                                                           </div>
                                                        </div>
                                                    <?php   } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div><!--col-10-->                            

                        </div><!--row close-->
                    </div><!--col-lg-12-->
                </div><!--row close-->
            </div><!--container close-->
        </div><!--page-content close-->
    </main>