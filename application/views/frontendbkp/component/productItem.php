
<?php


   if(isset($productItems) && is_array($productItems) && count($productItems)>0){ 

      // print_r($productItems);
      // exit();
      foreach ($productItems as $record){

         $items=$this->customlibrary->getProductItemByproductId($record['product_id']); 

         $firstItem=isset($items[0]) ? $items[0] : array();         
    ?>
   <div class="col-lg-1-<?php echo isset($pcol) ? $pcol : 4; ?> col-md-4 col-12 col-sm-6">
      <div class="product-cart-wrap mb-30">
         <div class="grid_product_group" id="grid_product_group<?php echo $record['product_id'];?>" >
            <div class="product-img-action-wrap">
               <div class="product-img product-img-zoom">
                  <a href="<?php echo base_url("product/".$record['slug']);?>" tabindex="0">
                     <img class="default-img" src="<?php echo base_url('uploads/'.$record['feature_img']);?>" alt="">
                     <!-- <img class="hover-img" src="" alt="" /> -->
                  </a>
               </div>
               <div class="product-action-1"></div>
               <div class="product-badges product-badges-position product-badges-mrg">
                  <span class="hot hotd4tab-slide" style="display: none">0% OFF</span>
               </div>
            </div>
            <div class="product-content-wrap">
               <div class="product-category">
                  <a href="javascript:void(0);" tabindex="0"></a>
               </div>
               <h2><a href="<?php echo base_url('detail/'.$record['slug'])?>" tabindex="0"><?php echo stripslashes($record['product_name'])?></a></h2>
               <div class="grid_product_rating">
                  <p>4.2 <i class="material-symbols-outlined">star</i></p>
                  <span>&nbsp;209 Rating</span>
               </div>
               <div class="product-card-bottom mt-15 mb-15">
                  <div class="brand_size">
                     <!-- ===========custom select start======== -->
                  <?php 
                     if(isset($items) && count($items)>0){ ?>
                     <div class="custom-dropdown">
                        <button class="dropdown-toggle cust_select_btn" id="dropdownToggle" aria-expanded="false" tabindex="0">
                        <?php echo isset($items[0]['pack_size']) ? $items[0]['pack_size'].''.$items[0]['units'] : "" ;?>
                        </button>
                        <ul class="dropdown-menu cust_select_lists" id="dropdownMenu" style="display: none;">
                           <?php 
                              foreach($items as $item){ 
                                 echo'<li onclick="setItem('.$record['product_id'].','.$item['variant_id'].','.$item['price'].','.$item['before_off_price'].');">
                                          <a data-value="500g" tabindex="0">
                                             <div class="kg_name">'.$item['pack_size'].''.$item['units'].'</div>
                                             <div class="off_ad_btn">
                                                <div class="off_percent_ad">12% OFF</div>
                                                <div class="product-price">
                                                   <span>₹<span class="price841">'.$item['price'].'</span></span>                         
                                                   <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice841">'.$item['before_off_price'].'</span></span></strike>
                                                </div>
                                                <div class="select_ad_btn d-none"><p>Add</p></div>
                                             </div>
                                          </a>
                                       </li>';
                              }
                           ?>
                        </ul>
                     </div>
                  <?php } ?>
                  </div>
               </div>

               <div class="product-card-bottom mt-15 mb-15">
                  <div class="product-price">
                     <span>₹<span class="price4tab-slide" id="price<?php echo $record['product_id'];?>"><?php echo isset($firstItem['price']) ? $firstItem['price'] : 0 ;?></span></span>
                    
                     <input type="hidden" id="price-value4tab-slide" value="" tabindex="0">&nbsp;&nbsp;
                     <strike>
                        <span style="font-size: 14px;font-weight: 400;color: #787878;">
                           <span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span>
                           <span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice4tab-slide" id="mrp<?php echo $record['product_id'];?>" >
                              <?php echo isset($firstItem['before_off_price']) ? $firstItem['before_off_price'] : 0 ;?>
                           </span>
                        </span>
                     </strike>
                  </div>
                  <div class="product-before-off-price"></div>
                  <span class="loaderdiv-header4tab-slide"></span>
               </div>
                <!-- Offer section-->  
               <div class="grid_offer_ad">
                  <div class="ad_btn" onclick="ad_btn(<?php echo $record['product_id'];?>)">
                     <h4>Har Din Sasta! <span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                  </div>
                  <div class="ad_show_sec">
                     <div class="product-category">
                        <a href="javascript:void(0);" tabindex="0"></a>
                     </div>
                     <h2><a href="https://uat.rdfpl.com/product-details/soyabean-dana/?snp=NA==" tabindex="0">SOYABEAN DANA</a></h2>
                     <div class="product-card-bottom mt-15 mb-15">
                        <div class="product-price">
                           <span>₹<span class="price4tab-slide"></span></span>
                           <input type="hidden" id="price-value4tab-slide" value="" tabindex="0">&nbsp;&nbsp;
                           <strike><span style="font-size: 14px;font-weight: 400;color: #787878;"><span style="font-size: 14px;font-weight: 500;color: #787878;">MRP ₹</span><span style="font-size: 14px;font-weight: 500;color: #787878;" class="beforeOffprice4tab-slide"></span></span></strike>
                        </div>
                        <div class="product-before-off-price"></div>
                        <span class="loaderdiv-header4tab-slide"></span>
                     </div>
                     <div class="ad_closed text-right" onclick="ad_closed(<?php echo $record['product_id'];?>)">
                        <span class="material-symbols-outlined">cancel</span>
                     </div>
                     <div class="ad_banner">
                        <div class="ad_percent_strip"><img src="<?php echo base_url();?>/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
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

                <!-- End Offer section-->  
               </div>
         </div>


         <div class="btn_group">
            <div class="save_for_later_btn">
               <!-- <div id="wisf"> -->
               <a href="javascript:void(0);" title="Wishlist" class="wish-div" onclick="addToWishlist(<?php echo $record['product_id'];?>);return false;">
               <span class="material-symbols-outlined idss4 hovercdd">bookmark</span></a>
               <!-- </div> -->
            </div>
            <div class="updd4tab-slide" style="text-align:center;" id="addToCartDiv<?php echo $record['product_id']; ?>">
               <input type="hidden" class="quantity-input" id="productItemId<?php echo $record['product_id']; ?>" value="<?php echo isset($firstItem['variant_id']) ? $firstItem['variant_id'] : 0 ?>" >
               <?php if(isset($firstItem['stock']) && $firstItem['stock'] >0){ ?>
                  
                  <button class="btn w-100 width-set  uptos475tab-slide hover-up" id="addtobtn<?php echo $record['product_id']; ?>"  onclick="addToCart(<?php echo $record['product_id']; ?>);return false;">Add</button>

                  <div class="quantity-controls w-100 hover-up width100 common-button css-inc475tab-slide" id="aquantitycontrols<?php echo $record['product_id']?>">
                        <button class="quantity-decrease qtymode"  tabindex="0" onclick="itemtIncreament(<?php echo $record['product_id']; ?>,1);"><span class="material-symbols-outlined">-</span></button>
                        <input type="text" class="quantity-input" id="qty<?php echo $record['product_id']; ?>" value="1" readonly>
                        <button class="quantity-increase qtymode" onclick="itemtIncreament(<?php echo $record['product_id']; ?>,2);" tabindex="0"><span class="material-symbols-outlined">+</span></button>
                  </div>
                  
               <?php } else { ?>
               <div class="btn w-100 width-set out_of_stock_btn uptos4tab-slide hover-up   css-btn4tab-slide" id="outOfStock<?php echo $record['product_id']; ?>">Out of Stock</div>
               <?php } ?>   
               
            </div>
         </div>
      </div>
   </div>
   <?php
   } 

} 
?>