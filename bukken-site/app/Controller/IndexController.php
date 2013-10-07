<?php

class IndexController extends AppController {
	var $layout = 'nisshin-bukken-0.0.1';

	public function beforeFilter() {
		// $this->Auth->allow('login', 'logout', 'add');
	}

	public function index() {
		$data = $this->by_str_getcsv_explode('../../csv/tokyo(excel).csv');
			ob_start();//ここから
			var_dump($data);
			$out=ob_get_contents();//ob_startから出力された内容をゲットする。
			ob_end_clean();//ここまで
			error_log('-----------------' . "\n", 3, 'log.txt');
			error_log($out . "\n", 3, 'log.txt');
			error_log('-----------------' . "\n", 3, 'log.txt');
		$this->set(
			array(
				'title_for_layout'			=> 'Topページ'
			)
		);
		$this->render("../Contents/Index/indexInIndex");
	}
}
