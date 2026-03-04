<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
    <?php
        if (isset($_GET['edit'])) {
            
            $edit_id = $_GET['edit'];

            $deal = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM deals WHERE id = '$edit_id'"));

        }
    ?>

    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-2">
                <?php include("partials/seller-sidebar.php"); ?>
            </div>
            <div class="col-md-10">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Edit Deals</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="seller-deals.php" class="bg-dark py-2 px-3 text-white">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4 mb-4">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <?php

                                if (isset($_POST['updatedeal'])) {
                                    
                                    $deal_id = $_POST['deal_id'];

                                    $seller_id = $_SESSION['seller_id'];

                                    $name = $_POST['name'];

                                    if (!empty($_FILES['picture']['name'])) {

                                        $picture         = $_FILES['picture']['name'];
                                        $picture_tmp     = $_FILES['picture']['tmp_name'];
                                        $picture_path    = "images/deals/" . $picture;
                                        move_uploaded_file($picture_tmp, "images/deals/$picture");

                                    } else {
                                        $picture_path = $deal['picture'];
                                    }

                                    $price = $_POST['price'];

                                    $update = mysqli_query($connection, "UPDATE deals SET name = '$name', picture = '$picture_path', price = '$price' WHERE id = '$deal_id'");

                                    echo "<div class='alert alert-success'>Deal Updated Successfully!</div>";

                                }

                            ?>
                            <input type="hidden" name="deal_id" value="<?php echo $edit_id; ?>">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="<?php echo $deal['name']; ?>" placeholder="Enter Deal Name" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="">Picture</label><br>
                                <img src="<?php echo $deal['picture']; ?>" class="img-thumbnail" style="width: 100px;height: 100px;margin-bottom: 10px;">
                                <input type="file" name="picture" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" name="price" value="<?php echo $deal['price']; ?>" placeholder="Enter Deal" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="updatedeal" class="bg-dark py-2 px-3 text-white">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("partials/footer.php"); ?>
