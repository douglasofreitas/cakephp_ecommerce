<?php
class ItempedidosController extends AppController {
	var $name = 'Itempedidos';
	function index() {
		$this->Itempedido->recursive = 0;
		$this->set('itempedidos', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid itempedido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('itempedido', $this->Itempedido->read(null, $id));
	}
	/*
	 * Criar um item de pedido do produto selecionado e redirecionar o usuário para visualizar o Pedido atual.
	 */
	function add($produto_id = null) {
		if ($produto_id == null) {
			$this->Session->setFlash(__('Produto inválido', true));
			$this->redirect('/produtos');
		}
                //verifica se pode adicionar o produto no carrinho.
                if($this->config_sistema['Configuracao']['ativa_compras'] == 0){
                    $this->Session->setFlash(__('Compra não ativado. Necessita configurar o meio de pagamento com o administrador', true));
                    $this->redirect('/produtos/view/'.$produto_id);
                }
                if(empty($_POST['tamanhoid']))
                    $tamanho_id = null;
                else
                    $tamanho_id = $_POST['tamanhoid'];
                if(empty($_POST['corid']))
                    $cor_id = null;
                else
                    $cor_id = $_POST['corid'];
		//Obtem os dados do produto
		//$produto = $this->Itempedido->Produto->read(null, $produto_id);
		$produto = $this->Itempedido->Produto->find('first', array('conditions' => array('Produto.id' => $produto_id), 
												'recursive' => '1'));
//		
//                $this->debugVar($produto);
//                
		if($produto){
                    $produtoquantidade_id = $this->Itempedido->Produto->tem_estoque($produto['Produto']['id'], $cor_id, $tamanho_id);
                    if(!empty($produtoquantidade_id)){
                        //adiciona o produto no carrinho
			//Verifica se já há um pedido criado
			if($this->Session->check('Pedido')){
                            $pedido = $this->Session->read('Pedido');
			}
                        if(empty($pedido)){
                            //cria um novo pedido
                            $pedido = $this->Itempedido->Pedido->cria_novo_pedido();
                            //verifica se teve sucesso na criação do pedido.
                            if(empty($pedido)){
                                $this->Session->setFlash(__('Erro ao adicionar o produto', true));
                                $this->redirect('/produtos/view/'.$produto_id);
                            }
                        }
			//cria o item ao pedido
			$item = $this->Itempedido->cria_item($pedido, $produto, $produtoquantidade_id);
			if($item == false)
				$this->Session->setFlash(__('Este produto já está na cesta.', true));
			else{
                                //obtem o pedido atualizado
                                $pedido = $this->Itempedido->Pedido->read(null, $pedido['Pedido']['id']);
				$this->Session->write('Pedido', $pedido);
			}
			$this->redirect('/pedidos/atual');
                    }
		}else{
			$this->Session->setFlash(__('Produto inválido', true));
			$this->redirect('/produtos');
		}
		$this->redirect('/pedidos/atual');
	}
	function alterar_quantidade(){
		if (!empty($this->data)) {
                        //validar o itempedido
			$itempedido = $this->Itempedido->read(null, $this->data['Itempedido']['id']);
                        if(empty($itempedido )){
                            $this->Session->setFlash(__('Item inválido', true));
                            $this->redirect('/pedidos/atual');
                        }
                        //verificar se houve alteração
                        $pedido = $this->Session->read('Pedido');
                        foreach($pedido['Itempedido'] as $item){
                            if($itempedido['Itempedido']['id'] == $item['id']){
                                if($this->data['Itempedido']['quantidade'] == $item['quantidade']){
                                    //não houve modificação
                                    $this->Session->setFlash(__('Não houve modificação na quantidade do produto', true));
                                    $this->redirect('/pedidos/atual');
                                }
                            }
                        }
                        $produto_id = $this->data['Itempedido']['produto_id'];
			$quantidade = $this->data['Itempedido']['quantidade'];
                        $produtoquantidade_id = $this->data['Itempedido']['produtoquantidade_id'];
                        //atualiza quantidade
                        $quantidade_nova = $this->Itempedido->atualiza_quantidade($this->data['Itempedido']['id'], $quantidade);
                        if(empty($quantidade_nova)){
                            $this->Session->setFlash(__('Não foi possível alterar a quantidade', true));
                        }else{
                            if($quantidade_nova < $quantidade){
                                $this->Session->setFlash(__('Estoque insuficiente para a quantidade desejada. Veja a quantidade atualizada', true));
                            }else{
                                $this->Session->setFlash(__('Quantidade do produto atualizado', true));
                            }
                        }
                        $pedido = $this->Itempedido->Pedido->read(null, $pedido['Pedido']['id']);
			$this->Session->write('Pedido', $pedido);
			$this->redirect('/pedidos/atual');
		}else{
			$this->Session->setFlash(__('Dados inválidos', true));
			$this->redirect('/pedidos/atual');
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid itempedido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Itempedido->save($this->data)) {
				$this->Session->setFlash(__('The itempedido has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The itempedido could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Itempedido->read(null, $id);
		}
		//$produtos = $this->Itempedido->Produto->find('list');
		//$pedidos = $this->Itempedido->Pedido->find('list');
		//$users = $this->Itempedido->User->find('list');
		$this->set(compact('produtos', 'pedidos', 'users'));
	}
	function delete($produto_id = null) {
		if (!$produto_id) {
			$this->Session->setFlash(__('Produto inválido', true));
			$this->redirect('/pedidos/atual');
		}
		//Verifica se já há um pedido criado
		if($this->Session->check('Pedido')){
			$pedido = $this->Session->read('Pedido');
			$pedido_id = $pedido['Pedido']['id'];
		}else{
			$this->Session->setFlash(__('Não há pedido de compra', true));
			$this->redirect('/pedidos/atual');
		}
		//Remove item
		if(!$this->Itempedido->remove_item($pedido, $produto_id)){
                    //erro ao remover o item
                    $this->Session->setFlash(__('Falha ao remover o item. Tente novamente', true));
                    $this->redirect('/pedidos/atual');
                }else{
                    $this->Session->setFlash(__('Item removido', true));
                }
                
                //atualiza o pedido na sessão
                $pedido = $this->Itempedido->Pedido->read(null, $pedido['Pedido']['id']);
                $this->Session->write('Pedido', $pedido);
                
		$this->redirect('/pedidos/atual');
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(array('*'));
		$this->set('nameSession', 'usuario');
	}
}
?>