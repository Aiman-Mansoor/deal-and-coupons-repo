<?php include("partials/head.php"); ?>

    <?php include("partials/sidebar.php"); ?>

    <?php include("partials/topnav.php"); ?>

        <div class="row">
            <div class="col-lg-8 p-r-0 title-margin-right">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Coupons</h1>
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

                                    $copn = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM coupons WHERE id = '$edit_id'"));

                                    ?>
                                    <h3>Update Coupons</h3>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <?php
                                            if (isset($_POST['update'])) {
                                                
                                                $name = $_POST['name'];
                                                $no_of_persons = $_POST['no_of_persons'];

                                                if (!empty($_FILES['picture']['name'])) {

                                                    $picture         = $_FILES['picture']['name'];
                                                    $picture_tmp     = $_FILES['picture']['tmp_name'];
                                                    $picture_path    = "images/coupons/" . $picture;
                                                    move_uploaded_file($picture_tmp, "../images/coupons/$picture");

                                                } else {
                                                    $picture_path = $copn['picture'];
                                                }

                                                $amount_to_apply = $_POST['amount_to_apply'];
                                                $off = $_POST['off'];
                                                $code = $_POST['code'];

                                                $update = mysqli_query($connection, "UPDATE coupons SET name = '$name', picture = '$picture_path', amount_to_apply = '$amount_to_apply', off = '$off', code = '$code', no_of_persons = '$no_of_persons' WHERE id = '$edit_id'");

                                                echo "<div class='alert alert-success'>Coupon Updated.</div>";

                                            }
                                        ?>
                                        <div class="form-group mb-3">
                                            <label for="">Name</label>
                                            <input type="text" name="name" value="<?php echo $copn['name']; ?>" placeholder="Enter Name" class="form-control" required="">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Amount to Apply On</label>
                                            <input type="number" name="amount_to_apply" value="<?php echo $copn['amount_to_apply']; ?>" placeholder="Enter the amount on which you want to apply this coupon" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Picture</label><br>
                                            <img src="../<?php echo $copn['picture']; ?>" class="img-thumbnail" style="width: 100px;height: 100px;margin-bottom: 10px;">
                                            <input type="file" name="picture" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Percentage Off%</label>
                                            <input type="text" name="off" value="<?php echo $copn['off']; ?>" placeholder="Enter Percentage" class="form-control" required="">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Code</label>
                                            <input type="text" name="code" value="<?php echo $copn['code']; ?>" placeholder="Enter Code" class="form-control" required="">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">No. of people can use</label>
                                            <input type="text" name="no_of_persons" value="<?php echo $copn['no_of_persons']; ?>" placeholder="Enter total number of coupon usage" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="update" value="Update" class="btn btn-secondary">
                                            <a href="coupons.php" class="btn btn-warning">Cancel</a>
                                        </div>
                                    </form>
                                    <?php

                                } else {
                            ?>
                            <h3>Add Coupons</h3>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                    if (isset($_POST['save'])) {
                                        
                                        $name = $_POST['name'];
                                        $no_of_persons = $_POST['no_of_persons'];

                                        if (!empty($_FILES['picture']['name'])) {

                                            $picture         = $_FILES['picture']['name'];
                                            $picture_tmp     = $_FILES['picture']['tmp_name'];
                                            $picture_path    = "images/coupons/" . $picture;
                                            move_uploaded_file($picture_tmp, "../images/coupons/$picture");

                                        } else {
                                            $picture_path = "";
                                        }

                                        $amount_to_apply = $_POST['amount_to_apply'];
                                        $off = $_POST['off'];
                                        $code = $_POST['code'];

                                        $save = mysqli_query($connection, "INSERT INTO coupons(name, picture, amount_to_apply, off, code, no_of_persons) VALUES('$name', '$picture_path', '$amount_to_apply', '$off', '$code', '$no_of_persons')");

                                        echo "<div class='alert alert-success'>Coupon Saved.</div>";

                                    }
                                ?>
                                <div class="form-group mb-3">
                                    <label for="">Name</label>
                                    <input type="text" name="name" placeholder="Enter Name" class="form-control" required="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Amount to Apply On</label>
                                    <input type="number" name="amount_to_apply" placeholder="Enter the amount on which you want to apply this coupon" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Percentage Off%</label>
                                    <input type="text" name="off" placeholder="Enter Percentage" class="form-control" required="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Code</label>
                                    <input type="text" name="code" placeholder="Enter Code" class="form-control" required="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Picture</label>
                                    <input type="file" name="picture" class="form-control" required="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">No. of people can use</label>
                                    <input type="text" name="no_of_persons" placeholder="Enter total number of coupon usage" class="form-control" required="">
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
                                    <th>Amount to Apply On</th>
                                    <th>Percentage</th>
                                    <th>Code</th>
                                    <th>No. of people can use</th>
                                    <th class="text-center">Created</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $coupons = mysqli_query($connection, "SELECT * FROM coupons");
                                        $inc = 1;
                                        while ($coupon = mysqli_fetch_array($coupons)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $inc; ?></td>
                                                <td>
                                                    <img src="../<?php echo $coupon['picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <strong><?php echo $coupon['name']; ?></strong><br>
                                                    <a href="coupons.php?edit=<?php echo $coupon['id']; ?>">Edit</a> / <a href="coupons.php?delete=<?php echo $coupon['id']; ?>" onclick="return confirm('Are you sure you want to delete this coupon?');">Delete</a>
                                                </td>
                                                <td>
                                                    Rs. <?php echo $coupon['amount_to_apply']; ?>
                                                </td>
                                                <td><?php echo $coupon['off']; ?></td>
                                                <td><?php echo $coupon['code']; ?></td>
                                                <td><?php echo $coupon['no_of_persons']; ?></td>
                                                <td class="text-center"><?php echo $coupon['created_at']; ?></td>
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

                mysqli_query($connection, "DELETE FROM coupons WHERE id = '$id'");

                header("Location: coupons.php");

            }
        ?>

<?php include("partials/footer.php"); ?>