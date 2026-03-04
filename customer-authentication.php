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
                                if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                                if (isset($_POST['login'])) {
                                    
                                    $email = $_POST['email'];

                                    $password = $_POST['password'];

                                    $check = mysqli_query($connection, "SELECT * FROM customers WHERE email = '$email'");

                                    if (mysqli_num_rows($check) > 0) {
                                        
                                        $customer = mysqli_fetch_array($check);

                                        if (password_verify($password, $customer['password'])) {
                                            
                                            if ($customer['status'] == 1) {
                                                
                                                $_SESSION['customer_id'] = $customer['id'];

                                                header("Location: dashboard.php");

                                            } else {
                                                echo "<div class='alert alert-danger'>Your Account has been blocked.</div>";
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
                                    
                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                    $phone = $_POST['phone'];

                                    $checkEmail = mysqli_query($connection, "SELECT * FROM customers WHERE email = '$email'");

                                    if (mysqli_num_rows($checkEmail) > 0) {
                                        
                                        echo "<div class='alert alert-danger'>Account with this email already exist.</div>";

                                    } else {

                                        if (!empty($_FILES['profile_picture']['name'])) {

                                            $picture         = $_FILES['profile_picture']['name'];
                                            $picture_tmp     = $_FILES['profile_picture']['tmp_name'];
                                            $picture_path    = "images/customers/" . $picture;
                                            move_uploaded_file($picture_tmp, "images/customers/$picture");

                                            $save = mysqli_query($connection, "INSERT INTO customers(name, email, password, phone, profile_picture) VALUES('$name', '$email', '$password', '$phone', '$picture_path')");

                                        } else {
                                            
                                            $save = mysqli_query($connection, "INSERT INTO customers(name, email, password, phone) VALUES('$name', '$email', '$password', '$phone')");

                                        }

                                        echo "<div class='alert alert-success'>Account Created Successfully!</div>";

                                    }

                                }
                            ?>
                            <div class="form__div">
                                <input type="text" name="name" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Full Name</label>
                            </div>
                            <div class="form__div">
                                <input type="email" name="email" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Email</label>
                            </div>
                            <div class="form__div">
                                <input type="password" name="password" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Password</label>
                            </div>
                            <div class="form__div">
                                <input type="number" name="phone" class="form__input" placeholder=" " required="">
                                <label for="" class="form__label">Phone</label>
                            </div>
                            <div class="form__div">
                                <input type="file" name="profile_picture" class="form__input" placeholder=" ">
                                <label for="" class="form__label">Profile Picture</label>
                            </div>
                            <input type="submit" name="signup" value="Sign Up" class="btn bg-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include("partials/footer.php"); ?>
