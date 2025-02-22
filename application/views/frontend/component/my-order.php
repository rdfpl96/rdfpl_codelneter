<?php
// echo '<pre>';
// print_r($getOrders);
// exit();
$this->load->view('frontend/header', $data);
?>

<style type="text/css">
    .buy-again-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #689F39;
        color: white;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
    }

    .buy-again-btn:hover {
        background-color: #689F39;
    }
</style>

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo base_url(); ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="<?php echo base_url('account'); ?>">My Account</a><span></span>My Orders
            </div>
        </div>
    </div>
    
    <div class="page-content pt-20 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 my_account_main m-auto">
                    <div class="row">
                        <div class="row" style="margin-top: 20px;">
        <div class="col-md-4">
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-md-2" style="width:200px">
        <form id="yearFilterForm" method="post" action="<?php echo base_url('common/my_order'); ?>">
            <select name="year" id="year_select" class="form-control" required onchange="document.getElementById('yearFilterForm').submit();">
                <option value="">Select Year</option>
                <option value="2021" <?php echo ($selected_year == '2021') ? 'selected' : ''; ?>>2021</option>
                <option value="2022" <?php echo ($selected_year == '2022') ? 'selected' : ''; ?>>2022</option>
                <option value="2023" <?php echo ($selected_year == '2023') ? 'selected' : ''; ?>>2023</option>
                <option value="2024" <?php echo ($selected_year == '2024') ? 'selected' : ''; ?>>2024</option>
                <option value="2025" <?php echo ($selected_year == '2025') ? 'selected' : ''; ?>>2025</option>
            </select>
        </form>
        </div>
        </div>
                        <div class="col-md-2">
                            <?php 
                            $p['pageType'] = 'order';
                            $this->load->view('frontend/component/my_account_side_bar', $p); 
                            ?>
                        </div>
                    <div class="col-md-10">
                    <div class="tab-content account dashboard-content">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <div class="card">
                        <div class="card-body accordion padding0" id="accordionExample">
                            <?php if ($getOrders && count($getOrders) > 0): ?>
                                <?php 
                                $lastOrderId = null;
                                // $total_amount = 0;
                                foreach ($getOrders as $index => $order): 
                                    if ($lastOrderId != $order->order_no):
                                        $lastOrderId = $order->order_no;
                                        $itemCount = count(array_filter($getOrders, fn($o) => $o->order_no === $order->order_no));
                                    // $total_amount = $order->price * $order->qty;


                                    $order_wise_product_details = $this->common_model->getOrderDetailsFun($order->order_no);
                                    $total_amount = 0;
                                    foreach ($order_wise_product_details as $key => $value1) {
                                        $total_amount += (($value1['price']) * ($value1['qty']));
                                    }
                                ?>
                                <?php
                                // echo '<pre>';
                                // print_r($sum);
                                // echo $total_amount; 
                                ?>
                                <div class="my_orders1" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index + 1; ?>" aria-expanded="true" aria-controls="collapse<?php echo $index + 1; ?>">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="shipping_icon">
                                                <span class="material-symbols-outlined">two_wheeler</span>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="order_process_flow">
                                                <div class="order-flow">
                                                    <!-- Order status logic here -->
                                                    <?php $ordProcess = $this->my_libraries->orderProcessSteps($order->customer_id, $order->order_id); ?>
                                                    <?php if (!in_array('Canceled', $ordProcess)): ?>
                                                        <div class="step-container2">
                                                            <label for="placed" class="order_step active"></label>
                                                            <span class="step-label">Placed</span>
                                                        </div>
                                                        <div class="step-container2">
                                                            <span class="dotted-line"></span>
                                                        </div>
                                                        <div class="step-container2">
                                                            <label for="in-process" class="order_step <?php echo (in_array('Received', $ordProcess)) ? 'active' : ''; ?>"></label>
                                                            <span class="step-label">In Process</span>
                                                        </div>
                                                        <div class="step-container2">
                                                            <span class="dotted-line"></span>
                                                        </div>
                                                        <div class="step-container2">
                                                            <label for="packed" class="order_step <?php echo (in_array('Ready to ship', $ordProcess)) ? 'active' : ''; ?>"></label>
                                                            <span class="step-label">Ready to ship</span>
                                                        </div>
                                                        <div class="step-container2">
                                                            <span class="dotted-line"></span>
                                                        </div>
                                                        <div class="step-container2">
                                                            <label for="delivered" class="order_step <?php echo (in_array('Shipped', $ordProcess)) ? 'active' : ''; ?>"></label>
                                                            <span class="step-label">Shipped</span>
                                                        </div>
                                                        <div class="step-container2">
                                                            <span class="dotted-line"></span>
                                                        </div>
                                                        <div class="step-container2">
                                                            <label for="reached" class="order_step <?php echo (in_array('Delivered', $ordProcess)) ? 'active' : ''; ?>"></label>
                                                            <span class="step-label">Delivered</span>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="step-container2">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="cancel_order_sec pb-10">
                                                                        <p class="d-flex"><span class="material-symbols-outlined info_fill">info</span>&nbsp;&nbsp; Cancelled</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="cancel_order_sec pb-10">
                                                                        <p class="d-flex"> Order Amount: Rs <?php echo $order->price * $order->qty; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 viw_btn_col">
                                            <a href="#" class="view-item-btn" data-order-no="<?php echo $order->order_no; ?>" data-bs-toggle="modal" data-bs-target="#viewItemsModal" onclick="getOrderProduct('<?php echo $order->order_no;?>')">
                                                <div class="btn btn_dark float-right">View <?php echo $itemCount;?> Item<?php echo ($itemCount > 1) ? 's' : ''; ?></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        <div id="collapse<?php echo $index + 1; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="ship_delivery">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Order Id: <u><?php echo $order->order_no; ?></u></p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <p>Order Date: <?php echo date("d M, l", strtotime($order->order_date)); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="delivery_info" style="padding-bottom:70px">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Delivery Address</strong></p>
                                        <p><?php echo $order->address_type;?></p>
                                        <p><?php echo $order->address1 . ', ' . $order->address2; ?></p>
                                        <p>
                                            <?php echo $order->area; ?>     
                                        </p>
                                        <p>Ph: <?php echo $order->mobile; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Payment Information</strong></p>
                                        <p>Payment Status: <span class="text-success"><?php //echo $order->payment_status; ?></span>Pending</p>
                                        <p>Mode Of Payment: <?php //echo $order->payment_mode; ?> Cash on delivery</p>
                                    </div>
                                    <div class="col-md-4" style="background: #f9f9f9;">
                                        <p><strong>Order Summary</strong></p>
                                        <div class="order_table">
                                            <?php
                                            // foreach ($getOrders as $order) {
                                            //     $orderTotals[$order->order_no] += $order->qty * $order->price;
                                            ?>
                                            <table>
                                                <tr>
                                                    <th>Order Amount</th>
                                                    <th><strong>Rs. <?php echo $total_amount; ?></strong></th>
                                                </tr>
                                                <tr>
                                                    <td>Savings</td>
                                                    <td><strong class="text-success">Rs. 0.00</strong></td>
                                                </tr>
                                            </table>
                                        <? //}?>
                                        </div>
                                    </div>
                                    <div class="order_view_more_details text-right pt-30">
                                        <a href="<?php echo base_url('order-details/'.$order->order_no); ?>">
                                            View More Details &gt;&gt;
                                        </a>

                                    </div>
                                </div>
                                <a href="<?= base_url('shop') ?>" class="buy-again-btn" target="_blank">Buy Again</a>
                                <button class="btn btn-cancel" data-order-id="12345" onclick="cancelOrder(this);">Cancel</button>
                            </div>
                        </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-orders-message">
                            <div class="nofo" style="text-align: center;margin-left: auto;margin-right: auto;width: 500px;">
                              <img src="<?php echo base_url().'include/frontend/assets/imgs/no_orders.png';?>">
                              <p style="text-align: center;"><h3>No Orders</h3></p>
                            </div>
                        </div>
                    <?php endif; ?>
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

<!-- Modal for View Items -->
<div class="modal fade" id="viewItemsModal" tabindex="-1" aria-labelledby="viewItemsModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewItemsModalLabel">View Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="">
                <div id="viewItemsContent"></div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('frontend/footer'); ?>
<input type="" name="">
<?php
// echo '<pre>';
// print_r(json_encode($getOrders));

?>
<script type="text/javascript">
function getOrderProduct(orderNo) {
    //alert(orderNo);
    $.ajax({
        //alert('step2');
        url: '<?php echo base_url('common/getOrderDetails'); ?>',
        type: 'GET',
        data: { order_no: orderNo },
        success: function(response) {
            console.log('aa=>', response);
            var html = JSON.parse(response);
            console.log('html=>', html);
            $('#viewItemsContent').html(html);
        }
    });
}

function cancelOrder(button) {
    var orderId = button.getAttribute('data-order-id');
    if (confirm('Are you sure you want to cancel the order?')) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo base_url('cart/cancel_order'); ?>", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
                if (xhr.responseText.includes('Order cancelled successfully')) {
                    window.location.href = "<?php echo base_url('my-order'); ?>"; 
                }
            }
        };
        xhr.send("order_id=" + orderId);
    }
} 

function filterOrdersByYear() {
    //alert('ahdkjahds');
    const year = document.getElementById('year_select').value;
    window.location.href = '<?php echo base_url('common/my_order'); ?>/' + year;
}

</script>
