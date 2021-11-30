<?php
    //sample test case to check testing setup for Chrome browser
    //https://www.lambdatest.com/blog/selenium-php-tutorial/#Webautomation


    //autoload the required classes thanks to composer
    require 'vendor/autoload.php'; 

    
    use PHPUnit\Framework\TestCase;
    use Facebook\WebDriver\Chrome\ChromeOptions;        //used for customizing the browser’s DesiredCapabilities
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\Remote\RemoteWebDriver;      //The RemoteWebDriver class is primarily responsible for handling all the interactions with the Selenium server
    use Facebook\WebDriver\WebDriverBy;
 

    //a test case is presented as a class which extends the TestCase class imported from PHPUnit
    class GoogleSearchChromeTest extends TestCase
    {
    
        protected $webDriver;
        
        public function build_chrome_capabilities(){
            $options = new ChromeOptions();
            //set the browser language to English
            $options->addArguments(array(
                'lang=en-GB',
                '--headless' //use Chrome without the GUI
            ));
            $capabilities = DesiredCapabilities::chrome();
            $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

            return $capabilities;
        }
        
        //executed when starting the browser session
        public function setUp(): void
        {
            $capabilities = $this->build_chrome_capabilities();
            //the URL of the Selenium server must be specified
            $host = 'http://localhost:4444/wd/hub';
            $this->webDriver = RemoteWebDriver::create($host, $capabilities);
        }
        
        //executed when closing the browser session after all the tests are done
        public function tearDown(): void
        {
            $this->webDriver->quit();
        }

        //test method
        /*
        * @test
        */ 
        public function test_searchTextOnGoogle()
        {
            $this->webDriver->get("https://www.google.com/");
            //maximize the browser window => reduce the chance of missing out web elements when testing
            $this->webDriver->manage()->window()->maximize();    
            
            sleep(1);
            
            //select the search bar element using the name locator
            $element = $this->webDriver->findElement(WebDriverBy::name("q"));
            
            if($element) {
                //type in the search bar
                $element->sendKeys("ElnoSabe");
                //submit
                $element->submit();
            }
            
            sleep(1);

            //get the window's title
            print $this->webDriver->getTitle();
            //check if the window's title is correct
            $this->assertEquals('ElnoSabe - Google Search', $this->webDriver->getTitle());
        }
    }

?>