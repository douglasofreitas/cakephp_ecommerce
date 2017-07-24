<?php
class ModelosController extends AppController {
	var $name = 'Modelos';
	function index() {
            $this->set('content_title', 'Modelos');
		$this->Modelo->recursive = 0;
		$this->set('modelos', $this->paginate());
	}
	function view($id = null) {
            $this->set('content_title', 'Visualizar modelo');
		if (!$id) {
			$this->Session->setFlash(__('Invalid modelo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('modelo', $this->Modelo->read(null, $id));
	}
	function add($subcategoria_id = null) {
            $this->set('content_title', 'Cadastrar modelo');
		if (!empty($this->data)) {
			$this->Modelo->create();
			if ($this->Modelo->save($this->data)) {
				$this->Session->setFlash(__('Modelo cadastrado', true));
				$this->redirect('/subcategorias/view/'.$this->data['Modelo']['subcategoria_id']);
			} else {
				$this->Session->setFlash(__('Modelo não foi cadastrado. Tente novamente', true));
			}
		}
                $subcategoria = $this->Modelo->Subcategoria->find('first', array('conditions' => array('Subcategoria.id' => $subcategoria_id), 
												'recursive' => '0'));
		$this->set(compact('subcategoria'));
	}
	function edit($id = null) {
            $this->set('content_title', 'Editar modelo');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid modelo', true));
			$this->redirect('/categorias');
		}
		if (!empty($this->data)) {
			if ($this->Modelo->save($this->data)) {
				$this->Session->setFlash(__('Modelo editado', true));
				$this->redirect('/subcategorias/view/'.$this->data['Modelo']['subcategoria_id']);
			} else {
				$this->Session->setFlash(__('Modelo não foi editado. Tente novamente', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Modelo->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for modelo', true));
			$this->redirect('/categorias');
		}
		$modelo = $this->Modelo->read(null, $id);
		if ($this->Modelo->delete($id)) {
			$this->Session->setFlash(__('Modelo removido', true));
			$this->redirect('/subcategorias/view/'.$modelo['Modelo']['subcategoria_id']);
		}
		$this->Session->setFlash(__('Modelo não pode ser removido, pois á produtos cadastrados nele', true));
		$this->redirect('/produtos/view/'.$modelo['Modelo']['produto_id']);
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(array('ajax_modelo'));
		$this->set('nameSession', 'manage');
	}
        function ajax_modelo(){
		$this->layout = null;
		$modelos = $this->Modelo->find('all', array('conditions' => array('subcategoria_id' => $this->params['form']['subcategoria_id']), 
												'recursive' => '0'));
		$select_modelos = array();
		foreach ($modelos as $mod){
			$select_modelos[$mod['Modelo']['id']] = $mod['Modelo']['nome'];
		}
		$empty = false;
		$add = false;
                $onlyfield = false;
		$model = 'Model';
		if(isset($this->params['form']['empty']))
                    if($this->params['form']['empty'])
			$empty = true;
		if(isset($this->params['form']['add']))
                    if($this->params['form']['add'])
			$add = true;
                if(isset($this->params['form']['onlyfield'])){
			$onlyfield = true;
                        $this->set('onlyfield', $onlyfield);
                }
		if(!empty($this->params['form']['model']))
			$model = $this->params['form']['model'];
		$this->set(compact('select_modelos', 'model', 'add', 'empty'));
                $this->set('subcategoria_id', $this->params['form']['subcategoria_id']);
	}
        function ajax_add() {
            $this->layout = null;
            $nome = $this->params['form']['nome'];
            $subcategoria_id = $this->params['form']['subcategoria_id'];
            
            $modelo = array();
            $modelo['Modelo']['subcategoria_id'] = $subcategoria_id;
            $modelo['Modelo']['nome'] = $nome;
            
            if ($this->Modelo->save($modelo)) {
                echo '1';
            } else {
                echo '0';    
            }
            $this->render('branco');
	}
}
?>