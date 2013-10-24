<?php

class AreaController extends AppController {
	var $layout = 'nisshin-bukken-0.0.1';

	public function beforeFilter() {
	}

	public function tokyo() {
		$data = $this->getResidenceData('tokyo');
		$this->set(
			array(
				'title_for_layout'			=> '東京ページ',
				'area'						=> 'tokyo',
				'residence_data'			=> $data
			)
		);
		$this->render("../Contents/Area/pageInArea");
	}

	public function kanagawa() {
		$data = $this->getResidenceData('kanagawa');
		$this->set(
			array(
				'title_for_layout'			=> '神奈川ページ',
				'area'						=> 'kanagawa',
				'residence_data'			=> $data
			)
		);
		$this->render("../Contents/Area/pageInArea");
	}

	public function chiba() {
		$data = $this->getResidenceData('chiba');
		$this->set(
			array(
				'title_for_layout'			=> '千葉ページ',
				'area'						=> 'chiba',
				'residence_data'			=> $data
			)
		);
		$this->render("../Contents/Area/pageInArea");
	}

	public function saitama() {
		$data = $this->getResidenceData('saitama');
		$this->set(
			array(
				'title_for_layout'			=> '埼玉ページ',
				'area'						=> 'saitama',
				'residence_data'			=> $data
			)
		);
		$this->render("../Contents/Area/pageInArea");
	}

	public function all() {
		$data = $this->getResidenceData('all');
		$this->set(
			array(
				'title_for_layout'			=> '全物件ページ',
				'area'						=> 'all',
				'residence_data'			=> $data
			)
		);
		$this->render("../Contents/Area/pageInArea");
	}
}
