
<?php $this->load->view('frontend/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    /* *** The Checkboxes *** */
label.btn.toggle-checkbox > i.fa:before { content:"\f096"; }
    label.btn.toggle-checkbox.active > i.fa:before { content:"\f046"; }

label.btn.active { box-shadow: none; }
label.btn.primary.active {
    background-color: #337ab7;
    border-color: #2e6da4;
    color: #ffffff;
    box-shadow: none;
}
label.btn.info.active {
    background-color: #5bc0de;
    border-color: #46b8da;
    color: #ffffff;
    box-shadow: none;
}
label.btn.success.active {
    background-color: #5cb85c;
    border-color: #4cae4c;
    color: #ffffff;
    box-shadow: none;
}
label.btn.warning.active {
    background-color: #f0ad4e;
    border-color: #eea236;
    color: #ffffff;
    box-shadow: none;
}
label.btn.danger.active {
    background-color: #d9534f;
    border-color: #d43f3a;
    color: #ffffff;
    box-shadow: none;
}
label.btn.inverse.active {
    background-color: #222222;
    border-color: #111111;
    color: #ffffff;
    box-shadow: none;
}
</style>
<main class="main">
<div class="page-header mb-50">
<div class="">
     
  <section class="checkout_top_sec">
            <div class="container mb-10">
               <div class="row">
                  <div class="col-md-1">
                     <div class="chekcout_royal_logo">
                        <a href="<?php echo base_url('');?>"><img src="<?php echo base_url('include/frontend/assets/imgs/theme/logo.png');?>" width="85px" alt="logo"></a>
                     </div>
                  </div>
                  <div class="col-md-11">
                     <div class="checkout_tabs">
                        <div class="step-container">
                           <div class="step">
                              <div class="step-text">
                                 <span class="step-icon-left">
                                    <svg class="svg-inline--fa fa-map-marker-alt fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                       <path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
                                    </svg>
                                    <!-- <i class="fas fa-map-marker-alt"></i> Font Awesome fontawesome.com -->
                                 </span>
                                 Delivery Address
                              </div>
                              <p><?php echo $this->customlibrary->getCustomerCurrentAddress($customer_id);?></p>
                           </div>
                           <div class="step" id="step3">
                              <div class="step-text">
                                 <span class="step-icon-left">
                                    <svg class="svg-inline--fa fa-calendar fa-w-14" aria-hidden="true" focusable="false" data-prefix="far" data-icon="calendar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                       <path fill="currentColor" d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"></path>
                                    </svg>
                                    <!-- <i class="far fa-calendar"></i> Font Awesome fontawesome.com -->
                                 </span>
                                 Delivery Options
                              </div>
                              <p>Choose your convenient date and time for <br> delivery</p>
                           </div>
                           <div class="step active" id="step2">
                              <div class="step-text">
                                 <span class="step-icon-left">
                                    <svg class="svg-inline--fa fa-credit-card fa-w-18" aria-hidden="true" focusable="false" data-prefix="far" data-icon="credit-card" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                       <path fill="currentColor" d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"></path>
                                    </svg>
                                    <!-- <i class="far fa-credit-card"></i> Font Awesome fontawesome.com -->
                                 </span>
                                 Payment
                              </div>
                              <p>Pay Order amount by selecting any payment  <br> mode</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

    <section>
        <div class="container mb-30">
            <div class="row">
                <div class="col-md-8">
            <!-- ==============================form secodn end===================== -->
                <div class="my_account_main">
                    <!-- <a href="<?php //echo base_url('checkout');?>" style="float: right;margin-top: -3%;">Back</a> -->
                    
                             <div class="check_addres_first">
                               <!-- <div class="row"> -->
                                  <!-- <div class="col-md-12"> -->
                                        <div class="accordionaaa" id="accordionExample">


                                          <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <div class="row">
                                                    <div class="col-md-6 location_first_icon">
                                                        <h3><input type="checkbox" class="gst_input form-check-input" name="gst_input" value="1">&nbsp;&nbsp;Enter GST Details (Optional)</h3>
                                                    </div>
                                                </div>
                                              </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                              <div class="accordion-body">
                                                <div class="row">
                                                   <?php  
                                                       // $gst['cusotmer_details']=$cusotmer_details;
                                                       // $this->load->view('frontend/containerPage/enterGstNumber',$gst);
                                                     ?>
                                                   </div>
                                              </div>
                                            </div>
                                          </div>


                                      <!--      <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour">
                                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                <div class="row">
                                                    <div class="col-md-6 location_first_icon">
                                                        <h3><span class="material-symbols-outlined">orders</span>Preview Items</h3>
                                                    </div>
                                                </div>
                                              </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                              <div class="accordion-body">
                                                <div class="row">
                                                   <?php  
                                                       //$this->load->view('frontend/containerPage/preview_items');
                                                     ?>
                                                   </div>
                                              </div>
                                            </div>
                                          </div> -->


                                          <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                 <div class="row">
                                                    <div class="col-md-4 location_first_icon">
                                                        <h3><span class="material-symbols-outlined">payments</span> Payment Mode</h3>
                                                    </div>
                                                </div>
                                              </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                              <div class="accordion-body">
                                                <label class="btn btn-default btn-lg toggle-checkbox primary">
                                                            <i class="fa fa-fw"></i>
                                                            <input id="one" autocomplete="off" class="" type="radio" />
                                                            Cash on deleivery
                                                        </label>
                                                   <label class="btn btn-primary btn-lg toggle-checkbox primary">
                                                            <i class="fa fa-fw"></i>
                                                            <input id="two" autocomplete="off" class="" type="radio" />
                                                            Online Payment
                                                        </label>
                                                <a href="javascript:void(0);" class="btn mb-20 w-100 order-place" style="width: 25% !important;">Order Place</a>
                                              </div>
                                            </div>
                                          </div>




                                        </div>
                                        <!-- ===================collap================ -->
                                  <!-- </div> -->
                              </div>
                            </div>
                            <!--chek address first end-->
                         
                       
                        <!-- ================================= -->
                    <!-- </div> -->
                </div>
                
                <div class="col-md-4">          
                  <div class="border p-md-4 cart-totals ml-30">
                   <?php //this->load->view('frontend/containerPage/order_summary_and_coupon_div');?>
                </div>
                </div> 
            </div>
        </div>                    
    </section>
</div>
</div>
</main>

<?php $this->load->view('frontend/footer'); ?>