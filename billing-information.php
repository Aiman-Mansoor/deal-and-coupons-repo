<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
        <?php
            $customer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $_SESSION['customer_id'] . "'"));
        ?>

        <section class="deliver-info">
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
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="deliver-info-form">
                            <h6>Billing information</h6>
                            <form action="" method="POST">
                                <?php
                                    if (isset($_POST['savebilling'])) {
                                        
                                        $customer_id = $_POST['customer_id'];
                                        $address = $_POST['address'];
                                        $city = $_POST['city'];
                                        $country = $_POST['country'];
                                        $state = $_POST['state'];
                                        $zipcode = $_POST['zipcode'];

                                        $checkRecord = mysqli_query($connection, "SELECT * FROM billing_information WHERE customer_id = '$customer_id'");
                                        if (mysqli_num_rows($checkRecord) > 0) {
                                            
                                            $update = mysqli_query($connection, "UPDATE billing_information SET address = '$address', city = '$city', country = '$country', state = '$state', zipcode = '$zipcode' WHERE id = '$customer_id'");

                                            echo "<div class='alert alert-success'>Billing Address Saved.</div>";

                                        } else {

                                            $save = mysqli_query($connection, "INSERT INTO billing_information(customer_id, address, city, country, state, zipcode) VALUES('$customer_id', '$address', '$city', '$country', '$state', '$zipcode')");

                                            echo "<div class='alert alert-success'>Billing Address Saved.</div>";

                                        }

                                    }

                                    $address = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM billing_information WHERE customer_id = '" . $_SESSION['customer_id'] . "'"));

                                ?>
                                <input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id']; ?>">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form__div">
                                            <input type="text" name="address" value="<?php if(isset($address['address'])) { echo $address['address']; } ?>" class="form__input" placeholder="
                                            " required="">
                                            <label for="" class="form__label">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form__div mb-0">
                                            <input type="text" name="city" value="<?php if(isset($address['city'])){ echo $address['city']; } ?>" class="form__input" placeholder="
                                            " required="">
                                            <label for="" class="form__label">City</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12 mt-30">
                                        <div class="form__div mb-0">
                                            <input type="text" name="country" value="<?php if(isset($address['country'])) { echo $address['country']; } ?>" class="form__input" placeholder="
                                            " required="">
                                            <label for="" class="form__label">Country</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 mt-30">
                                        <div class="form__div mb-0">
                                            <input type="text" name="state" value="<?php if(isset($address['state'])) { echo $address['state']; } ?>" class="form__input" placeholder="
                                            " required="">
                                            <label for="" class="form__label">State</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 mt-30">
                                        <div class="form__div">
                                            <input type="text" name="zipcode" value="<?php if(isset($address['zipcode'])) { echo $address['zipcode']; } ?>" class="form__input" placeholder="
                                            " required="">
                                            <label for="" class="form__label">Zip Code</label>
                                        </div>
                                    </div>
                                </div>
                                <button name="savebilling" class="btn bg-primary" type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php include("partials/footer.php"); ?>
