<?php
class AppController extends Controller {
    var $components = array('Acl', 'Auth', 'Session', 'Email', 'SwiftMailer', 'PagSeguro.Checkout', 'Image', 'Correio', 'CieloPedido');
    var $helpers = array('Html', 'Form', 'Session');
    var $layout = 'style_new';

    //Variáveis de configuração do sistema, são verificadas no beforeFilter()
    var $config_sistema = array();
    var $side_bar = array();
    var $categorias = array();
    var $marcas = array();
    var $subcategorias = array();
    var $fotoheaders = array();
    /* Função para envio de e-mail.
     * Parâmetros:
     * 	$to_name:
     * 	$to_email:
     * 	$tipo_email:
     *  $array_mesclagem: 
     */
//    function envia_email_old($to_name, $to_email, $assunto, $template_email, $array_mesclagem = array()){
//		
//                //$this->debugVar($config);   
//                
//                if($this->config_sistema['Configuracao']['envia_email'] == 1){
//		
//                    $this->SwiftMailer->smtpType = 'tls'; 
//                    $this->SwiftMailer->smtpHost = $this->config_sistema['Configuracao']['mail_host']; 
//                    $this->SwiftMailer->smtpPort = $this->config_sistema['Configuracao']['mail_port']; 
//                    $this->SwiftMailer->smtpUsername = $this->config_sistema['Configuracao']['mail_username']; 
//                    $this->SwiftMailer->smtpPassword = $this->config_sistema['Configuracao']['mail_password']; 
//
//                    $this->SwiftMailer->sendAs = 'html'; 
//                    $this->SwiftMailer->from = $this->config_sistema['Configuracao']['mail_username']; 
//                    $this->SwiftMailer->fromName = $this->config_sistema['Configuracao']['nome_empresa']; 
//                    $this->SwiftMailer->to = $to_email; 
//                    
//                    if($template_email == 'contato'){
//                        $this->SwiftMailer->replyTo = $array_mesclagem['email'];
//                    }
//                    
//                    $this->SwiftMailer->bcc = 'douglasofreitas@ig.com.br';
//                    
//                    $this->set('site_url', $this->config_sistema['Configuracao']['site_url']);
//                    foreach($array_mesclagem as $nome_campo => $value){
//                            $this->set($nome_campo, $value);
//                    }
//                    
//                    try { 
//                        if(!$this->SwiftMailer->send($template_email, '['.$this->config_sistema['Configuracao']['nome_empresa'].'] '.$assunto)) { 
//                            $this->log("Error sending email"); 
//                            return false;
//                        } else
//                            return true;
//                    } 
//                    catch(Exception $e) { 
//                          $this->log("Failed to send email: ".$e->getMessage()); 
//                    } 	
//		}else{
//			return false;
//		}
//                
//		return false;
//	}


    function salvar_email($to_name, $to_email, $assunto, $template_email, $array_mesclagem = array(), $tag = null, $ref_id = null, $enviar_oculto = false){

        //$this->debugVar($config);

        if($this->config_sistema['Configuracao']['envia_email'] == 1){

            //$this->SwiftMailer = new $this->SwiftMailer();

            $this->SwiftMailer->smtpType = 'tls';
            $this->SwiftMailer->smtpHost = $this->config_sistema['Configuracao']['mail_host'];
            $this->SwiftMailer->smtpPort = $this->config_sistema['Configuracao']['mail_port'];
            $this->SwiftMailer->smtpUsername = $this->config_sistema['Configuracao']['mail_username'];
            $this->SwiftMailer->smtpPassword = $this->config_sistema['Configuracao']['mail_password'];

            $this->SwiftMailer->sendAs = 'html';
            $this->SwiftMailer->from = $this->config_sistema['Configuracao']['mail_username'];
            $this->SwiftMailer->fromName = $this->config_sistema['Configuracao']['nome_empresa'];
            $this->SwiftMailer->bcc = 'douglas@grupodf.com';
            if($enviar_oculto){
                $this->SwiftMailer->bcc = $to_email;
                $this->SwiftMailer->to = $this->config_sistema['Configuracao']['email']; ;
            }else{
                $this->SwiftMailer->to = $to_email;
            }


            if($template_email == 'contato' | $template_email == 'encomenda' |  $template_email == 'mala_direta'){
                $this->SwiftMailer->replyTo = $array_mesclagem['email'];
            }



            //preparar corpo do email

            //selecionar template
            $this->loadModel('Emailloja');
            $emailloja = $this->Emailloja->find('first', array('conditions' => array('Emailloja.sigla' => $template_email), 'recursive' => 2 ));
            $template = $this->config_sistema['Configuracao']['email_cabecalho'];
            $template .= $emailloja['Emailloja']['texto'];
            //incluir rodape do e-mail
            $template .= $this->config_sistema['Configuracao']['email_assinatura'];
            $template .= $this->config_sistema['Configuracao']['email_rodape'];

            //substituindo variáveis de mesclagem
            $template = str_replace('##site##', $this->config_sistema['Configuracao']['site_url'], $template);
            foreach($array_mesclagem as $nome_campo => $value){
                $template = str_replace('##'.$nome_campo.'##', $value, $template);
            }

            $this->set('corpo_email', $template);

            //prepara histórico de envio de e-mail
            $this->loadModel('EmailHistorico');
            $emailhistorico = array();
            $emailhistorico['EmailHistorico']['sigla'] = $template_email;
            $emailhistorico['EmailHistorico']['remetente'] = $this->config_sistema['Configuracao']['mail_username'];
            if(is_array($to_email)){
                $emails_lista = '';
                foreach($to_email as $item_email){
                    if(empty($emails_lista)){
                        $emails_lista = $item_email;
                    }else{
                        $emails_lista .= ', '.$item_email;
                    }
                }
                $emailhistorico['EmailHistorico']['destino'] = $emails_lista;
            }else{
                $emailhistorico['EmailHistorico']['destino'] = $to_email;
            }
            $emailhistorico['EmailHistorico']['assunto'] = $assunto;
            $emailhistorico['EmailHistorico']['corpo'] = $template;
            $emailhistorico['EmailHistorico']['user_id'] = $this->Auth->user('id');
            $emailhistorico['EmailHistorico']['tag'] = $tag;
            if($enviar_oculto)
                $emailhistorico['EmailHistorico']['envia_oculto'] = 1;
            $emailhistorico['EmailHistorico']['ref_id'] = $ref_id;
            $emailhistorico['EmailHistorico']['enviado'] = 0;
            $this->EmailHistorico->save($emailhistorico);
            $mala_direta_id = $this->EmailHistorico->getInsertId();

            return $mala_direta_id;

        }else{
            return false;
        }
    }

        function envia_email($to_name, $to_email, $assunto, $template_email, $array_mesclagem = array(), $tag = null, $ref_id = null, $enviar_oculto = false){
		
                //$this->debugVar($config);   
            
                if($this->config_sistema['Configuracao']['envia_email'] == 1){
                    
                    //$this->SwiftMailer = new $this->SwiftMailer();
                    
                    $this->SwiftMailer->smtpType = 'tls'; 
                    $this->SwiftMailer->smtpHost = $this->config_sistema['Configuracao']['mail_host']; 
                    $this->SwiftMailer->smtpPort = $this->config_sistema['Configuracao']['mail_port']; 
                    $this->SwiftMailer->smtpUsername = $this->config_sistema['Configuracao']['mail_username']; 
                    $this->SwiftMailer->smtpPassword = $this->config_sistema['Configuracao']['mail_password']; 

                    $this->SwiftMailer->sendAs = 'html'; 
                    $this->SwiftMailer->from = $this->config_sistema['Configuracao']['mail_username']; 
                    $this->SwiftMailer->fromName = $this->config_sistema['Configuracao']['nome_empresa']; 
                    $this->SwiftMailer->bcc = 'douglas@grupodf.com';
                    if($enviar_oculto){
                        $this->SwiftMailer->bcc = $to_email;
                        $this->SwiftMailer->to = $this->config_sistema['Configuracao']['email']; ;
                    }else{
                        $this->SwiftMailer->to = $to_email;
                    }
                    
                    
                    if($template_email == 'contato' | $template_email == 'encomenda' |  $template_email == 'mala_direta'){
                        $this->SwiftMailer->replyTo = $array_mesclagem['email'];
                    }
                    
                    
                    
                    //preparar corpo do email


                    if($tag != 'mala_direta'){
                        //selecionar template

                        $this->loadModel('Emailloja');
                        $emailloja = $this->Emailloja->find('first', array('conditions' => array('Emailloja.sigla' => $template_email), 'recursive' => 2 ));

                        $template = $this->config_sistema['Configuracao']['email_cabecalho'];
                        $template .= $emailloja['Emailloja']['texto'];
                        //incluir rodape do e-mail
                        $template .= $this->config_sistema['Configuracao']['email_assinatura'];
                        $template .= $this->config_sistema['Configuracao']['email_rodape'];

                        //substituindo variáveis de mesclagem
                        $template = str_replace('##site##', $this->config_sistema['Configuracao']['site_url'], $template);
                        foreach($array_mesclagem as $nome_campo => $value){
                            $template = str_replace('##'.$nome_campo.'##', $value, $template);
                        }
                    }else{

                        $template = $array_mesclagem['mensagem'];
                    }

                    $this->set('corpo_email', $template);

                    //prepara histórico de envio de e-mail
                    $this->loadModel('EmailHistorico');
                    $emailhistorico = array();
                    $emailhistorico['EmailHistorico']['sigla'] = $template_email;
                    $emailhistorico['EmailHistorico']['remetente'] = $this->config_sistema['Configuracao']['mail_username'];
                    if(is_array($to_email)){
                        $emails_lista = '';
                        foreach($to_email as $item_email){
                            if(empty($emails_lista)){
                                $emails_lista = $item_email;
                            }else{
                                $emails_lista .= ', '.$item_email;
                            }
                        }
                        $emailhistorico['EmailHistorico']['destino'] = $emails_lista;
                    }else{
                        $emailhistorico['EmailHistorico']['destino'] = $to_email;
                    }
                    $emailhistorico['EmailHistorico']['assunto'] = $assunto;
                    $emailhistorico['EmailHistorico']['corpo'] = $template;
                    $emailhistorico['EmailHistorico']['user_id'] = $this->Auth->user('id');
                    $emailhistorico['EmailHistorico']['tag'] = $tag;
                    if($enviar_oculto)
                        $emailhistorico['EmailHistorico']['envia_oculto'] = 1;
                    $emailhistorico['EmailHistorico']['ref_id'] = $ref_id;
                    
                    try { 
                        if(!$this->SwiftMailer->send('vazio', '['.$this->config_sistema['Configuracao']['nome_empresa'].'] '.$assunto.'.')) { 
                            $this->log("Error sending email"); 
                            $emailhistorico['EmailHistorico']['enviado'] = 0;
                            if($tag != 'mala-direta') $this->EmailHistorico->save($emailhistorico);
                            return false;
                        } else{
                            $emailhistorico['EmailHistorico']['enviado'] = 1;
                            if($tag != 'mala-direta') $this->EmailHistorico->save($emailhistorico);
                            return true;
                        }
                    } 
                    catch(Exception $e){
                        $this->log("Failed to send email: ".$e->getMessage()); 
                        $emailhistorico['EmailHistorico']['enviado'] = 0;
                        if($tag != 'mala-direta') $this->EmailHistorico->save($emailhistorico);
                    }
                    
		}else{
			return false;
		}
                
		return false;
	}
	
    function beforeFilter() {
    	
        //Configure AuthComponent
        $this->Auth->authorize = 'actions';
        $this->Auth->actionPath = 'controllers/';
        //$this->Auth->allowedActions = array('display');
        //$this->Auth->allow(array('*'));
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'produtos', 'action' => 'index');
        $this->Auth->loginRedirect = array('controller' => 'produtos', 'action' => 'index');
        $this->Auth->autoRedirect = true;
        
        $this->Auth->loginError = "Usuário ou senha incorreta";
        $this->Auth->authError  = "Você não pode acessar esta página!";

        //coletando atributos do usuário para o layout
        $this->loadModel('Group');
        $grupo_usuario = $this->Group->getNome($this->Auth->user('group_id'));
        $nome_usuario = $this->Auth->user('name');
        
        //Verificando configurações do sistema
        $this->loadModel('Configuracao');
        $this->Configuracao->create();
        $this->config_sistema = $this->Configuracao->read(null, 1);

        //método de pagamento PagSeguro
        $this->Checkout->config(array(
            'email' => $this->config_sistema['Configuracao']['pagseguro_email'], // Email da conta do vendedor
            'token' => $this->config_sistema['Configuracao']['pagseguro_token'], // Token gerado pelo PagSeguro
            'timeout' => 5000,
            'charset' => 'UTF-8'
        ));
        
        //$this->debugVar($this->Auth->user('nome'));
        
        //verificar se a sessão já possui as configurações de exibição da barra lateral.
        if(!$this->Session->check('SideBar.tipo')){
        	$this->Session->write('SideBar.tipo', 'produtos');
        	$barra_lateral = 'produtos';
        }else{
        	$barra_lateral = $this->Session->read('SideBar.tipo');
        }
    	
        //verificar se a sessão já possui as configurações de exibição da barra de topo. 
    	if(!$this->Session->check('TopBar.tipo')){
        	$this->Session->write('TopBar.tipo', $grupo_usuario);
        	$barra_topo = $grupo_usuario;
        }else{
        	//$barra_topo = $this->Session->read('TopBar.tipo');
        	$this->Session->write('TopBar.tipo', $grupo_usuario);
        	$barra_topo = $grupo_usuario;
        }
        
        //obter dados da barra lateral.
        $this->loadModel('Categoria');
        $this->side_bar = $this->Categoria->find('all', array('conditions' => array(), 'recursive' => 1 ));
        
        foreach($this->side_bar as $cat){
            $this->categorias[$cat['Categoria']['id']] = $cat;
        }
        //obter subcategorias e modelos
        $sub_categorias = $this->Categoria->Subcategoria->find('all', array('conditions' => array(), 'recursive' => 1 ));
        
        foreach($sub_categorias as $subcat){
            $this->subcategorias[$subcat['Subcategoria']['id']] = $subcat;
        }

        //obter marcas
        $this->loadModel('Marca');
        $this->marcas = $this->Marca->find('all');
        
        
        //url da página atual
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
            $http = 'https';
        else
            $http = 'http';
        $selfURL = $http . '://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        
        //carregar imagens do slider
        $this->loadModel('Fotoheader');
        $this->fotoheaders = $this->Fotoheader->find('all', array('conditions' => array(), 'recursive' => 0 ));
        
        $this->set('login_group', $grupo_usuario);
        $this->set('login_group_id', $this->Auth->user('group_id'));
        $this->set('login_nome', $nome_usuario);
        $this->set('name_side_bar', $barra_lateral );
        $this->set('name_top_bar', $barra_topo);
        $this->set('side_bar', $this->side_bar);
        $this->set('categorias', $this->categorias);
        $this->set('marcas', $this->marcas);
        $this->set('subcategorias', $this->subcategorias);
        $this->set('fotoheaders', $this->fotoheaders);
        $this->set('nameSession', 'manage');
       	$this->set('controller_name', 'home');
        
        $this->set('config_sistema', $this->config_sistema);
        $this->set('selfURL', $selfURL);
        
//        echo '<pre>';
//        print_r($_SERVER);
//        echo '</pre>';
        
        //obter a lista de categorias para o menu lateral de acordo com o 
        //(galeria ou produto - é definido no controler na sessão e usada na view)
        //$this->loadModel('Subcategoria');
        
    }
	
    function codificar($string){ 
        if((isset($string)) && (is_string($string))){ 
            $enc_string = base64_encode($string); 
            $enc_string = str_replace("=","",$enc_string);
            $enc_string = strrev($enc_string);
            $md5 = md5($string); 
            $enc_string = substr($md5,0,3).$enc_string.substr($md5,-3);
        }else{ 
            $enc_string = "Parâmetro incorreto ou inexistente!";
        } 
        return $enc_string; 
    } 
    function descodificar($string){
        if((isset($string)) && (is_string($string))){ 
            $ini = substr($string,0,3);
            $end = substr($string,-3);
            $des_string = substr($string,0,-3);
            $des_string = substr($des_string,3);
            $des_string = strrev($des_string); 
            $des_string = base64_decode($des_string); 
            $md5 = md5($des_string); 
            $ver = substr($md5,0,3).substr($md5,-3);
            if($ver != $ini.$end){
                $des_string = "Erro na desencriptação!"; 
            }
        }else{
            $des_string = "Parâmetro incorreto ou inexistente!"; 
        } 
        return $des_string; 
    } 
    
    /** 
    * uploads files to the server 
    * @params: 
    *      $folder     = the folder to upload the files e.g. 'img/files' 
    *      $formdata   = the array containing the form files 
    *      $itemId     = id of the item (optional) will create a new sub folder 
    * @return: 
    *      will return an array with the success of each file upload 
    */  
    function uploadFiles($folder, $formdata, $itemId = null, $names = array(), $resize = false, $lado_max = 200, $filename_mini = null, $lado_max_mini = 100) {  
            // setup dir names absolute and relative  
            $folder_url = WWW_ROOT.$folder;  
            $rel_url = $folder;  

            // create the folder if it does not exist  
            if(!is_dir($folder_url)) {  
                    mkdir($folder_url);  
            }  

            // if itemId is set create an item folder  
            if($itemId) {  
                    // set new absolute folder  
                    $folder_url = WWW_ROOT.$folder.'/'.$itemId;   
                    // set new relative folder  
                    $rel_url = $folder.'/'.$itemId;  
                    // create directory  
                    if(!is_dir($folder_url)) {  
                            mkdir($folder_url);  
                    }  
            }  

            // list of permitted file types,
            $permitted = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/gif', 'image/bmp', 'image/png' );  

            // loop through and deal with the files  
            foreach($formdata as $key => $file) {  
                    if(!empty($names[$key])) {
                            $filename = $names[$key];
                    }else{
                            // replace spaces with underscores 
                            $filename = str_replace(' ', '_', $file['name']);
                    }
                    // assume filetype is false  
                    $typeOK = false;  

                    // check filetype is ok
                    if(in_array($file['type'], $permitted)) 
                            $typeOK = true;  

                    // if file type ok upload the file  
                    if($typeOK) {  
                            // switch based on error code  
                            switch($file['error']) {  
                                    case 0:  
                                            $url = $folder_url.'/'.$filename;  
                                            $success = move_uploaded_file($file['tmp_name'], $url);  
                                            // if upload was successful  
                                            if($success) {  
                                                    // save the url of the file  
                                                    $result['urls'][] = $url;  
                                                    
                                                    //diminuir imagem
                                                    if($resize){
                                                        $this->Image->resize_img($url, $lado_max, $url) ;
                                                    }
                                                    
                                                    //criar miniatura
                                                    if(!empty($filename_mini)){
                                                        $url_mini = $folder_url.'/'.$filename_mini;  
                                                        $result['urls'][] = $url_mini;  
                                                        $this->Image->resize_img($url, $lado_max_mini, $url_mini) ;
                                                        
                                                        //facebook
                                                        $url_mini_facebook = $folder_url.'/'.str_replace('_mini', '_mini_facebook', $filename_mini);  
                                                        $this->Image->resize_img($url, 130, $url_mini_facebook) ;
                                                    }
                                                    
                                                    
                                            } else {  
                                                    $result['errors'][] = "Error uploaded $filename. Please try again.";  
                                            }  
                                            break;  
                                    case 3:  
                                            // an error occured  
                                            $result['errors'][] = "Error uploading $filename. Please try again.";  
                                            break;  
                                    default:  
                                            // an error occured  
                                            $result['errors'][] = "System error uploading $filename. Contact webmaster.";  
                                            break;  
                            }  
                    } elseif($file['error'] == 4) {  
                            // no file was selected for upload  
                            $result['nofiles'][] = "No file Selected";  
                    } else {  
                            // unacceptable file type  
                            $result['errors'][] = "$filename cannot be uploaded. Acceptable file types: png, jpg, bmp, gif.";  
                    }  
            }  
            return $result;  
    } 

    function deleteFiles($folder, $itemId = null, $names = array()) {
            // setup dir name 
            $folder_url = WWW_ROOT.$folder;  

            // if itemId is set create an item folder  
            if($itemId) {  
                    // set new absolute folder  
                    $folder_url = WWW_ROOT.$folder.'/'.$itemId;   
            }  

            // loop through and delete files  
            foreach($names as $filename) {  
                    $url = $folder_url.'/'.$filename;  
                    if(file_exists($url)) unlink($url);
            }
            return true;  
    }

    function debugVar($obj){
            echo '<pre>';
            print_r($obj);
            echo '</pre>';
    }

	
    function build_acl() {
            if (!Configure::read('debug')) {
                    return $this->_stop();
            }
            $log = array();

            $aco =& $this->Acl->Aco;
            $root = $aco->node('controllers');
            if (!$root) {
                    $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
                    $root = $aco->save();
                    $root['Aco']['id'] = $aco->id; 
                    $log[] = 'Created Aco node for controllers';
            } else {
                    $root = $root[0];
            }   

            App::import('Core', 'File');
            $Controllers = App::objects('controller');
            $appIndex = array_search('App', $Controllers);
            if ($appIndex !== false ) {
                    unset($Controllers[$appIndex]);
            }
            $baseMethods = get_class_methods('Controller');
            $baseMethods[] = 'build_acl';

            $Plugins = $this->_getPluginControllerNames();
            $Controllers = array_merge($Controllers, $Plugins);

            // look at each controller in app/controllers
            foreach ($Controllers as $ctrlName) {
                    $methods = $this->_getClassMethods($this->_getPluginControllerPath($ctrlName));

                    // Do all Plugins First
                    if ($this->_isPlugin($ctrlName)){
                            $pluginNode = $aco->node('controllers/'.$this->_getPluginName($ctrlName));
                            if (!$pluginNode) {
                                    $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginName($ctrlName)));
                                    $pluginNode = $aco->save();
                                    $pluginNode['Aco']['id'] = $aco->id;
                                    $log[] = 'Created Aco node for ' . $this->_getPluginName($ctrlName) . ' Plugin';
                            }
                    }
                    // find / make controller node
                    $controllerNode = $aco->node('controllers/'.$ctrlName);
                    if (!$controllerNode) {
                            if ($this->_isPlugin($ctrlName)){
                                    $pluginNode = $aco->node('controllers/' . $this->_getPluginName($ctrlName));
                                    $aco->create(array('parent_id' => $pluginNode['0']['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginControllerName($ctrlName)));
                                    $controllerNode = $aco->save();
                                    $controllerNode['Aco']['id'] = $aco->id;
                                    $log[] = 'Created Aco node for ' . $this->_getPluginControllerName($ctrlName) . ' ' . $this->_getPluginName($ctrlName) . ' Plugin Controller';
                            } else {
                                    $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
                                    $controllerNode = $aco->save();
                                    $controllerNode['Aco']['id'] = $aco->id;
                                    $log[] = 'Created Aco node for ' . $ctrlName;
                            }
                    } else {
                            $controllerNode = $controllerNode[0];
                    }

                    //clean the methods. to remove those in Controller and private actions.
                    foreach ($methods as $k => $method) {
                            if (strpos($method, '_', 0) === 0) {
                                    unset($methods[$k]);
                                    continue;
                            }
                            if (in_array($method, $baseMethods)) {
                                    unset($methods[$k]);
                                    continue;
                            }
                            $methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
                            if (!$methodNode) {
                                    $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
                                    $methodNode = $aco->save();
                                    $log[] = 'Created Aco node for '. $method;
                            }
                    }
            }
            if(count($log)>0) {
                    debug($log);
            }
    }

    function _getClassMethods($ctrlName = null) {
            App::import('Controller', $ctrlName);
            if (strlen(strstr($ctrlName, '.')) > 0) {
                    // plugin's controller
                    $num = strpos($ctrlName, '.');
                    $ctrlName = substr($ctrlName, $num+1);
            }
            $ctrlclass = $ctrlName . 'Controller';
            $methods = get_class_methods($ctrlclass);

            // Add scaffold defaults if scaffolds are being used
            $properties = get_class_vars($ctrlclass);
            if (array_key_exists('scaffold',$properties)) {
                    if($properties['scaffold'] == 'admin') {
                            $methods = array_merge($methods, array('admin_add', 'admin_edit', 'admin_index', 'admin_view', 'admin_delete'));
                    } else {
                            $methods = array_merge($methods, array('add', 'edit', 'index', 'view', 'delete'));
                    }
            }
            return $methods;
    }

    function _isPlugin($ctrlName = null) {
            $arr = String::tokenize($ctrlName, '/');
            if (count($arr) > 1) {
                    return true;
            } else {
                    return false;
            }
    }

    function _getPluginControllerPath($ctrlName = null) {
            $arr = String::tokenize($ctrlName, '/');
            if (count($arr) == 2) {
                    return $arr[0] . '.' . $arr[1];
            } else {
                    return $arr[0];
            }
    }

    function _getPluginName($ctrlName = null) {
            $arr = String::tokenize($ctrlName, '/');
            if (count($arr) == 2) {
                    return $arr[0];
            } else {
                    return false;
            }
    }

    function _getPluginControllerName($ctrlName = null) {
            $arr = String::tokenize($ctrlName, '/');
            if (count($arr) == 2) {
                    return $arr[1];
            } else {
                    return false;
            }
    }

    /** 
    * Get the names of the plugin controllers ...
    * 
    * This function will get an array of the plugin controller names, and
    * also makes sure the controllers are available for us to get the 
    * method names by doing an App::import for each plugin controller.
    *
    * @return array of plugin names.
    *
    */
    function _getPluginControllerNames() {
            App::import('Core', 'File', 'Folder');
            $paths = Configure::getInstance();
            $folder =& new Folder();
            $folder->cd(APP . 'plugins');

            // Get the list of plugins
            $Plugins = $folder->read();
            $Plugins = $Plugins[0];
            $arr = array();

            // Loop through the plugins
            foreach($Plugins as $pluginName) {
                    // Change directory to the plugin
                    $didCD = $folder->cd(APP . 'plugins'. DS . $pluginName . DS . 'controllers');
                    // Get a list of the files that have a file name that ends
                    // with controller.php
                    $files = $folder->findRecursive('.*_controller\.php');

                    // Loop through the controllers we found in the plugins directory
                    foreach($files as $fileName) {
                            // Get the base file name
                            $file = basename($fileName);

                            // Get the controller name
                            $file = Inflector::camelize(substr($file, 0, strlen($file)-strlen('_controller.php')));
                            if (!preg_match('/^'. Inflector::humanize($pluginName). 'App/', $file)) {
                                    if (!App::import('Controller', $pluginName.'.'.$file)) {
                                            debug('Error importing '.$file.' for plugin '.$pluginName);
                                    } else {
                                            /// Now prepend the Plugin name ...
                                            // This is required to allow us to fetch the method names.
                                            $arr[] = Inflector::humanize($pluginName) . "/" . $file;
                                    }
                            }
                    }
            }
            return $arr;
    }

	
}
?>