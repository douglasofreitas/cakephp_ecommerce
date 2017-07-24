<?php
class CepFrete extends AppModel {
	var $name = 'CepFrete';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array();
        function valorFrete($cep_destino, $valor_frete){
            $faixa = $this->find('first', array('conditions' => array('CepFrete.cep_inicio <= ' => $cep_destino, 'CepFrete.cep_fim >= ' => $cep_destino)));
            if($faixa){
                if(!empty($faixa['CepFrete']['valor'])){
                    //valor fixo para o frete
                    return $faixa['CepFrete']['valor'];
                }elseif(!empty($faixa['CepFrete']['porcentagem'])){
                    //possui porcentagem sobre o desconto
                    return $valor_frete*(100-$faixa['CepFrete']['porcentagem'])/100;
                }
                return $valor_frete;
            }else{
                return $valor_frete;
            }
        }
        function beforeSave($options) {
		if (!empty($this->data['CepFrete']['data_inicio'])) {
	    		$this->data['CepFrete']['data_inicio'] = $this->dateFormatBeforeSave($this->data['CepFrete']['data_inicio']);
		}
		if (!empty($this->data['CepFrete']['data_fim'])) {
	    		$this->data['CepFrete']['data_fim'] = $this->dateFormatBeforeSave($this->data['CepFrete']['data_fim']);
		}
                if (!empty($this->data['CepFrete']['valor'])) {
	    		$this->data['CepFrete']['valor'] = $this->valorFormatBeforeSave($this->data['CepFrete']['valor']);
		}
		return true;
	}
	function valorFormatBeforeSave($valor) {
		return str_replace(',', '.', $valor);
	}	
	function dateFormatBeforeSave($dateString) {
		list($d, $m, $y) = preg_split('/\//', $dateString);
		$dateString = sprintf('%4d%02d%02d', $y, $m, $d);
		return date('Y-m-d', strtotime($dateString)); // Direction is from 
	}
	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (!empty($val['CepFrete']['data_inicio'])) {
				$results[$key]['CepFrete']['data_inicio_form'] = $this->dateFormatAfterFind($val['CepFrete']['data_inicio']);
			}
                        if (!empty($val['CepFrete']['data_fim'])) {
				$results[$key]['CepFrete']['data_fim_form'] = $this->dateFormatAfterFind($val['CepFrete']['data_fim']);
			}
                        if (!empty($val['CepFrete']['valor'])) {
				$results[$key]['CepFrete']['valor_form'] = $this->valorFormatAfterFind($val['CepFrete']['valor']);
			}
		}
		return $results;
	}
	function valorFormatAfterFind($valor) {
		return number_format($valor, 2, ',', '');
	}
        function dateFormatAfterFind($dateString) {
		return date('d/m/Y', strtotime($dateString));
	}
}
?>