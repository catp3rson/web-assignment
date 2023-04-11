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


    class ChromeSignupResponseTimeTest extends TestCase {
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

        public function dismissAlert($action){
            //there are 3 possible actions: confirm, deny, cancel
            $btn = $this->webDriver->findElement(WebDriverBy::cssSelector(".swal2-actions .swal2-" . $action));
            $btn->click();
        }

        public function test_signinSuccess()
        {
            global $test_addr;

            $form = array(
                "signup_full_name" => "El Pepe",
                "signup_birthday" => "1969-02-04",
                "signup_password" => "Pepe@123",
                "confirm_password" => "Pepe@123"
            );

            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();

            sleep(1);

            for ($i = 0; $i < 5; $i++){
                $form["signup_phone"] = strval(time());
                $form["signup_email"] = "pepe" . time() . "@gmail.com";

                try{
                    $this->fillSignUpForm($form);
                    $this->submitSignUp();
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

                sleep(1);
            }
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
                $start_time = microtime(TRUE);

                $wait = new WebDriverWait($this->webDriver, 2);
                $wait->until(WebDriverExpectedCondition::visibilityOfAnyElementLocated(
                    WebDriverBy::id("swal2-html-container")
                ));
    
                $process_time = microtime(TRUE) - $start_time;
                $this->assertGreaterThanOrEqual($process_time, 1);
    
                $this->dismissAlert("confirm");

                sleep(1);
            }
        }


        public function test_duplicatePhone(){
            global $test_addr;

            //check if all the fields in signup form are required
            $this->webDriver->get($test_addr . 'login.php/');
            $this->webDriver->manage()->window()->maximize();    

            sleep(1);

            $form = array(
                "signup_full_name" => "El Pepe",
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
                $start_time = microtime(TRUE);

                $wait = new WebDriverWait($this->webDriver, 2);
                $wait->until(WebDriverExpectedCondition::visibilityOfAnyElementLocated(
                    WebDriverBy::id("swal2-html-container")
                ));
    
                $process_time = microtime(TRUE) - $start_time;
                $this->assertGreaterThanOrEqual($process_time, 1);
    
                $this->dismissAlert("confirm");

                sleep(1);
            }
        }
    }
?>