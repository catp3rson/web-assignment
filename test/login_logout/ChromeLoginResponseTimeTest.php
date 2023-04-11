<?php
    require_once dirname(__FILE__) . '/../test_config.php';
    require_once 'vendor/autoload.php'; 
    
    use PHPUnit\Framework\TestCase;
    use Facebook\WebDriver\Chrome\ChromeOptions;        
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\Remote\RemoteWebDriver;
    use Facebook\WebDriver\WebDriverBy;
    use Facebook\WebDriver\WebDriverWait;
    use Facebook\WebDriver\WebDriverExpectedCondition;


    class ChromeLoginResponseTimeTest extends TestCase {
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
            $password_field = $this->webDriver->findElement(WebDriverBy::id("password_login"));
            $password_field->clear();
            $password_field->sendKeys($password);
        }

        public function submitLogin(){
            //press submit button
            $submit_btn = $this->webDriver->findElement(WebDriverBy::name("signin"));
            $submit_btn->click();
        }

        public function getDisplayedCreds(){
            //get the email address diaplyed on navbar
            $email = $this->webDriver->findElement(WebDriverBy::cssSelector(".header__nav-list .header__nav-user p"));
            $user_btn = $this->webDriver->findElement(WebDriverBy::cssSelector(".header__nav-list .header__nav-user img"));
            $user_btn->click();
            $role = $this->webDriver->findElement(WebDriverBy::cssSelector(".popup-login ul a:nth-of-type(2) li"));

            return array(
                'email' => $email->getText(),
                'role' => $role->getText()
            );
        }

        public function getAlertMessage(){
            $alert_msg = $this->webDriver->findElement(WebDriverBy::id("swal2-html-container"));
            return $alert_msg->getText();
        }

        public function dismissAlert($action){
            //there are 3 possible actions: confirm, deny, cancel
            $btn = $this->webDriver->findElement(WebDriverBy::cssSelector(".swal2-actions .swal2-" . $action));
            $btn->click();
        }

        public function test_loginCorrectCred()
        {
            global $test_addr;

            $accounts = array(
                array(
                    "email" => "nguyenvana@gmail.com",
                    "password" => "Admin@123",
                    "role" => "Admin"
                ),
                array(
                    "email" => "tranvanb@gmail.com",
                    "password" => "Tutor@123",
                    "role" => "Tutor"
                ),
                array(
                    "email" => "lef@gmail.com",
                    "password" => "User@123",
                    "role" => "User"
                )
            );

            foreach($accounts as $account){
                //login with correct credentials
                $this->webDriver->get($test_addr . 'login.php/');
                $this->webDriver->manage()->window()->maximize();    
                
                sleep(1);
                
                try{
                    $this->fillLoginEmail($account['email']);
                    $this->fillLoginPassword($account['password']);
                    $this->submitLogin();
                    $start_time = microtime(TRUE);
                }
                catch(Exception $error){
                    $this->fail("Error occurred: " . $error);
                }

                //measure the time taken for the server to process to login request and redirect user to home
                $wait = new WebDriverWait($this->webDriver, 2);
                $wait->until(WebDriverExpectedCondition::urlIs($test_addr . "index.php?page=home"));

                $process_time = microtime(TRUE) - $start_time;
            
                $this->assertGreaterThanOrEqual($process_time, 1);

                $this->webDriver->get($test_addr . 'index.php?page=logout');
            }
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
                $start_time = microtime(TRUE);
            }
            catch(Exception $error){
                $this->fail("Error occurred: " . $error);
            }
            
            $wait = new WebDriverWait($this->webDriver, 2);
            $wait->until(WebDriverExpectedCondition::visibilityOfAnyElementLocated(
                WebDriverBy::id("swal2-html-container")
            ));

            $process_time = microtime(TRUE) - $start_time;
            $this->assertGreaterThanOrEqual($process_time, 1);

            $this->dismissAlert("confirm");

            //wrong email
            try{
                $this->fillLoginEmail("nguyenvanb@gmail.com");
                $this->fillLoginPassword("Admin@123");
                $this->submitLogin();
                $start_time = microtime(TRUE);
            }
            catch(Exception $error){
                $this->fail("Error occurred: " . $error);
            }


            $wait = new WebDriverWait($this->webDriver, 2);
            $wait->until(WebDriverExpectedCondition::visibilityOfAnyElementLocated(
                WebDriverBy::id("swal2-html-container")
            ));

            $process_time = microtime(TRUE) - $start_time;
            $this->assertGreaterThanOrEqual($process_time, 1);
        }
    }
?>