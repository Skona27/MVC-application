<?php

class Settings_model extends Model {

	public function get_settings() {
		return $this->_db->search('settings', array('1', '=', '1'))->first();
	}

	public function update_settings($title, $keywords, $email, $description) {
		$this->_db->update('settings', 1, array(
			'title' => $title,
			'keywords' => $keywords,
			'email' => $email,
			'description' => $description,
		));
	}
}