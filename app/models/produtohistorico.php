<?php
class Produtohistorico extends AppModel {
	var $name = 'Produtohistorico';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Produto' => array(
			'className' => 'Produto',
			'foreignKey' => 'produto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        function grava_historico($produto_id, $descricao = null){
            $var = $this->Produto->read(null, $produto_id);
            $historico = array();
            $historico['Produtohistorico'] = $var['Produto'];
            $historico['Produtohistorico']['produto_id'] = $var['Produto']['id'];
            $historico['Produtohistorico']['descricao'] = $descricao;
            unset($historico['Produtohistorico']['id']);
            unset($historico['Produtohistorico']['created']);
            unset($historico['Produtohistorico']['modified']);
            $this->create();
            $this->save($historico);
        }
}
?>