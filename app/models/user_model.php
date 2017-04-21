<?php

class User_model extends Model {

	private $_user;

	public function __construct() {
		$this->_user = new User();
		$this->_db = Database::getInstance();
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

	public function update_profile($id, $login, $name) {
		$this->_user->update('users', array(
					'name' => $name,
					'username' => $login,
				), $id);
	}

	public function change_password($password) {
		$salt = Hash::salt(32);

		$this->_user->update('users', array(
			'password' => Hash::make($password, $salt),
			'salt' => $salt
		));
	}

	public function get_group($id) {
		return $this->_db->search('groups', array('id', '=', $id))->first();
	}

	public function register($login, $password, $name) {
		$salt = Hash::salt(32);

		$this->_user->create(array(
			'username' => $login,
			'password' => Hash::make($password, $salt),
			'salt' => $salt,
			'name' => $name,
			'joined' => date('Y-m-d H:i:s'),
			'group' => 2
		));
	}
}