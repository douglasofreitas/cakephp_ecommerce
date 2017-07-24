<?php
/* Itempedidos Test cases generated on: 2011-05-05 23:00:39 : 1304647239*/
App::import('Controller', 'Itempedidos');

class TestItempedidosController extends ItempedidosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ItempedidosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.itempedido', 'app.produto', 'app.pedido', 'app.user');

	function startTest() {
		$this->Itempedidos =& new TestItempedidosController();
		$this->Itempedidos->constructClasses();
	}

	function endTest() {
		unset($this->Itempedidos);
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