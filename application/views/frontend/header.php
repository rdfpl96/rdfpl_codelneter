<?php
   $custDetail=getCookies('customer');

   $customerId=isset($custDetail['customer_id']) ? $custDetail['customer_id'] : 0 ;
   $record_num = end($this->uri->segment_array());
   
   $headerArray=array('checkout','delivery-address','payment-option');
   $isheader=false;
   if(in_array($record_num,$headerArray)){
      $isheader=true;
   }
   
   $query= "select c_fname from tbl_customer where customer_id='$customerId'";
   $result = $this->db->query($query, array($customerId))->row();
   //print_r($result->c_fname);
   $tcategories=$this->customlibrary->getTopCategory();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Royal Dryfruits</title>
      <meta http-equiv="x-ua-compatible" content="ie=edge" />
      <meta name="description" content="" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta property="og:title" content="" />
      <meta property="og:type" content="" />
      <meta property="og:url" content="" />
      <meta property="og:image" content="" />
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>include/frontend/assets/imgs/theme/logo.png" />
      <!-- Template CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo base_url();?>include/frontend/assets/css/plugins/animate.min.css" />
      <link rel="stylesheet" href="<?php echo base_url();?>include/frontend/assets/css/main2cc5.css?v=5.6" />
      <link rel="stylesheet" href="<?php echo base_url();?>include/frontend/assets/css/custom-css.css" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
       <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUksStRc1nu8vDYcb8245lsuPz7l9GUg0&libraries=places" async defer></script>

 
   </head>
   <body>
      <div class="loading_full" style="display: none;">Loading&#8230;</div>
      <div id="snackbar"></div>

      <header class="header-area header-style-1 header-height-2 <?php echo $isheader ? 'd-none' : ''; ?>">
         <div class="header-middle header-middle-ptb-1 d-none d-lg-block sticky-bar">
            <div id="preloader-active" class="loader"></div>
            <div class="loader_static_line"></div>
            <div class="container">
               <div id="backdrop" class="backdrop"></div>
               <!-- style="width: 22% !important; -->
               <div class="header-wrap">
                  <div class="logo logo-width-1">
                     <a href="<?php echo base_url('')?>"><img src="<?php echo base_url()?>/include/frontend/assets/imgs/theme/logo.png" class="desk_logo" alt="logo"></a>
                     <div class="cat" style="position: absolute; bottom: 10px; z-index: 1; width: 280px;">

                        <?php echo $this->customlibrary->menubar(); ?>
                       
                     </div>
                  </div>
                  <div class="header-right">
                     <div class="search-style-2">
                        <form action="#" onsubmit="return false;">
                           <input type="text" id="searchproduct" class="search-me" placeholder="Search for Products..." autocomplete="off" onkeyup="searchProduct()">
                        </form>
                        <div class="search-result-box" id="searchResult">
                           <div class="search-product-list"></div>
                        </div>
                     </div>
                     <div class="header-action-right">
                        <div class="header-action-2">
                           <div class="location">
                              <div class="drop_location" id="drop_location">
                                 <h3>
                                    <span class="material-symbols-outlined">explore</span>&nbsp;
                                    Select Location
                                 </h3>
                              </div>
                               <div class="location_collpase hidden" id="location_details">
                                <div class="header_location">
                                    <h2>Select a location for delivery</h2>
                                    <p class="text-muted">Choose your address location to see product availability and delivery options</p>
                                </div>
                                <div class="location_search_box">
                                    <input type="text" id="location_search_input" class="form-control" placeholder="Search for area or Street name">
                                    
                                    <!-- <div class="location_list" style="display: none;">
                                        <ul id="location_results"></ul>
                                    </div> -->
                                    <div id="location_details">
                                      <p id="location_name"></p>
                                      <p id="location_address"></p>
                                      <p id="postal_code"></p>
                                    </div>
                                </div>
                            </div>
                           </div>
                           <!-- wiscout -->
                          
                           <div class="wiscal">  
                                <div id="wishit">  
                                  <div class="header-action-icon-2 header_wish_style">
                                  <?php if(isset($custDetail['isCustomerLogin']) && $custDetail['isCustomerLogin']==1) { ?>
                                    <a href="<?php echo base_url('wishlist');?>">
                                        <img class="svgInject" alt="Wishlist" src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-heart.svg" />
                                        <span class="pro-count blue" id="wishitcount"><?php echo $this->customlibrary->getWishListCount($customerId);?></span>
                                    </a>
                                  <?php } else{ ?>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#login-modal-user">
                                        <img class="svgInject" alt="Wishlist" src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-heart.svg" />
                                        <span class="pro-count blue">0</span>
                                    </a>

                                 <?php }?>  
                            
                                   </div>
                                </div>
                            </div>

                           <div class="header-action-icon-2 header_cart_style">
                            <?php if(isset($custDetail['isCustomerLogin']) && $custDetail['isCustomerLogin']==1) { ?>
                                <!-- For logged-in users, make the cart icon clickable -->
                                <a class="mini-cart-icon" href="<?php echo base_url('cart');?>">
                                    <img alt="Cart" src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-cart.svg" />
                                    <span class="pro-count blue total-items"><?php echo $this->customlibrary->total_items($customerId) ?: 0;?></span>
                                </a>
                            <?php } else { ?>
                                <!-- For guest users, open the login modal -->
                                <a class="mini-cart-icon" data-bs-toggle="modal" data-bs-target="#login-modal-user">
                                    <img alt="Cart" src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-cart.svg" />
                                    <span class="pro-count blue total-items"><?php echo $this->cart->total_items() ?: 0;?></span>
                                </a>
                            <?php } ?>
                        </div>
                           <div class="header-action-icon-2 login_sign_up_btn">
                              <?php if(isset($custDetail['isCustomerLogin']) && $custDetail['isCustomerLogin']==1) { 
                                 //print_r($custDetail);
                                 ?>

                                    <!-- Default dropend button -->
                                       <div class="user_icon_group">
                                           <div class="user_icon" data-bs-toggle="dropdown" aria-expanded="false">
                                               <span class="material-symbols-outlined">account_circle </span>
                                               <p style="text-align:center;margin-top:-10px;color:#808080"><?php echo $result->c_fname ?></p>
                                           </div>
                                           
                                           <ul class="dropdown-menu">
                                                <li><a href="<?php echo base_url('account');?>">My Account</a></li>
                                                <li><a class="d-flex justify-content-between" href="<?php echo base_url('cart');?>">My Basket <span class="pro-count blue total-items"><?php echo $this->customlibrary->total_items($customerId) ?: 0;?></span></a></li>
                                                <li><a href="<?php echo base_url('my-order');?>">My Orders</a></li>
                                                <li><a href="">My Smart Basket</a></li>
                                                <!-- <li><a href="">My Wallet <span></span></a></a></li> -->
                                                <li><a href="<?php echo base_url('contact');?>">Contact us</a></li>
                                                <li><a href="<?php echo base_url('logout')?>" class="logout-account">Logout</a></li>
                                          </ul>
                                      </div>
                                    
                              <?php }else{  ?>
                                      <a class="sign_btn" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#login-modal-user">
                                       <span class="lable ml-0">Login/Sign Up</span>
                                    </a>  
                              <?php }  ?>

                                </div>
                           </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="header-bottom header-bottom-bg-color">
            <!-- krish -->
            <div class="container">
               <div class="header-wrap header-space-between position-relative">
                  <div class="logo logo-width-1 d-block d-lg-none">
                     <a href="<?php echo base_url('');?>"><img src="<?php echo base_url('');?>/include/frontend/assets/imgs/theme/logo.png" alt="logo"></a>
                  </div>
                  <div class="header-nav d-none d-lg-flex">
                     <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                           <ul class="category-menu">
                              <li class="hot-deals"><a href="<?php echo base_url('shop/beauty-hygiene')?>">Beauty & Hygiene</a></li>
                              <li><a href="<?php echo base_url('shop');?>">Shop</a></li>
                              <li><a href="<?php echo base_url('shop/foodgrains-oils')?>">Foodgrains &amp; Oils</a></li>
                              <li><a href="<?php echo base_url('shop/dry-fruits-nuts')?>">Dry Fruits &amp; Nuts</a></li>
                              <li class="more-categories">
                                 <a class="active" href="#">&gt;&gt;</a>
                                 <ul class="sub-menu">
                                    <?php 
                                          if(count($tcategories)>0){
                                             foreach($tcategories as $record){
                                                echo ' <li><a href="'.base_url('shop/'.$record['slug']).'">'.$record['category'].'</a></li>';
                                             }
                                          }
                                    ?>
                                 </ul>
                              </li>
                           </ul> 
                        </nav>
                     </div>
                  </div>

                  <div class="hotline d-none d-lg-flex">
                     <div class="main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                           <ul class="d-inline-flex">
                              <li><a href=""><img alt="Smart Basket" src="<?php echo base_url('');?>/include/frontend/assets/imgs/theme/smart_bskt.png"></a></li>
                              <li><a href=""><img alt="Offers" src="<?php echo base_url('');?>/include/frontend/assets/imgs/theme/offers.png"></a></li>
                           </ul>
                        </nav>
                     </div>
                  </div>

                  <div class="header-action-icon-2 d-block d-lg-none">
                     <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                     </div>
                  </div>
                  <div class="header-action-right d-block d-lg-none">
                     <div class="header-action-2">
                        <div class="wismob">
                           <div id="wissmob">
                              <div class="header-action-icon-2">
                                 <a href="https://uat.rdfpl.com/wishlist">
                                 <img alt="Wishlist" src="<?php echo base_url('');?>/include/frontend/assets/imgs/theme/icons/icon-heart.svg">
                                 <span class="pro-count white">0</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                        <div class="header-action-icon-2">
                           <a href="javascript:void(0);" id="cartDropdown" class="mini-cart-icon">
                           <img alt="Nest" src="<?php echo base_url('');?>/include/frontend/assets/imgs/theme/icons/icon-cart.svg">
                           <span class="pro-count white total-items">4</span></a>
                           <div class="cart-display">
                              <div class="loaderdiv-header"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- <div class="errmess_comm"></div> -->
      </header>


      <div class="mobile-header-active mobile-header-wrapper-style">
         <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
               <div class="mobile-header-logo">
                  <a href="<?php echo base_url('');?>"><img src="<?php echo base_url('');?>/include/frontend/assets/imgs/theme/logo.png" alt="logo"></a>
               </div>
               <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                  <button class="close-style search-close">
                  <i class="icon-top"></i>
                  <i class="icon-bottom"></i>
                  </button>
               </div>
            </div>
            <div class="mobile-header-content-area">
               <div class="mobile-search search-style-3 mobile-header-border">
                  <form action="javascript:void(0);">
                     <input type="text" class="cal-focus" placeholder="Search for items…" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTopsearch" aria-controls="offcanvasTopsearch" readonly="">
                     <button data-bs-toggle="offcanvas" class="cal-focus" data-bs-target="#offcanvasTopsearch" aria-controls="offcanvasTopsearch"><i class="fi-rs-search"></i></button>
                  </form>
               </div>
               <div class="mobile-menu-wrap mobile-header-border">
                  <!-- mobile menu start -->
                  <nav>
                     <ul class="mobile-menu font-heading">
                        <li><a href="#">Hot Deals</a></li>
                        <li><a href="https://uat.rdfpl.com/about-us">About us</a></li>
                        <li class="menu-item-has-children">
                           <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span>
                           <a href="#">shop</a>
                           <ul class="dropdown" style="display: none;">
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/beauty-hygiene/?d=MTc=">Beauty &amp; Hygiene</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/beauty-hygiene/hair-care/?d=NDM=">Hair Care</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/beauty-hygiene/hair-care/hair-oil/?d=MzY=">Hair Oil</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/beauty-hygiene/hair-care/hair-color/?d=Mzc=">Hair Color</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/beauty-hygiene/skin-care/?d=NDQ=">Skin care</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/beauty-hygiene/skin-care/face-care/?d=MzU=">Face care</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/beauty-hygiene/skin-care/test/?d=NjQ=">Test</a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/gourmet-world-food/?d=MTY=">Gourmet World Food</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/gourmet-world-food/chocolates-biscuits/?d=NDI=">Chocolates &amp; Biscuits</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/gourmet-world-food/chocolates-biscuits/wafer-biscotti/?d=MzQ=">Wafer Biscotti</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/gourmet-world-food/chocolates-biscuits/chocolates/?d=NjI=">Chocolates</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/gourmet-world-food/chocolates-biscuits/candy-jelly/?d=NjU=">Candy &amp; jelly</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/gourmet-world-food/drinks-beverages/?d=NDg=">Drinks &amp; Beverages</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/gourmet-world-food/drinks-beverages/coffee-premix/?d=NDg=">Coffee &amp; Premix</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/gourmet-world-food/saucesspreads-dips/?d=NTE=">Sauces,Spreads &amp; Dips</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/gourmet-world-food/saucesspreads-dips/chocolate-peanut-spreads/?d=NjE=">Chocolate, Peanut Spreads</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/gourmet-world-food/brand-snacks-chips/?d=NTI=">Brand Snacks &amp; Chips</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/gourmet-world-food/brand-snacks-chips/trail-cocktail-mixes/?d=NjM=">Trail &amp; CocKtail Mixes</a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/spices-condiments/?d=Mw==">Spices &amp; Condiments</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class=""><a href="https://uat.rdfpl.com/shop/spices-condiments/whole-spices/?d=Nw==">Whole Spices</a>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/spices-condiments/powdred-spices/?d=OA==">Powdred Spices</a>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/spices-condiments/blended-masalas/?d=OQ==">Blended Masalas</a>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/spices-condiments/herbs-seasoning/?d=MTA=">Herbs &amp; Seasoning</a>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/spices-condiments/cooking-pastes/?d=MTE=">Cooking Pastes</a>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/gift-items/?d=MTA=">Gift Items</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/gift-items/gift-hamper-box/?d=MzY=">Gift Hamper &amp; box</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/gift-items/gift-hamper-box/assorted-gift-box/?d=MjQ=">Assorted Gift Box</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/gift-items/gift-hamper-box/dryfruits-gift-box/?d=MjU=">DryFruits Gift Box</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/gift-items/gift-baskets/?d=Mzc=">Gift Baskets</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/gift-items/gift-baskets/dryfruits-gift-baskets/?d=MjY=">DryFruits Gift Baskets</a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/pooja-samagri-salt-sugar-jaggery/?d=NQ==">Pooja Samagri, Salt, Sugar &amp; Jaggery</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class=""><a href="https://uat.rdfpl.com/shop/pooja-samagri-salt-sugar-jaggery/pooja-samagri/?d=MjI=">Pooja Samagri</a>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/dried-vegetables/?d=OA==">Dried vegetables</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class=""><a href="https://uat.rdfpl.com/shop/dried-vegetables/vegetables/?d=Mjg=">Vegetables</a>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/beverages/?d=NA==">Beverages</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/beverages/tea-coffee/?d=MTM=">Tea &amp; Coffee</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/beverages/tea-coffee/exotic-flavoured-tea/?d=MjE=">Exotic &amp; Flavoured Tea</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/beverages/tea-coffee/green-tea/?d=MjI=">Green Tea</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/beverages/tea-coffee/leaf-dust-tea/?d=MjM=">Leaf &amp; Dust tea</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/beverages/tea-coffee/instant-coffee/?d=NDc=">Instant Coffee</a></li>
                                       </ul>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/beverages/fruit-juices-drinks/?d=MTU=">Fruit Juices &amp; Drinks</a>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/beverages/energy-soft-drinks/?d=MTY=">Energy &amp; Soft Drinks</a>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/grocery-home-baking/?d=Nw==">Grocery &amp; Home Baking</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class=""><a href="https://uat.rdfpl.com/shop/grocery-home-baking/baking/?d=Mjc=">Baking</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/grocery-home-baking/salt--suger-jaggery/?d=MzQ=">Salt , Suger &amp; Jaggery</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/grocery-home-baking/salt--suger-jaggery/sugar/?d=NDE=">Sugar</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/grocery-home-baking/salt--suger-jaggery/jaggery/?d=NTY=">Jaggery</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/grocery-home-baking/salt--suger-jaggery/salt/?d=NTc=">Salt</a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/?d=Ng==">Snacks &amp; Branded Foods</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class=""><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/snacks/?d=MjY=">Snacks</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/ready-to-cook-eat/?d=Mzk=">Ready To CooK &amp; Eat</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/ready-to-cook-eat/papad-mangodi/?d=Mjg=">Papad &amp; Mangodi</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/ready-to-cook-eat/instant-mix/?d=Mjk=">Instant Mix</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/ready-to-cook-eat/papad-ready-to-fry/?d=NjA=">Papad &amp; Ready To Fry</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/snacks-namkeen/?d=NDA=">Snacks &amp; Namkeen</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/snacks-namkeen/ready-snacks/?d=MzE=">Ready Snacks</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/snacks-namkeen/namkeen/?d=MzI=">Namkeen</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/indian-mithai/?d=NDE=">Indian Mithai</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/indian-mithai/packed-sweets/?d=MzM=">Packed Sweets</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/pickles-chutney/?d=NDU=">Pickles &amp; Chutney</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/pickles-chutney/pickle/?d=Mzg=">Pickle</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/biscuits-cookies/?d=NDY=">Biscuits &amp; Cookies</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/snacks-branded-foods/biscuits-cookies/cookies/?d=Mzk=">Cookies</a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/foodgrains-oils/?d=MQ==">Foodgrains &amp; Oils</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/foodgrains-oils/atta-flours-sooji/?d=MQ==">Atta, Flours &amp; Sooji</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/atta-flours-sooji/atta-whole-wheat/?d=MzA=">Atta Whole Wheat</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/atta-flours-sooji/wheat-flours/?d=NDM=">Wheat Flours</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/atta-flours-sooji/flours/?d=NDQ=">Flours</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/atta-flours-sooji/sooji/?d=NDU=">Sooji</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/atta-flours-sooji/cereals-milets/?d=NTE=">Cereals &amp; Milets</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/atta-flours-sooji/barleys/?d=NTQ=">Barleys</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/atta-flours-sooji/besans/?d=NTk=">Besans</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/foodgrains-oils/pulses-beans/?d=Mg==">Pulses &amp; Beans</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/pulses-beans/toor-chana-moong-dal/?d=MTk=">Toor, Chana &amp; Moong Dal</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/pulses-beans/urad-other-dals/?d=MjA=">Urad &amp; Other Dals</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/foodgrains-oils/edible-oils-ghee/?d=Mw==">Edible Oils &amp; Ghee</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/edible-oils-ghee/oil/?d=NDY=">Oil</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/edible-oils-ghee/ghee/?d=NTg=">Ghee</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/foodgrains-oils/rice-rice-products/?d=MzU=">Rice &amp; Rice Products</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/rice-rice-products/basmati-rice/?d=NDA=">Basmati Rice</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/rice-rice-products/poha/?d=NTI=">Poha</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/rice-rice-products/rice/?d=NTM=">Rice</a></li>
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/rice-rice-products/rice-flours/?d=NTU=">Rice Flours</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/foodgrains-oils/mukhwas/?d=NDc=">Mukhwas</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/foodgrains-oils/mukhwas/churan/?d=NDI=">Churan</a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/ayurvedic-herbs-seeds/?d=OQ==">Ayurvedic Herbs &amp; Seeds</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class=""><a href="https://uat.rdfpl.com/shop/ayurvedic-herbs-seeds/herbal-seeds/?d=Mjk=">Herbal Seeds</a>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/ayurvedic-herbs-seeds/raw-herbs/?d=MzA=">Raw Herbs</a>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/ayurvedic-herbs-seeds/herbal-powders/?d=MzE=">Herbal Powders</a>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/ayurvedic-herbs-seeds/health-supplements/?d=MzI=">Health Supplements</a>
                                    </li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/dry-fruits-nuts/?d=Mg==">Dry Fruits &amp; Nuts</a>
                                 <ul class="dropdown" style="display: none;">
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/dry-fruits-nuts/nuts/?d=NA==">Nuts</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/dry-fruits-nuts/nuts/foxnuts/?d=NDk=">Foxnuts</a></li>
                                       </ul>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/dry-fruits-nuts/dehydrated-fruits/?d=NQ==">Dehydrated Fruits</a>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/dry-fruits-nuts/berries-raisins/?d=Ng==">Berries &amp; Raisins</a>
                                    </li>
                                    <li class=""><a href="https://uat.rdfpl.com/shop/dry-fruits-nuts/dates/?d=MTk=">Dates</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><a href="https://uat.rdfpl.com/shop/dry-fruits-nuts/other-dryfruits/?d=NTA=">Other Dryfruits</a>
                                       <ul class="dropdown" style="display: none;">
                                          <li><a href="https://uat.rdfpl.com/shop/dry-fruits-nuts/other-dryfruits/saffron/?d=NTA=">Saffron</a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                        <li><a href="https://uat.rdfpl.com/blog">Blogs</a></li>
                        <li><a href="https://uat.rdfpl.com/contact">Contact</a></li>
                     </ul>
                  </nav>
                  <!-- mobile menu end -->
               </div>
               <div class="mobile-header-info-wrap ">
                  <div class="single-mobile-header-info1">
                     <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#login-modal-user"><span class="lable ml-0"><i class="fi-rs-user"></i> Login / Sign Up</span></a> 
                  </div>
                  <div class="single-mobile-header-info2">
                     <a href="#"><i class="fi-rs-headphones"></i>&nbsp;&nbsp;+91 96499-99100</a>
                  </div>
               </div>
               <div class="mobile-social-icon mb-50">
                  <h6 class="mb-15">Follow Us</h6>
                  <a href=""><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/icons/icon-facebook-white.svg" alt=""></a>
                  <a href="#"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/icons/icon-twitter-white.svg" alt=""></a>
                  <a href="#"><img src="https://uat.rdfpl.com/include/frontend/assets/imgs/theme/icons/linkedin.svg" alt=""></a>
               </div>
               <div class="site-copyright">© 2024 Royal Dryfruit Private Limited All rights reserved</div>
            </div>
         </div>
      </div>
      <!--End header-->
      <!-- ===========mobile search============= -->
      <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTopsearch" aria-labelledby="offcanvasTopLabel">
         <div class="offcanvas-header">
            <div class="mobile-search search-style-3 mobile-header-border">
               <form action="javascript:void(0);">
                  <input type="text" placeholder="Search for items…" id="searchbar" class="search-me-mob" autocomplete="off"/>
                  <button>
                  <i class="fi-rs-search"></i>
                  </button>
               </form>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <div class="offcanvas-body">
            <div class="mobile_search_list">
               <ul class="search-product-list-mob"> </ul>
               <?php 
                  if(isset($menus) && $menus!=array()){
                      ?>
               <ul>
                  <div class="list_tagline">
                     <p>Top Searches</p>
                  </div>
                  <?php 
                     foreach(array_reverse($menus) as $key=>$values){
                      ?>
                  <li><a href="<?php echo base_url('shop/'.$values['ci_cat_name']).'/?d='.base64_encode($values['cat_id']);?>"><?php echo $values['category'];?> <span><i class="bi bi-arrow-up-right"></i></span></a></li>
                  <?php
                     }
                     
                     ?>
               </ul>
               <?php 
                  }
                  ?>
            </div>
         </div>
      </div>
      <!-- ================mobile search end============ -->
     
      <?php $this->load->view('frontend/component/login');?>
      