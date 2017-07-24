<?php
/* Pedidos Test cases generated on: 2011-05-05 23:01:08 : 1304647268*/
App::import('Controller', 'Pedidos');

class TestPedidosController extends PedidosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PedidosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.pedido', 'app.statuspedido', 'app.user', 'app.fatura', 'app.statusfatura', 'app.moeda', 'app.produto', 'app.infopagamento', 'app.pagamento', 'app.itempedido');

	function startTest() {
		$this->Pedidos =& new TestPedidosController();
		$this->Pedidos->constructClasses();
	}

	function endTest() {
		unset($this->Pedidos);
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