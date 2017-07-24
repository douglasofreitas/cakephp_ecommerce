<?php
/* Pagamentos Test cases generated on: 2011-05-05 23:01:04 : 1304647264*/
App::import('Controller', 'Pagamentos');

class TestPagamentosController extends PagamentosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PagamentosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.pagamento', 'app.fatura', 'app.pedido', 'app.statusfatura', 'app.moeda', 'app.produto', 'app.infopagamento', 'app.user');

	function startTest() {
		$this->Pagamentos =& new TestPagamentosController();
		$this->Pagamentos->constructClasses();
	}

	function endTest() {
		unset($this->Pagamentos);
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