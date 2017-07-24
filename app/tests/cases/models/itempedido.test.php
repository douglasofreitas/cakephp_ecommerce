<?php
/* Itempedido Test cases generated on: 2011-05-05 23:00:38 : 1304647238*/
App::import('Model', 'Itempedido');

class ItempedidoTestCase extends CakeTestCase {
	var $fixtures = array('app.itempedido', 'app.produto', 'app.pedido', 'app.user');

	function startTest() {
		$this->Itempedido =& ClassRegistry::init('Itempedido');
	}

	function endTest() {
		unset($this->Itempedido);
		ClassRegistry::flush();
	}

}
?>