<?php

class ConceptController extends AppController {
	var $layout = 'nisshin-bukken-0.0.1';

	public function beforeFilter() {
		// $this->Auth->allow('login', 'logout', 'add');
	}

	public function concept() {
		$this->render("../Contents/Concept/conceptInConcept");
	}
}