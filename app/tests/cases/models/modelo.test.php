<?php
/* Modelo Test cases generated on: 2011-05-05 23:00:49 : 1304647249*/
App::import('Model', 'Modelo');

class ModeloTestCase extends CakeTestCase {
	var $fixtures = array('app.modelo', 'app.produto');

	function startTest() {
		$this->Modelo =& ClassRegistry::init('Modelo');
	}

	function endTest() {
		unset($this->Modelo);
		ClassRegistry::flush();
	}

}
?>