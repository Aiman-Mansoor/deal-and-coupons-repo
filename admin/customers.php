<?php include("partials/head.php"); ?>

    <?php include("partials/sidebar.php"); ?>

    <?php include("partials/topnav.php"); ?>

        <div class="row">

            <div class="col-lg-8 p-r-0 title-margin-right">
                
                <div class="page-header">

                    <div class="page-title">
                        <h1>Customers</h1>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </thead>

                                <tbody>
                                    <?php
                                        $customers = mysqli_query($connection, "SELECT * FROM customers");
                                        if (mysqli_num_rows($customers)) {
                                            $inc = 1;
                                            while ($customer = mysqli_fetch_array($customers)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $inc; ?></td>
                                                    <td>
                                                        <img src="../<?php echo $customer['profile_picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;">
                                                        <?php echo $customer['name']; ?><br>
                                                        <?php
                                                            if ($customer['status'] == 1) {
                                                                ?>
                                                                <a href="customers.php?block=<?php echo $customer['id']; ?>" onclick="return confirm('Are you sure you want to block this user account?');">Block Account</a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="customers.php?activate=<?php echo $customer['id']; ?>" onclick="return confirm('Are you sure you want to activate this user account?');">Activate Account</a>
                                                                <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $customer['email']; ?></td>
                                                    <td><?php echo $customer['password']; ?></td>
                                                    <td><?php echo $customer['phone']; ?></td>
                                                    <td>
                                                        <?php
                                                            if ($customer['status'] == 1) {
                                                                echo "Active";
                                                            } else {
                                                                echo "Blocked";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $customer['created_at']; ?></td>
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
            if (isset($_GET['block'])) {
                
                $id = $_GET['block'];

                mysqli_query($connection, "UPDATE customers SET status = 0 WHERE id = '$id'");

                $_SESSION['msg'] = "<div class='alert alert-info'>User Account Blocked Successfully!</div>";

                header("Location: customers.php");

            }
            if (isset($_GET['activate'])) {
                
                $id = $_GET['activate'];

                mysqli_query($connection, "UPDATE customers SET status = 1 WHERE id = '$id'");

                $_SESSION['msg'] = "<div class='alert alert-info'>User Account Activated Successfully!</div>";

                header("Location: customers.php");

            }
        ?>

<?php include("partials/footer.php"); ?>