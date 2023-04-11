<?php
    require_once dirname(__FILE__) . '/../test_config.php';
    require_once 'vendor/autoload.php'; 
    
    use PHPUnit\Framework\TestCase;
    use Facebook\WebDriver\Firefox\FirefoxDriver;
    use Facebook\WebDriver\Firefox\FirefoxProfile;
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\Remote\RemoteWebDriver; 
    use Facebook\WebDriver\WebDriverBy;


    class FirefoxSignUpFormValidiation extends TestCase {
        protected $webDriver;
        
        public function build_chrome_capabilities(){
            $profile = new FirefoxProfile();
            $profile->setPreference("intl.accept_languages", "en-GB");

            $capabilities = DesiredCapabilities::firefox();
            $capabilities->setCapability(FirefoxDriver::PROFILE, $profile);

            return $capabilities;
        }
        
        //executed when starting the browser session
        public function setUp(): void
        {
            global $selenium_addr;
            
            $capabilities = $this->build_chrome_capabilities();
            $this->webDriver = RemoteWebDriver::create($selenium_addr, $capabilities);
        }
        
        //executed when closing the browser session after all the tests are done
        public function tearDown(): void
        {
            $this->webDriver->quit();
        }

        public function fillLoginEmail($email){
            //fill in email field in login form
            $email_field = $this->webDriver->findElement(WebDriverBy::id("email_login"));
            $email_field->clear();
            $email_field->sendKeys($email);
        }

        public function fillLoginPassword($password){
            //fill in password field in login form
            $password_field = $this->webDriver->findElement(webDriverBy::id("password_login"));
            $password_field->clear();
            $password_field->sendKeys($password);
        }

        public function submitLogin(){
            //press submit button
            $submit_btn = $this->webDriver->findElement(webDriverBy::name("signin"));
            $submit_btn->click();
        }

        public function getDisplayedCreds(){
            //get the email address diaplyed on navbar
            $email = $this->webDriver->findElement(webDriverBy::cssSelector(".header__nav-list .header__nav-user p"));
            $user_btn = $this->webDriver->findElement(webDriverBy::cssSelector(".header__nav-list .header__nav-user img"));
            $user_btn->click();
            $role = $this->webDriver->findElement(webDriverBy::cssSelector(".popup-login ul a:nth-of-type(2) li"));

            return array(
                'email' => $email->getText(),
                'role' => $role->getText()
            );
        }
        
        public function getAlertMessage(){
            $alert_msg = $this->webDriver->findElement(webDriverBy::id("swal2-html-container"));
            return $alert_msg->getText();
        }

        public function dismissAlert($action){
            //there are 3 possible actions: confirm, deny, cancel
            $btn = $this->webDriver->findElement(webDriverBy::cssSelector(".swal2-actions .swal2-" . $action));
            $btn->click();
        }

        public function verifyLogin($email, $password){
            try{
                $this->fillLoginEmail($email);
                $this->fillLoginPassword($password);
                $this->submitLogin();
            }
            catch(Exception $error){
                $this->fail("Error occurred: " . $error);
            }

            sleep(1);

            //verify by checking the email and role displayed on navbar
            try{
                $displayed_creds = $this->getDisplayedCreds();  
            }
            catch (Execption $error){
                $this->fail("Error occurred: " . $error);
            }

            return  $displayed_creds['email'] === "Hello " . $email
                        && $displayed_creds['role'] === "Role: User";
        }

        public function fillSignUpForm($form) {
            foreach($form as $key => $value){
                $script = sprintf(
                    "document.getElementsByName('%s')[0].setAttribute('value', '%s');", $key, $value
                );

                $this->webDriver->executeScript($script);
            }
        }

        public function submitSignUp() {
            $submit_btn = $this->webDriver->findElement(webDriverBy::name("signup"));
            $submit_btn->click();
        }

        public function test_requireFields(){
            global $test_addr;

            //check if all the fields in signup form are required
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    

            sleep(1);

            try{
                $full_name = $this->webDriver->findElement(webDriverBy::name("signup_full_name"));
                $birthday = $this->webDriver->findElement(webDriverBy::name("signup_birthday"));
                $phone = $this->webDriver->findElement(webDriverBy::name("signup_phone"));
                $email = $this->webDriver->findElement(webDriverBy::name("signup_email"));
                $password = $this->webDriver->findElement(webDriverBy::name("signup_password"));
                $confirm_password = $this->webDriver->findElement(webDriverBy::name("confirm_password"));
            }
            catch (Execption $error){
                $this->fail("Error occurred: " . $error);
            }

            $this->assertEquals('true', $full_name->getAttribute("required"));
            $this->assertEquals('true', $birthday->getAttribute("required"));
            $this->assertEquals('true', $phone->getAttribute("required"));
            $this->assertEquals('true', $email->getAttribute("required"));
            $this->assertEquals('true', $password->getAttribute("required"));
            $this->assertEquals('true', $confirm_password->getAttribute("required"));
        }

        public function test_differentPasswordConfirm() {
            global $test_addr;

            //check if 
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    

            sleep(1);

            $form = array(
                "signup_full_name" => "El Pepe",
                "signup_birthday" => "1969-02-04",
                "signup_phone" => "696969696969",
                "signup_email" => "pepe@gmail.com",
                "signup_password" => "Pepe@123"
            );

            $confirms = ["Pepe@12", "Pepe@11111111111111", "Pepe@124", "Pepe@123 ", " Pepe@123", " Pepe@123 "];

            foreach($confirms as $confirm){
                $form["confirm_password"] = $confirm;

                $this->fillSignUpForm($form);
                $this->submitSignUp();

                $password_compare = $this->webDriver->findElement(webDriverBy::id("compare-pass"));

                $this->assertEquals("The two passwords are different.", $password_compare->getText());
            }
        }

        public function test_wrongPasswordFormat() {
            global $test_addr;

            //check if 
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    

            sleep(1);

            $form = array(
                "signup_full_name" => "El Pepe",
                "signup_birthday" => "1969-02-04",
                "signup_phone" => "696969696969",
                "signup_email" => "pepe@gmail.com",
            );

            $passwords = ["Pepe@12", "pepe@123", "Pepe1234", "PEPE@123 ", "Pepe@Reeeee"];

            foreach($passwords as $password){
                $form["signup_password"] = $form["confirm_password"] = $password;

                $this->fillSignUpForm($form);
                $this->submitSignUp();

                $password_valid = $this->webDriver->findElement(webDriverBy::id("regex-pass"));

                $this->assertEquals("At least 8 characters, a symbol, upper and lower case letters, a number.", $password_valid->getText());
            }
        }

        public function test_wrongEmailFormat() {
            global $test_addr;

            //check if 
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    

            sleep(1);

            $form = array(
                "signup_full_name" => "El Pepe",
                "signup_birthday" => "1969-02-04",
                "signup_phone" => "696969696969",
                "signup_password" => "Pepe@123",
                "confirm_password" => "Pepe@123"
            );

            $emails = [
                "plainaddress",
                "#@%^%#$@#$@#.com",
                "@example.com",
                "Joe Smith <email@example.com>",
                "email.example.com",
                "email@example@example.com",
                ".email@example.com",
                "email.@example.com",
                "email..email@example.com",
                "email@example.com (Joe Smith)",
                "email@example",
                "email@111.222.333.44444",
                "email@example..com",
                "Abc..123@example.com",
                '”(),:;<>[\]@example.com',
                'this\ is"really"not\allowed@example.com'
            ];

            foreach($emails as $email){
                $form["signup_email"] = $email;

                $this->fillSignUpForm($form);
                $this->submitSignUp();

                $email_valid = $this->webDriver->findElement(webDriverBy::id("regex-email"));

                $this->assertEquals("Wrong email format.", $email_valid->getText());
            }
        }


        public function test_wrongPhoneFormat() {
            global $test_addr;

            //check if 
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    

            sleep(1);

            $form = array(
                "signup_full_name" => "El Pepe II",
                "signup_birthday" => "1969-02-04",
                "signup_email" => "pepe2@gmail.com",
                "signup_password" => "Pepe@123",
                "confirm_password" => "Pepe@123"
            );
            
            //check for short phone numbers
            $form["signup_phone"] = "69";

            $this->fillSignUpForm($form);
            $this->submitSignUp();

            sleep(10);

            $phone_valid = $this->webDriver->findElement(webDriverBy::id("regex-phone"));

            $this->assertEquals("Phone number is too short.", $phone_valid->getText());

            //check for long phone numbers
            $form["signup_phone"] = "69696969696969696969696969696969";

            $this->fillSignUpForm($form);
            $this->submitSignUp();

            $phone_valid = $this->webDriver->findElement(webDriverBy::id("regex-phone"));

            $this->assertEquals("Phone number is too long.", $phone_valid->getText());

            //check for phone numbers that contain invalid characters
            $phones = [
                "012a34567890",
                "01234567890 ",
                " 01234567890",
                " 01234567890 ",
            ];

            foreach($phones as $phone){
                $form["signup_phone"] = $phone;

                $this->fillSignUpForm($form);
                $this->submitSignUp();

                $phone_valid = $this->webDriver->findElement(webDriverBy::id("regex-phone"));

                $this->assertEquals("Phone number must contain only digits.", $phone_valid->getText());
            }
        }
    }
?>