<?php
class FotoheadersController extends AppController {
	var $name = 'Fotoheaders';
	function index() {
                $this->set('content_title', 'Fotos do header');
		$this->Fotoheader->recursive = 0;
		$this->set('fotoheaders', $this->paginate());
	}
	function view($id = null) {
            $this->set('content_title', 'Visualizar foto');
		if (!$id) {
			$this->Session->setFlash(__('Invalid fotoheader', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fotoheader', $this->Fotoheader->read(null, $id));
	}
	function add() {
            $this->set('content_title', 'Inserir foto de header');
		if (!empty($this->data)) {
			$this->Fotoheader->create();
			if ($this->Fotoheader->save($this->data)) {
                                $fotoheader_id = $this->Fotoheader->getInsertId();
                                //salvar a imagem
                                $foto = $this->data['Fotoheader']['foto'];
                                if(!empty($foto)) {
                                        if($foto['error'] == 0){
                                                $extensao = substr(strrchr($foto['name'], '.'), 1 );
                                                $datetime = date('YmdHms');
                                                $nome_arquivo = 'header_foto_'.$fotoheader_id.'_'.$datetime.'.'.$extensao;
                                                $nome_arquivo_mini = 'header_foto_'.$fotoheader_id.'_'.$datetime.'_mini.'.$extensao;
                                                $result = $this->uploadFiles('header', array($foto), null, array($nome_arquivo), false, null, $nome_arquivo_mini, 200);
                                                //gravar o nome da primeira imagem nos dados do produto
                                                $this->data['Fotoheader']['img'] = $nome_arquivo;
                                                $this->data['Fotoheader']['img_mini'] = $nome_arquivo_mini;
                                                $this->data['Fotoheader']['id'] = $fotoheader_id;
                                                $this->Fotoheader->save($this->data);
                                        }
                                }
				$this->Session->setFlash(__('Foto salva', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Foto não salva. Tente novamente', true));
			}
		}
	}
	function edit($id = null) {
            $this->set('content_title', 'Editar foto');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fotoheader', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                        //salvar a imagem
                        $foto = $this->data['Fotoheader']['foto'];
                        if(!empty($foto)) {
                                if($foto['error'] == 0){
                                        $extensao = substr(strrchr($foto['name'], '.'), 1 );
                                        $datetime = date('YmdHms');
                                        $nome_arquivo = 'header_foto_'.$this->data['Fotoheader']['id'].'_'.$datetime.'.'.$extensao;
                                        $nome_arquivo_mini = 'header_foto_'.$this->data['Fotoheader']['id'].'_'.$datetime.'_mini.'.$extensao;
                                        $result = $this->uploadFiles('header', array($foto), null, array($nome_arquivo), false, null, $nome_arquivo_mini, 200);
                                        //gravar o nome da primeira imagem nos dados do produto
                                        $this->data['Fotoheader']['img'] = $nome_arquivo;
                                        $this->data['Fotoheader']['img_mini'] = $nome_arquivo_mini;
                                }
                        }
			if ($this->Fotoheader->save($this->data)) {
				$this->Session->setFlash(__('Foto salva', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Foto não salva. Tente novamente', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fotoheader->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Fotoheader->delete($id)) {
			$this->Session->setFlash(__('Foto removida', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Foto não pode ser removida. Tente novamente', true));
		$this->redirect(array('action' => 'index'));
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
	}
}
?>