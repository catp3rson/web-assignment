<?php

include 'config.php';
session_start();

error_reporting(0);

if (isset($_SESSION["user_id"])) {
	header("Location: index.php");
}

if (isset($_POST["signup"])) {
	$full_name = mysqli_real_escape_string($conn, $_POST["signup_full_name"]);
	$birthday = mysqli_real_escape_string($conn, $_POST["signup_birthday"]);
	$phone = mysqli_real_escape_string($conn, $_POST["signup_phone"]);
	$email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
	$password = mysqli_real_escape_string($conn, md5($_POST["signup_password"]));

	$check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));

	if ($check_email > 0) {
		echo "<script>alert('Email already exists in out database.');</script>";
	} else {
		$sql = "INSERT INTO users (password, email, full_name, birthday, phone)  VALUES ( '$password','$email', '$full_name', '$birthday', '$phone')";
		$result = mysqli_query($conn, $sql);
		
		if ($result) {
			$_POST["signup_full_name"] = "";
			$_POST["signup_birthday"] = "";
			$_POST["signup_phone"] = "";
			$_POST["signup_email"] = "";
			$_POST["signup_password"] = "";
			
			echo "<script>alert('User registration successfully.');</script>";
		} else {
			echo "<script>alert('User registration failed.') ".mysqli_error($conn)." </script>";
			echo mysqli_error($conn);
		}
	}
}

if (isset($_POST["signin"])) {
	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, md5($_POST["password"]));

	$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password' ");

	if (mysqli_num_rows($check_email) > 0) {
		$row = mysqli_fetch_assoc($check_email);
		$_SESSION["user_id"] = $row['user_id'];
		$_SESSION["email"] = $row['email'];
		$_SESSION["role"] = $row['role'];

		if(isset($_GET['prev'])) {
			header("Location: ".$_GET['prev'].".php");
		}
		else {
			header("Location: index.php");
		}
	} else {
		echo "<script>alert('Login details is incorrect. Please try again.');</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="style1.css" />
	<title>Sign in & Sign up Form</title>
	<script src="./script.js"></script>
</head>

<body>
	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form action="" method="post" class="sign-in-form"onsubmit = '
					var email_regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
					password_regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
					var email_login = document.getElementById("email_login"),
					password_login = document.getElementById("password_login");
					if(!email_regex.test(email_login.value) || !password_regex.test(password_login.value))
					{
						event.preventDefault();
					}
					myValidation2();
				'>
					<h2 class="title">Sign in</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Email Address" name="email" id="email_login" value="<?php echo $_POST['email']; ?>" required />
					</div>
					<p style="color: red;" id="regex-email-login"></p>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" name="password" id="password_login" value="<?php echo $_POST['password']; ?>" required />
					</div>
					<p style="color: red;" id="regex-password-login"></p>
					<input type="submit" value="Login" name="signin" class="btn solid" />
				</form>



				<form action="" class="sign-up-form" method="post" onsubmit = '
    				var phone_regex = /^[0-9]*$/,
					email_regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
					password_regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
					var 
					signup_phone = document.getElementById("signup_phone"),
					signup_email = document.getElementById("signup_email"),
					signup_password = document.getElementById("signup_password"), 
					confirm_password = document.getElementById("confirm_password");
					
    				if(!phone_regex.test(signup_phone.value) || !email_regex.test(signup_email.value) || !password_regex.test(signup_password.value) || signup_password.value != confirm_password.value)
					{
						event.preventDefault();
					}
					myValidation();
				'>

					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Full Name" name="signup_full_name" value="<?php echo $_POST["signup_full_name"]; ?>" required />
					</div>

					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="date" placeholder="Date of birth" name="signup_birthday" value="<?php echo $_POST["signup_birthday"]; ?>" required />
					</div>



					<div class="input-field">
						<i class="fas fa-mobile"></i>
						<input type="text" placeholder="Phone" name="signup_phone" id="signup_phone" value="<?php echo $_POST["signup_phone"];?>" required />
					</div>
					<p style="color: red; font-size: 10px;" id="regex-phone"></p>

					<div class="input-field">
						<i class="fas fa-envelope"></i>
						<input type="text" placeholder="Email Address" name="signup_email" id="signup_email" value="<?php echo $_POST["signup_email"];?>" required />
					</div>
					<p style="color: red; font-size: 10px;" id="regex-email"></p>

					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" name="signup_password" id="signup_password" value="<?php echo $_POST["signup_password"]; ?>" required/>
					</div>
					<p style="color: red; font-size: 10px;" id="regex-pass"></p>

					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required/>
					</div>
					<p style="color: red; font-size: 10px;" id="compare-pass"></p>

					<input type="submit" class="btn" name="signup" value="Sign up"/>
				</form>
			</div>
		</div>

		<div class="panels-container">
			<div class="panel left-panel">
				<div class="content">
					<h3>New here ?</h3>
					<p>
						SIGN UP ....
					</p>
					<button class="btn transparent" id="sign-up-btn">
						Sign up
					</button>
				</div>
				<img src="img/log.svg" class="image" alt="" />
			</div>
			<div class="panel right-panel">
				<div class="content">
					<h3>One of us ?</h3>
					<p>
						SIGN IN ...
					</p>
					<button class="btn transparent" id="sign-in-btn">
						Sign in
					</button>
				</div>
				<img src="img/register.svg" class="image" alt="" />
			</div>
		</div>
	</div>

	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	<script src="app.js"></script>
</body>

</html>
