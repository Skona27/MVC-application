<?php

class Admin extends Controller {

	public function __construct() {
		parent::__construct();

		$this->_model = $this->model('User_model');

		if(!$this->_model->user()->isLoggedIn()) {
			$this->login();
			die();
		}

		if(!$this->_model->user()->hasPermissions('admin')) {
			Session::put('danger', 'You have no admin permissions!');
			$this->login();
			die();
		}
	}
	
	public function index() {
		$this->dashboard();
	}

	protected function login() {
		if(Input::exists() && Token::check(Input::get('token'))) {
			if($this->_model->validate($_POST)->passed()) {
				if(!$this->_model->login()) {
					Session::put('danger', 'Wrong username or password!');
				}
			} 	else Session::put('danger', $this->_model->validate($_POST)->stringErrors());

			Redirect::to('admin');
		}

		$this->_view->render('admin/login/index');
	}

	public function dashboard() {
		$this->_view->render('admin/dashboard/index', array(
			'active' 		=> 'dashboard',
			'page_header' 	=> 'Dashboard',
			'page_desc' 	=> 'Summary of your app',
			'sum_stats' 	=> Statistics::summaryStats(),
			'all_stats' 	=> Statistics::allStats()
		));
	}

	public function logout() {
		$this->_model->user()->logout();
		Redirect::to('admin');
	}

	public function addImages() {
		if(Input::exists() && Token::check(Input::get('token'))) {
			if(File::exists(Input::get('Files'))) {
				File::upload(Input::get('Files'), Config::get('dir/uploads'), Config::get('file/image_ext'));

				if(!empty(File::uploaded())) {
					Session::put('success', File::uploaded());
				}

				if(!empty(File::failed())) {
					Session::put('danger', File::failed());
				}
			} 	else {
				Session::put('danger', 'Choose a file!');
			}
		}

		$this->_view->render('admin/addImages/index', array(
			'page_header' => 'Gallery',
			'page_desc' => 'Add images',
			'active' => 'gallery'
		));
	}

	public function deleteImages() {
		$gallery = new Gallery();

		if(Input::exists() && Token::check(Input::get('token'))) {
			if(!empty(Input::get('Delete'))) {
				if($gallery->deleteImages(Input::get('Delete'))) {
					Session::put('success', $gallery->deletedImages());
				}	else {
					Session::put('danger', 'Internal error!');
				}
			}	else {
				Session::put('danger', 'Choose at least one image!');
			}
		}

		$this->_view->render('admin/deleteImages/index', array(
			'page_header' => 'Gallery',
			'page_desc' => 'Delete images',
			'active' => 'gallery',
			'images' => $gallery->getImages()
		));
	}
}