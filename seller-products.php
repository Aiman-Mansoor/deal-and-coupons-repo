<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
    
    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-2">
                <?php include("partials/seller-sidebar.php"); ?>
            </div>
            <div class="col-md-10">
                <div class="card mt-4 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>My Products</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="add-seller-product.php" class="bg-dark py-2 px-3 text-white">Add New</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $products = mysqli_query($connection, "SELECT * FROM products WHERE seller_id = '" . $_SESSION['seller_id'] . "'");
                                                $inc = 1;
                                                while ($product = mysqli_fetch_array($products)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $inc; ?></td>
                                                        <td>
                                                            <img src="<?php echo $product['picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <strong><?php echo $product['name']; ?></strong><br><br>
                                                            <a href="edit-seller-product.php?edit=<?php echo $product['id']; ?>">Edit</a> / <a href="seller-products.php?delete=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                                        </td>
                                                        <td>Rs. <?php echo $product['price']; ?></td>
                                                        <td>
                                                            <?php echo substr($product['description'], 0,120); ?>...
                                                            <br>
                                                            <br>
                                                            <strong>Off: </strong> <?php echo $product['off']; ?> %&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <strong>Qty: </strong> <?php echo $product['qty']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <strong>Tags: </strong> <?php echo $product['tags']; ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $inc++;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php
        if (isset($_GET['delete'])) {
            
            $product_id = $_GET['delete'];

            $delete = mysqli_query($connection, "DELETE FROM products WHERE id = '$product_id'");

            header("Location: seller-products.php");

        }
    ?>

<?php include("partials/footer.php"); ?>
