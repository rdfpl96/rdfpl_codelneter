<?php $this->load->view('frontend/header'); 
// echo '<pre>';
// print_r($order_details);
//print_r($customer_id);

//echo $getOrders[0]->customer_id;
//exit();
?> 
  <main class="main pages shop_main_background">
        <div class="page-header">
            <div class="archive-header">
                <div class="container">
                    <div class="breadcrumb">
                        <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span><a href="<?php echo base_url('my-order');?>">My Orders</a><span></span>Order Details
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                <h4 class="section-title style-2 mt-20 mb-20">Order details</h4>

                <div class="order_details_card">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="order_details_first_box">
                                <div class="order_no">
                                    <h3>Order No: <span><?php echo $getOrders[0]->order_no;?></span></h3>
                                </div>
                                <div class="order_status">
                                    <h3>Status: <span>Inprocess</span></h3>
                                </div>
                            </div>

                            <div class="order_process_flow order_details_flow">
                                <div class="order-flow">
                                    <div class="step-container2">
                                        <label for="placed" class="order_step active"></label>
                                        <span class="step-label">Placed</span>
                                    </div>

                                    <div class="step-container2">
                                        <span class="dotted-line"></span>
                                    </div>

                                    <div class="step-container2">
                                        <label for="in-process" class="order_step "></label>
                                        <span class="step-label">In Process</span>
                                    </div>

                                    <div class="step-container2">
                                        <span class="dotted-line"></span>
                                    </div>

                                    <div class="step-container2">
                                        <label for="packed" class="order_step "></label>
                                        <span class="step-label">Ready to ship</span>
                                    </div>

                                    <div class="step-container2">
                                        <span class="dotted-line"></span>
                                    </div>

                                    <div class="step-container2">
                                        <label for="delivered" class="order_step "></label>
                                        <span class="step-label">Shipped</span>
                                    </div>

                                    <div class="step-container2">
                                        <span class="dotted-line"></span>
                                    </div>

                                    <div class="step-container2">
                                        <label for="reached" class="order_step "></label>
                                        <span class="step-label">Delivered</span>
                                    </div>
                                </div>
                            </div><!--order_process_flow-->

                            <div class="more_product_question mb-20">
                                <div class="first_part">
                                    <img src="<?php echo base_url().'include/frontend/assets/imgs/theme/thinking_person.svg';?>">
                                    <div class="first_part_content">
                                        <h3>Want to add more products to this order ?</h3>
                                        <p>Place another order with the same timeslot to avail free delivery</p>
                                    </div>
                                </div>
                                <!-- <div class="second_part">
                                    <a href="">Read More <span>>></span></a>
                                </div> -->
                            </div>

                            <!-- <div class="order_cancel_alert_box">
                                <h3>Order cancelled : <span>Your order has been cancelled as per your request.</span></h3>
                            </div> -->

                        </div><!--card-body end-->
                    </div><!--card end-->
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <div class="order_details_second_box">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="order_details_first_info">
                                            <h3>Your Delivery address</h3>
                                            <?php
                                            $full_name = $getOrders[0]->fname . ' ' . $getOrders[0]->lname;
                                            ?>
                                            <h4><?php echo $getOrders[0]->address_type;?></h4>
                                            <h4><?php echo $full_name; ?></h4>
                                            <p><?php echo $getOrders[0]->address1 . ', ' . $getOrders[0]->address2; ?></p>
                                            <p>
                                            <?php echo $getOrders[0]->area; ?>     
                                        </p>
                                        <p>Ph: <?php echo $getOrders[0]->mobile; ?></p>
                                        </div>
                                    </div><!--col-md-4-->
                                    <div class="col-md-4">
                                        <div class="order_details_second_info">
                                            <div class="box_1">
                                                <h3>Your Delivery Slot</h3>
                                                <?php 
                                                $date = new DateTime($getOrders[0]->delivery_date);
                                                $formattedDate = $date->format('d F Y');
                                                $delivery_time = $getOrders[0]->delivery_time;
                                                list($start_time, $end_time) = explode('-', $delivery_time);
                                                $start_time_formatted = date('h:i A', strtotime($start_time)); 
                                                $end_time_formatted = date('h:i A', strtotime($end_time)); 
                                                $full_formatted_date = "{$formattedDate}, {$dayOfWeek} {$start_time_formatted} - {$end_time_formatted}";

                                                ?>
                                                <p><span class="material-symbols-outlined">calendar_month</span>&nbsp;&nbsp; <?php echo $formattedDate; ?></p>
                                                <p class="p-0"><span class="material-symbols-outlined">schedule</span>&nbsp;&nbsp; <?php echo $full_formatted_date; ?></p>
                                            </div>
                                            <div class="box_1">
                                                <h3>Payment status</h3>
                                                <p>Pending</p>
                                            </div>
                                            <div class="box_1">
                                                <h3>Mode of payment</h3>
                                                <p>Cash On Delivery</p>
                                            </div>

                                        </div>
                                    </div><!--col-md-4-->
                                    <div class="col-md-4">
                                        <?php
                                            $order_wise_product_details = $this->common_model->getOrderDetailsFun($getOrders[0]->order_no);
                                            $total_amount = 0;
                                            foreach ($order_wise_product_details as $key => $value1) {
                                                $total_amount += (($value1['price']) * ($value1['qty']));
                                            }
                                        ?>
                                        <div class="order_details_third_info " style="background: #f9f9f9;padding: 20px;">
                                            <p><strong>Order Summary</strong></p>

                                            <div class="order_table">
                                                <div class="order_total_custom_table">
                                                    <p>Subtotal</p>
                                                    <p><?php echo $total_amount;?></p>
                                                </div>
                                                <div class="order_total_custom_table">
                                                    <p>Delivery Charge</p>
                                                    <p>00 <span class="text-success">FREE</span></p>
                                                </div>
                                                <hr>
                                                <div class="order_total_custom_table">    
                                                    <p><b>Total Amount</b></p>
                                                    <p><?php echo $total_amount;?></p>
                                                </div>
                                                <div class="order_total_custom_table total_saving_class">
                                                    <p><b>Total Savings</b></p>
                                                    <p><b>Rs. 0.00</b></p>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div><!--col-md-4-->
                                </div>
                            </div>
                        </div>
                    </div><!--card end-->
                    <br><br>
                    <div class="order_details_total">
                        <?php
                        if ($getOrders && count($getOrders) > 0){
                        ?>
                        <?php $lastOrderId = null;
                        foreach ($getOrders as $index => $order){
                            if ($lastOrderId != $order->order_no){
                                {
                                    $lastOrderId = $order->order_no;
                                        $itemCount = count(array_filter($getOrders, fn($o) => $o->order_no === $order->order_no));
                            }
                        ?>
                        <h3>Items purchased <span><?php echo $itemCount;?> Item<?php echo ($itemCount > 1) ? 's' : ''; ?></span></h3>
                        <div class="item_purchase_button">
                            <a href="">Shop from this Order</a>
                        </div>
                    </div><!--order_details-button-->
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <div class="order_details_product_info">
                                <div class="category_items_info">
                                    <h3>Snacks & Branded Foods&nbsp;&nbsp; <span> (<?php echo $itemCount;?> Item<?php echo ($itemCount > 1) ? 's' : ''; ?> | RS. <?php echo $total_amount;?>)</span></h3>      
                                </div>
                                <?php
                                if (!empty($order_details)) {
                                    foreach ($order_details as $key => $value) {
                                        $imgFile1 = base_url() . 'uploads/' . $value['feature_img'];
                                        $total_price = $value['qty'] * $value['price'];
                                ?>
                                <div class="product_details_info_body">
                                    <div class="product_details_info_left">
                                        <img src="<?php echo $imgFile1; ?>" alt="Product Image" style="width:100px; height:auto;">
                                        <div class="d-block">
                                            <p><?php echo $value['product_name']; ?></p>

                                            <div class="starrating risingstar d-flex justify-content-end flex-row-reverse mt-10">
                                            <?php 
                                            $customer_id = $getOrders[0]->customer_id;
                                            $product_id = $value['product_id'];
                                            //echo $product_id;
                                            ?>
                                            &nbsp;
                                            <p>
                                                <a href="<?php echo base_url('rating-review/'.$order->order_no.'/'.$product_id) ?>">
                                                    Review this product
                                                </a>
                                            </p>&nbsp;
                                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>
                                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
                                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
                                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
                                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product_details_info_right">
                                        <p><span>Rs. <?php echo $value['price'];?> |Qty.<?php echo $value['qty'] ?> </span></p>
                                        <p><span class="text-success">Saved: ₹0</span></p>
                                    </div>
                                </div>
                                <?php 
                                }
                            }
                                ?>
                            </div>
                        </div>
                    </div><!--card end-->
                    <?php }
                    }
                    }
                     ?>
                    <br>
                </div>
            </div>
        </div>
</main>

<?php $this->load->view('frontend/footer'); ?>

    