<?php
class StatusfaturasController extends AppController {
	var $name = 'Statusfaturas';
	function index() {
		$this->Statusfatura->recursive = 0;
		$this->set('statusfaturas', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid statusfatura', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('statusfatura', $this->Statusfatura->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Statusfatura->create();
			if ($this->Statusfatura->save($this->data)) {
				$this->Session->setFlash(__('The statusfatura has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The statusfatura could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid statusfatura', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Statusfatura->save($this->data)) {
				$this->Session->setFlash(__('The statusfatura has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The statusfatura could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Statusfatura->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for statusfatura', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Statusfatura->delete($id)) {
			$this->Session->setFlash(__('Statusfatura deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Statusfatura was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'usuario');
	}
}
?>