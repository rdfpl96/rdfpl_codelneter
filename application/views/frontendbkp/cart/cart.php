<?php $this->load->view('frontend/header'); ?>
<main class="main">
   <!-- Modal -->
   <div class="modal verif-mods fade" id="cart-modal-show" role="dialog" tabindex="-1">
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
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container mb-80 mt-30">
      <div class="row">
         <div class="col-lg-9 mb-10">
            <h3 class="heading-2 mb-10">Your Basket</h3>
         </div>
      </div>
      <div class="cart_head">
         <div class="row">
            <div class="col-lg-10">
               <div class="cart_head_left">
                  <div class="heading_s1"> Subtotal (<span class="total-items">2</span> items) <span> ₹ <span class="final-amount" id="tot_amount">440.00</span></span></div>
                  <div class="subheading">Savings: <b>₹ 3.78</b></div>
               </div>
            </div>
            <div class="col-lg-2 d-flex justify-content-center align-items-center">
               <a href="javascript:void(0);" class="btn head_checkout_btn" data-bs-toggle="modal" data-bs-target="#login-modal-user">CheckOut</a>
               <!-- <div class="btn head_checkout_btn">Checkout</div> -->
            </div>
         </div>
      </div>
      <div class="row mt-30">
         <div class="col-lg-12">
            <!-- <div class="table-responsive table_cart shopping-summery trsd">
               <table class="table table-wishlist table-border" id="coar">
                   <thead>
                       <tr class="main-heading">
                           <th class="start pl-30 text-left" scope="col" colspan="1">Items (<span class="total-items">2</span> Item)</th>
                           <th>Product Name</th>
                           <th scope="col">Quantity</th>
                           <th scope="col">Sub-total</th>
                           <th>Remove</th>
                       </tr>
                   </thead>
                   <tbody>
               
                   
               
               
                       <tr class="pt-30" id="listcart475">
                           <td class="image product-thumbnail pt-40 pl-30"><img src="https://uat.rdfpl.com/uploads/1709111008DR. JAIN'S UTTAN POWDER 500 GM.jpg"></td>
                           <td class="product-des product-name">
                               <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">DR. JAIN'S UTTAN POWDER 500 GM</a></h6>
                               <div class="cart_sub_price">                                            
                                    <h4 class="text-body">₹220.00 </h4>
                                    <span class="text-muted">Weight : 500g</span>
                               </div>
               
                           
                                                                </td>
                          
                           <td class="detail-info">
                               <div class="detail-extralink mr-15">
                                  <div class="quantity-controls w-100 hover-up width100 common-button">
                                           <button class="quantity-decrease qtymode-cart" data-id="minus_475-708"><span class="material-symbols-outlined">remove</span></button>
                                           <input type="text" class="quantity-input" id="qty475-708" value="2" style="width:70px !important" readonly>
                                           <button style="width:70px !important" class="quantity-increase qtymode-cart" data-id="plus_475-708"><span class="material-symbols-outlined" >add</span></button>
                                       </div>
               
                                       <div class="loaderdiv-cart475-708" style="float: right; position: absolute;"></div>
                               </div>
                                <div class="text-center pt-10"> 
                                   <p class="text-grey text-center"><a href="javascript:void(0);" class="remove-item" data-id="" data-value="">Delete</a> |  -->
            <!-- <p class="text-grey text-center"><a href="" class="wish-div" data-id="">Save for later</a></p> 
               </div>  
               </td>
               <td class="price text-center" data-title="Price">
               <h4 class="text-brand text-center">₹<span id="subAmount4952f0bd1728417315fa4634c90a4d71">440.00</span> </h4>
               </td>
               <td>
                <div class="shopping-cart-delete text-center">
                   <a href="javascript:void(0);" class="remove-item text-center" data-id="4952f0bd1728417315fa4634c90a4d71" data-value="475"><span class="material-symbols-outlined"> delete </span></a>
                 </div>
                 <div class="loaderdiv-hcar475" style="position:absolute;"></div>
               </td>
               </tr>
               
                                      
               </tbody>
               </table>
               </div> -->
            <!-- ===============new_cart_design=========    -->
            <div class="main_basket_sec">
               <div class="main_basket_header">
                  <div class="row">
                     <div class="col-md-7">
                        <h3>Items  (4 items)</h3>
                     </div>
                     <div class="col-md-3 text-center">
                        <h3>Quantity</h3>
                     </div>
                     <div class="col-md-2 text-right">
                        <h3>Sub-total</h3>
                     </div>
                  </div>
               </div>
               <!--main_basket_header-->
               <div class="main_basket_category">
                  <h3>Fruits &amp; Vegetables</h3>
               </div>
               <div class="main_basket_product_sec">
                  <a href="" data-bs-toggle="modal" data-bs-target="#offer_modal">
                     <div class="main_basket_product_sec_offer_header">
                        <h3>Get it for ₹85.50! &nbsp;<span class="material-symbols-outlined fw-bold">expand_more</span></h3>
                     </div>
                  </a>
                  <div class="main_basket_product_inner_sec">
                     <div class="row">
                        <div class="col-md-7">
                           <div class="basket_offer_product_img_name">
                              <img src="https://uat.rdfpl.com/uploads/1701585195MASOORSABUT%20_1.jpg">
                              <div class="basket_offer_product_name">
                                 <p class="text-muted">Masoor Sabut</p>
                                 <h4>₹95.50 <span><strike> ₹127.4</strike></span></h4>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3 text-center d-flex align-items-end">
                           <div class="main_basket_product_quantity_btn">
                              <div class="detail-extralink">
                                 <div class="quantity-controls w-100 hover-up width100 common-button">
                                    <button class="quantity-decrease"><span class="material-symbols-outlined">remove</span></button>
                                    <input type="text" class="quantity-input" value="1">
                                    <button class="quantity-increase"><span class="material-symbols-outlined">add</span></button>
                                 </div>
                                 <div class="basket_offer_product_delete mt-20">
                                    <p><a href="">Delete</a> | <a href="">Save for later</a></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2 text-right d-flex justify-content-end align-items-end">
                           <div class="main_basket_product_price">
                              <h3>₹95.50</h3>
                              <p class="text-success">Saved: ₹74.8</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="main_basket_category">
                  <h3>Fruits &amp; Vegetables</h3>
               </div>
               <div class="main_basket_product_sec">
                  <a href="" data-bs-toggle="modal" data-bs-target="#offer_modal">
                     <div class="main_basket_product_sec_offer_header">
                        <h3>Get it for ₹85.50! &nbsp;<span class="material-symbols-outlined fw-bold">expand_more</span></h3>
                     </div>
                  </a>
                  <div class="main_basket_product_inner_sec">
                     <div class="row">
                        <div class="col-md-7">
                           <div class="basket_offer_product_img_name">
                              <img src="https://uat.rdfpl.com/uploads/1701585195MASOORSABUT%20_1.jpg">
                              <div class="basket_offer_product_name">
                                 <p class="text-muted">Masoor Sabut</p>
                                 <h4>₹95.50 <span><strike> ₹127.4</strike></span></h4>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3 text-center d-flex align-items-end">
                           <div class="main_basket_product_quantity_btn">
                              <div class="detail-extralink">
                                 <div class="quantity-controls w-100 hover-up width100 common-button">
                                    <button class="quantity-decrease"><span class="material-symbols-outlined">remove</span></button>
                                    <input type="text" class="quantity-input" value="1">
                                    <button class="quantity-increase"><span class="material-symbols-outlined">add</span></button>
                                 </div>
                                 <div class="basket_offer_product_delete mt-20">
                                    <p><a href="">Delete</a> | <a href="">Save for later</a></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2 text-right d-flex justify-content-end align-items-end">
                           <div class="main_basket_product_price">
                              <h3>₹95.50</h3>
                              <p class="text-success">Saved: ₹74.8</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- ===================news cart design end=========== -->
            <!-- <div class="cart-action d-flex justify-content-between">
               <a href="https://uat.rdfpl.com/shop" class="btn "><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
               </div>   -->  
         </div>
         <div class="row mt-60 cart_products">
            <div class="col-12">
               <h3 class="mb-30 pt-30">Save For Later</h3>
            </div>
            <div class="co-12">
               <div class="row related-products">
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 13">
                     <div class="product-cart-wrap mb-30">
                        <div class="grid_product_group" id="grid_product_group13">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="https://uat.rdfpl.com/product-details/masoor-sabut/?snp=MTM=">
                                    <img class="default-img" src="https://uat.rdfpl.com/uploads/1701585195MASOORSABUT _1.jpg" alt="">
                                    <!-- <img class="hover-img" src="" alt="" /> -->
                                 </a>
                              </div>
                              <div class="product-action-1"></div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot hotd13" style="display: none">0% OFF</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="javascript:void(0);">Pulses &amp; Beans</a>
                              </div>
                              <h2><a href="https://uat.rdfpl.com/product-details/masoor-sabut/?snp=MTM=">MASOOR SABUT</a></h2>
                              <div class="grid_product_rating">
                                 <p>4.2 <i class="material-symbols-outlined">star</i></p>
                                 <span>&nbsp;    209 Rating</span>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="brand_size">
                                    <!-- ===========custom select start======== -->
                                    <div class="custom-dropdown">
                                       <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false">
                                       Select
                                       </button>
                                       <ul class="dropdown-menu cust_select_lists" id="dropdownMenu">
                                          <li>
                                             <a data-value="1kg">
                                                <div class="kg_name">1KG</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                          <li>
                                             <a data-value="500g">
                                                <div class="kg_name">500g</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                    <!-- ===========custom select end======== -->
                                    <select class="form-select size" id="get-size13" data-id="13" data-value="">
                                       <option value="25">500 g</option>
                                       <option value="26">1 Kg</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="product-price">
                                    <span>₹<span class="price13">200.00</span></span>
                                    <input type="hidden" id="price-value13" value="200.00">&nbsp;&nbsp;
                                    <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice13">0.00</span></span></strike>
                                 </div>
                                 <div class="product-before-off-price">
                                 </div>
                                 <span class="loaderdiv-header13"></span>
                              </div>
                              <div class="grid_offer_ad">
                                 <div class="ad_btn" onclick="ad_btn(13)">
                                    <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                                 <div class="ad_show_sec">
                                    <div class="product-category">
                                       <a href="javascript:void(0);">Pulses &amp; Beans</a>
                                    </div>
                                    <h2><a href="https://uat.rdfpl.com/product-details/masoor-sabut/?snp=MTM=">MASOOR SABUT</a></h2>
                                    <div class="product-card-bottom mt-15 mb-15">
                                       <div class="product-price">
                                          <span>₹<span class="price13">200.00</span></span>
                                          <input type="hidden" id="price-value13" value="200.00">&nbsp;&nbsp;
                                          <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice13">0.00</span></span></strike>
                                       </div>
                                       <div class="product-before-off-price"></div>
                                       <span class="loaderdiv-header13"></span>
                                    </div>
                                    <div class="ad_closed text-right" onclick="ad_closed(13)">
                                       <span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ad_banner">
                                       <div class="ad_percent_strip"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                       <div class="ad_headline">
                                          <p>Har Din Sasta!</p>
                                       </div>
                                       <div class="ad_offer_percent">
                                          <h2>36% Off!</h2>
                                       </div>
                                       <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn_group">
                           <div class="save_for_later_btn">
                              <!-- <div id="wisf"> -->
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="MTM=">
                              <span class="material-symbols-outlined idss13 hovercdd">bookmark</span>                        </a>
                              <!-- </div> -->
                           </div>
                           <div class="updd13" style="text-align:center;">
                              <button class="btn w-100 width-set  uptos13 hover-up add-to-cart-button product-add css-btn13" data-id="13" data-value="">Add</button>
                              <div class="quantity-controls w-100 hover-up width100 common-button css-inc13">
                                 <button class="quantity-decrease qtymode" data-id="minus_13" data-value=""><span class="material-symbols-outlined">remove</span></button>
                                 <input type="text" class="quantity-input" id="qty13" value="1" readonly="">
                                 <button class="quantity-increase qtymode" data-id="plus_13" data-value=""><span class="material-symbols-outlined">add</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 14">
                     <div class="product-cart-wrap mb-30">
                        <div class="grid_product_group" id="grid_product_group14">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="https://uat.rdfpl.com/product-details/malka-masoor/?snp=MTQ=">
                                    <img class="default-img" src="https://uat.rdfpl.com/uploads/1701585309MALKAMASOOR_1.jpg" alt="">
                                    <!-- <img class="hover-img" src="" alt="" /> -->
                                 </a>
                              </div>
                              <div class="product-action-1"></div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot hotd14" style="display: none">0% OFF</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="javascript:void(0);">Pulses &amp; Beans</a>
                              </div>
                              <h2><a href="https://uat.rdfpl.com/product-details/malka-masoor/?snp=MTQ=">MALKA MASOOR</a></h2>
                              <div class="grid_product_rating">
                                 <p>4.2 <i class="material-symbols-outlined">star</i></p>
                                 <span>&nbsp;    209 Rating</span>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="brand_size">
                                    <!-- ===========custom select start======== -->
                                    <div class="custom-dropdown">
                                       <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false">
                                       Select
                                       </button>
                                       <ul class="dropdown-menu cust_select_lists" id="dropdownMenu">
                                          <li>
                                             <a data-value="1kg">
                                                <div class="kg_name">1KG</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                          <li>
                                             <a data-value="500g">
                                                <div class="kg_name">500g</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                    <!-- ===========custom select end======== -->
                                    <select class="form-select size" id="get-size14" data-id="14" data-value="">
                                       <option value="27">500 g</option>
                                       <option value="28">1 Kg</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="product-price">
                                    <span>₹<span class="price14">200.00</span></span>
                                    <input type="hidden" id="price-value14" value="200.00">&nbsp;&nbsp;
                                    <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice14">0.00</span></span></strike>
                                 </div>
                                 <div class="product-before-off-price">
                                 </div>
                                 <span class="loaderdiv-header14"></span>
                              </div>
                              <div class="grid_offer_ad">
                                 <div class="ad_btn" onclick="ad_btn(14)">
                                    <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                                 <div class="ad_show_sec">
                                    <div class="product-category">
                                       <a href="javascript:void(0);">Pulses &amp; Beans</a>
                                    </div>
                                    <h2><a href="https://uat.rdfpl.com/product-details/malka-masoor/?snp=MTQ=">MALKA MASOOR</a></h2>
                                    <div class="product-card-bottom mt-15 mb-15">
                                       <div class="product-price">
                                          <span>₹<span class="price14">200.00</span></span>
                                          <input type="hidden" id="price-value14" value="200.00">&nbsp;&nbsp;
                                          <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice14">0.00</span></span></strike>
                                       </div>
                                       <div class="product-before-off-price"></div>
                                       <span class="loaderdiv-header14"></span>
                                    </div>
                                    <div class="ad_closed text-right" onclick="ad_closed(14)">
                                       <span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ad_banner">
                                       <div class="ad_percent_strip"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                       <div class="ad_headline">
                                          <p>Har Din Sasta!</p>
                                       </div>
                                       <div class="ad_offer_percent">
                                          <h2>36% Off!</h2>
                                       </div>
                                       <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn_group">
                           <div class="save_for_later_btn">
                              <!-- <div id="wisf"> -->
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="MTQ=">
                              <span class="material-symbols-outlined idss14 hovercdd">bookmark</span>                        </a>
                              <!-- </div> -->
                           </div>
                           <div class="updd14" style="text-align:center;">
                              <button class="btn w-100 width-set  uptos14 hover-up add-to-cart-button product-add css-btn14" data-id="14" data-value="">Add</button>
                              <div class="quantity-controls w-100 hover-up width100 common-button css-inc14">
                                 <button class="quantity-decrease qtymode" data-id="minus_14" data-value=""><span class="material-symbols-outlined">remove</span></button>
                                 <input type="text" class="quantity-input" id="qty14" value="1" readonly="">
                                 <button class="quantity-increase qtymode" data-id="plus_14" data-value=""><span class="material-symbols-outlined">add</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 15">
                     <div class="product-cart-wrap mb-30">
                        <div class="grid_product_group" id="grid_product_group15">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="https://uat.rdfpl.com/product-details/kala-chana/?snp=MTU=">
                                    <img class="default-img" src="https://uat.rdfpl.com/uploads/1701585704KALACHANA_1.jpg" alt="">
                                    <!-- <img class="hover-img" src="" alt="" /> -->
                                 </a>
                              </div>
                              <div class="product-action-1"></div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot hotd15" style="display: none">0% OFF</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="javascript:void(0);">Pulses &amp; Beans</a>
                              </div>
                              <h2><a href="https://uat.rdfpl.com/product-details/kala-chana/?snp=MTU=">KALA CHANA</a></h2>
                              <div class="grid_product_rating">
                                 <p>4.2 <i class="material-symbols-outlined">star</i></p>
                                 <span>&nbsp;    209 Rating</span>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="brand_size">
                                    <!-- ===========custom select start======== -->
                                    <div class="custom-dropdown">
                                       <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false">
                                       Select
                                       </button>
                                       <ul class="dropdown-menu cust_select_lists" id="dropdownMenu">
                                          <li>
                                             <a data-value="1kg">
                                                <div class="kg_name">1KG</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                          <li>
                                             <a data-value="500g">
                                                <div class="kg_name">500g</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                    <!-- ===========custom select end======== -->
                                    <select class="form-select size" id="get-size15" data-id="15" data-value="">
                                       <option value="29">500 g</option>
                                       <option value="30">1 Kg</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="product-price">
                                    <span>₹<span class="price15">100.00</span></span>
                                    <input type="hidden" id="price-value15" value="100.00">&nbsp;&nbsp;
                                    <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice15">0.00</span></span></strike>
                                 </div>
                                 <div class="product-before-off-price">
                                 </div>
                                 <span class="loaderdiv-header15"></span>
                              </div>
                              <div class="grid_offer_ad">
                                 <div class="ad_btn" onclick="ad_btn(15)">
                                    <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                                 <div class="ad_show_sec">
                                    <div class="product-category">
                                       <a href="javascript:void(0);">Pulses &amp; Beans</a>
                                    </div>
                                    <h2><a href="https://uat.rdfpl.com/product-details/kala-chana/?snp=MTU=">KALA CHANA</a></h2>
                                    <div class="product-card-bottom mt-15 mb-15">
                                       <div class="product-price">
                                          <span>₹<span class="price15">100.00</span></span>
                                          <input type="hidden" id="price-value15" value="100.00">&nbsp;&nbsp;
                                          <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice15">0.00</span></span></strike>
                                       </div>
                                       <div class="product-before-off-price"></div>
                                       <span class="loaderdiv-header15"></span>
                                    </div>
                                    <div class="ad_closed text-right" onclick="ad_closed(15)">
                                       <span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ad_banner">
                                       <div class="ad_percent_strip"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                       <div class="ad_headline">
                                          <p>Har Din Sasta!</p>
                                       </div>
                                       <div class="ad_offer_percent">
                                          <h2>36% Off!</h2>
                                       </div>
                                       <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn_group">
                           <div class="save_for_later_btn">
                              <!-- <div id="wisf"> -->
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="MTU=">
                              <span class="material-symbols-outlined idss15 hovercdd">bookmark</span>                        </a>
                              <!-- </div> -->
                           </div>
                           <div class="updd15" style="text-align:center;">
                              <button class="btn w-100 width-set  uptos15 hover-up add-to-cart-button product-add css-btn15" data-id="15" data-value="">Add</button>
                              <div class="quantity-controls w-100 hover-up width100 common-button css-inc15">
                                 <button class="quantity-decrease qtymode" data-id="minus_15" data-value=""><span class="material-symbols-outlined">remove</span></button>
                                 <input type="text" class="quantity-input" id="qty15" value="1" readonly="">
                                 <button class="quantity-increase qtymode" data-id="plus_15" data-value=""><span class="material-symbols-outlined">add</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 16">
                     <div class="product-cart-wrap mb-30">
                        <div class="grid_product_group" id="grid_product_group16">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="https://uat.rdfpl.com/product-details/kabuli-chana-bada/?snp=MTY=">
                                    <img class="default-img" src="https://uat.rdfpl.com/uploads/1701585812KABULICHANABADA_1.jpg" alt="">
                                    <!-- <img class="hover-img" src="" alt="" /> -->
                                 </a>
                              </div>
                              <div class="product-action-1"></div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot hotd16" style="display: none">0% OFF</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="javascript:void(0);">Pulses &amp; Beans</a>
                              </div>
                              <h2><a href="https://uat.rdfpl.com/product-details/kabuli-chana-bada/?snp=MTY=">KABULI CHANA BADA</a></h2>
                              <div class="grid_product_rating">
                                 <p>4.2 <i class="material-symbols-outlined">star</i></p>
                                 <span>&nbsp;    209 Rating</span>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="brand_size">
                                    <!-- ===========custom select start======== -->
                                    <div class="custom-dropdown">
                                       <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false">
                                       Select
                                       </button>
                                       <ul class="dropdown-menu cust_select_lists" id="dropdownMenu">
                                          <li>
                                             <a data-value="1kg">
                                                <div class="kg_name">1KG</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                          <li>
                                             <a data-value="500g">
                                                <div class="kg_name">500g</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                    <!-- ===========custom select end======== -->
                                    <select class="form-select size" id="get-size16" data-id="16" data-value="">
                                       <option value="31">500 g</option>
                                       <option value="32">1 Kg</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="product-price">
                                    <span>₹<span class="price16">100.00</span></span>
                                    <input type="hidden" id="price-value16" value="100.00">&nbsp;&nbsp;
                                    <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice16">0.00</span></span></strike>
                                 </div>
                                 <div class="product-before-off-price">
                                 </div>
                                 <span class="loaderdiv-header16"></span>
                              </div>
                              <div class="grid_offer_ad">
                                 <div class="ad_btn" onclick="ad_btn(16)">
                                    <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                                 <div class="ad_show_sec">
                                    <div class="product-category">
                                       <a href="javascript:void(0);">Pulses &amp; Beans</a>
                                    </div>
                                    <h2><a href="https://uat.rdfpl.com/product-details/kabuli-chana-bada/?snp=MTY=">KABULI CHANA BADA</a></h2>
                                    <div class="product-card-bottom mt-15 mb-15">
                                       <div class="product-price">
                                          <span>₹<span class="price16">100.00</span></span>
                                          <input type="hidden" id="price-value16" value="100.00">&nbsp;&nbsp;
                                          <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice16">0.00</span></span></strike>
                                       </div>
                                       <div class="product-before-off-price"></div>
                                       <span class="loaderdiv-header16"></span>
                                    </div>
                                    <div class="ad_closed text-right" onclick="ad_closed(16)">
                                       <span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ad_banner">
                                       <div class="ad_percent_strip"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                       <div class="ad_headline">
                                          <p>Har Din Sasta!</p>
                                       </div>
                                       <div class="ad_offer_percent">
                                          <h2>36% Off!</h2>
                                       </div>
                                       <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn_group">
                           <div class="save_for_later_btn">
                              <!-- <div id="wisf"> -->
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="MTY=">
                              <span class="material-symbols-outlined idss16 hovercdd">bookmark</span>                        </a>
                              <!-- </div> -->
                           </div>
                           <div class="updd16" style="text-align:center;">
                              <button class="btn w-100 width-set  uptos16 hover-up add-to-cart-button product-add css-btn16" data-id="16" data-value="">Add</button>
                              <div class="quantity-controls w-100 hover-up width100 common-button css-inc16">
                                 <button class="quantity-decrease qtymode" data-id="minus_16" data-value=""><span class="material-symbols-outlined">remove</span></button>
                                 <input type="text" class="quantity-input" id="qty16" value="1" readonly="">
                                 <button class="quantity-increase qtymode" data-id="plus_16" data-value=""><span class="material-symbols-outlined">add</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 17">
                     <div class="product-cart-wrap mb-30">
                        <div class="grid_product_group" id="grid_product_group17">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="https://uat.rdfpl.com/product-details/kabuli-chana-chota/?snp=MTc=">
                                    <img class="default-img" src="https://uat.rdfpl.com/uploads/1701586110KABULICHANACHOTA_1.jpg" alt="">
                                    <!-- <img class="hover-img" src="" alt="" /> -->
                                 </a>
                              </div>
                              <div class="product-action-1"></div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot hotd17" style="display: none">0% OFF</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="javascript:void(0);">Pulses &amp; Beans</a>
                              </div>
                              <h2><a href="https://uat.rdfpl.com/product-details/kabuli-chana-chota/?snp=MTc=">KABULI CHANA CHOTA</a></h2>
                              <div class="grid_product_rating">
                                 <p>4.2 <i class="material-symbols-outlined">star</i></p>
                                 <span>&nbsp;    209 Rating</span>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="brand_size">
                                    <!-- ===========custom select start======== -->
                                    <div class="custom-dropdown">
                                       <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false">
                                       Select
                                       </button>
                                       <ul class="dropdown-menu cust_select_lists" id="dropdownMenu">
                                          <li>
                                             <a data-value="1kg">
                                                <div class="kg_name">1KG</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                          <li>
                                             <a data-value="500g">
                                                <div class="kg_name">500g</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                    <!-- ===========custom select end======== -->
                                    <select class="form-select size" id="get-size17" data-id="17" data-value="">
                                       <option value="33">500 g</option>
                                       <option value="34">1 Kg</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="product-price">
                                    <span>₹<span class="price17">50.00</span></span>
                                    <input type="hidden" id="price-value17" value="50.00">&nbsp;&nbsp;
                                    <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice17">0.00</span></span></strike>
                                 </div>
                                 <div class="product-before-off-price">
                                 </div>
                                 <span class="loaderdiv-header17"></span>
                              </div>
                              <div class="grid_offer_ad">
                                 <div class="ad_btn" onclick="ad_btn(17)">
                                    <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                                 <div class="ad_show_sec">
                                    <div class="product-category">
                                       <a href="javascript:void(0);">Pulses &amp; Beans</a>
                                    </div>
                                    <h2><a href="https://uat.rdfpl.com/product-details/kabuli-chana-chota/?snp=MTc=">KABULI CHANA CHOTA</a></h2>
                                    <div class="product-card-bottom mt-15 mb-15">
                                       <div class="product-price">
                                          <span>₹<span class="price17">50.00</span></span>
                                          <input type="hidden" id="price-value17" value="50.00">&nbsp;&nbsp;
                                          <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice17">0.00</span></span></strike>
                                       </div>
                                       <div class="product-before-off-price"></div>
                                       <span class="loaderdiv-header17"></span>
                                    </div>
                                    <div class="ad_closed text-right" onclick="ad_closed(17)">
                                       <span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ad_banner">
                                       <div class="ad_percent_strip"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                       <div class="ad_headline">
                                          <p>Har Din Sasta!</p>
                                       </div>
                                       <div class="ad_offer_percent">
                                          <h2>36% Off!</h2>
                                       </div>
                                       <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn_group">
                           <div class="save_for_later_btn">
                              <!-- <div id="wisf"> -->
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="MTc=">
                              <span class="material-symbols-outlined idss17 hovercdd">bookmark</span>                        </a>
                              <!-- </div> -->
                           </div>
                           <div class="updd17" style="text-align:center;">
                              <button class="btn w-100 width-set  uptos17 hover-up add-to-cart-button product-add css-btn17" data-id="17" data-value="">Add</button>
                              <div class="quantity-controls w-100 hover-up width100 common-button css-inc17">
                                 <button class="quantity-decrease qtymode" data-id="minus_17" data-value=""><span class="material-symbols-outlined">remove</span></button>
                                 <input type="text" class="quantity-input" id="qty17" value="1" readonly="">
                                 <button class="quantity-increase qtymode" data-id="plus_17" data-value=""><span class="material-symbols-outlined">add</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="custom_hr"></div>
            <div class="col-12">
               <h3 class="mb-30 pt-30">Before you checkout</h3>
            </div>
            <div class="co-12">
               <div class="row related-products">
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 13">
                     <div class="product-cart-wrap mb-30">
                        <div class="grid_product_group" id="grid_product_group13">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="https://uat.rdfpl.com/product-details/masoor-sabut/?snp=MTM=">
                                    <img class="default-img" src="https://uat.rdfpl.com/uploads/1701585195MASOORSABUT _1.jpg" alt="">
                                    <!-- <img class="hover-img" src="" alt="" /> -->
                                 </a>
                              </div>
                              <div class="product-action-1"></div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot hotd13" style="display: none">0% OFF</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="javascript:void(0);">Pulses &amp; Beans</a>
                              </div>
                              <h2><a href="https://uat.rdfpl.com/product-details/masoor-sabut/?snp=MTM=">MASOOR SABUT</a></h2>
                              <div class="grid_product_rating">
                                 <p>4.2 <i class="material-symbols-outlined">star</i></p>
                                 <span>&nbsp;    209 Rating</span>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="brand_size">
                                    <!-- ===========custom select start======== -->
                                    <div class="custom-dropdown">
                                       <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false">
                                       Select
                                       </button>
                                       <ul class="dropdown-menu cust_select_lists" id="dropdownMenu">
                                          <li>
                                             <a data-value="1kg">
                                                <div class="kg_name">1KG</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                          <li>
                                             <a data-value="500g">
                                                <div class="kg_name">500g</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                    <!-- ===========custom select end======== -->
                                    <select class="form-select size" id="get-size13" data-id="13" data-value="">
                                       <option value="25">500 g</option>
                                       <option value="26">1 Kg</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="product-price">
                                    <span>₹<span class="price13">200.00</span></span>
                                    <input type="hidden" id="price-value13" value="200.00">&nbsp;&nbsp;
                                    <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice13">0.00</span></span></strike>
                                 </div>
                                 <div class="product-before-off-price">
                                 </div>
                                 <span class="loaderdiv-header13"></span>
                              </div>
                              <div class="grid_offer_ad">
                                 <div class="ad_btn" onclick="ad_btn(13)">
                                    <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                                 <div class="ad_show_sec">
                                    <div class="product-category">
                                       <a href="javascript:void(0);">Pulses &amp; Beans</a>
                                    </div>
                                    <h2><a href="https://uat.rdfpl.com/product-details/masoor-sabut/?snp=MTM=">MASOOR SABUT</a></h2>
                                    <div class="product-card-bottom mt-15 mb-15">
                                       <div class="product-price">
                                          <span>₹<span class="price13">200.00</span></span>
                                          <input type="hidden" id="price-value13" value="200.00">&nbsp;&nbsp;
                                          <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice13">0.00</span></span></strike>
                                       </div>
                                       <div class="product-before-off-price"></div>
                                       <span class="loaderdiv-header13"></span>
                                    </div>
                                    <div class="ad_closed text-right" onclick="ad_closed(13)">
                                       <span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ad_banner">
                                       <div class="ad_percent_strip"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                       <div class="ad_headline">
                                          <p>Har Din Sasta!</p>
                                       </div>
                                       <div class="ad_offer_percent">
                                          <h2>36% Off!</h2>
                                       </div>
                                       <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn_group">
                           <div class="save_for_later_btn">
                              <!-- <div id="wisf"> -->
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="MTM=">
                              <span class="material-symbols-outlined idss13 hovercdd">bookmark</span>                        </a>
                              <!-- </div> -->
                           </div>
                           <div class="updd13" style="text-align:center;">
                              <button class="btn w-100 width-set  uptos13 hover-up add-to-cart-button product-add css-btn13" data-id="13" data-value="">Add</button>
                              <div class="quantity-controls w-100 hover-up width100 common-button css-inc13">
                                 <button class="quantity-decrease qtymode" data-id="minus_13" data-value=""><span class="material-symbols-outlined">remove</span></button>
                                 <input type="text" class="quantity-input" id="qty13" value="1" readonly="">
                                 <button class="quantity-increase qtymode" data-id="plus_13" data-value=""><span class="material-symbols-outlined">add</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 14">
                     <div class="product-cart-wrap mb-30">
                        <div class="grid_product_group" id="grid_product_group14">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="https://uat.rdfpl.com/product-details/malka-masoor/?snp=MTQ=">
                                    <img class="default-img" src="https://uat.rdfpl.com/uploads/1701585309MALKAMASOOR_1.jpg" alt="">
                                    <!-- <img class="hover-img" src="" alt="" /> -->
                                 </a>
                              </div>
                              <div class="product-action-1"></div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot hotd14" style="display: none">0% OFF</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="javascript:void(0);">Pulses &amp; Beans</a>
                              </div>
                              <h2><a href="https://uat.rdfpl.com/product-details/malka-masoor/?snp=MTQ=">MALKA MASOOR</a></h2>
                              <div class="grid_product_rating">
                                 <p>4.2 <i class="material-symbols-outlined">star</i></p>
                                 <span>&nbsp;    209 Rating</span>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="brand_size">
                                    <!-- ===========custom select start======== -->
                                    <div class="custom-dropdown">
                                       <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false">
                                       Select
                                       </button>
                                       <ul class="dropdown-menu cust_select_lists" id="dropdownMenu">
                                          <li>
                                             <a data-value="1kg">
                                                <div class="kg_name">1KG</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                          <li>
                                             <a data-value="500g">
                                                <div class="kg_name">500g</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                    <!-- ===========custom select end======== -->
                                    <select class="form-select size" id="get-size14" data-id="14" data-value="">
                                       <option value="27">500 g</option>
                                       <option value="28">1 Kg</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="product-price">
                                    <span>₹<span class="price14">200.00</span></span>
                                    <input type="hidden" id="price-value14" value="200.00">&nbsp;&nbsp;
                                    <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice14">0.00</span></span></strike>
                                 </div>
                                 <div class="product-before-off-price">
                                 </div>
                                 <span class="loaderdiv-header14"></span>
                              </div>
                              <div class="grid_offer_ad">
                                 <div class="ad_btn" onclick="ad_btn(14)">
                                    <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                                 <div class="ad_show_sec">
                                    <div class="product-category">
                                       <a href="javascript:void(0);">Pulses &amp; Beans</a>
                                    </div>
                                    <h2><a href="https://uat.rdfpl.com/product-details/malka-masoor/?snp=MTQ=">MALKA MASOOR</a></h2>
                                    <div class="product-card-bottom mt-15 mb-15">
                                       <div class="product-price">
                                          <span>₹<span class="price14">200.00</span></span>
                                          <input type="hidden" id="price-value14" value="200.00">&nbsp;&nbsp;
                                          <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice14">0.00</span></span></strike>
                                       </div>
                                       <div class="product-before-off-price"></div>
                                       <span class="loaderdiv-header14"></span>
                                    </div>
                                    <div class="ad_closed text-right" onclick="ad_closed(14)">
                                       <span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ad_banner">
                                       <div class="ad_percent_strip"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                       <div class="ad_headline">
                                          <p>Har Din Sasta!</p>
                                       </div>
                                       <div class="ad_offer_percent">
                                          <h2>36% Off!</h2>
                                       </div>
                                       <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn_group">
                           <div class="save_for_later_btn">
                              <!-- <div id="wisf"> -->
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="MTQ=">
                              <span class="material-symbols-outlined idss14 hovercdd">bookmark</span>                        </a>
                              <!-- </div> -->
                           </div>
                           <div class="updd14" style="text-align:center;">
                              <button class="btn w-100 width-set  uptos14 hover-up add-to-cart-button product-add css-btn14" data-id="14" data-value="">Add</button>
                              <div class="quantity-controls w-100 hover-up width100 common-button css-inc14">
                                 <button class="quantity-decrease qtymode" data-id="minus_14" data-value=""><span class="material-symbols-outlined">remove</span></button>
                                 <input type="text" class="quantity-input" id="qty14" value="1" readonly="">
                                 <button class="quantity-increase qtymode" data-id="plus_14" data-value=""><span class="material-symbols-outlined">add</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 15">
                     <div class="product-cart-wrap mb-30">
                        <div class="grid_product_group" id="grid_product_group15">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="https://uat.rdfpl.com/product-details/kala-chana/?snp=MTU=">
                                    <img class="default-img" src="https://uat.rdfpl.com/uploads/1701585704KALACHANA_1.jpg" alt="">
                                    <!-- <img class="hover-img" src="" alt="" /> -->
                                 </a>
                              </div>
                              <div class="product-action-1"></div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot hotd15" style="display: none">0% OFF</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="javascript:void(0);">Pulses &amp; Beans</a>
                              </div>
                              <h2><a href="https://uat.rdfpl.com/product-details/kala-chana/?snp=MTU=">KALA CHANA</a></h2>
                              <div class="grid_product_rating">
                                 <p>4.2 <i class="material-symbols-outlined">star</i></p>
                                 <span>&nbsp;    209 Rating</span>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="brand_size">
                                    <!-- ===========custom select start======== -->
                                    <div class="custom-dropdown">
                                       <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false">
                                       Select
                                       </button>
                                       <ul class="dropdown-menu cust_select_lists" id="dropdownMenu">
                                          <li>
                                             <a data-value="1kg">
                                                <div class="kg_name">1KG</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                          <li>
                                             <a data-value="500g">
                                                <div class="kg_name">500g</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                    <!-- ===========custom select end======== -->
                                    <select class="form-select size" id="get-size15" data-id="15" data-value="">
                                       <option value="29">500 g</option>
                                       <option value="30">1 Kg</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="product-price">
                                    <span>₹<span class="price15">100.00</span></span>
                                    <input type="hidden" id="price-value15" value="100.00">&nbsp;&nbsp;
                                    <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice15">0.00</span></span></strike>
                                 </div>
                                 <div class="product-before-off-price">
                                 </div>
                                 <span class="loaderdiv-header15"></span>
                              </div>
                              <div class="grid_offer_ad">
                                 <div class="ad_btn" onclick="ad_btn(15)">
                                    <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                                 <div class="ad_show_sec">
                                    <div class="product-category">
                                       <a href="javascript:void(0);">Pulses &amp; Beans</a>
                                    </div>
                                    <h2><a href="https://uat.rdfpl.com/product-details/kala-chana/?snp=MTU=">KALA CHANA</a></h2>
                                    <div class="product-card-bottom mt-15 mb-15">
                                       <div class="product-price">
                                          <span>₹<span class="price15">100.00</span></span>
                                          <input type="hidden" id="price-value15" value="100.00">&nbsp;&nbsp;
                                          <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice15">0.00</span></span></strike>
                                       </div>
                                       <div class="product-before-off-price"></div>
                                       <span class="loaderdiv-header15"></span>
                                    </div>
                                    <div class="ad_closed text-right" onclick="ad_closed(15)">
                                       <span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ad_banner">
                                       <div class="ad_percent_strip"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                       <div class="ad_headline">
                                          <p>Har Din Sasta!</p>
                                       </div>
                                       <div class="ad_offer_percent">
                                          <h2>36% Off!</h2>
                                       </div>
                                       <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn_group">
                           <div class="save_for_later_btn">
                              <!-- <div id="wisf"> -->
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="MTU=">
                              <span class="material-symbols-outlined idss15 hovercdd">bookmark</span>                        </a>
                              <!-- </div> -->
                           </div>
                           <div class="updd15" style="text-align:center;">
                              <button class="btn w-100 width-set  uptos15 hover-up add-to-cart-button product-add css-btn15" data-id="15" data-value="">Add</button>
                              <div class="quantity-controls w-100 hover-up width100 common-button css-inc15">
                                 <button class="quantity-decrease qtymode" data-id="minus_15" data-value=""><span class="material-symbols-outlined">remove</span></button>
                                 <input type="text" class="quantity-input" id="qty15" value="1" readonly="">
                                 <button class="quantity-increase qtymode" data-id="plus_15" data-value=""><span class="material-symbols-outlined">add</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 16">
                     <div class="product-cart-wrap mb-30">
                        <div class="grid_product_group" id="grid_product_group16">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="https://uat.rdfpl.com/product-details/kabuli-chana-bada/?snp=MTY=">
                                    <img class="default-img" src="https://uat.rdfpl.com/uploads/1701585812KABULICHANABADA_1.jpg" alt="">
                                    <!-- <img class="hover-img" src="" alt="" /> -->
                                 </a>
                              </div>
                              <div class="product-action-1"></div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot hotd16" style="display: none">0% OFF</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="javascript:void(0);">Pulses &amp; Beans</a>
                              </div>
                              <h2><a href="https://uat.rdfpl.com/product-details/kabuli-chana-bada/?snp=MTY=">KABULI CHANA BADA</a></h2>
                              <div class="grid_product_rating">
                                 <p>4.2 <i class="material-symbols-outlined">star</i></p>
                                 <span>&nbsp;    209 Rating</span>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="brand_size">
                                    <!-- ===========custom select start======== -->
                                    <div class="custom-dropdown">
                                       <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false">
                                       Select
                                       </button>
                                       <ul class="dropdown-menu cust_select_lists" id="dropdownMenu">
                                          <li>
                                             <a data-value="1kg">
                                                <div class="kg_name">1KG</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                          <li>
                                             <a data-value="500g">
                                                <div class="kg_name">500g</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                    <!-- ===========custom select end======== -->
                                    <select class="form-select size" id="get-size16" data-id="16" data-value="">
                                       <option value="31">500 g</option>
                                       <option value="32">1 Kg</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="product-price">
                                    <span>₹<span class="price16">100.00</span></span>
                                    <input type="hidden" id="price-value16" value="100.00">&nbsp;&nbsp;
                                    <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice16">0.00</span></span></strike>
                                 </div>
                                 <div class="product-before-off-price">
                                 </div>
                                 <span class="loaderdiv-header16"></span>
                              </div>
                              <div class="grid_offer_ad">
                                 <div class="ad_btn" onclick="ad_btn(16)">
                                    <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                                 <div class="ad_show_sec">
                                    <div class="product-category">
                                       <a href="javascript:void(0);">Pulses &amp; Beans</a>
                                    </div>
                                    <h2><a href="https://uat.rdfpl.com/product-details/kabuli-chana-bada/?snp=MTY=">KABULI CHANA BADA</a></h2>
                                    <div class="product-card-bottom mt-15 mb-15">
                                       <div class="product-price">
                                          <span>₹<span class="price16">100.00</span></span>
                                          <input type="hidden" id="price-value16" value="100.00">&nbsp;&nbsp;
                                          <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice16">0.00</span></span></strike>
                                       </div>
                                       <div class="product-before-off-price"></div>
                                       <span class="loaderdiv-header16"></span>
                                    </div>
                                    <div class="ad_closed text-right" onclick="ad_closed(16)">
                                       <span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ad_banner">
                                       <div class="ad_percent_strip"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                       <div class="ad_headline">
                                          <p>Har Din Sasta!</p>
                                       </div>
                                       <div class="ad_offer_percent">
                                          <h2>36% Off!</h2>
                                       </div>
                                       <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn_group">
                           <div class="save_for_later_btn">
                              <!-- <div id="wisf"> -->
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="MTY=">
                              <span class="material-symbols-outlined idss16 hovercdd">bookmark</span>                        </a>
                              <!-- </div> -->
                           </div>
                           <div class="updd16" style="text-align:center;">
                              <button class="btn w-100 width-set  uptos16 hover-up add-to-cart-button product-add css-btn16" data-id="16" data-value="">Add</button>
                              <div class="quantity-controls w-100 hover-up width100 common-button css-inc16">
                                 <button class="quantity-decrease qtymode" data-id="minus_16" data-value=""><span class="material-symbols-outlined">remove</span></button>
                                 <input type="text" class="quantity-input" id="qty16" value="1" readonly="">
                                 <button class="quantity-increase qtymode" data-id="plus_16" data-value=""><span class="material-symbols-outlined">add</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 17">
                     <div class="product-cart-wrap mb-30">
                        <div class="grid_product_group" id="grid_product_group17">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="https://uat.rdfpl.com/product-details/kabuli-chana-chota/?snp=MTc=">
                                    <img class="default-img" src="https://uat.rdfpl.com/uploads/1701586110KABULICHANACHOTA_1.jpg" alt="">
                                    <!-- <img class="hover-img" src="" alt="" /> -->
                                 </a>
                              </div>
                              <div class="product-action-1"></div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot hotd17" style="display: none">0% OFF</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="javascript:void(0);">Pulses &amp; Beans</a>
                              </div>
                              <h2><a href="https://uat.rdfpl.com/product-details/kabuli-chana-chota/?snp=MTc=">KABULI CHANA CHOTA</a></h2>
                              <div class="grid_product_rating">
                                 <p>4.2 <i class="material-symbols-outlined">star</i></p>
                                 <span>&nbsp;    209 Rating</span>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="brand_size">
                                    <!-- ===========custom select start======== -->
                                    <div class="custom-dropdown">
                                       <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false">
                                       Select
                                       </button>
                                       <ul class="dropdown-menu cust_select_lists" id="dropdownMenu">
                                          <li>
                                             <a data-value="1kg">
                                                <div class="kg_name">1KG</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                          <li>
                                             <a data-value="500g">
                                                <div class="kg_name">500g</div>
                                                <div class="off_ad_btn">
                                                   <div class="off_percent_ad">
                                                      12% OFF
                                                   </div>
                                                   <div class="product-price">
                                                      <span>₹<span class="price841">140.00</span></span>                         
                                                      <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">150.00</span></span></strike>
                                                   </div>
                                                   <div class="select_ad_btn">
                                                      <p>Add</p>
                                                   </div>
                                                </div>
                                             </a>
                                          </li>
                                       </ul>
                                    </div>
                                    <!-- ===========custom select end======== -->
                                    <select class="form-select size" id="get-size17" data-id="17" data-value="">
                                       <option value="33">500 g</option>
                                       <option value="34">1 Kg</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="product-card-bottom mt-15 mb-15">
                                 <div class="product-price">
                                    <span>₹<span class="price17">50.00</span></span>
                                    <input type="hidden" id="price-value17" value="50.00">&nbsp;&nbsp;
                                    <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice17">0.00</span></span></strike>
                                 </div>
                                 <div class="product-before-off-price">
                                 </div>
                                 <span class="loaderdiv-header17"></span>
                              </div>
                              <div class="grid_offer_ad">
                                 <div class="ad_btn" onclick="ad_btn(17)">
                                    <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                                 <div class="ad_show_sec">
                                    <div class="product-category">
                                       <a href="javascript:void(0);">Pulses &amp; Beans</a>
                                    </div>
                                    <h2><a href="https://uat.rdfpl.com/product-details/kabuli-chana-chota/?snp=MTc=">KABULI CHANA CHOTA</a></h2>
                                    <div class="product-card-bottom mt-15 mb-15">
                                       <div class="product-price">
                                          <span>₹<span class="price17">50.00</span></span>
                                          <input type="hidden" id="price-value17" value="50.00">&nbsp;&nbsp;
                                          <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice17">0.00</span></span></strike>
                                       </div>
                                       <div class="product-before-off-price"></div>
                                       <span class="loaderdiv-header17"></span>
                                    </div>
                                    <div class="ad_closed text-right" onclick="ad_closed(17)">
                                       <span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ad_banner">
                                       <div class="ad_percent_strip"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                       <div class="ad_headline">
                                          <p>Har Din Sasta!</p>
                                       </div>
                                       <div class="ad_offer_percent">
                                          <h2>36% Off!</h2>
                                       </div>
                                       <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="btn_group">
                           <div class="save_for_later_btn">
                              <!-- <div id="wisf"> -->
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="MTc=">
                              <span class="material-symbols-outlined idss17 hovercdd">bookmark</span>                        </a>
                              <!-- </div> -->
                           </div>
                           <div class="updd17" style="text-align:center;">
                              <button class="btn w-100 width-set  uptos17 hover-up add-to-cart-button product-add css-btn17" data-id="17" data-value="">Add</button>
                              <div class="quantity-controls w-100 hover-up width100 common-button css-inc17">
                                 <button class="quantity-decrease qtymode" data-id="minus_17" data-value=""><span class="material-symbols-outlined">remove</span></button>
                                 <input type="text" class="quantity-input" id="qty17" value="1" readonly="">
                                 <button class="quantity-increase qtymode" data-id="plus_17" data-value=""><span class="material-symbols-outlined">add</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row mt-60 cart_products">
         </div>
      </div>
   </div>
</main>


<div class="modal fade cart_modal_main_sec" id="offer_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background: #f4f4f4;">
        <h4 class="modal-title d-flex align-items-center justify-content-center" id="staticBackdropLabel"> <img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/offer_perecnt.svg">&nbsp; Offers</h4>
        <button type="button" class="btn-close fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body cart_page">
            <ul>
                <li> 
                    <div class="ad_banner">
                        <div class="ad_percent_strip"><img src="http://localhost/RDFPL_Lattest_BKP_12_April_2024/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                        <div class="ad_headline"><p>Har Din Sasta!</p></div>
                        <div class="ad_offer_percent"><h2>36% Off!</h2></div>
                        <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                    </div>
                </li>
                <li>
                    <div class="ad_banner">
                        <div class="ad_percent_strip"><img src="http://localhost/RDFPL_Lattest_BKP_12_April_2024/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                        <div class="ad_headline"><p>Har Din Sasta!</p></div>
                        <div class="ad_offer_percent"><h2>36% Off!</h2></div>
                        <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>₹66</b></div>
                    </div>
                </li>
            </ul>           
        </div>     
    </div>
  </div>
</div>
<?php $this->load->view('frontend/footer'); ?>