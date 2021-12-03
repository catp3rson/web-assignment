<?php
    require dirname(__FILE__) . '/../test_config.php';
    require 'vendor/autoload.php'; 
    
    use PHPUnit\Framework\TestCase;
    use Facebook\WebDriver\Firefox\FirefoxDriver;
    use Facebook\WebDriver\Firefox\FirefoxProfile;
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\Remote\RemoteWebDriver; 
    use Facebook\WebDriver\WebDriverBy;


    class FirefoxLogoutTest extends TestCase {
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

        public function clickLogout() {
            $logout_link = $this->webDriver->findElement(webDriverBy::cssSelector(".popup-login ul a:nth-of-type(1)"));
            $logout_link->click();
        }

        public function getDisplayedEmail() {
            //get the email address diaplyed on navbar
            $email = $this->webDriver->findElement(webDriverBy::cssSelector(".header__nav-list .header__nav-user p"));
            return $email->getText();
        }

        public function getDisplayedRole() {
            $user_btn = $this->webDriver->findElement(webDriverBy::cssSelector(".header__nav-list .header__nav-user img"));
            $user_btn->click();
            try{
                $role = $this->webDriver->findElement(webDriverBy::cssSelector(".popup-login ul a:nth-of-type(2) li"));
                return $role->getText();
            }
            catch (Exception $error){
                return NULL;
            }
        }
        
        public function test_logoutwhenLoggedIn()
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
                $displayed_email = $this->getDisplayedEmail();
                $displayed_role = $this->getDisplayedRole();  
            }
            catch (Execption $error){
                $this->fail("Error occurred: " . $error);
            }

            $this->assertEquals("Hello nguyenvana@gmail.com", $displayed_email);
            $this->assertEquals("Role: Admin", $displayed_role);


            //logout after logging in
            try{
                $this->clickLogout();
                sleep(1);
                $displayed_email = $this->getDisplayedEmail();
                $displayed_role = $this->getDisplayedRole();  
            }
            catch (Execption $error){
                $this->fail("Error occurred: " . $error);
            }

            $this->assertEquals("You are not signed in.", $displayed_email);
            $this->assertEquals(NULL, $displayed_role);
        }

        public function test_logoutWhenNotLoggedIn(){
            global $test_addr;

            //login with correct credentials
            $this->webDriver->get($test_addr . 'logout.php/');
            $this->webDriver->manage()->window()->maximize();

            try{
                $displayed_email = $this->getDisplayedEmail();
                $displayed_role = $this->getDisplayedRole();  
            }
            catch (Execption $error){
                $this->fail("Error occurred: " . $error);
            }

            $this->assertEquals("You are not signed in.", $displayed_email);
            $this->assertEquals(NULL, $displayed_role);
        }
    }
?>