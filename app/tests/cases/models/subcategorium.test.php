<?php
/* Subcategorium Test cases generated on: 2011-05-05 23:01:35 : 1304647295*/
App::import('Model', 'Subcategorium');

class SubcategoriumTestCase extends CakeTestCase {
	function startTest() {
		$this->Subcategorium =& ClassRegistry::init('Subcategorium');
	}

	function endTest() {
		unset($this->Subcategorium);
		ClassRegistry::flush();
	}

}
?>