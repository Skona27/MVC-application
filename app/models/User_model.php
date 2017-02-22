<?php

class User_model extends Model {

	private $_user;

	public function __construct() {
		$this->_user = new User();
	}

	public function user() {
		return $this->_user;
	}

	public function validate($data = array()) {
		$validate = new Validate();
		$validation = $validate->check($data, array(
			'Username' => array('required' => 'true'),
			'Password' => array('required' => 'true')
		));

		return $validation;
	}

	public function login() {
		$remember = (Input::get('remember') === 'on') ? true : false;
		$login = $this->user()->login(Input::get('Username'), Input::get('Password'), $remember);

		if($login) {
			return true;
		}	else return false;
	}
}