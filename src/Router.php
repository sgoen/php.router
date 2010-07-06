<?php
require_once('Routes.php');
/**
 * This class is responsible for routing url's to the apropriate controllers and functions.
 * 
 * @author j.smit <j.smit@sgoen.nl>
 */
class Router
{	
	/**
	 * Routes are stored in a protedted variable so they can be tested easily with
	 * a custom routes-set for testing.
	 * 
	 * @var $routes[]
	 */
	protected $routes;
	
	/**
	 * Returns the right Route given a stripped url (/your/route/here)
	 * 
	 * @param string $url, contains the full url
	 * @return Route
	 */
	protected function getRouteForUrl($url)
	{
		$route = array();

		for($i = sizeof($this->routes)-1; $i >= 0; $i--)
		{
			if(ereg($this->routes[$i]['pattern'], $url))
			{
				$route = $this->routes[$i];
				break;
			}
		}
		
		return $route;
	}
	
	/**
	 * Launches off the router and sets up intial values. These can be overidden in the test classes.
	 */
	public static function dispatch()
	{
		$this->routes = Routes::$routes;
	}
}
?>