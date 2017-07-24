<?php
class Pagsegurotransacao extends AppModel {
	var $name = 'Pagsegurotransacao';
	var $validate = array(
		
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Fatura' => array(
			'className' => 'Fatura',
			'foreignKey' => 'fatura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'pedido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        private function clearStr($str) {
		if (!get_magic_quotes_gpc()) {
			$str = addslashes($str);
		}
		return $str;
	}
        function valorFormatBeforeSave($valor) {
		return floatval(str_replace(',', '.', $valor));
	}
	function verifica_retorno($data, $token){
            $postdata = 'Comando=validar&Token='.$token;
            foreach ($data as $key => $value) {
                    $valued    = $this->clearStr($value);
                    $postdata .= "&$key=$valued";
            }
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://pagseguro.uol.com.br/pagseguro-ws/checkout/NPI.jhtml");
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_TIMEOUT, 5);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = trim(curl_exec($curl));
            curl_close($curl);
            return $result;
        }
        function verificar_e_save($evento){
                //salvar a transação no banco
                $pagseguro_transacao = array();
                if(!empty($evento['VendedorEmail']))
                $pagseguro_transacao['Pagsegurotransacao']['vendedoremail'] = $evento['VendedorEmail'];
                if(!empty($evento['TransacaoID']))
                $pagseguro_transacao['Pagsegurotransacao']['transacaoid'] = $evento['TransacaoID'];
                if(!empty($evento['Referencia']))
                $pagseguro_transacao['Pagsegurotransacao']['fatura_id'] = $evento['Referencia'];
                if(!empty($evento['Extras']))
                $pagseguro_transacao['Pagsegurotransacao']['extras'] = $evento['Extras'];
                if(!empty($evento['TipoFrete']))
                $pagseguro_transacao['Pagsegurotransacao']['tipofrete'] = $evento['TipoFrete'];
                if(!empty($evento['ValorFrete']))
                $pagseguro_transacao['Pagsegurotransacao']['valorfrete'] = $evento['ValorFrete'];
                if(!empty($evento['Anotacao']))
                $pagseguro_transacao['Pagsegurotransacao']['anotacao'] = $evento['Anotacao'];
                if(!empty($evento['DataTransacao']))
                $pagseguro_transacao['Pagsegurotransacao']['datatransacao'] = $evento['DataTransacao'];
                if(!empty($evento['TipoPagamento']))
                $pagseguro_transacao['Pagsegurotransacao']['tipopagamento'] = $evento['TipoPagamento'];
                if(!empty($evento['StatusTransacao']))
                $pagseguro_transacao['Pagsegurotransacao']['statustransacao'] = $evento['StatusTransacao'];
                if(!empty($evento['NumItens'])){
                    $pagseguro_transacao['Pagsegurotransacao']['numitens'] = $evento['NumItens'];
                    //calcular valor total do pedido no pagseguro
                    $valor_total = 0.0;
                    $num_itens = intval($evento['NumItens']);
                    for($i=1; $i<=$num_itens; $i++){
                        $valor_total += floatval($this->valorFormatBeforeSave($evento['ProdValor_'.$i]))*intval($evento['ProdQuantidade_'.$i]);
                    }
                    $pagseguro_transacao['Pagsegurotransacao']['valor_total'] = $valor_total;
                }
                //validar o _post do pagseguro
                $result_verificacao = $this->verifica_retorno($evento, $this->config_sistema['Configuracao']['pagseguro_token']);
                $pagseguro_transacao['Pagsegurotransacao']['verificacao'] = $result_verificacao;
                $this->save($pagseguro_transacao);
                return $pagseguro_transacao;
        }
}
?>