var $li = $('#pills-tab li').click(function() {
    $li.removeClass('selected');
    $(this).addClass('selected');
});

function myValidation()
{
    var phone_regex = /^[0-9]*$/,
    email_regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    password_regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    var 
    signup_phone = document.getElementById("signup_phone"),
    signup_email = document.getElementById("signup_email"),
    signup_password = document.getElementById("signup_password"), 
    confirm_password = document.getElementById("confirm_password");
    if(!phone_regex.test(signup_phone.value)) {
        document.getElementById("regex-phone").innerHTML = "No letter.";
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
        returnToPreviousPage();
        return false;
    }

    return true;
}

function myValidation2()
{
    var email_regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    password_regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    var email_login = document.getElementById("email_login"),
    password_login = document.getElementById("password_login");
    if(!email_regex.test(email_login.value)) {
        document.getElementById("regex-email-login").innerHTML = "Wrong email format.";
    }
    else document.getElementById("regex-email-login").innerHTML = "";
    if(!password_regex.test(password_login.value)) {
        document.getElementById("regex-password-login").innerHTML = "Password must contains at least 8 characters, a symbol,<br> upper and lower case letters and a number.";
    }
    else document.getElementById("regex-password-login").innerHTML = "";
    if(!email_regex.test(email_login.value) || !password_regex.test(password_login.value))
    {
        returnToPreviousPage();
        return false;
    }
}

const clickLogin = ()=>{
    let loginbox = document.querySelector('.popup-login');
    
    loginbox.style.display = loginbox.style.display == "block" ? "none":"block";
}


const closeClickLogin = ()=>{
    let loginbox = document.querySelector('.popup-login');
    
    loginbox.style.display = "none";
}
