 <?php $this->load->view('frontend/header'); 

$order_no = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
$product_id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

 ?>

 <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.php" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="my_account.php">My Order</a><span></span>Rating & Review
                </div>
            </div>
        </div>
        <div class="page-content pt-20 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 my_account_main m-auto">
                        <div class="row">
                            <div class="col-md-3">
                               <?php 
                                 $p['pageType']='rating-review';
                                 $this->load->view('frontend/component/my_account_side_bar',$p); 
                               ?>
                            </div>


                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content">

                                <?php
                                    $ar=array();
                                	if($review!=0){
                                		for ($i=1; $i <= $review[0]->cust_rate ; $i++) { 
                                			  $ar[]=$i;
                                		}
                                	}
                                	?>

                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                    <div class="card-body">
                                    <form class="form-contact" action="<?php echo base_url('common/rating_review_submit'); ?>" method="POST" id="commentForm">
                                        <input type="hidden" class="form-control" name="rate_id" id="rate-id" value="<?php echo ($review!=0) ? $review[0]->rate_id : 0 ; ?>">
                                        <input type="hidden" class="form-control" name="order_id" id="order_id" value="<?php echo $order_no; ?>">
                                        <input type="hidden" class="form-control" name="pro_id" id="pro_id" value="<?php echo $product_id; ?>">

                                        <input type="hidden" class="form-control" name="cust_id" id="cust_id" value="<?php echo $customer_id; ?>">
                                        <input type="hidden" class="form-control" name="star_rate" id="star-rate" value="<?php echo ($review!=0) ? $review[0]->cust_rate : 0 ; ?>">

                                        <div class="comment-form">
                                            <h4 class="mb-15">Rating & Review</h4>
                                                <div class="starrating risingstar d-flex justify-content-end flex-row-reverse mt-10">
                                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>
                                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
                                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
                                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
                                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8 col-md-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input type="text" name="title" class="form-control" placeholder="Title">
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"><?php echo ($review!=0) ? $review[0]->comment : ''; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button rate-btn button-contactForm submit-rating-review">Submit Review</button>
                                                        <div class="loaderdiv"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </form>
                                </div>
                            </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/footer'); ?>