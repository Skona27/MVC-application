<?php

class Model {

	protected $_db;
	
	protected function __construct() {
		$this->_db = Database::getInstance();
	}
}