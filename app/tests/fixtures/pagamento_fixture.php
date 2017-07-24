<?php
/* Pagamento Fixture generated on: 2011-05-05 23:01:03 : 1304647263 */
class PagamentoFixture extends CakeTestFixture {
	var $name = 'Pagamento';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'valor' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'fatura_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_pagamentos_faturas1' => array('column' => 'fatura_id', 'unique' => 0), 'fk_pagamentos_users1' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'valor' => 1,
			'created' => '2011-05-05 23:01:03',
			'modified' => '2011-05-05 23:01:03',
			'fatura_id' => 1,
			'user_id' => 1
		),
	);
}
?>