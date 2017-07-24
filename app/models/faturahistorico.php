<?php
class Faturahistorico extends AppModel {
	var $name = 'Faturahistorico';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Fatura' => array(
			'className' => 'Fatura',
			'foreignKey' => 'fatura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        function grava_historico($fatura_id){
            $var = $this->Fatura->read(null, $fatura_id);
            $historico = array();
            $historico['Faturahistorico'] = $var['Fatura'];
            $historico['Faturahistorico']['fatura_id'] = $var['Fatura']['id'];
            unset($historico['Faturahistorico']['id']);
            unset($historico['Faturahistorico']['created']);
            unset($historico['Faturahistorico']['modified']);
            $this->create();
            $this->save($historico);
        }
}
?>