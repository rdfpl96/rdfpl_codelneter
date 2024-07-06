<?php $this->load->view('frontend/header'); ?>
 <style type="text/css">
.order_details_flow .dotted-line {
width: 140px;
border-top: 2px dashed #949494;
}
.order_details_flow .order-flow .step-container2 .active{
    background-color: #689f39;
}
</style>
   <main class="main shop_main_background">
    <div class="page-header">
        <div class="">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 pt-50 m-auto">
                            <div class="sucess_page_left text-center">
                                <div class="check_icon">
                                    <span class="material-symbols-outlined">check_circle</span>
                                </div>
                                <div class="order_success_heading">
                                    <h3>THANK YOU</h3>
                                    <h1>Your Order is Confirmed</h1>
                                    <p>We will be sending you an email confirmation to info@rdfpl.com</p>
                                </div>
                                <div class="order_places_sec">
                                    <div class="order_success_message">
                                        <p>Order #<?php echo isset($order_no) ?  $order_no : "" ?> was placed on <?php echo date('M d, Y');?> and is currently in progress</p>
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
                                    <div class="expected_delivery_line text-left pt-20">
                                        <p>Expected Delivery Date: <b><?php echo date('M d, Y');?></b> 
                                            <a href="<?php echo base_url('my-order');?>" class="text-primary pl-50"><u><b>Click here go to dashboard</b></u></a></p>
                                    </div>
                                </div><!--order_places_sec-->
                            </div><!--sucess_page_left-->
                        </div><!--col-8-->
                        <div class="col-md-4 d-none">
                            <div class="success_page_right">
                                        <div class="order_details_id p-20">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="order_id">
                                                    <h6>Order Details</h6>
                                                    <h3>#<?php echo isset($order_no) ?  $order_no : "" ?></h3>
                                                </div>
                                                <!-- <div class="d_invoice_btn">
                                                    <a href=""><span class="material-symbols-outlined">download</span>&nbsp;&nbsp; Download Invoice</a>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="address_box pt-20">
                                            <div class="order_details_first_info p-20">
                                                <h3>Your Delivery Address</h3>
                                                <h4>Ajay Ghodvinde</h4>
                                                <p>A-333 Wagle Estate Road No. 22 Wagle Estate Road No. 22 Thane (W) 400604</p>
                                            </div>
                                          
                                            
                                        </div>
                                         <div class="order_details_third_info " style="background: #383838;padding: 20px;">
                                            <p><strong>Order Summary</strong></p>
                                            <div class="order_table">
                                                <div class="order_total_custom_table">
                                                    <p>Subtotal</p>
                                                    <p>₹47.4</p>
                                                </div>
                                                <div class="order_total_custom_table">
                                                    <p>Delivery Charge</p>
                                                    <p>₹50 <span class="text-success">FREE</span></p>
                                                </div>
                                                <hr>
                                                <div class="order_total_custom_table">
                                                    <p><b>Total Amount</b></p>
                                                    <p>₹47.4</p>
                                                </div>
                                                <div class="order_total_custom_table total_saving_class">
                                                    <p><b>Total Savings</b></p>
                                                    <p><b>₹62.6</b></p>
                                                </div>                                               
                                            </div>
                                        </div><!--order_details_third_info--><br><br>
                            </div>
                        </div><!--col-4-->
                    </div><!--row end-->
                </div>
            </section>
        </div>
    </div>
</main>    
<?php $this->load->view('frontend/footer'); ?>