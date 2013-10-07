<?php

class AreaController extends AppController {
	var $layout = 'nisshin-bukken-0.0.1';

	public function beforeFilter() {
		// $this->Auth->allow('login', 'logout', 'add');
	}

	public function tokyo() {
		$this->set(
			array(
				'title_for_layout'			=> '東京ページ'
			)
		);
		$this->render("../Contents/Area/tokyoInArea");
	}
}
