<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
        <?php
            $customer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $_SESSION['customer_id'] . "'"));
        ?>

        <section class="wishlist-area">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-2">
                        <img src="<?php echo $customer['profile_picture']; ?>" class="img-thumbnail w-100">
                    </div>
                    <div class="col-md-10">
                        <h6 class="font-weight-normal mb-3 mt-4"><strong>Name: </strong><?php echo $customer['name']; ?></h6>
                        <h6 class="font-weight-normal mb-3"><strong>Email: </strong><?php echo $customer['email']; ?></h6>
                        <h6 class="font-weight-normal mb-3"><strong>Phone: </strong><?php echo $customer['phone']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        
                        <?php include("partials/customer-sidebar.php"); ?>
                            
                    </div>
                </div>
                <div class="rows">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php

                                        $wishlists = mysqli_query($connection, "SELECT * FROM wishlists WHERE customer_id = '" . $_SESSION['customer_id'] . "'");

                                        if (mysqli_num_rows($wishlists) > 0) {
                                            $inc = 1;
                                            while ($wish = mysqli_fetch_array($wishlists)) {
                                                
                                                $product = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $wish['product_id'] . "'"));
                                                ?>
                                                <tr>
                                                    <td><?php echo $inc; ?></td>
                                                    <td>
                                                        <img src="<?php echo $product['picture']; ?>" style="width: 100px;height: 100px;"> <?php echo $product['name']; ?>
                                                    </td>
                                                    <td>Rs. <?php echo $product['price']; ?></td>
                                                    <td>
                                                        <a href="product-details.php?product_id=<?php echo $product['id']; ?>" class="badge bg-dark text-white py-2 px-3" target="_blank">View Product</a><br><br>
                                                        <a href="my-wishlist.php?remove=<?php echo $wish['id']; ?>" class="badge bg-danger text-white py-2 px-3">Remove</a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $inc++;
                                            }

                                        } else {
                                            echo "<tr class='text-center'><td colspan='4'>No Record Found!</td></tr>";
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
            if (isset($_GET['remove'])) {
                
                $id = $_GET['remove'];

                $delete = mysqli_query($connection, "DELETE FROM wishlists WHERE id = '$id'");

                header("Location: my-wishlist.php");

            }
        ?>

<?php include("partials/footer.php"); ?>
