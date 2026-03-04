<?php include("partials/head.php"); ?>

    <?php include("partials/sidebar.php"); ?>

    <?php include("partials/topnav.php"); ?>

        <div class="row">
            <div class="col-lg-8 p-r-0 title-margin-right">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Categoreis</h1>
                    </div>
                </div>
            </div>
        </div>

        <section id="main-content">

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <?php
                                if (isset($_GET['edit'])) {
                                    
                                    $edit_id = $_GET['edit'];

                                    $cat = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM categories WHERE id = '$edit_id'"));

                                    ?>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <?php
                                            if (isset($_POST['update'])) {
                                                
                                                $name = $_POST['name'];

                                                if (!empty($_FILES['picture']['name'])) {

                                                    $picture         = $_FILES['picture']['name'];
                                                    $picture_tmp     = $_FILES['picture']['tmp_name'];
                                                    $picture_path    = "images/categories/" . $picture;
                                                    move_uploaded_file($picture_tmp, "../images/categories/$picture");

                                                } else {
                                                    $picture_path = $cat['picture'];
                                                }

                                                $update = mysqli_query($connection, "UPDATE categories SET name = '$name', picture = '$picture_path' WHERE id = '$edit_id'");

                                                echo "<div class='alert alert-success'>Category Updated.</div>";

                                            }
                                        ?>
                                        <div class="form-group mb-3">
                                            <label for="">Name</label>
                                            <input type="text" name="name" value="<?php echo $cat['name']; ?>" placeholder="Enter Name" class="form-control" required="">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Picture</label><br>
                                            <img src="../<?php echo $cat['picture']; ?>" class="img-thumbnail" style="width: 100px;height: 100px;margin-bottom: 10px;">
                                            <input type="file" name="picture" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="update" value="Update" class="btn btn-secondary">
                                        </div>
                                    </form>
                                    <?php

                                } else {
                            ?>
                            <h3>Add Categories</h3>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                    if (isset($_POST['save'])) {
                                        
                                        $name = $_POST['name'];

                                        if (!empty($_FILES['picture']['name'])) {

                                            $picture         = $_FILES['picture']['name'];
                                            $picture_tmp     = $_FILES['picture']['tmp_name'];
                                            $picture_path    = "images/categories/" . $picture;
                                            move_uploaded_file($picture_tmp, "../images/categories/$picture");

                                        } else {
                                            $picture_path = "";
                                        }

                                        $save = mysqli_query($connection, "INSERT INTO categories(name, picture) VALUES('$name', '$picture_path')");

                                        echo "<div class='alert alert-success'>Category Saved.</div>";

                                    }
                                ?>
                                <div class="form-group mb-3">
                                    <label for="">Name</label>
                                    <input type="text" name="name" placeholder="Enter Name" class="form-control" required="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Picture</label>
                                    <input type="file" name="picture" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="save" value="Save" class="btn btn-secondary">
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Created</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $categories = mysqli_query($connection, "SELECT * FROM categories");
                                        $inc = 1;
                                        while ($category = mysqli_fetch_array($categories)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $inc; ?></td>
                                                <td>
                                                    <img src="../<?php echo $category['picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <strong><?php echo $category['name']; ?></strong><br>
                                                    <a href="categories.php?edit=<?php echo $category['id']; ?>">Edit</a> / <a href="categories.php?delete=<?php echo $category['id']; ?>" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                                                </td>
                                                <td><?php echo $category['created_at']; ?></td>
                                            </tr>
                                            <?php
                                            $inc++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <?php
            if (isset($_GET['delete'])) {
                
                $id = $_GET['delete'];

                mysqli_query($connection, "DELETE FROM categories WHERE id = '$id'");

                header("Location: categories.php");

            }
        ?>

<?php include("partials/footer.php"); ?>