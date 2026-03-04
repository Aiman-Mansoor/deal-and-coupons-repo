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
                                <h5>My Profile</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="seller-change-password.php" class="bg-dark py-2 px-3 text-white">Change Password</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <form action="" method="POST" class="col-md-12" enctype="multipart/form-data">
                        <?php
                            if (isset($_POST['updateprofile'])) {
                                
                                $storename = $_POST['storename'];
                                $phone_number = $_POST['phone_number'];

                                if (!empty($_FILES['profile_picture']['name'])) {

                                    $picture         = $_FILES['profile_picture']['name'];
                                    $picture_tmp     = $_FILES['profile_picture']['tmp_name'];
                                    $picture_path    = "images/sellers/" . $picture;
                                    move_uploaded_file($picture_tmp, "images/sellers/$picture");

                                } else {
                                    $picture_path = $seller['profile_picture'];
                                }

                                $company_address = $_POST['company_address'];
                                $shippingrate = $_POST['shippingrate'];
                                $about = $_POST['about'];

                                $save = mysqli_query($connection, "UPDATE sellers SET storename = '$storename', phone_number = '$phone_number', profile_picture = '$picture_path', company_address = '$company_address', shippingrate = '$shippingrate', about = '$about' WHERE id = '" . $_SESSION['seller_id'] . "'");

                                echo "<div class='alert alert-success'>Profile Saved Successfully.</div>";

                            }
                        ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Store Name</label>
                                            <input type="text" name="storename" value="<?php echo $seller['storename']; ?>" placeholder="Enter Store Name" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" value="<?php echo $seller['email']; ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <input type="number" name="phone_number" value="<?php echo $seller['phone_number']; ?>" placeholder="Enter Phone Number" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Profile Picture</label>
                                                    <input type="file" name="profile_picture" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <img src="<?php echo $seller['profile_picture']; ?>" class="img-thumbnail" style="width: 85px;height: 85px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Company Address</label>
                                            <input type="text" name="company_address" value="<?php echo $seller['company_address']; ?>" placeholder="Enter Phone Number" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Shipping Rate</label>
                                            <input type="number" name="shippingrate" value="<?php echo $seller['shippingrate']; ?>" placeholder="Enter Shipping Rate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">About Me</label>
                                            <textarea name="about" cols="7" rows="7" class="form-control" placeholder="Write here..." required=""><?php echo $seller['about']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="submit" name="updateprofile" value="Save" class="btn btn-dark w-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include("partials/footer.php"); ?>
