<?php
    require 'vendor/autoload.php'; 
    require dirname(__FILE__) . '/../test_config.php';

    use PHPUnit\Framework\TestCase;
    use Facebook\WebDriver\Chrome\ChromeOptions;      
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\Remote\RemoteWebDriver;
    use Facebook\WebDriver\WebDriverBy;


    //test case to test if user can access home from different locations
    class HomeAcessTest extends TestCase
    {
        protected $webDriver;
        protected $browser = array(
            'browserName' => 'chrome',
            'sessionStrategy' => 'shared'
        );
        
        public function build_chrome_capabilities(){
            $options = new ChromeOptions();
            $options->addArguments(array(
                'lang=en-GB',
                '--headless'
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
        

        public function tearDown(): void
        {
            $this->webDriver->quit();
        }


        public function test_homeInTimeRequest()
        {
            global $test_addr;

            //check if user can access Home page in reasonable time
            $this->webDriver->get($test_addr . '?page=home');

            //the ideal loading time is 1-2 seconds
            sleep(1);

            $element = $this->webDriver->findElement(WebDriverBy::className("promotion"));
            $load_success = FALSE;

            if ($element){
                $load_success = TRUE;
            }
            
            $this->assertEquals(TRUE, $load_success);
        }
    }
?>