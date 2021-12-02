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

            //check if the window's title is correct
            $this->assertEquals('ElnoSabe - Google Search', $this->webDriver->getTitle());
        }

        public function test_searchTextOnGoogle2()
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

            //check if the window's title is correct
            $this->assertEquals('ElnoSabe - Google Search', $this->webDriver->getTitle());
        }
    }


   
  





?>