<?php

class File {

	public static 	$uploaded = array();
	private static	$_failed = array();

	public static function exists($files = array()) {
		return (!empty($files['name'][0])) ? true : false;
	}

	public static function upload($files = array(), $path, $allowed_ext = array()) {
		foreach ($files['name'] as $position => $file_name) {
			
			$file_tmp = $files['tmp_name'][$position];
			$file_size = $files['size'][$position];
			$file_error = $files['error'][$position];

			$file_ext = explode('.', $file_name);
			$file_ext = strtolower(end($file_ext));

			if(in_array($file_ext, $allowed_ext)) {
				if($file_error === 0) {
					if($file_size <= Config::get('file/max_size')*1048576) {

						$new_file_name = uniqid('', true) . '.' . $file_ext;
						$file_destination = $path . $new_file_name;

						if(move_uploaded_file($file_tmp, $file_destination)) {
							File::$uploaded[$position] = $file_destination;
						}	else {
							File::$_failed[$position] = "[{$file_name}] failed to upload!";
						}

					}	else {
						File::$_failed[$position] = "[{$file_name}] is too large!";
					}
				}	else {
					File::$_failed[$position] = "[{$file_name}] errored with code {$file_error}!";
				}
			}	else {
				File::$_failed[$position] = "[{$file_name}] file extension '{$file_ext}' is not allowed!";
			}
		}
	}

	public static function uploaded() {
		if(empty(File::$uploaded)) {
			return false;
		}

		if(count(File::$uploaded) == 1) {
			$msg = ' plik został wrzucony!';
		}	else $msg = ' plików zostało wrzuconych!';
		return count(File::$uploaded) . $msg;
	}

	public static function failed() {
		return implode(' ', File::$_failed);
	}

	public static function delete($path) {
		if(file_exists($path)) {
			unlink($path);
			return true;
		}	else return false;
	}
}