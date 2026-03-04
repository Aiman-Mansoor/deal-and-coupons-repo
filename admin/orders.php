<?php include("partials/head.php"); ?>

    <?php include("partials/sidebar.php"); ?>

    <?php include("partials/topnav.php"); ?>

    <div class="row">

        <div class="col-lg-8 p-r-0 title-margin-right">

            <div class="page-header">

                <div class="page-title">
                    <h1>Orders</h1>
                </div>

            </div>

        </div>
        
    </div>
    
    <section id="main-content">

        <div class="row">

            <div class="col-md-12">

                <div class="card">
                
                    <?php
                        $orders = mysqli_query($connection, "SELECT * FROM orders GROUP BY tracking_number");
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
                                                <td><strong><?php echo $order['tracking_number']; ?></strong></td>
                                                <td><?php echo $order['order_date']; ?></td>
                                                <td><?php echo $order['status']; ?></td>
                                                <td>
                                                    <a href="order-detail.php?tracking_number=<?php echo $order['tracking_number']; ?>" class="text-info">View detail</a>
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