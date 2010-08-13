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
			array(
				"pattern" => "/^\/?$/", 
				"controller" => "TestControllerCase1", 
				"function" => "TestFunctionCase1"
			),
			array(
				"pattern" => "/^\/:class\/?$/", 
				"controller" => ":class", 
				"function" => "index",
				"dynamic" => array(
					":class" => "[a-zA-Z0-9][a-zA-Z0-9]*",
				),
			),
			array(
				"pattern" => "/^\/:class\/:function\/?$/", 
				"controller" => ":class", 
				"function" => ":function",
				"dynamic" => array(
					":class" => "[a-zA-Z0-9][a-zA-Z0-9]*",
					":function" => "[a-zA-Z0-9][a-zA-Z0-9]*",
				),
			),
			array(
				"pattern" => "/^\/foo\/?$/", 
				"controller" => "TestControllerCase2", 
				"function" => "TestFunctionCase2",
			),
			array(
				"pattern" => "/^\/foo\/foo\/?$/", 
				"controller" => "TestControllerCase3", 
				"function" => "TestFunctionCase4"
			),
		);
	}
	
	/**
	 * Tests the getRouteForUrl() function,
	 */
    public function testGetRouteForUrl()
    {	
        $url = '/';
        $testCase = $this->routerExposed->getRouteForUrl($url);
        $this->assertEquals('TestControllerCase1', $testCase['controller']);
        
        $url = '/foo';
        $testCase = $this->routerExposed->getRouteForUrl($url);
        $this->assertEquals('TestControllerCase2', $testCase['controller']);
        
        $url = '/foo/foo';
        $testCase = $this->routerExposed->getRouteForUrl($url);
        $this->assertEquals('TestControllerCase3', $testCase['controller']);
        
        $url = '';
        $testCase = $this->routerExposed->getRouteForUrl($url);
        $this->assertEquals('TestControllerCase1', $testCase['controller']);
        
        $url = '/foo/';
        $testCase = $this->routerExposed->getRouteForUrl($url);
        $this->assertEquals('TestControllerCase2', $testCase['controller']);
        
        $url = '/foo/foo/';
        $testCase = $this->routerExposed->getRouteForUrl($url);
        $this->assertEquals('TestControllerCase3', $testCase['controller']);
	
		$url = '/thisisdynamic';
        $testCase = $this->routerExposed->getRouteForUrl($url);
		$this->assertEquals(':class', $testCase['controller']);
    }
    
    /**
     * Test the exceptions for wrong url's
     * #expectedException Exception
     */
    /*public function testGetRouteForUrlException()
    {
    	$url = '/wrong';
        $testCase = $this->routerExposed->getRouteForUrl($url);
    }*/

	public function testIsRouteDynamic()
	{
		$route = $this->routerExposed->routes[0];
        $testCase = $this->routerExposed->routeIsDynamic($route);
        $this->assertEquals(false, $testCase);
	
		$route = $this->routerExposed->routes[1];
        $testCase = $this->routerExposed->routeIsDynamic($route);
        $this->assertEquals(true, $testCase);

	}
}
?>
