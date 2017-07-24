<?php
/* Infopagamento Test cases generated on: 2011-05-05 23:00:22 : 1304647222*/
App::import('Model', 'Infopagamento');

class InfopagamentoTestCase extends CakeTestCase {
	var $fixtures = array('app.infopagamento', 'app.user', 'app.fatura', 'app.pedido', 'app.statusfatura', 'app.moeda', 'app.pagamento');

	function startTest() {
		$this->Infopagamento =& ClassRegistry::init('Infopagamento');
	}

	function endTest() {
		unset($this->Infopagamento);
		ClassRegistry::flush();
	}

}
?>