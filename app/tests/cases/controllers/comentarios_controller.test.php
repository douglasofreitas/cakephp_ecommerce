<?php
/* Comentarios Test cases generated on: 2011-05-05 22:59:51 : 1304647191*/
App::import('Controller', 'Comentarios');

class TestComentariosController extends ComentariosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ComentariosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.comentario', 'app.produto', 'app.user');

	function startTest() {
		$this->Comentarios =& new TestComentariosController();
		$this->Comentarios->constructClasses();
	}

	function endTest() {
		unset($this->Comentarios);
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