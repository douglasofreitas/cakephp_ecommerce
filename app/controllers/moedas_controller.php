<?php
class MoedasController extends AppController {
	var $name = 'Moedas';
	function index() {
		$this->Moeda->recursive = 0;
		$this->set('moedas', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid moeda', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('moeda', $this->Moeda->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Moeda->create();
			if ($this->Moeda->save($this->data)) {
				$this->Session->setFlash(__('The moeda has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The moeda could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid moeda', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Moeda->save($this->data)) {
				$this->Session->setFlash(__('The moeda has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The moeda could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Moeda->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for moeda', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Moeda->delete($id)) {
			$this->Session->setFlash(__('Moeda deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Moeda was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
	}
}
?>