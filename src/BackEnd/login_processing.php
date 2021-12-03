<?php
    require dirname(__FILE__) . '/config.php';

    $sign_up_page = false; // true: go to signup page, false: go to login page.
    $sign_up_successful = false; // true: go to signup page, false: go to login page.
    $wrong_email = false;
    $wrong_password = false;
    $invalid_birthday = false;
    $invalid_phone = false;
    $invalid_email = false;
    $invalid_password = false;
    
    session_start();
    error_reporting(0);
    
    if (isset($_SESSION["user_id"])) {
        header("Location: " . $ROOT_URL . "index.php?page=home");
    }
    
    if (isset($_POST["signup"])) {
        $full_name = mysqli_real_escape_string($conn, $_POST["signup_full_name"]);
        $birthday = mysqli_real_escape_string($conn, $_POST["signup_birthday"]);
        $phone = mysqli_real_escape_string($conn, $_POST["signup_phone"]);
        $email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
        $password = $_POST["signup_password"];
    
        // Backend validation
        $phone_regex = '/^[0-9]*$/';
        $email_regex = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        $password_regex = '/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/';
        $invalid_birthday = (strtotime($birthday) ? false : true);
        $invalid_phone = (preg_match($phone_regex, $phone) ? false : true);
        $invalid_email = (preg_match($email_regex, $email) ? false : true);
        $invalid_password = (preg_match($password_regex, $password) ? false : true);
        
        $password = mysqli_real_escape_string($conn, password_hash($_POST["signup_password"], PASSWORD_DEFAULT));

        if($invalid_birthday === false and $invalid_email === false and $invalid_phone === false and $invalid_password === false) {
            $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));
            $check_phone = mysqli_num_rows(mysqli_query($conn, "SELECT phone FROM users WHERE phone='$phone'"));
    
            if ($check_email == 0 and $check_phone == 0) {
                $sql = "INSERT INTO users (password, email, full_name, birthday, phone)  VALUES ( '$password','$email', '$full_name', '$birthday', '$phone')";
                $result = mysqli_query($conn, $sql);
                
                if ($result) {
                    $_POST["signup_full_name"] = "";
                    $_POST["signup_birthday"] = "";
                    $_POST["signup_phone"] = "";
                    $_POST["signup_email"] = "";
                    $_POST["signup_password"] = "";
                    
                    $sign_up_successful = true;
                }
            }
        }
    }
    
    if (isset($_POST["signin"])) {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
    
        //Backend validation
        $email_regex = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        $password_regex = '/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/';
        $invalid_email = (preg_match($email_regex, $email) ? false : true);
        $invalid_password = (preg_match($password_regex, $password) ? false : true);
        $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
        if (mysqli_num_rows($check_email) === 1 and $invalid_email === false and $invalid_password === false) {
            $row = mysqli_fetch_assoc($check_email);
            
            if(password_verify($password, $row['password'])) {
                $_SESSION["user_id"] = $row['user_id'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["role"] = $row['role'];

                header("Location: " . $ROOT_URL . "index.php?page=home");
            }
            else {
                $wrong_password = true;
            }
        } else {
            if ($invalid_email === false and $invalid_password === false) {
                $wrong_email = true;
            }
        }
    }
?>