<?php
$this->load->view('frontend/header',$data);
?>
<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>Shipping Address
                </div>
            </div>
        </div>
        <div class="page-content pt-20 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 my_account_main m-auto">
                        <div class="row">
                            <div class="col-md-2">
                              <?php $this->load->view('frontend/component/my_account_side_bar'); ?>
                            </div>
                            <div class="col-md-10">
                                
                                <!-- <div class="tab-content account dashboard-content"> -->
                                    <!-- <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab"> -->


                                        
                                          <div class="check_addres_second">
                                            <!-- <h3>Shipping address</h3> -->
                                             <div class="errmess" style="margin-top: 10px;font-size: 19px;"></div>
                                              <?php 
                                              $addr['address']=$shipp_address;
                                              $addr['addrs']='shipping-address-save';
                                              $this->load->view('frontend/component/address_form',$addr);
                                              ?>
                                            </div>

                                    <!-- </div> -->

                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
$this->load->view('frontend/footer',$data);
?>
  