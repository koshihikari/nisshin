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

	public function kanagawa() {
		$this->set(
			array(
				'title_for_layout'			=> '神奈川ページ'
			)
		);
		$this->render("../Contents/Area/kanagawaInArea");
	}

	public function chiba() {
		$this->set(
			array(
				'title_for_layout'			=> '千葉ページ'
			)
		);
		$this->render("../Contents/Area/chibaInArea");
	}

	public function saitama() {
		$this->set(
			array(
				'title_for_layout'			=> '埼玉ページ'
			)
		);
		$this->render("../Contents/Area/saitamaInArea");
	}
}
