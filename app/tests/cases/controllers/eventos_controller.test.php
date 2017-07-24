<?php
/* Eventos Test cases generated on: 2011-05-05 22:59:58 : 1304647198*/
App::import('Controller', 'Eventos');

class TestEventosController extends EventosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EventosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.evento', 'app.user');

	function startTest() {
		$this->Eventos =& new TestEventosController();
		$this->Eventos->constructClasses();
	}

	function endTest() {
		unset($this->Eventos);
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