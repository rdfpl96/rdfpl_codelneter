<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <div class="mob_back_btn">
                        <h2 style="padding-top: 8px; color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                    </div>
                    <h3 class="fw-bold mb-0">Orders List</h3>
                    <div class="loaderdiv" style="position: absolute; z-index: 99999999; float: right; margin-left: 70%;"></div>
                </div>
            </div>
        </div> <!-- Row end -->

        <div class="row g-3 mb-3">
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/export_OrderList'); ?>" method="POST">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="filter-search">
                                        <label class="form-label">Search Orders</label>
                                        <input type="text" placeholder="Search" class="form-control" name="getKeywords" id="search-orders">
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">From Date</label>
                                            <input type="date" class="form-control w-100 searchDate" name="fromDate" id="fromDate" value="">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">To Date</label>
                                            <input type="date" class="form-control w-100 searchDate" id="toDate" name="toDate" value="">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="form-label btn btn-sm btn-secondary" style="color:white; margin-top: 10.9%;">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Export</span>
                                            </button>


                                        </div>

                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary" >Search</button>
                                    </button>
                                </div> -->
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- Row end -->

        <div class="g-3 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="padding: 0px 2% 2% !important;">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 clssn" style="white-space: nowrap; width: 100%;">
                                <thead>
                                    <tr>
                                        <th><span>&nbsp;</span><br>Order Id</th>
                                        <th><span>&nbsp;</span><br>Customer Name</th>
                                        <th><span>&nbsp;</span><br>Location</th>
                                        <th style="text-align: center;">
                                            <i class="fa fa-inr" aria-hidden="true" style="font-weight: bold; font-size: 17px;"></i>
                                            <span style="font-weight: bold; font-size: 19px;" class="tot-Amu"><?php echo ($order_list != 0) ? $order_amount[0]->total_amount : 0.00; ?></span><br>Order amount
                                        </th>
                                        <th><span>&nbsp;</span><br>Status</th>
                                        <th><span>&nbsp;</span><br>Pay Status</th>
                                        <th><span>&nbsp;</span><br>Order Date</th>
                                        <th><span>&nbsp;</span><br>View Order Details</th>
                                        <!-- <th><span>&nbsp;</span><br>Details</th> -->
                                    </tr>
                                </thead>
                                <tbody id="trRow">
                                    <?php if (!empty($order_list)) {
                                        foreach ($order_list as $order) { ?>
                                            <tr>
                                                <td><?php echo $order['order_no']; ?></td>
                                                <td><?php echo $order['customer_name']; ?></td>
                                                <td><?php echo $order['location']; ?></td>
                                                <td><?php echo $order['order_amount']; ?></td>
                                                <td style="background-color:#F49832;color:white;border:white;"><?php echo !empty($order['order_status']) ? $order['order_status'] : 'Pending'; ?></td>
                                                <td style="background-color:#F49832;color:white;border:white;"><?php echo !empty($order['pay_status']) ? $order['pay_status'] : 'Pending'; ?></td>

                                                <td><?php echo date('Y-m-d', strtotime($order['order_date'])); ?></td>
                                                <td><a href="<?php echo base_url('admin/order_details/' . $order['order_no']);
                                                                ?>" class="btn btn-primary">View Details</a></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="8">No orders found.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div id="pagint-div" style="float: right;">
                            <?php echo $links; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Row end -->
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-orders').keyup(function() {

            // var searchText = $(this).val();

            $.ajax({
                url: "<?php echo base_url('admin/search_order_list') ?>",
                type: 'POST',
                data: {
                    searchText: $('#search-orders').val(),
                    fromDate: $('#fromDate').val(),
                    toDate: $('#toDate').val()
                },
                success: function(response) {
                    $('#trRow').html(response);
                }
            });

        });
    });

    $(document).ready(function() {
        $('.searchDate').on('change', function() {

            // var searchText = $(this).val();

            $.ajax({
                url: "<?php echo base_url('admin/search_order_list') ?>",
                type: 'POST',
                data: {
                    searchText: $('#search-orders').val(),
                    fromDate: $('#fromDate').val(),
                    toDate: $('#toDate').val()
                },
                success: function(response) {
                    $('#trRow').html(response);
                }
            });

        });
    });
</script>