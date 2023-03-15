<?php

namespace MF\Init;

use LDAP\Result;

abstract class Bootstrap {
	private $routes;

	abstract protected function initRoutes(); 

	public function __construct() {
		$this->initRoutes();
		// echo $this->getUrl();
		$this->run($this->getUrl());
	}

	public function getRoutes() {
		return $this->routes;
	}

	public function setRoutes(array $routes) {
		$this->routes = $routes;
	}

	protected function run($url) {
		$routes = $this->getRoutes();
		$route = false;

		// echo "URL: " . $url . "<br>";
		
		foreach ($routes as $value) {
			if(!$route){
				// echo "URL: " . $url . " == " . "arr: " . $value['route']. "<br>";
				if( $value['route'] == $url){
					// echo "entrou <br>";
					$route = $value;
				}
			}
		}

		// if(!$route) $route = $routes['pageNotFound'];

		$class = "App\\Controllers\\".ucfirst($route['controller']);

		$controller = new $class;
				
		$action = $route['action'];

		$controller->$action();

	}

	protected function getUrl() {
		$url = $_SERVER['REQUEST_URI'];

		$pos = $this->isParameterByUrl($url);	

		if($pos !== -1) { // if exits char ? in url
			$start = $pos; 
			$end = strlen($url) - $pos; 
			$url = substr($url, 0, $start);
		}

		$url = substr($url, -1) == '/' ? $url  : $url . '/';

		return parse_url($url, PHP_URL_PATH);

	}

	protected function isParameterByUrl($url = null){
		$result = false;
		$char = "?";

		$pos = strpos($url, $char);
		$result = $pos ? $pos : -1;

		return $result;
	}
}

?>