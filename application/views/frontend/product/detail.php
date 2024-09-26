<?php 
$items=$this->customlibrary->getProductItemByproductId($pdetail['product_id']); 
$firstItem=isset($items[0]) ? $items[0] : array();
$this->load->model('product_model', 'productObj');
$getOfferName=$this->productObj->get_offername($pdetail['product_id']);
// print_r($getOfferName);
// exit();
$this->load->view('frontend/header');
?> 
<?php
// print_r($review['customer_name']);
// exit();
?>
<style type="text/css">
   .thumb-icon {
    cursor: pointer;
    color: gray; /* Default color */
    transition: color 0.3s;
}

.thumb-icon.active {
    color: blue; /* Active color */
}
</style>
<main class="main">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb breadcrub_shop">
            <div class="broad">
               <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
               <span></span>
               <a href="<?php echo base_url('shop');?>">Shop</a><span></span>
               <a href="<?php echo base_url('shop/'.$pdetail['top_cat_slug']);?>"><?php echo isset($pdetail['top_cat_name']) ? $pdetail['top_cat_name'] : '' ;?></a><span></span>
               <a href="<?php echo base_url('shop/'.$pdetail['top_cat_slug'].'/'.$pdetail['sub_cat_slug']);?>"><?php echo isset($pdetail['sub_cat_name']) ? $pdetail['sub_cat_name'] : '' ;?></a><span></span>
               <a href="<?php echo base_url('shop/'.$pdetail['top_cat_slug'].'/'.$pdetail['sub_cat_slug'].'/'.$pdetail['child_cat_slug']);?>"><?php echo isset($pdetail['child_cat_name']) ? $pdetail['child_cat_name'] : '' ;?></a>
               <span></span><?php echo isset($pdetail['product_name']) ? $pdetail['product_name'] : '' ;?>               
            </div>
            <div class="mobile-social-icon d-flex align-items-center">
               <p class="text-muted">Share On</p>
               &nbsp;&nbsp;
               <a style="background-color: #225aa1;" href="https://www.facebook.com/sharer.php?u=<?php echo base_url('product');?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/icons/icon-facebook-white.svg" alt=""></a>
               <a style="background-color: #16afe5;" href="https://twitter.com/share?text=<?php echo base_url('product');?>" target="_blank" title="Twitter"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/icons/icon-twitter-white.svg" alt=""></a>
               <a style="background-color: #c25252" href="https://mail.google.com/mail/?view=<?php echo base_url('product');?>" target="_blank" title="Email"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/icons/email.svg" alt="" style="max-width: 15px !important;"></a>
               <a style="background-color: #25D366" href="https://api.whatsapp.com/send?text= <?php echo base_url('product');?>/?snp=NDc1" target="_blank" title="Share via WhatsApp"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/icons/whatsapp_icon.svg" alt="" style="max-width: 20px !important;"></a>
            </div>
         </div>
      </div>
   </div>
   <div class="container mb-30">
      <div class="row">
         <div class="col-xl-12 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
               <div class="row mb-50 mt-30">
                  <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                     <div class="detail-gallery">
                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                        <!-- THUMBNAILS -->
                        <div class="slider-nav-thumbnails">
                           <?php for($i=1; $i<7; $i++){ 
                               $img=isset($pdetail['image'.$i]) ? $pdetail['image'.$i] : "" ;

                               if($img!=""){
                           ?>
                           <div>
                              <img src="<?php echo base_url('uploads/'.$img);?>" alt="product image">
                           </div>
                           
                           <?php } }?>
                        </div>
                        <!-- MAIN SLIDES -->
                        <div class="product-image-slider">
                           <?php for($i=1; $i<7; $i++){ 
                            $img=isset($pdetail['image'.$i]) ? $pdetail['image'.$i] : "" ;

                            if($img!=""){
                           ?>
                           <figure class="border-radius-10">
                              <img src="<?php echo base_url('uploads/'.$img);?>" alt="product image">
                           </figure>
                           <?php } }?>
                        </div> 
                     </div>
                     <!-- End Gallery -->
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="detail-info product_details_main_sec pr-30 pl-30">
                        <!-- <span class="stock-status out-stock"> Sale Off </span> -->
                        <div class="product_details_category">
                           <p><u><?php echo isset($pdetail['top_cat_name']) ? $pdetail['top_cat_name'] : '' ;?></u></p>
                        </div>
                        <h2 class="title-detail"><?php echo isset($pdetail['product_name']) ? $pdetail['product_name'] : '' ;?></h2>
                        <div class="grid_product_rating mt-10">
                          <?php
                              $productRatings = $this->customlibrary->getProductRatingSummary($pdetail['product_id']);
                              $average_rating = number_format($productRatings['average_rating'], 1);
                              $total_ratings = $productRatings['total_ratings'];
                              $total_reviews = $productRatings['total_reviews'];
                              //$rati=$this->customlibrary->getProductRatingSummary($pdetail['product_id']);

                          ?>
                          <p><?php echo $average_rating; ?> <i class="material-symbols-outlined">star</i></p>
                          <a href="<?= base_url('rating-review-details/' . $pdetail['product_id']) ?>"><span class="text-muted">&nbsp; <u><?php echo $total_ratings; ?> Ratings &amp; <?php echo $total_reviews; ?> Reviews</u></span></a>
                        </div>
                        <div class="product_details_price mt-20">
                           <p class="text-muted-low"><span>MRP </span><span><strike id="current-mrp">₹<?php echo isset($firstItem['before_off_price']) ? $firstItem['before_off_price'] : '' ?></strike></span></p>
                           <!-- <div class="clearfix product-price-cover">
                              <div class="product-price primary-color float-left">
                                 <span class="current-price">Price: ₹<span class="price475"><?php echo isset($firstItem['price']) ? $firstItem['price'] : '' ?></span></span>
                                 <span>
                                 </span>
                              </div>
                           </div> -->
                           <div class="clearfix product-price-cover">
                               <div class="product-price primary-color float-left">
                                   <span class="current-price">Price: ₹<span id="current-price" class="price475"><?php echo isset($items[0]['price']) ? $items[0]['price'] : '' ?></span></span>
                                   <span></span>
                               </div>
                           </div>
                           <div class="product_details_save">
                              <p class="text-brand d-flex">You Save: <span class="save-price font-md fw-bold color3 ml-15 hotd475" style="display: none">0% OFF</span>
                              </p>
                              <span class="text-muted-low font-sm">(inclusive of all taxes)</span>
                           </div>
                        </div>
                        <div class="d-flex justify-content-between">
                           <a href="#product_details_offer_ad">
                              <div class="grid_offer_ad mt-20">
                                 <div class="ad_btn" style="width: 470px;">
                                    <h4><?php echo (!empty($getOfferName)) ? $getOfferName[0]['offer_name'] : null;?><span class="material-symbols-outlined">keyboard_arrow_down</span></h4>
                                 </div>
                              </div>
                           </a>
                           <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" style="padding: 0px 26px;height: 40px;margin-top: 17px;background: #f17523;">
                                           Subscribe & Save
                           </button>
                           <!-- Offcanvas Component -->
                           <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color:rgb(250 250 250);">
                                 <div class="offcanvas-header">
                                   <h5 class="offcanvas-title" id="offcanvasExampleLabel">Subscribe & Save</h5>
                                   <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                 </div>
                                    <div class="offcanvas-body">

                                       <!-- ------subscribe details------ -->
                                       
                                       <div class="sub_percent">
                                           <p class="first_p">5%</p> <p class="second_p">10%</p>
                                       </div>

                                       <div class="product_details_price mt-20">
                                           <p class="text-muted-low"><span>MRP </span><span><strike>₹165.00</strike></span></p>
                                          <div class="clearfix product-price-cover">
                                             <div class="product-price primary-color float-left">
                                                  <span class="current-price">Price: ₹<span class="price<?php echo $value->product_id;?>"><?php echo $value->variants[0]->price;?></span></span>
                                                  <span>
                                             </div>
                                          </div>       
                                       </div><br>

                                       <p class="text-muted">Save 5% now and up to 10% on repeat deliveries. Cancel Anytime</p><br>

                                       <div class="sub_quantity d-flex">
                                           <div class="row mb-3">
                                               <label for="inputEmail3" class="col-sm-2 col-form-label">Qty:</label>
                                               <div class="col-sm-10">
                                                   <select class="form-select">
                                                       <option>0 (Delete)</option>
                                                       <option selected>1</option>
                                                       <option>2</option>
                                                   </select>
                                               </div>
                                           </div>               
                                       </div>

                                       <div class="delivery_time">
                                           <label>Deliver every</label>
                                           <select class="form-select">
                                               <option>2 month (Most common)</option>
                                               <option>1 Year</option>
                                           </select>
                                       </div><br>

                                       <a href="" class="btn"> Subscribe Now</a>


                                       <!-- ---------subscribe details end--------- -->
                                    </div>
                           </div>
                        </div>
                        <div class="short-desc mb-30">
                        </div>
                        <div class="detail-extralink mb-50">
                           <div class="product-extra-link2">
                              <div class="updd475" style="width: 100%;">
                                 <!-- <div class="quantity-controls w-100 hover-up width100 common-button css-inc475" id="aquantitycontrols<?php //echo $pdetail['product_id']?>" style="display: inline-flex;;">
                                    <button class="quantity-decrease qtymode"  onclick="countIncreament(<?php //echo $pdetail['product_id']; ?>,1);"><span class="material-symbols-outlined">remove</span></button>
                                    <input type="text" class="quantity-input" id="qty<?php //echo $pdetail['product_id']; ?>" value="1">
                                    <button class="quantity-increase qtymode" onclick="countIncreament(<?php //echo $pdetail['product_id']; ?>,2);"><span class="material-symbols-outlined">add</span></button>
                                 </div> -->
                                 <div>
                                    <label style="display: inline-block; margin-right: 10px;"><strong>Quantity :</strong></label>
                                    <input type="number" class="quantity-input" name="qty" id="qty<?php echo $pdetail['product_id']; ?>" value="1" min="1" max="99" style="display:inline-block;">
                                 </div>
                              </div>
                              <a href="javascript:void(0);" title="Wishlist" class="wish-div product_save_for_later_btn" data-id="NDc1" onclick="saveToLaterpdp(<?php echo $pdetail['product_id'];?>);">
                              <span class="material-symbols-outlined idss0473 hovercdd">bookmark</span> 
                              &nbsp;Save for later
                              </a>
                               <!-- <a href="javascript:void(0);" onclick="saveToLater(<?php //echo $product['cart_id']?>);">Save for later</a>  -->                                          
                           </div>
                           <?php
                           $checkout_url = base_url('checkout') . '?product_id=' . $pdetail['product_id'];
                           ?>
                       
                           <!-- <div class="grid_offer_ad mt-20"> -->
                              <div class="row mt-20">
                                 <div class="col-md-6">
                                    <button class="btn w-100  uptos475 hover-up add-to-cart-button" id="addtobtn<?php echo $pdetail['product_id']; ?>"  onclick="addToCartFromProduct(<?php echo $pdetail['product_id']; ?>);return false;">Add to basket</button>
                                 </div>
                                 <div class="col-md-6">
                                
                                    <!-- <h4>Buy Now <span class="material-symbols-outlined"></span></h4> -->
                                     <?php if(isset($isCustomerLogin) && $isCustomerLogin==1) { ?>
                                          <button class="btn w-100  uptos475 hover-up"  onclick="buyNow(<?php echo $pdetail['product_id']; ?>);return false;">Buy Now</button>
                                     <?php } else{ 
                                      
                                       ?> <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#login-modal-user" class="btn w-100">Buy Now
                                           </a>
                                    <?php }?>    
                                
                                 </div>
                              </div>
                           </div>
                           </a>  
                           <!-- </div> -->
                        
                           <!-- ----------pack sizes start--------- -->
                           <div class="product_details_pack_sizes d-block mt-30">
                            <h4>Pack Sizes</h4>
                            <ul class="cust_select_lists">
                                <?php foreach ($items as $item) { ?>
                                    <li>
                                       <div class="row">
                                       <!-- <div class="col-md-6">   -->
                                        <a href="javascript:void(0);" 
                                           data-pack-size="<?php echo $item['pack_size']; ?>" 
                                           data-unit="<?php echo $item['units']; ?>"
                                           data-price="<?php echo $item['price']; ?>" 
                                           data-before-off-price="<?php echo $item['before_off_price']; ?>"
                                           tabindex="0" 
                                           class="pack-size-option">
                                            <div class="kg_name"><?php echo $item['pack_size'] . ' ' . $item['units']; ?></div>
                                            <div class="off_ad_btn">
                                                <div class="off_percent_ad">12% OFF</div>
                                                <div class="product-price">
                                                    <span>₹<span class="price841"><?php echo $item['price']; ?></span></span>&nbsp;&nbsp;
                                                    <strike>
                                                        <span style="font-size: 16px;font-weight: 400;color: #787878;">
                                                            <span style="font-size: 16px;font-weight: 500;color: #787878;">MRP ₹</span>
                                                            <span style="font-size: 16px;font-weight: 500;color: #787878;" class="beforeOffprice841"><?php echo $item['before_off_price']; ?></span>
                                                        </span>
                                                    </strike>
                                                </div>

                                                <div class="col-md-4">
                                                <div class="select_ad_btn" style="display: none;">
                                                    <span class="material-symbols-outlined">done</span>
                                                </div>
                                                </div>
                                            </div>
                                          </div>
                                        </a>
                                    </li>
                                <?php } ?>
                                <!-- Add more options here -->
                            </ul>
                        </div>
                           <!-- ----------pack sizes end--------- -->
                           <!-- -----------offer ad------------- -->
                           <span id="product_details_offer_ad"></span>
                           <div class="product_details_offer_ad mt-20">
                              <div class="heading_s1 text-center mb-30">
                                 <h4>Offers</h4>
                              </div>
                              <div class="cart_page">
                                 <ul>
                                    <li>
                                       <div class="ad_banner">
                                          <div class="ad_percent_strip"><img src="http://localhost/RDFPL_Lattest_BKP_12_April_2024/include/frontend/assets/imgs/theme/default_card_tag_icon.webp" alt=""></div>
                                          <div class="ad_headline">
                                             <p><?php echo (!empty($getOfferName)) ? $getOfferName[0]['offer_name'] : null;?></p>
                                          </div>

                                          <div class="ad_offer_percent">
                                             <h2><?php echo (!empty($getOfferName)) ? $getOfferName[0]['value'] : null;?></h2>
                                          </div>
                                          <div class="ad_offer_desc"><?php echo (!empty($getOfferName)) ? $getOfferName[0]['description'] : null;?></div>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <!-- -------------offer ad end--------- -->
                        </div>
                        <div class="font-md">
                           <ul class="mr-50 float-start">
                              <!--  <li class="mb-5">Type: <span class="text-brand">Skin care</span></li>
                                 <li class="mb-5">SKU:<span class="text-brand"> FG003794</span></li> -->
                              <!-- <li class="mb-5">Stock:<span class="text-brand"> </span></li> -->
                           </ul>
                        </div>
                     </div>
                     <!-- Detail Info -->
                  </div>
               </div>
               <div class="loader_id" id="475"></div>
               <div class="custom_hr"></div>
               <!-- ----------product details accordin------------- -->
               <div class="product_details_accordin">
                  <div class="product_details_main_heading">
                     <h3><?php echo isset($pdetail['product_name']) ? $pdetail['product_name'] : '' ;?></h3>
                  </div>
                  <?php
                     $serializedData = $pdetail['other_info'];
                     $other_info = unserialize($serializedData);
                     //print_r($other_info);
                     ?>
                  <div class="accordion" id="accordionExample">
                   <?php foreach ($other_info as $index => $item): ?>
                       <div class="accordion-item">
                           <h2 class="accordion-header">
                               <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $index ?>">
                                   <?= htmlspecialchars($item['heading']) ?>
                               </button>
                           </h2>
                           <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#accordionExample">
                               <div class="accordion-body">
                                   <p><?= htmlspecialchars($item['description']) ?></p>
                               </div>
                           </div>
                       </div>
                   <?php endforeach; ?>
               </div>

               </div>
               <!-- ---------------product details accordin end------------ -->
               <!-- --------------product details rating reviews---------------- -->
               <div class="product_details_rating_reviews mt-30 mb-30">
                  <div class="product_details_main_heading">
                     <h3>Rating and Reviews</h3>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="review_sec_left_sec">
                           <div class="total_reviews icon_fill">
                            <h3 class="text-brand">
                                <?php echo number_format($productRate['average_rating'], 1); ?> 
                                <i class="material-symbols-outlined">star</i>
                            </h3>
                            <p class="text-muted">
                                <?php echo $productRate['total_ratings']; ?> ratings &amp; <?php echo $productRate['total_reviews']; ?> reviews
                            </p>
                            <?php if ($productRate['total_ratings'] > 0): ?>
                                <?php
                                    $five_star_percentage = ($productRate['five_star'] / $productRate['total_ratings']) * 100;
                                    $four_star_percentage = ($productRate['four_star'] / $productRate['total_ratings']) * 100;
                                    $three_star_percentage = ($productRate['three_star'] / $productRate['total_ratings']) * 100;
                                    $two_star_percentage = ($productRate['two_star'] / $productRate['total_ratings']) * 100;
                                    $one_star_percentage = ($productRate['one_star'] / $productRate['total_ratings']) * 100;
                                ?>
                                <div class="progress mt-30">
                                    <span>5 star</span>
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $five_star_percentage; ?>%" aria-valuenow="<?php echo $five_star_percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?php echo number_format($five_star_percentage, 1); ?>%
                                    </div>
                                </div>
                                <div class="progress">
                                    <span>4 star</span>
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $four_star_percentage; ?>%" aria-valuenow="<?php echo $four_star_percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?php echo number_format($four_star_percentage, 1); ?>%
                                    </div>
                                </div>
                                <div class="progress">
                                    <span>3 star</span>
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $three_star_percentage; ?>%" aria-valuenow="<?php echo $three_star_percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?php echo number_format($three_star_percentage, 1); ?>%
                                    </div>
                                </div>
                                <div class="progress">
                                    <span>2 star</span>
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $two_star_percentage; ?>%" aria-valuenow="<?php echo $two_star_percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?php echo number_format($two_star_percentage, 1); ?>%
                                    </div>
                                </div>
                                <div class="progress mb-30">
                                    <span>1 star</span>
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $one_star_percentage; ?>%" aria-valuenow="<?php echo $one_star_percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?php echo number_format($one_star_percentage, 1); ?>%
                                    </div>
                                </div>
                            <?php else: ?>
                                <p>No ratings available for this product.</p>
                            <?php endif; ?>
                        </div>
                           <div class="custom_hr"></div>
                           <!-- <h4 class="text-center mt-30 mb-20">Highlights</h4>
                           <div class="circle_progress_bar d-flex">
                              <div class="progress_circle text-center">
                                 <svg viewBox="0 0 86 86">
                                    <circle fill="none" stroke="#eee" cx="43" cy="43" r="39" stroke-width="8px"></circle>
                                    <circle stroke="#5E9400" stroke-linecap="round" fill="none" cx="43" cy="43" r="39" stroke-width="8px" transform="rotate(-90 43 43)" style="stroke-dasharray: 245.044;stroke-dashoffset: 49.0088;"></circle>
                                    <text x="50%" y="50%" dy=".3em" text-anchor="middle" color="#606060" style="line-height: 18px;">4</text>
                                 </svg>
                                 <h4>Taste</h4>
                                 <p class="text-muted">136 Rating</p>
                              </div>
                              <div class="progress_circle text-center">
                                 <svg viewBox="0 0 86 86">
                                    <circle fill="none" stroke="#eee" cx="43" cy="43" r="39" stroke-width="8px"></circle>
                                    <circle stroke="#5E9400" stroke-linecap="round" fill="none" cx="43" cy="43" r="39" stroke-width="8px" transform="rotate(-90 43 43)" style="stroke-dasharray: 300.044;stroke-dashoffset: 49.0088;"></circle>
                                    <text x="50%" y="50%" dy=".3em" text-anchor="middle" color="#606060" style="line-height: 18px;">5</text>
                                 </svg>
                                 <h4>Texture</h4>
                                 <p class="text-muted">115 Rating</p>
                              </div>
                           </div> -->
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="review_sec_right_sec">
                           <h3>Product Reviews</h3>
                               <?php
                                 // Fetch only the first 2 reviews
                                 $limited_reviews = array_slice($reviews, 0, 2);
                                 ?>

                                 <?php if (!empty($limited_reviews)): ?>
                                     <?php foreach ($limited_reviews as $review): ?>
                                         <div class="rating_review_details_list">
                                             <div class="mt-10">
                                                 <div class="grid_product_rating">
                                                     <p><?php echo htmlspecialchars($review['cust_rate']); ?> <i class="material-symbols-outlined">star</i></p>
                                                 </div>
                                                 <h4><?php echo htmlspecialchars($review['comment']); ?></h4>
                                                 <div class="rating_review_author d-flex justify-content-between">
                                                     <p class="text-muted">
                                                         <?php echo htmlspecialchars($review['customer_name']); ?>, 
                                                         (<?php echo htmlspecialchars($this->common_model->dateDifference($review['add_date'])); ?> ago)
                                                     </p>
                                                   <?php $active_like = ($review['thumb_action'] == 1) ? 'active' : ''; ?>
                                                   <?php $active_dislike = ($review['thumb_action'] == 0) ? 'active' : ''; ?>

                                                   <div class="thumb_icon">
                                                       <span class="material-symbols-outlined thumb-icon <?php echo $active_like; ?>" id="like_<?php echo $review['rate_id']; ?>" onclick="thumbAction('<?php echo $review['rate_id']; ?>', 'like')">thumb_up</span>
                                                       <span class="material-symbols-outlined thumb-icon <?php echo $active_dislike; ?>" id="dislike_<?php echo $review['rate_id']; ?>" onclick="thumbAction('<?php echo $review['rate_id']; ?>', 'dislike')">thumb_down</span>
                                                   </div>

                                                 </div>
                                             </div>
                                         </div>
                                     <?php endforeach; ?>
                                 <?php else: ?>
                                     <p>No reviews available.</p>
                                 <?php endif; ?>

                            <!-- <h6 class="text-center"><a href="https://uat.rdfpl.com/rating-review-details"><u> View all 70 reviews &gt;</u></a></h6> -->
                        </div>

                        <a href="<?= base_url('rating-review-details/' . $pdetail['product_id']) ?>" class="pull-right">View more</a>
                     </div>
                  </div>
               </div>
                <?php print_r($pdetail->product_id); ?>
               <!-- --------------product details rating reviews end---------------- -->
               <div class="product-info" style="display:none;">
                  <div class="tab-style3">
                     <ul class="nav nav-tabs text-uppercase">
                        <li class="nav-item">
                           <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                        </li>
                     </ul>
                     <div class="tab-content shop_info_tab entry-main-content">
                        <div class="tab-pane fade show active" id="Description">
                           <div class="disc-div">
                              <h5 class="mt-30"></h5>
                              <br>
                              <p></p>
                              <hr class="wp-block-separator is-style-dots">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Product details   -->
               <div class="container popular_background">
                  <div class="section-title mt-10">
                     <h3 class="">Similar products</h3>
                  </div>
                  <div class="row">
                     <div class="col-lg-12 col-md-12 " data-wow-delay=".4s">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                           <div class="carausel-4-columns carausel-arrow-center slick-slider" id="carausel-4-columns-related">
                              <div class="slick-list draggable">
                                 <div class="slick-track" style="opacity: 1; width: 5652px; transform: translate3d(-1256px, 0px, 0px);">
                                    <?php echo  $this->load->view("frontend/component/productItemSlick",array('productItems'=>$simillerProduct,'pcol'=>5),true);?>
                                 </div>
                              </div>
                             
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- --------------you may like to more in--------- -->
               <div class="custom_hr"></div>
                  <div class="container popular_background d-none">
                     <div class="section-title mt-10">
                        <h3 class="">Popular products</h3>
                     </div>
                     <div class="row pop">
                        <div class="col-lg-12 col-md-12 " data-wow-delay=".4s">
                           <div class="carausel-4-columns-cover arrow-center position-relative">
                              <div class="carausel-4-columns carausel-arrow-center  slick-slider" id="carausel-4-columns-popular">
                                 <div class="slick-list draggable">
                                    <div class="slick-track" style="opacity: 1; width: 5652px; transform: translate3d(0px, 0px, 0px);">
                                        <?php echo  $this->load->view("frontend/component/productItemSlick",array('productItems'=>$simillerProduct,'pcol'=>5),true);?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               <!-- --------------you may like to more in--------- -->
               <div class="product_details_you_may_like_sec mt-30 mb-30 d-none">
                  <div class="product_details_main_heading text-center">
                     <h3>You may like to view more in</h3>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="product_details_you_may_like_inner_div">
                           <a href="">COUNTRY OF ORIGIN : India &gt;</a>
                           <a href="">FOOD PREFERENCE : Vegetarian &gt;</a>
                           <a href="">PRODUCT TYPE : Multipack &gt;</a>
                        </div>
                     </div>
                  </div>
                  <div class="container popular_background mt-30 mb-30">
                     <div class="product_details_you_may_like_info_sec">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="product_details_you_may_like_info_inner_div">
                                 <img src="https://www.bbassets.com/bb2assets/images/png/veg-placeholder.png">
                                 <div class="product_details_you_may_like_info_inner_right">
                                    <p>VIEW MORE PRODUCTS FROM CADBURY PERK</p>
                                    <a href="">View All</a>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="product_details_you_may_like_info_inner_div">
                                 <img src="https://www.bbassets.com/bb2assets/images/png/veg-placeholder.png">
                                 <div class="product_details_you_may_like_info_inner_right">
                                    <p>VIEW MORE PRODUCTS FROM CHOCOLATES</p>
                                    <a href="">View All</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- --------------you may like to more in end--------- -->
               <!-- -------------more information---------- -->
               <div class="product_details_more_info mt-50 mb-30 d-none">
                  <div class="product_details_main_heading">
                     <h4>More Information</h4>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="list_heading">
                           <a href="">Snacks &amp; Branded Foods</a> &gt; <a href="">Chocolates &amp; Candies</a>
                        </div>
                        <div class="list_subheadings">
                           <a href="">Chocolates</a> | <a href="">Gift Boxes</a>
                        </div>
                     </div>
                     <div class="col-lg-12 mt-10">
                        <div class="list_heading">
                           <a href="">Brands</a> 
                        </div>
                        <div class="list_subheadings">
                           <a href="">Cadbury Perk</a> | <a href="">Cadbury Perk Chocolates</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- ---------------more information end--------------- -->
            </div>
         </div>
      </div>
   </div>
</main>
<?php $this->load->view('frontend/footer'); ?>

<script type="text/javascript">
$(document).ready(function() {
    // Set default price and MRP price
    var defaultPrice = $('#current-price').text();
    var defaultMrpPrice = $('#current-mrp').text();

    $('.pack-size-option').on('click', function() {
        // Remove 'active' class from all options and add it to the clicked one
        $('.pack-size-option').removeClass('active');
        $(this).addClass('active');
        var newPrice = $(this).data('price');
        var beforeOffPrice = $(this).data('before-off-price');

        // Update the price and MRP price sections
        $('#current-price').text(newPrice);
        $('#current-mrp').text(beforeOffPrice);

        // Show the 'done' icon for the selected option
        $('.select_ad_btn').hide();
        $(this).find('.select_ad_btn').show();
    });

    // Initialize visibility of 'done' icon for the default price
    $('.pack-size-option').each(function() {
        if ($(this).data('price') == defaultPrice) {
            $(this).addClass('active');
            $(this).find('.select_ad_btn').show();
        } else {
            $(this).find('.select_ad_btn').hide();
        }
    });
});

function countIncreament(product_id,type){
   var productItemId=$('#productItemId'+product_id).val();
    var qty=$('#qty'+product_id).val();
    
    if(type==2){
      qty=parseInt(qty)+1;
    }
    else if(type==1){
      if(parseInt(qty) >1){
        qty=parseInt(qty)-1;
      }else{
        $('#addtobtn'+product_id).css('display','inline-block');
        $('#aquantitycontrols'+product_id).hide();
      }

    }
    
    $('#qty'+product_id).val(qty);
}

function buyNow(product_id){

   let base_url='<?php echo base_url('setbuynowdetail')?>';
   var qty=$('#qty'+product_id).val();
   let varient_id=$('#productItemId' + product_id).val();
   
   $.ajax({
      url: base_url,
      type: 'POST',
      dataType: 'JSON',
      data: ({ 'product_id': product_id ,'varient_id':varient_id,'qty':qty}),
      success: function (res) {
         window.location='<?php echo base_url('checkout')?>';
      }
   });
}
</script>
<script>
function thumbAction(rate_id, action) {
    $.ajax({
        url: '<?php echo site_url('Product/update_thumbs_action'); ?>',
        type: 'POST',
        data: { rate_id: rate_id, action: action },
        dataType: 'json',
        success: function(response) {
            console.log('ss=>', response);
            if (response.status === 'success') {
                // $('.thumb-icon').removeClass('active');
                if (action === 'like') {
                    $('#like_' + rate_id).addClass('active');

                     $('#dislike_' + rate_id).removeClass('active');
                } else {
                    $('#dislike_' + rate_id).addClass('active');
                     $('#like_' + rate_id).removeClass('active');

                }
            } else {
                console.error('Error: ' + response.message);
            }
        }
    });
}
</script>
