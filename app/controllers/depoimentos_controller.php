<?php
class DepoimentosController extends AppController {
	var $name = 'Depoimentos';
    var $components = array('Captcha');

	function index() {
                $this->set('content_title', 'Depoimentos');
            
                $conditions = array();
                
                if($this->Auth->user('group_id') != 1){
                    $conditions = array('Depoimento.aprovado' => 1);
                }
                
		$this->Depoimento->recursive = 1;
		$this->set('depoimentos', $this->paginate('Depoimento', $conditions));

        $this->create_captcha();
                
                if($this->Auth->user('group_id') != 1){
			$this->render('index_cliente');
		}
	}
	function view($id = null) {
            $this->set('content_title', 'Visualizar depoimento');
		if (!$id) {
			$this->Session->setFlash(__('Depoimento inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('depoimento', $this->Depoimento->read(null, $id));
	}
	function add() {
            $this->set('content_title', 'Cadastrar depoimento');
		if (!empty($this->data)) {
			$this->Depoimento->create();
                        
            $this->data['Depoimento']['user_id'] = $this->Auth->user('id');

            if($this->data['Depoimento']['ver_code']==$this->Session->read('ver_code')){
                if ($this->Depoimento->save($this->data)) {

                    $depoimento_id = $this->Depoimento->getInsertId();
                    //gravar as fotos do depoimento
                    $count = 0;
                    if(isset($this->data['Depoimento']['foto']))
                    foreach ($this->data['Depoimento']['foto'] as $foto){
                        if(!empty($foto)) {
                            if($foto['error'] == 0){
                                $extensao = substr(strrchr($foto['name'], '.'), 1 );
                                $datetime = date('YmdHms');
                                $nome_arquivo = 'depoimento_'.$depoimento_id.'_'.$datetime.$count.'.'.$extensao;
                                //$nome_arquivo_mini = 'produto_'.$produto_id.'_'.$datetime.$count.'_mini.'.$extensao;
                                $result = $this->uploadFiles('fotos', array($foto), null, array($nome_arquivo), true, 800);
                                //gravar o nome da primeira imagem nos dados do produto

                                //gravar endereço de imagem no banco
                                $data_image = array();
                                $data_image['DepoimentoFoto']['depoimento_id'] = $depoimento_id;
                                $data_image['DepoimentoFoto']['nome'] = $nome_arquivo;
                                $this->Depoimento->DepoimentoFoto->create();
                                $this->Depoimento->DepoimentoFoto->save($data_image);
                                $count++;
                            }
                        }
                    }

                    $array_mesclagem = array();
                    $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_empresa'];
                    $this->envia_email($this->config_sistema['Configuracao']['nome_empresa'], $this->config_sistema['Configuracao']['email'], 'Novo depoimento ' ,'depoimento_notifica', $array_mesclagem);


                    if($this->Auth->user('group_id') != 1)
                        $this->Session->setFlash(__('Obrigado pelo depoimento. Após avaliar-mos o depoimento liberaremos ao público', true));
                    else
                        $this->Session->setFlash(__('Depoimento salvo', true));

                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Depoimento não foi salvo. Tente novamente', true));
                }
            }else{
                $this->Session->setFlash('Código de verificação incorreto.');
                $this->redirect('index');
            }


		}
                $this->set('action', 'add');
                $this->render('depoimento');
	}
	function edit($id = null) {
            $this->set('content_title', 'Editar depoimento');
			if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid depoimento', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Depoimento->save($this->data)) {

                $depoimento_id = $this->data['Depoimento']['id'];
                //gravar as fotos do depoimento
                $count = 0;
                foreach ($this->data['Depoimento']['foto'] as $foto){
                    if(!empty($foto)) {
                        if($foto['error'] == 0){
                            $extensao = substr(strrchr($foto['name'], '.'), 1 );
                            $datetime = date('YmdHms');
                            $nome_arquivo = 'depoimento_'.$depoimento_id.'_'.$datetime.$count.'.'.$extensao;
                            //$nome_arquivo_mini = 'produto_'.$produto_id.'_'.$datetime.$count.'_mini.'.$extensao;
                            $result = $this->uploadFiles('fotos', array($foto), null, array($nome_arquivo), true, 800);
                            //gravar o nome da primeira imagem nos dados do produto

                            //gravar endereço de imagem no banco
                            $data_image = array();
                            $data_image['DepoimentoFoto']['depoimento_id'] = $depoimento_id;
                            $data_image['DepoimentoFoto']['nome'] = $nome_arquivo;
                            $this->Depoimento->DepoimentoFoto->create();
                            $this->Depoimento->DepoimentoFoto->save($data_image);
                            $count++;
                        }
                    }
                }


                $this->Session->setFlash(__('Depoimento salvo', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Depoimento não foi salvo. Tente novamente', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Depoimento->read(null, $id);
		}
                $this->set('action', 'edit');
                $this->render('depoimento');
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Depoimento inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Depoimento->delete($id)) {
			$this->Session->setFlash(__('Depoimento removido', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Depoimento não pode ser removido', true));
		$this->redirect(array('action' => 'index'));
	}

    function remover_foto($foto_id){
        $foto = $this->Depoimento->DepoimentoFoto->read(null, $foto_id);

        if($this->Depoimento->DepoimentoFoto->delete($foto['DepoimentoFoto']['id'])){
            $this->Session->setFlash(__('Foto removida', true));
        }

        $this->redirect('edit/'.$foto['DepoimentoFoto']['depoimento_id']);
    }

	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(array('index', 'view', 'add', 'remover_foto'));
		
                
                $this->set('nameSession', 'manage');
		$this->set('controller_name', 'depoimentos');
	}

    function create_captcha()	{
        //App::import("Component","Captcha"); //including captcha class
        $this->Captcha =  new CaptchaComponent(); //creating an object instance
        $this->Captcha->controller = & $this; //assign this conroller(CaptchaController) object to its captcha object's controller property.
        $this->set('captcha_src',$captcha_src=$this->Captcha->create()); //create a capthca and assign to a variable
    }
}
?>