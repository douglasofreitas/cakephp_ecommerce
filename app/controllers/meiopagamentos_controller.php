<?php
class MeiopagamentosController extends AppController {
	var $name = 'Meiopagamentos';
	function index() {
		$this->Meiopagamento->recursive = 0;
		$this->set('meiopagamentos', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid meiopagamento', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('meiopagamento', $this->Meiopagamento->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Meiopagamento->create();
			if ($this->Meiopagamento->save($this->data)) {
				$this->Session->setFlash(__('The meiopagamento has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The meiopagamento could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid meiopagamento', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Meiopagamento->save($this->data)) {
				$this->Session->setFlash(__('The meiopagamento has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The meiopagamento could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Meiopagamento->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for meiopagamento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Meiopagamento->delete($id)) {
			$this->Session->setFlash(__('Meiopagamento deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Meiopagamento was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
	}
}
?>