<?php 

session_start();

if (!isset($_SESSION["user_id"])) {
  header("Location: index.php");
}


echo $_SESSION['user_id'];



?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
</head>
<body>
	<a href="logout.php">Logout</a>
</body>
</html>