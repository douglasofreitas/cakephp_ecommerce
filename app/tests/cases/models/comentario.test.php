<?php
/* Comentario Test cases generated on: 2011-05-05 22:59:48 : 1304647188*/
App::import('Model', 'Comentario');

class ComentarioTestCase extends CakeTestCase {
	var $fixtures = array('app.comentario', 'app.produto', 'app.user');

	function startTest() {
		$this->Comentario =& ClassRegistry::init('Comentario');
	}

	function endTest() {
		unset($this->Comentario);
		ClassRegistry::flush();
	}

}
?>