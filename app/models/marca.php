<?php
class Marca extends AppModel {
	var $name = 'Marca';
//	var $validate = array(
//		'produto_id' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Produto' => array(
			'className' => 'Produto',
			'foreignKey' => 'marca_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>