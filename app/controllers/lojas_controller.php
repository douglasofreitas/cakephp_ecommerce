<?php
class LojasController extends AppController {
	var $name = 'Lojas';
	var $uses = array('Fotogaleria', 'Produto', 'Configuracao');
	function home() {
		$this->set('content_title', 'Home');
                $this->redirect('/pages/home');
	}
	function contato() {
		$this->set('content_title', 'Contato');
                $this->redirect('/pages/contato');
	}
	function contato_tecnico() {
		$this->set('content_title', 'Contato Técnico');
                $this->redirect('/pages/contato_tecnico');
	}
        function quem_somos(){
            $this->set('content_title', 'Quem Somos');
            $this->data = $this->config_sistema;
        }
        function troca_devolucao(){
            $this->set('content_title', 'Trocas e devoluções');
            $this->data = $this->config_sistema;
        }
        function politica_privacidade(){
            $this->set('content_title', 'Política de privacidade e segurança');
            $this->data = $this->config_sistema;
        }
        function index(){
            $this->set('content_title', 'Sistema');
        }
        function dados_gerais(){
            $this->set('content_title', 'Dados da Loja');
            $this->data = $this->config_sistema;
        }
        function editar_dados($setor = 'editar_dados_gerais'){
            $this->set('content_title', 'Editar dados da loja');
            //validando a página a ser carregada
            if($setor != 'editar_dados_gerais')
                if($setor != 'editar_dados_email')
                    if($setor != 'editar_dados_recursos')
                        if($setor != 'editar_dados_loja')
                            $setor = 'editar_dados_gerais';
            if (!empty($this->data)) {
                if ($this->Configuracao->save($this->data)) {
                    $this->Session->setFlash(__('Dados salvos', true));
                    $this->redirect(array('action' => 'dados_gerais'));
                }else{
                    $this->Session->setFlash(__('Erro ao salvar. Tente novamente', true));
                    $this->redirect(array('action' => 'dados_gerais'));
                }
            }
            $this->data = $this->config_sistema;
            $this->render($setor);
        }
	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(array('quem_somos', 'troca_devolucao', 'politica_privacidade'));
		$this->set('nameSession', 'manage');
		$this->set('controller_name', 'home');
	}
        //-------------------------------
        //  Funções de testes e rotinas
        //-------------------------------
        //Funções usadas para manutenção ou modificações na loja como em produtos, pedidos ou galeria
        function cria_modelo_110_220(){
            $this->loadModel('Produto');
            $produtos = $this->Produto->find('all', array('recursive' => 1));
            foreach($produtos as $produto){
                //verifica se já há modelos cadastrados
                if(!empty($produto['Modelo'])){
                    //possui modelos 
                    foreach ($produto['Modelo'] as $modelo){
                        //remover modelo
                        $this->Produto->Modelo->delete($modelo['id']);
                        $new_modelo = array();
                        $new_modelo['Modelo']['produto_id'] = $produto['Produto']['id'];
                        $new_modelo['Modelo']['nome'] = $modelo['nome'].' (Voltagem: 110V)';
                        $this->Produto->Modelo->create();
                        $this->Produto->Modelo->save($new_modelo);
                        $new_modelo['Modelo']['nome'] = $modelo['nome'].' (Voltagem: 220V)';
                        $this->Produto->Modelo->create();
                        $this->Produto->Modelo->save($new_modelo);
                    }
                }else{
                    //não possui modelos, criar para a voltagem
                    $new_modelo = array();
                    $new_modelo['Modelo']['produto_id'] = $produto['Produto']['id'];
                    $new_modelo['Modelo']['nome'] = 'Voltagem: 110V';
                    $this->Produto->Modelo->create();
                    $this->Produto->Modelo->save($new_modelo);
                    $new_modelo['Modelo']['nome'] = 'Voltagem: 220V';
                    $this->Produto->Modelo->create();
                    $this->Produto->Modelo->save($new_modelo);
                }
            }
        }
        function teste_email(){
            //enviar e-mail para o cliente sobre a criação da conta.
            $array_mesclagem = array();
            $array_mesclagem['nome'] = 'Douglas';
            if($this->envia_email($this->config_sistema['Configuracao']['nome_responsavel'], $this->config_sistema['Configuracao']['email'], 'E-mail de teste' ,'teste_email', $array_mesclagem))
                $this->Session->setFlash(__('Email de teste enviado', true));
            else
                $this->Session->setFlash(__('Falha ao enviar o e-mail. Verifique os dados de conexão', true));
            $this->redirect('/lojas/dados_gerais');
        }
        /*
         * Mudar o valor do frete para um valor fixo, para que possa ser usado para testes de pagamento, por exemplo
         */
        function ajusta_valor_frete(){
            $pedido = $this->Session->read('Pedido');
            $pedido['Pedido']['frete'] = 1;
            $pedido['Pedido']['frete_form'] = number_format($pedido['Pedido']['frete'], 2, ',', '');
            $this->Session->write('Pedido', $pedido);
            $this->redirect('/pedidos/pagamento');
        }
        function compactar_imagens_produtos(){
            $this->loadModel('Produto');
            $produtos = $this->Produto->find('all');
            //para cada produto, compactar suas imagens e cirar uma miniatura para cada uma
            foreach($produtos as $produto){
                foreach($produto['Foto'] as $foto){
                      if( !strstr($foto['nome_img'], '_mini.') ){
                      //if( true ){  
                        $nome = $foto['nome'];
                        $nome_mini = str_replace('.', '_mini.', $foto['nome']);
                        $folder_url = WWW_ROOT.'fotos';   
                        $url = $folder_url.DS.$nome;  
                        $url_mini = $folder_url.DS.$nome_mini;  
                        echo 'URL: '.$url.'<br>';
                        echo 'URL_MINI: '.$url_mini.'<br>';
                        //diminuir imagem
                        $this->Image->resize_img($url, '700', $url) ;
                        //criar miniatura
                        $this->Image->resize_img($url, '200', $url_mini) ;
                        //grava miniatura na foto
                        $foto_banco = $this->Produto->Foto->find('first', array('conditions' => array('Foto.id' => $foto['id'])));
                        $foto_banco['Foto']['nome_img'] = $nome_mini;
                        $this->Produto->Foto->save($foto_banco);    
                    }
                }
                if( !strstr($produto['Produto']['img_mini'], '_mini.') ){
                //if( true){
                    //atualiza a foto mini do produto
                    $produto['Produto']['img_mini'] = str_replace('.', '_mini.', $produto['Produto']['img_mini']);
                    $this->Produto->save($produto);
                }
            }
        }
        function compactar_imagens_produtos_facebook(){
            $this->loadModel('Produto');
            $produtos = $this->Produto->find('all');
            //para cada produto, compactar suas imagens e cirar uma miniatura para cada uma
            foreach($produtos as $produto){
                foreach($produto['Foto'] as $foto){
                      if(true){
                      //if( true ){  
                        $nome = $foto['nome'];
                        $nome_mini = str_replace('.', '_mini_facebook.', $foto['nome']);
                        $folder_url = WWW_ROOT.'fotos';   
                        $url = $folder_url.DS.$nome;  
                        $url_mini = $folder_url.DS.$nome_mini;  
                        echo 'URL_MINI: '.$url.'<br>';
                        echo 'URL_MINI_FACEBOOK: '.$url_mini.'<br>';
                        //diminuir imagem
                        //$this->Image->resize_img($url, '700', $url) ;
                        //criar miniatura faebook
                        $this->Image->resize_img($url, '130', $url_mini) ;
                        //grava miniatura na foto
//                        $foto_banco = $this->Produto->Foto->find('first', array('conditions' => array('Foto.id' => $foto['id'])));
//                        $foto_banco['Foto']['nome_img'] = $nome_mini;
//                        $this->Produto->Foto->save($foto_banco);    
                    }
                }
//                if( !strstr($produto['Produto']['img_mini'], '_mini.') ){
//                //if( true){
//                    //atualiza a foto mini do produto
//                    $produto['Produto']['img_mini'] = str_replace('.', '_mini.', $produto['Produto']['img_mini']);
//                    $this->Produto->save($produto);
//                }
            }
        }
        function compactar_imagens_galeria(){
            $this->loadModel('Fotogaleria');
            $fotos = $this->Fotogaleria->find('all');
            //para cada produto, compactar suas imagens e cirar uma miniatura para cada uma
            foreach($fotos as $foto){
                //if( !strstr($foto['Fotogaleria']['mini_img'], '_mini.') ){
                if(true){
                    $nome = $foto['Fotogaleria']['nome_img'];
                    $nome_mini = str_replace('.', '_mini.', $foto['Fotogaleria']['nome_img']);
                    $folder_url = WWW_ROOT.'fotos';   
                    $url = $folder_url.DS.$nome;  
                    $url_mini = $folder_url.DS.$nome_mini;  
                    echo 'URL: '.$url.'<br>';
                    echo 'URL_MINI: '.$url_mini.'<br>';
                    //diminuir imagem
                    $this->Image->resize_img($url, '800', $url) ;
                    //criar miniatura
                    $this->Image->resize_img($url, '200', $url_mini) ;
                    $foto['Fotogaleria']['mini_img'] = $nome_mini;
                    $this->Fotogaleria->save($foto);
                }
            }
        }
        function muda_status_pedido(){
            $this->loadModel('Statuspedido');
            $status = $this->Statuspedido->read(null, 5);
            $status['Statuspedido']['nome'] = 'Não autorizado';
            $this->Statuspedido->save($status);
            $status = $this->Statuspedido->read(null, 6);
            $status['Statuspedido']['nome'] = 'Completado';
            $this->Statuspedido->save($status);
        }
        function atualiza_valor_pedido(){
            $this->loadModel('Pedido');
            $pedidos = $this->Pedido->find('all', array(  'recursive' => '1'));
            foreach($pedidos as $key => $pedido){
                $pedido['Pedido']['valor_total'] = $this->Pedido->obtemValorTotal($pedido['Pedido']['id']);
                $this->Pedido->save($pedido);
            }
            $this->layout = false;
        }
        function edit_photo_header(){
            $this->set('content_title', 'Editar fotos do header');
        }
        
        function relatorios(){
            $this->set('content_title', 'Relatórios');
        }
}
?>