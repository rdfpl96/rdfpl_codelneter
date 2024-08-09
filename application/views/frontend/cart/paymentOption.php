
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
.ad_type li{
    padding-left:117px;
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
            <div class="my_account_main">
               <!-- <a href="<?php //echo base_url('checkout');?>" style="float: right;margin-top: -3%;">Back</a> -->
               <div class="check_addres_first">
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
                              <?php echo $this->load->view('frontend/component/gst',array('gstdetail'=>$gstDetail), true); ?>
                           </div>
                        </div>
                     </div>
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
                              <ul class="ad_type text-center">
                                 <li><input type="radio" name="payemnt_type" id="home" value="cod" class="actinput" checked><label for="home"><span class="material-symbols-outlined">payments</span>&nbsp;&nbsp; Cash On Delivery</label></li>
                                 <li><input type="radio" name="payemnt_type" id="office" value="online" class="actinput"><label for="office"><span class="material-symbols-outlined">credit_card</span>&nbsp;&nbsp; Online Payment</label></li>
                                 &nbsp;&nbsp;&nbsp;&nbsp;
                              </ul>
                              <div class="text-right mt-30">
                                 <a href="javascript:void(0);" class="btn mb-20 w-100 order-place" style="width: 25% !important;" onclick="placeOrder();return false;">Order Place</a>
                              </div>
                           </div>
                        </div>
                        <div id="errMsg"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="border p-md-4 cart-totals ml-30">
                <div class="table-responsive page-manage">
                      <div id="updPage">
                         <!-- ---------new order summary--------- -->
                         <a href="" data-bs-toggle="modal" data-bs-target="#vouchers_modal">
                            <div class="apply_vouchers">
                               <div class="left_side_voucher">
                                  <img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/offer_perecnt.svg">
                                  <div class="voucher_header">
                                     <h4>Apply Voucher</h4>
                                     <p class="text-muted">7 Vouchers Available</p>
                                  </div>
                               </div>
                               <div class="right_side_voucher">
                                  <span class="material-symbols-outlined">chevron_right</span>
                               </div>
                            </div>
                         </a>
                         <div class="order_summary_div mt-30">
                            <div class="order_summary_header mb-10 mt-10">
                               <h4>Order Summary</h4>
                            </div>
                            <div class="custom_hr"></div>
                            <div class="first_sec_summary  mb-10 mt-10">
                               <div class="first_div_total">
                                  <p>Basket Value</p>
                                  <p>₹<?php echo isset($orderSummery['totalSellingPrice']) ? $orderSummery['totalSellingPrice'] : 0;?></p>
                               </div>
                               <div class="first_div_total">
                                  <p>Delivery &amp; Handling Charges</p>
                                  <p><strike>₹<?php echo isset($orderSummery['shipingcharge']) ? $orderSummery['shipingcharge'] : 0;?></strike>
                                   <!-- <span class="text-brand">FREE</span>  -->
                                </p>
                               </div>
                                <?php if(isset($orderSummery['couponDisc']) && $orderSummery['couponDisc']!=0 ) { ?>
                                <div class="first_div_total">
                                  <p>Coupon discount</p>
                                  <p>₹<?php echo isset($orderSummery['couponDisc']) ? $orderSummery['couponDisc'] : 0;?></p>
                               </div>
                            <?php } ?>
                            </div>
                            <div class="custom_hr"></div>
                            
                            <div class="third_sec_summary mb-10 mt-10">
                               <div class="first_div_total">
                                  <p><b>Total Amount Payable</b></p>
                                  <p><b>₹<?php echo isset($orderSummery['totalPayAmout']) ? $orderSummery['totalPayAmout'] : 0;?></b></p>
                               </div>
                            </div>
                            <div class="fourth_sec_summary total_summary mb-10 mt-10">
                               <div class="first_div_total">
                                  <p>Total Savings</p>
                                  <p>₹<?php echo isset($orderSummery['totalSave']) ? $orderSummery['totalSave'] : 0;?></p>
                               </div>
                            </div>
                         </div>
                         <!--order_summary_div-->
                         <!-- ---------new order summary end--------- -->
                      </div>
               </div>
               <!-- ---------------vouchers modal--------------- -->
               <div class="modal fade" id="vouchers_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none; z-index: 10000000;">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <div class="errmess_cou"></div>
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Apply Voucher</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <!-- ------body start-------- -->
                           <?php 
                            if(isset($couponList) && count($couponList)>0){ ?>

                                <div class="coupon_lists">
                                  <div class="coupon_list_input d-flex justify-content-between align-items-center mb-20">
                                     <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Coupon code" value="" style="border: 1px solid red;">&nbsp;&nbsp;
                                     <button class="btn apply_coupon_disk" onclick="applyCouponCode();return false;">Apply</button>
                                </div>
                                  <div class="loaderdiv-coupon" style="color:red" id="coupon_err_msg"></div>
                                  <div class="custom_hr"></div>
                                   <?php foreach($couponList as $crecord){ ?>
                                      <div class="coupon_lists_info mt-20 mb-20">
                                         <p>10% instant discount up to to Rs.200 on a minimum order Rs.1500, Valid ONCE on Tata Neu HDFC Bank Credit Cards. Get additional 5% NeuCoins (with NeuCard Infinity) &amp; additional 2% NeuCoins (with NeuCard Plus) for orders placed on bigbasket app &amp; 10% NeuCoins (NeuCard Infinity) &amp; additional 7% NeuCoins (NeuCard Plus) for orders placed on Big Basket through Tata Neu app. Uncapped.</p>
                                         <p class="text-danger">Add Rs 1174 more of products to your basket and restart the checkout process</p>
                                         <h5 onclick="selectCoupon('<?php echo $crecord['coupon_code'] ;?>');"><?php echo $crecord['coupon_code']?></h5>
                                      </div>
                                      <div class="custom_hr"></div>
                                   <?php } ?>
                                </div>

                            <?php 
                            }

                           ?>
                        
                        </div>
                     </div>
                  </div>
               </div>
               <!-- ------------------vouchers modal end----------------------- -->
               <div class="paym-css">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
    </div>
    </div>
</main>

<?php $this->load->view('frontend/footer'); ?>
<script>
   function selectCoupon(code){
         $('#coupon_code').val(code);
   }

   function applyCouponCode(){

        let couponcode=$('#coupon_code').val();

        if(couponcode!=''){
             $.ajax({ 
                type: "POST",
                dataType:"JSON",
                url: '<?php echo base_url('apply-coupon-code')?>',
                data:({couponcode:couponcode}),
                success: function(result){
                  if(result.status==1){
                     window.location=reload();
                  //$('.total-items').text(result.total_items);
                  }else{
                     $('#coupon_err_msg').text(result.message);
                  }
               }
            });
         }else{
            $('#coupon_err_msg').text('Please enter the coupon code');
        }

   }

   function placeOrder(){
      let payemnt_type=$('input[name="payemnt_type"]:checked').val();
      let sdate=localStorage.getItem('sdate');
      let stime=localStorage.getItem('stime');
      let addressId=localStorage.getItem('address_id');
      let order_no='<?php echo isset($order_no) ? $order_no : "" ;?>';
      if(payemnt_type!=''){
         $.ajax({ 
            type: "POST",
            dataType:"JSON",
            url: '<?php echo base_url('payment/');?>'+payemnt_type,
            data:({sdate:sdate,stime:stime,address_id:addressId,order_no:order_no}),
               success: function(res){
               if(res.status==0){
                  window.location.href ='<?php echo base_url('payment/success/');?>'+res.order_no;
               }else{
                  $('#errMsg').html(`<div class="alert alert-danger">`+res.message+`</div>`);
                  setTimeout(function(){ $('#errMsg').html(``); }, 3000);
               }
              
            }

         });
        
      }else{
         $('#errMsg').html(`<div class="alert alert-danger">Please select payment type</div>`);
         setTimeout(function(){ $('#errMsg').html(``); }, 3000);
      }

   } 
</script>
