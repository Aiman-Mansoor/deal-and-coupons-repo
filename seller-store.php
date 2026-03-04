<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <?php

        if (isset($_GET['seller_id'])) {
            
            $seller_id = $_GET['seller_id'];

            $seller = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM sellers WHERE id = '$seller_id'"));

        }

    ?>

    <section class="account-sign py-4">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <h3>Seller Store - <?php echo $seller['storename']; ?></h3>

                </div>

            </div>

        </div>

    </section>

    <section class="populerproduct">

        <div class="container">
            
            <div class="row">
                
                <div class="col-md-2">
                    <div>
                        <img src="<?php echo $seller['profile_picture']; ?>" class="img-thumbnail">
                    </div>
                </div>

                <div class="col-md-10">
                    <h5 class="mb-3"><?php echo $seller['storename']; ?></h5>
                    <?php
                        $reviews = mysqli_query($connection, "SELECT * FROM product_reviews WHERE seller_id = '$seller_id'");
                        $countreviews = mysqli_num_rows($reviews);
                        if ($countreviews > 0) {
                            $sum = 0;
                            while ($review = mysqli_fetch_array($reviews)) {
                                $sum = $sum + $review['rating'];
                            }
                            $tr = $sum / $countreviews;
                        } else {
                            $tr = 0;
                        }
                            
                    ?>
                    <p class="mb-3">Ratings (<?php echo number_format((float)$tr, 1, '.', ''); ?>/5)</p>
                    <span class="bg-primary text-white px-2 border mb-2">Verified Seller ✔</span>
                    <p class="mt-3 text-dark">
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2m0-5c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m-7 2.602c0-3.517 3.271-6.602 7-6.602s7 3.085 7 6.602c0 3.455-2.563 7.543-7 14.527-4.489-7.073-7-11.072-7-14.527m7-7.602c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602"/></svg>
                        <?php echo $seller['company_address']; ?>
                    </p>
                </div>

                <div class="col-md-12 mt-5">
                    <h5 class="mb-3">About Seller</h5>
                    <p>
                        <?php echo $seller['about']; ?>
                    </p>
                </div>

                <div class="col-md-12 mt-5">
                    
                    <div class="row">
                        
                        <div class="col-md-12">
                            <h5 class="mb-3">Seller Products</h5>
                        </div>

                        <div class="col-md-12">
                            
                            <div class="row">
                                
                                <?php
                                    $products = mysqli_query($connection, "SELECT * FROM products WHERE seller_id = '$seller_id' AND qty <> 0 AND is_display = 1 ORDER BY off DESC");
                                    while ($product = mysqli_fetch_array($products)) {
                                        ?>
                                        <div class="col-md-3 col-sm-6">
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

            </div>

        </div>

    </section>
    
<?php include("partials/footer.php"); ?>
