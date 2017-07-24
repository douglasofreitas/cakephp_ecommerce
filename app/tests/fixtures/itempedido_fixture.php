<?php
/* Itempedido Fixture generated on: 2011-05-05 23:00:38 : 1304647238 */
class ItempedidoFixture extends CakeTestFixture {
	var $name = 'Itempedido';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'produto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'pedido_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'quantidade' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'valor_unitario' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'desconto' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'comprado' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_item_carrinho_pessoa1' => array('column' => 'user_id', 'unique' => 0), 'fk_item_carrinho_produto1' => array('column' => 'produto_id', 'unique' => 0), 'fk_item_carrinhos_carrinho1' => array('column' => 'pedido_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'produto_id' => 1,
			'pedido_id' => 1,
			'quantidade' => 1,
			'valor_unitario' => 1,
			'desconto' => 1,
			'comprado' => 1,
			'user_id' => 1,
			'created' => '2011-05-05 23:00:38',
			'modified' => '2011-05-05 23:00:38'
		),
	);
}
?>