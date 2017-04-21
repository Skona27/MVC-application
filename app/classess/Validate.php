<?php

class Validate {

	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct() {
		$this->_db = Database::getInstance();
	}

	public function check($source, $items = array()) {
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {

				$value = trim($source[$item]);
				$item = Sanitize::escape($item);

				if($rule === 'required' && empty($value)) {
					$this->addError("{$item} is required!");
				}	else if(!empty($value)) {
					switch($rule) {
						case 'min':
							if(strlen($value) < $rule_value) {
								$this->addError("{$item} musi mieć przynajmniej {$rule_value} znaków!");
							}	break;

						case 'max':
							if (strlen($value) > $rule_value) {
								$this->addError("{$item} musi mieć maksymalnie {$rule_value} znaków!");
							}	break;

						case 'matches':
							if ($value != $source[$rule_value]) {
								$this->addError("{$rule_value} musi pasować do {$item}!");
							}	break;

						case 'unique':
							$check = $this->_db->search($rule_value, array($item, '=', $value));
							if ($check->count()) {
								$this->addError("{$item} już istnieje!");
							}	break;

						case 'email':
							if(!filter_var($value, FILTER_SANITIZE_EMAIL)) {
								$this->addError("$item} nie jest poprawnym adresem email!");
							}	break;
					}
				}
			}
		}

		if(empty($this->errors())) {
			$this->_passed = true;
		}	return $this;
	}

	private function addError($error) {
		$this->_errors[] = $error;
	}

	public function errors() {
		return $this->_errors;
	}

	public function stringErrors() {
		$string = '';
		foreach ($this->_errors as $error) {
			$string .= $error . ' ';
		}
		return $string;
	}

	public function passed() {
		return $this->_passed;
	}
}