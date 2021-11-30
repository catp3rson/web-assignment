<?php
	$mysql_addr = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_db = "tutor_booking_system";
	$conn = new mysqli($mysql_addr, $mysql_user, $mysql_password);
	$sql = "CREATE DATABASE IF NOT EXISTS tutor_booking_system;";
	$conn->query($sql);
	$conn = mysqli_connect($mysql_addr, $mysql_user, $mysql_password, $mysql_db);
	
	if (!$conn) {
		echo "Connection failed!";
	}
?>