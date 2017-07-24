<?php
/* Statusfaturas Test cases generated on: 2011-05-05 23:01:21 : 1304647281*/
App::import('Controller', 'Statusfaturas');

class TestStatusfaturasController extends StatusfaturasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StatusfaturasControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.statusfatura', 'app.fatura', 'app.pedido', 'app.statuspedido', 'app.user', 'app.itempedido', 'app.produto', 'app.subcategoria', 'app.moeda', 'app.comentario', 'app.foto', 'app.modelo', 'app.infopagamento', 'app.pagamento');

	function startTest() {
		$this->Statusfaturas =& new TestStatusfaturasController();
		$this->Statusfaturas->constructClasses();
	}

	function endTest() {
		unset($this->Statusfaturas);
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