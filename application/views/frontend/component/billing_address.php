<?php
$this->load->view('frontend/header',$data);
?>
<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>Billing Address
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
                                
                                <div class="tab-content account dashboard-content">
                                    <div class="tab-pane fade active show" >
                                        
                                         <div class="check_addres_second">
                                            <!-- <h3>Billing address</h3> -->

                                            <?php if(!empty($getAddr) && $getAddr!=""){?>
                                              <br>
                                             <div class="add_new_header">
                                                <div class="row">
                                                    <div class="col-md-1 text-white">
                                                        <h4 class="text-white"><span><i class="fas fa-map-marker-alt"></i></span></h4>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="new_add_heading">
                                                            <h5><?php echo $delnames;?></h5>
                                                            <p><?php echo $getAddr;?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           <?php } ?>

                                            <?php 
                                            
                                            $addr['address']=$billingAddress;
                                            $addr['addrs']='billing-address-save';
                                            $this->load->view('frontend/component/address_form',$addr);
                                            ?>
                                            </div>        

                                    </div>

                                </div>
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