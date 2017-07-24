<?php
class SubcategoriasController extends AppController {
	var $name = 'Subcategorias';
	function index() {
		$this->set('content_title', 'Subcategorias');
		$this->Subcategoria->recursive = 0;
		$subcategorias = $this->Subcategoria->find('all', array('conditions' => array(), 
												'recursive' => '1'));
		$this->set('subcategorias', $subcategorias);
	}
	function view($id = null) {
		$this->set('content_title', 'Visualizar Subcategoria');
		if (!$id) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action' => 'index'));
		}
                $subcategoria = $this->Subcategoria->read(null, $id);
		//obter as subcategorias
		$modelos = $this->Subcategoria->Modelo->find('all', 
			array('conditions' => array('Modelo.subcategoria_id' => $id), 
			'recursive' => '1'));
		$this->set('subcategoria', $subcategoria);
		$this->set('modelos', $modelos);
	}
	function add($categoria_id = null) {
		$this->set('content_title', 'Cadastrar Subcategoria');
		if (!empty($this->data)) {
			$this->Subcategoria->create();
			if ($this->Subcategoria->save($this->data)) {
				$this->Session->setFlash(__('Subcategoria cadastrada.', true));
				$this->redirect('/categorias/view/'.$this->data['Subcategoria']['categoria_id']);
			} else {
				$this->Session->setFlash(__('Subcategoria não pode ser cadastrada. Entre em contato com o suporte.', true));
			}
		}
		$categorias = $this->Subcategoria->Categoria->find('all', array('conditions' => array(), 
												'recursive' => '1'));
		$select_categorias = array();
		foreach ($categorias as $item){
			$select_categorias[$item['Categoria']['id']] = $item['Categoria']['nome'];
		}										
                if(empty($categoria_id))
                    $categoria_id = '';
                $this->set('categoria_id', $categoria_id);
                $this->set('select_categorias', $select_categorias);
	}
	function edit($id = null) {
		$this->set('content_title', 'Editar Subcategoria');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subcategoria->save($this->data)) {
				$this->Session->setFlash(__('Subcategoria editada.', true));
				$this->redirect('/categorias/view/'.$this->data['Subcategoria']['categoria_id']);
			} else {
				$this->Session->setFlash(__('Subcategoria não pode ser editada. Entre em contato com o suporte.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subcategoria->read(null, $id);
		}
		$categorias = $this->Subcategoria->Categoria->find('all', array('conditions' => array(), 
												'recursive' => '1'));
		$select_categorias = array();
		foreach ($categorias as $item){
			$select_categorias[$item['Categoria']['id']] = $item['Categoria']['nome'];
		}										
		$this->set('select_categorias', $select_categorias);
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subcategoria->delete($id)) {
			$this->Session->setFlash(__('Subcategoria removida', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subcategoria não pode ser removida, pois há fotos/produtos cadastrados nesta subcategoria', true));
		$this->redirect(array('action' => 'index'));
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(array('ajax_subcategoria'));
		$this->set('nameSession', 'manage');
	}
	function ajax_subcategoria(){
		$this->layout = null;
		$subcategorias = $this->Subcategoria->find('all', array('conditions' => array('categoria_id' => $this->params['form']['categoria_id']), 
												'recursive' => '0'));
		//gerar lista de países
		$select_subcategorias = array();
		foreach ($subcategorias as $sub){
			$select_subcategorias[$sub['Subcategoria']['id']] = $sub['Subcategoria']['nome'];
		}
		$empty = false;
		$add = false;
                $onlyfield = false;
		$model = 'Model';
		if($this->params['form']['empty'] == 'true')
                    $empty = true;
		if($this->params['form']['add'] == 'true')
                    $add = true;
                if(isset($this->params['form']['onlyfield'])){
                    $onlyfield = true;
                    $this->set('onlyfield', $onlyfield);
                }			
		if(isset($this->params['form']['model']))
			$model = $this->params['form']['model'];
		$this->set('empty', $empty);
		$this->set('add', $add);
		$this->set('model', $model);
                $this->set('categoria_id', $this->params['form']['categoria_id']);
		$this->set(compact('select_subcategorias'));
	}
        function ajax_add() {
            $this->layout = null;
            $nome = $this->params['form']['nome'];
            $categoria_id = $this->params['form']['categoria_id'];
            
            $subcategoria = array();
            $subcategoria['Subcategoria']['categoria_id'] = $categoria_id;
            $subcategoria['Subcategoria']['nome'] = $nome;
            
            if ($this->Subcategoria->save($subcategoria)) {
                echo '1';
            } else {
                echo '0';    
            }
            $this->render('branco');
	}
}
?>