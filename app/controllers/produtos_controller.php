<?php
class ProdutosController extends AppController {
    var $name = 'Produtos';
    var $components = array('Excel');
    var $paginate = array(
        'limit' => 21
    );
    var $helpers = array('produtopack');
    function index() {

//                echo '<pre>';
//                print_r($_SESSION);
//                echo '</pre>';

        //$this->set('content_title', 'Produtos');
        $this->Produto->recursive = 0;
        //verifica se é necessário fazer um redirecionamento
        if($this->Session->check('Redirect_url')){
            $redirect_url = $this->Session->read('Redirect_url');
            $this->Session->delete('Redirect_url');
            $this->redirect($redirect_url);
        }
        if($this->Auth->user('group_id') == 1){
            $condicao = array();
        }else{
            $condicao = array('Produto.ativo' => true);
        }
        //obter produtos ativos
        $produtos_ativos = $this->Produto->countProdutosAtivos();
        $this->set('produtos_ativos', $produtos_ativos);
        $this->set('produtos', $this->paginate('Produto', $condicao ));
    }

    function index_admin() {

        if($this->Auth->user('group_id') != 1){
            $this->redirect('/produtos');
        }

        //$this->set('content_title', 'Produtos');
        $this->Produto->recursive = 0;
        //verifica se é necessário fazer um redirecionamento
        if($this->Session->check('Redirect_url')){
            $redirect_url = $this->Session->read('Redirect_url');
            $this->Session->delete('Redirect_url');
            $this->redirect($redirect_url);
        }


        $condition = array();
        $param_filtro = array();
        $param_get = '?';
        if(!empty($_GET)){
            $param_filtro = $_GET;

            if (!empty($_GET['busca'])) {
                $_GET['busca'] = str_replace(' ', '%', $_GET['busca']);
                $condition['OR'] = array(
                    array('Produto.nome LIKE ' => '%'.$_GET['busca'].'%'),
                    array('Produto.descricao LIKE ' => '%'.$_GET['busca'].'%')
                );
            }
            if (!empty($_GET['subcategoria_id'])) {
                $condition['Produto.subcategoria_id'] = intval($_GET['subcategoria_id']);
            }
            if (!empty($_GET['marca_id'])) {
                $condition['Produto.marca_id'] = intval($_GET['marca_id']);
            }
            if (!empty($_GET['ativo'])) {
                $condition['Produto.ativo'] = 1;
            }
            if (!empty($_GET['promocao'])) {
                $condition['Produto.promocao'] = 1;
            }
            if (!empty($_GET['categoria_id'])) {
                $condition['Subcategoria.categoria_id'] = intval($_GET['categoria_id']);
            }
            if (!empty($_GET['valor_form'])) {
                //normalizar o valor
                $valor = str_replace(',', '.', $_GET['valor_form']) ;
                $condition['Produto.valor '.$_GET['valor_condicao']] = $valor;
            }
            if (!empty($_GET['peso_form'])) {
                //normalizar o valor
                $peso = str_replace(',', '.', $_GET['peso_form']) ;
                $condition['Produto.peso '.$_GET['peso_condicao']] = $peso;
            }
            foreach($_GET as $key => $value)
                if($key != 'url')
                    $param_get .= $key.'='.$value.'&';
            ;
        }

        $this->Produto->recursive = 1;
        $this->set('param_get', $param_get);
        $this->set('param_filtro', $param_filtro);

        if(!empty($_GET['categoria_id'])){
            $subcategorias = $this->Produto->Subcategoria->find('all', array('conditions' => array('Subcategoria.categoria_id' => $_GET['categoria_id']), 'recursive' => '0'));
        }else{
            $subcategorias = array();
        }
        $select_subcategorias = array();
        foreach ($subcategorias as $sub){
            $select_subcategorias[$sub['Subcategoria']['id']] = $sub['Subcategoria']['nome'];
        }
        $categorias = $this->Produto->Subcategoria->Categoria->find('all', array('conditions' => array(), 'recursive' => '0'));
        $select_categorias = array();
        foreach ($categorias as $categoria){
            $select_categorias[$categoria['Categoria']['id']] = $categoria['Categoria']['nome'];
        }
        $marcas = $this->Produto->Marca->find('all');
        $select_marcas = array();
        foreach ($marcas as $marca){
            $select_marcas[$marca['Marca']['id']] = $marca['Marca']['nome'];
        }
        $this->set(compact('select_categorias', 'select_marcas', 'select_subcategorias'));

        //obter produtos ativos
        $produtos_ativos = $this->Produto->countProdutosAtivos($condition);
        $this->set('produtos_ativos', $produtos_ativos);

        $this->set('produtos', $this->paginate('Produto', $condition ));
    }

    function filtro() {
        $condition = array();
        $param_get = '?';
        if(!empty($_GET['busca_flag'])){
            if (!empty($_GET['subcategoria_id'])) {
                $condition['Produto.subcategoria_id'] = $_GET['subcategoria_id'];
            }
            if (!empty($_GET['modelo_id'])) {
                $condition['Produto.modelo_id'] = $_GET['modelo_id'];
            }
            if (!empty($_GET['marca_id'])) {
                $condition['Produto.marca_id'] = $_GET['marca_id'];
            }
            if (!empty($_GET['categoria_id'])) {
                $condition['Subcategoria.categoria_id'] = $_GET['categoria_id'];
            }
            if (!empty($_GET['busca'])) {
                $_GET['busca'] = str_replace(' ', '%', $_GET['busca']);
                $condition['OR'] = array(
                    array('Produto.nome LIKE ' => '%'.$_GET['busca'].'%'),
                    array('Produto.descricao LIKE ' => '%'.$_GET['busca'].'%')
                );
            }
            if (!empty($_GET['quantidade'])) {
                $condition['Produto.quantidade'] = $_GET['quantidade'];
            }
            if (!empty($_GET['valor_form'])) {
                //normalizar o valor
                $valor = str_replace(',', '.', $_GET['valor_form']) ;
                $condition['Produto.valor '.$_GET['valor_condicao']] = $valor;
            }
            if (!empty($_GET['peso_form'])) {
                //normalizar o valor
                $peso = str_replace(',', '.', $_GET['peso_form']) ;
                $condition['Produto.peso '.$_GET['peso_condicao']] = $peso;
            }
            if (!empty($_GET['promocao'])) {
                $condition['Produto.promocao'] = $_GET['promocao'];
            }
            if (!empty($_GET['lancamento'])) {
                $condition['Produto.lancamento'] = $_GET['lancamento'];
            }
            if (!empty($_GET['ativo'])) {
                $condition['Produto.ativo'] = $_GET['ativo'];
            }
            //print_r($_GET);
            if (!empty($_GET['somente_loja'])) {
                if($_GET['somente_loja'] == 'sim')
                    $condition['Produto.venda_somente_loja'] = 1;
                else
                    $condition['Produto.venda_somente_loja'] = 0;
            }
            foreach($_GET as $key => $value)
                if($key != 'url')
                    $param_get .= $key.'='.$value.'&';
            ;
        }else{
            //$this->redirect(array('action' => 'index'));
        }
        //é usuário comum
        if($this->Auth->user('group_id') != 1){
            $condition['Produto.ativo'] = 1;
        }
        //obter produtos ativos
        $produtos_ativos = $this->Produto->countProdutosAtivos($condition);
        $this->set('produtos_ativos', $produtos_ativos);
        //$this->set('content_title', 'Produtos: Busca');
        $this->set('param_get', $param_get);
        $this->set('produtos', $this->paginate('Produto', $condition));
    }
    function filtro_categoria($id) {
        $condition = array();
        $condition['Subcategoria.categoria_id'] = $id;
        $this->loadModel('Categoria');
        $categoria = $this->Categoria->find('first', array('conditions' => array('id' => $id),
            'recursive' => '0'));
        $this->Session->write('Produto.filtro', $condition);
        $this->Session->write('Produto.nome_filtro', $categoria['Categoria']['nome']);
        $this->redirect(array('action' => 'filtro'));
    }
    function filtro_subcategoria($id) {
        $condition = array();
        $condition['Produto.subcategoria_id'] = $id;
        $subcategoria = $this->Produto->Subcategoria->find('first', array('conditions' => array('Subcategoria.id' => $id),
            'recursive' => '0'));
        $this->Session->write('Produto.filtro', $condition);
        $this->Session->write('Produto.nome_filtro', $subcategoria['Categoria']['nome'].' - '.$subcategoria['Subcategoria']['nome']);
        $this->redirect(array('action' => 'filtro'));
    }
    function filtro_marca($id) {
        $condition = array();
        $condition['Produto.marca_id'] = $id;
        $marca = $this->Produto->Marca->find('first', array('conditions' => array('Marca.id' => $id),
            'recursive' => '0'));
        $this->Session->write('Produto.filtro', $condition);
        $this->Session->write('Produto.nome_filtro', 'Marca - '.$marca['Marca']['nome']);
        $this->redirect(array('action' => 'filtro'));
    }
    function filtro_modelo($id) {
        $condition = array();
        $condition['Produto.modelo_id'] = $id;
        $modelo = $this->Produto->Modelo->find('first', array('conditions' => array('Modelo.id' => $id),
            'recursive' => '0'));
        $this->Session->write('Produto.filtro', $condition);
        $this->Session->write('Produto.nome_filtro', $modelo['Subcategoria']['nome'].' - '.$modelo['Modelo']['nome']);
        $this->redirect(array('action' => 'filtro'));
    }
    function filtro_form() {
        $this->set('content_title', 'Buscar Produto');
        if(!empty($_GET['busca_flag'])){
            $param_get = '?';
            foreach($_GET as $key => $value)
                $param_get .= $key.'='.$value.'&';
            ;
            $this->redirect('/produtos/filtro'.$param_get);
        }
        $categorias = $this->Produto->Subcategoria->Categoria->find('all', array('conditions' => array(),
            'recursive' => '0'));
        $select_categorias = array();
        foreach ($categorias as $categoria){
            $select_categorias[$categoria['Categoria']['id']] = $categoria['Categoria']['nome'];
        }
        $this->set('select_categorias', $select_categorias);
    }

    function registra_preferencia($produto_id = null, $tipo = ''){
        $produto = $this->Produto->read(null, $produto_id);

        //incrementar a visualizacao do produto
        $produto['Produto']['count_amei'] = intval($produto['Produto']['count_amei']) + 1;
        $this->Produto->save($produto);

        if($tipo == 'masculino')
            $this->Session->setFlash(__('Obrigado por curtir nosso produto! ', true));
        else
            $this->Session->setFlash(__('Obrigado por amar nosso produto! ', true));
        $this->redirect('/produtos/view/'.$produto_id);
    }

    function registra_desejo($produto_id = null){
        $produto = $this->Produto->read(null, $produto_id);

        //incrementar a visualizacao do produto
        $produto['Produto']['count_quero'] = intval($produto['Produto']['count_quero']) + 1;
        $this->Produto->save($produto);

        $this->Session->setFlash(__('Obrigado por registrar seu desejo pelo produto! ', true));
        $this->redirect('/produtos/view/'.$produto_id);
    }

    function view($id = null, $opcao = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid produto', true));
            $this->redirect(array('action' => 'index'));
        }
        $produto = $this->Produto->read(null, $id);
        if($this->Auth->user('group_id') != 1){
            //incrementar a visualizacao do produto
            $produto['Produto']['visualizacao'] = intval($produto['Produto']['visualizacao']) + 1;
            $this->Produto->save($produto);
        }
        //verifica se esta ativo - controle de acesso por produto
        if($produto['Produto']['ativo'] == 0 && $opcao != 'oculto'){
            if($this->Auth->user('group_id') != 1){
                $this->redirect('/produtos/index');
            }
        }
        if($opcao == 'oculto'){
            $this->set('opcao', $opcao);
        }

        //Obter a categoria
        $categoria = $this->Produto->Subcategoria->Categoria->find('first', array('conditions' => array('id' => $produto['Subcategoria']['categoria_id']), 'recursive' => 0 ));
        $fotos = $this->Produto->Foto->find('all', array('conditions' => array('produto_id' => $id), 'recursive' => 0 ));
        $produto['Foto'] = array();
        foreach ($fotos as $foto){
            $produto['Foto'][] = $foto['Foto'];
        }
        $this->set('content_title', $produto['Produto']['nome']);
        $this->set('produto', $produto);
        $this->set('categoria', $categoria);
    }
    function view_admin($id = null , $opcao = null) {
        if($this->Auth->user('group_id') == 2){
            $this->redirect('/produtos/view/'.$id);
        }
        if (!$id) {
            $this->Session->setFlash(__('Invalid produto', true));
            $this->redirect(array('action' => 'index'));
        }
        $produto = $this->Produto->read(null, $id);
        //Obter a categoria
        $categoria = $this->Produto->Subcategoria->Categoria->find('first', array('conditions' => array('id' => $produto['Subcategoria']['categoria_id']), 'recursive' => 0 ));
        $fotos = $this->Produto->Foto->find('all', array('conditions' => array('produto_id' => $id), 'recursive' => 0 ));
        $produto['Foto'] = array();
        foreach ($fotos as $foto){
            $produto['Foto'][] = $foto['Foto'];
        }
        $this->set('content_title', $produto['Produto']['nome']);
        $this->set('produto', $produto);
        $this->set('categoria', $categoria);
        $this->set('tamanho_lista', $this->Produto->Tamanho->getLista($id));
        $this->set('cor_lista', $this->Produto->Cor->getLista($id));
    }
    //$id é para o caso de usar um produto ja criado para obter a categoria e a subcategoria.
    function add($id = null) {
        $this->set('content_title', 'Cadastrar Produto');
        if (!empty($this->data)) {
            $this->Produto->create();
            $this->data['Produto']['user_id'] = $this->Session->read('Auth.User.id');
            if ($this->Produto->save($this->data)) {
                $produto_id = $this->Produto->getInsertId();
                //gravar as fotos do produto
                $count = 0;
                foreach ($this->data['Produto']['foto'] as $foto){
                    if(!empty($foto)) {
                        if($foto['error'] == 0){
                            $extensao = substr(strrchr($foto['name'], '.'), 1 );
                            $datetime = date('YmdHms');
                            $nome_arquivo = 'produto_'.$produto_id.'_'.$datetime.$count.'.'.$extensao;
                            $nome_arquivo_mini = 'produto_'.$produto_id.'_'.$datetime.$count.'_mini.'.$extensao;
                            $result = $this->uploadFiles('fotos', array($foto), null, array($nome_arquivo), true, 800, $nome_arquivo_mini, 400);
                            //gravar o nome da primeira imagem nos dados do produto
                            if($count == 0){
                                $this->data['Produto']['img'] = $nome_arquivo;
                                $this->data['Produto']['img_mini'] = $nome_arquivo_mini;
                                $this->data['Produto']['id'] = $produto_id;
                                $this->Produto->save($this->data);
                            }
                            //gravar endereço de imagem no banco
                            $this->loadModel('Foto');
                            $data_image = array();
                            $data_image['Foto']['produto_id'] = $produto_id;
                            $data_image['Foto']['nome'] = $nome_arquivo;
                            $data_image['Foto']['nome_img'] = $nome_arquivo_mini;
                            $this->Foto->create();
                            $this->Foto->save($data_image);
                            $count++;
                        }
                    }
                }
                //gravar os modelos do produto
                foreach ($this->data['Cor'] as $cor){
                    if(!empty($cor)){
                        $cor_array = array();
                        $cor_array['Cor']['produto_id'] = $produto_id;
                        $cor_array['Cor']['nome'] = $cor;
                        $this->Produto->Cor->create();
                        $this->Produto->Cor->save($cor_array);
                    }
                }
                //gravar os tamanhos do produto
                foreach ($this->data['Tamanho'] as $tamanho){
                    if(!empty($tamanho)){
                        $tamanho_array = array();
                        $tamanho_array['Tamanho']['produto_id'] = $produto_id;
                        $tamanho_array['Tamanho']['nome'] = $tamanho;
                        $this->Produto->Tamanho->create();
                        $this->Produto->Tamanho->save($tamanho_array);
                    }
                }
                $this->Session->setFlash(__('Produto cadastrado', true));
                $this->redirect(array('action' => 'add_quantidade/'.$produto_id));
            } else {
                $this->Session->setFlash(__('Produto não pode ser cadastrado. Verifique se os campos estão preenchidos', true));
                $this->redirect(array('action' => 'add'));
            }
        }
        $produto = null;
        if(!empty($id)){
            $produto = $this->Produto->read(null, $id);
            if(!empty($produto)){
                $this->set('produto', $produto);
            }
        }
        if(!empty($produto)){
            $subcategorias = $this->Produto->Subcategoria->find('all', array('conditions' => array('Subcategoria.categoria_id' => $produto['Subcategoria']['categoria_id']),
                'recursive' => '0'));
        }else{
            $subcategorias = $this->Produto->Subcategoria->find('all', array('conditions' => array(),
                'recursive' => '0'));
        }
        $select_subcategorias = array();
        foreach ($subcategorias as $sub){
            $select_subcategorias[$sub['Subcategoria']['id']] = $sub['Subcategoria']['nome'];
        }

        //buscar por modelos de uma subcategoria
        if(!empty($produto['Subcategoria']['id'])){
            $modelos = $this->Produto->Subcategoria->Modelo->find('all', array('conditions' => array('Modelo.subcategoria_id' => $produto['Subcategoria']['id']),
                'recursive' => -1));
            $select_modelos = array();
            foreach ($modelos as $modelo){
                $select_modelos[$modelo['Modelo']['id']] = $modelo['Modelo']['nome'];
            }
            $this->set('select_modelos', $select_modelos);
        }

        $categorias = $this->Produto->Subcategoria->Categoria->find('all', array('conditions' => array(),
            'recursive' => '0'));
        $select_categorias = array();
        foreach ($categorias as $categoria){
            $select_categorias[$categoria['Categoria']['id']] = $categoria['Categoria']['nome'];
        }
        $marcas = $this->Produto->Marca->find('all');
        $select_marcas = array();
        foreach ($marcas as $marca){
            $select_marcas[$marca['Marca']['id']] = $marca['Marca']['nome'];
        }
        $moedas = $this->Produto->Moeda->find('all', array('conditions' => array(),
            'recursive' => '0'));
        $select_moedas = array();
        foreach ($moedas as $moeda){
            $select_moedas[$moeda['Moeda']['id']] = $moeda['Moeda']['sigla'];
        }
        $this->set(compact('select_categorias', 'select_moedas', 'select_marcas', 'select_subcategorias'));
    }
    function add_quantidade($id = null) {
        $this->set('content_title', 'Inserir quantidade em estoque');
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid produto', true));
            $this->redirect(array('action' => 'index'));
        }
        //gravar quantidades
        if (!empty($this->data)) {
            foreach($this->data['Produto'] as $tamanho_id => $valor){
                if(is_array($valor)){
                    //é to tipo tamanho/cor
                    foreach($valor as $cor_id => $quantidade){
                        $array_produtoquantidade = array();
                        $array_produtoquantidade['ProdutoQuantidade']['produto_id'] = $id;
                        $array_produtoquantidade['ProdutoQuantidade']['tamanho_id'] = $tamanho_id;
                        $array_produtoquantidade['ProdutoQuantidade']['cor_id'] = $cor_id;
                        $array_produtoquantidade['ProdutoQuantidade']['quantidade'] = $quantidade;
                        $this->Produto->ProdutoQuantidade->create();
                        $this->Produto->ProdutoQuantidade->verifica_save($array_produtoquantidade);
                    }
                }else{
                    //é do tipo somente tamanho
                    $array_produtoquantidade = array();
                    $array_produtoquantidade['ProdutoQuantidade']['produto_id'] = $id;
                    $array_produtoquantidade['ProdutoQuantidade']['tamanho_id'] = $tamanho_id;
                    $array_produtoquantidade['ProdutoQuantidade']['quantidade'] = $valor;
                    $this->Produto->ProdutoQuantidade->create();
                    $this->Produto->ProdutoQuantidade->verifica_save($array_produtoquantidade);
                }
            }
            $this->Session->setFlash(__('Quantidades cadastradas', true));
            $this->redirect(array('action' => 'view_admin/'.$id));
        }
        if (empty($this->data)) {
            $this->data = $this->Produto->read(null, $id);
        }
    }
    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid produto', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            $this->Produto->Produtohistorico->grava_historico($id);
            if ($this->Produto->save($this->data)) {
                $this->Session->setFlash(__('Produto editado', true));
                $this->redirect('/produtos/view_admin/'.$id);
            } else {
                $this->Session->setFlash(__('Produto não pode ser editado. Verifique se os campos estão preenchidos', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Produto->read(null, $id);
        }
        $subcategorias = $this->Produto->Subcategoria->find('all', array('conditions' => array('Subcategoria.categoria_id' => $this->data['Subcategoria']['categoria_id']),
            'recursive' => '0'));
        $select_subcategorias = array();
        foreach ($subcategorias as $sub){
            $select_subcategorias[$sub['Subcategoria']['id']] = $sub['Subcategoria']['nome'];
        }
        $modelos = $this->Produto->Modelo->find('all', array('conditions' => array('Modelo.subcategoria_id' => $this->data['Produto']['subcategoria_id']),
            'recursive' => '0'));
        $select_modelos = array();
        foreach ($modelos as $mod){
            $select_modelos[$mod['Modelo']['id']] = $mod['Modelo']['nome'];
        }
        $categorias = $this->Produto->Subcategoria->Categoria->find('all', array('conditions' => array(),
            'recursive' => '0'));
        $select_categorias = array();
        foreach ($categorias as $categoria){
            $select_categorias[$categoria['Categoria']['id']] = $categoria['Categoria']['nome'];
        }
        $marcas = $this->Produto->Marca->find('all');
        $select_marcas = array();
        foreach ($marcas as $marca){
            $select_marcas[$marca['Marca']['id']] = $marca['Marca']['nome'];
        }
        $moedas = $this->Produto->Moeda->find('all', array('conditions' => array(),
            'recursive' => '0'));
        $select_moedas = array();
        foreach ($moedas as $moeda){
            $select_moedas[$moeda['Moeda']['id']] = $moeda['Moeda']['sigla'];
        }
        $this->set('content_title', 'Editando produto: '.$this->data['Produto']['nome']);
        $this->set(compact('select_categorias', 'select_subcategorias', 'select_moedas', 'select_marcas', 'select_modelos'));
    }
    function edit_quantidade($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid produto', true));
            $this->redirect(array('action' => 'index'));
        }
        //gravar quantidades
        if (!empty($this->data)) {
            foreach($this->data['Produto'] as $tamanho_id => $valor){
                if(is_array($valor)){
                    //é to tipo tamanho/cor
                    foreach($valor as $cor_id => $quantidade){
                        //verifica se ja possuia quantidade cadastrada
                        $array_produtoquantidade = array();
                        $array_produtoquantidade['ProdutoQuantidade']['produto_id'] = $id;
                        $array_produtoquantidade['ProdutoQuantidade']['tamanho_id'] = $tamanho_id;
                        $array_produtoquantidade['ProdutoQuantidade']['cor_id'] = $cor_id;
                        $array_produtoquantidade['ProdutoQuantidade']['quantidade'] = $quantidade;
                        $this->Produto->ProdutoQuantidade->create();
                        $this->Produto->ProdutoQuantidade->verifica_save($array_produtoquantidade);
                    }
                }else{
                    //é do tipo somente tamanho
                    $array_produtoquantidade = array();
                    $array_produtoquantidade['ProdutoQuantidade']['produto_id'] = $id;
                    $array_produtoquantidade['ProdutoQuantidade']['tamanho_id'] = $tamanho_id;
                    $array_produtoquantidade['ProdutoQuantidade']['quantidade'] = $valor;
                    $this->Produto->ProdutoQuantidade->create();
                    $this->Produto->ProdutoQuantidade->verifica_save($array_produtoquantidade);
                }
            }
            $this->Session->setFlash(__('Quantidades cadastradas', true));
            $this->redirect(array('action' => 'view_admin/'.$id));
        }
        if (empty($this->data)) {
            $this->data = $this->Produto->read(null, $id);
        }
    }
    function alterar_status($id){
        $produto = $this->Produto->read(null, $id);
        if($produto['Produto']['ativo'] == 1){
            $produto['Produto']['ativo'] = 0;
        }else{
            $produto['Produto']['ativo'] = 1;
        }
        $this->Produto->create();
        $this->Produto->save($produto);
        $this->Session->setFlash(__('Status atualizado', true));
        $this->redirect(array('action' => 'view_admin/'.$id));
    }
    function edit_photos($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Código inválido', true));
            $this->redirect(array('action' => 'index'));
        }
        $produto = $this->Produto->read(null, $id);
        if (!empty($this->data)) {
            //adicionar uma foto
            $count = 0;
            //$this->debugVar($this->data['Produto']['foto']);
            foreach ($this->data['Produto']['foto'] as $foto){
                //$this->debugVar($foto);
                if(!empty($foto)) {
                    if($foto['error'] == 0){
                        $extensao = substr(strrchr($foto['name'], '.'), 1 );
                        $datetime = date('YmdHms');
                        $nome_arquivo = 'produto_'.$id.'_'.$datetime.$count.'.'.$extensao;
                        $nome_arquivo_mini = 'produto_'.$id.'_'.$datetime.$count.'_mini.'.$extensao;
                        $result = $this->uploadFiles('fotos', array($foto), null, array($nome_arquivo), true, 800, $nome_arquivo_mini, 400);
                        //gravar endereço de imagem no banco
                        //$this->loadModel('Foto');
                        $data_image = array();
                        $data_image['Foto']['produto_id'] = $id;
                        $data_image['Foto']['nome'] = $nome_arquivo;
                        $data_image['Foto']['nome_img'] = $nome_arquivo_mini;
                        $this->Produto->Foto->create();
                        $this->Produto->Foto->save($data_image);
                        $foto_id = $this->Produto->Foto->getInsertId();
                        if(count($produto['Foto']) == 0){
                            //associar como foto principal
                            $produto['Produto']['img'] = $nome_arquivo;
                            $produto['Produto']['img_mini'] = $nome_arquivo_mini;
                            $this->Produto->save($produto);
                        }
                    }
                }
                $count++;
            }
        }
        //obter fotos ordenadas por id
        $imagens = $this->Produto->Foto->find('all', array('conditions' => array('produto_id' => $id), 'recursive' => 0 ));
        $produto['Foto'] = array();
        foreach ($imagens as $img){
            $produto['Foto'][] = $img['Foto'];
        }
        $this->data = $produto;
        $this->set('content_title', 'Editar Fotos: '.$produto['Produto']['nome']);
        $this->set('produto_id', $id);
    }
    function foto_principal($produto_id, $foto_id){
        //obter os dados da foto
        $foto = $this->Produto->Foto->read(null, $foto_id);
        $produto = $this->Produto->read(null, $produto_id);
        $produto['Produto']['img'] = $foto['Foto']['nome_img'];
        $produto['Produto']['img_mini'] = $foto['Foto']['nome_img'];
        $this->Produto->save($produto);
        $this->Session->setFlash(__('Foto principal associada', true));
        $this->redirect(array('action' => 'view_admin/'.$produto_id));
    }
    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for produto', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Produto->delete($id)) {
            $this->Session->setFlash(__('Produto removido', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Produto não pode ser removido pois possui pedidos. Edite o produto e desative para que os cliente não visualizem', true));
        $this->redirect(array('action' => 'index'));
    }
    /**
     * Atualizar método
     * Enter description here ...
     */
    function listar_todos(){
        $condicao = array('Produto.removido' => '0');
        $this->Produto->recursive = '0';
        $this->paginate = array('limit' => $this->produtosPorPagina, 'order' => array('Produto.data_inclusao' => 'asc'));
        $produtos = $this->paginate('Produto', $condicao);
        $this->set('produtos', $produtos);
        $this->set('produtosPorPagina', $this->produtosPorPagina);
        $this->set('totalProdutos', $this->Produto->find('count'));
    }
    /**
     * Atualizar método
     * Enter description here ...
     */
    function listar_por_categoria($categoria = null){
        $condicao = array('Produto.categoria_id' => $categoria, 'Produto.removido' => '0');
        if ($this->Produto->find('count', array('conditions' => $condicao)))
        {
            $this->paginate = array('limit' => $this->produtosPorPagina, 'order' => array('Produto.data_inclusao' => 'desc'));
            $produtos = $this->paginate('Produto', $condicao);
            $this->set('produtos', $produtos);
            $this->set('categoria', $categoria);
            $this->set('produtosPorPagina', $this->produtosPorPagina);
            $this->set('totalProdutos', $this->Produto->find('count', array('conditions' => $condicao)));
        }
    }
    /**
     * Atualizar método
     * Enter description here ...
     */
    function listar_promocao(){
        $condicao = array('Produto.promocao' => '1', 'Produto.removido' => '0');
        if ($this->Produto->find('count', array('conditions' => $condicao)))
        {
            $this->paginate = array('limit' => $this->produtosPorPagina, 'order' => array('Produto.data_inclusao' => 'asc'));
            $produtos = $this->paginate('Produto', $condicao);
            $this->set('produtos', $produtos);
            $this->set('produtosPorPagina', $this->produtosPorPagina);
            $this->set('totalProdutos', $this->Produto->find('count', array('conditions' => $condicao)));
        }
    }
    /**
     * Atualizar método
     * Enter description here ...
     */
    function buscar(){
        if(!empty($this->data))
        {
            $condicao = array();
            //$this->data['Produto']['descricao'] = $this->data['Produto']['nome'];
            $filtro = $this->postConditions($this->data,
                array('nome' => 'LIKE',
                    'descricao' => 'LIKE'));
            //echo print_r($filtro);
            foreach ($filtro as $field => $value)
            {
                if ($value != '' && $value != '%%')
                {
                    $condicao[$field] = $value;
                }
            }
            if ($this->Produto->find('count', array('conditions' => $condicao))>0)
            {
                $this->paginate = array('limit' => $this->produtosPorPagina, 'order' => array('Produto.data_inclusao' => 'asc'));
                $produtos = $this->paginate('Produto', $condicao);
                $this->set('produtos', $produtos);
                //echo print_r($produtos);
                $this->set('produtosPorPagina', $this->produtosPorPagina);
                $this->set('totalProdutos', $this->Produto->find('count', array('conditions' => $condicao)));
            }
        }
        $this->render('listar_promocao');
    }
    function indicar_produto(){
        if (!empty($this->data)) {
            $produto = $this->Produto->find('first', array('conditions' => array('Produto.id' => $this->data['Contato']['produto_id'])));
            //prepara array de mesclagem
            $array_mesclagem = array();
            $array_mesclagem['nome_produto'] = $produto['Produto']['nome'];
            $array_mesclagem['email_de'] = $this->data['Contato']['email_de'];
            $array_mesclagem['email_para'] = $this->data['Contato']['email_para'];
            $array_mesclagem['mensagem'] = nl2br($this->data['Contato']['mensagem']);
            $array_mesclagem['link_produto'] = $this->config_sistema['Configuracao']['site_url'].'/produtos/view/'.$produto['Produto']['id'];
            $assunto = $this->config_sistema['Configuracao']['nome_empresa'].' - Indicação de produto: '.$produto['Produto']['nome'];
            $contato = $this->data;
            $contato['Contato']['assunto'] = $assunto;
            $contato['Contato']['mensagem'] = nl2br($this->data['Contato']['mensagem']).'<br/>'.$array_mesclagem['link_produto'];
            $this->loadModel('Contato');
            $this->Contato->save($contato);
            if ($this->envia_email(' ', $this->data['Contato']['email_para'], $assunto, 'indicar_produto', $array_mesclagem, 'produto', $produto['Produto']['id'])) {
                $this->Session->setFlash('E-mail enviado.');
            }else{
                $this->Session->setFlash('Falha no envio, tente novamente mais tarde');
            }
        }
        $this->redirect('/produtos/view/'.$produto['Produto']['id']);
    }
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'view', 'filtro', 'filtro_categoria', 'filtro_form', 'filtro_subcategoria', 'filtro_marca', 'filtro_modelo', 'listar_por_categoria', 'listar_promocao', 'listar_todos', 'indicar_produto', 'encomenda', 'registra_preferencia', 'registra_desejo'));
        $this->set('nameSession', 'manage');
        $this->set('controller_name', 'produtos');
        //gravando o controle na sessão para o menu lateral
        $this->Session->write('SideBar.tipo', 'produtos');
        $this->set('name_side_bar', 'produtos' );
    }
    /**
     * Atualizar método
     * Enter description here ...
     */
    function detalhe($produto_id){
        $this->Produto->create();
        $produto = $this->Produto->get_produto($produto_id);
        //echo print_r($produto);
        $this->set('produto', $produto);
        $this->set('detalhe', 'sim');
    }
    function encomenda($id = null){
        //verifica se há um produto_id no GET
        $produto_nome = '';
        $produto_link = '';
        $this->set('content_title', 'Encomendar produto');
        if (!empty($this->data)) {
            if(!empty($this->data['Produto']['produto'])){
                $produto = $this->Produto->read(null, $this->data['Produto']['produto']);
                $produto_link = $this->config_sistema['Configuracao']['site_url'].'/produtos/view/'.$produto['Produto']['id'];
                $produto_nome = $produto['Produto']['nome'];
            }
            //prepara array de mesclagem
            $array_mesclagem = array();
            $array_mesclagem['nome'] = $this->data['Produto']['nome'];
            $array_mesclagem['email'] = $this->data['Produto']['email'];
            $array_mesclagem['telefone'] = $this->data['Produto']['telefone'];
            $array_mesclagem['mensagem'] = nl2br($this->data['Produto']['mensagem']);
            $array_mesclagem['produto_link'] = nl2br($produto_link);
            if ($this->envia_email($this->config_sistema['Configuracao']['nome_empresa'], $this->config_sistema['Configuracao']['email'], 'Encomenda: '.$produto_nome ,'encomenda', $array_mesclagem)) {
                $this->Session->setFlash('E-mail enviado. Obrigado pelo contato');
            } else {
                $this->Session->setFlash('Falha no envio, verifique se os campos foram preenchidos');
            }
            $this->redirect('/produtos/view/'.$this->data['Produto']['produto']);
        }
        if(empty($id)){
            $this->redirect('/produtos');
        }else{
            $this->set('produto_id', $id);
            $produto = $this->Produto->read(null, $id);
            $this->set('produto', $produto);
            $produto_nome = $produto['Produto']['nome'];
        }
    }

    function relatorios($tipo = null){
        if(empty($tipo))
            $this->redirect('/lojas/relatorios');

        $produtos = array();
        $produtos_count = array();


        if($tipo == 'visualizados'){
            $this->set('content_title', 'Produtos mais visualizados');

            $produtos = $this->Produto->find('all', array('order' => 'Produto.visualizacao DESC'));

        }elseif($tipo == 'amados'){
            $this->set('content_title', 'Produtos mais amados');

            $produtos = $this->Produto->find('all', array('order' => 'Produto.count_amei DESC'));

        }elseif($tipo == 'vendidos'){
            $this->set('content_title', 'Produtos mais vendidos');

            //obter lista de itens de pedidos aprovados

            $produtos_id = $this->Produto->Itempedido->query("SELECT produto_id, COUNT(produto_id) as total_pedidos FROM itempedidos AS Itempedido
                    INNER JOIN pedidos AS Pedido ON Itempedido.pedido_id = Pedido.id
                    WHERE Pedido.statuspedido_id = 3 OR Pedido.statuspedido_id = 6 OR Pedido.statuspedido_id = 7
                    GROUP BY Itempedido.produto_id");
            foreach($produtos_id as $id){
                $produtos[] = $this->Produto->find('first', array('conditions' => array('Produto.id' => $id['Itempedido']['produto_id']), 'recursive' => -1));
                $produtos_count[$id['Itempedido']['produto_id']] = $id[0]['total_pedidos'];
            }

        }

        $this->set('produtos', $produtos);
        $this->set('produtos_count', $produtos_count);
        $this->set('tipo', $tipo);
    }

    function exportar(){

        $categorias = $this->Produto->Subcategoria->Categoria->find('all', array('conditions' => array(), 'recursive' => '0'));
        $select_categorias = array();
        foreach ($categorias as $categoria){
            $select_categorias[$categoria['Categoria']['id']] = $categoria['Categoria']['nome'];
        }

        $condition = array();
        $param_filtro = array();
        $param_get = '?';
        if(!empty($_GET)){
            $param_filtro = $_GET;

            if (!empty($_GET['busca'])) {
                $_GET['busca'] = str_replace(' ', '%', $_GET['busca']);
                $condition['OR'] = array(
                    array('Produto.nome LIKE ' => '%'.$_GET['busca'].'%'),
                    array('Produto.descricao LIKE ' => '%'.$_GET['busca'].'%')
                );
            }
            if (!empty($_GET['subcategoria_id'])) {
                $condition['Produto.subcategoria_id'] = intval($_GET['subcategoria_id']);
            }
            if (!empty($_GET['marca_id'])) {
                $condition['Produto.marca_id'] = intval($_GET['marca_id']);
            }
            if (!empty($_GET['ativo'])) {
                $condition['Produto.ativo'] = 1;
            }
            if (!empty($_GET['promocao'])) {
                $condition['Produto.promocao'] = 1;
            }
            if (!empty($_GET['categoria_id'])) {
                $condition['Subcategoria.categoria_id'] = intval($_GET['categoria_id']);
            }
            if (!empty($_GET['valor_form'])) {
                //normalizar o valor
                $valor = str_replace(',', '.', $_GET['valor_form']) ;
                $condition['Produto.valor '.$_GET['valor_condicao']] = $valor;
            }
            if (!empty($_GET['peso_form'])) {
                //normalizar o valor
                $peso = str_replace(',', '.', $_GET['peso_form']) ;
                $condition['Produto.peso '.$_GET['peso_condicao']] = $peso;
            }
            foreach($_GET as $key => $value)
                if($key != 'url')
                    $param_get .= $key.'='.$value.'&';
            ;
        }

        $this->Produto->recursive = 1;
        $produtos = $this->Produto->find('all', array('conditions' => $condition));

        //iniciar Excel
        $this->Excel->iniciando('lista_produtos_'.date('d-m-Y_H-i-s').'.xls');
        $header = array('Código', 'Nome', 'Subcategoria', 'Categoria', 'Modelo', 'Marca', 'Valor','Valor de custo',
            'Promoção', 'Desconto', 'Lançamento', 'Venda somente na loja', 'Peso', 'Comprimento', 'Largura', 'Altura', 'Visualizações',
            'Pedidos totais', 'Cadastro', 'Últ. Modificação', 'Ativo');
        $this->Excel->writeLine($header);

        $writeLine = array();
        foreach($produtos as $produto){
            $promocao = 'Não';
            $desconto = '-';
            $lancamento = 'Não';
            $venda_loja = 'Não';
            $valor_custo = '-';
            $ativo = 'Sim';

            if($produto['Produto']['promocao'] == 1){
                $promocao = 'Sim';
                $desconto = $produto['Produto']['desconto'].'%';
            }
            if($produto['Produto']['lancamento'] == 1){
                $lancamento = 'Sim';
            }
            if($produto['Produto']['venda_somente_loja'] == 1){
                $venda_loja = 'Sim';
            }
            if($produto['Produto']['ativo'] == 0){
                $ativo = 'Não';
            }
            if(!empty($produto['Produto']['valor_custo_form'])){
                $valor_custo = 'Sim';
            }

            $writeLine = array($produto['Produto']['id'], $produto['Produto']['nome'], $produto['Subcategoria']['nome'],
                $select_categorias[$produto['Subcategoria']['categoria_id']], $produto['Modelo']['nome'], $produto['Marca']['nome'],
                'R$ '.$produto['Produto']['valor_form'], 'R$ '.$valor_custo,
                $promocao, $desconto, $lancamento, $venda_loja, $produto['Produto']['peso_form'],
                $produto['Produto']['medida_comprimento'], $produto['Produto']['medida_largura'], $produto['Produto']['medida_altura'],
                $produto['Produto']['visualizacao'],
                count($produto['Itempedido']), date('d/m/Y', strtotime($produto['Produto']['created'])),
                date('d/m/Y', strtotime($produto['Produto']['modified'])), $ativo);

            $this->Excel->writeLine($writeLine);
        }

        //Finalizar Excel
        $this->Excel->fechando();
    }
}
?>