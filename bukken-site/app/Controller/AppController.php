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
			),
			'script'		=> array(
				'http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js',
				// 'http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.map',
				// '//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js',
				'http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.1/underscore-min.js',
				// '//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.0.0/backbone-min.js',
				// '../plugin/bootstrap-3.0.0/dist/js/bootstrap.min.js',
				'helper/Namespace.js'
				// 'helper/Gateway.js'
			),
			'less'			=> array(
				'../less/general/chrome_shared2.less',
				'../less/custom/common.less',
				'../less/custom/header.less',
				'../less/custom/menu.less'
			)
		));
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
