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
                    <div class="col-md-12">
                        
                        <?php include("partials/customer-sidebar.php"); ?>
                        
                    </div>
                    <div class="col-md-12">
                        <div class="account-setting">
                            <h6>Dashboard</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include("partials/footer.php"); ?>
