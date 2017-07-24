<?php
/* Infopagamentos Test cases generated on: 2011-05-05 23:00:23 : 1304647223*/
App::import('Controller', 'Infopagamentos');

class TestInfopagamentosController extends InfopagamentosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class InfopagamentosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.infopagamento', 'app.user', 'app.fatura', 'app.pedido', 'app.statusfatura', 'app.moeda', 'app.pagamento');

	function startTest() {
		$this->Infopagamentos =& new TestInfopagamentosController();
		$this->Infopagamentos->constructClasses();
	}

	function endTest() {
		unset($this->Infopagamentos);
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