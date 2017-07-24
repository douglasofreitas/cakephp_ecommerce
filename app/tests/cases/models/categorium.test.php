<?php
/* Categorium Test cases generated on: 2011-05-05 22:59:40 : 1304647180*/
App::import('Model', 'Categorium');

class CategoriumTestCase extends CakeTestCase {
	function startTest() {
		$this->Categorium =& ClassRegistry::init('Categorium');
	}

	function endTest() {
		unset($this->Categorium);
		ClassRegistry::flush();
	}

}
?>