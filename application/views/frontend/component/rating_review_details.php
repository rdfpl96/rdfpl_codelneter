<?php $this->load->view('frontend/header'); ?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb breadcrub_shop">
                <div class="broad">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span>Product Review
                </div>
                
            </div>
        </div>
    </div>
    <div class="container mb-30">

                <!-- --------------product details rating reviews---------------- -->
                <div class="product_details_rating_reviews mt-30 mb-30">
                  <div class="product_details_main_heading">
                     <h3>Rating and Reviews</h3>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="review_sec_left_sec">
                           <div class="total_reviews icon_fill">
                            <?php
                              // $productRatings = $this->customlibrary->getProductRatingSummary($product_id);
                              // $average_rating = number_format($productRatings['average_rating'], 1);
                              // $total_ratings = $productRatings['total_ratings'];
                              // $total_reviews = $productRatings['total_reviews'];
                              //$rati=$this->customlibrary->getProductRatingSummary($pdetail['product_id']);

                          ?>
                              <h3 class="text-brand"><?php echo number_format($productRate['average_rating'],1); ?> <i class="material-symbols-outlined">star</i></h3>
                              <p class="text-muted"><?php echo $productRate['total_ratings']; ?> ratings &amp; <?php echo $productRate['total_reviews']; ?> reviews</p>
                              <div class="progress mt-30">
                                 <span>5 star</span>
                                 <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                              </div>
                              <div class="progress">
                                 <span>4 star</span>
                                 <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                              </div>
                              <div class="progress">
                                 <span>3 star</span>
                                 <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                              </div>
                              <div class="progress">
                                 <span>2 star</span>
                                 <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                              </div>
                              <div class="progress mb-30">
                                 <span>1 star</span>
                                 <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                              </div>
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
                                     <?php //if (!empty($reviews)): ?>
                                     <?php foreach ($reviews as $review): ?>
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
                                                     <div class="thumb_icon">
                                                         <?php echo htmlspecialchars($review['thumbs_up']); ?>
                                                         <span class="material-symbols-outlined">thumb_up</span>
                                                         <?php echo htmlspecialchars($review['thumbs_down']); ?>
                                                         <span class="material-symbols-outlined">thumb_down</span>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     <?php endforeach; ?>
                                 <?php //else: ?>
                                     <p>No reviews available.</p>
                                 <?php //endif; ?>

                            <!-- <h6 class="text-center"><a href="https://uat.rdfpl.com/rating-review-details"><u> View all 70 reviews &gt;</u></a></h6> -->
                        </div>
                        <a href="<?= base_url('rating-review-details/' . $pdetail->product_id) ?>" class="pull-right">View more</a>
                     </div>
                  </div>
               </div>
                <!-- --------------product details rating reviews end---------------- -->


                

            </div>
        </main>
<?php $this->load->view('frontend/footer'); ?>
<script type="text/javascript">
var count = $(('#count'));
$({ Counter: 0 }).animate({ Counter: count.text() }, {
  duration: 5000,
  easing: 'linear',
  step: function () {
    count.text(Math.ceil(this.Counter)+ "%");
  }
});

var s = Snap('#animated');
var progress = s.select('#progress');

progress.attr({strokeDasharray: '0, 251.2'});
Snap.animate(0,251.2, function( value ) {
    progress.attr({ 'stroke-dasharray':value+',251.2'});
}, 5000);
</script>
