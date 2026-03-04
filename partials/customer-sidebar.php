<?php
    if (!isset($_SESSION['customer_id'])) {
        header("Location: customer-authentication.php");
    }
?>
<div class="dashboard-nav">
    <ul class="list-inline">
        <li class="list-inline-item">
            <a href="dashboard.php">
                Dashboard
            </a>
        </li>
        <li class="list-inline-item">
            <a href="account-setting.php">
                Account settings
            </a>
        </li>
        <li class="list-inline-item">
            <a href="billing-information.php">Billing information</a>
        </li>
        <li class="list-inline-item">
            <a href="my-wishlist.php">Wishlist</a>
        </li>
        <li class="list-inline-item">
            <a href="my-orders.php">Orders</a>
        </li>
        <li class="list-inline-item">
            <a href="customer-deals-booked.php">Deals Booked</a>
        </li>
        <li class="list-inline-item">
            <a href="logout.php" class="mr-0" onclick="return confirm('Are you sure you want to logout?')">Log-out</a>
        </li>
    </ul>
</div>