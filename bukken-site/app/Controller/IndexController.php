<?php

class IndexController extends AppController {
	var $layout = 'nisshin-bukken-0.0.1';

	public function beforeFilter() {
		// $this->Auth->allow('login', 'logout', 'add');
	}

	public function index() {
		$this->set(
			array(
				'title_for_layout'			=> 'Topページ'
			)
		);
		$this->render("../Contents/Index/indexInIndex");
	}
}
