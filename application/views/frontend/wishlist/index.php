<?php $this->load->view('frontend/header'); ?>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>My Wishlist
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 my_account_main m-auto">
                        <div class="row">
                            <div class="col-md-2">
                               <?php 
                                $p['pageType'] = 'wishlist';
                                $p['re_div']='rediv';
                                 $this->load->view('frontend/component/myaccountsidebar',$p); 
                                ?>
                            </div>
                            <div class="col-md-10 refe-dv mt-20">
                                <!-- =========wishlist new design======== -->
<div class="row">
    <div class="col-md-12">
        <div class="wish_list_header">
            <div class="wish_select d-flex align-items-center justify-content-between">
                <div class="wish_sel_div">
                    <h6>Selected Products (0)</h6>
                    <input class="form-check-input mb-3" type="checkbox">
                    <label class="form-check-label mt-1 pl-2">
                        <span class="font-small fw-600" style="font-size:16px;"> Select All</span>
                    </label>
                </div>
                <div class="wish_all_btn d-flex align-items-center justify-content-center">
                    <h6 class="text-muted">For Selected Products</h6>&nbsp; <a href="" class="btn btn-primary ">Add To Bakset </a>
                </div>
        </div>
        </div>
    </div>
</div>
<div class="custom_hr"></div>

<div class="row product-grid mt-2">    
<?php for ($i=0; $i < 10; $i++) { ?>
  
  
    <!-- ===============product show=============== -->
    <div class="col-lg-1-4 col-md-4 col-12 col-sm-6 476">
        <div class="wish_select">
            <input class="form-check-input mb-3" type="checkbox">
        </div>
        <div class="product-cart-wrap mb-30">

        <div class="grid_product_group" id="grid_product_group476">
            <div class="product-img-action-wrap">
                <div class="product-img product-img-zoom">
                <a href="http://localhost/RDFPL_Lattest_BKP_12_April_2024/product-details/dr-jains-jaswand-kesh-tel-100-ml/?snp=NDc2">
                    <img class="default-img" src="https://site.rdfpl.com/uploads/1709111059DR. JAIN'S JASWAND KESH TEL 100 ML.jpg" alt="">
                    <!-- <img class="hover-img" src="" alt="" /> -->
                </a>
                </div>
                <div class="product-action-1"></div>
                <div class="product-badges product-badges-position product-badges-mrg">                    
                    <span class="hot hotd476" style="display: none;">0% OFF</span>
                </div>
            </div>
            <div class="product-content-wrap">
                <div class="product-category">
                    <a href="javascript:void(0);">Hair Care</a>
                </div>
              
                <h2>
                    <a href="http://localhost/RDFPL_Lattest_BKP_12_April_2024/product-details/dr-jains-jaswand-kesh-tel-100-ml/?snp=NDc2">DR. JAIN'S JASWAND KESH TEL 100 ML</a>
                </h2>

                <div class="grid_product_rating">
                    <p>4.2 <i class="material-symbols-outlined">star</i></p> <span>&nbsp; 209 Rating</span>
                </div>
 
                <div class="product-card-bottom mt-15 mb-15">
                    <div class="brand_size">

                        <!-- ===========custom select start======== -->
                            <div class="custom-dropdown">
                              <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false" onclick="onclickAddCustCSS(1)">
                                Select
                              </button>
                              <ul class="dropdown-menu cust_select_lists onclickAddCustCSS1" id="dropdownMenu">
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
                                <!-- Add more options here -->
                              </ul>
                            </div>
                        <!-- ===========custom select end======== -->

                    </div>
                </div>

                <div class="product-card-bottom mt-15 mb-15">
                    <div class="product-price">
                        <span>₹<span class="price476">165.00</span></span>

                        <input type="hidden" id="price-value476" value="165.00">&nbsp;&nbsp;
                         
                        <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice476">165.00</span></span></strike>
                    </div>

                    <div class="product-before-off-price">                       
                    </div>
                    <span class="loaderdiv-header476"></span>
                </div>
                    
                <div class="grid_offer_ad">
                    <div class="ad_btn" onclick="HarDinApnaOpen(476,'')">
                        <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                    </div>
                    <div class="ad_show_sec">
                        <div class="product-category">
                            <a href="javascript:void(0);">Hair Care</a>
                        </div>
              
                         <h2><a href="http://localhost/RDFPL_Lattest_BKP_12_April_2024/product-details/dr-jains-jaswand-kesh-tel-100-ml/?snp=NDc2">DR. JAIN'S JASWAND KESH TEL 100 ML</a></h2>

                        <div class="product-card-bottom mt-15 mb-15">
                            <div class="product-price">
                                <span>₹<span class="price476">165.00</span></span>

                                <input type="hidden" id="price-value476" value="165.00">&nbsp;&nbsp;
                                 
                                <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice476">165.00</span></span></strike>
                            </div>

                            <div class="product-before-off-price"></div>
                            <span class="loaderdiv-header476"></span>
                        </div>

                        <div class="ad_closed text-right" onclick="HarDinApneClosed(476)">
                            <span class="material-symbols-outlined">cancel</span>
                        </div>
                        <div class="ad_banner">
                            <div class="ad_percent_strip"><img src="http://localhost/RDFPL_Lattest_BKP_12_April_2024/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                            <div class="ad_headline"><p>Har Din Sasta!</p></div>
                            <div class="ad_offer_percent"><h2>36% Off!</h2></div>
                            <div class="ad_offer_desc">Get up to <b>3</b> qty at <b>₹58</b> and additional Qty at <b>66</b></div>
                        </div>
                    </div>
                </div>

                  </div>
                </div>

                <div class="btn_group">
                 <div class="save_for_later_btn">
                    <!-- <div id="wisf"> -->
                    <a href="javascript:void(0);" title="Wishlist" class="wish-div" data-id="NDc2">
                        <span class="material-symbols-outlined idss476 hovercdd">bookmark</span>
                    </a>
                   <!-- </div> -->
                </div>

                 

            <div class="updd476" style="text-align:center;">

                <button class="btn w-100 width-set  uptos476  add-to-cart-button product-add css-btn476" data-id="476" data-value="">Add</button>
                

                                <div class="quantity-controls w-100  width100 common-button css-inc476">
                    <button class="quantity-decrease qtymode" data-id="minus_476" data-value=""><span class="material-symbols-outlined">remove</span></button>
                    <input type="text" class="quantity-input" id="qty476" value="1" readonly="">
                    <button class="quantity-increase qtymode" data-id="plus_476" data-value=""><span class="material-symbols-outlined">add</span></button>
                </div>
               
                </div>           
            </div>
        </div>
    </div>                        
    <!-- ==============product show end============ -->
<?php }  ?>   
</div><!--row end-->

<!-- =========wishlist new design end======== -->
                                <!-- <div class="tab-content account dashboard-content"> -->
                                    <!-- <div class="tab-pane fade active show" > -->
                              <!--<div class="card2">-->
                              <!--    <div class="card-body2">-->
                              <!--      <div id="refpa">-->
                              <!--        <div class="row product-grid">-->
                                        <?//php
                                          // if(isset($products) && count($products)>0){
                                           //  $data['productItems']=$products;
                                             // $data['pcol']=4; 

                                             //  echo  $this->load->view("frontend/component/productItem",$data,true);
                                             // }else{ ?>
                                               <!--<img src="<?php echo base_url().'include/no-product.png';?>" style="width: 40%;margin-left: auto;margin-right: auto;padding: 3% 0 3%;">-->
                                               <!--   <h3 style="text-align: center;">Product Not Found</h3>-->
                                             <? //php } ?>
                              <!--         </div>-->
                              <!--         <div class="pagination-area mt-20 mb-20">-->
                              <!--            <nav aria-label="Page navigation example">-->
                              <!--               <?php echo $links ;?>-->
                              <!--            </nav>-->
                              <!--         </div>-->
                              <!--      </div>-->
                              <!--    </div>-->
                              <!--</div>-->
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $this->load->view('frontend/footer'); ?>