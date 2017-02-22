<?php

class View {

	public function render($view, $data = array()) {
		switch(explode('/', $view)[0]) {
			case 'admin':
				if(explode('/', $view)[1] === 'login') {
					require_once '../app/views/' . $view . '.php';
				} else {
					require_once '../app/views/admin/template/header.php';
					require_once '../app/views/' . $view . '.php';
					require_once '../app/views/admin/template/footer.php';
				}
				break;
			case 'page':
				require_once '../app/views/page/template/header.php';
				require_once '../app/views/' . $view . '.php';
				require_once '../app/views/page/template/footer.php';
		}
	}
}