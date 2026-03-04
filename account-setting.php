<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <?php

        $customer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $_SESSION['customer_id'] . "'"));

    ?>

        <section class="account">
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
                    <div class="col-lg-6 col-md-12">
                        <div class="account-setting">
                            <h6>Account settings</h6>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                    if (isset($_POST['updateprofile'])) {
                                        
                                        $name = $_POST['name'];
                                        $phone = $_POST['phone'];

                                        if (!empty($_FILES['profile_picture']['name'])) {

                                            $picture         = $_FILES['profile_picture']['name'];
                                            $picture_tmp     = $_FILES['profile_picture']['tmp_name'];
                                            $picture_path    = "images/customers/" . $picture;
                                            move_uploaded_file($picture_tmp, "images/customers/$picture");

                                        } else {
                                            $picture_path = $customer['profile_picture'];
                                        }

                                        $update = mysqli_query($connection, "UPDATE customers SET name = '$name', phone = '$phone', profile_picture = '$picture_path' WHERE id = '" . $_SESSION['customer_id'] . "'");

                                        echo "<div class='alert alert-success'>Profile Updated.</div>";

                                    }
                                ?>
                                <div class="form__div">
                                    <input type="text" name="name" value="<?php echo $customer['name']; ?>" class="form__input" placeholder="
                                    " required="">
                                    <label for="" class="form__label">Full Name</label>
                                </div>
                                <div class="form__div">
                                    <input type="number" name="phone" value="<?php echo $customer['phone']; ?>" class="form__input" placeholder="
                                    " required="">
                                    <label for="" class="form__label">Phone</label>
                                </div>
                                    <img src="<?php echo $customer['profile_picture']; ?>" class="img-thumbnail" style="width: 100px;height: 100px;margin-bottom: 10px;">
                                <div class="form__div">
                                    <input type="file" name="profile_picture" class="form__input" placeholder="
                                    ">
                                    <label for="" class="form__label">Profile Picture</label>
                                </div>
                                <button type="submit" name="updateprofile" class="btn bg-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="change-password">
                            <h6>Change password</h6>
                            <form action="" method="POST">
                                <?php
                                    if (isset($_POST['changepassword'])) {
                                        
                                        $current_password = $_POST['current_password'];
                                        $new_password = $_POST['new_password'];
                                        $confirm_password = $_POST['confirm_password'];

                                        $checkPassword = mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $_SESSION['customer_id'] . "' AND password = '$current_password'");

                                        if (mysqli_num_rows($checkPassword) > 0) {
                                            
                                            if ($new_password == $confirm_password) {
                                                
                                                $update = mysqli_query($connection, "UPDATE customers SET password = '$new_password' WHERE id = '" . $_SESSION['customer_id'] . "'");

                                                echo "<div class='alert alert-success'>Password Updated Successfully!</div>";

                                            } else {
                                                echo "<div class='alert alert-danger'>New Password is incorrect.</div>";
                                            }

                                        } else {
                                            echo "<div class='alert alert-danger'>Current Password is incorrect.</div>";
                                        }

                                    }
                                ?>
                                <div class="form__div">
                                    <input type="password" name="current_password" class="form__input" placeholder=" ">
                                    <label for="" class="form__label">Current password</label>
                                </div>
                                <div class="form__div">
                                    <input type="password" name="new_password" class="form__input" placeholder=" ">
                                    <label for="" class="form__label">New passwords</label>
                                </div>
                                <div class="form__div mb-40">
                                    <input type="password" name="confirm_password" class="form__input" placeholder=" ">
                                    <label for="" class="form__label">Confirm passwords</label>
                                </div>
                                <button type="submit" name="changepassword" class="btn bg-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include("partials/footer.php"); ?>
