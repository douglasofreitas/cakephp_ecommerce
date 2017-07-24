<?php
/* Categorias Test cases generated on: 2011-05-05 22:59:41 : 1304647181*/
App::import('Controller', 'Categorias');

class TestCategoriasController extends CategoriasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CategoriasControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.categoria', 'app.subcategoria');

	function startTest() {
		$this->Categorias =& new TestCategoriasController();
		$this->Categorias->constructClasses();
	}

	function endTest() {
		unset($this->Categorias);
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