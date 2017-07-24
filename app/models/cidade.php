<?php
class Cidade extends AppModel {
	var $name = 'Cidade';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $order = array("Cidade.nome" => "asc");
	var $recursive = 0;
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
	var $belongsTo = array(
		'Estado' => array(
			'className' => 'Estado',
			'foreignKey' => 'estado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'cidade_id',
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
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'cidade_id',
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
	function getFormSelect($estado_id = null){
		$select_cidades = array();
		if(empty($estado_id)){
			$conditions = array();
                        return $select_cidades;
                }
		else
			$conditions = array('Cidade.estado_id' => $estado_id);
		$cidades = $this->find('all', array('conditions' => $conditions,
											 'recursive' => '0'));
		foreach($cidades as $c){
			$select_cidades[$c['Cidade']['id']] = $c['Cidade']['nome'];
		}
		return $select_cidades;
	}
        function getNome($id){
            $cidade = $this->find('first', array('conditions' => array('Cidade.id' => $id), 'recursive' => '0'));
            return $cidade['Cidade']['nome'];
        }
        function getEstadoSigla($id){
            $cidade = $this->find('first', array('conditions' => array('Cidade.id' => $id), 'recursive' => '0'));
            return $cidade['Cidade']['estado_id'];
        }
}
?>