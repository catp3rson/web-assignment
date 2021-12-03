<?php
    require dirname(__FILE__) . '/../test_config.php';
    require 'vendor/autoload.php'; 
    
    use PHPUnit\Framework\TestCase;
    use Facebook\WebDriver\Chrome\ChromeOptions;        
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\Remote\RemoteWebDriver;     
    use Facebook\WebDriver\WebDriverBy;


    class ChromeLoginInputCredentialsTest extends TestCase {
        protected $webDriver;
        
        public function build_chrome_capabilities(){
            $options = new ChromeOptions();
            //set the browser language to English
            $options->addArguments(array(
                'lang=en-GB'
            ));

            $capabilities = DesiredCapabilities::chrome();
            $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

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

        public function test_loginCorrectCred()
        {
            global $test_addr;

            //login with correct credentials
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    
            
            sleep(1);
            
            try{
                $this->fillLoginEmail("nguyenvana@gmail.com");
                $this->fillLoginPassword("Admin@123");
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

            $this->assertEquals("Hello nguyenvana@gmail.com", $displayed_creds['email']);
            $this->assertEquals("Role: Admin", $displayed_creds['role']);
        }
        

        public function test_loginIncorrectCred()
        {
            global $test_addr;

            //login with incorrect credentials
            $this->webDriver->get($test_addr . 'login.php/');

            $this->webDriver->manage()->window()->maximize();    
            
            sleep(1);
            
            //wrong password
            try{
                $this->fillLoginEmail("nguyenvana@gmail.com");
                $this->fillLoginPassword("User@123");
                $this->submitLogin();
            }
            catch(Exception $error){
                $this->fail("Error occurred: " . $error);
            }

            sleep(1);

            try{
                $alert_msg = $this->getAlertMessage();
            }
            catch(Exception $error){
                $this->fail("Error occurred: " . $error);
            }

            //there should be an alert to notify user about the wrong password
            $this->assertEquals("Wrong password for this email!", $alert_msg);
            $this->dismissAlert('confirm');


            //wrong email
            try{
                $this->fillLoginEmail("nguyenvanb@gmail.com");
                $this->fillLoginPassword("Admin@123");
                $this->submitLogin();
            }
            catch(Exception $error){
                $this->fail("Error occurred: " . $error);
            }

            sleep(1);

            try{
                $alert_msg = $this->getAlertMessage();
            }
            catch(Exception $error){
                $this->fail("Error occurred: " . $error);
            }

            //there should be an alert to notify user about the wrong password
            $this->assertEquals("Can not find any account with this email!", $alert_msg);
            $this->dismissAlert('confirm');
        }
    }
?>