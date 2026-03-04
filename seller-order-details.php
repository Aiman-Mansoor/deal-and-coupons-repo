<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-2">
                <?php include("partials/seller-sidebar.php"); ?>
            </div>
            <div class="col-md-10">
                <div class="card mt-4 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order #<?php echo $_GET['tracking_number']; ?> Details</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="seller-orders.php" class="badge bg-dark text-white py-2 px-3">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

                    $ordersingle = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM orders WHERE tracking_number = '" . $_GET['tracking_number'] . "' LIMIT 1"));

                ?>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5>Customer Details</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $ordersingle['customer_name']; ?></td>
                                                <td><a href="mailto:<?php echo $ordersingle['customer_email']; ?>"><?php echo $ordersingle['customer_email']; ?></a></td>
                                                <td><a href="tel:<?php echo $ordersingle['customer_phone']; ?>"><?php echo $ordersingle['customer_phone']; ?></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5>Customer Address</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>ZipCode</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $ordersingle['address']; ?></td>
                                                <td><?php echo $ordersingle['city']; ?></td>
                                                <td><?php echo $ordersingle['country']; ?></td>
                                                <td><?php echo $ordersingle['state']; ?></td>
                                                <td><?php echo $ordersingle['zipcode']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5>Products To Deliver</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                    $tracking_number = $_GET['tracking_number'];

                                    $orders = mysqli_query($connection, "SELECT orders.tracking_number, orders.seller_id, orders.customer_id, orders.product_id, orders.original_price, orders.off, orders.qty, orders.shipping_price, orders.coupon_code, orders.coupon_amount, orders.order_date, products.id, products.name, products.picture AS productPicture FROM orders INNER JOIN products ON orders.product_id = products.id WHERE orders.tracking_number = '$tracking_number' AND orders.seller_id = '" . $_SESSION['seller_id'] . "'");
                                ?>
                                <div class="table-reponsive">
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Off</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $shippingrate = 0;
                                                $totalamount = 0;
                                                if (mysqli_num_rows($orders) > 0) {
                                                    $inc = 1;
                                                    while ($order = mysqli_fetch_array($orders)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $inc; ?></td>
                                                            <td>
                                                                <img src="<?php echo $order['productPicture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <?php echo $order['name']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $order['original_price']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $order['off']; ?>%
                                                            </td>
                                                            <td>
                                                                <?php echo $order['qty']; ?>
                                                            </td>
                                                            <td>Rs. 
                                                                <?php
                                                                    if ($order['off'] == 0) {
                                                                        echo $subtotal = $order['original_price'];
                                                                    } else {
                                                                        $new_amount = ($order['off'] / 100) * $order['original_price'];
                                                                        $returningAmount = $order['original_price'] - $new_amount;
                                                                        $offprice = number_format((float)$returningAmount, 2, '.', '');
                                                                        echo $subtotal = $offprice * $order['qty'];
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $inc++;
                                                        $shippingrate = $shippingrate + $order['shipping_price'];
                                                        $totalamount = $totalamount + $subtotal;

                                                    }
                                                                    
                                                    $singleOrder = mysqli_fetch_array(mysqli_query($connection, "SELECT coupon_code, coupon_amount FROM orders WHERE tracking_number = '$tracking_number' LIMIT 1"));

                                                    if (!empty($singleOrder['coupon_code'])) {
                                                        ?>
                                                        <tr class="bg-light">
                                                            <td colspan="4"></td>
                                                            <td>
                                                                <strong>Coupon Applied</strong>
                                                            </td>
                                                            <td>Rs. <?php echo $singleOrder['coupon_amount']; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    <tr class="bg-light">
                                                        <td colspan="4"></td>
                                                        <td>
                                                            <strong>Shipping Rate</strong>
                                                        </td>
                                                        <td>Rs. <?php echo $shippingrate; ?></td>
                                                    </tr>
                                                    <tr class="bg-light">
                                                        <td colspan="4"></td>
                                                        <td>
                                                            <strong>Total</strong>
                                                        </td>
                                                        <td>Rs. 
                                                            <?php

                                                                if (!empty($singleOrder['coupon_code'])) {
                                                                    $orderdetailTotal = $shippingrate + $totalamount;
                                                                    $final = $orderdetailTotal - $singleOrder['coupon_amount'];
                                                                    echo $final;
                                                                } else {
                                                                    $orderdetailTotal = $shippingrate + $totalamount;
                                                                    echo $orderdetailTotal;
                                                                }

                                                            

                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    
                                                } else {

                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                                
                    </div>
                </div>
                
            </div>

        </div>

    </div>

<?php include("partials/footer.php"); ?>
