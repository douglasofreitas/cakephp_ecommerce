<?php
class StatuspedidosController extends AppController {
	var $name = 'Statuspedidos';
	function index() {
		$this->Statuspedido->recursive = 0;
		$this->set('statuspedidos', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid statuspedido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('statuspedido', $this->Statuspedido->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Statuspedido->create();
			if ($this->Statuspedido->save($this->data)) {
				$this->Session->setFlash(__('The statuspedido has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The statuspedido could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid statuspedido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Statuspedido->save($this->data)) {
				$this->Session->setFlash(__('The statuspedido has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The statuspedido could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Statuspedido->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for statuspedido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Statuspedido->delete($id)) {
			$this->Session->setFlash(__('Statuspedido deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Statuspedido was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
	}
}
?>