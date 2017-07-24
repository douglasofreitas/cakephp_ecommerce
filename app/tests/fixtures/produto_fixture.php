<?php
/* Produto Fixture generated on: 2011-05-05 23:01:13 : 1304647273 */
class ProdutoFixture extends CakeTestFixture {
	var $name = 'Produto';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'subcategoria_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'nome' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descricao' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'quantidade' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'img' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'img_mini' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'moeda_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'valor' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'promocao' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'desconto' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_produto_categoria1' => array('column' => 'subcategoria_id', 'unique' => 0), 'fk_produtos_moedas1' => array('column' => 'moeda_id', 'unique' => 0), 'fk_produtos_users1' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'subcategoria_id' => 1,
			'nome' => 'Lorem ipsum dolor sit amet',
			'descricao' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'quantidade' => 1,
			'img' => 'Lorem ipsum dolor sit amet',
			'img_mini' => 'Lorem ipsum dolor sit amet',
			'moeda_id' => 1,
			'valor' => 1,
			'promocao' => 1,
			'desconto' => 1,
			'user_id' => 1,
			'created' => '2011-05-05 23:01:13',
			'modified' => '2011-05-05 23:01:13'
		),
	);
}
?>