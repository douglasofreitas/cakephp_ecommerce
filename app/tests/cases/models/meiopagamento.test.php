<?php
/* Meiopagamento Test cases generated on: 2011-05-05 23:00:44 : 1304647244*/
App::import('Model', 'Meiopagamento');

class MeiopagamentoTestCase extends CakeTestCase {
	var $fixtures = array('app.meiopagamento');

	function startTest() {
		$this->Meiopagamento =& ClassRegistry::init('Meiopagamento');
	}

	function endTest() {
		unset($this->Meiopagamento);
		ClassRegistry::flush();
	}

}
?>