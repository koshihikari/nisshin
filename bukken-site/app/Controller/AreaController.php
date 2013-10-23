<?php

class AreaController extends AppController {
	var $layout = 'nisshin-bukken-0.0.1';

	public function beforeFilter() {
	}

	public function tokyo() {
		$this->set(
			array(
				'title_for_layout'			=> '東京ページ',
				'area'						=> 'tokyo'
			)
		);
		$this->render("../Contents/Area/pageInArea");
	}

	public function kanagawa() {
		$this->set(
			array(
				'title_for_layout'			=> '神奈川ページ',
				'area'						=> 'kanagawa'
			)
		);
		$this->render("../Contents/Area/pageInArea");
	}

	public function chiba() {
		$this->set(
			array(
				'title_for_layout'			=> '千葉ページ',
				'area'						=> 'chiba'
			)
		);
		$this->render("../Contents/Area/pageInArea");
	}

	public function saitama() {
		$this->set(
			array(
				'title_for_layout'			=> '埼玉ページ',
				'area'						=> 'saitama'
			)
		);
		$this->render("../Contents/Area/pageInArea");
	}

	public function all() {
		$this->set(
			array(
				'title_for_layout'			=> '全物件ページ',
				'area'						=> 'all'
			)
		);
		$this->render("../Contents/Area/pageInArea");
	}
}
