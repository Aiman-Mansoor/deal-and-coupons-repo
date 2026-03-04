<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
        <section class="banner-area">

            <div class="container-fluid">

                <div class="row">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                          <img src="images/slides/1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="images/slides/2.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="images/slides/3.png" class="d-block w-100" alt="...">
                        </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>

            </div>

        </section>

        <style>
            .owl-item {
                margin-right: 20px;
            }
        </style>

        <section class="py-5">
            <div id="demo" class="container">
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <h3>Deals</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">

                            <div id="owl-example" class="owl-carousel">
                                <?php
                                    $deals = mysqli_query($connection, "SELECT * FROM deals");
                                    while ($deal = mysqli_fetch_array($deals)) {
                                        ?>
                                        <a href="deal-details.php?deal_id=<?php echo $deal['id']; ?>" class="item col-md-4 mb-3">
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
                </div>
            </div>
                
        </section>

        <section class="populerproduct">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>Popular Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $orders = mysqli_query($connection, "SELECT * FROM orders GROUP BY product_id ASC LIMIT 6");
                        while ($order = mysqli_fetch_array($orders)) {
                            $products = mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $order['product_id'] . "'");
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
                        }
                            
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="products.php" class="btn bg-primary">View All Products</a>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="categorys">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>Shop with top categorys</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $categories = mysqli_query($connection, "SELECT * FROM categories");
                        while ($category = mysqli_fetch_array($categories)) {
                            ?>
                            <div class="col-md-4">
                                <div class="productcategory text-center shadow p-3 pb-5">
                                    <div class="productcategory-img">
                                        <a href="product-by-category.php?category_id=<?php echo $category['id']; ?>"><img src="<?php echo $category['picture']; ?>" alt="images" style="height: 200px;"></a>
                                    </div>
                                    <div class="productcategory-text">
                                        <a href="product-by-category.php?category_id=<?php echo $category['id']; ?>">
                                            <h6><?php echo $category['name']; ?></h6>
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
