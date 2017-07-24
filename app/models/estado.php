<?php
class Estado extends AppModel {
	var $name = 'Estado';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $order = array("Estado.nome" => "asc");
	var $primaryKey = 'estado_id';
	var $hasMany = array(
		'Cidade' => array(
			'className' => 'Cidade',
			'foreignKey' => 'estado_id',
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
	function getFormSelect(){
		$estados = $this->find('all', array('conditions' => array(),
											 'recursive' => '-1'));
		$select_estados = array();
		foreach($estados as $e){
			$select_estados[$e['Estado']['estado_id']] = $e['Estado']['nome'];
		}
		return $select_estados;
	}
}
?>