<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/958/The-Pages-Controller
 */
class PagesController extends AppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Pages';
/**
 * Default helper
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html', 'Session', 'produtopack');
	var $components = array('Captcha');
/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array();
	var $nameSession = 'home';
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	function display() {
		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;
		if (!empty($path[0])) {
			$page = $path[0];
			//página inicial
			if($page == 'home'){
                            //$this->redirect('/produtos');
                            //$this->set('content_title', 'Home');
                            
                            //obter alguns produtos
                            $this->loadModel('Produto');
                            $produtos_venda = $this->Produto->find('all', array('conditions' => array('Produto.venda_somente_loja' => 0, 'Produto.ativo' => 1) , 'limit' => '9'));
                            $this->set('produtos_venda', $produtos_venda);
                            $produtos_showroow = $this->Produto->find('all', array('conditions' => array('Produto.venda_somente_loja' => 1, 'Produto.ativo' => 1) , 'limit' => '9'));
                            $this->set('produtos_showroow', $produtos_showroow);
                            $produtos_lancamento = $this->Produto->find('all', array('conditions' => array('Produto.lancamento' => 1, 'Produto.ativo' => 1) , 'limit' => '9'));
                            $this->set('produtos_lancamento', $produtos_lancamento);
                        }
                        //contato técnico
			if($page == 'contato_tecnico'){
                            $this->set('content_title', 'Contato Técnico');
                        }	
                        //contato
			if($page == 'contato'){
                            $this->set('content_title', 'Contato');
							$this->create_captcha();
                        }
                        //contato
			if($page == 'politica_privacidade'){
                            $this->set('content_title', 'Segurança e privacidade');
                        }
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
	
	function create_captcha()	{
            //App::import("Component","Captcha"); //including captcha class
            $this->Captcha =  new CaptchaComponent(); //creating an object instance
            $this->Captcha->controller = & $this; //assign this conroller(CaptchaController) object to its captcha object's controller property.
            $this->set('captcha_src',$captcha_src=$this->Captcha->create()); //create a capthca and assign to a variable
	}	
	
	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(array('*'));
		$this->set('nameSession', 'manage');
		$this->set('controller_name', 'produtos');
                $this->Session->write('SideBar.tipo', 'produtos');
		$this->set('name_side_bar', 'produtos' );
	}
}
