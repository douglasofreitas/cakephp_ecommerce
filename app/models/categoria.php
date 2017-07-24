<?php
class Categoria extends AppModel {
	var $name = 'Categoria';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $order = array("Categoria.nome" => "asc");
	var $validate = array(
		'nome' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'allowEmpty' => false,
				'required' => true,
				'message' => 'Campo obrigatório!',
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	var $hasMany = array(
		'Subcategoria' => array(
			'className' => 'Subcategoria',
			'foreignKey' => 'categoria_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Subcategoria.nome ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
?>