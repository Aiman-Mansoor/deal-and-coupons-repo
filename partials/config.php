<?php

	ob_start();

	session_start();

	$connection = mysqli_connect("localhost", "root", "", "couponnsales_db");

	if (!$connection) {
		
		echo "Error Establishing Database Connection.";

	}

?>