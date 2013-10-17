<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Less.Less');
	var $autoRender = false;
	var $ext = '.html';
	var $components = array('DebugKit.Toolbar');

	public function beforeRender() {
		$this->set(array(
			'css'			=> array(
				// '../plugin/bootstrap-3.0.0/dist/css/bootstrap.min.css'
				// 'style.css'
			),
			'script'		=> array(
				'http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js',
				'http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.1/underscore-min.js',
				'../plugin/jquery.tile/jquery.tile.min.js',
				'helper/Namespace.js',
				'common.js'
			),
			'less'			=> array(
				'../less/general/chrome_shared2.less',
				'../less/custom/common.less',
				'../less/custom/elements/header.less',
				'../less/custom/elements/menu.less',
				'../less/custom/elements/footer.less'
			)
		));
	}

	public function getResidenceData($area) {
		$data = $this->by_str_getcsv_explode('../../csv/tokyo(excel).csv');
			ob_start();//ここから
			var_dump($data);
			$out=ob_get_contents();//ob_startから出力された内容をゲットする。
			ob_end_clean();//ここまで
			error_log('-----------------' . "\n", 3, 'log.txt');
			error_log($out . "\n", 3, 'log.txt');
			error_log('-----------------' . "\n", 3, 'log.txt');

		// $data = array(
		// 	array(
		// 		'type'	=> 'palace',
		// 		'orderOfTop'	=> 0,
		// 		'residenceName'	=> 'Proud新宿',
		// 		'residenceUrl'	=> 'http://www.google.com',
		// 		'residenceThumb'	=> 'サムネイルパス0',
		// 		'area'	=> '東京23区',
		// 		'type'	=> 'palace',
		// 	)
		// );
		return $data;
	}

	public function by_str_getcsv_explode($file) {
		$ret = array();

		$buf = mb_convert_encoding(file_get_contents($file), 'utf-8', 'sjis-win');
		// $buf = file_get_contents($file);
		// $lines = explode("\n", $buf);
		$lines = explode("\r\n", $buf);
		array_pop($lines);
		foreach ($lines as $line) {
			$ret[] = str_getcsv($line);
		}

		return $ret;
	}
}
