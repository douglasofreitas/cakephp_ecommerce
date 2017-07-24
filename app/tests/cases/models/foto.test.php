<?php
/* Foto Test cases generated on: 2011-05-05 23:00:09 : 1304647209*/
App::import('Model', 'Foto');

class FotoTestCase extends CakeTestCase {
	var $fixtures = array('app.foto', 'app.produto');

	function startTest() {
		$this->Foto =& ClassRegistry::init('Foto');
	}

	function endTest() {
		unset($this->Foto);
		ClassRegistry::flush();
	}

}
?>