<?php $this->load->view('frontend/header'); ?>
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
                                                       <span class="material-symbols-outlined thumb-icon <?php echo $active_like; ?>" id="like_<?php echo $review['rate_id']; ?>" onclick="thumbAction('<?php echo $review['rate_id']; ?>', 'like')">thumb_up</span>
                                                       <span class="material-symbols-outlined thumb-icon <?php echo $active_dislike; ?>" id="dislike_<?php echo $review['rate_id']; ?>" onclick="thumbAction('<?php echo $review['rate_id']; ?>', 'dislike')">thumb_down</span>
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