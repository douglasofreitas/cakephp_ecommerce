<?php
/* Foto Fixture generated on: 2011-05-05 23:00:09 : 1304647209 */
class FotoFixture extends CakeTestFixture {
	var $name = 'Foto';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'produto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'nome' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'nome_img' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_fotos_produtos1' => array('column' => 'produto_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'produto_id' => 1,
			'nome' => 'Lorem ipsum dolor sit amet',
			'nome_img' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-05-05 23:00:09',
			'modified' => '2011-05-05 23:00:09'
		),
	);
}
?>