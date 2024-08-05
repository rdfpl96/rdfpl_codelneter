
<?php $this->load->view('frontend/header'); ?>

<?php if(isset($sliders) && count($sliders)>0){?>
<section class="home-slider position-relative mb-30">
  <div class="container">
    <div class="home-slide-cover mt-30">
      <div id="carouselExampleIndicators1" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators" id="carouselIndicators1">
          <!-- Indicators will be generated dynamically here -->
        </div>
        <div class="carousel-inner">
          <!-- Manually add carousel items -->
          <?php 
          $k=0;
             foreach ($sliders as $slider) {
              ?>
              <?php //if($key==0){ echo 'active';}?>
          <div class="carousel-item <?php echo ($k==0)? 'active': ""; ?>">
            <a href="<?php echo $slider['button_link'];?>"><img src="<?php echo base_url()?>uploads/banner/<?php echo $slider['desk_image']?>" class="d-block w-100" alt="Slide 1"></a>
          </div>
          <?php $k++;} ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</section>
 <?php } ?>


<div class="container popular_background">
    <div class="section-title mt-10">
        <h3 class="">My Smart Basket</h3>
        <div class="arrows_slider d-flex align-items-center">
            <a href="">Show More</a>
            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-related-arrows"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12" data-wow-delay=".4s">
            <div class="carausel-4-columns-cover arrow-center position-relative">
                <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-smartbasket">
                    <!-- <div class="row product-grid"> -->
                       
                        <?php echo $smartBasketProdctHtml;?>
                       
                <!-- </div> -->
               </div>
            </div>
        </div>
    </div>
</div>
<section class="section-padding">
      <div class="container">
        <div class="home_category_sec">
            <div class="home_cat_heading">
                <h3>Bank Offers</h3>
            </div>
            <div class="row">
                <?php for ($i=0; $i < 4 ; $i++) { ?>
                    <div class="col-md-3">
                      <div class="hoem_cat_img">
                          <a href=""><img src="<?php echo base_url();?>include/frontend/assets/imgs/category/bank_offers.webp" alt="" /></a>
                      </div>
                  </div>
                <?php } ?>                      
            </div>
        </div>
      </div>
  </section>


    <div class="container popular_background mt-30 d-none">
        <div class="section-title mt-10">
            <h3 class="">Best Sellers</h3>
            <!-- <div class="arrows_slider d-flex align-items-center">  
                <a href="">Show More</a>       
                <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-best-sellers-arrows"></div>
            </div> -->
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 " data-wow-delay=".4s">
                <div class="carausel-4-columns-cover arrow-center position-relative">
                    
                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-best-sellers">
                                    <?php if($category_list!=0){ ?>

                                      <?php foreach(array_reverse($category_list) as $key1 => $value){  
                                            $index_tab = 'best-'.$value->cat_id.'-'.($key1+1);
                                            $active2_best_tab= ($key1==0)? 'active':''; 

                                            $where1['pro.status']=1;
                                            $where1['mapp.cat_id']=$value->cat_id;
                                            $where_chain=queryChain($where1);
                                              // $sql_limit='LIMIT 10,10';
                                            $sql_limit='';
                                            $product_list2 =$this->my_libraries->getProductlist_royal($where_chain,'','','',$sql_limit);
                                            $dailyBestSells=$product_list2;

                                              // $where['pro.status']=1;
                                              // $where['mapp.cat_id']=$value->cat_id;
                                              // $sql_limit='LIMIT 0,20';
                                              // $where_and_chain=queryChain($where);
                                              // $getProduct =$this->my_libraries->getProductlist_royal($where_and_chain,'','','',$sql_limit);
                                              // echo "<pre>";
                                              // print_r($dailyBestSells);
                                              // echo "</pre>";
                                             ?>
                                           <?php
                                           if($dailyBestSells!=array()){
                                                $datadaily['itemDisplyNummber']=5;
                                                $datadaily['category']=$value;
                                                $datadaily['products']=$dailyBestSells;
                                                $datadaily['unique']='tab-slide';
                                                $this->load->view('frontend/containerPage/productItem',$datadaily);
                                            }else{
                                            ?>
                                              <div class="blank" style="text-align: center;font-size: 16px;">No Data </div>
                                            <?php
                                          } 
                                         ?>                    

                                      <?php 
                                       } 
                                    }
                                ?>
                   </div>
               </div>

           </div>

       </div>
    </div>


    <div class="container popular_background mt-30" >
        <div class="section-title mt-10">
            <h3 class="">Featured Product</h3>
            <div class="arrows_slider d-flex align-items-center">  
            <a href="">Show More</a>       
            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-featured-arrows"></div>
            </div>
        </div>
        <div class="row">
            <?php echo $this->load->view('frontend/component/productItem', array("productItems"=>$featureProdct,'pcol'=>5), TRUE); ?>
        </div>
    </div>

<div class="container popular_background mt-30" >
    <div class="section-title mt-10">
        <h3 class="">Top Selling Product</h3>
        <!-- <div class="arrows_slider d-flex align-items-center">  
        <a href="">Show More</a>       
        <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-top-selling-arrows"></div>
        </div> -->
    </div>
    <div class="row">
        <?php echo $this->load->view('frontend/component/productItem', array("productItems"=>$topsellingProduct,'pcol'=>5), TRUE); ?>
    </div>
</div>

<div class="container popular_background mt-30" >
    <div class="section-title mt-10">
        <h3 class="">Newly Launch</h3>
        <!-- <div class="arrows_slider d-flex align-items-center">  
        <a href="">Show More</a>       
        <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-newly-launch-arrows"></div>
        </div> -->
    </div>
    <div class="row">
       <?php echo $this->load->view('frontend/component/productItem', array("productItems"=>$Newproduct,'pcol'=>5), TRUE); ?>
    </div>
</div>



       
      
     
      <section class="section-padding">
          <div class="container">
            <div class="home_category_sec">
                <div class="home_cat_heading">
                    <h3>Top Offers</h3>
                </div>
                <div class="row">
                    <?php for ($i=0; $i < 4 ; $i++) { ?>
                        <div class="col-md-3">
                          <div class="hoem_cat_img">
                              <a href=""><img src="<?php echo base_url();?>include/frontend/assets/imgs/category/top_offers.webp" alt="" /></a>
                          </div>
                      </div>
                    <?php } ?>                      
                </div>
            </div>
          </div>
      </section>
      <section class="section-padding">
          <div class="container">
            <div class="home_category_sec">
                <div class="home_cat_heading">
                    <h3>Your Daily Staples</h3>
                </div>
                <div class="row">
                    <?php for ($i=0; $i < 4 ; $i++) { ?>
                        <div class="col-md-3">
                          <div class="hoem_cat_img">
                              <a href=""><img src="<?php echo base_url();?>include/frontend/assets/imgs/category/daily_staples.webp" alt="" /></a>
                          </div>
                      </div>
                    <?php } ?>                      
                </div>
            </div>
          </div>
      </section>
      <section class="section-padding">
          <div class="container">
            <div class="home_category_sec">
                <div class="home_cat_heading">
                    <h3>Snacks Store</h3>
                </div>
                <div class="row">
                    <?php for ($i=0; $i < 6 ; $i++) { ?>
                        <div class="col-md-2">
                          <div class="hoem_cat_img">
                              <a href=""><img src="<?php echo base_url();?>include/frontend/assets/imgs/category/snacks.webp" alt="" /></a>
                          </div>
                      </div>
                    <?php } ?>                      
                </div>
            </div>
          </div>
      </section>
      <section class="section-padding">
          <div class="container">
            <div class="home_category_sec">
                <div class="home_cat_heading">
                    <h3>Beverages</h3>
                </div>
                <div class="row">
                    <?php for ($i=0; $i < 6 ; $i++) { ?>
                        <div class="col-md-2">
                          <div class="hoem_cat_img">
                              <a href=""><img src="<?php echo base_url();?>include/frontend/assets/imgs/category/demo_cat.webp" alt="" /></a>
                          </div>
                      </div>
                    <?php } ?>                      
                </div>
            </div>
          </div>
      </section>
<?php if($ads_banner!=0){?>
<section class="home-slider position-relative mb-30">
  <div class="container">
    <div class="home-slide-cover mt-30">
      <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators" id="carouselIndicators2">
    
        </div>
        <div class="carousel-inner">
          <!-- Manually add carousel items -->
          <?php 
             foreach ($ads_banner as $key => $desk_value) {
              ?>
              <?php //if($key==0){ echo 'active';}?>
          <div class="carousel-item <?php echo ($key==0)? 'active': null?>">
            <a href="<?php echo $desk_value->button_link;?>"><img src="<?php echo base_url()?>uploads/banner/<?php echo $desk_value->desk_image;?>" class="d-block w-100" alt="Slide 1"></a>
          </div>
          <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</section>
<?php } ?>
 <section class="homepage_about_brand section-padding">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <p><b>Royal dryfruits – online grocery store</b></p>
                 <p>Established decades ago in the heart of a bustling city, Royal Dryfruits began as a humble storefront, offering the freshest of fruits and vegetables, top-quality pulses and food grains, dairy products, and hundreds of branded items, all handpicked and delivered to your home, all at the click of a button. Over the years, our commitment to excellence has transformed us from a local favorite to a nationally recognized brand synonymous with premium quality and unmatched taste.</p>
                 <p>At Royal Dryfruits, our mission is simple yet profound: to bring a staggering array of over 40,000 products from more than 1,000 brands to the doorsteps of over 10 million satisfied customers. We believe in maintaining the authenticity of flavors while ensuring top-notch quality, making every bite a delightful experience.</p>
                 <p>In today's fast-paced world, Royal Dryfruits continues to provide our customers with the freshest, most exquisite range of dry fruits sourced from the best regions around the globe. From essential household cleaning products to the latest beauty and makeup trends, Royal Dryfruits remains your one-stop shop for daily needs.</p>
                 <p>We now serve 300+ cities and towns across India and ensure swift delivery times, guaranteeing that all your groceries, snacks and branded foods reach you on time.</p>
                 <p>Whether it's a last-minute dinner party or you simply need something urgently, we've got you covered. This service exemplifies our commitment to providing you with not just the widest range of products but also the fastest and most efficient shopping experience, making Royal Dryfruits the go-to destination for all your immediate grocery needs.</p>
             </div>
         </div>
     </div>
 </section>
</main>
<?php $this->load->view('frontend/footer'); ?>
<script>
 
  // Generate the indicators dynamically based on the number of carousel items
  document.querySelectorAll('.carousel').forEach((carousel, index) => {
    const carouselInner = carousel.querySelector('.carousel-inner');
    const carouselIndicators = carousel.querySelector(`#carouselIndicators${index + 1}`);

    for (let i = 0; i < carouselInner.children.length; i++) {
      const button = document.createElement('button');
      button.type = 'button';
      button.dataset.bsTarget = `#carouselExampleIndicators${index + 1}`;
      button.dataset.bsSlideTo = i;
      button.setAttribute('aria-label', `Slide ${i + 1}`);

      if (i === 0) {
        button.classList.add('active');
        button.setAttribute('aria-current', 'true');
      }

      carouselIndicators.appendChild(button);
    }
  });

</script>