<?php
class MarcasController extends AppController {
	var $name = 'Marcas';
	function index() {
                $this->set('content_title', 'Marcas');
		$this->Marca->recursive = 1;
		$this->set('marcas', $this->Marca->find('all'));
	}
	function view($id = null) {
                $this->set('content_title', 'Visualizar marca');
		if (!$id) {
			$this->Session->setFlash(__('Invalid Marca', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('Marca', $this->Marca->read(null, $id));
	}
	function add() {
                $this->set('content_title', 'Cadastrar marca');
		if (!empty($this->data)) {
			$this->Marca->create();
			if ($this->Marca->save($this->data)) {
				$this->Session->setFlash(__('Marca cadastrada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Marca não foi cadastrada. tente novamente ou entre em contato com o técnico.', true));
			}
		}
//		$marcas = $this->Marca->Produto->find('list');
//		$this->set(compact('marcas'));
	}
	function edit($id = null) {
                $this->set('content_title', 'Editar marca');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Marca inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Marca->save($this->data)) {
				$this->Session->setFlash(__('Marca salva', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Marca não foi salva. tente novamente ou entre em contato com o técnico.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Marca->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Marca', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Marca->delete($id)) {
			$this->Session->setFlash(__('Marca removido', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
	}
}
?>