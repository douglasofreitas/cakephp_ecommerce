<?php
/* Moeda Test cases generated on: 2011-05-05 23:00:55 : 1304647255*/
App::import('Model', 'Moeda');

class MoedaTestCase extends CakeTestCase {
	var $fixtures = array('app.moeda', 'app.fatura', 'app.pedido', 'app.statusfatura', 'app.infopagamento', 'app.user', 'app.pagamento', 'app.produto');

	function startTest() {
		$this->Moeda =& ClassRegistry::init('Moeda');
	}

	function endTest() {
		unset($this->Moeda);
		ClassRegistry::flush();
	}

}
?>