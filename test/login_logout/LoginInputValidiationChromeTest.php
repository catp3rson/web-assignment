<?php
    require dirname(__FILE__) . '/../test_config.php';
    require 'vendor/autoload.php'; 
    
    use PHPUnit\Framework\TestCase;
    use Facebook\WebDriver\Chrome\ChromeOptions;        
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\Remote\RemoteWebDriver;     
    use Facebook\WebDriver\WebDriverBy;


    class LoginInputValidiationChromeTest extends TestCase {
        protected $webDriver;
        
        public function build_chrome_capabilities(){
            $options = new ChromeOptions();
            //set the browser language to English
            $options->addArguments(array(
                'lang=en-GB'
                // '--headless' //use Chrome without the GUI
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

        
        public function test_loginCorrectCred()
        {
            //login with correct credentials
            $this->webDriver->get($test_addr . 'login.php/');

            $this->webDriver->manage()->window()->maximize();    
            
            sleep(1);
            
            try{
                $email_field = $this->webDriver->findElement(WebDriverBy::id("email_login"));
                $password_field = $this->webDriver->findElement(webDriverBy::id("password_login"));
                $submit_btn = $this->webDriver->findElement(webDriverBy::name("signin"));
            }
            catch(Exception $e){
                
    
            }

            $email_field->sendKeys("nguyenvana@gmail.com");
            $password_field->sendKeys("admin123");

            $submit_btn->submit();
            
            sleep(1);

            
        }


        public function test_loginIncorrectCred()
        {
            //login with incorrect credentials
        }


        

    }

?>