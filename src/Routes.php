<?php
/**
 * Routes holds all the routes which are used by the Router class.
 * 
 * @author j.smit <j.smit@sgoen.nl>
 */
class Routes
{
	/**
	 * @var array() $routes, holds a multidimensional array of routes.
	 */
	public static $routes = array(
		array("pattern" => "^(.*)$", "controller" => "TestController", "function" => "TestFunction"),
	);
}
?>