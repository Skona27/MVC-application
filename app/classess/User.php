<?php

class User {

	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;

	public function __construct($user = null) {
		$this->_db = Database::getInstance();

		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		if(!$user) {
			if(Session::exists($this->_sessionName)) {
				$user = Session::get($this->_sessionName);

				if($this->find($user)) {
					$this->_isLoggedIn = true;
				}
			}
		}	else {
			$this->find($user);
		}
	}

	public function create($fields = array()) {
		if(!$this->_db->insert('users', $fields)) {
			//flash session error problem, redirect
		}
	}

	public function find($user = null) {
		if($user) {
			$field = (is_numeric($user)) ? 'id' : 'username';
			$data = $this->_db->search('users', array($field, '=', $user));

			if($data->count()) {
				$this->_data = $data->first();
				return $this;
			}
		}	else return false;
	}

	public function login($username = null, $password = null, $remember = false) {
		$user = $this->find($username);

		if(!$username && !$password && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->id);
		}	else {		
			if($user) {
				if($this->data()->password === Hash::make($password, $this->data()->salt)) {
					Session::put($this->_sessionName, $this->data()->id);

					if($remember) {
						$hash = Hash::unique();
						$hashCheck = $this->_db->search('users_session', array('user_id', '=', $this->data()->id));

						if(!$hashCheck->count()) {
							$this->_db->insert('users_session', array(
								'user_id' => $this->data()->id,
								'hash' => $hash
							));
						} 	else $hash = $hashCheck->first()->hash;

						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}
					return true;
				}
			}
		} 	return false;
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function data() {
		return $this->_data;
	}

	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}

	public function logout() {
		$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}

	public function update($table, $fields = array(), $id = null) {
		if(!$id && $this->isLoggedIn()) {
			$id = $this->data()->id;
		}

		if(!$this->_db->update($table, $id, $fields)) {
			//flash error, redirect
		}
	}

	public function hasPermissions($key) {
		$group = $this->_db->search('groups', array('id', '=', $this->data()->group));

		if($group->count()) {
			$permissions = json_decode($group->first()->permissions, true);
			if($permissions[$key] == true) {
				return true;
			}
		}	else return false;
	}
}