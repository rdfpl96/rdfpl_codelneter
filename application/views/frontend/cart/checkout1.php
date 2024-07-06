<?php $this->load->view('frontend/header'); ?>
<main class="main">
   <div class="page-header mb-50 mt-30">
      
      <section>
         <div class="container mb-30">
            <div class="row">
               <div class="col-md-8">
                  <div class="form-steps_div">
                     <!-- <a href="https://uat.rdfpl.com/cart" style="float: right;margin-top: -3%;">Back</a> -->
                     <!-- Modal -->
                     <div class="modal verif-mods fade" id="cart-modal-show" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 50% !important;">
                           <div class="modal-content ">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Cart Preview</h5>
                              </div>
                              <div class="modal-body">
                                 <div class="alert alert-danger" role="alert">
                                    <h5>Product not deliver on your selected shipping address.</h5>
                                 </div>
                                 <div class="table-responsive" style="padding: 15px 2px 15px;">
                                    <table class="table">
                                       <thead>
                                          <tr>
                                             <th></th>
                                             <th>Items</th>
                                             <th>Quantity</th>
                                             <th>Sub-total</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr class="pt-30">
                                             <td class="image product-thumbnail pt-40 pl-30"><img src="https://uat.rdfpl.com/uploads/17071320681.jpg" alt="#"></td>
                                             <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">Strawberry dried</a></h6>
                                                <div class="cart_sub_price">
                                                   <h4 class="text-body">₹100 </h4>
                                                   <span class="text-muted">Weight : 200g</span>
                                                </div>
                                             </td>
                                             <td class="detail-info text-center">
                                                <h5 class="check_qty_main"><span class="check_qty_mob">Qty:</span>2</h5>
                                             </td>
                                             <td class="price text-center" data-title="Price">
                                                <h4 class="text-brand">₹200 </h4>
                                             </td>
                                          </tr>
                                          <tr class="pt-30">
                                             <td class="image product-thumbnail pt-40 pl-30"><img src="https://uat.rdfpl.com/uploads/1709111008DR. JAIN'S UTTAN POWDER 500 GM.jpg" alt="#"></td>
                                             <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">DR. JAIN'S UTTAN POWDER 500 GM</a></h6>
                                                <div class="cart_sub_price">
                                                   <h4 class="text-body">₹220 </h4>
                                                   <span class="text-muted">Weight : 500g</span>
                                                </div>
                                             </td>
                                             <td class="detail-info text-center">
                                                <h5 class="check_qty_main"><span class="check_qty_mob">Qty:</span>2</h5>
                                             </td>
                                             <td class="price text-center" data-title="Price">
                                                <h4 class="text-brand">₹440 </h4>
                                             </td>
                                          </tr>
                                          <tr class="pt-30">
                                             <td class="image product-thumbnail pt-40 pl-30"><img src="https://uat.rdfpl.com/uploads/1709111059DR. JAIN'S JASWAND KESH TEL 100 ML.jpg" alt="#"></td>
                                             <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">DR. JAIN'S JASWAND KESH TEL 100 ML</a></h6>
                                                <div class="cart_sub_price">
                                                   <h4 class="text-body">₹165 </h4>
                                                   <span class="text-muted">Weight : 100g</span>
                                                </div>
                                             </td>
                                             <td class="detail-info text-center">
                                                <h5 class="check_qty_main"><span class="check_qty_mob">Qty:</span>4</h5>
                                             </td>
                                             <td class="price text-center" data-title="Price">
                                                <h4 class="text-brand">₹660 </h4>
                                             </td>
                                          </tr>
                                          <tr class="pt-30">
                                             <td class="image product-thumbnail pt-40 pl-30"><img src="https://uat.rdfpl.com/uploads/1709111158DR. JAIN'S JASWAND GEL 500 GM.jpg" alt="#"></td>
                                             <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">DR. JAIN'S JASWAND GEL 500 GM</a></h6>
                                                <div class="cart_sub_price">
                                                   <h4 class="text-body">₹720 </h4>
                                                   <span class="text-muted">Weight : 500g</span>
                                                </div>
                                             </td>
                                             <td class="detail-info text-center">
                                                <h5 class="check_qty_main"><span class="check_qty_mob">Qty:</span>2</h5>
                                             </td>
                                             <td class="price text-center" data-title="Price">
                                                <h4 class="text-brand">₹1440 </h4>
                                             </td>
                                          </tr>
                                          <tr class="pt-30">
                                             <td class="image product-thumbnail pt-40 pl-30"><img src="https://uat.rdfpl.com/uploads/17015834431.jpg" alt="#"></td>
                                             <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">URAD SABUT</a></h6>
                                                <div class="cart_sub_price">
                                                   <h4 class="text-body">₹110 </h4>
                                                   <span class="text-muted">Weight : 500g</span>
                                                </div>
                                             </td>
                                             <td class="detail-info text-center">
                                                <h5 class="check_qty_main"><span class="check_qty_mob">Qty:</span>1</h5>
                                             </td>
                                             <td class="price text-center" data-title="Price">
                                                <h4 class="text-brand">₹110 </h4>
                                             </td>
                                          </tr>
                                          <tr class="pt-30">
                                             <td class="image product-thumbnail pt-40 pl-30"><img src="https://uat.rdfpl.com/uploads/1701583681URADMOGAR_1.jpg" alt="#"></td>
                                             <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">URAD MOGAR</a></h6>
                                                <div class="cart_sub_price">
                                                   <h4 class="text-body">₹200 </h4>
                                                   <span class="text-muted">Weight : 500g</span>
                                                </div>
                                             </td>
                                             <td class="detail-info text-center">
                                                <h5 class="check_qty_main"><span class="check_qty_mob">Qty:</span>1</h5>
                                             </td>
                                             <td class="price text-center" data-title="Price">
                                                <h4 class="text-brand">₹200 </h4>
                                             </td>
                                          </tr>
                                          <tr class="pt-30">
                                             <td class="image product-thumbnail pt-40 pl-30"><img src="https://uat.rdfpl.com/uploads/1701583806p1.jpg" alt="#"></td>
                                             <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">URAD KALI DAL</a></h6>
                                                <div class="cart_sub_price">
                                                   <h4 class="text-body">₹250 </h4>
                                                   <span class="text-muted">Weight : 500g</span>
                                                </div>
                                             </td>
                                             <td class="detail-info text-center">
                                                <h5 class="check_qty_main"><span class="check_qty_mob">Qty:</span>1</h5>
                                             </td>
                                             <td class="price text-center" data-title="Price">
                                                <h4 class="text-brand">₹250 </h4>
                                             </td>
                                          </tr>
                                          <tr class="pt-30">
                                             <td class="image product-thumbnail pt-40 pl-30"><img src="https://uat.rdfpl.com/uploads/1708760689DR. JAIN KUMKUMADI OIL 15 ML Frant.jpg" alt="#"></td>
                                             <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">DR. JAIN KUMKUMADI OIL 15 ML</a></h6>
                                                <div class="cart_sub_price">
                                                   <h4 class="text-body">₹2400 </h4>
                                                   <span class="text-muted">Weight : 15g</span>
                                                </div>
                                             </td>
                                             <td class="detail-info text-center">
                                                <h5 class="check_qty_main"><span class="check_qty_mob">Qty:</span>1</h5>
                                             </td>
                                             <td class="price text-center" data-title="Price">
                                                <h4 class="text-brand">₹2400 </h4>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-stepxxx">
                        <div class="check_addres_first addred-div" style="display: none;">
                           <div id="addr-control">
                              <!-- class="go-to-preview" -->
                              <!-- <h3>Select Your Address</h3> -->
                              <div class="card">
                                 <div class="card-body">
                                    <div class="row">
                                       <div class="col-md-12 mt-30">
                                          <a href="javascript:void(0);" class="add-address">
                                             <div class="check_new_ad">
                                                <span>
                                                   <svg class="svg-inline--fa fa-map-marker-alt fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                                      <path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
                                                   </svg>
                                                   <!-- <i class="fas fa-map-marker-alt"></i> Font Awesome fontawesome.com -->
                                                </span>
                                                <br>
                                                <p>+ Add New Address</p>
                                             </div>
                                          </a>
                                       </div>
                                       <div class="col-md-6 defsdd">
                                          <div id="defaAddr">
                                             <a href="javascript:void(0);" class="apply-addr" data-id="140">
                                                <div class="check_default_ad mt-30">
                                                   <h4>Home</h4>
                                                   <p>room 4,                                 kishan nagar,                                 thame ,                                kis,<br>
                                                      Maharashtra, Gangakher,                                 400408<br>
                                                      Ph: 9004649745
                                                   </p>
                                                   <h6>DEFAULT</h6>
                                                </div>
                                             </a>
                                          </div>
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
                        <div class="check_addres_second add-addr-div" style="display: block;">
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
                                       <h5>Pymod Jaiswa</h5>
                                       <p>Home - room 4, kishan nagar, thame, kis, Gangakher, Maharashtra, 400408</p>
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
                                          <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-state-container"><span class="select2-selection__rendered" id="select2-state-container" role="textbox" aria-readonly="true" title="Select">Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                       </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                       <label for="inputPassword5" class="form-label">Select City </label>
                                       <div class="custom_select w-100 select2-selection-city">
                                          <input type="hidden" name="cityid" id="cityid" value="">
                                          <select class="form-control select-active select2-hidden-accessible" name="city" id="city" data-select2-id="city" tabindex="-1" aria-hidden="true">
                                             <option value="" data-select2-id="4">Select</option>
                                          </select>
                                          <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="3" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-city-container"><span class="select2-selection__rendered" id="select2-city-container" role="textbox" aria-readonly="true" title="Select">Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
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
                           <div class="errmess_cou"></div>
                           <table class="table no-border">
                              <tbody>
                                 <tr>
                                    <td colspan="2">
                                       <h4>Apply Coupon </h4>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="">
                                       <input type="text" class="form-control" name="coupon_codes_disk" id="coupon_codes_disk" placeholder="Coupon code" value="">
                                    </td>
                                    <td class="cart_total_amount">
                                       <button class="btn  w-100 apply_coupon_disk">Apply</button>
                                       <div class="loaderdiv-coupon" style="position: absolute;"></div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="2">
                                       <h4>Order Summary</h4>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="cart_total_label">
                                       <h6 class="text-muted">Sub-Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                       <h4 class="text-brand text-end">₹5700</h4>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td scope="col" colspan="2">
                                       <div class="divider-2 mt-10 mb-10"></div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="cart_total_label">
                                       <h6 class="text-muted">Shipping</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                       <h5 class="text-heading text-end">Free</h5>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td scope="col" colspan="2">
                                       <div class="divider-2 mt-10 mb-10"></div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="cart_total_label">
                                       <h6 class="text-muted">Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                       <h4 class="text-brand text-end">₹5700.00</h4>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="paym-css">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</main>

 <div class="col-md-4">
                  <div class="border p-md-4 cart-totals ml-30">
                     <div class="table-responsive page-manage">
                        <div id="updPage">
                           <!-- ---------new order summary--------- -->
                           <a href="" data-bs-toggle="modal" data-bs-target="#vouchers_modal">
                              <div class="apply_vouchers">
                                 <div class="left_side_voucher">
                                    <img src="http://localhost/RDFPL_Lattest_BKP_12_April_2024/include/frontend/assets/imgs/theme/offer_perecnt.svg">
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
                                    <p>₹200</p>
                                 </div>
                                 <div class="first_div_total">
                                    <p>Delivery &amp; Handling Charges</p>
                                    <p><strike>₹30</strike> <span class="text-brand">FREE</span></p>
                                 </div>
                              </div>
                              <div class="custom_hr"></div>
                              <div class="first_sec_summary  mb-10 mt-10">
                                 <div class="first_div_total">
                                    <p>Coupon Value</p>
                                    <p><span class="order_icon">(-)</span> <span class="rupees_font">₹</span><span class="couponAmt">5.00</span></p>
                                 </div>
                              </div>
                              <div class="custom_hr"></div>
                              <div class="second_sec_summary mb-10 mt-10">
                                 <div class="first_div_total">
                                    <div class="wallet_summary">
                                       <p class=" d-flex align-items-center pb-0"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">&nbsp;&nbsp; Use Wallet</p>
                                       <p class="pl-25 text-muted-low">Balance: ₹5</p>
                                    </div>
                                    <p>- ₹5</p>
                                 </div>
                              </div>
                              <div class="custom_hr"></div>
                              <div class="third_sec_summary mb-10 mt-10">
                                 <div class="first_div_total">
                                    <p><b>Total Amount Payable</b></p>
                                    <p><b>₹200</b></p>
                                 </div>
                              </div>
                              <div class="fourth_sec_summary total_summary mb-10 mt-10">
                                 <div class="first_div_total">
                                    <p>Total Savings</p>
                                    <p>₹8509.00</p>
                                 </div>
                              </div>
                           </div>
                           <!--order_summary_div-->
                           <!-- ---------new order summary end--------- -->
                        </div>
                     </div>
                     <!-- ---------------vouchers modal--------------- -->
                     <div class="modal fade" id="vouchers_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <div class="errmess_cou"></div>
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Apply Voucher</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <!-- ------body start-------- -->
                                 <div class="coupon_lists">
                                    <div class="coupon_list_input d-flex justify-content-between align-items-center mb-20">
                                       <input type="text" class="form-control" name="coupon_codes_disk" id="coupon_codes_disk" placeholder="Coupon code" value="7Y83WR" readonly="">&nbsp;&nbsp;
                                       <button class="btn ">Applied</button>
                                       <div class="loaderdiv-coupon" style="position: absolute;"></div>
                                    </div>
                                    <div class="custom_hr"></div>
                                    <div class="coupon_lists_info mt-20 mb-20">
                                       <p>10% instant discount up to to Rs.200 on a minimum order Rs.1500, Valid ONCE on Tata Neu HDFC Bank Credit Cards. Get additional 5% NeuCoins (with NeuCard Infinity) &amp; additional 2% NeuCoins (with NeuCard Plus) for orders placed on bigbasket app &amp; 10% NeuCoins (NeuCard Infinity) &amp; additional 7% NeuCoins (NeuCard Plus) for orders placed on Big Basket through Tata Neu app. Uncapped.</p>
                                       <p class="text-danger">Add Rs 1174 more of products to your basket and restart the checkout process</p>
                                       <h5>NEUCARDMAY24</h5>
                                    </div>
                                    <div class="custom_hr"></div>
                                    <div class="coupon_lists_info mt-20 mb-20">
                                       <p>10% instant discount up to to Rs.200 on a minimum order Rs.1500, Valid ONCE on Tata Neu HDFC Bank Credit Cards. Get additional 5% NeuCoins (with NeuCard Infinity) &amp; additional 2% NeuCoins (with NeuCard Plus) for orders placed on bigbasket app &amp; 10% NeuCoins (NeuCard Infinity) &amp; additional 7% NeuCoins (NeuCard Plus) for orders placed on Big Basket through Tata Neu app. Uncapped.</p>
                                       <p class="text-danger">Add Rs 1174 more of products to your basket and restart the checkout process</p>
                                       <h5>NEUCARDMAY24</h5>
                                    </div>
                                    <div class="custom_hr"></div>
                                 </div>
                                 <!-- ---------body end-------- -->
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- ------------------vouchers modal end----------------------- -->
                     <div class="paym-css">
                        <a href="http://localhost/RDFPL_Lattest_BKP_12_April_2024/order-payment" class="btn mb-20 w-100 ">Payment</a>
                     </div>
                  </div>
               </div>
<?php $this->load->view('frontend/footer'); ?>