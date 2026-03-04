<?php include("partials/head.php"); ?>

    <?php include("partials/sidebar.php"); ?>

    <?php include("partials/topnav.php"); ?>

    <div class="row">

        <div class="col-lg-8 p-r-0 title-margin-right">

            <div class="page-header">

                <div class="page-title">
                    <h1>Sellers</h1>
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
                                <th width="200">Store Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Company Address</th>
                                <th>Shipping Rate</th>
                                <th>About</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </thead>

                            <tbody>
                                <?php
                                    $sellers = mysqli_query($connection, "SELECT * FROM sellers");
                                    if (mysqli_num_rows($sellers)) {
                                        $inc = 1;
                                        while ($seller = mysqli_fetch_array($sellers)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $inc; ?></td>
                                                <td>
                                                    <img src="../<?php echo $seller['profile_picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;">
                                                    <?php echo $seller['storename']; ?><br>
                                                    <?php
                                                        if ($seller['status'] == 0) {
                                                            ?>
                                                            <a href="sellers.php?approve=<?php echo $seller['id']; ?>" onclick="return confirm('Are you sure you want to approve this account?')" class="badge bg-primary">Approve</a> / <a href="sellers.php?block=<?php echo $seller['id']; ?>" onclick="return confirm('Are you sure you want to block this account?')" class="badge bg-primary">Block</a>
                                                            <?php
                                                        } elseif ($seller['status'] == 1) {
                                                            ?>
                                                            <a href="sellers.php?block=<?php echo $seller['id']; ?>" onclick="return confirm('Are you sure you want to block this account?')" class="badge bg-primary">Block</a>
                                                            <?php
                                                        } elseif($seller['status'] == 2) {
                                                            ?>
                                                            <a href="sellers.php?approve=<?php echo $seller['id']; ?>" onclick="return confirm('Are you sure you want to approve this account?')"  class="badge bg-primary">Approve</a>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $seller['phone_number']; ?></td>
                                                <td><?php echo $seller['email']; ?></td>
                                                <td><?php echo $seller['password']; ?></td>
                                                <td><?php echo $seller['company_address']; ?></td>
                                                <td><?php echo $seller['shippingrate']; ?></td>
                                                <td><?php echo $seller['about']; ?></td>
                                                <td>
                                                    <?php
                                                        if ($seller['status'] == 0) {
                                                            echo "Pending";
                                                        } elseif ($seller['status'] == 1) {
                                                            echo "Approved";
                                                        } elseif ($seller['status'] == 2) {
                                                            echo "Blocked";
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $seller['created_at']; ?></td>
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

        if (isset($_GET['approve'])) {
            
            $id = $_GET['approve'];

            mysqli_query($connection, "UPDATE sellers SET status = 1 WHERE id = '$id'");

            mysqli_query($connection, "UPDATE products SET is_display = 1 WHERE seller_id = '$id'");

            header("Location: sellers.php");

        }

        if (isset($_GET['block'])) {
            
            $id = $_GET['block'];

            mysqli_query($connection, "UPDATE sellers SET status = 2 WHERE id = '$id'");

            mysqli_query($connection, "UPDATE products SET is_display = 0 WHERE seller_id = '$id'");

            header("Location: sellers.php");

        }

    ?>

<?php include("partials/footer.php"); ?>