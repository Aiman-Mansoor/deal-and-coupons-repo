<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <?php

        $seller = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM sellers WHERE id = '" . $_SESSION['seller_id'] . "'"));

    ?>

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
                                <h5>Change Password</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="seller-profile.php" class="bg-dark py-2 px-3 text-white">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="POST">
                                    <?php
                                        if (isset($_POST['updatepassword'])) {
                                            
                                            $password = $_POST['password'];

                                            $update = mysqli_query($connection, "UPDATE sellers SET password = '$password' WHERE id = '" . $_SESSION['seller_id'] . "'");

                                            echo "<div class='alert alert-success'>Password Updated.</div>";

                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="">New Password</label>
                                        <input type="password" name="password" placeholder="Enter new password" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="updatepassword" value="Update" class="btn btn-dark">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("partials/footer.php"); ?>
