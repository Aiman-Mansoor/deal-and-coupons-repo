<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
        
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
                                <h5>Create Deals</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="seller-deals.php" class="bg-dark py-2 px-3 text-white">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <?php

                                if (isset($_POST['createdeal'])) {
                                    
                                    $category_id = $_POST['category_id'];
                                    $seller_id = $_SESSION['seller_id'];

                                    $name = $_POST['name'];

                                    if (!empty($_FILES['picture']['name'])) {

                                        $picture         = $_FILES['picture']['name'];
                                        $picture_tmp     = $_FILES['picture']['tmp_name'];
                                        $picture_path    = "images/deals/" . $picture;
                                        move_uploaded_file($picture_tmp, "images/deals/$picture");

                                    } else {
                                        $picture_path = "";
                                    }

                                    $price = $_POST['price'];

                                    $save = mysqli_query($connection, "INSERT INTO deals(category_id, seller_id, name, picture, price) VALUES('$category_id', '$seller_id', '$name', '$picture_path', '$price')");

                                    echo "<div class='alert alert-success'>Deal Created Successfully!</div>";

                                }

                            ?>
                            <div class="form-group">
                                <label for="">Select Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                        $categories = mysqli_query($connection, "SELECT * FROM categories");
                                        while ($category = mysqli_fetch_array($categories)) {
                                            ?>
                                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="Enter Deal Name" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="">Picture</label>
                                <input type="file" name="picture" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" name="price" placeholder="Enter Deal" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="createdeal" class="bg-dark py-2 px-3 text-white">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("partials/footer.php"); ?>
