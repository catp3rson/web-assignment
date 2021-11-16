<?php
$hostname = "localhost";
$username = "root";
$password = "an0kumene";
$database = "tutor_booking_system";
$conn = new mysqli($hostname, $username, $password);
$sql = "CREATE DATABASE IF NOT EXISTS tutor_booking_system;";
$conn->query($sql);
$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
	echo "Connection failed!";
}
?>