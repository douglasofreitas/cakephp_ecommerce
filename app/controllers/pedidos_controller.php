<?php
class PedidosController extends AppController {
	var $name = 'Pedidos';
	//var $components = array('Correio', 'CieloPedido');
        //var $uses = array('Pagseguronotification');
        var $paginate = array(
            'limit' => 10
        );
        var $helpers = array('pedidopack', 'produtopack');
	function index() {
                $this->Pedido->recursive = 1;
		//verifica se é admin, assim redireciona para a index_admin
		if($this->Auth->user('group_id') == 1){
			$this->redirect('/pedidos/index_admin');
		} 
		$this->set('content_title', 'Meus pedidos');
		//obter os pedidos do usuário
		$pedidos = $this->Pedido->find('all', array('conditions' => array('Pedido.user_id' => $this->Auth->user('id')), 
												'recursive' => '1'));
                foreach($pedidos as $key => $pedido){
                    $pedidos[$key]['Pedido']['valor_total'] = $this->Pedido->obtemValorTotal($pedido['Pedido']['id']);
                    $pedidos[$key]['Pedido']['valor_total_form'] = number_format($pedidos[$key]['Pedido']['valor_total'], 2, ',', '');
                }
		$this->set('pedidos', $pedidos);
	}
	function index_admin(){
		$this->set('content_title', 'Pedidos');
		$condicao = array("not" => array ( "Pedido.user_id" => null));
		$this->Pedido->recursive = 1;
		$this->set('pedidos', $this->paginate('Pedido', $condicao ));
	}
        function listar_pedidos_sem_user(){
		$this->set('content_title', 'Pedidos sem usuários associados');
		$condicao = array('Pedido.user_id' => null);
		$this->Pedido->recursive = 1;
		$this->set('pedidos', $this->paginate('Pedido', $condicao ));
                $this->render('index_admin');
	}
        //nesta visualização não há restrição de pedidos não associados a um cliente
        function index_root(){
		$this->set('content_title', 'Pedidos');
		$this->Pedido->recursive = 1;
		$this->set('pedidos', $this->paginate());
	}
	function view($id = null) {
		//se for admin, deve usar a visualização completa
		if($this->Auth->user('group_id') == 1){
			$this->redirect('/pedidos/view_admin/'.$id);
		}
		$this->set('content_title', 'Visualizar Pedido');
		if (!$id) {
			$this->Session->setFlash(__('Invalid pedido', true));
			$this->redirect(array('action' => 'index'));
		}
                //verifica se o pedido pertence ao usuário
                if(!$this->Pedido->is_owner($id, $this->Auth->user('id'))){
                    $this->redirect('/pedidos');
                }
		$this->Pedido->recursive = 1;
		$pedido = $this->Pedido->read(null, $id);
                $tipo_correio = $this->Correio->getNomeTipoPagamento($pedido['Pedido']['tipo_correio']);
		$itenspedido = $this->Pedido->Itempedido->find('all', array('conditions' => array('Itempedido.pedido_id' => $id), 
                                                                                                'recursive' => '1'));
		$fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $id), 
												'recursive' => '0'));
		$estado = $this->Pedido->Cidade->Estado->read(null, $pedido['Cidade']['estado_id']);
                $produtos = array();
                foreach($pedido['Itempedido'] as $item){
                    $produto = $this->Pedido->Itempedido->Produto->read(null, $item['produto_id']);
                    $produtos[$produto['Produto']['id']] = $produto;
                }   
		$this->set('pedido', $pedido);
		$this->set('fatura', $fatura);
		$this->set('estado', $estado);
                $this->set('tipo_correio', $tipo_correio);
                $this->set('produtos', $produtos);
		$this->set('itenspedido', $itenspedido);
	}
	function view_admin($id = null) {
		$this->set('content_title', 'Visualizar Pedido');
		if (!$id) {
			$this->Session->setFlash(__('Invalid pedido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Pedido->recursive = 0;
		$pedido = $this->Pedido->find('first', array('conditions' => array('Pedido.id' => $id), 
												'recursive' => '1'));
		$itenspedido = $this->Pedido->Itempedido->find('all', array('conditions' => array('Itempedido.pedido_id' => $id), 
												'recursive' => '1'));
		$fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $id), 
												'recursive' => '0'));
		$estado = $this->Pedido->Cidade->Estado->read(null, $pedido['Cidade']['estado_id']);
                $tipo_correio = $this->Correio->getNomeTipoPagamento($pedido['Pedido']['tipo_correio']);
                $select_statuspedido = $this->Pedido->Statuspedido->getFormSelect();
                $select_statusfatura = $this->Pedido->Fatura->Statusfatura->getFormSelect();
                foreach($pedido['Itempedido'] as $item){
                    $produto = $this->Pedido->Itempedido->Produto->read(null, $item['produto_id']);
                    $produtos[$produto['Produto']['id']] = $produto;
                }   
                $this->set(compact('pedido', 'fatura', 'estado', 'tipo_correio', 'itenspedido', 'select_statuspedido', 'select_statusfatura', 'produtos'));
	}
        function view_root($id = null) {
		$this->set('content_title', 'Visualizar Pedido');
		if (!$id) {
			$this->Session->setFlash(__('Invalid pedido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Pedido->recursive = 0;
		$pedido = $this->Pedido->find('first', array('conditions' => array('Pedido.id' => $id), 
												'recursive' => '1'));
		$itenspedido = $this->Pedido->Itempedido->find('all', array('conditions' => array('Itempedido.pedido_id' => $id), 
												'recursive' => '1'));
		$fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $id), 
												'recursive' => '0'));
		$estado = $this->Pedido->Cidade->Estado->read(null, $pedido['Cidade']['estado_id']);
                $tipo_correio = $this->Correio->getNomeTipoPagamento($pedido['Pedido']['tipo_correio']);
                $select_statuspedido = $this->Pedido->Statuspedido->getFormSelect();
                $select_statusfatura = $this->Pedido->Fatura->Statusfatura->getFormSelect();
                $this->set(compact('pedido', 'fatura', 'estado', 'tipo_correio', 'itenspedido', 'select_statuspedido', 'select_statusfatura'));
	}
	function criar_pedido($id_user = null) {
                $this->set('content_title', 'Cadastrar pedido');
		if (!empty($this->data)) {
			$this->Pedido->create();
			if ($this->Pedido->save($this->data)) {
                                $pedido_id = $this->Pedido->getInsertId();
                                $this->Pedido->Pedidohistorico->create();
                                $this->Pedido->Pedidohistorico->grava_historico($pedido_id);
				$this->Session->setFlash(__('The pedido has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pedido could not be saved. Please, try again.', true));
			}
		}
                $produtos = $this->Pedido->Itempedido->Produto->find('all');
                //obter lista de estados
		$select_estados = $this->Pedido->Cidade->Estado->getFormSelect();
                $user = $this->Pedido->User->read(null, $id_user);
		$this->set(compact('select_estados', 'produtos', 'id_user', 'user'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid pedido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pedido->save($this->data)) {
				$this->Session->setFlash(__('The pedido has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pedido could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pedido->read(null, $id);
		}
		$statuspedidos = $this->Pedido->Statuspedido->find('list');
		$users = $this->Pedido->User->find('list');
		$this->set(compact('statuspedidos', 'users'));
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pedido', true));
			$this->redirect(array('action'=>'index_root'));
		}
		if ($this->Pedido->delete($id)) {
			$this->Session->setFlash(__('Pedido deleted', true));
			$this->redirect(array('action'=>'index_root'));
		}
		$this->Session->setFlash(__('Pedido was not deleted', true));
		$this->redirect(array('action' => 'index_root'));
	}
	function calcular_frete_form(){
            $this->set('content_title', 'Calcular Frete');
            $correio = array();
            if(!empty($this->data)){
                $correio['cep_destino'] = $this->data['Correio']['cep_destino'];
                $correio['tipo_correio'] = $this->data['Correio']['tipo_correio'];
                $correio['peso'] = $this->data['Correio']['peso'];
                $correio['valor'] = $this->data['Correio']['valor'];
                $correio['comprimento'] = intval($this->data['Correio']['comprimento']);
                $correio['largura'] = intval($this->data['Correio']['largura']);
                $correio['altura'] = intval($this->data['Correio']['altura']);
//                print_r($correio);
//                die('');
                $correio_component = $this->Correio->getSedex($this->config_sistema['Configuracao']['cep'], $correio['cep_destino'], $correio['peso'], $correio['tipo_correio'],
                                        $correio['comprimento'], $correio['largura'], $correio['altura'], $correio['valor']);
                if(is_array($correio_component)){
                    $valor_frete = floatval(str_replace(',', '.', $correio_component['valor']));
                    $correio['frete'] = number_format($valor_frete, 2, ',', '');    
                }else{
                    $this->Session->setFlash(__('Erro ao calcular o frete. Tente novamente', true));
                }
            }
            if(empty($correio)){
                $correio['cep_destino'] = '';
                $correio['tipo_correio'] = '';
                $correio['peso'] = '';
                $correio['frete'] = 0;
                $correio['valor'] = 100;
            }
            $this->set('correio', $correio);
        }
        function calcular_frete_ajax($produto_id){
            $this->layout = null;
            $correio = array();
            $valor_frete = '0,00';
            $prazo_entrega = '';
            if(!empty($this->params['form'])){
                $correio['cep_destino'] = $this->params['form']['cep_destino'];
                $correio['tipo_correio'] = $this->params['form']['tipo_correio'];
                //obtem peso
                $produto = $this->Pedido->Itempedido->Produto->read(null, $produto_id);
                $correio['peso'] = $produto['Produto']['peso'];
                $correio_component = $this->Correio->getSedex($this->config_sistema['Configuracao']['cep'], $correio['cep_destino'], $correio['peso'], $correio['tipo_correio'],
                                       $produto['Produto']['medida_comprimento'], $produto['Produto']['medida_largura'], $produto['Produto']['medida_altura'], $produto['Produto']['valor']);



                if(is_array($correio_component)){
                    if($correio_component['erro'] == 99){
                        $valor_frete = '';
                        $this->set('erro', $correio_component['erro']);
                    }else{
                        $valor_frete = floatval(str_replace(',', '.', $correio_component['valor']));
                        $valor_frete = number_format($valor_frete, 2, ',', '');   
                        $prazo_entrega =  $correio_component['prazo_entrega'];
                    }
                }else{
                    $this->Session->setFlash(__('Erro ao calcular o frete. Tente novamente', true));
                }
            }

            if(empty($correio)){
                $correio['cep_destino'] = '';
                $correio['tipo_correio'] = '';
                $correio['peso'] = '';
                $correio['frete'] = 0;
                $this->set('erro', 99);
            }
            
            $this->set('prazo_entrega', $prazo_entrega);
            $this->set('valor_frete', $valor_frete);
        }
	function calcular_frete($notifica = '1'){
            //verifica se o cep esta no form
            $cep_destino = null;
            $tipo_correio = null;
            if(!empty($this->data)){
                $cep_destino = $this->data['Pedido']['cep'];
                $tipo_correio = $this->data['Pedido']['tipo_correio'];
            }else{
                if($this->Session->check('Pedido')){
                    $pedido = $this->Session->read('Pedido');
                    $cep_destino = $pedido['Pedido']['cep'];
                    $tipo_correio = $pedido['Pedido']['tipo_correio'];
                }
            }
            if(!empty($cep_destino)){
//                $cep_destino = $this->data['Pedido']['cep'];
//                $tipo_correio = $this->data['Pedido']['tipo_correio'];
                //obter o cep de origem
                $cep_origem = $this->config_sistema['Configuracao']['cep'];
                //fazer a soma dos pesos dos produtos
                $peso = 0.0;
                $comprimento = 0;
                $largura = 0;
                $altura = 0;
                $valor = 0;
                $array_produtos = array();
                $pedido = $this->Session->read('Pedido');
                if(count($pedido['Itempedido'])>0){
                        foreach ($pedido['Itempedido'] as $item){
                                $produto = $this->Pedido->Itempedido->Produto->read(null, $item['produto_id']);
                                $peso += $produto['Produto']['peso']*$item['quantidade'];
                                $valor += $produto['Produto']['valor']*$item['quantidade'];
                                if($produto['Produto']['medida_comprimento'] > $comprimento)
                                    $comprimento = $produto['Produto']['medida_comprimento'];
                                if($produto['Produto']['medida_largura'] > $largura)
                                    $largura = $produto['Produto']['medida_largura'];
                                $altura += $produto['Produto']['medida_altura']*$item['quantidade'];
                                $array_produtos[$item['produto_id']] = $item['quantidade'];
                        }
                }

                CakeLog::write('debug', 'PEDIDO CONTROLLER -- calcular_frete');
                CakeLog::write('debug', '$cep_origem, $cep_destino, $peso, $tipo_correio, $comprimento, $largura, $altura, $valor_declarado');
                CakeLog::write('debug', $cep_origem.' - '.$cep_destino.' - '.$peso.' - '.$tipo_correio.' - '.$comprimento.' - '.$largura.' - '.$altura.' - '.$valor);


                $correio = $this->Correio->getSedex($cep_origem, $cep_destino, $peso, $tipo_correio, $comprimento, $largura, $altura, $valor);
                if(is_array($correio)){
                        if($correio['erro'] == 99){
                            $this->Session->setFlash(__('Erro no serviço de frete dos correios. Tente novamente mais tarde', true));	
                        }else{
                            $valor_frete = floatval(str_replace(',', '.', $correio['valor']));
                            //verifica se o CEP possui desconto
                            $this->loadModel('CepFrete');
                            $valor_frete = $this->CepFrete->valorFrete($cep_destino, $valor_frete);
                            $pedido['Pedido']['frete_form'] = number_format($valor_frete, 2, ',', '');
                            $pedido['Pedido']['frete'] = $valor_frete;
                            $pedido['Pedido']['cep'] = $cep_destino;
                            $pedido['Pedido']['tipo_correio'] = $tipo_correio;
                            $this->Session->write('Frete.prazo_entrega', $correio['prazo_entrega']);
                            $this->Session->write('Frete.valor', $correio['valor']);
                            $this->Session->write('PedidoValidate.frete_check', $array_produtos);
                            $this->Session->delete('PedidoValidate.frete_error');
                            //salva o pedido 
                            if(!$this->Pedido->save($pedido))
                                $this->Session->setFlash(__('Erro ao salvar o frete', true));
                            else{
                                $this->Session->write('Pedido', $pedido);
                                if($notifica == '1')
                                    $this->Session->setFlash(__('Frete atualizado', true));	
                            }
                        }
                }else{
                        $this->Session->write('PedidoValidate.frete_error', 1);
                        //$this->Pedido->save($pedido);
                        //$this->Session->write('Pedido', $pedido);
                        if($notifica == '1')
                            $this->Session->setFlash(__('Não foi possível calcular o frete, verifique se foi digitado corretamente', true));
                }
                //completar os dados do pedido com o endereço e valor do frete
            }else{
                    //não informou o cep
                    if($notifica == '1')
                        $this->Session->setFlash(__('Informe o CEP para que seja calculado o frete', true));
            }
            $this->redirect('/pedidos/atual');
	}
        function salvar_frete(){
            //verifica se o cep esta no form
            $valor_frete = $this->data['Pedido']['valor_frete_form'];
            $valor_frete = floatval(str_replace(',', '.', $valor_frete));
            if($valor_frete >= 0){
                $pedido = $this->Session->read('Pedido');
                $pedido['Pedido']['frete_form'] = number_format($valor_frete, 2, ',', '');
                $pedido['Pedido']['frete'] = $valor_frete;
                $this->Session->delete('PedidoValidate.frete_error');
                //salva o pedido 
                if($this->Pedido->save($pedido)){
                    $this->Session->write('Pedido', $pedido);
                    $this->Session->setFlash(__('Frete atualizado', true));	
                }else{
                    $this->Session->setFlash(__('Erro ao salvar o frete', true));	
                }
            }else{
                //não informou o cep
                $this->Session->setFlash(__('Informe o CEP para que seja calculado o frete', true));
            }
            $this->redirect('/pedidos/atual');
        }
	//Passo 1
	function atual() {
		$this->set('content_title', 'Meu carrinho');
		$this->set('passo_pedido', 'pedido');
		$this->set('controller_name', 'produtos');
		//Verificar se há um pedido iniciado
		$pedido = array();
                $produtos = array();
                
//                echo '<pre>';
//                print_r($_SESSION);
//                echo '</pre>';
                
		if($this->Session->check('Pedido')){
                    $pedido = $this->Session->read('Pedido');
                    
//                    unset($pedido['Pedido']['user_id']);
//                    unset($pedido['Pedido']['cidade_id']);
//                    unset($pedido['Pedido']['statuspedido_id']);
//                    $pedido['Pedido']['bairro'] = 'centro2';
//                    if($this->Pedido->save($pedido)){
//                        echo 'certo';
//                    }else{
//                        echo 'errado';
//                    }
//                    $this->debugVar($pedido);
//                    die();
                    if(!empty($pedido['Itempedido'])){
                        if(count($pedido['Itempedido']) > 0){
                            //possui frete calculado?
                            if(empty($pedido['Pedido']['frete'])){
                                //verifica se possui erro no calculo do frete
                                if($this->Session->check('PedidoValidate.frete_error')){
                                    $this->Session->setFlash(__('Insira o CEP abaixo para calcular o valor do frete', true));
                                }else{
                                    //verifica se possui endereço no cadastro
                                    if($this->Auth->user('group_id') != 1)
                                        $user = $this->Auth->user();
                                        if(empty($pedido['Pedido']['cep'])){
                                            if( !empty($user['User']['cep']) ){
                                                //atribuir endereco ao pedido e calcular o frete
                                                $pedido = $this->Pedido->gravar_endereco($pedido, $user['User'] );
                                                $pedido['Pedido']['tipo_correio'] = 41106;
                                                $this->Pedido->save($pedido);
                                                $this->Session->write('Pedido', $pedido);
                                                $this->redirect('/pedidos/calcular_frete/0');
                                            }
                                        }else{
                                            $this->redirect('/pedidos/calcular_frete/0');
                                        }
                                }
                            }
                        }
                    }else{
                    }
                    //enviar os produtos para a página
                    if(!empty($pedido['Itempedido']))
                    foreach($pedido['Itempedido'] as $item){
                        $produto = $this->Pedido->Itempedido->Produto->read(null, $item['produto_id']);
                        $produtos[$produto['Produto']['id']] = $produto;
                    }   
		}
		$this->set(compact('pedido', 'produtos'));
	}
	//Passo 2
	function obter_endereco(){
		$this->set('content_title', 'Endereço para o envio');
		$this->set('passo_pedido', 'endereco');
                $this->set('controller_name', 'produtos');
		$pedido = $this->Session->read('Pedido');
		$user = $this->Session->read('Auth.User');
                //Verifica se foi feio o passo 1 corretamente
		$status_passo_1 = $this->Pedido->verifica_passo_1($pedido, $this->config_sistema);
		if($status_passo_1 == 'sem_produto'){
			$this->Session->setFlash(__('Você não possui produtos no pedido.', true));
			$this->redirect('/pedidos/atual');
		}elseif($status_passo_1 == 'sem_cep'){
                        //se for admin não é necessário voltar para o passo anterior
                        if($this->Auth->user('group_id') != 1){
                            $this->Session->setFlash(__('Insira o CEP para calcular o frete.', true));
                            $this->redirect('/pedidos/atual');    
                        }
		}
		//verifica se esta logado
		if (!$this->Session->read('Auth.User')) {
			//redirecionar para a página de login para depois salvar o pedido
			$this->Session->write('Redirect_url', '/pedidos/obter_endereco');
			$this->redirect('/users/login');
		}
		//$user = $this->Pedido->User->find('first', array('conditions' => array('User.id' => $this->Session->read('Auth.User.id'))));
                //$user = $user['User'];
                if(!empty($this->data)){
			//gravar o endereço do usuário
			$pedido = $this->Pedido->gravar_endereco($pedido, $this->data['Pedido']);
                        $pedido['Pedido']['user_id'] = $user['id'];
                        $this->Pedido->save($pedido);
			$this->Session->write('Pedido', $pedido);
			//$this->Session->setFlash(__('Endereço salvo', true));
			$this->redirect('/pedidos/pagamento');
		}
                if(empty($pedido['Pedido']['endereco']))
                    if(!empty($user['endereco'])){
                        if($this->Auth->user('group_id') != 1){
                            $pedido = $this->Pedido->gravar_endereco($pedido, $user );
                            $this->Session->write('Pedido', $pedido);
                        }
                    }
		//$this->debugVar($pedido);
		//obter lista de estados
		$select_estados = $this->Pedido->Cidade->Estado->getFormSelect();
		//$select_estados = $this->Pedido->Cidade->Estado->find('all');
		//$this->debugVar($select_estados);
		if(!empty($pedido['Pedido']['cidade_id'])){
			$cidade = $this->Pedido->Cidade->read(null, $pedido['Pedido']['cidade_id']);
			$estado_id = $cidade['Cidade']['estado_id'];
                        //obter lista de estados
			$select_cidades = $this->Pedido->Cidade->getFormSelect($estado_id);
		}else{
			$estado_id = null;
			$select_cidades = array();
		}
		$this->set(compact('pedido', 'user', 'estado_id', 'select_estados', 'select_cidades'));
	}
	//Passo 3
	function pagamento(){
		$this->set('content_title', 'Pagamento');
		$this->set('passo_pedido', 'pagamento');
                $this->set('controller_name', 'produtos');
		$pedido = $this->Session->read('Pedido');
		//Verifica se foi feio o passo 2 corretamente
		$status_passo_2 = $this->Pedido->verifica_passo_2($pedido, $this->config_sistema);
		if($status_passo_2 == false){
                    if($this->Auth->user('group_id') != 1){
                        $this->Session->setFlash(__('Preencha corretamente o fomulário de endereço', true));
                        $this->redirect('/pedidos/obter_endereco');
                    }
                }
//		//salvar o pedido no banco
//		$pedido = $this->Pedido->gravar_pedido($pedido, $this->Auth->user('id'));
//		if($pedido == false){
//			$this->redirect('/pedidos/atual');
//		}
                if(isset($pedido['Pedido']['cidade_id'])){
                    $cidade = $this->Pedido->Cidade->find('first', array('conditions' => array('Cidade.id' => $pedido['Pedido']['cidade_id']), 
                                                                                        'recursive' => '-1'));
                    $cidade_form = $cidade['Cidade']['nome'].' - '.$cidade['Cidade']['estado_id'];
                }else{
                    $cidade_form = null;
                }
		//preparar variáveis da Cielo
		$select_bandeiras = $this->CieloPedido->getBandeiras();
		$select_formaspagamento = $this->CieloPedido->getFormasPagamento();
                $select_statuspedido = $this->Pedido->Statuspedido->getFormSelect();
                $select_statusfatura = $this->Pedido->Fatura->Statusfatura->getFormSelect();
                //enviar os produtos para a página
                $produtos = array();
                foreach($pedido['Itempedido'] as $item){
                    $produto = $this->Pedido->Itempedido->Produto->read(null, $item['produto_id']);
                    $produtos[$produto['Produto']['id']] = $produto;
                }
                //obtendo dados do cliente
                $cliente = array();
                if(!empty($pedido['Pedido']['user_id'])){
                    $cliente = $this->Pedido->User->read(null, $pedido['Pedido']['user_id']);
                }
		$this->Session->write('Pedido', $pedido);
		$this->set(compact('pedido', 'cidade_form', 'produtos', 'cliente', 'select_formaspagamento', 'select_bandeiras', 'select_statuspedido', 'select_statusfatura'));
                $this->set('user_id', $this->Auth->user('id'));
	}
        function concluido(){
            $this->set('content_title', 'Pedido salvo');
        }
        function concluir_pedido(){
            $pedido = $this->Session->read('Pedido');
            $pedido = $this->Pedido->saveTotal($pedido['Pedido']['id']);
            if (!empty($this->data)) {
                //salvar o status do pedido
                $pedido['Pedido']['statuspedido_id'] = $this->data['Pedido']['statuspedido_id'];
                $this->Pedido->save($pedido);
                $this->Pedido->Pedidohistorico->grava_historico($pedido['Pedido']['id']);
                $this->Pedido->atualiza_estoque($pedido['Pedido']['id']);
                //salvar o status da fatura
                $fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $pedido['Pedido']['id'], 'Fatura.ativo' => '1'), 
                                                                    'recursive' => '0'));	
                $fatura['Fatura']['statusfatura_id'] = $this->data['Pedido']['statusfatura_id'];
                $this->Pedido->Fatura->save($fatura);
            }
            $this->redirect('/pedidos/index_admin');
        }
        function associar_cliente($user_id){
            $pedido = $this->Session->read('Pedido');
            $pedido['Pedido']['user_id'] = $user_id;
            if($this->Pedido->save($pedido)){
                $pedido = $this->Pedido->read(null, $pedido['Pedido']['id']);
                $this->Session->write('Pedido', $pedido);
                $this->Session->setFlash(__('Cliente associado', true));
            }else{
                $this->Session->setFlash(__('Erro ao associar o clinete. Tente mais tarde', true));
            }
            $this->redirect('/pedidos/pagamento');
        }
        function fazer_pagamento_antigo($id){
            $this->autoRender = false;
            //verifica se o pedido pertence ao usuário
            if(!$this->Pedido->is_owner($id, $this->Auth->user('id'))){
                $this->redirect('/pedidos');
            }
            //recurso desativado
            $this->redirect('/pedidos/view/'.$id);
            //fim
            $pedido = $this->Pedido->find('first', array('conditions' => array('Pedido.id' => $id), 'recursive' => '1'));
            $fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $id), 
                                                                                        'recursive' => '0'));
            $array_pagseguro_set = array();
            $i = 1;
            foreach($pedido['Itempedido'] as $item){
                $produto_item = $this->Pedido->Itempedido->Produto->find('first', array('conditions' => array('Produto.id' => $item['produto_id']), 
                                                                                        'recursive' => '0'));
                $array_pagseguro_set['itemId'.$i] = $produto_item['Produto']['id'];
                if(empty($item['modelo']))
                    $array_pagseguro_set['itemDescription'.$i] = $produto_item['Produto']['nome'];
                else
                    $array_pagseguro_set['itemDescription'.$i] = $produto_item['Produto']['nome'].' ('.$item['modelo'].')';
                $array_pagseguro_set['itemAmount'.$i] = number_format($item['valor_unitario'], 2, '.', '');
                $array_pagseguro_set['itemQuantity'.$i] = $item['quantidade'];
                $array_pagseguro_set['itemWeight'.$i] = $produto_item['Produto']['peso']*1000;
                $i++;
            }
            //Adiciona o item referente ao frete.
            $tipo_correio_nome = $this->Correio->getNomeTipoPagamento($pedido['Pedido']['tipo_correio']);
            $array_pagseguro_set['itemId'.$i] = '00';
            $array_pagseguro_set['itemDescription'.$i] = 'FRETE ('.$tipo_correio_nome.')';
            $array_pagseguro_set['itemAmount'.$i] = number_format($pedido['Pedido']['frete'], 2, '.', '');
            $array_pagseguro_set['itemQuantity'.$i] = 1;
            $array_pagseguro_set['itemWeight'.$i] = '00';
            $this->Checkout->set($array_pagseguro_set);
            $shipping = array(
                'reference' => $pedido['Pedido']['id'],
                'senderName' => $this->Auth->user('name'),
                'senderEmail' => $this->Auth->user('email'),
                'shippingType' => '2',
                'shippingAddressStreet' => $pedido['Pedido']['endereco'],
                'shippingAddressNumber' => $pedido['Pedido']['numero'],
                'shippingAddressDistrict' => $pedido['Pedido']['bairro'],
                'shippingAddressPostalCode' => $pedido['Pedido']['cep'],
                'shippingAddressCity' => $this->Pedido->Cidade->getNome($pedido['Pedido']['cidade_id']),
                'shippingAddressState' => $this->Pedido->Cidade->getEstadoSigla($pedido['Pedido']['cidade_id']),
                'shippingAddressCountry' => 'BRA'
            );
            $this->Checkout->setShipping($shipping);
            $return = $this->Checkout->finalize();
            //$this->debugVar($array_pagseguro_set);
            if(empty($return))
                $this->Session->setFlash(__('Erro ao tentar fazer o pagamento, tente mais tarde.', true));
            if (isset($return['Erros'])) {
                //Tratamento dos erros
                //$this->debugVar($return);
                $this->Session->setFlash(__('Erro ao tentar fazer o pagamento, tente mais tarde.', true));
            }
        }
	function fazer_pagamento(){
            $pedido = $this->Session->read('Pedido');
            $this->autoRender = false;
            $pedido = $this->Pedido->saveTotal($pedido['Pedido']['id']);
            $fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $pedido['Pedido']['id'], 'Fatura.ativo' => 1), 
                                                            'recursive' => '0'));
            //PAGSEGURO
            if(true){
                $array_pagseguro_set = array();
                $i = 1;
                foreach($pedido['Itempedido'] as $item){
                    $produto = $this->Pedido->Itempedido->Produto->read(null, $item['produto_id']);
                    $array_pagseguro_set['itemId'.$i] = $item['produto_id'];
                    $array_pagseguro_set['itemDescription'.$i] = $produto['Produto']['nome'];
                    $array_pagseguro_set['itemAmount'.$i] = number_format($item['valor_unitario'], 2, '.', '');
                    $array_pagseguro_set['itemQuantity'.$i] = $item['quantidade'];
                    $array_pagseguro_set['itemWeight'.$i] = $produto['Produto']['peso']*1000;
                    $i++;
                }
                //Adiciona o item referente ao frete.
                $tipo_correio_nome = $this->Correio->getNomeTipoPagamento($pedido['Pedido']['tipo_correio']);
                $array_pagseguro_set['itemId'.$i] = '00';
                $array_pagseguro_set['itemDescription'.$i] = 'FRETE ('.$tipo_correio_nome.')';
                $array_pagseguro_set['itemAmount'.$i] = number_format($pedido['Pedido']['frete'], 2, '.', '');
                $array_pagseguro_set['itemQuantity'.$i] = 1;
                $array_pagseguro_set['itemWeight'.$i] = '00';
                $this->Checkout->set($array_pagseguro_set);
                $shipping = array(
                    'reference' => $fatura['Fatura']['id'],
                    'senderName' => $this->Auth->user('nome'),
                    'senderEmail' => $this->Auth->user('email'),
                    'shippingType' => '2',
                    'shippingAddressStreet' => $pedido['Pedido']['endereco'],
                    'shippingAddressNumber' => $pedido['Pedido']['numero'],
                    'shippingAddressDistrict' => $pedido['Pedido']['bairro'],
                    'shippingAddressPostalCode' => $pedido['Pedido']['cep'],
                    'shippingAddressCity' => $this->Pedido->Cidade->getNome($pedido['Pedido']['cidade_id']),
                    'shippingAddressState' => $this->Pedido->Cidade->getEstadoSigla($pedido['Pedido']['cidade_id']),
                    'shippingAddressCountry' => 'BRA'
                );
                $this->Checkout->setShipping($shipping);
                $return = $this->Checkout->finalize();
                //$this->debugVar($array_pagseguro_set);
                if(empty($return))
                    $this->Session->setFlash(__('Erro ao tentar fazer o pagamento, tente mais tarde.', true));
                if (isset($return['Erros'])) {
                    //Tratamento dos erros
                    //$this->debugVar($return);
                    $this->Session->setFlash(__('Erro ao tentar fazer o pagamento, tente mais tarde.', true));
                }
            }
            //CIELO
            if(false){
                //Obter os dados da Cielo do banco
                $this->CieloPedido->formaPagamentoBandeira = $this->data['Cielo']['codigoBandeira']; 
                if($this->data['Cielo']['formaPagamento'] != "A" && $this->data['Cielo']['formaPagamento'] != "1")
                {
                        $this->CieloPedido->formaPagamentoProduto = 2;
                        $this->CieloPedido->formaPagamentoParcelas = $this->data['Cielo']['formaPagamento'];
                } 
                else 
                {
                        $this->CieloPedido->formaPagamentoProduto = $this->data['Cielo']['formaPagamento'];
                        $this->CieloPedido->formaPagamentoParcelas = 1;
                }
                $this->CieloPedido->dadosEcNumero = $this->CieloPedido->CIELO;
                $this->CieloPedido->dadosEcChave = $this->CieloPedido->CIELO_CHAVE;
                $this->CieloPedido->capturar = 'false';	
                $this->CieloPedido->autorizar = 2;
                $this->CieloPedido->dadosPedidoNumero = $pedido['Pedido']['id']; 
                $this->CieloPedido->dadosPedidoValor = $pedido['Pedido']['valor_total'];
                $this->CieloPedido->dadosPedidoDescricao = 'Pedido na Home Sample';
                //TESTE - CIELO TEST valor
                $this->CieloPedido->dadosPedidoValor = 100;
                $this->CieloPedido->urlRetorno = $this->CieloPedido->ReturnURL();
                // ENVIA REQUISIÇÃO SITE CIELO
                $objResposta = $this->CieloPedido->RequisicaoTransacao(false);
                $this->CieloPedido->tid = $objResposta->tid;
                $this->CieloPedido->pan = $objResposta->pan;
                $this->CieloPedido->status = $objResposta->status;
                $urlAutenticacao = "url-autenticacao";
                $this->CieloPedido->urlAutenticacao = $objResposta->$urlAutenticacao;
                // Serializa Pedido e guarda na SESSION
                $StrPedido = $this->CieloPedido->ToString();
                $this->Session->write('PedidoCIELO', $StrPedido);
                //atualiza dados da fatura com os dados da CIELO
                $fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $pedido['Pedido']['id'], 'Fatura.ativo' => '1'), 
                                                                                        'recursive' => '0'));	
                $fatura['Fatura']['cielo_tid'] = $objResposta->tid;
                $fatura['Fatura']['cielo_bandeira'] = $this->CieloPedido->formaPagamentoBandeira;
                $fatura['Fatura']['cielo_parcelas'] = $this->CieloPedido->formaPagamentoParcelas;
                $fatura['Fatura']['cielo_url'] = $this->CieloPedido->urlAutenticacao;
                $fatura['Fatura']['statusfatura_id'] = 1;
                $this->Pedido->Fatura->save($fatura);
                echo '<script type="text/javascript">
                            window.location.href = "' . $this->CieloPedido->urlAutenticacao . '"
                     </script>';
                die('');
            }
	}
	function pedido_concluido($id = null){
		$this->set('content_title', 'Pedido concluído');
                if($this->Session->check('Pedido')){
                    $pedido = $this->Session->read('Pedido');
                    $this->Session->delete('Pedido');
                    $this->set(compact('pedido'));
                }
		//$pedido = $this->Pedido->read(null, $id);
                //Não é mais necessário
                if(false){
                    //pode verificar o pedido na cielo para saber se ja esta autorizado
                    //...
                    //atualizar status do pedido
                    $pedido['Pedido']['statuspedido_id'] = 2;
                    $this->Pedido->save($pedido);
                    $fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $pedido['Pedido']['id']), 
                                                                                            'recursive' => '0'));
                    $fatura['Fatura']['statusfatura_id'] = 1;
                    $this->Pedido->Fatura->save($fatura);
                }
		if(isset($pedido)){
                    //enviar e-mail para o usuário sobre a conclusão do pedido
                    $nome_cliente = $this->Auth->user('name');
                    $email_cliente = $this->Auth->user('username');
                    $array_mesclagem = array();
                    $array_mesclagem['nome'] = $this->Auth->user('name');
                    $array_mesclagem['pedido'] = $pedido;
                    $this->envia_email($nome_cliente, $email_cliente, 'Pedido criado' ,'pedido_concluido', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                }
	}
	function mudar_status_pedido($id = null){
            if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Pedido inválido', true));
                $this->redirect(array('action' => 'index'));
            }
            $status_id = $this->data['Pedido']['statuspedido_id'];
            $pedido = $this->Pedido->find('first', array('conditions' => array('Pedido.id' => $id), 
                                                                            'recursive' => '0'));
            $pedido['Pedido']['statuspedido_id'] = $status_id;
            //$this->Pedido->Pedidohistorico->grava_historico($pedido['Pedido']['id']);
            if($this->Pedido->save($pedido)){
                $this->Pedido->Pedidohistorico->grava_historico($pedido['Pedido']['id']);
                $this->Pedido->atualiza_estoque($id, $this->config_sistema['Configuracao']['desativa_produto_vazio']);
                if($status_id == 4){
                    //cancela a fatura
                    $fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $id), 
                                                                                    'recursive' => '0'));
                    if(!empty($fatura)){
                        if($fatura['Fatura']['statusfatura_id'] != 4 & $fatura['Fatura']['statusfatura_id'] != 6){
                            $fatura['Fatura']['statusfatura_id'] = 9;
                            if($this->Pedido->Fatura->save($fatura)){
                                $this->Pedido->Fatura->Faturahistorico->grava_historico($fatura['Fatura']['id']);
                                $this->Session->setFlash(__('Status modificado', true));
                            }else{
                                $this->Session->setFlash(__('Não foi possível cancelar a fatura', true));
                            }
                        }
                    }else{
                        $this->Session->setFlash(__('Status modificadado, mas é necessário cancelar a fatura do cliente no site de pagamento.', true));
                    }
                }else{
                    $this->Session->setFlash(__('Status modificado', true));
                }
            }else{
                $this->Session->setFlash(__('Não foi possível mudar o status, tente novamente.', true));
            }
            $this->redirect('/pedidos/view_admin/'.$id);
	}
        function teste1(){
            $this->Pedido->Itempedido->Produto->colocaEstoque(2, 5);
        }
        //----
        //Métodos PAGSEGURO
        //----
        function retorno_pagseguro(){
            $evento = $_POST;
            $this->layout = null;
            $this->render = null;
            echo "<br/>Processando retorno...<br/>\n";
            //verificar se é notificação ou transação
            if(!empty($evento['notificationCode'])){
                //notificação
                echo 'Notificação<br/>';
                $this->loadModel('Pagseguronotification');
                $notificacao = array();
                $notificacao['id'] = $evento['notificationCode'];
                $notificacao['notificationtype'] = $evento['notificationType'];
                $verif_notif = $this->Pagseguronotification->find('first', array('conditions' => array('Pagseguronotification.id' => $evento['notificationCode']), 
                                                                'recursive' => '0'));
                if(empty($verif_notif)){
                    //enviando por e-mail
                    $array_mesclagem = array();
                    $array_mesclagem['variavel'] = '<pre>'.print_r($_POST, true).'</pre>';
                    if($this->envia_email('Administrador DF', 'douglas@grupodf.com', 'Retorno PagSeguro' ,'teste_variavel', $array_mesclagem))
                        echo "Envio de e-mail com sucesso<br/> \n";
                    else
                        echo "Falha no envio de e-mail<br/> \n";
                }
                if($this->Pagseguronotification->save($notificacao));
            }elseif(!empty($evento['TransacaoID'])){
                //transação
                //enviando por e-mail
                $array_mesclagem = array();
		$array_mesclagem['variavel'] = '<pre>'.print_r($_POST, true).'</pre>';
		if($this->envia_email('Administrador DF', 'douglas@grupodf.com', 'Retorno PagSeguro' ,'teste_variavel', $array_mesclagem))
                    echo "Envio de e-mail com sucesso<br/> \n";
                else
                    echo "Falha no envio de e-mail<br/> \n";
                echo "Transação\n";
                //salvar a transação no banco
                $pagseguro_transacao = array();
                if(!empty($evento['VendedorEmail']))
                $pagseguro_transacao['Pagsegurotransacao']['vendedoremail'] = $evento['VendedorEmail'];
                if(!empty($evento['TransacaoID']))
                $pagseguro_transacao['Pagsegurotransacao']['transacaoid'] = $evento['TransacaoID'];
                if(!empty($evento['Referencia']))
                $pagseguro_transacao['Pagsegurotransacao']['pedido_id'] = $evento['Referencia'];
                if(!empty($evento['Extras']))
                $pagseguro_transacao['Pagsegurotransacao']['extras'] = $evento['Extras'];
                if(!empty($evento['TipoFrete']))
                $pagseguro_transacao['Pagsegurotransacao']['tipofrete'] = $evento['TipoFrete'];
                if(!empty($evento['ValorFrete']))
                $pagseguro_transacao['Pagsegurotransacao']['valorfrete'] = $evento['ValorFrete'];
                if(!empty($evento['Anotacao']))
                $pagseguro_transacao['Pagsegurotransacao']['anotacao'] = $evento['Anotacao'];
                if(!empty($evento['DataTransacao']))
                $pagseguro_transacao['Pagsegurotransacao']['datatransacao'] = $evento['DataTransacao'];
                if(!empty($evento['TipoPagamento']))
                $pagseguro_transacao['Pagsegurotransacao']['tipopagamento'] = $evento['TipoPagamento'];
                if(!empty($evento['StatusTransacao']))
                $pagseguro_transacao['Pagsegurotransacao']['statustransacao'] = $evento['StatusTransacao'];
                $valor_total = 0.0;
                if(!empty($evento['NumItens'])){
                    $pagseguro_transacao['Pagsegurotransacao']['numitens'] = $evento['NumItens'];
                    //calcular valor total do pedido no pagseguro
                    $num_itens = intval($evento['NumItens']);
                    for($i=1; $i<=$num_itens; $i++){
                        $valor_total += floatval($this->Pedido->valorFormatBeforeSave($evento['ProdValor_'.$i]))*intval($evento['ProdQuantidade_'.$i]);
                    }
                    $pagseguro_transacao['Pagsegurotransacao']['valor_total'] = $valor_total;
                }
                
                
                //validar o _post do pagseguro
                //$result_verificacao = $this->Pedido->Pagsegurotransacao->verifica_retorno($evento, $this->config_sistema['Configuracao']['pagseguro_token']);
                $result_verificacao = "VERIFICADO";
                echo "Salvando transação";
                
                $pagseguro_transacao['Pagsegurotransacao']['verificacao'] = $result_verificacao;
                if($this->Pedido->Pagsegurotransacao->save($pagseguro_transacao))
                    echo 'Transação Salva<br/>';
                else {
                    echo 'Transsação não salva<br/>';
                }
                
                // TODO grupodf: variável ainda não utilizada, pois ainda possui o true na condição
                if ($result_verificacao == "VERIFICADO" | true){
                    //atualizar status da fatura do pedido
                    $fatura_id = $evento['Referencia'];
                    echo 'Fatura:'.$fatura_id;
                    $fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.id' => $fatura_id), 
                                                            'recursive' => '0'));
                    if($fatura) echo 'Fatura localizada<br>';
                    
                    $pedido = $this->Pedido->find('first', array('conditions' => array('Pedido.id' => $fatura['Fatura']['pedido_id']), 
                                                            'recursive' => '1'));
                    if($pedido) echo 'Pedido localizado<br>';

                    $pedido_id = $fatura['Fatura']['pedido_id'];
                    echo "Pedido: $pedido_id\n";
                    echo "Status do pedido (form): ".$evento['StatusTransacao']."\n";
                    $novo_statusfatura_id = $this->Pedido->Fatura->Statusfatura->getStatusIdPagseguro($evento['StatusTransacao']);
                    echo "Novo Status: $novo_statusfatura_id\n";
                    if(!empty($novo_statusfatura_id)){
                        echo 'Status atual da fatura: '.$fatura['Fatura']['statusfatura_id']."\n";
                        //verifica se teve mudança de status
                        if($novo_statusfatura_id != $fatura['Fatura']['statusfatura_id']){
                            //salva novo status
                            echo "Salvando novo status...\n";
                            $fatura['Fatura']['statusfatura_id'] = $novo_statusfatura_id;
                            $this->Pedido->Fatura->create();
                            $this->Pedido->Fatura->save($fatura);
                            $this->Pedido->Fatura->Faturahistorico->grava_historico($fatura['Fatura']['id']);


                            //atualiza status do pedido
                            $novo_statuspedido_id = $this->Pedido->atualizaStatusByFaturaPagseguro($pedido_id, $novo_statusfatura_id);
                            //envio de e-mails
                            if($novo_statusfatura_id == 6){
                                //pagamento completado, que esta liberado no pagseguro
                                $array_mesclagem = array();
                                $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_responsavel'];
                                $array_mesclagem['pedido'] = $this->Pedido->obtemInfo($pedido);
                                $this->envia_email($this->config_sistema['Configuracao']['nome_responsavel'], $this->config_sistema['Configuracao']['email'], 'Pedido '.$pedido['Pedido']['id'].': pagamento PagSeguro concluído' ,'pagseguro_concluido', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                            }
                            if($novo_statusfatura_id == 1){
                                //aguardando pagamento 
                                $array_mesclagem = array();
                                $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_responsavel'];
                                $array_mesclagem['pedido'] = $this->Pedido->obtemInfo($pedido);
                                $this->envia_email($this->config_sistema['Configuracao']['nome_responsavel'], $this->config_sistema['Configuracao']['email'], 'Pedido '.$pedido['Pedido']['id'].': aguardando pagamento PagSeguro' ,'pagseguro_analise', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                            }
                            if($novo_statusfatura_id == 4){  //Autorizado
                                //pagamento aprovado, pode mandar pelo correio
                                $array_mesclagem = array();
                                $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_responsavel'];
                                $array_mesclagem['pedido'] = $this->Pedido->obtemInfo($pedido);
                                $array_mesclagem['endereco'] = $this->Pedido->obtemEndereco($pedido);
                                $this->envia_email($this->config_sistema['Configuracao']['nome_responsavel'], $this->config_sistema['Configuracao']['email'], 'Pedido '.$pedido_id.': pagamento PagSeguro aprovado' ,'pagseguro_aprovado', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                                //enviar e-mail para cliente avisando da autorização
                                $array_mesclagem['nome'] = $pedido['User']['name'];
                                $this->envia_email($pedido['User']['name'], $pedido['User']['email'], 'Pedido '.$pedido_id.': pagamento aprovado' ,'pedido_aprovado_cliente', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                            }
                            if($novo_statusfatura_id == 9){
                                //pagamento cancelado
                                $array_mesclagem = array();
                                $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_responsavel'];
                                $array_mesclagem['pedido'] = $this->Pedido->obtemInfo($pedido);
                                $this->envia_email($this->config_sistema['Configuracao']['nome_responsavel'], $this->config_sistema['Configuracao']['email'], 'Pedido '.$pedido['Pedido']['id'].': Pagamento PagSeguro cancelado' ,'pagseguro_cancelado', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                                //enviar e-mail para cliente para notificar do cancelamento
                                $array_mesclagem['nome'] = $pedido['User']['name'];
                                $this->envia_email($pedido['User']['name'], $pedido['User']['email'], 'Pedido '.$pedido_id.': pagamento cancelado' ,'pedido_cancelado_cliente', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                            }

                            //atualizar estoque do pedido
                            if ($novo_statusfatura_id == 4){
                                $status_id = 6;
                                $pedido_alteracao = $this->Pedido->find('first', array('conditions' => array('Pedido.id' => $fatura['Fatura']['pedido_id']),
                                    'recursive' => '0'));
                                $pedido_alteracao['Pedido']['statuspedido_id'] = $status_id;
                                //$this->Pedido->Pedidohistorico->grava_historico($pedido['Pedido']['id']);
                                if($this->Pedido->save($pedido_alteracao)){
                                    $this->Pedido->Pedidohistorico->grava_historico($pedido_alteracao['Pedido']['id']);
                                    $this->Pedido->atualiza_estoque($fatura['Fatura']['pedido_id'], $this->config_sistema['Configuracao']['desativa_produto_vazio']);
                                }
                            }


                        }
                    }
                }else{
                    // TODO grupodf: erro na verificação, notificar Grupo DF da tentativa
                }
            }
        }
        //----
        //Métodos CIELO
        //----
	function consultar_pedido($id) {
		$fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $id), 
											'recursive' => '0'));
		//Obter os dados da Cielo do banco
                $this->Cielo->carrega_configuracao($this->config_sistema);
		$consulta = $this->Cielo->consultar_pedido($fatura['Fatura']['cielo_tid']);							
		//atualizar fatura
		$this->Pedido->Fatura->atualiza_status_cielo($fatura, $consulta);
		$this->redirect('/pedidos/view_admin/'.$id);
        /*
         Array
                (
                    [Transacao] => Array
                        (
                            [id] => 5
                            [versao] => 1.0.0
                            [xmlns] => http://ecommerce.cbmp.com.br
                            [tid] => xxxxxxxxxxxxxxxxxx
                            [Dados-pedido] => Array
                                (
                                    [numero] => 1
                                    [valor] => 433
                                    [moeda] => 986
                                    [data-hora] => 2011-01-10T00:54:13.559-02:00
                                    [idioma] => PT
                                )
                            [Forma-pagamento] => Array
                                (
                                    [produto] => 2
                                    [parcelas] => 2
                                )
                            [status] => 0
                        )
                )
         */
	}
	function capturar_fatura($id){
            $fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $id), 
                                                                            'recursive' => '0'));
            //Obter os dados da Cielo do banco
            $this->loadModel('Configuracao');
            $this->Configuracao->create();
            $config = $this->Configuracao->read(null, 1);
            $this->Cielo->carrega_configuracao($config);
            $captura = $this->Cielo->capturar_pedido($fatura['Fatura']['cielo_tid']);
            //atualizar status da fatura
            $this->redirect('/pedidos/consultar_pedido/'.$id);
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(array('atual', 'obter_endereco', 'calcular_frete_ajax', 'calcular_frete', 'pagamento', 'fazer_pagamento', 'fazer_pagamento_antigo', 'retorno_pagseguro', 'salvar_frete', 'concluido', 'calcular_frete_form', 'imprimi_pedido', 'enviar_email_avaliacao'));
		$this->set('nameSession', 'manage');
		$this->set('controller_name', 'pedidos');
                $this->Session->write('SideBar.tipo', 'produtos');
	}
	function rastreio_correio(){
            if (!empty($this->data)) {
                $pedido = $this->Pedido->read(null, $this->data['Pedido']['pedido_id']);
                $pedido['Pedido']['rastreio_correio'] = $this->data['Pedido']['rastreio_correio'];
                //mudar status do pedido para "Em Entrega" caso ainda esteja como "Aprovado"
                if($pedido['Pedido']['statuspedido_id'] == 6)
                    $pedido['Pedido']['statuspedido_id'] = 3;
                if($this->Pedido->save($pedido)){
                    $this->Pedido->Pedidohistorico->grava_historico($pedido['Pedido']['id'], 'Código de rastreio atualizado');
                    //envia e-mail para o cliente com o código de rastreio
                    $array_mesclagem = array();
                    $array_mesclagem['nome'] = $pedido['User']['name'];
                    $array_mesclagem['pedido'] = $this->Pedido->obtemInfo($pedido);
                    $array_mesclagem['rastreio_codigo'] = $this->data['Pedido']['rastreio_correio'];
                    if($this->envia_email($pedido['User']['name'], $pedido['User']['email'], 'Pedido '.$pedido['Pedido']['id'].': Código de rastreio' ,'pedido_codigo_rastreio', $array_mesclagem, 'pedido', $pedido['Pedido']['id']))
                        $this->Session->setFlash(__('Código de rastreio salvo e enviado por e-mail para o cliente.', true));
                    else
                        $this->Session->setFlash(__('Código de rastreio salvo, mas não foi enviado e-mail. Tente novamente', true));
                    $this->redirect(array('action' => 'view_admin/'.$this->data['Pedido']['pedido_id']));
                }else{
                    $this->Session->setFlash(__('Não foi possível salvar o código de correio, enter em contato com o suporte.', true));
                    $this->redirect(array('action' => 'view_admin/'.$this->data['Pedido']['pedido_id']));
                }
            }
            $this->Session->setFlash(__('Nenhum dado informado. Tente novamente.', true));
            $this->redirect(array('action' => 'index'));
        }
        function email_rastreio_correio($pedido_id){
            $pedido = $this->Pedido->read(null, $pedido_id);
            //envia e-mail para o cliente com o código de rastreio
            $array_mesclagem = array();
            $array_mesclagem['nome'] = $pedido['User']['name'];
            $array_mesclagem['pedido'] = $this->Pedido->obtemInfo($pedido);
            $array_mesclagem['rastreio_codigo'] = $pedido['Pedido']['rastreio_correio'];
            if($this->envia_email($pedido['User']['name'], $pedido['User']['email'], 'Pedido '.$pedido['Pedido']['id'].': Código de rastreio' ,'pedido_codigo_rastreio', $array_mesclagem, 'pedido', $pedido['Pedido']['id']))
                $this->Session->setFlash(__('Código de rastreio enviado para o cliente.', true));
            else
                $this->Session->setFlash(__('Erro ao enviar o e-mail. Tente novamente ou contato o suporte', true));
            $this->redirect(array('action' => 'view_admin/'.$pedido_id));
        }

    function enviar_email_avaliacao($pedido_id){
        $pedido = $this->Pedido->read(null, $pedido_id);

        $array_mesclagem = array();
        $array_mesclagem['nome'] = $pedido['User']['name'];
        $array_mesclagem['codigo_pedido'] = $pedido['Pedido']['id'];

        //no caso de criar um link para cada produto do pedido
        $produtos = '';
        foreach($pedido['Itempedido'] as $item){
            $produto = $this->Pedido->Itempedido->Produto->read(null, $item['produto_id']);
            $produtos .= '<a href="' . Router::url( '/produtos/view/'.$item['produto_id'].'/oculto', true ).'">'.$produto['Produto']['nome'].'</a><br/><br/>';
        }

        $array_mesclagem['link_depoimento'] = '<a href="'.Router::url( '/depoimentos', true ).'">Fazer depoimento</a>';

        if($this->envia_email($pedido['User']['name'], $pedido['User']['email'], 'Pedido '.$pedido['Pedido']['id'].': Avaliação do pedido' ,'pedido_avaliacao', $array_mesclagem, 'pedido', $pedido['Pedido']['id'])){
            $pedido['Pedido']['email_avaliacao'] = 1;
            $this->Pedido->save($pedido);
            $this->Session->setFlash(__('E-mail para avaliação enviado com sucesso', true));
        }else{
            $this->Session->setFlash(__('Erro ao enviar o e-mail. Tente novamente', true));
        }
        $this->redirect(array('action' => 'view_admin/'.$pedido_id));

    }
        
        
        function imprimi_pedido($id){
            
            $pedido = $this->Pedido->read(null, $id);
            $tipo_correio = $this->Correio->getNomeTipoPagamento($pedido['Pedido']['tipo_correio']);
            $itenspedido = $this->Pedido->Itempedido->find('all', array('conditions' => array('Itempedido.pedido_id' => $id), 
                                                                                            'recursive' => '1'));
            $fatura = $this->Pedido->Fatura->find('first', array('conditions' => array('Fatura.pedido_id' => $id), 
                                                                                            'recursive' => '0'));
            $estado = $this->Pedido->Cidade->Estado->read(null, $pedido['Cidade']['estado_id']);
            $produtos = array();
            foreach($pedido['Itempedido'] as $item){
                $produto = $this->Pedido->Itempedido->Produto->read(null, $item['produto_id']);
                $produtos[$produto['Produto']['id']] = $produto;
            }   
            
            $table_itens = '<table class="item" >
                    <tr class="">
                            <td class="header_table_simple" style="min-width: 100px">Produto</td>
                            <td class="header_table_simple" align="center">Quantidade</td>
                            <td class="header_table_simple" align="center">Valor</td>
                    </tr>';
            
            $valor_total = $pedido['Pedido']['frete'];
            $i = 0;
            foreach($pedido['Itempedido'] as $item){

                    $class = null;
                    if ($i++ % 2 == 0) {
                            $class = ' class="linha_impar"';
                    }else{
                            $class = ' class="linha_par"';
                    }

                    $modelo = '';
                    if(!empty($item['produtoquantidade_id'])){

                        //obter a cor e o tamanho do item do pedido, por enquanto esta longo
                        $cor_id = null;
                        $cor_nome = null;
                        $tamanho_id = null;
                        $tamanho_nome = null;

                        foreach($produtos[$item['produto_id']]['ProdutoQuantidade'] as $prod_quant){
                            if($prod_quant['id'] == $item['produtoquantidade_id']){
                                $cor_id = $prod_quant['cor_id'];
                                $tamanho_id = $prod_quant['tamanho_id'];
                            }
                        }
                        if(!empty($cor_id)){
                            foreach($produtos[$item['produto_id']]['Cor'] as $cor){
                                if($cor_id == $cor['id']){
                                    $cor_nome = $cor['nome'];
                                }
                            }
                            foreach($produtos[$item['produto_id']]['Tamanho'] as $tamanho){
                                if($tamanho_id == $tamanho['id']){
                                    $tamanho_nome = $tamanho['nome'];
                                }
                            }
                        }
                        if(!empty($cor_nome)){
                            $modelo = '<br/>Cor: '.$cor_nome.' <br/>Tamanho: '.$tamanho_nome.'';
                        }

                    }



                    $table_itens .= '<tr '.$class.' ><td>';
                    $table_itens .= $produtos[$item['produto_id']]['Produto']['nome'];  
                    $table_itens .= ' '.$modelo;
                    $table_itens .= '</td><td align="center">';
                    $table_itens .= $item['quantidade'];
                    $table_itens .= '</td><td>R$ ';
                    $table_itens .= number_format($item['valor_total'], 2, ',', '.');
                    $table_itens .= '</td></tr>';

                    $valor_total += $item['valor_total']; 
            }
            
            $table_itens .= '</table>';
            
            $endereco = '<table class="endereco">
                <tr>
                    <td><strong>Destinatário</strong></td>
                    <td colspan="3">'.$pedido['Pedido']['nome'].'</td>
                </tr>
                <tr>
                    <td><strong>Endereço</strong></td>
                    <td colspan="3">
                        '.$pedido['Pedido']['endereco'].' &nbsp;&nbsp;&nbsp;
                        <strong>Número</strong> '.$pedido['Pedido']['numero'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        <strong>Complemento</strong> '.$pedido['Pedido']['complemento'].' <br>
                    </td>
                </tr>
                <tr>
                    <td><strong>CEP</strong></td>
                    <td>'.$pedido['Pedido']['cep'].'</td>
                    <td><strong>Bairro</strong></td>
                    <td>'.$pedido['Pedido']['bairro'].'</td>
                </tr>
                <tr>
                    <td><strong>Cidade</strong></td>
                    <td colspan="3">'.$pedido['Cidade']['nome'].' - '.$estado['Estado']['nome'].' </td>
                </tr>
            </table>';
            
            if(!empty($pedido['Pedido']['tipo_correio']))
                $tipo_correio = ' ('.$tipo_correio.')';
            
            //GERAR O PDF
            
            App::import('Vendor', 'mpdf/mpdf');
            //$mpdf=new mPDF('en-x','A4','','',10,10,30,35,5,10);
            $mpdf=new mPDF();
            $html = '<html><head><style>
                    body{
                            font-family: Verdana;
                    }
                    
                    table.item td{
                            border: 1px solid #DDD; 
                            height:40px;
                    }
                    table.endereco td{
                            height:10px;
                    }
                    table td{
                            height:40px;
                    }
                    td.destaque {
                            background:#EEE;
                    }
                    </style></head><body>';
            
            $html .= '<h1>Pedido '.$id.'</h1>';
            
            $html .= '<table>';
            
            $html .= '<tr><td class="destaque"><strong>Código:</strong></td><td> '.$pedido['Pedido']['id'].'</td></tr>';
            $html .= '<tr><td class="destaque"><strong>Cliente:</strong></td><td> '.$pedido['User']['name'].'</td></tr>';
            $html .= '<tr><td class="destaque"><strong>Data do pedido:</strong></td><td> '.date('d/m/Y H:m:s', strtotime($pedido['Pedido']['created'])).'</td></tr>';
            
            $html .= '<tr><td class="destaque" style="vertical-align:top"><strong>Endereço:</strong></td><td> '.$endereco.'</td></tr>';
            $html .= '<tr><td> </td><td> </td></tr>';
            
            
            $html .= '<tr><td class="destaque" style="vertical-align:top"><strong>Itens do pedido:</strong></td><td> '.$table_itens.'</td></tr>';
            $html .= '<tr><td class="destaque"><strong>Frete '.$tipo_correio.':</strong></td><td> R$ '.number_format($pedido['Pedido']['frete'],2, ',', '.').'</td></tr>';
            $html .= '<tr><td class="destaque"><strong>Total:</strong></td><td> R$ '.number_format($valor_total,2, ',', '.').'</td></tr>';
            
            $html .= '</table></body></html>';
            $mpdf->WriteHTML($html);
            $mpdf->Output('pedido_'.$id.'.pdf', 'I');
        }



}
?>