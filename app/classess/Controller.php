<?php

class Controller {

	protected 	$_view,
				$_model;

	public function __construct() {
		$this->_view = new View();
	}

	protected function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}
}