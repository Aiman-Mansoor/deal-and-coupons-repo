<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
    
    <?php
        if (isset($_GET['product_id'])) {
            
            $product_id = $_GET['product_id'];

            $product = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM products WHERE id = '$product_id'"));

            if($product['is_display'] == 0) {
                header("Location: seller-store.php?seller_id=".$product['seller_id']);
            }

            $seller = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM sellers WHERE id = '" . $product['seller_id'] . "'"));

            $category = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM categories WHERE id = '" . $product['category_id'] . "'"));

            $galleries = mysqli_query($connection, "SELECT * FROM product_galleries WHERE product_id = '" . $product['id'] . "'");

        }

        if (isset($_GET['product_id']) AND isset($_GET['wishlists'])) {
            
            $customer_id = $_SESSION['customer_id'];
            $wishlist_id = $_GET['wishlists'];

            $checkExist = mysqli_query($connection, "SELECT * FROM wishlists WHERE customer_id = '$customer_id' AND product_id = '$wishlist_id'");

            if (mysqli_num_rows($checkExist) > 0) {
                
                echo "<div class='alert alert-danger'>Product Already Added to Wishlist.</div>";

            } else {

                $save = mysqli_query($connection, "INSERT INTO wishlists(customer_id, product_id) VALUES('$customer_id', '$wishlist_id')");

                echo "<div class='alert alert-success'>Product Added to Wishlist.</div>";

            }

        }

        if (isset($_GET['product_id']) AND isset($_GET['addtocart'])) {
            
            $product_id = $_GET['addtocart'];

            $customer_id = $_SESSION['customer_id'];

            $checkExist = mysqli_query($connection, "SELECT * FROM carts WHERE customer_id = '$customer_id' AND product_id = '$product_id'");

            if (mysqli_num_rows($checkExist) > 0) {
                
                echo "<div class='alert alert-danger'>Product Already Added to Cart.</div>";

            } else {
                
                $save = mysqli_query($connection, "INSERT INTO carts(customer_id, product_id, qty) VALUES('$customer_id', '$product_id', 1)");

                echo "<div class='alert alert-success'>Product Added to Cart.</div>";

            }

        }

    ?>

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page"><?php echo $category['name']; ?></li>
                            <li class="breadcrumb-item" aria-current="page"><?php echo $product['name']; ?></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                    <h5>Detail</h5>
                </div>
            </div>
        </div>
    </section>
    
    <section class="product">
        <div class="container">
            <div class="row mb-5 pb-4">
                <div class="col-lg-6 col-md-5 col-12">
                    <div class="product-slider">
                        <div class="exzoom" id="exzoom">
                            <div class="exzoom_img_box">
                                <div class="featuredImage">
                                    <img src="<?php echo $product['picture']; ?>" class="imgtochange"/>
                                </div>
                                <ul class='exzoom_img_ul' style="display: flex;">

                                    <?php
                                        while ($gallery = mysqli_fetch_array($galleries)) {
                                            ?>
                                            <li style="border: 1px solid #e4e1e1;padding: 5px;margin-right: 10px;width:100px;">
                                                <a class="galleryImage" rel="<?php echo $gallery['image']; ?>">
                                                    <img src="<?php echo $gallery['image']; ?>" />
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-7 col-12">
                    <div class="product-pricelist">
                        <h2><?php echo $product['name']; ?></h2>
                        <div class="product-pricelist-ratting">
                            <div class="price">
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
                        <p class="mb-3">
                            <strong>Category: </strong> <?php echo $category['name']; ?>
                        </p>
                        <p class="mb-3">
                            <strong>Quantity: </strong> In Stock
                        </p>
                        <p class="mb-3">
                            <strong>Sold By: </strong> <a href="seller-store.php?seller_id=<?php echo $seller['id']; ?>"><?php echo $seller['storename']; ?></a>
                        </p>
                        <p>
                            <?php echo $product['description']; ?>
                        </p>
                        <p class="mb-5 mt-3">
                            <strong>Tags: </strong><?php echo $product['tags']; ?>
                        </p>
                        <div class="product-pricelist-selector-button">
                            <?php
                                if (isset($_SESSION['customer_id'])) {
                                    ?>
                                    <a class="btn cart-bg " href="product-details.php?product_id=<?php echo $product['id']; ?>&addtocart=<?php echo $product['id']; ?>">Add to cart
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    </a>
                                    <a class="btn bg-primary cart-hart" href="product-details.php?product_id=<?php echo $product['id']; ?>&wishlists=<?php echo $product['id']; ?>">
                                        <svg id="Heart" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="20"
                                            viewBox="0 0 22 20">
                                            <defs>
                                                <clipPath id="clip-path">
                                                    <rect width="22" height="20" fill="none" />
                                                </clipPath>
                                            </defs>
                                            <g id="Repeat_Grid_1" data-name="Repeat Grid 1" clip-path="url(#clip-path)">
                                                <g transform="translate(1 1)">
                                                    <path id="Heart-2" data-name="Heart"
                                                        d="M20.007,4.59a5.148,5.148,0,0,0-7.444,0L11.548,5.636,10.534,4.59a5.149,5.149,0,0,0-7.444,0,5.555,5.555,0,0,0,0,7.681L4.1,13.317,11.548,21l7.444-7.681,1.014-1.047a5.553,5.553,0,0,0,0-7.681Z"
                                                        transform="translate(-1.549 -2.998)" fill="#fff" stroke="#335aff"
                                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="btn cart-bg " href="customer-authentication.php">Add to cart
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    </a>
                                    <a class="btn bg-primary cart-hart" href="customer-authentication.php">
                                        <svg id="Heart" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="20"
                                            viewBox="0 0 22 20">
                                            <defs>
                                                <clipPath id="clip-path">
                                                    <rect width="22" height="20" fill="none" />
                                                </clipPath>
                                            </defs>
                                            <g id="Repeat_Grid_1" data-name="Repeat Grid 1" clip-path="url(#clip-path)">
                                                <g transform="translate(1 1)">
                                                    <path id="Heart-2" data-name="Heart"
                                                        d="M20.007,4.59a5.148,5.148,0,0,0-7.444,0L11.548,5.636,10.534,4.59a5.149,5.149,0,0,0-7.444,0,5.555,5.555,0,0,0,0,7.681L4.1,13.317,11.548,21l7.444-7.681,1.014-1.047a5.553,5.553,0,0,0,0-7.681Z"
                                                        transform="translate(-1.549 -2.998)" fill="#fff" stroke="#335aff"
                                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                    <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    
                    <?php
                        $reviews = mysqli_query($connection, "SELECT * FROM product_reviews WHERE product_id = '" . $product['id'] . "'");
                    ?>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                                Description
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                Reviews (<?php echo mysqli_num_rows($reviews); ?>)
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane p-3 fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <?php
                                echo $product['description'];
                            ?>
                        </div>
                        <div class="tab-pane p-3 fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="reviews_wrapper">
                                    
                                <h2 class="pt-2 pb-4"><?php echo mysqli_num_rows($reviews); ?> reviews</h2>

                                <?php
                                    if (mysqli_num_rows($reviews) > 0) {
                                    
                                        while ($review = mysqli_fetch_array($reviews)) {

                                            $customer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $review['customer_id'] . "'"))

                                            ?>  
                                            <div class="reviews_comment_box">
                                                <div class="comment_thmb">
                                                    <img src="<?php echo $customer['profile_picture']; ?>" style="width:47px;height: 47px;" class="img-thumbnail">
                                                </div>
                                                <div class="comment_text">
                                                    <div class="reviews_meta">
                                                        <div class="star_rating">
                                                            <ul>
                                                                <?php

                                                                    if ($review['rating'] < 1) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        ';
                                                                    } elseif ($review['rating'] <= 1) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        ';
                                                                    } elseif ($review['rating'] > 1 AND $review['rating'] <=2) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        ';
                                                                    } elseif ($review['rating'] > 2 AND $review['rating'] <=3) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        ';
                                                                    } elseif ($review['rating'] > 3 AND $review['rating'] <=4) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        ';
                                                                    } elseif ($review['rating'] > 4 AND $review['rating'] <=5) {
                                                                        echo '
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                        ';
                                                                    }

                                                                ?>

                                                            </ul>
                                                        </div>
                                                        <p>
                                                            <strong><?php echo $customer['name']; ?> </strong>
                                                            - 
                                                            <?php echo $review['created_at']; ?>
                                                        </p>
                                                        <span><?php echo $review['review_description']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }

                                    } else {
                                        echo "No Reviews.";
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
