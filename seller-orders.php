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
                        <h5>My Orders</h5>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <?php
                            $orders = mysqli_query($connection, "SELECT * FROM orders WHERE seller_id = '" . $_SESSION['seller_id'] . "' GROUP BY tracking_number");

                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }

                        ?>
                        <div class="table-reponsive">
                            <table class="table">
                                <thead>
                                    <th># Tracking Number</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Change Status</th>
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
                                                        <?php
                                                            if ($order['status'] == 'Processing') {
                                                                ?>
                                                                <a href="seller-orders.php?ontheway=<?php echo $order['tracking_number']; ?>" onclick="return confirm('Are you sure you want to change this order to On The Way?');">Change to <strong>On The Way</strong></a>
                                                                <?php
                                                            } elseif ($order['status'] == 'On The Way') {
                                                                ?>
                                                                <a href="seller-orders.php?deliver=<?php echo $order['tracking_number']; ?>" onclick="return confirm('Are you sure you want to change this order to Delivered?');">Change to <strong>Deliverd</strong></a>
                                                                <?php
                                                            }else {
                                                                ?>
                                                                Delivered
                                                                <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="seller-order-details.php?tracking_number=<?php echo $order['tracking_number']; ?>" class="text-info">View detail</a>
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
        </div>
    </div>

    <?php
        if (isset($_GET['ontheway'])) {
            
            $tracking_number = $_GET['ontheway'];

            $update = mysqli_query($connection, "UPDATE orders SET status = 'On The Way' WHERE tracking_number = '$tracking_number'");

            $_SESSION['msg'] = "<div class='alert alert-success'>Order Status Changed to On The Way.</div>";

            header("Location: seller-orders.php");

        }
        if (isset($_GET['deliver'])) {
            
            $tracking_number = $_GET['deliver'];

            $update = mysqli_query($connection, "UPDATE orders SET status = 'Delivered' WHERE tracking_number = '$tracking_number'");

            $_SESSION['msg'] = "<div class='alert alert-success'>Order Status Changed to Delivered.</div>";

            header("Location: seller-orders.php");

        }
    ?>

<?php include("partials/footer.php"); ?>
