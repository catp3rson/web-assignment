<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "tutor_booking_system";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
	echo "Connection failed!";
}

?>