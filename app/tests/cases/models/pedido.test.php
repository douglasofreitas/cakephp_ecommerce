<?php
/* Pedido Test cases generated on: 2011-05-05 23:01:08 : 1304647268*/
App::import('Model', 'Pedido');

class PedidoTestCase extends CakeTestCase {
	var $fixtures = array('app.pedido', 'app.statuspedido', 'app.user', 'app.fatura', 'app.statusfatura', 'app.moeda', 'app.produto', 'app.infopagamento', 'app.pagamento', 'app.itempedido');

	function startTest() {
		$this->Pedido =& ClassRegistry::init('Pedido');
	}

	function endTest() {
		unset($this->Pedido);
		ClassRegistry::flush();
	}

}
?>