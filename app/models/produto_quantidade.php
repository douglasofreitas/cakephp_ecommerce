<?php
class ProdutoQuantidade extends AppModel {
	var $name = 'ProdutoQuantidade';
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
                'cor_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
                'tamanho_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Produto' => array(
			'className' => 'Produto',
			'foreignKey' => 'produto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'Cor' => array(
			'className' => 'Cor',
			'foreignKey' => 'cor_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Cor.nome'
		), 
                'Tamanho' => array(
			'className' => 'Tamanho',
			'foreignKey' => 'tamanho_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Tamanho.nome'
		)
	);
        function verifica_save($produtoquantidade){
            //verifica se ja possui a quantidade cadastrada
            if(!empty($produtoquantidade['ProdutoQuantidade']['cor_id'])){
                //considerar a cor
                $pq = $this->find('first', array('conditions' => array('produto_id' => $produtoquantidade['ProdutoQuantidade']['produto_id'],
                                                                     'tamanho_id' => $produtoquantidade['ProdutoQuantidade']['tamanho_id'],
                                                                     'cor_id' => $produtoquantidade['ProdutoQuantidade']['cor_id']), 'recursive' => '-1'));
            }else{
                //não considerar a cor
                $pq = $this->find('first', array('conditions' => array('produto_id' => $produtoquantidade['ProdutoQuantidade']['produto_id'],
                                                                     'tamanho_id' => $produtoquantidade['ProdutoQuantidade']['tamanho_id']), 'recursive' => '-1'));
            }
            if(empty($pq)){
                $this->save($produtoquantidade);
            }else{
                $pq['ProdutoQuantidade']['quantidade'] = $produtoquantidade['ProdutoQuantidade']['quantidade'];
                $this->save($pq);
            }
        }
        function beforeSave($options) {
		if (!empty($this->data['ProdutoQuantidade']['quantidade'])) {
	    		$this->data['ProdutoQuantidade']['quantidade'] = $this->intFormatBeforeSave($this->data['ProdutoQuantidade']['quantidade']);
		}
		return true;
	}
	function intFormatBeforeSave($valor) {
            $valor = intval($valor);
            if(empty($valor)) $valor = 0;
            if($valor < 0) $valor = 0;
            return $valor;
	}	
}
?>