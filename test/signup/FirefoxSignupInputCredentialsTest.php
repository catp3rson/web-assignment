<?php
    require_once dirname(__FILE__) . '/../test_config.php';
    require_once 'vendor/autoload.php'; 
    
    use PHPUnit\Framework\TestCase;
    use Facebook\WebDriver\Firefox\FirefoxDriver;
    use Facebook\WebDriver\Firefox\FirefoxProfile;
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\Remote\RemoteWebDriver; 
    use Facebook\WebDriver\WebDriverBy;


    class FirefoxSignupInputCredentialsTest extends TestCase {
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

        public function test_signupSuccess(){
            global $test_addr;

            //check if all the fields in signup form are required
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    

            sleep(1);

            $form = array(
                "signup_full_name" => "El Pepe",
                "signup_birthday" => "1969-02-04",
                "signup_phone" => strval(time()),
                "signup_email" => "pepe" . time() . "@gmail.com",
                "signup_password" => "Pepe@123",
                "confirm_password" => "Pepe@123"
            );

            $this->fillSignUpForm($form);
            $this->submitSignUp();

            sleep(1);

            $this->assertEquals("Please sign-in with your new account.", $this->getAlertMessage());
            $this->dismissAlert("confirm");

            $this->assertTrue($this->verifyLogin($form["signup_email"], $form["signup_password"]));
        }


        public function test_duplicateEmail(){
            global $test_addr;

            //check if all the fields in signup form are required
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    

            sleep(1);

            $form = array(
                "signup_full_name" => "El Pepe",
                "signup_birthday" => "1969-02-04",
                "signup_phone" => strval(time()),
                "signup_password" => "Pepe@123",
                "confirm_password" => "Pepe@123"
            );

            $emails = ["nguyenvana@gmail.com", "tranvanb@gmail.com", "lef@gmail.com"];

            foreach($emails as $email){
                $form["signup_email"] = $email;
                $this->fillSignUpForm($form);
                $this->submitSignUp();

                sleep(1);

                $this->assertEquals("Email already exists in out database!", $this->getAlertMessage());
                $this->dismissAlert("confirm");
            }
        }

        public function test_duplicatePhone(){
            global $test_addr;

            //check if all the fields in signup form are required
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    

            sleep(1);

            $form = array(
                "signup_full_name" => "El Pepe II",
                "signup_birthday" => "1969-02-04",
                "signup_email" => "pepe" . time() . "@gmail.com",
                "signup_password" => "Pepe@123",
                "confirm_password" => "Pepe@123"
            );

            $phones = ["04445556666", "01234567890", "06667778888"];

            foreach($phones as $phone){
                $form["signup_phone"] = $phone;
                $this->fillSignUpForm($form);
                $this->submitSignUp();

                sleep(1);

                $this->assertEquals("Phone number already exists in out database!", $this->getAlertMessage());
                $this->dismissAlert("confirm");
            }
        }

    }
?>