<?php
/* Pagamento Test cases generated on: 2011-05-05 23:01:03 : 1304647263*/
App::import('Model', 'Pagamento');

class PagamentoTestCase extends CakeTestCase {
	var $fixtures = array('app.pagamento', 'app.fatura', 'app.pedido', 'app.statusfatura', 'app.moeda', 'app.produto', 'app.infopagamento', 'app.user');

	function startTest() {
		$this->Pagamento =& ClassRegistry::init('Pagamento');
	}

	function endTest() {
		unset($this->Pagamento);
		ClassRegistry::flush();
	}

}
?>