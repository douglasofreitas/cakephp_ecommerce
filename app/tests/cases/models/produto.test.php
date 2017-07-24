<?php
/* Produto Test cases generated on: 2011-05-05 23:01:13 : 1304647273*/
App::import('Model', 'Produto');

class ProdutoTestCase extends CakeTestCase {
	var $fixtures = array('app.produto', 'app.subcategoria', 'app.moeda', 'app.fatura', 'app.pedido', 'app.statuspedido', 'app.user', 'app.itempedido', 'app.statusfatura', 'app.infopagamento', 'app.pagamento', 'app.comentario', 'app.foto', 'app.modelo');

	function startTest() {
		$this->Produto =& ClassRegistry::init('Produto');
	}

	function endTest() {
		unset($this->Produto);
		ClassRegistry::flush();
	}

}
?>