<?php include("partials/head.php"); ?>

    <?php include("partials/sidebar.php"); ?>

    <?php include("partials/topnav.php"); ?>

    <?php
        if (isset($_GET['product_id'])) {
            
            $product_id = $_GET['product_id'];

        }
    ?>

    <div class="row">

        <div class="col-lg-12 p-r-0 title-margin-right">

            <div class="page-header">

                <div class="page-title">

                    <div class="row">
                        <div class="col-md-6">
                            <h1>Product Reviews</h1>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="products.php" class="btn btn-dark">Go Back</a>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        
    </div>
    
    <section id="main-content">

        <div class="row">

            <div class="col-md-12">
                <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                ?>
                <div class="card">
                
                    <div class="table-responsive">
                        
                        <table class="table">
                            
                            <thead>
                                <th>#</th>
                                <th>Seller</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Created At</th>
                                <th>Remove</th>
                            </thead>

                            <tbody>
                                <?php
                                    $products = mysqli_query($connection, "SELECT * FROM product_reviews WHERE product_id = '$product_id'");
                                    if (mysqli_num_rows($products)) {
                                        $inc = 1;
                                        while ($product = mysqli_fetch_array($products)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $inc; ?></td>
                                                <td>
                                                    <?php
                                                        $seller = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM sellers WHERE id = '" . $product['seller_id'] . "'"));
                                                    ?>
                                                    <img src="../<?php echo $seller['profile_picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <?php echo $seller['storename']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $customer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $product['customer_id'] . "'"));
                                                    ?>
                                                    <img src="../<?php echo $customer['profile_picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <?php echo $customer['name']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $p = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $product['product_id'] . "'"));
                                                    ?>
                                                    <img src="../<?php echo $p['picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <?php echo $p['name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $product['review_description']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $product['rating']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $product['created_at']; ?>
                                                </td>
                                                <td>
                                                    <a href="product-reviews.php?product_id=<?php echo $product['product_id']; ?>&remove=<?php echo $product['id']; ?>">Remove</a>
                                                </td>
                                            </tr>
                                            <?php
                                            $inc++;
                                        }

                                    }
                                        
                                ?>
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
            
        </div>

    </section>

    <?php
        if (isset($_GET['product_id']) AND isset($_GET['remove'])) {
            
            $product_id = $_GET['product_id'];

            $remove = $_GET['remove'];

            mysqli_query($connection, "DELETE FROM product_reviews WHERE id = '$remove'");

            $_SESSION['msg'] = "<div class='alert alert-info'>Review Removed Successfully!</div>";

            header("Location: product-reviews.php?product_id=".$product_id);

        }
    ?>

<?php include("partials/footer.php"); ?>