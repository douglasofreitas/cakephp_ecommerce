<?php
/* Statusfatura Test cases generated on: 2011-05-05 23:01:20 : 1304647280*/
App::import('Model', 'Statusfatura');

class StatusfaturaTestCase extends CakeTestCase {
	var $fixtures = array('app.statusfatura', 'app.fatura', 'app.pedido', 'app.statuspedido', 'app.user', 'app.itempedido', 'app.produto', 'app.subcategoria', 'app.moeda', 'app.comentario', 'app.foto', 'app.modelo', 'app.infopagamento', 'app.pagamento');

	function startTest() {
		$this->Statusfatura =& ClassRegistry::init('Statusfatura');
	}

	function endTest() {
		unset($this->Statusfatura);
		ClassRegistry::flush();
	}

}
?>