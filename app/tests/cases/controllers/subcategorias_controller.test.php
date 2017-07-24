<?php
/* Subcategorias Test cases generated on: 2011-05-05 23:01:35 : 1304647295*/
App::import('Controller', 'Subcategorias');

class TestSubcategoriasController extends SubcategoriasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SubcategoriasControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.subcategoria', 'app.categoria', 'app.produto', 'app.moeda', 'app.fatura', 'app.pedido', 'app.statuspedido', 'app.user', 'app.itempedido', 'app.statusfatura', 'app.infopagamento', 'app.pagamento', 'app.comentario', 'app.foto', 'app.modelo');

	function startTest() {
		$this->Subcategorias =& new TestSubcategoriasController();
		$this->Subcategorias->constructClasses();
	}

	function endTest() {
		unset($this->Subcategorias);
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