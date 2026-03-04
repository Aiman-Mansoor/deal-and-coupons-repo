<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <section class="account-sign py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>All Products</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="populerproduct">
        <div class="container">
            <div class="row">
                <?php
                    $products = mysqli_query($connection, "SELECT * FROM products WHERE qty <> 0 AND is_display = 1");
                    if (mysqli_num_rows($products) > 0) {
                        while ($product = mysqli_fetch_array($products)) {
                            ?>
                            <div class="col-md-4 col-sm-6">
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
        </div>
    </section>
    
<?php include("partials/footer.php"); ?>
