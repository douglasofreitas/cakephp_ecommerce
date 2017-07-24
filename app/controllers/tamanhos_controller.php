<?php
class TamanhosController extends AppController {
	var $name = 'Tamanhos';
	function index() {
		$this->Tamanho->recursive = 0;
		$this->set('modelos', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tamanho', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tamanho', $this->Tamanho->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Tamanho->create();
			if ($this->Tamanho->save($this->data)) {
                                $tamanho_id = $this->Tamanho->getInsertId();
                                //salvar as quantidades do produtos com as cores correspondentes
                                $cores = $this->Tamanho->Produto->Cor->find('all', array('conditions' => array('produto_id' => $this->data['Tamanho']['produto_id']), 'recursive' => -1 ));
                                if(!empty($cores)){
                                    foreach($cores as $cor){
                                        $array_produtoquantidade = array();
                                        $array_produtoquantidade['ProdutoQuantidade']['produto_id'] = $this->data['Tamanho']['produto_id'];
                                        $array_produtoquantidade['ProdutoQuantidade']['cor_id'] = $cor['Cor']['id'];
                                        $array_produtoquantidade['ProdutoQuantidade']['tamanho_id'] = $tamanho_id;
                                        $this->Tamanho->ProdutoQuantidade->create();
                                        $this->Tamanho->ProdutoQuantidade->save($array_produtoquantidade);
                                    }
                                }
				$this->Session->setFlash(__('Tamanho cadastrado', true));
				$this->redirect('/produtos/edit_quantidade/'.$this->data['Tamanho']['produto_id']);
			} else {
				$this->Session->setFlash(__('Tamanho não foi cadastrado. Tente novamente', true));
			}
		}
		$produtos = $this->Tamanho->Produto->find('list');
		$this->set(compact('produtos'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tamanho', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tamanho->save($this->data)) {
				$this->Session->setFlash(__('Tamanho editado', true));
				$this->redirect('/produtos/view_admin/'.$this->data['Tamanho']['produto_id']);
			} else {
				$this->Session->setFlash(__('The tamanho could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tamanho->read(null, $id);
		}
		$produtos = $this->Tamanho->Produto->find('list');
		$this->set(compact('produtos'));
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tamanho', true));
			$this->redirect(array('action'=>'index'));
		}
		$tamanho = $this->Tamanho->read(null, $id);
		if ($this->Tamanho->delete($id)) {
			$this->Session->setFlash(__('Tamanho removido', true));
			$this->redirect('/produtos/view_admin/'.$tamanho['Tamanho']['produto_id']);
		}
		$this->Session->setFlash(__('Tamanho não pode ser removido, pois á pedido feito com ele.', true));
		$this->redirect('/produtos/view/'.$tamanho['Tamanho']['produto_id']);
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
	}
}
?>