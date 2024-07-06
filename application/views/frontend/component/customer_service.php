 <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>Customer Service
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
                                <div class="account dashboard-content">
                                    
                                        <div class="card2">
                                            <div class="card-body">

                                                <div class="customer_service">
                                                    <div class="row">
                                                        <div class="customer_service_heading">
                                                            <h3>Regarding Orders</h3>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="customer_service_card">
                                                                <div class="customer_service_icon">
                                                                    <span class="material-symbols-outlined">calendar_clock</span>
                                                                </div>
                                                                <div class="customer_service_heading">
                                                                    <h4>Change Delivery Slot</h4>
                                                                    <p class="text-muted">Click here to change the delivery slot</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="customer_service_card">
                                                                <div class="customer_service_icon">
                                                                   <span class="material-symbols-outlined">currency_exchange</span>
                                                                </div>
                                                                <div class="customer_service_heading">
                                                                    <h4>Returns & Exchanges</h4>
                                                                    <p class="text-muted">Click here to exchange/return your delivered products</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="customer_service_card">
                                                                <div class="customer_service_icon">
                                                                    <span class="material-symbols-outlined">delete_history</span>
                                                                </div>
                                                                <div class="customer_service_heading">
                                                                    <h4>Cancel Orders</h4>
                                                                    <p class="text-muted">Click here to cancel your active order</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="customer_service_heading pt-30">
                                                            <h3>Regarding Payments</h3>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="customer_service_card">
                                                                <div class="customer_service_icon">
                                                                    <span class="material-symbols-outlined">currency_rupee</span>
                                                                </div>
                                                                <div class="customer_service_heading">
                                                                    <h4>Pay for an Order</h4>
                                                                    <p class="text-muted">Click here to pay for your unpaid active order</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="customer_service_card">
                                                                <div class="customer_service_icon">
                                                                    <span class="material-symbols-outlined">percent</span>
                                                                </div>
                                                                <div class="customer_service_heading">
                                                                    <h4>Forgot eVoucher</h4>
                                                                    <p class="text-muted">Click here to apply voucher for an active order</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
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