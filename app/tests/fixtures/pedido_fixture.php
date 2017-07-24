<?php
/* Pedido Fixture generated on: 2011-05-05 23:01:08 : 1304647268 */
class PedidoFixture extends CakeTestFixture {
	var $name = 'Pedido';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'statuspedido_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'num_cartao' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'num_cartao_cod_seg' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_pedidos_status_pedidos1' => array('column' => 'statuspedido_id', 'unique' => 0), 'fk_pedidos_users1' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'statuspedido_id' => 1,
			'num_cartao' => 'Lorem ipsum dolor ',
			'num_cartao_cod_seg' => 'Lor',
			'created' => '2011-05-05 23:01:08',
			'modified' => '2011-05-05 23:01:08',
			'user_id' => 1
		),
	);
}
?>