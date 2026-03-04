<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
    
    <?php
        
    ?>

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order Placed</li>
                        </ol>
                    </nav>
                    <h5>Order Placed</h5>
                </div>
            </div>
        </div>
    </section>
    
    <section class="cart-area">

        <div class="container">

            <?php

                $carts = mysqli_query($connection, "SELECT * FROM carts WHERE customer_id = '" . $_SESSION['customer_id'] . "'");

                $couponcode;
                $coupon;

                if (isset($_SESSION['couponcode'])) {
                    $couponcode = $_SESSION['couponcode'];
                } else {
                    $couponcode = '';
                }

                if (isset($_SESSION['coupon'])) {
                    $coupon = $_SESSION['coupon'];
                } else {
                    $coupon = '';
                }

                // echo $_SESSION['couponcode'];

                // exit();

                if (mysqli_num_rows($carts) > 0) {
                    
                    $customer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $_SESSION['customer_id'] . "'"));

                    $billing = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM billing_information WHERE customer_id = '" . $_SESSION['customer_id'] . "'"));

                    $countorders = mysqli_query($connection, "SELECT * FROM orders ORDER BY id DESC LIMIT 1");

                    if (mysqli_num_rows($countorders) > 0) {
                        $lasttn = mysqli_fetch_array($countorders);
                        $tracking_number = $lasttn['tracking_number'] + 1;
                    } else {
                        $tracking_number = 1001;
                    }

                    

                    $productTotal = 0;

                    $shippingTotal = 0;

                    while ($cart = mysqli_fetch_array($carts)) {

                        $product = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $cart['product_id'] . "'"));
                        $seller = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM sellers WHERE id = '" . $product['seller_id'] . "'"));
                        
                        $newqty = $product['qty'] - $cart['qty'];

                        $minusqty = mysqli_query($connection, "UPDATE products SET qty = '$newqty' WHERE id = '" . $cart['product_id'] . "'");

                        $seller_id              = $product['seller_id'];
                        $customer_id            = $_SESSION['customer_id'];
                        $product_id             = $cart['product_id'];
                        $original_price         = $product['price'];
                        $off                    = $product['off'];
                        $qty                    = $cart['qty'];
                        $shipping_price         = $seller['shippingrate'];
                        $coupon_code            = $couponcode;
                        $coupon_amount          = $coupon;
                        $address                = $billing['address'];
                        $city                   = $billing['city'];
                        $country                = $billing['country'];
                        $state                  = $billing['state'];
                        $zipcode                = $billing['zipcode'];
                        $customer_name          = $customer['name'];
                        $customer_email         = $customer['email'];
                        $customer_phone         = $customer['phone'];
                        $order_date             = date("Y-m-d");

                        $orderquery = mysqli_query($connection, "INSERT INTO orders(tracking_number, seller_id, customer_id, product_id, original_price, off, qty, shipping_price, coupon_code, coupon_amount, address, city, country, state, zipcode, customer_name, customer_email, customer_phone, order_date) VALUES('$tracking_number', '$seller_id', '$customer_id', '$product_id', '$original_price', '$off', '$qty', '$shipping_price', '$coupon_code', '$coupon_amount', '$address', '$city', '$country', '$state', '$zipcode', '$customer_name', '$customer_email', '$customer_phone', '$order_date')");

                        if($orderquery) {
                            
                            $removecart = mysqli_query($connection, "DELETE FROM carts WHERE id = '" . $cart['id'] . "'");
                        } else {
                            echo mysqli_error($connection);
                        }

                        

                    }
                    unset($_SESSION['coupon']);
                    unset($_SESSION['couponcode']);
                } else {
                    header("Location: cart.php");
                }

            ?>
                  
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body text-center pt-5 pb-5">
                        <img src="images/logo.png" class="img-fluid w-75">
                        <h4 class="pt-5 pb-3">Order Recieved</h4>
                        <p>Please Check Your Profile for Order Details.</p>
                        <a href="my-orders.php" class="btn btn-dark mt-5">My Orders</a>
                    </div>
                </div>
            </div>

        </div>

    </section>

<?php include("partials/footer.php"); ?>
