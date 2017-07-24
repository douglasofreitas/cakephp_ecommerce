<?php 
if(!empty($erro)){
    if($erro == 99){
        echo 'Erro no serviço de frete dos correios. Tente novamente mais tarde';
    }
}else{
    
    echo 'Valor: R$ '.$valor_frete.'<br/>'; 
    $prazo_entrega = intval($prazo_entrega);
    if($prazo_entrega == 1)
        echo 'Prazo: '.$prazo_entrega.' dia útil'; 
    else
        echo 'Prazo: '.$prazo_entrega.' dias úteis'; 
}
?>