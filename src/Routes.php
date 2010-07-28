<?php
/**
 * Routes holds all the routes which are used by the Router class.
 * 
 * @author j.smit <j.smit@sgoen.nl>
 */
class Routes
{
	/**
	 * The order of routes is important because when the router matches an url to the routes
	 * it will start with the LAST one. The first match will be used.
     *
	 * @var array() $routes, holds a multidimensional array of routes.
	 */
	public static $routes = array(
		array("pattern" => "/^\/?/", "controller" => "TestController", "function" => "TestFunction"),
	);
}
?>
