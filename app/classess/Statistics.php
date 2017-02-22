<?php

class Statistics {

	private 	$_db,
				$_cookieExpiry,
				$_dateNow,
				$_datePast;

	private function __construct() {
		$this->_db = Database::getInstance();
		$this->_cookieExpiry = Config::get('stats/cookie_expiry');
		$this->_dateNow = date('Y-m-d');
		$this->_datePast = date('Y-m-d', strtotime('-' . Config::get('stats/cookie_expiry') . 'seconds', strtotime(date('Y-m-d'))));
	}	

	public static function track() {
		$statistics = new Statistics();

		$statistics->checkDate();
		$statistics->updateStats();
	}

	public static function allStats() {
		return Database::getInstance()->search('stats', array('1', '=', '1'))->results();
	}

	public static function summaryStats() {
		$statistics = Statistics::allStats();

		$all_visits = 0;
		$all_visitors = 0;
		$all_unique = 0;

		foreach ($statistics as $stat) {

			$all_visits += $stat->visits;
			$all_visitors += $stat->total_visitors;
			$all_unique += $stat->unique_visitors;
		}

		if($all_visitors && $all_unique) {
			$returning = floor(($all_visitors - $all_unique) / $all_visitors * 100);
			$new = ceil($all_unique / $all_visitors * 100);
		}	else {
			$returning = $all_visitors;
			$new = $all_unique;
		}

		if($all_visits && $all_visitors) {
			$per_user = ceil($all_visits / $all_visitors * 100) / 100;
		}	else {
			$per_user = 0;
		}

		return array(
			'all_visits' 	=> $all_visits,
			'all_visitors'	=> $all_visitors,
			'all_unique' 	=> $all_unique,
			'per_user' 		=> $per_user
		);
	}

	private function checkDate() {
		if(!$this->_db->search('stats', array('date', '=', $this->_dateNow))->results()) {
			$this->_db->insert('stats', array(
				'date' => $this->_dateNow
			));
		}

		$this->_db->delete('stats', array('date', '<', $this->_datePast));
	}

	private function updateStats() {
		$stats = $this->_db->search('stats', array('date', '=', $this->_dateNow))->first();

		$visits = $stats->visits;
		$total_visitors = $stats->total_visitors;
		$unique_visitors = $stats->unique_visitors;

		$id = $stats->id;

		$this->_db->update('stats', $id, array('visits' => $visits + 1));

		if(!Cookie::exists('unique_visitor')) {
			$this->_db->update('stats', $id, array('unique_visitors' => $unique_visitors + 1));
			Cookie::put('unique_visitor', Hash::unique(), $this->_cookieExpiry);
		}

		if(!Cookie::exists('visitor')) {
			$this->_db->update('stats', $id, array('total_visitors' => $total_visitors + 1));
			Cookie::put('visitor', Hash::unique(), 30);
		}
	}
}