<?php 
// print_r($isdelivered);
//exit();
$this->load->view('frontend/header'); 
?>
<style type="text/css">
   .selected-address-type {
    border: 2px solid grey;
    border-radius: 5px;
    padding: 5px;
   /*.modal-dialog{
      max-width: 50% !important;
      margin:1.75rem auto !important;
   }*/
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                        <div class="section check_addres_first addred-div">
                           <div id="addr-control">
                              <!-- class="go-to-preview" -->
                              <h3 class="heading_checkout">Select your address</h3>
                              <div class="card">
                                 <div class="card-body">
                                    <div class="row">
                                       <div class="col-md-6 mb-3">
                                          <a href="javascript:void(0);" class="add-address" onclick="showAddForm();">
                                             <div class="check_new_ad">
                                                <div class="text-center">
                                                   <span class="material-symbols-outlined">location_on</span>
                                                   <p>+ Add New Address</p>
                                                </div>
                                             </div>
                                          </a>
                                       </div>

                                       <?php 
                                          if(isset($addressList) && count($addressList)>0){


                                             foreach($addressList as $record){ ?>
                                                <div class="col-md-6 mb-3">
                                                   <div id="defaAddr">
                                                      
                                                         
                                                     
                                                      <div class="check_default_ad<?php echo $record['setAddressDefault']==1 ? "" : 2; ?>">
                                                           <div class="d-flex align-items-center">
                                                               <span class="material-symbols-outlined text-white">done</span>&nbsp;&nbsp;&nbsp;
                                                               <span class="material-symbols-outlined text-white" style="cursor:pointer;" onclick="deleteAddress(<?php echo $record['addr_id']; ?>); return false;">delete</span>&nbsp;&nbsp;&nbsp;
                                                               <span class="material-symbols-outlined text-white" style="cursor:pointer;" onclick="editAddress('<?php echo $record['addr_id']; ?>'); return false;" data-bs-toggle="modal" data-bs-target="#editAddressModal">edit</span>&nbsp;&nbsp;&nbsp;
                                                            </div>
                                                            <a href="#" class="apply-addr" onclick="selecAddress(<?php echo $record['addr_id'];?>);return false;">
                                                            <p><?php echo $record['address1']?>, <?php echo $record['address2']?>,<?php echo $record['area']?>
                                                            <br>
                                                            <?php echo $record['state_id']?>, <?php echo $record['city']?> -<?php echo $record['pincode']?></p>
                                                            <?php if($record['setAddressDefault']==1){ 
                                                                echo'<h6>Default</h6>';
                                                            } ?>
                                                             </a>
                                                         </div>
                                                   </div>
                                                </div>
                                       <?php         
                                             }
                                          }

                                       ?>
                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--chek address first end-->
                        <div class="section check_addres_second add-addr-div" style="display: none;" id="add-addr-div">
                           <div class="add_new_header" style="display: block;">
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
                                       <h5 class="areaName"></h5>
                                       <p class="fullAdress"></p>
                                    </div>
                                 </div>
                                 <div class="col-md-3">
                                    <a href="javascript:void(0);" class="change-location" onclick="changeLocation();return false;">
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
                                <form action="<?php echo base_url('add-neww-address')?>" method="post" id="addressForm" enctype="" onsubmit="createNewAddress();return false;">
                                 <input type="hidden" name="addr_id" id="addr_id" value="">
                                    <div class="row">
                                     <div class="form-group col-lg-4">
                                         <label for="fname" class="form-label">First Name <span class="text-danger">*</span></label>
                                         <input type="text" name="fname" id="fname" placeholder="Enter First Name" value="" required>
                                         <span id="er_fname" class="form-text" style="color: red;"></span>
                                     </div>
                                     <div class="form-group col-lg-4">
                                         <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                         <input type="email" name="email" id="email" placeholder="Enter email id" value="" required onchange="validateEmail(this)">
                                         <span id="er_email" class="form-text" style="color: red;"></span>
                                     </div>
                                     <div class="form-group col-lg-4">
                                         <label for="mobile" class="form-label">Mobile No <span class="text-danger">*</span></label>
                                         <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="" required onchange="validateMobile(this)">
                                         <span id="er_mobile" class="form-text" style="color: red;"></span>
                                     </div>
                                 </div>
                                 <br>
                                 <h6>Address Details</h6>
                                 <br>
                                 <div class="row">
                                     <div class="form-group col-lg-6">
                                         <label for="inputPassword5" class="form-label">House No <span class="text-danger">*</span></label>
                                         <input type="text" name="address1" id="address1" placeholder="Enter House No" value="" required>
                                         <span id="er_address1" class="form-text" style="color: red;"></span>
                                     </div>
                                     <div class="form-group col-lg-6">
                                         <label for="inputPassword5" class="form-label">Apartment name <span class="text-danger">*</span> </label>
                                         <input type="text" name="address2" id="address2" placeholder="Enter Apartment name" value="" required>
                                         <span id="er_address2" class="form-text" style="color: red;"></span>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="form-group col-lg-6">
                                         <label for="inputPassword5" class="form-label">Area<span class="text-danger">*</span></label>
                                         <input type="text" name="area" id="area" placeholder="Enter Landmark for easy reach out" value="" required>
                                         <span id="er_area" class="form-text" style="color: red;"></span>
                                     </div>
                                     <div class="form-group col-lg-6">
                                         <label for="inputPassword5" class="form-label">Street Details/Landmark </label>
                                         <input type="text" name="landmark" id="landmark" placeholder="Enter Street Details/Landmark" value="">
                                     </div>
                                 </div>
                                    <div class="row shipping_calculator">
                                        <div class="form-group col-lg-4">
                                            <label for="inputPassword5" class="form-label">Select State <span class="text-danger">*</span> </label>
                                            <!-- <div class="custom_select w-100 select2-selection-state">
                                                <select class="form-control select-active class-state select2-hidden-accessible" name="state_id" id="state_id" data-select2-id="state" tabindex="-1" aria-hidden="true" required>
                                                    <?php //echo $this->customlibrary->getStateOptionInOption(); ?>
                                                </select>
                                            </div> -->
                                            <div class="custom_select w-100 select2-selection-city">
                                                <input type="text" name="state_id" id="state_id" placeholder="Enter city state" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputPassword5" class="form-label">Select City <span class="text-danger">*</span></label>
                                            <div class="custom_select w-100 select2-selection-city">
                                                <input type="text" name="city" id="city" placeholder="Enter city name" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputPassword5" class="form-label">Pincode <span class="text-danger">*</span></label>
                                            <input type="text" name="pincode" id="pincode" placeholder="Enter Pincode" oninput="validatePincode(this)" value="" maxlength="6" required onchange="validatePincode(this)">
                                            <span id="er_pincode" class="form-text" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <h6>*Address Type</h6>
                                    <br>
                                    <ul class="ad_type">
                                        <li><input type="radio" name="address_type" id="home" value="Home" class="actinput" onclick="showOtheField('home');" required><label for="home"><span class="material-symbols-outlined">home</span>&nbsp;&nbsp; Home</label></li>
                                        <li><input type="radio" name="address_type" id="office" value="Office" class="actinput" onclick="showOtheField('office');" required><label for="office"><span class="material-symbols-outlined">work</span>&nbsp;&nbsp; Office</label></li>
                                        <li><input type="radio" name="address_type" id="other" value="Other" class="actinput" onclick="showOtheField('other');" required><label for="other"><span class="material-symbols-outlined">location_on</span>&nbsp;&nbsp; Other</label></li>
                                        <li><input type="text" class="form-control" name="address_type" id="other_loc" value="" placeholder="Type Here" style="display:none;"></li>
                                    </ul>
                                    <div class="delivery_check d-flex align-items-center pt-10">
                                        <input class="form-check-input class-price-desk0" type="checkbox" value="1" name="setAddressDefault">&nbsp;&nbsp;
                                        <label class="form-check-label mb-0">
                                            <span>
                                                <p class="text-muted">Make this as my default delivery address</p>
                                            </span>
                                        </label>
                                    </div>
                                    <div id="errf"></div>
                                    <hr>
                                    <div class="row p-20 float-right">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-md w-100 add-shi-sa" data-id="">
                                                Add Address
                                            </button>
                                            <div class="loaderdiv_addrs"></div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        </div>
                        <!-- Select location--->
                        <form method="post">
                        <div class="section" id="selectLocation" style="display:none;">
                           <div class="card">
                              <!-- <div class="card-body">
                                 <input id="search-box" name="search-box" type="text" placeholder="Search for places..." value="<?php //echo isset($isdelivered) ? $isdelivered : ''; ?>">
                                 <span id="pincode-message" style="color: red;"></span>
                                 <div id="map" style="height: 500px; width: 100%;"></div>

                                 <div class="add_new_header" id="useLocationSection" style="display:none;">
                                    <div class="row">
                                       <div class="col-md-8">
                                          <div class="new_add_heading">
                                             <h5 class="areaName"></h5>
                                             <p class="fullAdress"></p>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <a href="javascript:void(0);" class="change-location" onclick="useLocation();return false;">
                                             <div class="chag_loc">
                                                <p>Use Location</p>
                                             </div>
                                          </a>
                                       </div>
                                    </div>
                                 </div>

                              </div> -->
                              <div class="card-body">
                               <input id="search-box" name="search-box" type="text" placeholder="Search for places..." value="<?php echo isset($isdelivered) ? $isdelivered : ''; ?>">
                               
                               <div id="map" style="height: 500px; width: 100%;"></div>

                               <div class="add_new_header" id="useLocationSection" style="display:none;">
                                   <div class="row">
                                       <div class="col-md-8">
                                           <div class="new_add_heading">
                                               <h5 class="areaName"></h5>
                                               <p class="fullAdress"></p>
                                           </div>
                                       </div>
                                       <div class="col-md-3">
                                           <a href="javascript:void(0);" class="change-location" onclick="useLocation();return false;">
                                               <div class="chag_loc">
                                                   <p>Use Location</p>
                                               </div>
                                           </a>
                                       </div>
                                   </div>
                               </div>

                               <div id="errorMessage" style="color: red; display: none;">
                                   We do not serve in this area currently. Please select another location.
                               </div>
                           </div>

                           </div>
                        </div>
                        </form>
                        <!-- End Select location--->
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
                              <div class="third_sec_summary mb-10 mt-10">
                                 <div class="first_div_total">
                                    <p><b>Total Amount Payable</b></p>
                                    <p><b><?php echo isset($orderSumery['totalSellingPrice']) ? $orderSumery['totalSellingPrice'] : 0;?></b></p>
                                 </div>
                              </div>
                              <div class="fourth_sec_summary total_summary mb-10 mt-10">
                                 <div class="first_div_total">
                                    <p>Total saved on basket value</p>
                                    <p>₹<?php echo isset($orderSumery['totalSave']) ? $orderSumery['totalSave'] : 0 ;?></p>
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
<!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true" >
   <?php
   //echo '<pre>';
   //print_r($addressDetails);
   //exit();
   ?>
    <div class="modal-dialog" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('update-address'); ?>" method="post" id="editAddressForm">

                  <input type="hidden" name="edit_addr_id" id="edit_addr_id">

                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="edit_fname" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="fname" id="edit_fname" placeholder="Enter First Name" value="" required>
                            <span id="er_edit_fname" class="form-text" style="color: red;"></span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="edit_email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="edit_email" placeholder="Enter email id" value="" required>
                            <span id="er_edit_email" class="form-text" style="color: red;"></span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="edit_mobile" class="form-label">Mobile No <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" id="edit_mobile" placeholder="Enter Mobile Number" value="" required>
                            <span id="er_edit_mobile" class="form-text" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="edit_address1" class="form-label">House No <span class="text-danger">*</span></label>
                            <input type="text" name="address1" id="edit_address1" placeholder="Enter House No" value="" required>
                            <span id="er_edit_address1" class="form-text" style="color: red;"></span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="edit_address2" class="form-label">Apartment name <span class="text-danger">*</span> </label>
                            <input type="text" name="address2" id="edit_address2" placeholder="Enter Apartment name" value="" required>
                            <span id="er_edit_address2" class="form-text" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="edit_area" class="form-label">Area<span class="text-danger">*</span></label>
                            <input type="text" name="area" id="edit_area" placeholder="Enter Landmark for easy reach out" value="" required>
                            <span id="er_edit_area" class="form-text" style="color: red;"></span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="edit_landmark" class="form-label">Street Details/Landmark </label>
                            <input type="text" name="landmark" id="edit_landmark" placeholder="Enter Street Details/Landmark" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="edit_state_id" class="form-label">Select State <span class="text-danger">*</span> </label>
                            <div class="custom_select w-100 select2-selection-state">
                                <input type="text" name="state" id="edit_state" placeholder="Enter state name" value="" required>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="edit_city" class="form-label">Select City <span class="text-danger">*</span></label>
                            <input type="text" name="city" id="edit_city" placeholder="Enter city name" value="" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="edit_pincode" class="form-label">Pincode <span class="text-danger">*</span></label>
                            <input type="text" name="pincode" id="edit_pincode" placeholder="Enter Pincode" maxlength="6" value="" required>
                            <span id="er_edit_pincode" class="form-text" style="color: red;"></span>
                        </div>
                    </div>
                    <h6>*Address Type</h6>
                    <ul class="ad_type">
                      <li>
                          <div class="address-type-container">
                              <input type="radio" name="address_type" id="edit_home" value="Home" class="actinput" required>
                              <label for="edit_home"><span class="material-symbols-outlined">home</span>&nbsp;&nbsp; Home</label>
                          </div>
                      </li>
                      <li>
                          <div class="address-type-container">
                              <input type="radio" name="address_type" id="edit_office" value="Office" class="actinput" required>
                              <label for="edit_office"><span class="material-symbols-outlined">work</span>&nbsp;&nbsp; Office</label>
                          </div>
                      </li>
                      <li>
                          <div class="address-type-container">
                              <input type="radio" name="address_type" id="edit_other" value="Other" class="actinput" required>
                              <label for="edit_other"><span class="material-symbols-outlined">location_on</span>&nbsp;&nbsp; Other</label>
                          </div>
                      </li>
                      <li>
                          <input type="text" class="form-control" name="address_type" id="edit_other_loc" value="" placeholder="Type Here" style="display:none;">
                      </li>
                     </ul>

                    <div class="delivery_check d-flex align-items-center pt-10">
                        <input class="form-check-input class-price-desk0" type="checkbox" value="1" name="setAddressDefault">&nbsp;&nbsp;
                        <label class="form-check-label mb-0">
                            <span>
                                <p class="text-muted">Make this as my default delivery address</p>
                            </span>
                        </label>
                    </div>
                    <hr>
                    <div class="row p-20 float-right">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-md w-100 add-shi-sa">
                                Update Address
                            </button>
                            <div class="loaderdiv_addrs"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('frontend/footer'); ?>
<script>
   function validateEmail(input) {
    const email = input.value;
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const errorSpan = document.getElementById('er_email');
    if (!regex.test(email)) {
        errorSpan.textContent = 'Please enter a valid email address.';
        input.style.borderColor = 'red';
    } else {
        errorSpan.textContent = '';
        input.style.borderColor = '';
    }
}

function validateMobile(input) {
    const mobile = input.value;
    const regex = /^\d{10}$/;
    const errorSpan = document.getElementById('er_mobile');
    if (!regex.test(mobile)) {
        errorSpan.textContent = 'Please enter a valid 10-digit mobile number.';
        input.style.borderColor = 'red';
    } else {
        errorSpan.textContent = '';
        input.style.borderColor = '';
    }
}

function validatePincode(input) {
    const pincode = input.value;
    const regex = /^\d{6}$/;
    const errorSpan = document.getElementById('er_pincode');
    if (!regex.test(pincode)) {
        errorSpan.textContent = 'Please enter a valid 6-digit pincode.';
        input.style.borderColor = 'red';
    } else {
        errorSpan.textContent = '';
        input.style.borderColor = '';
    }
}

</script>
<script>
        let map;
        let geocoder;
        let marker;

      function initAutocomplete() {
           map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 19.076090, lng: 72.877426 },
                zoom: 8
            });
            
            const input = document.getElementById('search-box');
            const searchBox = new google.maps.places.SearchBox(input);

            geocoder = new google.maps.Geocoder();

            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            searchBox.addListener('places_changed', function () {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                if (marker) {
                    marker.setMap(null);
                }

                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                    // Create a marker for each place.
                    marker = new google.maps.Marker({
                        map: map,
                        title: place.name,
                        position: place.geometry.location
                    });

                    getAddress(place.geometry.location);

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
      }

   function getAddress(latLng) {
         const geocoder = new google.maps.Geocoder();
         geocoder.geocode({ location: latLng }, function (results, status) {
             if (status === 'OK') {
                 if (results[0]) {
                     console.log(results[0]);
                    console.log(results);

                    let area=results[0].address_components[1].long_name +' '+ results[0].address_components[2].long_name;
                    let city = '';
                    let state = '';
                    let pincode = '';
                    results[0].address_components.forEach(component => {
                    if (component.types.includes('locality')) {
                        city = component.long_name;
                    }
                    if (component.types.includes('administrative_area_level_1')) {
                        state = component.long_name;
                    }
                    if (component.types.includes('postal_code')) {
                        pincode = component.long_name;
                    }
                });
                    // console.log(area);
                    // console.log(city);
                    // console.log(state);

                    $('.areaName').text(results[0].address_components[1].long_name);
                    $('.fullAdress').text(results[0].formatted_address);
                    $('#area').val(area);
                    $('#city').val(city);
                    $('#state_id').val(state);
                    $('#pincode').val(pincode);


                    $('#useLocationSection').show();

                    checkPincodeValidationForDelivery(pincode);
                    //alert('Address: ' + results[0].formatted_address);
                 } else {
                     alert('No results found');
                 }
             } else {
                 alert('Geocoder failed due to: ' + status);
             }
         });
   }

   function showAddForm(){
      $('.section').hide();
      $('#selectLocation').show();
   }   
     
   function changeLocation(){
      $('#add-addr-div').hide();
      $('#selectLocation').show();
   }

   function useLocation(){
      $('.section').hide();
      $('#add-addr-div').show();
   }

   function showOtheField(address_type){
      if(address_type=='other'){
         $('#other_loc').css('display','block');
      }else{
         $('#other_loc').css('display','none');
      }
   }

  

   function createNewAddress(){

      var formData = new FormData($('#addressForm')[0]);
      $.ajax({
         type: 'post',
         url: $('#addressForm').attr('action'),
         data: formData,
         dataType: "json",
         processData: false,
         contentType: false,
         beforeSend: function() {
         },
         success: function(res) {
                  
           if(res.error==0){
               $('#addressForm')[0].reset();
               location.reload();
               // Swal.fire('Success','success'); 

           }
           else if(res.error==1){
               $('#'+res.error_tag).text(res.err_msg);
           }
           else{
              // Swal.fire({
              //    icon: 'error',
              //    title: 'Oops...',
              //    text: 'Something went wrong!',
              //  })
           }
       },
       complete: function() {
            //$.unblockUI();
         // $('#btn1').css('display', 'block');
         // $('#btn2').css('display', 'none');
       },
       error: function(xhr, status, error) {
         console.log(error);
       },
     });
   }

   function selecAddress(address_id){
      $.ajax({
        url:'<?php echo base_url('set-default-address');?>',
        type:'POST',
        dataType:'JSON',
        data:({'address_id':address_id}),
         success:function(res){
           if(res.error==0){
             localStorage.setItem('address_id',address_id)
            location.href = "<?php echo base_url('checkout')?>"; 
           }else{

           }
          
        }
      });

   }

   //Call the initAutocomplete function when the DOM is fully loaded
   document.addEventListener('DOMContentLoaded', function() {
     
     initAutocomplete();
   });
</script>
<script>
function deleteAddress(addr_id) {
    if (confirm('Are you sure you want to delete this address?')) {
        $.ajax({
            url: '<?php echo base_url('delete-address'); ?>',
            type: 'POST',
            data: { addr_id: addr_id },
            success: function(response) {
                if(response.success) {
                    alert('Address deleted successfully');
                } else {
                    alert('Address deleted successfully');
                }
            },
            error: function() {
                alert('Error deleting address');
            }
        });
    }
}

$(document).ready(function() {
    $('input[name="address_type"]').on('change', function() {
        $('.address-type-container').removeClass('selected-address-type');
        $(this).closest('.address-type-container').addClass('selected-address-type');
        if ($('#edit_other').is(':checked')) {
            $('#edit_other_loc').show();
        } else {
            $('#edit_other_loc').hide();
        }
    });
    $('input[name="address_type"]:checked').trigger('change');
});


function editAddress(addr_id) {
   //alert('addr_id=> '+addr_id);
    $.ajax({
        url: "<?php echo base_url('get_address_details'); ?>",
        type: 'POST',
        data: { addr_id: addr_id },
        dataType: 'json',
        success: function(response) {
         console.log(response);
            if (response.status) {
                $('#edit_addr_id').val(response.data.addr_id);
                $('#edit_fname').val(response.data.fname);
                $('#edit_email').val(response.data.email);
                $('#edit_mobile').val(response.data.mobile);
                $('#edit_address1').val(response.data.address1);
                $('#edit_address2').val(response.data.address2);
                $('#edit_area').val(response.data.area);
                $('#edit_landmark').val(response.data.landmark);
                $('#edit_state').val(response.data.state);
                $('#edit_city').val(response.data.city);
                $('#edit_pincode').val(response.data.pincode);
                $('input[name="address_type"][value="' + response.data.address_type + '"]').prop('checked', true);
                $('input[name="address_type"]').trigger('change');
                $('#editAddressModal').modal('show');
                //console.log(response);
            } else {
                alert('Failed to fetch address details.');
            }
        }
    });
}
</script>
<script type="text/javascript">

   function checkPincodeValidationForDelivery(pincode) {
    $.ajax({
        url: 'cart/deliveryAddress',
        type: 'POST',
        data: {
            'search-box': pincode
        },
        success: function(response) {
            var data = JSON.parse(response);
            
            if (data.isdelivered) {
                $('#errorMessage').hide();
                $('#useLocationSection').show();
                $('.areaName').text(data.areaName);
                $('.fullAdress').text(data.fullAdress);
            } else {
                $('#useLocationSection').hide();
                $('#errorMessage').show();
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
</script>