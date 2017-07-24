<?php
class Produto extends AppModel {
	var $name = 'Produto';
        var $order = array("Produto.modified" => "desc");
	var $validate = array(
		'subcategoria_id' => array(
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
		'user_id' => array(
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
		'Subcategoria' => array(
			'className' => 'Subcategoria',
			'foreignKey' => 'subcategoria_id',
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
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Marca' => array(
			'className' => 'Marca',
			'foreignKey' => 'marca_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Modelo' => array(
			'className' => 'modelo',
			'foreignKey' => 'modelo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'Comentario' => array(
			'className' => 'Comentario',
			'foreignKey' => 'produto_id',
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
		'Foto' => array(
			'className' => 'Foto',
			'foreignKey' => 'produto_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Foto.id ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Itempedido' => array(
			'className' => 'Itempedido',
			'foreignKey' => 'produto_id',
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
		'Cor' => array(
			'className' => 'Cor',
			'foreignKey' => 'produto_id',
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
               'Tamanho' => array(
			'className' => 'Tamanho',
			'foreignKey' => 'produto_id',
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
                'ProdutoQuantidade' => array(
			'className' => 'ProdutoQuantidade',
			'foreignKey' => 'produto_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'tamanho_id',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
                'Produtohistorico' => array(
			'className' => 'Produtohistorico',
			'foreignKey' => 'produto_id',
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
        function retiraEstoque($id, $num_items, $prod_quant_id = null){
            if(empty($prod_quant_id)){
                //atualiza a quantidade na entidade Produto
                $produto = $this->read(null, $id); 
                $produto['Produto']['quantidade'] = $produto['Produto']['quantidade'] - intval($num_items);
                $this->Produtohistorico->grava_historico($id);
                $this->create();
                if($this->save($produto))
                    return true;
                else
                    return false;
            }else{
                //atualiza a quantidade na entidade ProdutoQuantidade
                $produtoquantidade = $this->ProdutoQuantidade->read(null, $prod_quant_id); 
                $produtoquantidade['ProdutoQuantidade']['quantidade'] = $produtoquantidade['ProdutoQuantidade']['quantidade'] - intval($num_items);
                $this->ProdutoQuantidade->create();
                if($this->ProdutoQuantidade->save($produtoquantidade))
                    return true;
                else
                    return false;
            }

            //verificar se ha estoque do produto, pois de não houver não pode ficar ativo
            $produto = $this->read(null, $id);
            if(count($produto['ProdutoQuantidade']) > 0){
                $soma = 0;
                foreach($produto['ProdutoQuantidade'] as $quantidade){
                    $soma += intval($quantidade['quantidade']);
                }
                if($soma == 0){
                    //desativar o produto
                    $produto['Produto']['ativo'] = 0;
                    $this->create();
                    $this->save($produto);
                }
            }


        }
        function colocaEstoque($id, $num_items, $prod_quant_id = null){
            if(empty($prod_quant_id)){
                $produto = $this->read(null, $id); 
                $produto['Produto']['quantidade'] = $produto['Produto']['quantidade'] + intval($num_items);
                $this->Produtohistorico->grava_historico($id);
                $this->create();
                if($this->save($produto))
                    return true;
                else
                    return false;
            }else{
                //atualiza a quantidade na entidade ProdutoQuantidade
                $produtoquantidade = $this->ProdutoQuantidade->read(null, $prod_quant_id); 
                $produtoquantidade['ProdutoQuantidade']['quantidade'] = $produtoquantidade['ProdutoQuantidade']['quantidade'] + intval($num_items);
                $this->ProdutoQuantidade->create();
                if($this->ProdutoQuantidade->save($produtoquantidade))
                    return true;
                else
                    return false;
            }
        }
        function tem_estoque($id, $cor_id, $tamanho_id){
            $produtoquantidade_id = null;
            $produto = $this->find('first', array('conditions' => array('Produto.id' => $id), 
                                                  'recursive' => '1'));
            foreach($produto['ProdutoQuantidade'] as $prod_quant){
                if($prod_quant['cor_id'] == $cor_id)
                    if($prod_quant['tamanho_id'] == $tamanho_id)
                        if($prod_quant['quantidade'] > 0){
                            $produtoquantidade_id = $prod_quant['id'];
                        }
            }
            return $produtoquantidade_id;
        }

    function desativaProdutoVazio($id){
        $produto = $this->read(null, $id);
        $soma = intval($produto['Produto']['quantidade']);
        foreach($produto['ProdutoQuantidade'] as $prod_quant){
            $soma += $prod_quant['quantidade'];
        }

        if($soma == 0){
            $produto['Produto']['ativo'] = 0;
            $this->create();
            if($this->save($produto))
                return true;
            else
                return false;
        }else{
            return true;
        }
    }
    function ativaProduto($id){
        $produto = $this->read(null, $id);
        $produto['Produto']['ativo'] = 1;
        $this->create();
        if($this->save($produto))
            return true;
        else
            return false;

    }

        function countProdutosAtivos($condition = array()){
            $condition['Produto.ativo'] = 1;
            $produtos_ativos = $this->find('count', array('conditions' => $condition, 
                                                  'recursive' => '1'));
            return $produtos_ativos;
        }
	function beforeSave($options) {
		if (!empty($this->data['Produto']['valor_form'])) {
	    		$this->data['Produto']['valor'] = $this->valorFormatBeforeSave($this->data['Produto']['valor_form']);
		}
                if (!empty($this->data['Produto']['valor_custo_form'])) {
	    		$this->data['Produto']['valor_custo'] = $this->valorFormatBeforeSave($this->data['Produto']['valor_custo_form']);
		}
		if (!empty($this->data['Produto']['peso_form'])) {
	    		$this->data['Produto']['peso'] = $this->valorFormatBeforeSave($this->data['Produto']['peso_form']);
		}
		return true;
	}
	function valorFormatBeforeSave($valor) {
		return str_replace(',', '.', $valor);
	}	
	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (!empty($val['Produto']['valor'])) {
				$results[$key]['Produto']['valor_form'] = $this->valorFormatAfterFind($val['Produto']['valor']);
			}
                        if (!empty($val['Produto']['valor_custo'])) {
				$results[$key]['Produto']['valor_custo_form'] = $this->valorFormatAfterFind($val['Produto']['valor_custo']);
			}
			if (!empty($val['Produto']['peso'])) {
				$results[$key]['Produto']['peso_form'] = $this->pesoFormatAfterFind($val['Produto']['peso']);
			}
		}
		return $results;
	}
        function pesoFormatAfterFind($valor) {
		return number_format($valor, 3, ',', '.');
	}
	function valorFormatAfterFind($valor) {
		return number_format($valor, 2, ',', '.');
	}
}
?>