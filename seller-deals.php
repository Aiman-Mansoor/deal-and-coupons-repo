<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
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
                                <h5>My Deals</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="add-deals.php" class="bg-dark py-2 px-3 text-white">Add New</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Deal Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $deals = mysqli_query($connection, "SELECT * FROM deals WHERE seller_id = '" . $_SESSION['seller_id'] . "'");
                                        if (mysqli_num_rows($deals) > 0) {
                                            $inc = 1;
                                            while ($deal = mysqli_fetch_array($deals)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $inc; ?></td>
                                                    <td>
                                                        <img src="<?php echo $deal['picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <?php echo $deal['name']; ?><br>
                                                        <a href="edit-seller-deal.php?edit=<?php echo $deal['id']; ?>">Edit</a> / <a href="seller-deals.php?delete=<?php echo $deal['id']; ?>">Delete</a>
                                                    </td>
                                                    <td>
                                                        <?php echo $deal['price']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="deal-products.php?deal_id=<?php echo $deal['id']; ?>">Add Deal Products</a>
                                                    </td>
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

        if (isset($_GET['delete'])) {
            
            $id = $_GET['delete'];

            $delete = mysqli_query($connection, "DELETE FROM deals WHERE id = '$id'");

            header("Location: seller-deals.php");

        }

    ?>

<?php include("partials/footer.php"); ?>
