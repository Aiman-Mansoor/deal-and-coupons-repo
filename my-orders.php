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
                        <?php
                            $orders = mysqli_query($connection, "SELECT * FROM orders WHERE customer_id = '" . $_SESSION['customer_id'] . "' GROUP BY tracking_number");
                        ?>
                        <div class="table-reponsive">
                            <table class="table">
                                <thead>
                                    <th># Tracking Number</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                        if (mysqli_num_rows($orders) > 0) {
                                            
                                            while ($order = mysqli_fetch_array($orders)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $order['tracking_number']; ?></td>
                                                    <td><?php echo $order['order_date']; ?></td>
                                                    <td><?php echo $order['status']; ?></td>
                                                    <td>
                                                        <a href="my-order-detail.php?tracking_number=<?php echo $order['tracking_number']; ?>" class="text-info">View detail</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                        } else {

                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include("partials/footer.php"); ?>
