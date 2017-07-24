<?php
class EmaillojasController extends AppController {
	var $name = 'Emaillojas';
	function index() {
            $this->set('content_title', 'E-mails do sistema');
            $this->Emailloja->recursive = 0;
            $this->set('emaillojas', $this->Emailloja->find('all'));
	}
        function edit($id = null) {
            $this->set('content_title', 'Editar corpo de e-mail');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('E-mail inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Emailloja->save($this->data)) {
				$this->Session->setFlash(__('E-mail salvo', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('E-mail não salvo, por favor tente novamente', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Emailloja->read(null, $id);
		}
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
		$this->set('controller_name', 'home');
	}
}
?>