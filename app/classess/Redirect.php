<?php

class Redirect {

	public static function to($location = null) {
		if($location) {
			if(is_numeric($location)) {
				switch($location) {
					case 404:
						header('HTTP/1.0 404 Not Found');
						//custom page error;
						exit();
						break;
					default:
						break;
				}
			}	else {
				header('Location: ' . Config::get('path/public') . $location);
				exit();
			}
		}
	}
}