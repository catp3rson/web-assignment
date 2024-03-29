<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="login.css" />
	<title>Sign in & Sign up</title>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>


<?php 
	require_once dirname(__FILE__) . "/script.php";
	require_once dirname(__FILE__) . "/../BackEnd/login_processing.php";
?>


<body>
	<?php // Alerts
		if (isset($_POST["signup"]) and $invalid_birthday) {
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Invalid birthday!",
				});
			</script>';
			$sign_up_page = true;
		}
		if (isset($_POST["signup"]) and $invalid_phone) {
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Invalid phone number!",
				});
			</script>';
			$sign_up_page = true;
		}
		if ($invalid_email) {
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Invalid email address!",
				});
			</script>';
			$sign_up_page = true;
		}
		if ($invalid_password) {
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Invalid password!",
				});
			</script>';
			$sign_up_page = true;
		}
		if (isset($_POST["signup"]) and $check_email > 0) {
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Email already exists in out database!",
				});
			</script>';
			$sign_up_page = true;
		}
		else if (isset($_POST["signup"]) and $check_phone > 0) {
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Phone number already exists in out database!",
				});
			</script>';
			$sign_up_page = true;
		}
		if(isset($_POST["signup"]) and $sign_up_successful == true) {
			echo '<script>
				Swal.fire({
					icon: "success",
					title: "Success",
					text: "Please sign-in with your new account.",
				});
			</script>';
		}
		if(isset($_POST["signin"]) and $wrong_email) {
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Can not find any account with this email!",
				});
			</script>';
		}
		if(isset($_POST["signin"]) and $wrong_password) {
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Wrong password for this email!",
				});
			</script>';
		}
	?>


	<div class="container <?php echo  $sign_up_page ? 'sign-up-mode' : ''; ?>">
		<div class="forms-container">
			<div class="signin-signup">

				<!-- Begin login form -->
				<form action="" method="post" class="sign-in-form" onsubmit = '
					var email_regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
					password_regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
					var email_login = document.getElementById("email_login"),
					password_login = document.getElementById("password_login");
					if(!email_regex.test(email_login.value) || !password_regex.test(password_login.value))
					{
						event.preventDefault();
					}
					var email_login = document.getElementById("email_login"),
    				password_login = document.getElementById("password_login");

					return myValidation2(email_login, password_login);
				'>
					<h1 class="title">Sign in</h1>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Email Address" name="email" id="email_login" value="<?php echo $_POST['email']; ?>" required />
					</div>
					<p style="color: white;" id="regex-email-login"></p>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" name="password" id="password_login" value="<?php echo $_POST['password']; ?>" required />
					</div>
					<p style="color: white;" id="regex-password-login"></p>
					<input type="submit" value="Login" name="signin" class="btn solid" />
				</form>
				<!-- End login form -->
				

				<!-- Begin signup form -->
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
					
					return myValidation(signup_phone, signup_email, signup_password, confirm_password);
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
					<p style="color: white; font-size: 10px;" id="regex-phone"></p>
					<div class="input-field">
						<i class="fas fa-envelope"></i>
						<input type="text" placeholder="Email Address" name="signup_email" id="signup_email" value="<?php echo $_POST["signup_email"];?>" required />
					</div>
					<p style="color: white; font-size: 10px;" id="regex-email"></p>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" name="signup_password" id="signup_password" required/>
					</div>
					<p style="color: white; font-size: 10px;" id="regex-pass"></p>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required/>
					</div>
					<p style="color: white; font-size: 10px;" id="compare-pass"></p>
					<input type="submit" class="btn" name="signup" value="Sign up"/>
				</form>
				<!-- End signup form -->

			</div>
		</div>

		<!-- Begin panel -->
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

		<!-- End panel -->

	</div>
</body>


<script>
	const sign_in_btn = document.querySelector("#sign-in-btn");
	const sign_up_btn = document.querySelector("#sign-up-btn");
	const container = document.querySelector(".container");

	sign_up_btn.addEventListener("click", () => {
	container.classList.add("sign-up-mode");
	});

	sign_in_btn.addEventListener("click", () => {
	container.classList.remove("sign-up-mode");
	});
</script>


</html>