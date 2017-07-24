<?php
/* Produtos Test cases generated on: 2011-05-05 23:01:14 : 1304647274*/
App::import('Controller', 'Produtos');

class TestProdutosController extends ProdutosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProdutosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.produto', 'app.subcategoria', 'app.moeda', 'app.fatura', 'app.pedido', 'app.statuspedido', 'app.user', 'app.itempedido', 'app.statusfatura', 'app.infopagamento', 'app.pagamento', 'app.comentario', 'app.foto', 'app.modelo');

	function startTest() {
		$this->Produtos =& new TestProdutosController();
		$this->Produtos->constructClasses();
	}

	function endTest() {
		unset($this->Produtos);
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