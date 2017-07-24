<?php
/* Users Test cases generated on: 2011-05-05 23:01:43 : 1304647303*/
App::import('Controller', 'Users');

class TestUsersController extends UsersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UsersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.group', 'app.comentario', 'app.produto', 'app.subcategoria', 'app.categoria', 'app.moeda', 'app.fatura', 'app.pedido', 'app.statuspedido', 'app.itempedido', 'app.statusfatura', 'app.infopagamento', 'app.pagamento', 'app.foto', 'app.modelo', 'app.evento');

	function startTest() {
		$this->Users =& new TestUsersController();
		$this->Users->constructClasses();
	}

	function endTest() {
		unset($this->Users);
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