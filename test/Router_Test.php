<?php
require_once dirname(__FILE__) . '/../src/Router.php';
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
	protected $router;
	
	/**
	 * Sets up all the testing data for this unit test.
	 */
	protected function setUp()
	{
		$this->router = new Router();
		
		$this->router->setRoutes(array(
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
		));
	}
	
	/**
	 * Tests the dispatch() function,
	 */
	public function testGetRouteForUrl()
	{
		$url = '/';
		$testCase = $this->router->dispatch($url);
		$this->assertEquals('TestControllerCase1', $testCase->class);

		$url = '/foo';
		$testCase = $this->router->dispatch($url);
		$this->assertEquals('TestControllerCase2', $testCase->class);

		$url = '/foo/foo';
		$testCase = $this->router->dispatch($url);
		$this->assertEquals('TestControllerCase3', $testCase->class);

		$url = '';
		$testCase = $this->router->dispatch($url);
		$this->assertEquals('TestControllerCase1', $testCase->class);

		$url = '/foo/';
		$testCase = $this->router->dispatch($url);
		$this->assertEquals('TestControllerCase2', $testCase->class);

		$url = '/foo/foo/';
		$testCase = $this->router->dispatch($url);
		$this->assertEquals('TestControllerCase3', $testCase->class);

		$url = '/thisisdynamic';
		$testCase = $this->router->dispatch($url);
		$this->assertEquals(':class', $testCase->class);
	}
}
?>
