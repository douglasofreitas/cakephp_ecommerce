<?php
/* Moedas Test cases generated on: 2011-05-05 23:00:56 : 1304647256*/
App::import('Controller', 'Moedas');

class TestMoedasController extends MoedasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MoedasControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.moeda', 'app.fatura', 'app.pedido', 'app.statusfatura', 'app.infopagamento', 'app.user', 'app.pagamento', 'app.produto');

	function startTest() {
		$this->Moedas =& new TestMoedasController();
		$this->Moedas->constructClasses();
	}

	function endTest() {
		unset($this->Moedas);
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