<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <section class="account-sign py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Brouse our Coupons</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <?php
                    $coupons = mysqli_query($connection, "SELECT * FROM coupons");
                    if (mysqli_num_rows($coupons) > 0) {
                        
                        while ($coupon = mysqli_fetch_array($coupons)) {
                            ?>
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="product-item shadow">
                                    <div class="product-item-image mb-0">
                                        <a>
                                            <img src="<?php echo $coupon['picture']; ?>" alt="Product Name" class="img-fluid border-bottom" style="height: 200px;width: 100%;">
                                        </a>
                                    </div>
                                    <div class="product-item-info text-center py-4">
                                        <a href="#" class="border-bottom pb-3">
                                            <?php echo $coupon['name']; ?>
                                            
                                        </a>
                                        <h6 class="font-weight-normal border-bottom pb-3 pt-2">
                                            <strong>Off: </strong><?php echo $coupon['off']; ?>%
                                        </h6>
                                        <h6 class="font-weight-normal border-bottom pb-3 pt-2">
                                            <strong>Code: </strong><?php echo $coupon['code']; ?>
                                        </h6>
                                        <h6 class="font-weight-normal pt-2">
                                            <strong>On Amount: </strong>Rs. <?php echo round($coupon['amount_to_apply'], 0); ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                    } else {

                    }
                ?>
            </div>
        </div>
    </section>

<?php include("partials/footer.php"); ?>
