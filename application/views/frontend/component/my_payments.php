 <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>My Payments
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

                            <div class="col-md-6">
                                <div class="my_payments_main_sec mt-30">                                    
                                    <h4 class="font-weight">Wallets</h4>
                                    <div class="accordion  mt-20" id="accordionExample">                             
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <a class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-md-1">
                                                            <div class="my_payment_sec_icon">
                                                                <img src="<?php echo base_url().'include/frontend/assets/imgs/theme/paytm.png';?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <div class="my_payment_sec_heading">Paytm</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-11">
                                                            <div class="payment_sec_details">
                                                                <div class="form-group col-lg-8">
                                                                    <label class="form-label">Phone Number</label>
                                                                    <input type="text" placeholder="Enter Mobile Number" value="">
                                                                    <label class="text-muted form-label">One time password(OTP) will be sent to this number</label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <a href="#" class="btn btn-md w-100 add-shi-sa shipping-address-save">Send OTP</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>        
                                            </div>
                                        </div><br> 

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <a class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-md-1">
                                                            <div class="my_payment_sec_icon">
                                                                <img src="<?php echo base_url().'include/frontend/assets/imgs/theme/mobikwik.png';?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <div class="my_payment_sec_heading">Mobikwik</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-11">
                                                            <div class="payment_sec_details">
                                                                <div class="form-group col-lg-8">
                                                                    <label class="form-label">Phone Number</label>
                                                                    <input type="text" placeholder="Enter Mobile Number" value="">
                                                                    <label class="text-muted form-label">One time password(OTP) will be sent to this number</label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <a href="#" class="btn btn-md w-100 add-shi-sa shipping-address-save">Send OTP</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>        
                                            </div>
                                        </div> <br>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingthree">
                                                <a class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-md-1">
                                                            <div class="my_payment_sec_icon">
                                                                <img src="<?php echo base_url().'include/frontend/assets/imgs/theme/freecharge.png';?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <div class="my_payment_sec_heading">Freecharge</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-11">
                                                            <div class="payment_sec_details">
                                                                <div class="form-group col-lg-8">
                                                                    <label class="form-label">Phone Number</label>
                                                                    <input type="text" placeholder="Enter Mobile Number" value="">
                                                                    <label class="text-muted form-label">One time password(OTP) will be sent to this number</label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <a href="#" class="btn btn-md w-100 add-shi-sa shipping-address-save">Send OTP</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>        
                                            </div>
                                        </div> <br>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingfour">
                                                <a class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-md-1">
                                                            <div class="my_payment_sec_icon">
                                                                <img src="<?php echo base_url().'include/frontend/assets/imgs/theme/amazonpay.png';?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <div class="my_payment_sec_heading">Amazon Pay</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-11">
                                                            <div class="payment_sec_details">
                                                                <div class="form-group col-lg-8">
                                                                    <div class=" d-flex align-items-center pt-10">
                                                                        <input class="form-check-input " type="checkbox">&nbsp;&nbsp;
                                                                            <label class="form-check-label mb-0">
                                                                                <span> <p class="text-muted">Make this as my default payment option</p></span>
                                                                            </label>                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <a href="#" class="btn btn-md w-100 add-shi-sa shipping-address-save">Place Order & Pay</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>        
                                            </div>
                                        </div>
                                    </div> <!--accordin end-->
                                </div><!--my_payments_main_sec-->
                            </div><!--col-6-->

                        </div><!--row close-->
                    </div><!--col-lg-12-->
                </div><!--row close-->
            </div><!--container close-->
        </div><!--page-content close-->
    </main>