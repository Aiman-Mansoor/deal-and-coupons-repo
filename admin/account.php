<?php include("partials/head.php"); ?>

    <?php include("partials/sidebar.php"); ?>

    <?php include("partials/topnav.php"); ?>

            <?php
                $admin = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM admin"));
            ?>

            <div class="row">

                <div class="col-lg-8 p-r-0 title-margin-right">
                    
                    <div class="page-header">

                        <div class="page-title">
                            <h1>My Account</h1>
                        </div>

                    </div>

                </div>
                
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td><?php echo $admin['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Password</strong></td>
                                            <td><?php echo $admin['password']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4">Update Profile</h4>
                            <form action="" method="POST">
                                <?php
                                    if (isset($_POST['updateprofile'])) {
                                        
                                        $email = $_POST['email'];
                                        $password = $_POST['password'];

                                        $update = mysqli_query($connection, "UPDATE admin SET email = '$email', password = '$password'");

                                        echo "<div class='alert alert-info'>Profile Updated.</div>";

                                    }
                                ?>
                                <div class="form-group mb-3">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="<?php echo $admin['email']; ?>" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Password</label>
                                    <input type="text" name="password" value="<?php echo $admin['password'] ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="updateprofile" value="Update Profile" class="btn btn-secondary w-100">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<?php include("partials/footer.php"); ?>