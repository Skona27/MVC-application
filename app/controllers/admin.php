<?php

class Admin extends Controller {

	protected $_user;

	public function __construct() {
		parent::__construct();

		$this->_model = $this->model('user_model');
		@$this->_user = $this->_model->user()->data();

		if(!$this->_model->user()->isLoggedIn()) {
			$this->login();
			die();
		}

		if(!$this->_model->user()->hasPermissions('admin')) {
			Session::put('danger', 'Nie masz uprawnień administratora!');
			$this->login();
			die();
		}
	}
	
	public function index() {
		$this->dashboard();
	}









	//Statystyki

	public function dashboard() {
		$this->_view->render('admin/dashboard/index', array(
			'css' 			=> array('morris.css'),
			'active' 		=> 'dashboard',
			'username'		=> $this->_user->username,
			'page_header' 	=> 'Statystyki',
			'page_desc' 	=> 'Podsumowanie',
			'sum_stats' 	=> Statistics::summaryStats(),
			'all_stats' 	=> Statistics::allStats()
		));
	}







	//Ustawienia

	public function settings() {
		$this->_model = $this->model('settings_model');

		if(Input::exists() && Token::check(Input::get('token'))) {
			if(!empty(Input::get('title')) || !empty(Input::get('description')) || !empty(Input::get('keywords')) || !empty(Input::get('email'))) {
				$this->_model->update_settings(Input::get('title'), Input::get('keywords'), Input::get('email'), Input::get('description'));
				Session::put('success', 'Zmiany zostały zapisane!');
			}	else Session::put('danger', 'Podaj nazwę!');
		}

		$this->_view->render('admin/settings/index', array(
			'page_header' 	=> 'Ustawienia',
			'page_desc' 	=> 'Zarządzaj stroną',
			'active' 		=> 'ustawienia',
			'settings' 		=> $this->_model->get_settings(),
			'username'		=> $this->_user->username,
		));
	}











	//User

	protected function login() {
		if(Input::exists() && Token::check(Input::get('token'))) {
			if($this->_model->validate($_POST)->passed()) {
				if(!$this->_model->login()) {
					Session::put('danger', 'Zły login lub hasło!');
				}
			} 	else Session::put('danger', $this->_model->validate($_POST)->stringErrors());

			Redirect::to('admin');
		}

		$this->_view->render('admin/login/index');
	}

	public function logout() {
		$this->_model->user()->logout();
		Redirect::to('admin');
	}

	public function see_profile() {
		$this->_view->render('admin/profile/see_profile', array(
			'page_header' 	=> 'Ustawienia',
			'page_desc'		=> 'Profil użytkownika',
			'active' 		=> 'none',
			'username'		=> $this->_user->username,
			'name' 			=> $this->_user->name,
			'joined' 		=> $this->_user->joined,
			'group' 		=> $this->_model->get_group($this->_user->group)->name,
		));
	}	

	public function edit_profile() {
		if(Input::exists() && Token::check(Input::get('token'))) {
			if(!empty(Input::get('name')) || !empty(Input::get('login')) || !empty(Input::get('password'))) {

				if(Hash::make(Input::get('password'), $this->user->salt) !== $this->user->password) {
					Session::put('danger', 'Błędne hasło!');
				} else {
					$this->_model->update_profile($this->user->id, Input::get('login'), Input::get('name'));
					Session::put('success', 'Zmiany zostały zapisane!');
					Redirect::to('admin/edit_profile');
				}
			}	else Session::put('danger', 'Podaj nazwę!');
		}

		$this->_view->render('admin/profile/edit_profile', array(
			'page_header' 	=> 'Ustawienia',
			'page_desc' 	=> 'Edytuj profil',
			'active' 		=> 'none',
			'username'		=> $this->_user->username,
			'name' 			=> $this->_user->name,
		));
	}

	public function change_password() {
		if(Input::exists() && Token::check(Input::get('token'))) {
			if(!empty(Input::get('password')) || !empty(Input::get('password_new')) || !empty(Input::get('password_again'))) {

				if(Hash::make(Input::get('password'), $this->user->salt) !== $this->user->password) {
					Session::put('danger', 'Błędne hasło!');
				} else {
					$validate = new Validate();
					$validation = $validate->check($_POST, array(
						'password_new' 	=> array(
							'required' 	=> true,
							'min' 		=> 6
						),
						'password_again' => array(
							'required' 	=> true,
							'min' 		=> 6,
							'matches' 	=> 'password_new'
						)
					));

					if($validation->passed()) {
						$this->_model->change_password(Input::get('password_new'));
						Session::put('success', 'Zmiany zostały zapisane!');
					}	else {
						Session::put('danger', $validation->stringErrors());
					}
				}
			}	else Session::put('danger', 'Podaj nazwę!');
		}

		$this->_view->render('admin/profile/change_password', array(
			'page_header' 		=> 'Ustawienia',
			'page_desc' 		=> 'Zmień hasło',
			'active' 			=> 'none',
			'username'			=> $this->_user->username,
			'name' 				=> $this->_user->name,
		));
	}

	public function register_user() {
		if(Input::exists() && Token::check(Input::get('token'))) {
			if(!empty(Input::get('name')) || !empty(Input::get('username')) || !empty(Input::get('password')) || !empty(Input::get('password_again'))) {

				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'username' => array(
						'required' 	=> true,
						'min'		=> 3,
						'max' 		=> 20,
						'unique' 	=> 'users'
					),
					'password' 		=> array(
						'required'	=> true,
						'min' 		=> 6
					),
					'password_again' 	=> array(
						'required' 		=> true,
						'matches'		=> 'password'
					),
					'name' => array(
						'required' 	=> true,
						'min' 		=> 3,
						'max' 		=> 50
					)
				));

				if($validation->passed()) {
					$this->_model->register(Input::get('username'), Input::get('password'), Input::get('name'));
					Session::put('success', 'Nowy użytkownik został dodany!');
				} else {
					Session::put('danger', $validation->stringErrors());
				}
			}	else Session::put('danger', 'Wypełnij wszystkie pola!');
		}

		$this->_view->render('admin/profile/register_user', array(
			'page_header' 	=> 'Ustawienia',
			'page_desc' 	=> 'Dodaj użytkownika',
			'active' 		=> 'none',
			'username'		=> $this->_user->username,
		));
	}














	//Gallery

	public function add_images() {
		if(!Config::get('modules/gallery')) {
			Session::put('danger', 'Nie masz wystarczających uprawnień!');
			Redirect::to('admin');
		}

		if(Input::exists() && Token::check(Input::get('token'))) {
			if(File::exists(Input::get('Files'))) {
				File::upload(Input::get('Files'), Config::get('dir/gallery'), Config::get('file/image_ext'));

				if(!empty(File::uploaded())) {
					Session::put('success', File::uploaded());
				}

				if(!empty(File::failed())) {
					Session::put('danger', File::failed());
				}
			} 	else {
				Session::put('danger', 'Wybierz plik!');
			}
		}

		$this->_view->render('admin/gallery/add-images', array(
			'page_header' 	=> 'Galeria',
			'page_desc' 	=> 'Dodaj zdjęcia',
			'active' 		=> 'gallery',
			'username'		=> $this->_user->username,
		));
	}

	public function delete_images() {
		if(!Config::get('modules/gallery')) {
			Session::put('danger', 'Nie masz wystarczających uprawnień!');
			Redirect::to('admin');
		}

		$gallery = new Gallery();

		if(Input::exists() && Token::check(Input::get('token'))) {
			if(!empty(Input::get('Delete'))) {
				if($gallery->deleteImages(Input::get('Delete'))) {
					Session::put('success', $gallery->deletedImages());
				}	else {
					Session::put('danger', 'Błąd serwera! Skontaktuj się ze swoim administratorem');
				}
			}	else {
				Session::put('danger', 'Wybierz przynajmniej jeden obraz!');
			}
		}

		$this->_view->render('admin/gallery/delete-images', array(
			'page_header' 	=> 'Galeria',
			'page_desc' 	=> 'Usuń zdjęcia',
			'active' 		=> 'gallery',
			'username'		=> $this->_user->username,
			'images' 		=> $gallery->getImages()
		));
	}
}