<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-2">
                <?php include("partials/seller-sidebar.php"); ?>
            </div>
            <div class="col-md-10">
                <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Deal Bookings</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Deal Name</th>
                                    <th>Customer Name</th>
                                    <th>Products</th>
                                    <th>Price</th>
                                    <th>Shipping</th>
                                    <th>Total</th>
                                    <th>Booking Date</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $bookings = mysqli_query($connection, "SELECT * FROM deals_booked WHERE seller_id = '" . $_SESSION['seller_id'] . "'");
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
                                                        <br>
                                                        <a href="seller-deals-booked.php?deliver=<?php echo $booking['id']; ?>" onclick="return confirm('Are you sure you want to deliver this order?')">Deliver Order</a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $customer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $booking['customer_id'] . "'"));

                                                            $billing = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM billing_information WHERE customer_id = '" . $booking['customer_id'] . "'"));

                                                        ?>
                                                        <p><?php echo $customer['name']; ?></p>
                                                        <p><a href="tel:<?php echo $customer['phone']; ?>"><?php echo $customer['phone']; ?></a></p>
                                                        <p><a href="mailto:<?php echo $customer['email']; ?>"><?php echo $customer['email']; ?></a></p>
                                                        <p><strong>Address: </strong> <?php echo $billing['address'] . ", " . $billing['zipcode'] . ", <br>" . $billing['city'] . ", " . $billing['state'] . ", " . $billing['country']; ?></p>
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
                                                    <td>Rs. <?php echo $booking['price']; ?></td>
                                                    <td>Rs. <?php echo $booking['shippingrate']; ?></td>
                                                    <td>Rs. <?php echo $booking['price'] + $booking['shippingrate']; ?></td>
                                                    <td><?php echo $booking['booking_date']; ?></td>
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

    <?php

        if (isset($_GET['deliver'])) {
            
            $id = $_GET['deliver'];

            $changestatus = mysqli_query($connection, "UPDATE deals_booked SET status = 'Delivered' WHERE id = '$id'");

            $_SESSION['msg'] = "<div class='alert alert-success'>Booking Status Changed.</div>";

            header("Location: seller-deals-booked.php");

        }

    ?>

<?php include("partials/footer.php"); ?>
