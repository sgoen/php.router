<?php
require_once('Routes.php');
/**
 * This class is responsible for routing url's to the apropriate controllers and functions.
 * It handles url's like "foo/foo/foo". In a url like "http://mydomain.com/foo/foo?foo=foo"
 * the address "http://mydomain.com" and the GET variables "?foo=foo" should be filtered
 * before passing them to the router.
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
		$route = NULL;

		for($i = sizeof($this->routes)-1; $i >= 0; $i--)
		{
			if(preg_match($this->routes[$i]['pattern'], $url))
			{
				$route = $this->routes[$i];
				break;
			}
		}
		
		if($route == NULL)
		{
			throw new Exception('Ivalid url, unable to get route.');
		}
		
		return $route;
	}
	
	/**
	 * Launches off the router and sets up intial values. These can be overidden in the test classes.
	 */
	public static function dispatch($url)
	{
		$this->routes = Routes::$routes;
		$route = $this->getRouteFromUrl($url);
	}
}
?>
