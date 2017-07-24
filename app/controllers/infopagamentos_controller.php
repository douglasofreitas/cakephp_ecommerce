<?php
/*
 * AINDA NÃO IMPLEMENTADO
 */
class InfopagamentosController extends AppController {
	var $name = 'Infopagamentos';
	function index() {
		$this->Infopagamento->recursive = 0;
		$this->set('infopagamentos', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid infopagamento', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('infopagamento', $this->Infopagamento->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Infopagamento->create();
			if ($this->Infopagamento->save($this->data)) {
				$this->Session->setFlash(__('The infopagamento has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The infopagamento could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Infopagamento->User->find('list');
		$faturas = $this->Infopagamento->Fatura->find('list');
		$this->set(compact('users', 'faturas'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid infopagamento', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Infopagamento->save($this->data)) {
				$this->Session->setFlash(__('The infopagamento has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The infopagamento could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Infopagamento->read(null, $id);
		}
		$users = $this->Infopagamento->User->find('list');
		$faturas = $this->Infopagamento->Fatura->find('list');
		$this->set(compact('users', 'faturas'));
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for infopagamento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Infopagamento->delete($id)) {
			$this->Session->setFlash(__('Infopagamento deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Infopagamento was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'usuario');
	}
}
?>