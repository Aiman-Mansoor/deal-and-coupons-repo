<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <section class="account-sign">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="account-sign-in">
                        <h5 class="text-center">Sign in</h5>
                        <form action="" method="POST">
                            <?php
                                if (isset($_POST['login'])) {
                                    
                                    $email = $_POST['email'];

                                    $password = $_POST['password'];

                                    $check = mysqli_query($connection, "SELECT * FROM sellers WHERE email = '$email'");

                                    if (mysqli_num_rows($check) > 0) {
                                        
                                        $seller = mysqli_fetch_array($check);
                                        
                                        if (password_verify($password, $seller['password'])) {
                                            
                                            if ($seller['status'] == 0) {
                                                
                                                echo "<div class='alert alert-info'>Your account is under review. Please wait for your account approval and try again later.</div>";

                                            } elseif ($seller['status'] == 1) {
                                                
                                                $_SESSION['seller_id'] = $seller['id'];

                                                header("Location: seller-dashboard.php");

                                            } elseif ($seller['status'] == 2) {
                                                
                                                echo "<div class='alert alert-danger'>You account has been blocked due to some suspecious activity. Please contact our support for any further query.</div>";

                                            }

                                        } else {

                                            echo "<div class='alert alert-danger'>Email or Password is Invalid.</div>";

                                        }

                                    } else {

                                        echo "<div class='alert alert-danger'>Email or Password is Invalid.</div>";

                                    }

                                }
                            ?>
                            <div class="form__div">
                                <input type="email" name="email" class="form__input" required="">
                                <label for="" class="form__label">Email</label>
                            </div>
                            <div class="form__div mb-0">
                                <input id="upassword" type="password" name="password" class="form__input" required="">
                                <label for="" class="form__label">Password</label>
                            </div>
                            <div class="password-info d-flex align-items-center justify-content-between flex-wrap">
                                <div class="password-info-left">
                                    <input type="checkbox" id="show-password" class="mb-0">
                                    <label for="showpass" class="mb-0">Show Password</label>
                                </div>
                            </div>
                            <input type="submit" name="login" value="Sign In" class="btn bg-primary">
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="account-sign-up">
                        <h5 class="text-center">Sign up</h5>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <?php
                                if (isset($_POST['signup'])) {
                                    
                                    $email = $_POST['email'];
                                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                    $storename = $_POST['storename'];
                                    $phone_number = $_POST['phone_number'];
                                    $company_address = $_POST['company_address'];
                                    $shippingrate = $_POST['shippingrate'];
                                    $about = $_POST['about'];

                                    $checkEmail = mysqli_query($connection, "SELECT * FROM sellers WHERE email = '$email'");

                                    if (mysqli_num_rows($checkEmail) > 0) {
                                        
                                        echo "<div class='alert alert-danger'>Account with this email already exist.</div>";

                                    } else {

                                        if (!empty($_FILES['profile_picture']['name'])) {

                                            $picture         = $_FILES['profile_picture']['name'];
                                            $picture_tmp     = $_FILES['profile_picture']['tmp_name'];
                                            $picture_path    = "images/sellers/" . $picture;
                                            move_uploaded_file($picture_tmp, "images/sellers/$picture");

                                        } else {
                                            $picture_path = "";
                                        }

                                        $save = mysqli_query($connection, "INSERT INTO sellers(email, password, storename, phone_number, profile_picture, company_address, shippingrate, about) VALUES('$email', '$password', '$storename', '$phone_number', '$picture_path', '$company_address', '$shippingrate', '$about')");

                                        echo "<div class='alert alert-success'>Account Created Successfully!</div>";

                                    }

                                }
                            ?>
                            <div class="form__div">
                                <input type="email" name="email" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Email</label>
                            </div>
                            <div class="form__div">
                                <input type="password" name="password" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Password</label>
                            </div>
                            <div class="form__div">
                                <input type="text" name="storename" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Store Name</label>
                            </div>
                            <div class="form__div">
                                <input type="number" name="phone_number" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Phone Number</label>
                            </div>
                            <div class="form__div">
                                <input type="file" name="profile_picture" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Profile Picture</label>
                            </div>
                            <div class="form__div">
                                <input type="text" name="company_address" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Company Address</label>
                            </div>
                            <div class="form__div">
                                <input type="number" name="shippingrate" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Shipping Rate</label>
                            </div>
                            <div class="form__div">
                                <textarea name="about" class="form__input" required=""></textarea>
                                <label for="" class="form__label">About</label>
                            </div>
                            <input type="submit" name="signup" value="Sign Up" class="btn bg-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include("partials/footer.php"); ?>
