
<?php $this->load->view('frontend/header'); ?>

<main class="main shop_main_background" style="transform: none;">
   <div class="page-call" style="transform: none;">
      <div id="page-act" style="transform: none;">
         <div class="page-header">
            <div class="container">
               <div class="archive-header">
                  <div class="row align-items-center">
                     <div class="col-xl-9">
                        <div class="breadcrumb">
                           <a href="https://uat.rdfpl.com/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a><span></span>
                           <a href="javascript:void(0);" data-href="" class="filterCategory">shop</a><span></span><a href="javascript:void(0);" data-href="" class="filterCategory">Dry Fruits &amp; Nuts</a>                            
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
                     <p style="color:black;">We found <strong class="text-brand"><?php  echo isset($productCount) ? $productCount : 0 ;?></strong> items for you!</p>

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
                        <select type="type" class="form-select single-select float-sm-end mobile-sort sort-by-filter" id="my-drop-down-select-element-id">
                           <option value="all">Relevance </option>
                           <option value="latest">Latest</option>
                           <option value="low_to_high">Price: Low to High</option>
                           <option value="high_to_low">Price: High to Low</option>
                           <option value="best_selling">Best Selling</option>
                           <option value="A_Z">Title(A-Z)</option>
                           <option value="Z_A">Title(Z-A)</option>
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
                                 Price
                                 <i class="fi-rs-angle-small-down angle-down"></i>
                                 <i class="fi-rs-angle-small-up angle-up"></i>
                                 </a>
                                 <div class="shop-product-fillter-header">
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input price-range class-price-desk0" type="checkbox">
                                          <label class="form-check-label">
                                          <span> Less than Rs 20</span>
                                          </label>                       
                                       </div>
                                    </div>
                                    <!--list-group end-->
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input price-range class-price-desk0" type="checkbox">
                                          <label class="form-check-label">
                                          <span> Less than Rs 20</span>
                                          </label>                       
                                       </div>
                                    </div>
                                    <!--list-group end-->
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input price-range class-price-desk0" type="checkbox">
                                          <label class="form-check-label">
                                          <span> Less than Rs 20</span>
                                          </label>                       
                                       </div>
                                    </div>
                                    <!--list-group end-->
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input price-range class-price-desk0" type="checkbox">
                                          <label class="form-check-label">
                                          <span> Less than Rs 20</span>
                                          </label>                       
                                       </div>
                                    </div>
                                    <!--list-group end-->
                                    <div class="list-group">
                                       <div class="list-group-item">
                                          <input class="form-check-input price-range class-price-desk0" type="checkbox">
                                          <label class="form-check-label">
                                          <span> Less than Rs 20</span>
                                          </label>                       
                                       </div>
                                    </div>
                                    <!--list-group end-->
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
                  <div class="row product-grid">
                     <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                      <?php echo $products; ?>  
                     <!--  -->
                  </div>
                  <!--product grid-->
                  <!-- <div class="pagination-area mt-20 mb-20">
                     <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                           <li class="page-item active"><a href="#" class="page-link">1</a></li>
                           <li class="page-item page-link"><a href="javascript:void(0);" data-href="https://uat.rdfpl.com/shop/dry-fruits-nuts/?d=Mg%3D%3D&amp;per_page=2" data-ci-pagination-page="2" class="filterPagination">2</a></li>
                           <li class="page-item page-link"><a href="javascript:void(0);" data-href="https://uat.rdfpl.com/shop/dry-fruits-nuts/?d=Mg%3D%3D&amp;per_page=3" data-ci-pagination-page="3" class="filterPagination">3</a></li>
                           <li class="page-item page-link"><a href="javascript:void(0);" data-href="https://uat.rdfpl.com/shop/dry-fruits-nuts/?d=Mg%3D%3D&amp;per_page=2" data-ci-pagination-page="2" rel="next" class="filterPagination"><i class="fi-rs-arrow-small-right"></i></a></li>
                           <li class="page-item page-link"><a href="#"></a><a href="javascript:void(0);" data-href="https://uat.rdfpl.com/shop/dry-fruits-nuts/?d=Mg%3D%3D&amp;per_page=5" data-ci-pagination-page="5" class="filterPagination">L</a></li>
                        </ul>
                     </nav>
                  </div> -->
                  <!-- </div>
                     </div> -->
                  <!--End Deals-->
               </div>

               <div class="col-lg-1-5 primary-sidebar sticky-sidebar sticky_sidebar_desktop" style="overflow: visible; box-sizing: border-box; min-height: 1px;">
                
                  <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 55.7695px;">

                     <h5 class="section-title style-1 mb-30">Shop by Category</h5>
                     <div class="sidebar-widget widget-category-2 mb-30">
                        <div class="sidebar2">
                           <div class="category-list">
                              <?php if(isset($categoryName) && $categoryName!="") { ?>
                                 <h4><?php echo $categoryName;?></h4>
                              <?php } ?>  
                              <?php if(isset($sidecategories) && count($sidecategories)>0) { ?>
                              <ul>
                                 <?php 
                                    foreach($sidecategories as $scategory){ 
                                       if(isset($categoryLevel) && $categoryLevel==1){
                                          echo' <li><a href="'.base_url('pc/'.$scategory['top_cat_slug'].'/'.$scategory['slug']).'" class="filterCategory"><span>'.$scategory['subCat_name'].'</span></a></li>';
                                       }
                                       else if(isset($categoryLevel) && $categoryLevel==2){
                                          echo' <li><a href="'.base_url('pc/'.$scategory['top_cat_slug'].'/'.$scategory['sub_cat_slug'].'/'.$scategory['slug']).'" class="filterCategory"><span>'.$scategory['childCat_name'].'</span></a></li>';
                                       }else{
                                          echo'<li><a href="'.base_url('pc/'.$scategory['slug']).'" class="filterCategory"><span>'.$scategory['category'].'</span></a></li>';
                                       }
                                    ?>
                                   
                                 <?php } ?>
                              </ul>
                            <?php } ?>
                           </div>
                        </div>
                     </div>

                     <a class="shop-filter-toogle" href="">
                     Price
                     <i class="fi-rs-angle-small-down angle-down"></i>
                     <i class="fi-rs-angle-small-up angle-up"></i>
                     </a>
                     <div class="shop-product-fillter-header">
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range class-price-desk0" type="checkbox">
                              <label class="form-check-label">
                              <span> Less than Rs 20</span>
                              </label>                       
                           </div>
                        </div>
                        <!--list-group end-->
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range class-price-desk0" type="checkbox">
                              <label class="form-check-label">
                              <span> Less than Rs 20</span>
                              </label>                       
                           </div>
                        </div>
                        <!--list-group end-->
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range class-price-desk0" type="checkbox">
                              <label class="form-check-label">
                              <span> Less than Rs 20</span>
                              </label>                       
                           </div>
                        </div>
                        <!--list-group end-->
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range class-price-desk0" type="checkbox">
                              <label class="form-check-label">
                              <span> Less than Rs 20</span>
                              </label>                       
                           </div>
                        </div>
                        <!--list-group end-->
                        <div class="list-group">
                           <div class="list-group-item">
                              <input class="form-check-input price-range class-price-desk0" type="checkbox">
                              <label class="form-check-label">
                              <span> Less than Rs 20</span>
                              </label>                       
                           </div>
                        </div>
                        <!--list-group end-->
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