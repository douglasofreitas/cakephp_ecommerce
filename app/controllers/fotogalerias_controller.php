<?php
class FotogaleriasController extends AppController {
	var $name = 'Fotogalerias';
	function index() {
		$this->set('content_title', 'Galeria de fotos');
		if($this->Auth->user('group_id') != 1){
			$condicao = array();
		}else{
			$condicao = array('Fotogaleria.ativo' => 1);
		}
		$this->Fotogaleria->recursive = 0;
		$this->set('fotos', $this->paginate('Fotogaleria', $condicao));
	}
	function filtro() {
		if ($this->Session->check('Fotogaleria.filtro')) {
			$condicao = $this->Session->read('Fotogaleria.filtro');
			//$this->debugVar($condicao);
		}else{
			$this->redirect(array('action' => 'index'));
		}
		if($this->Auth->user('group_id') != 1){
			$condicao['Fotogaleria.ativo'] = 1;
		}
	 	$this->set('content_title', 'Galeria de fotos: '.$this->Session->read('Fotogaleria.nome_filtro'));
		$this->Fotogaleria->recursive = 0;
		$this->set('fotos', $this->paginate('Fotogaleria', $condicao));
	}
	function filtro_categoria($id) {
		$condition = array();
		$condition['Subcategoria.categoria_id'] = $id;
		$this->loadModel('Categoria');
		$categoria = $this->Categoria->find('first', array('conditions' => array('id' => $id), 
												'recursive' => '0'));
		$this->Session->write('Fotogaleria.filtro', $condition);
		$this->Session->write('Fotogaleria.nome_filtro', $categoria['Categoria']['nome']);
		$this->redirect(array('action' => 'filtro'));
	}
	function filtro_subcategoria($id) {
		$condition = array();
		$condition['Fotogaleria.subcategoria_id'] = $id;
		$subcategoria = $this->Fotogaleria->Subcategoria->find('first', array('conditions' => array('Subcategoria.id' => $id), 
												'recursive' => '0'));
		$this->Session->write('Fotogaleria.filtro', $condition);
		$this->Session->write('Fotogaleria.nome_filtro', $subcategoria['Categoria']['nome'].' - '.$subcategoria['Subcategoria']['nome']);
		$this->redirect(array('action' => 'filtro'));
	}
	function filtro_form() {
		$this->set('content_title', 'Buscar Foto');
		if (!empty($this->data)) {
			$condition = array();
			if (!empty($this->data['Fotogaleria']['subcategoria_id'])) {
				$condition['Fotogaleria.subcategoria_id'] = $this->data['Fotogaleria']['subcategoria_id'];
			}
			if (!empty($this->data['Fotogaleria']['busca'])) {
                                $this->data['Fotogaleria']['busca'] = str_replace(' ', '%', $this->data['Fotogaleria']['busca']);
                                $condition['OR'] = array(
                                        array('Fotogaleria.nome LIKE ' => '%'.$this->data['Fotogaleria']['busca'].'%'),
                                        array('Fotogaleria.descricao LIKE ' => '%'.$this->data['Fotogaleria']['busca'].'%')
                                );
			}
			if (!empty($this->data['Fotogaleria']['categoria_id'])) {
				$condition['Subcategoria.categoria_id'] = $this->data['Fotogaleria']['categoria_id'];
			}
			$this->Session->write('Fotogaleria.filtro', $condition);
			$this->Session->write('Fotogaleria.nome_filtro', 'Filtro');
			$this->redirect(array('action' => 'filtro'));			
		}
		$categorias = $this->Fotogaleria->Subcategoria->Categoria->find('all', array('conditions' => array(), 
												'recursive' => '0'));
		$select_categorias = array();
		foreach ($categorias as $categoria){
			$select_categorias[$categoria['Categoria']['id']] = $categoria['Categoria']['nome'];
		}			
		$this->set('select_categorias', $select_categorias);
	}
	function view($id = null) {
		$this->set('content_title', 'Detalhes');
		if (!$id) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('foto', $this->Fotogaleria->read(null, $id));
	}
	function add() {
		$this->set('content_title', 'Cadastrar Foto');
		if (!empty($this->data)) {
			$this->Fotogaleria->create();
			$this->data['Fotogaleria']['user_id'] = $this->Session->read('Auth.User.id');
			if ($this->Fotogaleria->save($this->data)) {
				$fotogaleria_id = $this->Fotogaleria->getInsertId();
				$count = 0;
				$nome_arquivo = '';
                                $nome_arquivo_mini = '';
                                //no caso tem somente uma imagem, passando somente uma vez neste loop
				foreach ($this->data['Fotogaleria']['foto'] as $foto){
					$extensao = substr(strrchr($foto['name'], '.'), 1 );
                                        $datetime = date('YmdHms');
					$nome_arquivo = 'fotogaleria_'.$fotogaleria_id.'_'.$datetime.$count.'.'.$extensao;
                                        $nome_arquivo_mini = 'fotogaleria_'.$fotogaleria_id.'_'.$datetime.$count.'_mini.'.$extensao;
					$result = $this->uploadFiles('fotos', array($foto), null, array($nome_arquivo), true, 800, $nome_arquivo_mini, 200);
					$count++;
				}
				//somente grava a ultima foto na tabela.
				$this->data['Fotogaleria']['id'] = $fotogaleria_id;
				$this->data['Fotogaleria']['nome_img'] = $nome_arquivo;
				$this->data['Fotogaleria']['mini_img'] = $nome_arquivo_mini;
				$this->Fotogaleria->save($this->data);
				$this->Session->setFlash(__('Foto cadastrada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Foto não pôde ser cadastrada. Entre em contato com o suporte.', true));
			}
		}
		$subcategorias = $this->Fotogaleria->Subcategoria->find('all', array('conditions' => array(), 
												'recursive' => '0'));
		$select_subcategorias = array();
		foreach ($subcategorias as $sub){
			$select_subcategorias[$sub['Subcategoria']['id']] = $sub['Subcategoria']['nome'];
		}
		$categorias = $this->Fotogaleria->Subcategoria->Categoria->find('all', array('conditions' => array(), 
												'recursive' => '0'));
		$select_categorias = array();
		foreach ($categorias as $categoria){
			$select_categorias[$categoria['Categoria']['id']] = $categoria['Categoria']['nome'];
		}
		$this->set(compact('select_categorias'));
	}
	function edit($id = null) {
		$this->set('content_title', 'Editar Foto');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Fotogaleria']['user_id'] = $this->Session->read('Auth.User.id');
			$count = 0;
			$nome_arquivo = '';
			foreach ($this->data['Fotogaleria']['foto'] as $foto){
				if($foto['error'] == 0){
					$extensao = substr(strrchr($foto['name'], '.'), 1 );
                                        $datetime = date('YmdHms');
					$nome_arquivo = 'fotogaleria_'.$this->data['Fotogaleria']['id'].'_'.$datetime.$count.'.'.$extensao;
                                        $nome_arquivo_mini = 'fotogaleria_'.$this->data['Fotogaleria']['id'].'_'.$datetime.$count.'_mini.'.$extensao;
					$result = $this->uploadFiles('fotos', array($foto), null, array($nome_arquivo), true, 800, $nome_arquivo_mini, 200);
					$count++;
				}
			}
			if($nome_arquivo != ''){
				$this->data['Fotogaleria']['nome_img'] = $nome_arquivo;
				$this->data['Fotogaleria']['mini_img'] = $nome_arquivo_mini;
			}
			if ($this->Fotogaleria->save($this->data)) {
				$this->Session->setFlash(__('Foto editada.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Foto não pode ser editada. Entre em contato com o suporte.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fotogaleria->read(null, $id);
		}
		$subcategorias = $this->Fotogaleria->Subcategoria->find('all', array('conditions' => array('Categoria.id' => $this->data['Subcategoria']['categoria_id']), 
												'recursive' => '0'));
		$select_subcategorias = array();
		foreach ($subcategorias as $sub){
			$select_subcategorias[$sub['Subcategoria']['id']] = $sub['Subcategoria']['nome'];
		}
		$this->set(compact('select_subcategorias'));
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Código inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Fotogaleria->delete($id)) {
			$this->Session->setFlash(__('Foto removida', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Foto não pode ser removida. Entre em contato com o suporte.', true));
		$this->redirect(array('action' => 'index'));
	}
	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(array('index', 'filtro', 'filtro_categoria', 'filtro_form', 'filtro_subcategoria', 'view'));
		$this->set('nameSession', 'manage');
		$this->set('controller_name', 'fotogalerias');
		//gravando o controle na sessão para o menu lateral
		$this->Session->write('SideBar.tipo', 'fotogalerias');
		$this->set('name_side_bar', 'fotogalerias' );
                if($this->config_sistema['Configuracao']['ativa_fotogaleria'] == 0)
                    $this->redirect('/produtos');
	}
}
?>