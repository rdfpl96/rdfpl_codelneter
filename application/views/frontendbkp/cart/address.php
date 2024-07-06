<?php $this->load->view('frontend/header'); ?>
<main class="main">
   <div class="page-header mb-50">
      <div class="">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                           <div class="step active">
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
                           <div class="step" id="step2">
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
      </div>
      <section>
         <div class="container mb-30">
            <div class="row">
               <div class="col-md-8">
                  <div class="form-steps_div">
                     <!-- <a href="http://localhost/RDFPL_Lattest_BKP_12_April_2024/cart" style="float: right;margin-top: -3%;">Back</a> -->
                     <div class="form-stepxxx">
                        <div class="check_addres_first addred-div">
                           <div id="addr-control">
                              <!-- class="go-to-preview" -->
                              <h3 class="heading_checkout">Select your address</h3>
                              <div class="card">
                                 <div class="card-body">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <a href="javascript:void(0);" class="add-address">
                                             <div class="check_new_ad">
                                                <div class="text-center">
                                                   <span class="material-symbols-outlined">location_on</span>
                                                   <p>+ Add New Address</p>
                                                </div>
                                             </div>
                                          </a>
                                       </div>
                                       <div class="col-md-6 defsdd">
                                          <div id="defaAddr">
                                             <a href="javascript:void(0);" class="apply-addr" data-id="132">
                                                <div class="check_default_ad ">
                                                   <h4>Office</h4>
                                                   <p>65,                                 test,                                 dsds ,                                Lodha Supremus 2, Wagle Estate Road No. 22 Thane (W),<br>
                                                      Maharashtra, Thane,                                 400604<br>
                                                      Ph: 9898989898
                                                   </p>
                                                   <h6>DEFAULT</h6>
                                                </div>
                                             </a>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <a href="javascript:void(0);" class="apply-addr" data-id="132">
                                             <div class="check_default_ad2 mt-30">
                                                <h4>Office</h4>
                                                <p>65,                                 test,                                 dsds ,                                Lodha Supremus 2, Wagle Estate Road No. 22 Thane (W),<br>
                                                   Maharashtra, Thane,                                 400604<br>
                                                   Ph: 9898989898
                                                </p>
                                                <div class="bot_footer check_footer2">
                                                   <input type="radio" class="btn-check shipdress" value="132" name="options" id="radioDefault132" autocomplete="off">
                                                   <label class="btn btn-secondary fw-bold" for="radioDefault132">Deliver Here</label>
                                                </div>
                                                <div class="loaderdiv_addrs132" style="display: none;">
                                                   <span class="lds-ring-small">
                                                      <div></div>
                                                      <div></div>
                                                      <div></div>
                                                      <div></div>
                                                   </span>
                                                </div>
                                             </div>
                                          </a>
                                       </div>
                                    </div>
                                    <!--  <div class="pagination-area mt-20 mb-20">
                                       <nav aria-label="Page navigation example">
                                                         </nav>
                                       </div> -->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--chek address first end-->
                        <div class="check_addres_second add-addr-div" style="display: none;">
                           <!-- <h3 class="mb-10">Add new address</h3> -->
                           <!-- <div class="card mt-30"> -->
                           <!-- <div class="card-body"> -->
                           <!-- <div class="add_new_header"> -->
                           <div class="add_new_header">
                              <div class="row">
                                 <div class="col-md-1 text-white">
                                    <h4 class="text-white">
                                       <span>
                                          <svg class="svg-inline--fa fa-map-marker-alt fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                             <path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
                                          </svg>
                                          <!-- <i class="fas fa-map-marker-alt"></i> Font Awesome fontawesome.com -->
                                       </span>
                                    </h4>
                                 </div>
                                 <div class="col-md-8">
                                    <div class="new_add_heading">
                                       <h5>Lakhu Ghodvinde</h5>
                                       <p>Home - Tt, Ggg, Fgg, Fgg, Bombuflat, Andaman and Nicobar Islands, 421103</p>
                                    </div>
                                 </div>
                                 <div class="col-md-3">
                                    <a href="javascript:void(0);" class="change-location">
                                       <div class="chag_loc">
                                          <p>Change Location</p>
                                       </div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-body">
                                 <br>
                                 <h6>Personal Details</h6>
                                 <br>
                                 <div class="row">
                                    <div class="form-group col-lg-4">
                                       <label for="inputPassword5" class="form-label">First Name <span class="text-danger">*</span></label>
                                       <input type="text" name="fname" id="fname" placeholder="Enter First Name" value="">
                                    </div>
                                    <div class="form-group col-lg-4">
                                       <label for="inputPassword5" class="form-label">Last Name <span class="text-danger">*</span></label>
                                       <input type="text" name="lname" id="lname" placeholder="Enter Last Name" value="">
                                    </div>
                                    <div class="form-group col-lg-4">
                                       <label for="inputPassword5" class="form-label">Mobile No <span class="text-danger">*</span></label>
                                       <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="">
                                    </div>
                                 </div>
                                 <br>
                                 <h6>Address Details</h6>
                                 <br>
                                 <div class="row">
                                    <div class="form-group col-lg-6">
                                       <label for="inputPassword5" class="form-label">House No <span class="text-danger">*</span></label>
                                       <input type="text" name="apart_house" id="apart_house" placeholder="Enter House No" value="">
                                    </div>
                                    <div class="form-group col-lg-6">
                                       <label for="inputPassword5" class="form-label">Apartment name </label>
                                       <input type="text" name="apart_name" id="apart_name" placeholder="Enter Apartment name" value="">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="form-group col-lg-6">
                                       <label for="inputPassword5" class="form-label">Landmark for easy reach out </label>
                                       <input type="text" name="area" id="area" placeholder="Enter Landmark for easy reach out" value="">
                                    </div>
                                    <div class="form-group col-lg-6">
                                       <label for="inputPassword5" class="form-label">Street Details/Landmark </label>
                                       <input type="text" name="street_landmark" id="street_landmark" placeholder="Enter Street Details/Landmark" value="">
                                    </div>
                                 </div>
                                 <div class="row shipping_calculator">
                                    <div class="form-group col-lg-4">
                                       <label for="inputPassword5" class="form-label">Select State </label>
                                       <div class="custom_select w-100 select2-selection-state">
                                          <select class="form-control select-active class-state select2-hidden-accessible" name="state" id="state" data-select2-id="state" tabindex="-1" aria-hidden="true">
                                             <option value="" data-select2-id="2">Select</option>
                                             <option value="1">Andaman and Nicobar Islands</option>
                                             <option value="2">Andhra Pradesh</option>
                                             <option value="3">Arunachal Pradesh</option>
                                             <option value="4">Assam</option>
                                             <option value="5">Bihar</option>
                                             <option value="6">Chandigarh</option>
                                             <option value="7">Chhattisgarh</option>
                                             <option value="8">Dadra and Nagar Haveli</option>
                                             <option value="9">Daman and Diu</option>
                                             <option value="10">Delhi</option>
                                             <option value="11">Goa</option>
                                             <option value="12">Gujarat</option>
                                             <option value="13">Haryana</option>
                                             <option value="14">Himachal Pradesh</option>
                                             <option value="15">Jammu and Kashmir</option>
                                             <option value="16">Jharkhand</option>
                                             <option value="17">Karnataka</option>
                                             <option value="18">Kenmore</option>
                                             <option value="19">Kerala</option>
                                             <option value="20">Lakshadweep</option>
                                             <option value="21">Madhya Pradesh</option>
                                             <option value="22">Maharashtra</option>
                                             <option value="23">Manipur</option>
                                             <option value="24">Meghalaya</option>
                                             <option value="25">Mizoram</option>
                                             <option value="26">Nagaland</option>
                                             <option value="27">Narora</option>
                                             <option value="28">Natwar</option>
                                             <option value="29">Odisha</option>
                                             <option value="30">Paschim Medinipur</option>
                                             <option value="31">Pondicherry</option>
                                             <option value="32">Punjab</option>
                                             <option value="33">Rajasthan</option>
                                             <option value="34">Sikkim</option>
                                             <option value="35">Tamil Nadu</option>
                                             <option value="36">Telangana</option>
                                             <option value="37">Tripura</option>
                                             <option value="38">Uttar Pradesh</option>
                                             <option value="39">Uttarakhand</option>
                                             <option value="40">Vaishali</option>
                                             <option value="41">West Bengal</option>
                                          </select>
                                          <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-state-container"><span class="select2-selection_rendered" id="select2-state-container" role="textbox" aria-readonly="true" title="Select">Select</span><span class="select2-selection_arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                       </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                       <label for="inputPassword5" class="form-label">Select City </label>
                                       <div class="custom_select w-100 select2-selection-city">
                                          <input type="hidden" name="cityid" id="cityid" value="">
                                          <select class="form-control select-active select2-hidden-accessible" name="city" id="city" data-select2-id="city" tabindex="-1" aria-hidden="true">
                                             <option value="" data-select2-id="4">Select</option>
                                          </select>
                                          <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="3" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-city-container"><span class="select2-selection_rendered" id="select2-city-container" role="textbox" aria-readonly="true" title="Select">Select</span><span class="select2-selection_arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                       </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                       <label for="inputPassword5" class="form-label">Pincode <span class="text-danger">*</span></label>
                                       <input type="text" name="pincode" id="pincode" placeholder="Enter Pincode" oninput="validatePincode(this)" value="">
                                    </div>
                                 </div>
                                 <br>
                                 <h6>*Address Type</h6>
                                 <br>
                                 <ul class="ad_type">
                                    <li><input type="radio" name="type" id="home" value="Home" class="actinput"><label for="home"><span class="material-symbols-outlined">home</span>&nbsp;&nbsp; Home</label></li>
                                    <li><input type="radio" name="type" id="office" value="Office" class="actinput"><label for="office"><span class="material-symbols-outlined">work</span>&nbsp;&nbsp; Office</label></li>
                                    <li><input type="radio" name="type" id="other" value="Other" class="actinput"><label for="other"><span class="material-symbols-outlined">location_on</span>&nbsp;&nbsp; Other</label></li>
                                    <li><input type="text" class="form-control" name="other_loc" id="other_loc" value="" placeholder="Type Here" style="display:none;"></li>
                                 </ul>
                                 <div class="delivery_check d-flex align-items-center pt-10">
                                    <input class="form-check-input class-price-desk0" type="checkbox">&nbsp;&nbsp;
                                    <label class="form-check-label mb-0">
                                       <span>
                                          <p class="text-muted">Make this as my default delivery address</p>
                                       </span>
                                    </label>
                                 </div>
                                 <div id="errf"></div>
                              </div>
                              <hr>
                              <div class="row p-20 float-right">
                                 <div class="col-md-4"></div>
                                 <div class="col-md-4">
                                    <!-- <a href="" class="btn btn_dark w-100">Cancel</a> -->
                                 </div>
                                 <div class="col-md-4">
                                    <a href="javascript:void(0);" class="btn btn-md w-100 add-shi-sa shipping-address-save" data-id="">
                                    Add Address
                                    </a>
                                    <div class="loaderdiv_addrs"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--chek address second end-->    
                     </div>
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="border p-md-4 cart-totals ml-30">
                     <div class="table-responsive page-manage">
                        <div id="updPage">
                           
                           <div class="order_summary_div mt-30">
                              <div class="order_summary_header mb-10 mt-10">
                                 <h4>Order Summary</h4>
                              </div>
                              <div class="custom_hr"></div>
                             
                            
                              
                              <div class="custom_hr"></div>
                              <div class="third_sec_summary mb-10 mt-10">
                                 <div class="first_div_total">
                                    <p><b>Total Amount Payable</b></p>
                                    <p><b>₹200</b></p>
                                 </div>
                              </div>
                              <div class="fourth_sec_summary total_summary mb-10 mt-10">
                                 <div class="first_div_total">
                                    <p>Total saved on basket value</p>
                                    <p>₹8509.00</p>
                                 </div>
                              </div>
                           </div>
                           <!--order_summary_div-->
                           <!-- ---------new order summary end--------- -->
                        </div>
                     </div>
                   
                     
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</main>
<?php $this->load->view('frontend/footer'); ?>