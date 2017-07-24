<?php
class Pedido extends AppModel {
	var $name = 'Pedido';
        var $order = array("Pedido.id" => "desc");
	var $validate = array(
		'statuspedido_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Statuspedido' => array(
			'className' => 'Statuspedido',
			'foreignKey' => 'statuspedido_id',
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
		'Cidade' => array(
			'className' => 'Cidade',
			'foreignKey' => 'cidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'Fatura' => array(
			'className' => 'Fatura',
			'foreignKey' => 'pedido_id',
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
		'Itempedido' => array(
			'className' => 'Itempedido',
			'foreignKey' => 'pedido_id',
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
                'Pedidohistorico' => array(
			'className' => 'Pedidohistorico',
			'foreignKey' => 'pedido_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Pedidohistorico.created DESC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
                'Pagsegurotransacao' => array(
			'className' => 'Pagsegurotransacao',
			'foreignKey' => 'pedido_id',
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
        function is_owner($pedido_id, $user_id){
            $pedido = $this->find('first', array('conditions' => array('Pedido.id' => $pedido_id, 'Pedido.user_id' => $user_id), 
											'recursive' => '-1'));
            if(!empty($pedido['Pedido']))
                return true;
            else
                return false;
        }
        function saveTotal($id){
            $pedido = $this->read(null, $id);
            $valor_total = $pedido['Pedido']['frete'];
            foreach($pedido['Itempedido'] as $item){
                $valor_total += $item['valor_total'];
            }
            $pedido['Pedido']['valor_total'] = $valor_total;
            $this->save($pedido);
            $this->Fatura->criar_fatura($id, $valor_total);
            return $pedido;
        }
	/*
	 * Instancia um novo pedido temporário para o cliente
	 */
	function cria_novo_pedido(){
		$pedido = array();
                $pedido['Pedido']['statuspedido_id'] = 1;
                if($this->save($pedido)){
                    $id = $this->getInsertId();
                    $this->Pedidohistorico->create();
                    $this->Pedidohistorico->grava_historico($id);
                    $pedido = $this->read(null, $id);
                    return $pedido;
                }else{
                    return false;
                }
	}
	function obtemValorTotal($id){
                $pedido = $this->find('first', array('conditions' => array('Pedido.id' => $id), 'recursive' => '1'));
		$valor_total = $pedido['Pedido']['frete'];
                $i = 0;
		foreach($pedido['Itempedido'] as $item){
			$valor_total += $item['valor_unitario']*$item['quantidade']; 
		}
		return $valor_total;
	}
        //Não utilizado mais
        /*
	function gravar_pedido($pedido, $user_id){
		//echo 'Gravar pedido<br>';
		if(empty($pedido['Pedido']['id'])){
			//echo 'Gravação iniciada<br>';
			$pedido['Pedido']['statuspedido_id'] = 1;
			if(count($pedido['item'])>0){
				$pedido_array = array();
				$pedido_array['Pedido']['statuspedido_id'] = 1;
				$pedido_array['Pedido']['nome'] = $pedido['Pedido']['nome'];
				$pedido_array['Pedido']['frete'] = $pedido['Pedido']['frete'];
				$pedido_array['Pedido']['cep'] = $pedido['Pedido']['cep'];
				$pedido_array['Pedido']['endereco'] = $pedido['Pedido']['endereco'];
				$pedido_array['Pedido']['numero'] = $pedido['Pedido']['numero'];
				$pedido_array['Pedido']['complemento']  = $pedido['Pedido']['complemento'];
				$pedido_array['Pedido']['bairro'] = $pedido['Pedido']['bairro'];
				$pedido_array['Pedido']['cidade_id'] = $pedido['Pedido']['cidade_id'];
                                $pedido_array['Pedido']['tipo_correio'] = $pedido['Pedido']['tipo_correio'];
				$pedido_array['Pedido']['user_id'] = $user_id;
				//echo 'Contagem maior que 0<br>';
				$this->create();
				//echo '<pre>';
				//print_r($pedido);
				//print_r($pedido_array);
				//echo '</pre>';
				$this->save($pedido_array);
				$pedido_id = $this->getInsertId();
				$pedido['Pedido']['id'] = $pedido_id;
				//echo 'Contagem maior que 0<br>';
				//salvar cada item do pedido
				$valor_total = $pedido['Pedido']['frete'];
				foreach($pedido['item'] as $item){
					$item['Itempedido']['pedido_id'] = $pedido_id;					
					$this->Itempedido->create();
					$this->Itempedido->save($item);
					$valor_total += $item['Itempedido']['valor_total'];  
				}
				//criar fatura do pedido
				$fatura_array = array();
				$fatura_array['pedido_id'] = $pedido_id;
				$fatura_array['statusfatura_id'] = 7;
				$fatura_array['moeda_id'] = 1;
				$fatura_array['valor'] = $valor_total;
				$this->Fatura->create();
				$this->Fatura->save($fatura_array);
                                //atualiza valor do pedido
                                $pedido_new = $this->read(null, $pedido_id);
                                $pedido_new['Pedido']['valor_total'] = $valor_total;
                                $this->create();
				$this->save($pedido_new);
			}else{
				//não há pedidos
				return false;
			}
		}
		return $pedido;
	}
	*/
	function gravar_endereco($pedido, $endereco){
		//gravar o endereço do usuário
                if(!empty($endereco['nome']))
                    $pedido['Pedido']['nome'] = $endereco['nome']; 
                if(!empty($endereco['name']))
                    $pedido['Pedido']['nome'] = $endereco['name']; 
                if(!empty($endereco['endereco']))
                    $pedido['Pedido']['endereco'] = $endereco['endereco']; 
                if(!empty($endereco['numero']))
                    $pedido['Pedido']['numero'] = $endereco['numero'];
                if(!empty($endereco['complemento']))
                    $pedido['Pedido']['complemento'] = $endereco['complemento'];
                if(!empty($endereco['bairro']))
                    $pedido['Pedido']['bairro'] = $endereco['bairro'];
                if(!empty($endereco['cep']))
                    $pedido['Pedido']['cep'] = $endereco['cep'];
                if(!empty($endereco['cidade_id']))
                    $pedido['Pedido']['cidade_id'] = $endereco['cidade_id'];
		return $pedido;
	}
	function verifica_passo_1($pedido, $config_sistema){
		//verifica se tem itens no pedido
		if(empty($pedido['Itempedido']))
			return 'sem_produto';
		if(count($pedido['Itempedido']) == 0)
			return 'sem_produto';
		//verifica se foi calculado o frete
                if($config_sistema['Configuracao']['calcula_frete']){
                    if(empty($pedido['Pedido']['frete'])){
                            return 'sem_cep';
                    }
                }
		return 'ok';
	} 
	function verifica_passo_2($pedido, $config_sistema){
		//verifica se tem itens no pedido
		if($this->verifica_passo_1($pedido, $config_sistema) == 'ok'){
			if(empty($pedido['Pedido']['endereco']))
				return false;
			if(empty($pedido['Pedido']['numero']))
				return false;
			if(empty($pedido['Pedido']['bairro']))
				return false;
			if(empty($pedido['Pedido']['cidade_id']))
				return false;
		}else{
			return false;
		}
		return true;
	} 
        function atualizaStatusByFaturaPagseguro($id, $statusfatura_id){
            $pedido = $this->find('first', array('conditions' => array('Pedido.id' => $id), 
                                                    'recursive' => '-1'));
            $novo_status = $pedido['Pedido']['statuspedido_id'];
            if($statusfatura_id == 6)
                $novo_status = 7;
            if($statusfatura_id == 1)
                $novo_status = 2;
            if($statusfatura_id == 4)
                $novo_status = 6;
            if($statusfatura_id == 9)
                $novo_status = 4;
            $this->create();
            $pedido['Pedido']['statuspedido_id'] = $novo_status;
            
            $this->save($pedido);
            $this->Pedidohistorico->grava_historico($id);
            $this->atualiza_estoque($id);
            return $novo_status;
        }
        function obtemInfo($pedido){
            $info = '';
            $info = 'Código do pedido: '.$pedido['Pedido']['id'].'<br/>
                <br/>
                <table>
                    <tr>
                        <td style="min-width: 100px">Produto</td>
                        <td align="center">Quantidade</td>
                        <td align="center">Valor</td>
                    </tr>';
            $valor_total = $pedido['Pedido']['frete'];
            $i = 0;
            //obter os itens com os produtos
            $itens = $this->Itempedido->find('all', array('conditions' => array('Pedido.id' => $pedido['Pedido']['id']), 
                                    'recursive' => '1'));
            $produtos = array();
            foreach($itens as $item){
                $produto = $this->Itempedido->Produto->read(null, $item['Itempedido']['produto_id']);
                $produtos[$produto['Produto']['id']] = $produto;
            }   
            foreach($itens as $item){
                $info .= '<tr><td>';
                $info .= $item['Produto']['nome'];
                $modelo = '';
                if(!empty($item['Itempedido']['produtoquantidade_id'])){
                    //obter a cor e o tamanho do item do pedido, por enquanto esta longo
                    $cor_id = null;
                    $cor_nome = null;
                    $tamanho_id = null;
                    $tamanho_nome = null;
                    foreach($produtos[$item['Itempedido']['produto_id']]['ProdutoQuantidade'] as $prod_quant){
                        if($prod_quant['id'] == $item['Itempedido']['produtoquantidade_id']){
                            $cor_id = $prod_quant['cor_id'];
                            $tamanho_id = $prod_quant['tamanho_id'];
                        }
                    }
                    if(!empty($cor_id)){
                        foreach($produtos[$item['Itempedido']['produto_id']]['Cor'] as $cor){
                            if($cor_id == $cor['id']){
                                $cor_nome = $cor['nome'];
                            }
                        }
                        foreach($produtos[$item['Itempedido']['produto_id']]['Tamanho'] as $tamanho){
                            if($tamanho_id == $tamanho['id']){
                                $tamanho_nome = $tamanho['nome'];
                            }
                        }
                    }
                    if(!empty($cor_nome)){
                        $modelo = '<br/>Cor: '.$cor_nome.'<br/>Tamanho: '.$tamanho_nome.'';
                    }
                }
                $info .= ' '.$modelo;
                $info .= '</td><td>';
                $info .= $item['Itempedido']['quantidade'];
                $info .= '</td><td>R$ ';
                $info .= number_format($item['Itempedido']['valor_total'],2, ',', '.');
                $info .= '</td></tr>';
                $valor_total += $item['Itempedido']['valor_total']; 
            }
            $info .= '
                </table>
                    <br>
                    <table >
                        <tr >
                            <td width="100px">Frete</td>
                            <td>R$ '.number_format($pedido['Pedido']['frete'],2, ',', '.').'</td>
                        </tr>
                        <tr >
                            <td>Valor Total</td>
                            <td><strong>R$ '.number_format($valor_total,2, ',', '.').'</strong></td>
                        </tr>
                </table>';
            return $info;
        }
        function obtemEndereco($pedido){
            $endereco = '';
            $endereco = '
                <br/>
                <strong>Endereço de entrega:</strong><br/><br/>
                <strong>Cliente:</strong> '.$pedido['Pedido']['nome'].'
                <strong>Endereço:</strong> '.$pedido['Pedido']['endereco'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Número:</strong> '.$pedido['Pedido']['numero'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Complemento:</strong> '.$pedido['Pedido']['complemento'].' <br><br>
                <strong>CEP:</strong> '.$pedido['Pedido']['cep'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Bairro:</strong> '.$pedido['Pedido']['bairro'].' <br><br>
                <strong>Cidade:</strong> '.$pedido['Cidade']['nome'].' - '.$pedido['Cidade']['estado_id'].' <br>';
            return $endereco;
        }
        function atualiza_estoque($id, $desativa_produto_vazio = 0){
            $pedido = $this->read(null, $id);
            if($pedido['Pedido']['baixa_estoque'] == 0){
                //deve dar baixa no estoque se estiver nos seguintes status
                if($pedido['Pedido']['statuspedido_id'] == 2 ||
                        $pedido['Pedido']['statuspedido_id'] == 3 ||
                        $pedido['Pedido']['statuspedido_id'] == 7){
                    $this->retiraEstoque($pedido, $desativa_produto_vazio);
                    //salvar baixa do estoque
                    $pedido['Pedido']['baixa_estoque'] = 1;
                    $this->save($pedido);
                }
            }else{
                //devolver ao estoque caso esteja nos seguintes status
                if($pedido['Pedido']['statuspedido_id'] == 1 ||
                        $pedido['Pedido']['statuspedido_id'] == 4 ||
                        $pedido['Pedido']['statuspedido_id'] == 5 ||
                        $pedido['Pedido']['statuspedido_id'] == 6){
                    $this->colocaEstoque($pedido, $desativa_produto_vazio);
                    //salvar baixa do estoque
                    $pedido['Pedido']['baixa_estoque'] = 0;
                    $this->save($pedido);
                }
            }
        }
        function retiraEstoque($pedido, $desativa_produto_vazio = 0){
            //baixa_estoque
            if($pedido['Pedido']['baixa_estoque'] == 0)
                foreach($pedido['Itempedido'] as $itempedido){
                    $this->Itempedido->Produto->create();
                    if(!empty($itempedido['produtoquantidade_id'])){
                        $this->Itempedido->Produto->retiraEstoque($itempedido['produto_id'], $itempedido['quantidade'], $itempedido['produtoquantidade_id']);
                        if($desativa_produto_vazio){
                            $this->Itempedido->Produto->desativaProdutoVazio($itempedido['produto_id']);
                        }
                    }else{
                        $this->Itempedido->Produto->retiraEstoque($itempedido['produto_id'], $itempedido['quantidade']);
                        if($desativa_produto_vazio){
                            $this->Itempedido->Produto->desativaProdutoVazio($itempedido['produto_id']);
                        }
                    }
                }
        }
        function colocaEstoque($pedido, $desativa_produto_vazio = 0){
            if($pedido['Pedido']['baixa_estoque'] == 1)
                foreach($pedido['Itempedido'] as $itempedido){
                    $this->Itempedido->Produto->create();
                    if(!empty($itempedido['produtoquantidade_id'])){
                        $this->Itempedido->Produto->colocaEstoque($itempedido['produto_id'], $itempedido['quantidade'], $itempedido['produtoquantidade_id']);
                        if($desativa_produto_vazio){
                            $this->Itempedido->Produto->ativaProduto($itempedido['produto_id']);
                        }
                    }else{
                        $this->Itempedido->Produto->colocaEstoque($itempedido['produto_id'], $itempedido['quantidade']);
                        if($desativa_produto_vazio){
                            $this->Itempedido->Produto->ativaProduto($itempedido['produto_id']);
                        }
                    }
                }
        }
        function afterFind($results) {
		foreach ($results as $key => $val) {
                    //formata o valor total do item
                    if(!empty($val['Pedido']['valor_total']))
                        $results[$key]['Pedido']['valor_total_form'] = number_format($val['Pedido']['valor_total'], 2, ',', '');
                    else
                        $results[$key]['Pedido']['valor_total_form'] = '-----';
                    if(!empty($val['Pedido']['frete']))
                        $results[$key]['Pedido']['frete_form'] = number_format($val['Pedido']['frete'], 2, ',', '');
                    else
                        $results[$key]['Pedido']['frete_form'] = '0,00';
		}
		return $results;
	}
        function valorFormatBeforeSave($valor) {
		return str_replace(',', '.', $valor);
	}
        function valorFormatAfterFind($valor) {
		return number_format($valor, 2, ',', '.');
	}
        function beforeSave($options) {
		if (empty($this->data['Pedido']['cidade_id'])) {
	    		unset($this->data['Pedido']['cidade_id']);
		}
                if (empty($this->data['Pedido']['statuspedido_id'])) {
	    		unset($this->data['Pedido']['statuspedido_id']);
		}
                if (empty($this->data['Pedido']['user_id'])) {
	    		unset($this->data['Pedido']['user_id']);
		}
		return true;
	}
}
?>