<?php
/* Evento Test cases generated on: 2011-05-05 22:59:57 : 1304647197*/
App::import('Model', 'Evento');

class EventoTestCase extends CakeTestCase {
	var $fixtures = array('app.evento', 'app.user');

	function startTest() {
		$this->Evento =& ClassRegistry::init('Evento');
	}

	function endTest() {
		unset($this->Evento);
		ClassRegistry::flush();
	}

}
?>