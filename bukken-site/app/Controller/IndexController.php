<?php

class IndexController extends AppController {
	var $layout = 'nisshin-bukken-0.0.1';
	// var $name = 'Users';
	// var $components = array('Auth');

	public function beforeFilter() {
		// $this->Auth->allow('login', 'logout', 'add');
	}

	public function index() {
		// if ($this->request->isPost()) {
		// 	if ($this->Auth->login()) {
		// 		$this->redirect(array('controller'=>'Main', 'action'=>''));
		// 	} else {
		// 		$this->Session->setFlash('ユーザ名かパスワードが違います。', 'default', array(), 'auth');
		// 	}
		// }
		// $deviceName = $this->getDeviceName('p');
		// $this->set(
		// 	array(
		// 		'deviceName'			=> $deviceName,
		// 		'title_for_layout'		=> 'ログイン',
		// 		'modified'				=> filemtime("../webroot/history.html")
		// 	)
		// );
		// $this->render("../Contents/User/loginInUser");
		$this->render("../Contents/Index/indexInIndex");
		// echo 'ok';
	}
}
