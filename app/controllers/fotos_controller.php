<?php
class FotosController extends AppController {
	var $name = 'Fotos';
	function index() {
		$this->Foto->recursive = 0;
		$this->set('fotos', $this->paginate());
	}
	function view($id = null) {
		$this->layout = null;
		if (!$id) {
			$this->Session->setFlash(__('Invalid foto', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('foto', $this->Foto->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Foto->create();
			if ($this->Foto->save($this->data)) {
				$this->Session->setFlash(__('The foto has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The foto could not be saved. Please, try again.', true));
			}
		}
		$produtos = $this->Foto->Produto->find('list');
		$this->set(compact('produtos'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid foto', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Foto->save($this->data)) {
				$this->Session->setFlash(__('The foto has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The foto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Foto->read(null, $id);
		}
		$produtos = $this->Foto->Produto->find('list');
		$this->set(compact('produtos'));
	}
	function delete($id = null) {
		$foto = $this->Foto->read(null, $id);
		$produto = $this->Foto->Produto->find('first', array('conditions' => array('Produto.id' => $foto['Foto']['produto_id'])));
		if (!$id) {
			$this->Session->setFlash(__('Foto inválida', true));
			$this->redirect('/produtos/edit_photos/'.$foto['Foto']['produto_id']);
		}
		if ($this->Foto->delete($id)) {
                    //verificar se o produto ainda tem foto, senão deve deixar o campo em branco
                    $fotos_produto = $this->Foto->find('first', array('conditions' => array('Foto.produto_id' => $foto['Foto']['produto_id'])));
                    if(empty($fotos_produto)){
                        //apagar o nome do produto
                        $produto['Produto']['img'] = '';
                        $produto['Produto']['img_mini'] = '';
                    }else{
                        if($produto['Produto']['img_mini'] == $foto['Foto']['nome_img']){
                            $produto['Produto']['img'] = $fotos_produto['Foto']['nome'];
                            $produto['Produto']['img_mini'] = $fotos_produto['Foto']['nome_img'];
                        }
                    }
                    $this->Foto->Produto->save($produto);
                    $this->Session->setFlash(__('Foto removida', true));
                    $this->redirect('/produtos/edit_photos/'.$foto['Foto']['produto_id']);
		}
		$this->Session->setFlash(__('Foto não pode ser removida, por favor entrar em contato com o técnico', true));
		$this->redirect('/produtos/edit_photos/'.$foto['Foto']['produto_id']);
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
	}
}
?>