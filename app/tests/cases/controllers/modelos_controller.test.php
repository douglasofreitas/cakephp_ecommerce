<?php
/* Modelos Test cases generated on: 2011-05-05 23:00:49 : 1304647249*/
App::import('Controller', 'Modelos');

class TestModelosController extends ModelosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ModelosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.modelo', 'app.produto');

	function startTest() {
		$this->Modelos =& new TestModelosController();
		$this->Modelos->constructClasses();
	}

	function endTest() {
		unset($this->Modelos);
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