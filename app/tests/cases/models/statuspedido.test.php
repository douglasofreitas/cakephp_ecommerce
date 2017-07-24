<?php
/* Statuspedido Test cases generated on: 2011-05-05 23:01:26 : 1304647286*/
App::import('Model', 'Statuspedido');

class StatuspedidoTestCase extends CakeTestCase {
	var $fixtures = array('app.statuspedido', 'app.pedido', 'app.user', 'app.fatura', 'app.statusfatura', 'app.moeda', 'app.produto', 'app.subcategoria', 'app.comentario', 'app.foto', 'app.itempedido', 'app.modelo', 'app.infopagamento', 'app.pagamento');

	function startTest() {
		$this->Statuspedido =& ClassRegistry::init('Statuspedido');
	}

	function endTest() {
		unset($this->Statuspedido);
		ClassRegistry::flush();
	}

}
?>