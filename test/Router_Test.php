<?php
require_once dirname(__FILE__).'/../../libraries/PHPUnit-3.4.9/PHPUnit/Framework.php';
require_once dirname(__FILE__).'/classes/Router_Exposed.php';

/**
 * This class tests the Router using the Router_Exposed class
 * 
 * @author j.smit <j.smit@sgoen.nl>
 */
class Router_Test extends PHPUnit_Framework_TestCase
{
	/**
	 * Holds the Router_Exposed object.
	 */
	protected $routerExposed;
	
	/**
	 * Sets up all the testing data for this unit test.
	 */
	protected function setUp()
	{
		$this->routerExposed = new Router_Exposed();
		
		$this->routerExposed->routes = array(
			array("pattern" => "^(.*)$", "controller" => "TestController", "function" => "TestFunction"),
			array("pattern" => "^(.foo/*)$", "controller" => "FooController", "function" => "TestFunction"),
			array("pattern" => "^(.foo/foo*)$", "controller" => "FooController", "function" => "FooFunction"),
		);
	}
	
	/**
	 * Tests the getRouteForUrl() function,
	 */
    public function testGetRouteForUrl()
    {	
        $url = '/';
        $testCase = $this->routerExposed->getRouteForUrl($url);
        $this->assertEquals('TestController', $testCase['controller']);
        
        $url = '/foo';
        $testCase = $this->routerExposed->getRouteForUrl($url);
        $this->assertEquals('FooController', $testCase['controller']);
        
        $url = '/foo/foo';
        $testCase = $this->routerExposed->getRouteForUrl($url);
        $this->assertEquals('FooFunction', $testCase['function']);
    }
}
?>