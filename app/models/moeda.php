<?php
class Moeda extends AppModel {
	var $name = 'Moeda';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Fatura' => array(
			'className' => 'Fatura',
			'foreignKey' => 'moeda_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Produto' => array(
			'className' => 'Produto',
			'foreignKey' => 'moeda_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
?>