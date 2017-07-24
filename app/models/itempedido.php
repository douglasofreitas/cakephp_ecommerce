<?php
class Itempedido extends AppModel {
	var $name = 'Itempedido';
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
		'pedido_id' => array(
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
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'pedido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	function cria_item($pedido, $produto, $produtoquantidade_id){
		//verifica se o produto ja esta no pedido
		if(!empty($pedido['Itempedido']))
			foreach($pedido['Itempedido'] as $item){
				if($item['produto_id'] == $produto['Produto']['id']){
					return false;
				}
			}
                $item = array();
		$item['Itempedido']['pedido_id'] = $pedido['Pedido']['id'];
		$item['Itempedido']['produto_id'] = $produto['Produto']['id'];
		$item['Itempedido']['produtoquantidade_id'] = $produtoquantidade_id;
                $item['Itempedido']['quantidade'] = 1;
		if($produto['Produto']['promocao'] == 1){
                        $item['Itempedido']['desconto'] = $produto['Produto']['desconto'];
			$item['Itempedido']['valor_total'] = $produto['Produto']['valor']*(100-$produto['Produto']['desconto'])/100;
                        $item['Itempedido']['valor_unitario'] = $produto['Produto']['valor']*(100-$produto['Produto']['desconto'])/100;
		} else {
                        $item['Itempedido']['desconto'] = 0;
			$item['Itempedido']['valor_total'] = $produto['Produto']['valor'];
                        $item['Itempedido']['valor_unitario'] = $produto['Produto']['valor'];
		}
		$item['Itempedido']['valor_total_form'] = number_format($item['Itempedido']['valor_total'],2, ',', '.');
                $item['Itempedido']['valor_unitario_form'] = number_format($item['Itempedido']['valor_unitario'],2, ',', '.');
                if($this->save($item)){
                    //apaga o valor do frete do produto
                    $pedido = $this->Pedido->read(null, $pedido['Pedido']['id']);
                    $pedido['Pedido']['frete'] = null;
                    $pedido['Pedido']['frete_form'] = null;
                    $this->Pedido->save($pedido);  
                    return $item;
                }else{
                    return false;
                }
	}
        function atualiza_quantidade($id, $quantidade){
            $quantidade_possivel = 0;
            $itempedido = $this->read(null, $id);
            $produtoquantidade = $this->Produto->ProdutoQuantidade->read(null, $itempedido['Itempedido']['produtoquantidade_id']);
            if($produtoquantidade['ProdutoQuantidade']['quantidade'] < $quantidade){
                if($quantidade > $itempedido['Itempedido']['quantidade'])
                    $quantidade_possivel = $produtoquantidade['ProdutoQuantidade']['quantidade'];
            }else{
                $quantidade_possivel = $quantidade;
            }
            if(!empty($quantidade_possivel)){
                //salvar nova quantidade
                $itempedido['Itempedido']['quantidade'] = $quantidade_possivel;
                $this->save($itempedido);
                //atualizar pedido na sessão, apagando o frete
                $pedido = $this->Pedido->read(null, $itempedido['Itempedido']['pedido_id']);
                $pedido['Pedido']['frete'] = null;
                $pedido['Pedido']['frete_form'] = null;
                $this->Pedido->save($pedido);
            }
            return $quantidade_possivel;
        }
	function remove_item($pedido, $produto_id){
		$nova_lista = array();
		$pedido_removido = false;
		if(!empty($pedido['Itempedido']))
			foreach($pedido['Itempedido'] as $item){
				if($item['produto_id'] == $produto_id){
					//remove item
                                        if($this->delete($item['id'])){
                                            //apaga o valor do frete do produto
                                            $pedido = $this->Pedido->read(null, $pedido['Pedido']['id']);
                                            $pedido['Pedido']['frete'] = null;
                                            $pedido['Pedido']['frete_form'] = null;
                                            $this->Pedido->save($pedido);
                                            return true;
                                        }else{
                                            return false;
                                        }
				}
			}
                return false;
	}
	function afterFind($results) {
		foreach ($results as $key => $val) {
			//calcula o valor total do item
                        if(!empty($val['Itempedido']['valor_unitario'])){
                            $results[$key]['Itempedido']['valor_total'] = ($val['Itempedido']['valor_unitario'])*$val['Itempedido']['quantidade'];
                            $results[$key]['Itempedido']['valor_total_form'] = number_format($results[$key]['Itempedido']['valor_total'], 2, ',', '');
                            $results[$key]['Itempedido']['valor_unitario_form'] = number_format($val['Itempedido']['valor_unitario'], 2, ',', '');
                        }else{
                            $results[$key]['Itempedido']['valor_unitario_form'] = '0,00';
                            $results[$key]['Itempedido']['valor_total'] = '0,00';
                            $results[$key]['Itempedido']['valor_total_form'] = '0,00';
                        }
		}
		return $results;
	}
}
?>