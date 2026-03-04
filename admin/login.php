<?php include("partials/head.php"); ?>

    <?php
        if (isset($_SESSION['admin_email'])) {
            
            header("Location: index.php");

        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5 pt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center pt-3">Admin Login</h4>
                        <form class="form p-4" method="POST" action="">
                            <?php

                                if (isset($_POST['login'])) {
                                    
                                    $email = mysqli_real_escape_string($connection, $_POST['email']);
                                    $password = mysqli_real_escape_string($connection, $_POST['password']);

                                    $check = mysqli_query($connection, "SELECT * FROM admin WHERE email = '$email'");

                                    if (mysqli_num_rows($check) > 0) {
                                        
                                        $admin = mysqli_fetch_array($check);

                                        if ($admin['password'] == $password) {
                                            
                                            $_SESSION['admin_email'] = $admin['email'];

                                            header("Location: index.php");

                                        } else {
                                            echo "<div class='alert alert-danger'>Email or password is incorrect.</div>";
                                        }

                                    } else {
                                        echo "<div class='alert alert-danger'>Email or password is incorrect.</div>";
                                    }

                                }

                            ?>
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="form-group mb-3">
                                        <label>Your Email<span>*</span></label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required="">
                                    </div>  
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group mb-3">
                                        <label>Your Password<span>*</span></label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required="">
                                    </div>  
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <input type="checkbox"> Remember me!
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group button">
                                        <button name="login" type="submit" class="btn btn-secondary w-100">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("partials/footer.php"); ?>