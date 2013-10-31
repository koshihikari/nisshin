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

	function afterFilter(){
		// 出力文字コード変更(UTF8からSJIS)
		$this->response->body(mb_convert_encoding($this->response->body(), 'Shift_JIS','UTF-8'));
		$this->response->charset('SHIFT-JIS');
	}

	public function beforeRender() {
		$this->set(array(
			'css'			=> array(
				// '../plugin/bootstrap-3.0.0/dist/css/bootstrap.min.css'
				// 'style.css'
			),
			'script'		=> array(
				'http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js',
				'http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.1/underscore-min.js',
				'../plugin/jquery-floating-widget-plugin/floatingWidget.js',
				'../plugin/jquery.tile/jquery.tile.min.js',
				'../cake-js/helper/Namespace.js',
				'../cake-js/common.js'
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
		$csv = $this->by_str_getcsv_explode('../../data/palacestage.csv');

		// ob_start();//ここから
		// var_dump($csv);
		// $out=ob_get_contents();//ob_startから出力された内容をゲットする。
		// ob_end_clean();//ここまで
		// error_log('-----------------' . "\n", 3, 'log.txt');
		// error_log($out . "\n", 3, 'log.txt');
		// error_log('-----------------' . "\n", 3, 'log.txt');

		// CSVからエリアごとのデータを抽出する
		$data = array();
		for ($i=1,$len=count($csv); $i<$len; $i++) {
			if (
				($area === 'top' && is_numeric(preg_replace('/[^0-9]/', '', $csv[$i][2])) === true)
				||
				($area === 'tokyo' && ($csv[$i][7] === '東京23区' || $csv[$i][7] === '東京都下'))
				||
				($area === 'kanagawa' && $csv[$i][7] === '神奈川')
				||
				($area === 'chiba' && $csv[$i][7] === '千葉')
				||
				($area === 'saitama' && $csv[$i][7] === '埼玉')
				||
				($area === 'all')
			) {
				// 並び順を取得
				$order = 0;
				if ($area === 'top') {
					$order = (int)preg_replace('/[^0-9]/', '', $csv[$i][2]) - 1;
				} else {
					$order = (int)$csv[$i][21] - 1;
				}
				if ($order < 0 || $csv[$i][1] === '非表示') {
					continue;
				}

				// 物件タイプを取得
				// $residenceType = '';
				// if (0 < preg_match('/palace/i', $csv[$i][1])) {
				// 	$residenceType = 'palace';
				// } else if (0 < preg_match('/duo/i', $csv[$i][1])) {
				// 	$residenceType = 'duo';
				// }

				// エリア区別を取得
				if ($area === 'tokyo') {
					$areaType = $csv[$i][7] === '東京23区' ? 'tokyo23' : 'tokyoOther';
				} else if ($area === 'all') {
					if ($csv[$i][7] === '東京23区' || $csv[$i][7] === '東京都下') {
						$areaType = $csv[$i][7] === '東京23区' ? 'tokyo23' : 'tokyoOther';
					} else if ($csv[$i][7] === '神奈川') {
						$areaType = 'kanagawa';
					} else if ($csv[$i][7] === '千葉') {
						$areaType = 'chiba';
					} else if ($csv[$i][7] === '埼玉') {
						$areaType = 'saitama';
					}
				}

				// 利用可能路線(1〜4)を取得
				$train = array();
				for ($j=9; $j<13; $j++) {
					if ($csv[$i][$j] !== '') {
						array_push($train, $csv[$i][$j]);
					}
				}

				// 予定価格(下限, 上限)を取得
				$estPrice = array();
				for ($j=14; $j<16; $j++) {
					if ($csv[$i][$j] !== '') {
						array_push($estPrice, $csv[$i][$j]);
					}
				}

				// 販売価格(下限, 上限)を取得
				$salePrice = array();
				for ($j=16; $j<18; $j++) {
					if ($csv[$i][$j] !== '') {
						array_push($salePrice, $csv[$i][$j]);
					}
				}
			if ($salePrice[0] !== '未定') {
		// 		if (0 < count($salePrice) && ($salePrice[0] !== $salePrice[1])) {
		// 			$keywords = preg_split('/[0-9]/', $salePrice[0]);
		// ob_start();//ここから
		// var_dump($keywords);
		// $out=ob_get_contents();//ob_startから出力された内容をゲットする。
		// ob_end_clean();//ここまで
		// error_log('-----------------' . "\n", 3, 'log.txt');
		// error_log($out . "\n", 3, 'log.txt');
		// error_log('-----------------' . "\n", 3, 'log.txt');
				// 	number_format($salePrice[0]) . '万円〜' . number_format($salePrice[1]) . '万円';
				// } else {
				// 	number_format($salePrice[0]) . '万円';
				// }
			}

				// 専有面積(下限, 上限)を取得
				$exArea = array();
				for ($j=18; $j<20; $j++) {
					if ($csv[$i][$j] !== '') {
						array_push($exArea, $csv[$i][$j]);
					}
				}

				// 間取り(下限, 上限)を取得
				$plan = array();
				for ($j=22; $j<24; $j++) {
					if ($csv[$i][$j] !== '') {
						array_push($plan, $csv[$i][$j]);
					}
				}

				$tmpData = array(
					'resiName'			=> $csv[$i][3],		// 物件名
					'topResiTxt'		=> $csv[$i][4],		// TOP物件コメント
					'resiUrl'			=> $csv[$i][5],		// 物件URL
					'resiThumb'			=> $csv[$i][6],		// 物件サムネイル画像
					'area'				=> $csv[$i][7],		// エリア
					'address'				=> $csv[$i][8],		// 所在地
					'train'				=> $train,			// 利用可能路線(1〜4)
					'meritCopy'			=> $csv[$i][13],	// メリットコピー
					'estPrice'			=> $estPrice,		// 予定価格(下限, 上限)
					'salePrice'			=> $salePrice,		// 販売価格(下限, 上限)
					'exArea'			=> $exArea,			// 専有面積(下限, 上限)
					'requestUrl'		=> $csv[$i][20],	// 資料請求URL
					'plan'				=> $plan,			// 間取り(下限, 上限)
					'isNew'				=> $csv[$i][24] === '表示' ? true : false,		// NEW
					'icon'				=> array(
						'isTimeOnFoot'		=> $csv[$i][25] === '表示' ? true : false,	// 駅5分
						'isFamily'			=> $csv[$i][26] === '表示' ? true : false,	// ファミリーにおすすめ
						'isSingleDinks'		=> $csv[$i][27] === '表示' ? true : false,	// SINGLE・DINKS
						'isVisitLocal'		=> $csv[$i][28] === '表示' ? true : false,	// 現地内覧可
						'isOpenGallery'		=> $csv[$i][29] === '表示' ? true : false,	// モデルルーム公開中
					)
				);

				// 東京の場合は23区と都下も区別
				if ($area === 'tokyo' || $area === 'all') {
					$data[$areaType][$order] = $tmpData;
					// $data[$areaType][$residenceType][$order] = $tmpData;
				} else {
					$data[$order] = $tmpData;
					// $data[$residenceType][$order] = $tmpData;
				}
			}
		}


		// 東京の場合は23区と都下をマージ
		// if ($area === 'tokyo') {
		// 	if (array_key_exists('palace', $data) && array_key_exists('duo', $data)) {
		// 		if (array_key_exists('tokyo23', $data['palace']) && array_key_exists('tokyoOther', $data['palace'])) {
		// 			$data['palace'] = array_merge($data['palace']['tokyo23'], $data['palace']['tokyoOther']);
		// 		}
		// 	} else if (array_key_exists('palace', $data)) {
		// 		$fixedData = $data['palace'];
		// 	} else if (array_key_exists('duo', $data)) {
		// 		$fixedData = $data['duo'];
		// 	}

		// }

		// if (array_key_exists('palace', $data) && array_key_exists('duo', $data)) {
		// 	$fixedData = array_merge($data['palace'], $data['duo']);
		// } else if (array_key_exists('palace', $data)) {
		// 	$fixedData = $data['palace'];
		// } else if (array_key_exists('duo', $data)) {
		// 	$fixedData = $data['duo'];
		// }

		// ob_start();//ここから
		// var_dump($data);
		// $out=ob_get_contents();//ob_startから出力された内容をゲットする。
		// ob_end_clean();//ここまで
		// error_log('-----------------' . "\n", 3, 'log.txt');
		// error_log($out . "\n", 3, 'log.txt');
		// error_log('-----------------' . "\n", 3, 'log.txt');

		// for ($i=0,$len=count($data['tokyoOther']['palace']); $i<$len; $i++) {
		// 	error_log($data['tokyoOther']['palace'][$i]['resiName'] . "\n", 3, 'log.txt');
		// }

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
