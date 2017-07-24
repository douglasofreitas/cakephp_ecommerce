<?php
/* Statuspedidos Test cases generated on: 2011-05-05 23:01:26 : 1304647286*/
App::import('Controller', 'Statuspedidos');

class TestStatuspedidosController extends StatuspedidosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StatuspedidosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.statuspedido', 'app.pedido', 'app.user', 'app.fatura', 'app.statusfatura', 'app.moeda', 'app.produto', 'app.subcategoria', 'app.comentario', 'app.foto', 'app.itempedido', 'app.modelo', 'app.infopagamento', 'app.pagamento');

	function startTest() {
		$this->Statuspedidos =& new TestStatuspedidosController();
		$this->Statuspedidos->constructClasses();
	}

	function endTest() {
		unset($this->Statuspedidos);
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