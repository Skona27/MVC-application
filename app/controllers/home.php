<?php

class Home extends Controller {

	public function __construct() {
		parent::__construct();

		Statistics::track();
	}

	public function index() {
		$this->_view->render('page/home/index', array('active' => 'home'));
	}
}