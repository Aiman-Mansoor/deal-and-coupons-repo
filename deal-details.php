<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <?php
        if (isset($_GET['deal_id'])) {
            
            $deal_id = $_GET['deal_id'];

            $deal = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM deals WHERE id = '$deal_id'"));

            $seller = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM sellers WHERE id = '" . $deal['seller_id'] . "'"));

        }
    ?>

    <section class="account-sign py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Deal Name - <?php echo $deal['name']; ?></h3>
                </div>
            </div>
        </div>
    </section>

    <section class="populerproduct">
        <div class="container">
            <?php

                if (isset($_GET['deal_id']) AND isset($_GET['seller_id']) AND isset($_GET['deal_price']) AND isset($_GET['shippingrate'])) {
                    
                    $deal_id = $_GET['deal_id'];

                    $seller_id = $_GET['seller_id'];

                    $customer_id = $_SESSION['customer_id'];

                    $deal_price = $_GET['deal_price'];

                    $shippingrate = $_GET['shippingrate'];

                    $save = mysqli_query($connection, "INSERT INTO deals_booked(deal_id, seller_id, customer_id, price, shippingrate, booking_date) VALUES('$deal_id', '$seller_id', '$customer_id', '$deal_price', '$shippingrate', now())");

                    echo "<div class='alert alert-success'>Deal Booked Successfully! <a href='customer-deals-booked.php'>View Booking</a></div>";

                }
            
            ?>
            <div class="row mb-4">

                <div class="col-md-4 mb-4">
                    <img src="<?php echo $deal['picture']; ?>" style="height: 230px;" class="img-thumbnail">
                </div>

                <div class="col-md-8">
                    <h4 class="mb-3"><?php echo $deal['name']; ?></h4>
                    <p class="mb-3"><strong>Price: </strong>Rs. <?php echo $deal['price']; ?></p>
                    <p><strong>Shipping: </strong>Rs. <?php echo $seller['shippingrate']; ?></p>
                    <?php
                        if (isset($_SESSION['customer_id'])) {
                            $checkBilling = mysqli_query($connection, "SELECT * FROM billing_information WHERE customer_id = '" . $_SESSION['customer_id'] . "'");
                            if (mysqli_num_rows($checkBilling) > 0) {
                                ?>
                                <a href="deal-details.php?deal_id=<?php echo $deal['id'];?>&seller_id=<?php echo $deal['seller_id'] ?>&deal_price=<?php echo $deal['price']; ?>&shippingrate=<?php echo $seller['shippingrate']; ?>" class="btn btn-dark mt-4">Order Now!</a>
                                <?php
                            } else {
                                ?>
                                <a href="billing-information.php" class="btn btn-dark mt-4">Update Billing to Get the Deal</a>
                                <?php
                            }
                            ?>
                            
                            <?php
                        } else {
                            ?>
                            <a href="customer-authentication.php" class="btn btn-dark mt-4">Login</a>
                            <?php
                        }
                    ?>
                    
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <h3>Products Includes</h3>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <?php

                            $deal_products = mysqli_query($connection, "SELECT * FROM deal_products WHERE deal_id = '$deal_id'");

                            while ($single = mysqli_fetch_array($deal_products)) {
                                $product = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $single['product_id'] . "'"));
                                ?>
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <div class="product-item-image">
                                            <a href="product-details.php?product_id=<?php echo $product['id']; ?>"><img src="<?php echo $product['picture']; ?>" alt="Product Name"
                                                    class="img-fluid"></a>
                                            <div class="cart-icon">
                                                <a href="product-details.php?product_id=<?php echo $product['id']; ?>" class="w-100 bg-transparent">
                                                    <?php
                                                    if ($product['off'] != 0) {
                                                        echo "<span class='off'>" . $product['off'] . " % Off</span>";
                                                    }
                                                ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-item-info">
                                            <a href="product-details.php?product_id=<?php echo $product['id']; ?>">
                                                <?php echo $product['name']; ?>
                                                
                                            </a>
                                            <?php
                                                if($product['off'] == 0) {
                                                    ?>
                                                    <span class="new_price">Rs. <?php echo $product['price']; ?></span>
                                                    <?php
                                                } else {

                                                    $new_amount = ($product['off'] / 100) * $product['price'];
                                                    $returningAmount = $product['price'] - $new_amount;
                                                    $offprice = number_format((float)$returningAmount, 2, '.', '');
                                                    ?>
                                                    <del>Rs. <?php echo $product['price']; ?></del> – <span>Rs. <?php echo $offprice; ?></span>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                        ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
    
<?php include("partials/footer.php"); ?>
