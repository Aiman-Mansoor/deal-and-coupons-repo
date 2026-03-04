<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <?php
        if (isset($_GET['category_id'])) {
            
            $category_id = $_GET['category_id'];

            $category = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM categories WHERE id = '$category_id'"));

        }
    ?>

    <section class="account-sign py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Products By Category - <?php echo $category['name']; ?></h3>
                </div>
            </div>
        </div>
    </section>

        <section class="py-5">
            <div id="demo" class="container">
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <h3>Coupons</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">

                            <div id="owl-example" class="owl-carousel">
                                <?php
                                    $coupons = mysqli_query($connection, "SELECT * FROM coupons");
                                    if (mysqli_num_rows($coupons) > 0) {
                                        
                                        while ($coupon = mysqli_fetch_array($coupons)) {
                                            ?>
                                            <div class="col-md-12">
                                                <div class="product-item shadow">
                                                    <div class="product-item-image mb-0">
                                                        <a>
                                                            <img src="<?php echo $coupon['picture']; ?>" alt="Product Name" class="img-fluid border-bottom" style="height: 200px;width: 100%;">
                                                        </a>
                                                    </div>
                                                    <div class="product-item-info text-center py-4">
                                                        <a href="#" class="border-bottom pb-3">
                                                            <?php echo $coupon['name']; ?>
                                                            
                                                        </a>
                                                        <h6 class="font-weight-normal border-bottom pb-3 pt-2">
                                                            <strong>Off: </strong><?php echo $coupon['off']; ?>%
                                                        </h6>
                                                        <h6 class="font-weight-normal border-bottom pb-3 pt-2">
                                                            <strong>Code: </strong><?php echo $coupon['code']; ?>
                                                        </h6>
                                                        <h6 class="font-weight-normal pt-2">
                                                            <strong>On Amount: </strong>Rs. <?php echo round($coupon['amount_to_apply'], 0); ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }

                                    } else {

                                    }
                                ?>
                            </div>

                                
                        </div>
                    </div>
                </div>
            </div>
                
        </section>

    <section class="populerproduct">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <h3>Deals</h3>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <?php
                            $deals = mysqli_query($connection, "SELECT * FROM deals WHERE category_id = '$category_id'");
                            while ($deal = mysqli_fetch_array($deals)) {
                                ?>
                                <a href="deal-details.php?deal_id=<?php echo $deal['id']; ?>" class="col-md-3 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo $deal['picture']; ?>" class="img-thumbnail" style="height: 230px;">
                                            <h5 class="py-2"><?php echo $deal['name']; ?></h5>
                                            <p>Rs. <?php echo $deal['price']; ?></p>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <?php
                    $products = mysqli_query($connection, "SELECT * FROM products WHERE category_id = '$category_id' AND off <> 0 AND is_display = 1 AND qty <> 0");
                    if (mysqli_num_rows($products) > 0) {
                        while ($product = mysqli_fetch_array($products)) {
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
                    } else {
                        ?>
                        <div class="col-md-12">
                            <h4>No Product found in this category.</h4>
                        </div>
                        <?php
                    }
                        
                ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-5">Our Sellers</h2>
                </div>
                <?php
                    $sellers = mysqli_query($connection, "SELECT * FROM products WHERE category_id = '$category_id' GROUP BY seller_id");
                    while ($single = mysqli_fetch_array($sellers)) {

                        $seller = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM sellers WHERE id = '" . $single['seller_id'] . "'"));

                        ?>
                        <div class="col-md-3">
                            <div class="product-item shadow p-3 text-center bg-white">
                                <div class="product-item-image">
                                    <a href="seller-store.php?seller_id=<?php echo $seller['id']; ?>">
                                        <img src="<?php echo $seller['profile_picture']; ?>" alt="Product Name"
                                            class="img-fluid">
                                    </a>
                                </div>
                                <div class="product-item-info">
                                    <span class="bg-primary text-white px-2 border mb-2">Verified Seller ✔</span>
                                    <a href="seller-store.php?seller_id=<?php echo $seller['id']; ?>">
                                        <?php echo $seller['storename']; ?>
                                        <p class="text-body mb-3 mt-2">View Profile</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                ?>
            </div>
        </div>
    </section>
    
<?php include("partials/footer.php"); ?>
