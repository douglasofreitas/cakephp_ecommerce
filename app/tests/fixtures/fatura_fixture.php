<?php
/* Fatura Fixture generated on: 2011-05-05 23:00:03 : 1304647203 */
class FaturaFixture extends CakeTestFixture {
	var $name = 'Fatura';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'pedido_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'statusfatura_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'valor' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'moeda_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_faturas_pedidos1' => array('column' => 'pedido_id', 'unique' => 0), 'fk_faturas_status_faturas1' => array('column' => 'statusfatura_id', 'unique' => 0), 'fk_faturas_moedas1' => array('column' => 'moeda_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'pedido_id' => 1,
			'statusfatura_id' => 1,
			'valor' => 1,
			'moeda_id' => 1,
			'created' => '2011-05-05 23:00:03',
			'modified' => '2011-05-05 23:00:03'
		),
	);
}
?>