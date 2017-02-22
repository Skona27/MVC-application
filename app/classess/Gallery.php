<?php

class Gallery  {

	private $_path,
			$_dir,
			$_extensions,
			$_deletedItems;

	public function __construct() {
		$this->_path = Config::get('path/uploads');
		$this->_dir = Config::get('dir/uploads');
		$this->_extensions = Config::get('file/image_ext');
	}

	private function scanDirectory($dir) {
		return scandir($dir);
	}

	public function deletedImages() {
		if($this->_deletedItems == 1) {
			$msg = ' image was deleted!';
		}	else $msg = ' images were deleted!';
		return $this->_deletedItems . $msg;
	}

	public function getImages() {
		$images = $this->scanDirectory($this->_dir);

		foreach ($images as $index => $image) {
			$extension = explode('.', $image);
			$extension = strtolower(end($extension));

			if(!in_array($extension, $this->_extensions)) {
				unset($images[$index]);
			}	else {
				$images[$index] = array(
					'path' => $this->_path . $image,
					'dir' => $this->_dir . $image
				);
			}
		}	return (count($images)) ? $images : false;
	}

	public function deleteImages($paths = array()) {
		$this->_deletedItems = 0;

		if(!empty($paths)) {
			foreach ($paths as $path) {
				if(File::delete($path)) {
					$this->_deletedItems++;
				}
			}
		}	return $this->_deletedItems;
	}

}