<?php
/* Meiopagamentos Test cases generated on: 2011-05-05 23:00:44 : 1304647244*/
App::import('Controller', 'Meiopagamentos');

class TestMeiopagamentosController extends MeiopagamentosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MeiopagamentosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.meiopagamento');

	function startTest() {
		$this->Meiopagamentos =& new TestMeiopagamentosController();
		$this->Meiopagamentos->constructClasses();
	}

	function endTest() {
		unset($this->Meiopagamentos);
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