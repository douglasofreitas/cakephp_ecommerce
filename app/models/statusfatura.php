<?php
class Statusfatura extends AppModel {
	var $name = 'Statusfatura';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Fatura' => array(
			'className' => 'Fatura',
			'foreignKey' => 'statusfatura_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
        function getStatusId($nome_status){
            $status = $this->find('first', array('conditions' => array('Statusfatura.nome LIKE' => $nome_status), 
											'recursive' => '-1'));
            if(!empty($status['Statusfatura']['id']))
                return $status['Statusfatura']['id'];
            else
                return null;
        }
        function getStatusIdPagseguro($nome_status){
            //$status = $this->find('all');
            if(strpos($nome_status, 'Completado') !== false){
                return 6;
            }
            if(strpos($nome_status, 'Aguardando') !== false){
                return 1;
            }
            if(strpos($nome_status, 'Aprovado') !== false){
                return 4;
            }
            if(strpos($nome_status, 'Em') !== false){
                return 1;
            }
            if(strpos($nome_status, 'Cancelado') !== false){
                return 9;
            }
            return false;
        }
        function getFormSelect(){
                //Considerando para o PagSeguro
		$statusfatura = $this->find('all', array('conditions' => array(), 'recursive' => '-1'));
		$select_statusfatura = array();
		foreach($statusfatura as $status){
                    $id = $status['Statusfatura']['id'];
                    if($id == 1 | $id == 4 | $id == 6 | $id == 7 | $id == 9 )
			$select_statusfatura[$status['Statusfatura']['id']] = $status['Statusfatura']['nome'];
		}
		return $select_statusfatura;
	}
}
?>