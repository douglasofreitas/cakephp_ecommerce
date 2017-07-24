<?php
class CorsController extends AppController {
	var $name = 'Cors';
	function index() {
		$this->Cor->recursive = 0;
		$this->set('modelos', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid cor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cor', $this->Cor->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Cor->create();
			if ($this->Cor->save($this->data)) {
                                $cor_id = $this->Cor->getInsertId();
                                //salvar as quantidades do produtos com as cores correspondentes
                                $tamanhos = $this->Cor->Produto->Tamanho->find('all', array('conditions' => array('produto_id' => $this->data['Cor']['produto_id']), 'recursive' => -1 ));
                                if(!empty($tamanhos)){
                                    foreach($tamanhos as $tamanho){
                                        $array_produtoquantidade = array();
                                        $array_produtoquantidade['ProdutoQuantidade']['produto_id'] = $this->data['Cor']['produto_id'];
                                        $array_produtoquantidade['ProdutoQuantidade']['tamanho_id'] = $tamanho['Tamanho']['id'];
                                        $array_produtoquantidade['ProdutoQuantidade']['cor_id'] = $cor_id;
                                        $this->Cor->ProdutoQuantidade->create();
                                        $this->Cor->ProdutoQuantidade->save($array_produtoquantidade);
                                    }
                                }
				$this->Session->setFlash(__('Cor cadastrada', true));
				$this->redirect('/produtos/edit_quantidade/'.$this->data['Cor']['produto_id']);
			} else {
				$this->Session->setFlash(__('The cor could not be saved. Please, try again.', true));
			}
		}
		$produtos = $this->Cor->Produto->find('list');
		$this->set(compact('produtos'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid cor', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cor->save($this->data)) {
				$this->Session->setFlash(__('Cor editada', true));
				$this->redirect('/produtos/view_admin/'.$this->data['Cor']['produto_id']);
			} else {
				$this->Session->setFlash(__('The cor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cor->read(null, $id);
		}
		$produtos = $this->Cor->Produto->find('list');
		$this->set(compact('produtos'));
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for cor', true));
			$this->redirect(array('action'=>'index'));
		}
		$cor = $this->Cor->read(null, $id);
		if ($this->Cor->delete($id)) {
			$this->Session->setFlash(__('Cor removida', true));
			$this->redirect('/produtos/view_admin/'.$cor['Cor']['produto_id']);
		}
		$this->Session->setFlash(__('Cor não pode ser removido, pois á pedido feito com ele.', true));
		$this->redirect('/produtos/view/'.$cor['Cor']['produto_id']);
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
	}
}
?>