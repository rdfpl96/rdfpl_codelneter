<?php
// print_r($offers);
// exit();
?>
<?php $this->load->view('frontend/header'); ?>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>My offers
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 my_account_main m-auto">
                        <div class="row">
                            <!-- <div class="col-md-2">
                               <?php 
                                // $p['pageType'] = 'wishlist';
                                // $p['re_div']='rediv';
                                //  $this->load->view('frontend/component/myaccountsidebar',$p); 
                                ?>
                            </div> -->
                            <div class="col-md-12 ">
                                
                                <!-- <div class="tab-content account dashboard-content"> -->
                                    <!-- <div class="tab-pane fade active show" > -->
                                        
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="refpa">
                                        <div class="row product-grid">
                                            <?php if (!empty($offers)):?>

                                                <?php
                                                    $data['productItems'] = $offers;
                                                    $this->load->view('frontend/component/productItem', $data);
                                                ?>
                                            <?php //echo $products;?>
                                            <?php else: ?>
                                                <img src="<?php echo base_url('include/no-product.png'); ?>" style="width: 40%; margin-left: auto; margin-right: auto; padding: 3% 0 3%;">
                                                <h3 style="text-align: center;">Product Not Found</h3>
                                            <?php endif; ?>
                                        </div>                                            
                                            <div class="pagination-area mt-20 mb-20">
                                                <nav aria-label="Page navigation example">
                                                    <?php echo $links ;?>
                                               </nav>
                                           </div>
                                       </div>
                                        </div>
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
<?php $this->load->view('frontend/footer'); ?>