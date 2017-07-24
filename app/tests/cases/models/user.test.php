<?php
/* User Test cases generated on: 2011-05-05 23:01:41 : 1304647301*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.group', 'app.comentario', 'app.produto', 'app.subcategoria', 'app.categoria', 'app.moeda', 'app.fatura', 'app.pedido', 'app.statuspedido', 'app.itempedido', 'app.statusfatura', 'app.infopagamento', 'app.pagamento', 'app.foto', 'app.modelo', 'app.evento');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
?>