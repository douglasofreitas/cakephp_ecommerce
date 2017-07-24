<?php
/* Fatura Test cases generated on: 2011-05-05 23:00:03 : 1304647203*/
App::import('Model', 'Fatura');

class FaturaTestCase extends CakeTestCase {
	var $fixtures = array('app.fatura', 'app.pedido', 'app.statusfatura', 'app.moeda', 'app.infopagamento', 'app.pagamento');

	function startTest() {
		$this->Fatura =& ClassRegistry::init('Fatura');
	}

	function endTest() {
		unset($this->Fatura);
		ClassRegistry::flush();
	}

}
?>