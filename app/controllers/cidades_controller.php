<?php
class CidadesController extends AppController {
	var $name = 'Cidades';
	function index() {
		$this->Fatura->recursive = 0;
		$this->set('faturas', $this->paginate());
	}
	function ajax_cidades(){
		$this->layout = null;
		$select_cidades = $this->Cidade->getFormSelect($this->params['form']['estado_id']);
		$this->set('select_cidades', $select_cidades);
		$this->set('model', $this->params['form']['model']);
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(array('ajax_cidades'));
		$this->set('nameSession', 'usuario');
	}
}
?>