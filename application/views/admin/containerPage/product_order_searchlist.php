<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <!-- Include any necessary CSS or JavaScript libraries -->
     
</head>
<body>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    <?php if (!empty($order_list)) {
                        foreach ($order_list as $order) { ?>
                            <tr>
                            <td><?php echo $order['order_no']; ?></td>
                                                <td><?php echo $order['customer_name']; ?></td>
                                                <td><?php echo $order['location']; ?></td>
                                                <td><?php echo $order['order_amount']; ?></td>
                                                
                                                <td class="badge" style="background-color:#F49832;color:white;border:white;"><?php echo !empty($order['order_status']) ? $order['order_status'] : 'Pending'; ?></td>
                                                <td style="background-color: #689F39;"><?php echo !empty($order['pay_status']) ? $order['pay_status'] : 'Pending'; ?></td>
                                                <td><?php echo $order['order_date']; ?></td>
                                <!-- Add more cells as needed -->
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="7">No orders found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
