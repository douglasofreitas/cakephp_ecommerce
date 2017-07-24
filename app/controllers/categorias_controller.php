<?php
class CategoriasController extends AppController {
	var $name = 'Categorias';
	function index() {
		$this->set('content_title', 'Categorias');
		$this->Categoria->recursive = 0;
		$categorias = $this->Categoria->find('all', array('conditions' => array(), 
												'recursive' => '1'));
		$this->set('categorias', $categorias);
	}
	function view($id = null) {
		$this->set('content_title', 'Visualizar Categoria');
		if (!$id) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$categoria = $this->Categoria->read(null, $id);
		//obter as subcategorias
		$subcategorias = $this->Categoria->Subcategoria->find('all', 
			array('conditions' => array('Subcategoria.categoria_id' => $id), 
			'recursive' => '1'));
		$this->set('categoria', $categoria);
		$this->set('subcategorias', $subcategorias);
	}
	function add() {
		$this->set('content_title', 'Cadastrar Categoria');
		if (!empty($this->data)) {
			$this->Categoria->create();
			if ($this->Categoria->save($this->data)) {
				$this->Session->setFlash(__('Categoria cadastrada.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Categoria não pode ser cadastrada. Entre em contato com o suporte.', true));
			}
		}
	}
	function edit($id = null) {
		$this->set('content_title', 'Editar Categoria');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Categoria->save($this->data)) {
				$this->Session->setFlash(__('Categoria editada.', true));
				$this->redirect(array('action' => 'view/'.$this->data['Categoria']['id']));
			} else {
				$this->Session->setFlash(__('Categoria não pode ser editada. Entre em contato com o suporte.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Categoria->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Categoria->delete($id)) {
			$this->Session->setFlash(__('Categoria removida.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Categoria não pode ser removida, pois há fotos/produtos cadastrados nesta categoria.', true));
		$this->redirect(array('action' => 'index'));
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
	}
}
?>