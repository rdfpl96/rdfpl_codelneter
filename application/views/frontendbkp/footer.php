<footer class="main">
         <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-md-4">
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0" data-wow-delay="0">
                            <div class="logo mb-30">
                                <a href="index.php" class="mb-15"><img src="<?php echo base_url();?>include/frontend/assets/imgs/footer-logo.png" alt="logo" /></a>
                            </div>
                            <ul class="contact-infor">
                                <li class="foot_address"><img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong>&nbsp; <span><?php  //echo $this->my_libraries->getContactDetails('address');?></span></li>
                                <li>

                                    <?php
                                     $spitvalie=""; //$this->my_libraries->getContactDetails('contact');
                                     // $expo=explode('-', $spitvalie);
                                     // $contactsNumber = str_replace(' ','',$expo[1]); 
                                    ?>

                                    <img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Call Us:</strong>&nbsp;<span><?php  echo $spitvalie;?></span>
                                </li>
                                <li><img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-email-2.svg" alt="" /><strong>Email:</strong> &nbsp;<span><a class="text-white" href="mailto:<?php  //echo $this->my_libraries->getContactDetails('email');?>" class="__cf_email__"><?php  //echo $this->my_libraries->getContactDetails('email');?></a></span></li>
                                <li class="foot_app_icon"><img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/footer_gp.svg" alt="" /><img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/footer_app.svg" alt="" /></li>
                                <div class="mobile-social-icon">
                                    <a href="#"><img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                                    <a href="#"><img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/icon-twitter-white.svg" alt="" /></a>
                                    <a href="#"><img src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icons/linkedin.svg" alt="" style="max-width: 40px !important;"/></a>                          
                                </div>
                            </ul>



                        </div>
                    </div>
                    <div class="footer-link-widget col" data-wow-delay=".1s">
                        <h4 class="widget-title">Company</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="<?php echo base_url('about-us');?>">About Us</a></li>
                            <li><a href="<?php echo base_url('blog');?>">Blogs</a></li>                            
                            <li><a href="<?php echo base_url('contact');?>">Contact Us</a></li>
                            <li><a href="<?php echo base_url('refund-and-cancelation-policy');?>">Cancellation & Refund Policy</a></li>
                            <li><a href="<?php echo base_url('privacy-policy');?>">Privacy Policy</a></li>
                            <li><a href="<?php echo base_url('terms-and-conditions');?>">Terms &amp; Conditions</a></li>
                            <li><a href="<?php echo base_url('shipping-policy');?>">Shipping Policy</a></li>
                            <li><a href="<?php echo base_url('faq');?>">FAQ</a></li>
                            <li><a href="<?php echo base_url('disclaimer');?>">Disclaimer</a></li>
                             
                        </ul>
                    </div>
                    <div class="footer-link-widget col" data-wow-delay=".2s">
                        <h4 class="widget-title">Find in Fast</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            
                        </ul>
                    </div>
                   
                    <div class="footer-link-widget col-md-3" data-wow-delay=".4s">
                        <h4 class="widget-title">Latest Blogs</h4>
                        <ul class="footer-list product-sidebar mb-sm-5 mb-md-0">

                           
                        </ul>
                        <div class="newsletter">
                            <div class="newsletter-inner ">
                                <div class="newsletter-content">
                            <form class="form-subcriber d-flex" method="post" action="#">
                                <input type="email" id="newsletter-email" placeholder="Your emaill address">
                                <button class="btn btn-dis newletter" type="button">Subscribe</button>
                            </form>
                            <div class="loaderdiv-subs"></div>
                            </div>
                            </div>
                            </div>
                    </div>
                        <div class="row">
                            <div class="cities_we_serve">
                                <h3>Cities We Serve</h3>
                                <ul>
                                    <?php for ($i=0; $i < 10 ; $i++) { ?>
                                        <li>Srirangapatna</li>
                                        <li>Shoranur</li>
                                        <li>Rameswaram</li>
                                        <li>Nagpur</li>
                                        <li>Balaghat</li>
                                        <li>Puri</li>
                                        <li>Bodhan</li>
                                        <li>Barabanki</li>
                                        <li>Chagalamarri</li>
                                        <li>PETERBAR</li>
                                        <li>Kilimanoor</li>
                                        <li>Begusarai</li>
                                        <li>BACHHRAWAN</li>
                                        <!-- Maharashtra Cities -->
                                        <li>Mumbai</li>
                                        <li>Pune</li>
                                        <li>Nagpur</li>
                                        <li>Nashik</li>
                                        <li>Aurangabad</li>
                                        <li>Thane</li>
                                        <li>Solapur</li>
                                        <li>Amravati</li>
                                        <li>Kolhapur</li>
                                        <li>Malegaon</li>
                                        <li>Jalgaon</li>
                                        <li>Akola</li>
                                        <li>Latur</li>
                                        <li>Bodhan</li>
                                    <?php } ?>
                                    
                                </ul>
                            </div>
                        </div>
                </div>
        </section>
        <div class="container pb-20 " data-wow-delay="0">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm text-white mb-0">&copy; <?php echo date('Y');?> <strong class="text-white">Royal Dryfruit Private Limited</strong> All rights reserved</p>
                </div>
              </div>
            
        </div>
    </footer>

    <!-- load email--->

<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script src="<?php echo base_url();?>include/frontend/assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/slick.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/jquery.syotimer.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/waypoints.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/wow.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/perfect-scrollbar.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/magnific-popup.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/select2.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/counterup.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/jquery.countdown.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/images-loaded.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/isotope.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/scrollup.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/jquery.vticker-min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/jquery.theia.sticky.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/jquery.elevatezoom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- Template  JS -->
<script src="<?php echo base_url();?>include/frontend/assets/js/main2cc5.js?v=5.6"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/shop2cc5.js?v=5.6"></script>
<script src="<?php echo base_url();?>include/frontend/assets/frontend_ajax.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
 <script>
    function setItem(prod_id,itemId,price,mrp_price){
        
        $('#price'+prod_id).text(price);
        $('#mrp'+prod_id).text(mrp_price);
        $('#productItemId'+prod_id).val(itemId);
    }
 </script>
</body>
</html>