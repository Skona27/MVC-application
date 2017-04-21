<?php
class Pagination {
	private $_allItems,
			$_perPage,
			$_pages;

	public function __construct($allItems, $perPage) {
		$this->_allItems = $allItems;
		$this->_perPage = $perPage;
		$this->_pages = ceil($this->_allItems / $this->_perPage);
	}

	public function allItems() {
		return $this->_allItems;
	}

	public function pages() {
		return $this->_pages;
	}

	public function perPage() {
		return $this->_perPage;
	}

	public function paginate($pageID) {
		if($pageID > 1) {
			return ($pageID * $this->_perPage) - $this->_perPage;
		} else {
			return 0;
		}
	}
}