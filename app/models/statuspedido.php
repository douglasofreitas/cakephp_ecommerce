<?php
class Statuspedido extends AppModel {
	var $name = 'Statuspedido';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'statuspedido_id',
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
		$statuspedido = $this->find('all', array('conditions' => array(), 'recursive' => '-1'));
		$select_statuspedido = array();
		foreach($statuspedido as $status){
			$select_statuspedido[$status['Statuspedido']['id']] = $status['Statuspedido']['nome'];
		}
		return $select_statuspedido;
	}
}
?>