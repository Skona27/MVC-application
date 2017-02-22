<?php

class App {

	protected 	$controller = 'home',
				$method = 'index',
				$params = array();

	public function __construct() {
		$url = $this->parseUrl();

		if(file_exists('../app/controllers/' . $url[0] . '.php')) {
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once '../app/controllers/' . $this->controller . '.php';

		$this->controller = new $this->controller;

		if(isset($url[1])) {
			if(method_exists($this->controller, $url[1]) && $this->method_public($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : array();

		call_user_func_array(array($this->controller, $this->method), $this->params);

	}

	protected function parseUrl() {		
		if(isset($_GET['url'])) {
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}

	protected function method_public($object, $method) {
		$reflection = new ReflectionMethod($object, $method);
		if ($reflection->isPublic()) {
			return true;
		}	else return false;
	}
}