<?php 
    require_once dirname(__FILE__) . '/../BackEnd/config.php';

    function retrieveTutor($tutor_id){
        global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWD, $MYSQL_DB;
        
        $conn = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWD, $MYSQL_DB);
        $query_str = sprintf("SELECT * FROM users WHERE user_id = %s", $tutor_id);
        $query = mysqli_query($conn, $query_str);

        if (!$query){
            echo "<script>alert('Error executing query: " . mysqli_error($conn) . "')</script>";
            return NULL;
        }
    
        return mysqli_fetch_assoc($query);
    }
?> 


<script>

function myValidation(signup_phone, signup_email, signup_password, confirm_password) {
    var phone_regex = /^[0-9]{10,15}$/;
    var email_regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var password_regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    
    if(!phone_regex.test(signup_phone.value)) {
        if (signup_phone.value.length < 10){
            document.getElementById("regex-phone").innerHTML = "Phone number is too short.";
        }
        else if (signup_phone.value.length > 15){
            document.getElementById("regex-phone").innerHTML = "Phone number is too long.";
        }
        else{
            document.getElementById("regex-phone").innerHTML = "Phone number must contain only digits.";
        }   
    }
    else document.getElementById("regex-phone").innerHTML = "";
    if(!email_regex.test(signup_email.value)) {
        document.getElementById("regex-email").innerHTML = "Wrong email format.";
    }
    else document.getElementById("regex-email").innerHTML = "";
    if(!password_regex.test(signup_password.value)) {
        document.getElementById("regex-pass").innerHTML = "At least 8 characters, a symbol, upper and lower case letters, a number.";
    }
    else document.getElementById("regex-pass").innerHTML = "";
    if(signup_password.value != confirm_password.value) {
        document.getElementById("compare-pass").innerHTML = "The two passwords are different.";
    }
    else document.getElementById("compare-pass").innerHTML = "";
    if(!phone_regex.test(signup_phone.value) || !email_regex.test(signup_email.value) || !password_regex.test(signup_password.value) || signup_password.value != confirm_password.value)
    {
        return false;
    }

    return true;
}

function myValidation2(email_login, password_login) {
    var email_regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var password_regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if(!email_regex.test(email_login.value)) {
        document.getElementById("regex-email-login").innerHTML = "Wrong email format.";
    }
    else document.getElementById("regex-email-login").innerHTML = "";
    if(!password_regex.test(password_login.value)) {
        document.getElementById("regex-password-login").innerHTML = "Password must contain at least 8 characters, a special character, <br> an uppercase, lowercase letter and a digit.";
    }
    else document.getElementById("regex-password-login").innerHTML = "";
    if(!email_regex.test(email_login.value) || !password_regex.test(password_login.value))
    {
        return false;
    }
}

const clickLogin = ()=> {
    let loginbox = document.querySelector('.popup-login');
    
    loginbox.style.display = loginbox.style.display == "block" ? "none":"block";
}


const closeClickLogin = ()=> {
    let loginbox = document.querySelector('.popup-login');
    
    loginbox.style.display = "none";
}

</script>
