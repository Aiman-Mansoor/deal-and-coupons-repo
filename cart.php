<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
    
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                    <h5>Cart</h5>
                </div>
            </div>
        </div>
    </section>
    
    <section class="cart-area">

        <div class="container">

            <?php
            
                if (isset($_POST['applycoupon'])) {
                    
                    $code = $_POST['code'];

                    $checkUsed = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM orders WHERE coupon_code = '$code' AND customer_id = '" . $_SESSION['customer_id'] . "'"));

                    if ($checkUsed == 1) {
                        echo "<div class='alert alert-danger'>Coupon Expired.</div>";
                    } else {
                        
                        $totalprice = $_POST['totalprice'];

                        $checkcoupon = mysqli_query($connection, "SELECT * FROM coupons WHERE code = '$code'");

                        if (mysqli_num_rows($checkcoupon) > 0) {
                            
                            $coupon = mysqli_fetch_array($checkcoupon);



                            if ($coupon['no_of_persons'] == 0) {
                                echo "<div class='alert alert-danger'>Coupon Code is expired.</div>";
                            } else {

                                if ($totalprice >= $coupon['amount_to_apply']) {
                                    
                                    $newleft = $coupon['no_of_persons'] - 1;

                                    $new_amount = ($coupon['off'] / 100) * $totalprice;
                                    $returningAmount = $totalprice - $new_amount;
                                    $offprice = number_format((float)$returningAmount, 2, '.', '');
                                    
                                    $amount = $totalprice - $offprice;

                                    $_SESSION['coupon'] = $amount;
                                    $_SESSION['couponcode'] = $coupon['code'];

                                    $updateusage = mysqli_query($connection, "UPDATE coupons SET no_of_persons = '$newleft' WHERE id = '" . $coupon['id'] . "'");

                                    echo "<div class='alert alert-success'>Coupon is Applied Successfully!</div>";

                                } else {
                                    echo "<div class='alert alert-danger'>Coupon Code can not be applied on this price.</div>";
                                }

                            }

                        } else {
                            echo "<div class='alert alert-danger'>Coupon Code is Invalid.</div>";
                        }

                    }

                }
            ?>

            <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
            ?>

            <?php
                if (isset($_SESSION['customer_id'])) {

                    $carts = mysqli_query($connection, "SELECT * FROM carts WHERE customer_id = '" . $_SESSION['customer_id'] . "'");

                    if (mysqli_num_rows($carts) > 0) {
                        ?>

                        <div class="rows">
                            <div class="cart-items">
                                <div class="header">
                                    <div class="image">
                                        Image
                                    </div>
                                    <div class="name">
                                        Name
                                    </div>
                                    <div class="price">
                                        Prices
                                    </div>
                                    <div class="rating">
                                        Sale in %
                                    </div>
                                    <div class="info">
                                        Info
                                    </div>
                                </div>
                                <div class="body">

                                    <?php
                                        $productTotal = 0;
                                        $shippingTotal = 0;
                                        while ($cart = mysqli_fetch_array($carts)) {
                                            $product = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $cart['product_id'] . "'"));
                                            $seller = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM sellers WHERE id = '" . $product['seller_id'] . "'"));
                                            ?>
                                            <div class="item">
                                                <div class="image">
                                                    <img src="<?php echo $product['picture']; ?>">
                                                </div>
                                                <div class="name">
                                                    <div class="name-text">
                                                        <p><?php echo $product['name']; ?></p>
                                                    </div>
                                                    <div class="button">
                                                        <a class="del text-danger" href="cart.php?remove=<?php echo $cart['id']; ?>">Remove Product</a>
                                                    </div>
                                                </div>
                                                <div class="price">
                                                    <?php
                                                        if($product['off'] == 0) {
                                                            $productprice = $product['price'] * $cart['qty'];
                                                            ?>
                                                            <span class="new_price">Rs. <?php echo $product['price']; ?></span>
                                                            <?php
                                                        } else {

                                                            $new_amount = ($product['off'] / 100) * $product['price'];
                                                            $returningAmount = $product['price'] - $new_amount;
                                                            $offprice = number_format((float)$returningAmount, 2, '.', '');
                                                            $productprice = $offprice * $cart['qty'];
                                                            ?>
                                                            <del>Rs. <?php echo $product['price']; ?></del> – <span>Rs. <?php echo $offprice; ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                                <div class="rating">
                                                    <?php echo $product['off']; ?>%
                                                </div>
                                                <div class="info">
                                                    <div class="quantity">
                                                        <div class="product-pricelist-selector-quantity">
                                                            <h6>quantity</h6>
                                                            <div class="wan-spinner wan-spinner-4">
                                                                <select name="qty" class="form-control" onchange="location = this.value;">
                                                                    <option value="<?php echo $cart['qty']; ?>"><?php echo $cart['qty']; ?></option>
                                                                    <?php
                                                                        for ($i=1; $i < $product['qty']; $i++) { 
                                                                            ?>
                                                                            <option value="cart.php?cart_id=<?php echo $cart['id'] ?>&qty=<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $productTotal = $productTotal + $productprice;

                                            $multiplyShipping = $seller['shippingrate'];

                                            $shippingTotal = $shippingTotal + $multiplyShipping;
                                        }
                                    ?>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                    if (isset($_SESSION['coupon'])) {
                                        ?>
                                        <div class="apply-coupon">
                                            <h6>Coupon Applied</h6>
                                            <!-- <form action="" method="POST"> -->
                                                <div class="form__div">
                                                    <input type="text" class="form__input text-uppercase" value="<?php if(isset($_SESSION['couponcode'])) { echo $_SESSION['couponcode']; }; ?>" disabled="">
                                                    <label for="" class="form__label">Coupon Code</label>
                                                </div>
                                                <button class="btn bg-primary" disabled="">apply COUPON</button>
                                            <!-- </form> -->
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="apply-coupon">
                                            <h6>Apply Coupon</h6>
                                            <form action="" method="POST">
                                                <input type="hidden" name="totalprice" value="<?php echo $productTotal; ?>">
                                                <div class="form__div">
                                                    <input type="text" name="code" class="form__input text-uppercase" placeholder=" ">
                                                    <label for="" class="form__label">Coupon Code</label>
                                                </div>
                                                <button class="btn bg-primary" type="submit" name="applycoupon">apply COUPON</button>
                                            </form>
                                        </div>
                                        <?php
                                    }
                                ?>
                                        
                            </div>
                            <div class="col-lg-6">
                                <?php
                                    $checkBilling = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM billing_information WHERE customer_id = '" . $_SESSION['customer_id'] . "'"));
                                    if ($checkBilling > 0) {

                                        $address = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM billing_information WHERE customer_id = '" . $_SESSION['customer_id'] . "'"));

                                        ?>
                                        <div class="card mt-5">
                                            <div class="card-body">
                                                <h6>Billing information</h6>
                                                <form action="" method="POST">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form__div">
                                                                <input type="text" name="address" value="<?php if(isset($address['address'])) { echo $address['address']; } ?>" class="form__input bg-light" placeholder="
                                                                " readonly style="cursor: not-allowed;">
                                                                <label for="" class="form__label">Address</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form__div mb-0">
                                                                <input type="text" name="city" value="<?php if(isset($address['city'])){ echo $address['city']; } ?>" class="form__input bg-light" placeholder="
                                                                " readonly style="cursor: not-allowed;">
                                                                <label for="" class="form__label">City</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-12 mt-30">
                                                            <div class="form__div mb-0">
                                                                <input type="text" name="country" value="<?php if(isset($address['country'])) { echo $address['country']; } ?>" class="form__input bg-light" placeholder="
                                                                " readonly style="cursor: not-allowed;">
                                                                <label for="" class="form__label">Country</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-12 mt-30">
                                                            <div class="form__div mb-0">
                                                                <input type="text" name="state" value="<?php if(isset($address['state'])) { echo $address['state']; } ?>" class="form__input bg-light" placeholder="
                                                                " readonly style="cursor: not-allowed;">
                                                                <label for="" class="form__label">State</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-12 mt-30">
                                                            <div class="form__div">
                                                                <input type="text" name="zipcode" value="<?php if(isset($address['zipcode'])) { echo $address['zipcode']; } ?>" class="form__input bg-light" placeholder="
                                                                " readonly style="cursor: not-allowed;">
                                                                <label for="" class="form__label">Zip Code</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="card mt-5">
                                            <div class="card-body bg-info">
                                                <p class="text-center text-white">Update Billing Information to Checkout.</p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                                        
                                <div class="card-price">
                                    <h6>Check Summery</h6>
                                    <div class="card-price-list d-flex justify-content-between align-items-center">
                                        <div class="item">
                                            <p><?php echo mysqli_num_rows($carts); ?> item</p>
                                        </div>
                                        <div class="price">
                                            <p>Rs. <?php echo $productTotal; ?></p>
                                        </div>
                                    </div>
                                    <?php
                                        if (isset($_SESSION['coupon'])) {
                                            ?>
                                            <div class="card-price-list d-flex justify-content-between align-items-center">
                                                <div class="item">
                                                    <p>Coupon Applied</p>
                                                </div>
                                                <div class="price">
                                                    <p><strong>-</strong> <?php echo $_SESSION['coupon']; ?></p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                    <div class="card-price-list d-flex justify-content-between align-items-center">
                                        <div class="item">
                                            <p>Shipping Cast</p>
                                        </div>
                                        <div class="price">
                                            <p>Rs. <?php echo $shippingTotal; ?></p>
                                        </div>
                                    </div>
                                    <div class="card-price-subtotal d-flex justify-content-between align-items-center">
                                        <div class="total-text">
                                            <p>Total Price</p>
                                        </div>
                                        <div class="total-price">

                                            <?php
                                                $totalCart = $productTotal + $shippingTotal;

                                                if (isset($_SESSION['coupon'])) {
                                                    $finalCartAmount = $totalCart - $_SESSION['coupon'];
                                                } else {
                                                    $finalCartAmount = $totalCart;
                                                }

                                            ?>
                                            <p>Rs. <?php echo $finalCartAmount; ?></p>
                                        </div>
                                    </div>
                                    <form action="#">
                                        <?php
                                            if ($checkBilling > 0) {
                                                ?>
                                                <a href="checkout.php" class="btn bg-primary" type="submit" style="width: 100%;">Checkout Now</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="billing-information.php" class="btn bg-primary" type="submit" style="width: 100%;">Update Billing Information to Checkout</a>
                                                <?php
                                            }
                                        ?>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                    } else {
                        ?>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="card border-0 shadow">
                                    <div class="card-body py-5">
                                        <h4 class="text-center">Cart is Empty!</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                } else {
                    ?>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="card border-0 shadow">
                                <div class="card-body py-5">
                                    <h4 class="text-center">Cart is Empty!</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>

        </div>

    </section>

    <?php
        if (isset($_GET['cart_id']) AND isset($_GET['qty'])) {
            
            $cart_id = $_GET['cart_id'];

            $qty = $_GET['qty'];

            $update = mysqli_query($connection, "UPDATE carts SET qty = '$qty' WHERE id = '$cart_id'");

            if ($update) {
                header("Location: cart.php");
            } else {
                echo mysqli_error($connection);
            }

        }
        if (isset($_GET['remove'])) {
            $id = $_GET['remove'];
            $delete = mysqli_query($connection, "DELETE FROM carts WHERE id = '$id'");
            $_SESSION['msg'] = "<div class='alert alert-info'>Product Removed from cart.</div>";
            header("Location: cart.php");
        }
    ?>

<?php include("partials/footer.php"); ?>
