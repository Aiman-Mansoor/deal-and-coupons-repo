<?php include("partials/head.php"); ?>
    
    <?php include("partials/navigation.php"); ?>
    
    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-2">
                <?php include("partials/seller-sidebar.php"); ?>
            </div>
            <div class="col-md-10">
                <div class="card mt-4 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Add Product</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="seller-products.php" class="bg-dark py-2 px-3 text-white">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <?php
                        if (isset($_POST['save'])) {

                            $seller_id = $_SESSION['seller_id'];

                            $category_id = $_POST['category_id'];

                            $name = $_POST['name'];
                            $price = $_POST['price'];
                            $off = $_POST['off'];
                            $qty = $_POST['qty'];
                            $description = $_POST['description'];

                            if (!empty($_FILES['picture']['name'])) {

                                $picture         = $_FILES['picture']['name'];
                                $picture_tmp     = $_FILES['picture']['tmp_name'];
                                $picture_path    = "images/products/" . $picture;
                                move_uploaded_file($picture_tmp, "images/products/$picture");

                            } else {
                                $picture_path = "";
                            }

                            $tags = $_POST['tags'];

                            $save = mysqli_query($connection, "INSERT INTO products(seller_id, category_id, name, picture, price, off, qty, tags, description) VALUES('$seller_id', '$category_id', '$name', '$picture_path', '$price', '$off', '$qty', '$tags', '$description')");

                            $last_inserted_product_id = mysqli_insert_id($connection);

                            for( $i=0 ; $i < count($_FILES['gallery']['name']) ; $i++ ) {

                                if (!empty($_FILES['gallery']['name'][$i])) {

                                    $gallery = $_FILES['gallery']['name'][$i];
                                    $gallery_tmp = $_FILES['gallery']['tmp_name'][$i];

                                    $gallery_image_path    = "images/products/gallery/" . $gallery;
                                    move_uploaded_file($gallery_tmp, "images/products/gallery/$gallery");

                                    $save = mysqli_query($connection, "INSERT INTO product_galleries(product_id, image) VALUES('$last_inserted_product_id', '$gallery_image_path')");

                                }

                            }

                            echo "<div class='alert alert-success'>Product Saved Successfully.</div>";

                        }
                    ?>
                    <div class="row mb-5">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                
                                    <div class="form-group">
                                        <label for="">Category</label>
                                        <select name="category_id" class="form-control" required="">
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
                                        <input type="text" name="name" placeholder="Enter Product Name" class="form-control" required="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="number" name="price" placeholder="Enter Price" class="form-control" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="">% Off</label>
                                        <input type="number" name="off" value="0" placeholder="Enter Percentage Off %" class="form-control" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Quantity</label>
                                        <input type="number" name="qty" value="1" placeholder="Enter Product Quantity" class="form-control" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" placeholder="Write about product here..." cols="5" rows="5" class="form-control" required=""></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Picture</label>
                                        <input type="file" name="picture" class="form-control" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Gallery</label>
                                        <input type="file" name="gallery[]" class="form-control" multiple="">
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Search Tags <small>( Comma Seperated )</small></label>
                                        <input type="text" name="tags" placeholder="Write tags comma seperated" class="form-control" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="submit" name="save" value="Save" class="btn btn-dark w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include("partials/footer.php"); ?>
