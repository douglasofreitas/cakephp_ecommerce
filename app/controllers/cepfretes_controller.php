<?php
class CepfretesController extends AppController {
	var $name = 'Cepfretes';
	var $uses = array('CepFrete');
	function index() {
                $this->set('content_title', 'CEPs e fretes');
		$this->CepFrete->recursive = 0;
		$this->set('cepfretes', $this->paginate());
	}
	function add(){
		$this->set('content_title', 'Cadastrar faixa de CEP');
                if (!empty($this->data)) {
			$this->CepFrete->create();
			if ($this->CepFrete->save($this->data)) {
				$this->Session->setFlash(__('CEPs salvos', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('CEPs não salvos. Tente novamente', true));
			}
		}
	}
        function edit($id = null){
                if (!$id) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('content_title', 'Editar faixa de CEP');
                if (!empty($this->data)) {
			$this->CepFrete->create();
			if ($this->CepFrete->save($this->data)) {
				$this->Session->setFlash(__('CEPs salvos', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('CEPs não salvos. Tente novamente', true));
			}
		}
                $this->data = $this->CepFrete->read(null, $id);
	}
        function view($id = null){
                if (!$id) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action'=>'index'));
		}
                $this->set('content_title', 'Visualizar faixa de CEP');
                $cepfrete = $this->CepFrete->read(null, $id);
                $this->set('cepfrete', $cepfrete );
        }
        function delete($id = null){
		if (!$id) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CepFrete->delete($id)) {
			$this->Session->setFlash(__('Faixa de CEP removida', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Faixa de CEP não removida. Tente novamente', true));
		$this->redirect(array('action' => 'index'));
	}
	function beforeFilter() {
		parent::beforeFilter(); 
                //$this->Auth->allow(array('quem_somos', 'troca_devolucao', 'politica_privacidade'));
		$this->set('nameSession', 'manage');
		$this->set('controller_name', 'home');
	}
}
?>