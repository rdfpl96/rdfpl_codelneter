
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
                <div class="product_details_rating_reviews mt-30">
                     <div class="product_details_main_heading">
                       <h3>Rating and Reviews</h3>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="review_sec_left_sec">
                                <div class="total_reviews icon_fill">
                                    <h3 class="text-brand">4.2 <i class="material-symbols-outlined">star</i></h3>
                                    <p class="text-muted">5180 ratings & 70 reviews</p>                                    
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
                                <h4 class="text-center mt-30 mb-20">Highlights</h4>                               
                                <div class="circle_progress_bar d-flex">
                                        <div class="progress_circle text-center">
                                        <svg viewBox="0 0 86 86"><circle fill="none" stroke="#eee" cx="43" cy="43" r="39" stroke-width="8px"></circle><circle stroke="#5E9400" stroke-linecap="round" fill="none" cx="43" cy="43" r="39" stroke-width="8px" transform="rotate(-90 43 43)" style="stroke-dasharray: 245.044;stroke-dashoffset: 49.0088;"></circle><text x="50%" y="50%" dy=".3em" text-anchor="middle" color="#606060" style="line-height: 18px;">4</text></svg>
                                        <h4>Taste</h4>
                                        <p class="text-muted">136 Rating</p>
                                        </div>
                                        <div class="progress_circle text-center">
                                        <svg  viewBox="0 0 86 86"><circle fill="none" stroke="#eee" cx="43" cy="43" r="39" stroke-width="8px"></circle><circle stroke="#5E9400" stroke-linecap="round" fill="none" cx="43" cy="43" r="39" stroke-width="8px" transform="rotate(-90 43 43)" style="stroke-dasharray: 300.044;stroke-dashoffset: 49.0088;"></circle><text x="50%" y="50%" dy=".3em" text-anchor="middle" color="#606060" style="line-height: 18px;">5</text></svg>
                                        <h4>Texture</h4>
                                        <p class="text-muted">115 Rating</p>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="review_sec_right_sec">
                                <h3>Product Reviews</h3>
                                <div class="rating_review_details_list">
                                    <div class="mt-10">
                                        <div class="grid_product_rating">
                                        <p>3 <i class="material-symbols-outlined">star</i></p> 
                                        </div>
                                        <h4>The product is good but the quantity is very less compared to offline product available in the retail market. Totally upset after receiving the product.</h4>
                                        <div class="rating_review_author d-flex justify-content-between">
                                            <p class="text-muted">Joydeep Ghosh, (a year ago)</p>
                                            <div class="thumb_icon">
                                                <span class="material-symbols-outlined">thumb_up</span>
                                                <span class="material-symbols-outlined">personal_places</span>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="rating_review_details_list">
                                    <div class="mt-10">
                                        <div class="grid_product_rating">
                                        <p>3 <i class="material-symbols-outlined">star</i></p> 
                                        </div>
                                        <h4>The product is good but the quantity is very less compared to offline product available in the retail market. Totally upset after receiving the product.</h4>
                                        <div class="rating_review_author d-flex justify-content-between">
                                            <p class="text-muted">Joydeep Ghosh, (a year ago)</p>
                                            <div class="thumb_icon">
                                                <span class="material-symbols-outlined">thumb_up</span>
                                                <span class="material-symbols-outlined">personal_places</span>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    
                </div>
                <!-- --------------product details rating reviews end---------------- -->


                

            </div>
        </main>

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
