<?php
class Cor extends AppModel {
	var $name = 'Cor';
	var $validate = array(
		'produto_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Produto' => array(
			'className' => 'Produto',
			'foreignKey' => 'produto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        var $hasMany = array(
                'ProdutoQuantidade' => array(
			'className' => 'ProdutoQuantidade',
			'foreignKey' => 'cor_id',
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
        );
        function getLista($id)
	{
                $array_objeto = array();
		$cors = $this->find('all', array('conditions' => array('produto_id' => $id), 'recursive' => -1 ));
		foreach($cors as $c){
			$array_objeto[$c['Cor']['id']] = $c['Cor'];
		}
		return $array_objeto;
	}
}
?>