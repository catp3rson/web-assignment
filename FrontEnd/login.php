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
  $address = mysqli_real_escape_string($conn, $_POST["signup_address"]);
  $phone = mysqli_real_escape_string($conn, $_POST["signup_phone"]);
  
  /*$username = mysqli_real_escape_string($conn, $_POST["signup_user_name"]);*/
  $email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
  $password = mysqli_real_escape_string($conn, md5($_POST["signup_password"]));
  /*$cpassword = mysqli_real_escape_string($conn, md5($_POST["signup_cpassword"]));*/


  $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));

  /*if ($password !== $cpassword) {
    echo "<script>alert('Password did not match.');</script>";
  } else*/if ($check_email > 0) {
    echo "<script>alert('Email already exists in out database.');</script>";
  } else {
    $sql = "INSERT INTO users (password, email, full_name, birthday, phone, address)  VALUES ( '$password','$email', '$full_name', '$birthday', '$phone', '$address')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $_POST["signup_full_name"] = "";
      $_POST["signup_birthday"] = "";
      $_POST["signup_address"] = "";
      $_POST["signup_phone"] = "";
    
      /*$_POST["signup_user_name"] = "";*/
      $_POST["signup_email"] = "";
      $_POST["signup_password"] = "";
      /*$_POST["signup_cpassword"] = "";*/

      $to = $email;
      $subject = "Email verification";

      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // More headers
      $headers .= "From: ". $my_email;

      if (mail($to,$subject,$message,$headers)) {
        echo "<script>alert('We have sent a verification link to your email - {$email}.');</script>";
      } else {
        echo "<script>alert('Mail not sent. Please try again.');</script>";
      }
    } else {
      echo "<script>alert('User registration failed.');</script>";
    }
  }
}

if (isset($_POST["signin"])) {
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

  $check_email = mysqli_query($conn, "SELECT user_id FROM users WHERE email='$email' AND password='$password' ");

  if (mysqli_num_rows($check_email) > 0) {
    $row = mysqli_fetch_assoc($check_email);
    $_SESSION["user_id"] = $row['user_id'];
    header("Location: index.php");
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
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">




        <form action="" method="post" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Email Address" name="email" value="<?php echo $_POST['email']; ?>" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required />
          </div>
          <input type="submit" value="Login" name="signin" class="btn solid" />
          <p style="display: flex;justify-content: center;align-items: center;margin-top: 20px;"><a href="forgot-password.php" style="color: #4590ef;">Forgot Password?</a></p>
        </form>






        <form action="" class="sign-up-form" method="post">
          <h2 class="title">Sign up</h2>

          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Full Name" name="signup_full_name" value="<?php echo $_POST["signup_full_name"]; ?>" required />
          </div>

          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Date of birth" name="signup_birthday" value="<?php echo $_POST["signup_birthday"]; ?>" required />
          </div>

          <div class="input-field">
            <i class="fas fa-map-marker"></i>
            <input type="text" placeholder="Address" name="signup_address" value="<?php echo $_POST["signup_address"]; ?>" required />
          </div>

          <div class="input-field">
            <i class="fas fa-mobile"></i>
            <input type="text" placeholder="Phone" name="signup_phone" value="<?php echo $_POST["signup_phone"]; ?>" required />
          </div>
          <!--
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="User Name" name="signup_user_name" value="<?php echo $_POST["signup_user_name"]; ?>" required />
          </div>
          -->
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email Address" name="signup_email" value="<?php echo $_POST["signup_email"]; ?>" required />
          </div>
          
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="signup_password" value="<?php echo $_POST["signup_password"]; ?>" required id = "signup_password" pattern ="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}" title = "at least 8" required/>
          </div>

          <!--
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Confirm Password" name="signup_cpassword" value="<?php echo $_POST["signup_cpassword"]; ?>" required />
          </div>
          -->

          <input type="submit" class="btn" name="signup" value="Sign up" />
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
