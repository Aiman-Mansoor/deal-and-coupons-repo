<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <?php

        if (isset($_GET['deal_id'])) {
            
            $deal_id = $_GET['deal_id'];

            $deal = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM deals WHERE id = '$deal_id'"));

        }

    ?>

    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-2">
                <?php include("partials/seller-sidebar.php"); ?>
            </div>
            <div class="col-md-10">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Add Product Deals</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="seller-deals.php" class="bg-dark text-white px-4 py-2 border-0">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <?php
                            if (isset($_POST['addproduct'])) {
                            
                                $deal_id = $_POST['deal_id'];

                                $seller_id = $_SESSION['seller_id'];

                                $product_id = $_POST['product_id'];

                                $check = mysqli_query($connection, "SELECT * FROM deal_products WHERE deal_id = '$deal_id' AND product_id = '$product_id' AND seller_id = '$seller_id'");

                                if (mysqli_num_rows($check) > 0) {
                                    
                                    echo "<div class='alert alert-danger'>Product Already Added to Deal.</div>";

                                } else {

                                    $save = mysqli_query($connection, "INSERT INTO deal_products(deal_id, seller_id, product_id) VALUES('$deal_id', '$seller_id', '$product_id')");

                                    echo "<div class='alert alert-success'>Product Added to Deal.</div>";

                                }

                            }
                        ?>
                        <form action="" method="POST" class="form-inline justify-content-center">
                            <input type="hidden" name="deal_id" value="<?php echo $deal_id; ?>">
                            <div class="form-group w-25">
                                <select name="product_id" class="form-control w-100" required="">
                                    <option value="">Select</option>
                                    <?php
                                        $products = mysqli_query($connection, "SELECT * FROM products WHERE seller_id = '" . $_SESSION['seller_id'] . "'");
                                        while ($single = mysqli_fetch_array($products)) {
                                            ?>
                                            <option value="<?php echo $single['id']; ?>"><?php echo $single['name']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="addproduct" value="Add" class="bg-dark text-white px-4 py-2 border-0">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Deal Name</th>
                                    <th>Product Name</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $allproducts = mysqli_query($connection, "SELECT * FROM deal_products WHERE deal_id = '$deal_id'");
                                        if (mysqli_num_rows($allproducts) > 0) {
                                            $inc = 1;
                                            while ($ds = mysqli_fetch_array($allproducts)) {
                                                $dsingle = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM deals WHERE id = '" . $ds['deal_id'] . "'"));
                                                $product = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $ds['product_id'] . "'"));
                                                ?>
                                                <tr>
                                                    <td><?php echo $inc; ?></td>
                                                    <td><?php echo $dsingle['name']; ?></td>
                                                    <td><?php echo $product['name']; ?></td>
                                                    <td><a href="deal-products.php?deal_id=<?php echo $ds['deal_id']; ?>&remove=<?php echo $ds['id']; ?>">Remove</a></td>
                                                </tr>
                                                <?php
                                                $inc++;
                                            }

                                        } else {

                                            echo "<tr><td>No Record Found!</td></tr>";

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

    <?php

        if (isset($_GET['deal_id']) AND isset($_GET['remove'])) {
            
            $deal_id = $_GET['deal_id'];

            $id = $_GET['remove'];

            $remove = mysqli_query($connection, "DELETE FROM deal_products WHERE id = '$id'");

            header("Location: deal-products.php?deal_id=".$deal_id);

        }

    ?>

<?php include("partials/footer.php"); ?>
