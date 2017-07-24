<?php
class ComentariosController extends AppController {
	var $name = 'Comentarios';
	function index() {
            $this->set('content_title', 'Comentários');
		$this->Comentario->recursive = 0;
		$this->set('comentarios', $this->paginate());
	}
	function view($id = null) {
            $this->set('content_title', 'Visualizar comentário');
		if (!$id) {
			$this->Session->setFlash(__('Comentário inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('comentario', $this->Comentario->read(null, $id));
	}
	function add() {
            $this->set('content_title', 'Cadastrar comentário');
		if (!empty($this->data)) {
			$this->Comentario->create();
                        $this->data['Comentario']['aprovado'] = 1;
                        $this->data['Comentario']['user_id'] = $this->Auth->user('id');
                        if ($this->Comentario->save($this->data)) {
				$this->Session->setFlash(__('Obrigado pelo seu comentário! Continue vendo nossos produtos!', true));
                                
                        //enviar e-mail para administradora do site
                        if(!empty($this->data['Produto']['produto'])){
                            $produto = $this->Produto->read(null, $this->data['Comentario']['produto_id']);
                            $produto_link = $this->config_sistema['Configuracao']['site_url'].'/produtos/view/'.$produto['Produto']['id'];
                            $produto_nome = $produto['Produto']['nome'];

                            $array_mesclagem = array();
                            $array_mesclagem['link'] = $produto_link;
                            $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_empresa'];
                            $this->envia_email($this->config_sistema['Configuracao']['nome_empresa'], $this->config_sistema['Configuracao']['email'], 'Novo comentário: '.$produto_nome ,'comentario_notifica', $array_mesclagem);

                        }


                        //se for para um produto, redirecionar para a view do produto
                        if(!empty($this->data['Comentario']['produto_id'])){
                            $this->redirect('/produtos/view/'.$this->data['Comentario']['produto_id']);
                        }
                                
				$this->redirect('/produtos/index');
			} else {
				$this->Session->setFlash(__('Comentário não foi salvo. Tente novamente', true));
			}
		}
		$this->set('action', 'add');
                $this->render('comentario');
	}
	function edit($id = null) {
            $this->set('content_title', 'Editar comentário');
			if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Comentário inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comentario->save($this->data)) {
				$this->Session->setFlash(__('Comentário salvo', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Comentário não foi salvo. Tente novamente', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comentario->read(null, $id);
		}
		$this->set('action', 'edit');
                $this->render('comentario');
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Comentário inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comentario->delete($id)) {
			$this->Session->setFlash(__('Comentário removido', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Comentário não pode ser removido', true));
		$this->redirect(array('action' => 'index'));
	}

    function notifica() {
        $this->layout = null;


        preg_match('/view\/([^\/]*)\//', urldecode($this->params['form']['link']), $m );

        echo $m[1];

        $this->Comentario->create();
        $data['Comentario']['aprovado'] = 1;
        $data['Comentario']['produto_id'] = $m[1];
        $data['Comentario']['descricao'] = urldecode($this->params['form']['link']);
        $this->Comentario->save($data);

        echo 'ok';

        $array_mesclagem = array();
        //$array_mesclagem['link'] = 'http://homesample.com.br/produtos/view/'.$m[1];		$array_mesclagem['link'] = urldecode($this->params['form']['link']);
        $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_empresa'];
        $this->envia_email($this->config_sistema['Configuracao']['nome_empresa'], $this->config_sistema['Configuracao']['email'], 'Novo comentário em '.date('d/m/Y G:i') ,'comentario_notifica', $array_mesclagem);

        $this->render('branco');
    }

	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(array('add', 'notifica'));
		$this->set('nameSession', 'manage');
                $this->set('controller_name', 'comentarios');
	}
}
?>