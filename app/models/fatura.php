<?php
class Fatura extends AppModel {
	var $name = 'Fatura';
	var $validate = array(
		'pedido_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'statusfatura_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'moeda_id' => array(
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
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'pedido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Statusfatura' => array(
			'className' => 'Statusfatura',
			'foreignKey' => 'statusfatura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Moeda' => array(
			'className' => 'Moeda',
			'foreignKey' => 'moeda_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'Infopagamento' => array(
			'className' => 'Infopagamento',
			'foreignKey' => 'fatura_id',
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
		'Pagamento' => array(
			'className' => 'Pagamento',
			'foreignKey' => 'fatura_id',
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
		'Faturahistorico' => array(
			'className' => 'Faturahistorico',
			'foreignKey' => 'fatura_id',
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
                'Pagsegurotransacao' => array(
			'className' => 'Pagsegurotransacao',
			'foreignKey' => 'fatura_id',
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
        function criar_fatura($pedido_id, $valor_total){
            $fatura = array();
            $fatura['Fatura']['pedido_id'] = $pedido_id;
            $fatura['Fatura']['valor'] = $valor_total;
            $fatura['Fatura']['statusfatura_id'] = 7;
            $fatura['Fatura']['moeda_id'] = 1;
            $fatura['Fatura']['ativo'] = 1;
            $this->save($fatura);
            $id = $this->getInsertId();
            $this->Faturahistorico->create();
            $this->Faturahistorico->grava_historico($id);
        }
	function atualiza_status_cielo($fatura, $cielo){
		$fatura['Fatura']['statusfatura_id'] = $cielo['Transacao']['status'];
		$this->save($fatura);
		$pedido_id = $fatura['Fatura']['pedido_id'];
		$atualiza_pedido = false;
		$this->Pedido->create();
		$pedido = $this->Pedido->read(null, $pedido_id); 
		//verificar necessidade de atualizar o status do pedido
		if($cielo['Transacao']['status'] == 4){
			//autorizado
			$pedido['Pedido']['statuspedido_id'] = 6;
			$atualiza_pedido = true;
		}elseif($cielo['Transacao']['status'] == 5){
			//não-autorizado
			$pedido['Pedido']['statuspedido_id'] = 6;
			$atualiza_pedido = true;
		}elseif($cielo['Transacao']['status'] == 6){
			//não-autorizado
			$pedido['Pedido']['statuspedido_id'] = 3;
			$atualiza_pedido = true;
		}
		if($atualiza_pedido){
			$this->Pedido->save($pedido);
		}
	}
}
?>