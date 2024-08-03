<?php

$this->load->view('frontend/header');
// echo '<pre>'; 
// print_r($_SESSION);
// exit();
?>

<?php
$max_price = $price_range['max_price'];
$min_price = $price_range['min_price'];
$num_ranges = 8;
$range_step = 100;
$start_with = $min_price + 10;

$price_ranges = [];
for ($i = 0; $i < $num_ranges; $i++) {
   $start = $start_with + ($i * $range_step);
   $end = $start + $range_step;
   $price_ranges[] = ['start' => round($start), 'end' => round($end)];
}


$lastRange = round($end);
?>
<main class="main shop_main_background" style="transform: none;">
   <div class="page-call" style="transform: none;">
      <div id="page-act" style="transform: none;">
         <div class="page-header">
            <div class="container">
               <div class="archive-header">
                  <div class="row align-items-center">
                     <div class="col-xl-9">
                        <div class="breadcrumb">
                           Home<span></span><?php echo isset($bread) ? $bread : ""; ?>
                        </div>
                     </div>
                     <div class="col-xl-3 text-end d-none d-xl-block"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container" style="transform: none;">
            <div class="row flex-row-reverse" style="transform: none;">
               <div class="shop-product-fillter" style="transform: none;">
                  <div class="totall-product">
                     <p style="color:black;">We found <strong class="text-brand"><?php echo isset($productCount) ? $productCount : 0; ?></strong> items for you!</p>

                     <div class="filters_result pt-10 d-none">
                        <!-- <p>Filters: </p> -->
                        <ul class="tags-list">
                           <li class="hover-up">
                              <a href="#" style="background: #ea6d6d;color: #fff;border-color: #ea6d6d;">Clear</a>
                           </li>
                           <li class="hover-up">
                              <a href="#">Cabbage<i class="fi-rs-cross ml-10"></i></a>
                           </li>
                           <li class="hover-up">
                              <a href="#">Cabbage<i class="fi-rs-cross ml-10"></i></a>
                           </li>
                           <li class="hover-up">
                              <a href="#">Cabbage<i class="fi-rs-cross ml-10"></i></a>
                           </li>
                           <li class="hover-up">
                              <a href="#">Cabbage<i class="fi-rs-cross ml-10"></i></a>
                           </li>
                        </ul>
                     </div>
                  </div>

                  <div class="sort-by-product-area" style="transform: none;">
                     <!-- <p style="color:black;"><b>Filter</b></p>&nbsp;&nbsp;&nbsp; -->
                     <div class="sort-by-cover">
                        <select type="type" class="form-select single-select float-sm-end mobile-sort sort-by-filter" id="my-drop-down-select-element-id" name="searchbyselect" onchange="searchBySelection();">
                           <option value="">Relevance</option>
                           <!-- <option value="latest">Latest</option> -->
                           <option value="low_to_high">Price: Low to High</option>
                           <option value="high_to_low">Price: High to Low</option>
                           <!-- <option value="best_selling">Best Selling</option> -->
                           <!--  <option value="A_Z">Title(A-Z)</option>
                           <option value="Z_A">Title(Z-A)</option> -->
                        </select>
                     </div>
                     <div class="shop_mobile_filter" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                        <div class="btn_filter"><span class="material-symbols-outlined">tune</span>&nbsp;&nbsp; Filter</div>
                     </div>
                     <!-- =============mobile filter sidebar============ -->
                     <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel" style="transform: none;">
                        <div class="offcanvas-header">
                           <h5 id="offcanvasTopLabel">Filter</h5>
                           <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body" style="transform: none;">
                           <!-- ------------filter body---------------- -->
                           <div class="col-lg-1-5 primary-sidebar sticky-sidebar sticky_sidebar_desktop mobile_sidebar_filter" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                              <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 0px; position: static; transform: none;">
                                 <h5 class="section-title style-1 mb-30">Shop by Category</h5>
                                 <div class="sidebar-widget widget-category-2 mb-30">
                                    <div class="sidebar2">
                                       <div class="category-list">
                                          <h4>Gourmet World Food</h4>
                                          <ul>
                                             <li><a href="javascript:void(0);" data-href="https://uat.rdfpl.com/shop/dry-fruits-nuts/nuts/?d=NA==" class="filterCategory"><span>Nuts</span></a></li>
                                             <li><a href="javascript:void(0);" data-href="https://uat.rdfpl.com/shop/dry-fruits-nuts/dehydrated-fruits/?d=NQ==" class="filterCategory"><span>Dehydrated Fruits</span></a></li>
                                             <li><a href="javascript:void(0);" data-href="https://uat.rdfpl.com/shop/dry-fruits-nuts/berries-raisins/?d=Ng==" class="filterCategory"><span>Berries &amp; Raisins</span></a></li>
                                             <li><a href="javascript:void(0);" data-href="https://uat.rdfpl.com/shop/dry-fruits-nuts/dates/?d=MTk=" class="filterCategory"><span>Dates</span></a></li>
                                             <li><a href="javascript:void(0);" data-href="https://uat.rdfpl.com/shop/dry-fruits-nuts/other-dryfruits/?d=NTA=" class="filterCategory"><span>Other Dryfruits</span></a></li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                                 <a class="shop-filter-toogle" href="">
                                    Product Rating
                                    <i class="fi-rs-angle-small-down angle-down"></i>
                                    <i class="fi-rs-angle-small-up angle-up"></i>
                                 </a>
                                 <div class="shop-product-fillter-header">
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input product-rating-filter class-rating-desk5" type="checkbox">
                                          <label class="form-check-label" for="exampleCheckbox-che-5">
                                             <span class="material-symbols-outlined fill_star">star</span>
                                             <span class="material-symbols-outlined fill_star">star</span>
                                             <span class="material-symbols-outlined fill_star">star</span>
                                             <span class="material-symbols-outlined fill_star">star</span>
                                             <span class="material-symbols-outlined fill_star">star</span>
                                          </label>
                                       </div>
                                    </div>
                                    <div class="list-group">
                                       <div class="list-group-item ">
                                          <input class="form-check-input product-rating-filter class-rating-desk5" type="checkbox">
                                          <label class="form-check-label" for="exampleCheckbox-che-5">
                                             <span class="material-symbols-outlined fill_star">star</span>
                                             <span class="material-symbols-outlined fill_star">star</span>
                                             <span class="material-symbols-outlined fill_star">star</span>
                                             <span class="material-symbols-outlined fill_star">star</span>
                                          </label>
                                       </div>
                                    </div>
                                    <div class="list-group">
                                       <div class="list-group-item ">
                                          <input class="form-check-input product-rating-filter class-rating-desk5" type="checkbox">
                                          <label class="form-check-label" for="exampleCheckbox-che-5">
                                             <span class="material-symbols-outlined fill_star">star</span>
                                             <span class="material-symbols-outlined fill_star">star</span>
                                             <span class="material-symbols-outlined fill_star">star</span>
                                          </label>
                                       </div>
                                    </div>
                                    <div class="list-group">
                                       <div class="list-group-item ">
                                          <input class="form-check-input product-rating-filter class-rating-desk5" type="checkbox">
                                          <label class="form-check-label" for="exampleCheckbox-che-5">
                                             <span class="material-symbols-outlined fill_star">star</span>
                                             <span class="material-symbols-outlined fill_star">star</span>
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                                 <a class="shop-filter-toogle" href="">
                                    Brands
                                    <i class="fi-rs-angle-small-down angle-down"></i>
                                    <i class="fi-rs-angle-small-up angle-up"></i>
                                 </a>
                                 <div class="shop-product-fillter-header">
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input type="text" name="" class="form-control filter_search" placeholder="Search here">
                                       </div>
                                    </div>
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input price-range class-price-desk0" type="checkbox">
                                          <label class="form-check-label">
                                             <span> Amar</span>
                                          </label>
                                       </div>
                                    </div>
                                    <!--list-group end-->
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input price-range class-price-desk0" type="checkbox">
                                          <label class="form-check-label">
                                             <span> Amar</span>
                                          </label>
                                       </div>
                                    </div>
                                    <!--list-group end-->
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input price-range class-price-desk0" type="checkbox">
                                          <label class="form-check-label">
                                             <span> Amar</span>
                                          </label>
                                       </div>
                                    </div>
                                    <!--list-group end-->
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input price-range class-price-desk0" type="checkbox">
                                          <label class="form-check-label">
                                             <span> Amar</span>
                                          </label>
                                       </div>
                                    </div>
                                    <!--list-group end-->
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input price-range class-price-desk0" type="checkbox">
                                          <label class="form-check-label">
                                             <span> Amar</span>
                                          </label>
                                       </div>
                                    </div>
                                    <!--list-group end-->
                                 </div>
                              </div>
                           </div>
                           <!-- -----------------filter body end---------------- -->
                        </div>
                     </div>
                     <!-- =============mobile filter sidebar end============ -->
                  </div>
               </div>
               <div class="container">
                  <hr class="mb-30 mt-30">
               </div>
               <div class="col-lg-4-5">
                  <!--  <div class="page-call">
                     <div id="page-act"> -->
                  <div class="row product-grid" id="productList">
                     <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                     <?php echo $products; ?>
                     <!--  -->
                     <div class="pagination-links">
                        <?php echo $pagination; ?>
                     </div>
                  </div>

               </div>

               <div class="col-lg-1-5 primary-sidebar sticky-sidebar sticky_sidebar_desktop" style="overflow: visible; box-sizing: border-box; min-height: 1px;">

                  <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 55.7695px;">

                     <h5 class="section-title style-1 mb-30">Shop by Category</h5>
                     <div class="sidebar-widget widget-category-2 mb-30">
                        <div class="sidebar2">
                           <div class="category-list">
                              <?php if (isset($categoryName) && $categoryName != "") { ?>
                                 <h4><?php echo $categoryName; ?></h4>
                              <?php } ?>
                              <?php if (isset($sidecategories) && count($sidecategories) > 0) { ?>
                                 <ul>
                                    <?php
                                    foreach ($sidecategories as $scategory) {
                                       if (isset($categoryLevel) && $categoryLevel == 1) {
                                          echo ' <li><a href="' . base_url('pc/' . $scategory['top_cat_slug'] . '/' . $scategory['slug']) . '" class="filterCategory"><span>' . $scategory['subCat_name'] . '</span></a></li>';
                                       } else if (isset($categoryLevel) && $categoryLevel == 2) {
                                          echo ' <li><a href="' . base_url('pc/' . $scategory['top_cat_slug'] . '/' . $scategory['sub_cat_slug'] . '/' . $scategory['slug']) . '" class="filterCategory"><span>' . $scategory['childCat_name'] . '</span></a></li>';
                                       } else {
                                          echo '<li><a href="' . base_url('pc/' . $scategory['slug']) . '" class="filterCategory"><span>' . $scategory['category'] . '</span></a></li>';
                                       }
                                    ?>

                                    <?php } ?>
                                 </ul>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                     <a class="shop-filter-toogle" href="#">
                        Price
                        <i class="fi-rs-angle-small-down angle-down"></i>
                        <i class="fi-rs-angle-small-up angle-up"></i>
                     </a>
                     <div class="shop-product-fillter-header">

                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range price" type="checkbox" onchange="filterByPrice(0, <?php echo $start_with; ?>);">
                              <label class="form-check-label">
                                 <span> Less than Rs <?php echo $start_with; ?></span>
                              </label>
                           </div>
                        </div>

                        <?php foreach ($price_ranges as $range) { ?>
                           <div class="list-group">
                              <div class="list-group-item">
                                 <input class="form-check-input price-range price" type="checkbox" onchange="filterByPrice(<?php echo $range['start']; ?>, <?php echo $range['end']; ?>);">
                                 <label class="form-check-label">
                                    <span>Rs <?php echo $range['start']; ?> To <?php echo $range['end']; ?></span>
                                 </label>
                              </div>
                           </div>
                        <?php } ?>


                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range price" type="checkbox" onchange="filterByPrice(<?php echo $lastRange; ?>, <?php echo $max_price; ?>);">
                              <label class="form-check-label">
                                 <span> More than Rs <?php echo $lastRange; ?></span>
                              </label>
                           </div>
                        </div>

                     <a class="shop-filter-toogle" href="">
                        Product Rating
                        <i class="fi-rs-angle-small-down angle-down"></i>
                        <i class="fi-rs-angle-small-up angle-up"></i>
                     </a>
                     <div class="shop-product-fillter-header">
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input product-rating-filter class-rating-desk5" type="checkbox" onchange="filterByRating(5)">
                              <label class="form-check-label" for="exampleCheckbox-che-5">
                                 <span class="material-symbols-outlined fill_star">star</span>
                                 <span class="material-symbols-outlined fill_star">star</span>
                                 <span class="material-symbols-outlined fill_star">star</span>
                                 <span class="material-symbols-outlined fill_star">star</span>
                                 <span class="material-symbols-outlined fill_star">star</span>
                              </label>
                           </div>
                        </div>
                        <div class="list-group">
                           <div class="list-group-item ">
                              <input class="form-check-input product-rating-filter class-rating-desk5" type="checkbox" onchange="filterByRating(4)">
                              <label class="form-check-label" for="exampleCheckbox-che-5">
                                 <span class="material-symbols-outlined fill_star">star</span>
                                 <span class="material-symbols-outlined fill_star">star</span>
                                 <span class="material-symbols-outlined fill_star">star</span>
                                 <span class="material-symbols-outlined fill_star">star</span>
                              </label>
                           </div>
                        </div>
                        <div class="list-group">
                           <div class="list-group-item ">
                              <input class="form-check-input product-rating-filter class-rating-desk5" type="checkbox" onchange="filterByRating(3)">
                              <label class="form-check-label" for="exampleCheckbox-che-5">
                                 <span class="material-symbols-outlined fill_star">star</span>
                                 <span class="material-symbols-outlined fill_star">star</span>
                                 <span class="material-symbols-outlined fill_star">star</span>
                              </label>
                           </div>
                        </div>
                        <div class="list-group">
                           <div class="list-group-item ">
                              <input class="form-check-input product-rating-filter class-rating-desk5" type="checkbox" onchange="filterByRating(2)">
                              <label class="form-check-label" for="exampleCheckbox-che-5">
                                 <span class="material-symbols-outlined fill_star">star</span>
                                 <span class="material-symbols-outlined fill_star">star</span>
                              </label>
                           </div>
                        </div>
                     </div>
                     <a class="shop-filter-toogle d-none" href="">
                        Brands
                        <i class="fi-rs-angle-small-down angle-down"></i>
                        <i class="fi-rs-angle-small-up angle-up"></i>
                     </a>
                     <div class="shop-product-fillter-header d-none">
                        <div class="list-group">
                           <div class="list-group-item">
                              <input type="text" name="" class="form-control filter_search" placeholder="Search here">
                           </div>
                        </div>
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range class-price-desk0" type="checkbox">
                              <label class="form-check-label">
                                 <span> Amar</span>
                              </label>
                           </div>
                        </div>
                        <!--list-group end-->
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range class-price-desk0" type="checkbox">
                              <label class="form-check-label">
                                 <span> Amar</span>
                              </label>
                           </div>
                        </div>
                        <!--list-group end-->
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range class-price-desk0" type="checkbox">
                              <label class="form-check-label">
                                 <span> Amar</span>
                              </label>
                           </div>
                        </div>
                        <!--list-group end-->
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range class-price-desk0" type="checkbox">
                              <label class="form-check-label">
                                 <span> Amar</span>
                              </label>
                           </div>
                        </div>
                        <!--list-group end-->
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range class-price-desk0" type="checkbox">
                              <label class="form-check-label">
                                 <span> Amar</span>
                              </label>
                           </div>
                        </div>
                        <!--list-group end-->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


</main>
<?php $this->load->view('frontend/footer'); ?>
<script>
   $(document).on('click', '.price', function() {
      $('.price').not(this).prop('checked', false);
   });




   $(document).on('click', '.product-rating-filter', function() {
      $('.product-rating-filter').not(this).prop('checked', false);
   });

   var formData = new FormData();

   function searchBySelection() {
      formData.append("searchbyselect", $('select[name="searchbyselect"] option:selected').val());
      search();
   }

   function filterByRating(rating) {
      formData.append("rating", rating);
      search();
   }

   function filterByPrice(min_price, max_price) {
      //alert(min_price+' , '+max_price);
      formData.append("min_price", min_price);
      formData.append("max_price", max_price);

      search();
   }

   function search() {
      // alert(base_url);
      $.ajax({
         type: 'post',
         url: '<?php echo base_url('product-filter'); ?>',
         data: formData,
         dataType: "json",
         processData: false,
         contentType: false,
         beforeSend: function() {},
         success: function(res) {
            $('#productList').html(res.data);
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
</script>