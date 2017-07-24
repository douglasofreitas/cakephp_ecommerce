<?php
/* Fotos Test cases generated on: 2011-05-05 23:00:09 : 1304647209*/
App::import('Controller', 'Fotos');

class TestFotosController extends FotosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FotosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.foto', 'app.produto');

	function startTest() {
		$this->Fotos =& new TestFotosController();
		$this->Fotos->constructClasses();
	}

	function endTest() {
		unset($this->Fotos);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>