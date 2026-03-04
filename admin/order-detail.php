<?php include("partials/head.php"); ?>

    <?php include("partials/sidebar.php"); ?>

    <?php include("partials/topnav.php"); ?>

    <?php

        $tracking_number = $_GET['tracking_number'];

        $single = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM orders WHERE tracking_number = '$tracking_number' LIMIT 1"));

        $seller = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM sellers WHERE id = '" . $single['seller_id'] . "'"));

        $customer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $single['customer_id'] . "'"));

    ?>

    <div class="row">

        <div class="col-lg-12">

            <div class="row">
                <div class="col-md-6">
                    
                    <div class="page-header">

                        <div class="page-title">
                            <h1>Orders</h1>
                        </div>

                    </div>

                </div>
                <div class="col-md-6 text-right">
                    
                    <div class="page-header">

                        <div class="page-title">
                            <a href="orders.php" class="btn btn-dark">Go Back</a>
                        </div>

                    </div>



                </div>
            </div>

        </div>
        
    </div>
    
    <section id="main-content">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <h4 class="mb-3">Seller Info</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>Store Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th class="text-center">Company Address</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="../<?php echo $seller['profile_picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;">
                                        <strong><?php echo $seller['storename']; ?></strong>
                                    </td>
                                    <td>
                                        <a href="mailto:<?php echo $seller['email']; ?>" class="text-primary"><?php echo $seller['email']; ?></a>
                                    </td>
                                    <td><a href="tel:<?php echo $seller['phone_number']; ?>" class="text-primary"><?php echo $seller['phone_number']; ?></a></td>
                                    <td class="text-center">
                                        <?php echo $seller['company_address']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <h4 class="mb-3">Customer Details</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-center">Phone</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="../<?php echo $customer['profile_picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;">
                                        <?php echo $customer['name']; ?>
                                    </td>
                                    <td>
                                        <a href="mailto:<?php echo $customer['email']; ?>" class="text-primary"><?php echo $customer['email']; ?></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="tel:<?php echo $customer['phone']; ?>" class="text-primary"><?php echo $customer['phone']; ?></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <h4 class="mb-3">Customer Address</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>Address</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>State</th>
                                <th class="text-center">Zip Code</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $single['address']; ?></td>
                                    <td><?php echo $single['city']; ?></td>
                                    <td><?php echo $single['country']; ?></td>
                                    <td><?php echo $single['state']; ?></td>
                                    <td><?php echo $single['zipcode']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">

                <div class="card">

                    <h4 class="mb-3">Products Ordered</h4>
                    
                    <?php
                        
                        $orders = mysqli_query($connection, "
                                SELECT orders.tracking_number, orders.seller_id, orders.customer_id, orders.product_id, orders.original_price, orders.off, orders.qty, orders.shipping_price, orders.coupon_code, orders.coupon_amount, orders.order_date, products.id, products.name, products.picture AS productPicture FROM orders INNER JOIN products ON orders.product_id = products.id WHERE orders.tracking_number = '$tracking_number'
                            ");
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
                                                    <img src="../<?php echo $order['productPicture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <?php echo $order['name']; ?>
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

    </section>

<?php include("partials/footer.php"); ?>