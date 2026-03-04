<?php
    if (!isset($_SESSION['admin_email'])) {
        
        header("Location: login.php");

    }
?>
<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo"><a href="index.php">
                    <span>Admin</span></a>
                </div>
                <li><a href="index.php"><i class="ti-home"></i> Dashboard </a></li>
                <li><a href="categories.php"><i class="ti-home"></i> Categories </a></li>
                <li><a href="products.php"><i class="ti-home"></i> Products </a></li>
                <li><a href="sellers.php"><i class="ti-home"></i> Sellers </a></li>
                <li><a href="orders.php"><i class="ti-home"></i> Orders </a></li>
                <li><a href="coupons.php"><i class="ti-home"></i> Coupons </a></li>
                <li><a href="customers.php"><i class="ti-home"></i> Customers </a></li>
                <li><a href="account.php"><i class="ti-home"></i> My Account </a></li>
                <li><a href="logout.php" onclick="return confirm('Are you sure you want to logout?');"><i class="ti-close"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- /# sidebar -->