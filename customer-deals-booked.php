<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
        <?php
            $customer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $_SESSION['customer_id'] . "'"));
        ?>

        <section class="account">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-2">
                        <img src="<?php echo $customer['profile_picture']; ?>" class="img-thumbnail w-100">
                    </div>
                    <div class="col-md-10">
                        <h6 class="font-weight-normal mb-3 mt-4"><strong>Name: </strong><?php echo $customer['name']; ?></h6>
                        <h6 class="font-weight-normal mb-3"><strong>Email: </strong><?php echo $customer['email']; ?></h6>
                        <h6 class="font-weight-normal mb-3"><strong>Phone: </strong><?php echo $customer['phone']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <?php include("partials/customer-sidebar.php"); ?>
                        
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="account-setting pb-0">
                            <h6>Deals Booked</h6>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>Deal Name</th>
                                            <th>Seller Name</th>
                                            <th>Products</th>
                                            <th>Booking Date</th>
                                            <th>Price</th>
                                            <th>Shipping</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $bookings = mysqli_query($connection, "SELECT * FROM deals_booked WHERE customer_id = '" . $_SESSION['customer_id'] . "'");
                                                if (mysqli_num_rows($bookings) > 0) {
                                                    $inc = 1;
                                                    while ($booking = mysqli_fetch_array($bookings)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $inc; ?></td>
                                                            <td>
                                                                <?php
                                                                    $deal = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM deals WHERE id = '" . $booking['deal_id'] . "'"));
                                                                    echo $deal['name'];
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $seller = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM sellers WHERE id = '" . $booking['seller_id'] . "'"));
                                                                    echo $seller['storename'];
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $products = mysqli_query($connection, "SELECT * FROM deal_products WHERE deal_id = '" . $booking['deal_id'] . "'");
                                                                    $i = 1;
                                                                    while ($product = mysqli_fetch_array($products)) {
                                                                        $p = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $product['product_id'] . "'"));
                                                                        ?>
                                                                        <p><strong><?php echo $i. ": " . $p['name']; ?></strong></p>
                                                                        <?php
                                                                        $i++;
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $booking['booking_date']; ?></td>
                                                            <td>Rs. <?php echo $booking['price']; ?></td>
                                                            <td>Rs. <?php echo $booking['shippingrate']; ?></td>
                                                            <td>Rs. <?php echo $booking['price'] + $booking['shippingrate']; ?></td>
                                                            <td><?php echo $booking['status']; ?></td>
                                                        </tr>
                                                        <?php
                                                        $inc++;
                                                    }
                                                } else {
                                                    echo "<tr><td>No Results Found!</td></tr>";
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
        </section>

<?php include("partials/footer.php"); ?>
