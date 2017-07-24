<?php
/* Pedidos Test cases generated on: 2011-09-01 14:12:04 : 1314897124*/
App::import('Controller', 'Cielo.Pedidos');

class TestPedidosController extends PedidosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PedidosControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->Pedidos =& new TestPedidosController();
		$this->Pedidos->constructClasses();
	}

	function endTest() {
		unset($this->Pedidos);
		ClassRegistry::flush();
	}

}
?>