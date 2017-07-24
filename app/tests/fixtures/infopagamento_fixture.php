<?php
/* Infopagamento Fixture generated on: 2011-05-05 23:00:22 : 1304647222 */
class InfopagamentoFixture extends CakeTestFixture {
	var $name = 'Infopagamento';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nome_arquivo' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'fatura_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_info_pagamentos_users1' => array('column' => 'user_id', 'unique' => 0), 'fk_info_pagamentos_faturas1' => array('column' => 'fatura_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'nome_arquivo' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'fatura_id' => 1,
			'created' => '2011-05-05 23:00:22',
			'modified' => '2011-05-05 23:00:22'
		),
	);
}
?>