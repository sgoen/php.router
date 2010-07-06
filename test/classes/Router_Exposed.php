<?php
require_once(dirname(__FILE__).'/../../src/Router.php');

/**
 * The Exposed Class is used to make protected and private members accessible for testing purposes.
 * 
 * @author j.smit <j.smit@sgoen.nl>
 */
class Router_Exposed extends Router
{
	/**
	 * Make the protected $routes var accessible
	 * @var $routes[]
	 */
	public $routes;
	
	/**
	 * Surrogates protected function Router->getRoute()
	 * @see Router#getRoute($url)
	 */
	public function getRouteForUrl($url)
	{
		return parent::getRouteForUrl($url);
	}
}
?>