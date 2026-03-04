<?php include("partials/head.php"); ?>

    <?php include("partials/sidebar.php"); ?>

    <?php include("partials/topnav.php"); ?>

    <div class="row">

        <div class="col-lg-8 p-r-0 title-margin-right">

            <div class="page-header">

                <div class="page-title">
                    <h1>Products</h1>
                </div>

            </div>

        </div>
        
    </div>
    
    <section id="main-content">

        <div class="row">

            <div class="col-md-12">

                <div class="card">
                
                    <div class="table-responsive">
                        
                        <table class="table">
                            
                            <thead>
                                <th>#</th>
                                <th width="200">Name</th>
                                <th>Price</th>
                                <th>Off</th>
                                <th>Description</th>
                                <th>Display</th>
                                <th>Created At</th>
                            </thead>

                            <tbody>
                                <?php
                                    $products = mysqli_query($connection, "SELECT * FROM products");
                                    if (mysqli_num_rows($products)) {
                                        $inc = 1;
                                        while ($product = mysqli_fetch_array($products)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $inc; ?></td>
                                                <td>
                                                    <img src="../<?php echo $product['picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;">
                                                    <?php echo $product['name']; ?><br>
                                                    <a href="product-reviews.php?product_id=<?php echo $product['id']; ?>" class="badge bg-primary">View Reviews</a>
                                                    <?php
                                                        if ($product['is_display'] == 1) {
                                                            ?>
                                                            <a href="products.php?draft=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to draft this product?')" class="badge bg-dark">Draft</a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="products.php?publish=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to publish this product?')" class="badge bg-dark">Publish</a>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>Rs. <?php echo $product['price']; ?></td>
                                                <td><?php echo $product['off']; ?>% Off</td>
                                                <td><?php echo $product['description']; ?></td>
                                                <td>
                                                    <?php
                                                        if ($product['is_display'] == 1) {
                                                            echo "Published";
                                                        } else {
                                                            echo "Draft";
                                                        }
                                                    ?>
                                                </td>   
                                                <td><?php echo $product['created_at']; ?></td>
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

        if (isset($_GET['draft'])) {
            
            $id = $_GET['draft'];

            mysqli_query($connection, "UPDATE products SET is_display = 0 WHERE id = '$id'");

            header("Location: products.php");

        }

        if (isset($_GET['publish'])) {
            
            $id = $_GET['publish'];

            mysqli_query($connection, "UPDATE products SET is_display = 1 WHERE id = '$id'");

            header("Location: products.php");

        }

    ?>

<?php include("partials/footer.php"); ?>