<?php
    require dirname(__FILE__) . '/../test_config.php';
    require 'vendor/autoload.php'; 
    
    use PHPUnit\Framework\TestCase;
    use Facebook\WebDriver\Firefox\FirefoxDriver;
    use Facebook\WebDriver\Firefox\FirefoxProfile;
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\Remote\RemoteWebDriver; 
    use Facebook\WebDriver\WebDriverBy;


    class FirefoxLoginInputFormValidiationTest extends TestCase {
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

        public function test_requiredFields()
        {
            //check that all input fields of login form are required
            global $test_addr;

            //login with empty fields
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    
            
            sleep(1);
            
            //check validiation
            try{
                $email_field = $this->webDriver->findElement(webDriverBy::id("email_login"));
                $password_field = $this->webDriver->findElement(webDriverBy::id("password_login"));
            }
            catch (Exception $error) {
                $this->fail("Error occurred: " . $error);
            }

            $this->assertEquals('true', $email_field->getAttribute("required"));
            $this->assertEquals('true', $password_field->getAttribute("required"));
        }

        /**
         * @doesNotPerformAssertions
         */
        public function test_emailWrongFormatFront()
        {
            //check that user is notified when password format is wrong (front end)
            global $test_addr;

            //login with empty fields
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    
            
            sleep(1);

            $expected_msg = "Wrong email format.";

            //trying out different wrong email formats
            $emails = array(
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
            );

            foreach ($emails as $email) {
                try{
                    $this->fillLoginEmail($email);
                    $this->fillLoginPassword("Admin@123");
                    $this->submitLogin();
                    $password_field = $this->webDriver->findElement(webDriverBy::id("email_login"));
                    $password_regex = $this->webDriver->findElement(webDriverBy::id("regex-email-login"));
                }
                catch (Exception $error){
                    $this->fail("Error occurred: " . $error);
                }
                
                $password_valid_msg = str_replace(array("\r", "\n"), ' ', $password_regex->getText());

                if ($password_valid_msg !== $expected_msg){
                    $this->fail("Regex failed to detect invalid email: " . $email);
                }
            }
        }


        public function test_passwordWrongFormat()
        {
            //check that user is notified when password format is wrong (front end)
            global $test_addr;

            //login with empty fields
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    
            
            sleep(1);

            $expected_msg = "Password must contain at least 8 characters, a special character, an uppercase, lowercase letter and a digit.";

            //trying out different wrong password formats
            $passwords = array(
                "Admin123",
                "admin@123",
                "Admin@1",
                "AAAAAAAAAAAAA",
                "AdminAAAAAAAA"
            );

            foreach ($passwords as $password) {
                try{
                    $this->fillLoginEmail("nguyenvana@gmail.com");
                    $this->fillLoginPassword($password);
                    $this->submitLogin();
                    $password_field = $this->webDriver->findElement(webDriverBy::id("password_login"));
                    $password_regex = $this->webDriver->findElement(webDriverBy::id("regex-password-login"));
                }
                catch (Exception $error){
                    $this->fail("Error occurred: " . $error);
                }
                
                $password_valid_msg = str_replace(array("\r", "\n"), ' ', $password_regex->getText());

                $this->assertEquals($expected_msg, $password_valid_msg);
            }
        }

    }
?>