<?php
	$mysql_addr = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_db = "tutor_booking_system";

	$ROOT_URL = "http://localhost/web-assignment/src/FrontEnd/";
	
	$conn = mysqli_connect($mysql_addr, $mysql_user, $mysql_password, $mysql_db);
	if (!$conn) {
		echo "Connection failed!";
	}
?>