<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
        <?php
            $customer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM customers WHERE id = '" . $_SESSION['customer_id'] . "'"));
        ?>

        <section class="wishlist-area">
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
                <div class="rows">
                    <?php
                        if (isset($_POST['submitreview'])) {
                            
                            $tracking_number = $_POST['tracking_number'];
                            $seller_id = $_POST['seller_id'];
                            $customer_id = $_POST['customer_id'];
                            $product_id = $_POST['product_id'];
                            $rating = $_POST['rating'];
                            $review_description = $_POST['review_description'];

                            $save = mysqli_query($connection, "INSERT INTO product_reviews(seller_id, customer_id, product_id, review_description, rating) VALUES('$seller_id', '$customer_id', '$product_id', '$review_description', '$rating')");

                            $_SESSION['msg'] = "<div class='alert alert-success'>Your Review is Submitted Successfully!</div>";

                            header("Location: my-order-detail.php?tracking_number=".$tracking_number);

                        }
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                    ?>
                    <div class="col-md-12">
                        <?php
                            $tracking_number = $_GET['tracking_number'];

                            $orders = mysqli_query($connection, "
                                    SELECT orders.tracking_number, orders.seller_id, orders.customer_id, orders.product_id, orders.original_price, orders.off, orders.qty, orders.shipping_price, orders.coupon_code, orders.coupon_amount, orders.order_date, orders.status, products.id, products.name, products.picture AS productPicture FROM orders INNER JOIN products ON orders.product_id = products.id WHERE orders.tracking_number = '$tracking_number'
                                ");
                        ?>
                        <div class="table-reponsive">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Off</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Review</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $shippingrate = 0;
                                        $totalamount = 0;
                                        if (mysqli_num_rows($orders) > 0) {
                                            $inc = 1;
                                            while ($order = mysqli_fetch_array($orders)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $inc; ?></td>
                                                    <td>
                                                        <img src="<?php echo $order['productPicture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <?php echo $order['name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $order['original_price']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $order['off']; ?>%
                                                    </td>
                                                    <td>
                                                        <?php echo $order['qty']; ?>
                                                    </td>
                                                    <td>Rs. 
                                                        <?php
                                                            if ($order['off'] == 0) {
                                                                echo $subtotal = $order['original_price'];
                                                            } else {
                                                                $new_amount = ($order['off'] / 100) * $order['original_price'];
                                                                $returningAmount = $order['original_price'] - $new_amount;
                                                                $offprice = number_format((float)$returningAmount, 2, '.', '');
                                                                echo $subtotal = $offprice * $order['qty'];
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if ($order['status'] == 'Delivered') {

                                                                $checkReviewed = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM product_reviews WHERE product_id = '" . $order['product_id'] . "' AND customer_id = '" . $_SESSION['customer_id'] . "'"));

                                                                if ($checkReviewed > 0) {
                                                                    echo "Review Submitted.";
                                                                } else {
                                                                    ?>
                                                                        <!-- Button trigger modal -->
                                                                    <button type="button" class="bg-primary border-0 text-white px-3 py-1 border" data-toggle="modal" data-target="#review<?php echo $order['product_id']; ?>">
                                                                      Submit Review
                                                                    </button>

                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="review<?php echo $order['product_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                      <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                          <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Review Product <?php echo $order['name']; ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                              <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                          </div>
                                                                          <div class="modal-body">

                                                                            <form action="" method="POST">
                                                                                
                                                                                <div class="product_ratting mb-10">
                                                                                    <h3>Your rating</h3>
                                                                                    
                                                                                </div>
                                                                                <div class="product_review_form">
                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            <div class="form-group">
                                                                                                <input type="hidden" name="tracking_number" value="<?php echo $order['tracking_number']; ?>">
                                                                                                <input type="hidden" name="seller_id" value="<?php echo $order['seller_id']; ?>">
                                                                                                <input type="hidden" name="customer_id" value="<?php echo $order['customer_id']; ?>">
                                                                                                <input type="hidden" name="product_id" value="<?php echo $order['product_id']; ?>">
                                                                                                <div class="rate">
                                                                                                    <input type="radio" id="star5" name="rating" value="5">
                                                                                                    <label for="star5" title="text">5 stars</label>
                                                                                                    <input type="radio" id="star4" name="rating" value="4">
                                                                                                    <label for="star4" title="text">4 stars</label>
                                                                                                    <input type="radio" id="star3" name="rating" value="3">
                                                                                                    <label for="star3" title="text">3 stars</label>
                                                                                                    <input type="radio" id="star2" name="rating" value="2">
                                                                                                    <label for="star2" title="text">2 stars</label>
                                                                                                    <input type="radio" id="star1" name="rating" value="1">
                                                                                                    <label for="star1" title="text">1 star</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12">
                                                                                            <div class="form-group">
                                                                                                <label>Your review </label>
                                                                                                <textarea name="review_description" class="form-control" rows="5" cols="5" placeholder="Write your review..." required=""></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <button type="submit" name="submitreview" class="btn btn-dark">Submit</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo "Pending.";
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $inc++;
                                                $shippingrate = $shippingrate + $order['shipping_price'];
                                                $totalamount = $totalamount + $subtotal;

                                            }
                                                            
                                            $singleOrder = mysqli_fetch_array(mysqli_query($connection, "SELECT coupon_code, coupon_amount FROM orders WHERE tracking_number = '$tracking_number' LIMIT 1"));

                                            if (!empty($singleOrder['coupon_code'])) {
                                                ?>
                                                <tr class="bg-light">
                                                    <td colspan="5"></td>
                                                    <td>
                                                        <strong>Coupon Applied</strong>
                                                    </td>
                                                    <td>Rs. <?php echo $singleOrder['coupon_amount']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr class="bg-light">
                                                <td colspan="5"></td>
                                                <td>
                                                    <strong>Shipping Rate</strong>
                                                </td>
                                                <td>Rs. <?php echo $shippingrate; ?></td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td colspan="5"></td>
                                                <td>
                                                    <strong>Total</strong>
                                                </td>
                                                <td>Rs. 
                                                    <?php

                                                        if (!empty($singleOrder['coupon_code'])) {
                                                            $orderdetailTotal = $shippingrate + $totalamount;
                                                            $final = $orderdetailTotal - $singleOrder['coupon_amount'];
                                                            echo $final;
                                                        } else {
                                                            $orderdetailTotal = $shippingrate + $totalamount;
                                                            echo $orderdetailTotal;
                                                        }

                                                    

                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            
                                        } else {

                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include("partials/footer.php"); ?>
