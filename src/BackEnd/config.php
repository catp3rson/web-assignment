<?php
	// user roles
	$ROLES = [
		"admin" => 0,
		"tutor" => 1,
		"user" => 2
	];

	// mysql config
	$MYSQL_HOST = "localhost";
	$MYSQL_USER = getenv("MYSQL_USER");
	$MYSQL_PASSWD = getenv("MYSQL_USER_PASSWD");
	$MYSQL_DB = getenv("MYSQL_DB");

	// root url
	$ROOT_URL = "http://localhost:8080/FrontEnd/";
	$conn = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWD, $MYSQL_DB);
	if (!$conn) {
		echo "Connection to database failed!";
	}
	mysqli_set_charset($conn, "utf8mb4");
?>