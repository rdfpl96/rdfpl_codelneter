<?php
$this->load->view('frontend/header',$data);
?>
<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> About us
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 m-auto">
                        <section class="row align-items-center mb-50">
                            <div class="col-lg-4">
                                <img src="<?php echo base_url();?>include/frontend/assets/imgs/about_us.png" alt="" class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4" />
                            </div>
                            <div class="col-lg-8 about_us_heading">
                                <div class="pl-25">
                                    <h2 class="mb-30">Welcome to Royal Dryfruits</h2>
                                    <p class="mb-25 text-muted">Established decades ago in the heart of a bustling city, Royal Dryfruits began as a humble storefront, offering the finest quality of dried fruits and nuts. Over the years, our commitment to excellence has transformed us from a local favorite to a nationally recognized brand synonymous with premium quality and unmatched taste.</p>
                                    <p class="mb-50 text-muted">At Royal Dryfruits, our mission is simple yet profound: to provide our customers with the freshest, most exquisite range of dry fruits sourced from the best regions around the globe. We believe in maintaining the authenticity of flavors while ensuring top-notch quality, making every bite a delightful experience.</p>
                                   
                                </div>
                            </div>
                        </section>
                        <section class="text-center mb-50">
                            <h2 class="title style-3 mb-40">What We Provide?</h2>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-1.svg" alt="" />
                                        <h4>Best Prices & Offers</h4>
                                        <p>Unbeatable deals ensuring you get the best value for your money.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-2.svg" alt="" />
                                        <h4>Wide Assortment</h4>
                                        <p>A vast selection of premium dry fruits and nuts, catering to all your culinary needs.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-3.svg" alt="" />
                                        <h4>Free Delivery</h4>
                                        <p>Enjoy hassle-free shopping with complimentary delivery straight to your doorstep.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-4.svg" alt="" />
                                        <h4>Easy Returns</h4>
                                        <p>Not satisfied? Return or exchange your products effortlessly with our seamless return policy.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-5.svg" alt="" />
                                        <h4>100% Satisfaction</h4>
                                        <p>Your happiness is our priority; we guarantee satisfaction with every purchase.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-6.svg" alt="" />
                                        <h4>Great Daily Deal</h4>
                                        <p>Exciting daily offers and promotions, ensuring you get more for less.</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                       
                    </div>
                </div>
            </div>

              <?php  if($team_list!=0){ ?>
        <section class="text-center mb-50">
            <div class="container">
              
                 <h3>Our Team</h3>
                    <div class="carausel-708-columns-cover position-relative team-carausel">
                       <div class="carausel-708-columns" id="carausel-708-columns">
                 <?php  foreach (array_reverse($team_list) as $key => $value) { 


                   $filePath=(($value->image!="") ? './uploads/user/'.$value->image :'');
                    if(file_exists($filePath)){
                       $imgFile=base_url().'uploads/user/'.$value->image;
                    }else{
                      $imgFile=base_url().'include/assets/default_product_image.png';
                    }
                   
                    ?>
                    <div class="card-3 mb-24">
                        <div class="banner-img Up">
                        <div class="featured-card team-div">
                            <img src="<?php echo $imgFile;?>" alt="" />
                            <h4><?php echo $value->name;?></h4>
                            <span><?php echo $value->designation;?></span>

                            <p><?php echo $value->short_details;?></p>
                             <div class="mobile-social-icon-team">
                                 <?php if($value->fb_link!=""){?>
                                <a href="<?php echo $value->fb_link;?>" title="Facebook" target="_blank"><img src="http://localhost:8081/royalDryfruit/include/frontend/assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                                 <?php } ?>
                               
                                <?php if($value->twitter_link!=""){?>
                               <a href="<?php echo $value->twitter_link;?>" title="Twitter"  target="_blank"><img src="http://localhost:8081/royalDryfruit/include/frontend/assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                               <?php } ?>
                                
                                 <?php if($value->insta_link!=""){?>
                                <a href="<?php echo $value->insta_link;?>" title="instagram" target="_blank"><img src="http://localhost:8081/royalDryfruit/include/frontend/assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                                 <?php } ?>
                                 
                                   <?php if($value->linkedin_link!=""){?>
                                 <a href="<?php echo $value->linkedin_link;?>" title="Linkedin" target="_blank"><img src="http://localhost:8081/royalDryfruit/include/frontend/assets/imgs/theme/icons/icons8-linkedin.svg" alt=""></a>
                                 <?php } ?>
                              </div>
                        </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
               
            </div>
        </section>
    <?php } ?>

        
            <section class="container mb-50 d-none d-md-block">
                <div class="row about-count">
                    <div class=""></div>
                    <div class="col-lg-1-5 col-md-6 text-center mb-lg-0 mb-md-5">
                        <h1 class="heading-1"><span class="count">12</span>+</h1>
                        <h4>Years of Excellence</h4>
                    </div>
                    <div class="col-lg-1-5 col-md-6 text-center">
                        <h1 class="heading-1"><span class="count">1000</span>+</h1>
                        <h4>Satisfied Customers</h4>
                    </div>
                    <div class="col-lg-1-5 col-md-6 text-center">
                        <h1 class="heading-1"><span class="count">20</span>+</h1>
                        <h4>Sustainable Sourcing</h4>
                    </div>
                    <div class="col-lg-1-5 col-md-6 text-center">
                        <h1 class="heading-1"><span class="count">500</span>+</h1>
                        <h4>Daily Shipments</h4>
                    </div>
                    <div class="col-lg-1-5 text-center d-none d-lg-block">
                        <h1 class="heading-1"><span class="count">26</span>+</h1>
                        <h4>Award-Winning Quality</h4>
                    </div>
                </div>
            </section>
          
        </div>
    </main>
<?php
$this->load->view('frontend/footer',$data);
?>    