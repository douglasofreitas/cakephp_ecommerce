<?php
class Pedidohistorico extends AppModel {
	var $name = 'Pedidohistorico';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'pedido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        function grava_historico($pedido_id, $descricao = NULL){
            $var = $this->Pedido->read(null, $pedido_id);
            $historico = array();
            $historico['Pedidohistorico'] = $var['Pedido'];
            $historico['Pedidohistorico']['pedido_id'] = $var['Pedido']['id'];
            $historico['Pedidohistorico']['descricao'] = $descricao;
            unset($historico['Pedidohistorico']['id']);
            unset($historico['Pedidohistorico']['created']);
            unset($historico['Pedidohistorico']['modified']);
            $this->create();
            $this->save($historico);
        }
}
?>