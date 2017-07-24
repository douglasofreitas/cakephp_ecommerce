<?php
/* Faturas Test cases generated on: 2011-05-05 23:00:04 : 1304647204*/
App::import('Controller', 'Faturas');

class TestFaturasController extends FaturasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FaturasControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.fatura', 'app.pedido', 'app.statusfatura', 'app.moeda', 'app.infopagamento', 'app.pagamento');

	function startTest() {
		$this->Faturas =& new TestFaturasController();
		$this->Faturas->constructClasses();
	}

	function endTest() {
		unset($this->Faturas);
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