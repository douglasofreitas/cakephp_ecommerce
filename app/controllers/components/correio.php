<?php 
/*
 * Componente para obter dados pelo site dos correios
 * 
# Código dos Serviços dos Correios  
#    FRETE PAC = 41106       
#    FRETE SEDEX = 40010       
#    FRETE SEDEX 10 = 40215       
#    FRETE SEDEX HOJE = 40290    
#    FRETE E-SEDEX = 81019       
#    FRETE MALOTE = 44105       
#    FRETE NORMAL = 41017       
#   SEDEX A COBRAR = 40045       
 */
class CorreioComponent extends Object
{
    function CorreioComponent(){
    }
    function getNomeTipoPagamento($cod_tipo_correio){
        switch ($cod_tipo_correio){
            case 41106:
                return 'PAC';
                break;
            case 40010:
                return 'SEDEX';
                break;
            case 40215:
                return 'SEDEX 10';
                break;
            case 40290:
                return 'SEDEX HOJE';
                break;
            case 81019:
                return 'E-SEDEX';
                break;
            case 44105:
                return 'MALOTE';
                break;
            case 41017:
                return 'NORMAL';
                break;
            case 40045:
                return 'SEDEX A COBRAR';
                break;
        }
        return '';
    }
    function getSedex($cepOrigem, $cepDestino, $peso, $servico = 40010, $comprimento = 1, $largura = 1, $altura = 1, $valor_declarado =  0)
    {
        $urlCorreios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=$cepOrigem&sCepDestino=$cepDestino&nVlPeso=$peso&nCdFormato=1&nVlComprimento=$comprimento&nVlAltura=$altura&nVlLargura=$largura&sCdMaoPropria=s&nVlValorDeclarado=".intval($valor_declarado)."&sCdAvisoRecebimento=n&nCdServico=$servico&nVlDiametro=0&StrRetorno=xml";

        CakeLog::write('debug', 'COMPONENT CORREIO -- getSedex');
        CakeLog::write('debug', '$urlCorreios: '.$urlCorreios);

        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlCorreios);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 15);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		$conteudo = curl_exec($ch);
		curl_close($ch);
		$conteudo = trim(str_replace(array("\n", chr(13)), "", $conteudo));
		$consulta_valida = true;
		preg_match_all("/<Valor>(.+)<\/Valor>/", $conteudo, $valor);
		preg_match_all("/<EntregaDomiciliar>(.+)<\/EntregaDomiciliar>/", $conteudo, $entrega_domiciliar);
		preg_match_all("/<PrazoEntrega>(.+)<\/PrazoEntrega>/", $conteudo, $prazo_entrega);
		preg_match_all("/<Erro>(.+)<\/Erro>/", $conteudo, $erro);
		if(!isset($valor[1][0]))
			$consulta_valida = false;
		if(!isset($entrega_domiciliar[1][0]))
			$consulta_valida = false;
		if(!isset($prazo_entrega[1][0]))
			$consulta_valida = false;
		if(!isset($erro[1][0]))
			$consulta_valida = false;
		if($consulta_valida){
			$sedex = array(
				'valor' => $valor[1][0],
				'entrega_domiciliar' => $entrega_domiciliar[1][0],
				'prazo_entrega' => $prazo_entrega[1][0] + 1,
				'erro' => $erro[1][0],
			);
		} else {
			$sedex = false;
		}
        return $sedex;
    }
}
?>
