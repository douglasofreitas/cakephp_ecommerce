<strong>Código do pedido</strong> <?php echo $pedido['Pedido']['id'] ?> <br>
<br>
<strong>Nome do cliente: </strong>
<?php 
	echo $this->Html->link(
		$pedido['User']['name'],
		'/users/view/'.$pedido['User']['id'],
		array('target' => '_blank')); 
        
?><br>
<br>
<table>
	<tr>
                <td>
                    <strong>Status do pedido:</strong><br/>
                    <?php echo $pedido['Statuspedido']['nome'] ?>
                </td>
                <td style="width:260px;padding-left: 25px;">
                    <?php 
                    if($pedido['Statuspedido']['id'] != 4){
                        
                        //exibe opções para o pedido.
                        echo __('Mudar status do pedido para');
                        
                        echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'mudar_status_pedido/'.$pedido['Pedido']['id']), 'class' => 'formulario'));
                        echo $this->Form->select('statuspedido_id', $select_statuspedido, $pedido['Statuspedido']['id'],  array('empty' => false));	
                        //echo '<input type="submit" value="Salvar" style="float:right" ></form>';
                        echo '<button style="float:center" class="button2 small2 orange2" type="submit" id="botao_adicionar_produto">Salvar</button>';
                        echo '</form>';
                        
                        /*
                        echo $this->Html->link(
                            $this->Html->image("icon/cross.png", array("alt" => "Remover",'class' => 'tipHoverTop', 'title' => 'Cancelar pedido')),
                            '/pedidos/mudar_status_pedido/'.$pedido['Pedido']['id'].'/4',
                            array('escape' => false),
                            'Tem certeza que deseja cancelar este pedido?'
                        );
                         */
                    }
                    ?>
                </td>
	</tr>
        
        <?php
        //verifica se tem fatura no pedido
        if(!empty($fatura)){
        ?>
        
	<tr>
		<td>
			<strong>Status do pagamento:</strong><br/>
			<?php echo $fatura['Statusfatura']['nome'] ?>
		</td>
                <td style="padding-left: 25px;">
                    <?php 
                    
                    //selecionar fatura
                    //$fatura = $pedido['Fatura'][0];
                    if($pedido['Statuspedido']['id'] != 4){
                        echo __('Mudar status do pagamento para');
                        echo $this->Form->create('Fatura', array('url' => array('controller' => 'faturas', 'action' =>'mudar_status_fatura/'.$fatura['Fatura']['id']), 'class' => 'formulario'));
                        echo $this->Form->select('statusfatura_id', $select_statusfatura, $fatura['Fatura']['statusfatura_id'],  array('empty' => false));	
                        echo '<button style="float:center" class="button2 small2 orange2" type="submit" id="botao_adicionar_produto">Salvar</button>';
                        echo '</form>';

                    }
                    
                    //CIELO
                    if(false){
                        if($fatura['Statusfatura']['id'] == 9){
                                //para fatura cancelada não mostra opções
                        }elseif($fatura['Statusfatura']['id'] == 4){
                                echo $this->Html->image('icon/money_dollar.png', 
                                        array('alt' => 'Capturar dinheiro', 
                                                'url' => '/pedidos/capturar_fatura/'.$pedido['Pedido']['id'], 'class' => 'tipHoverBottom', 'title' => 'Capturar dinheiro')
                                );
                        }elseif($fatura['Statusfatura']['id'] == 6){
                                //para capturado não exibe nada
                        }else{
                                echo $this->Html->image('icon/find.png', 
                                        array('alt' => 'Verificar status do pagamento', 
                                                'url' => '/pedidos/consultar_pedido/'.$pedido['Pedido']['id'], 'class' => 'tipHoverBottom', 'title' => 'Verificar status do pagamento')
                                );
                        }
                    }
                    ?>
                </td>
	</tr>
        
        <?php
        }
        ?>
</table>
<br/>

<strong>Código de rastreio do correio:</strong>
<?php
echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'rastreio_correio'), 'class' => 'formulario'));
echo $this->Form->hidden('pedido_id', array('value' => $pedido['Pedido']['id']));	
echo $this->Form->input('rastreio_correio', array('label' => false, 'style' => 'width:200px', 'value' => $pedido['Pedido']['rastreio_correio']));	
echo '<button style="float:center" class="button2 small2 orange2" type="submit" id="botao_adicionar_produto">Salvar</button>';
echo '</form>';

if(!empty($pedido['Pedido']['rastreio_correio'])){
    echo $this->Html->link(
        'Enviar e-mail para cliente',
        '/pedidos/email_rastreio_correio/'.$pedido['Pedido']['id'],
        array('class' => 'tipHoverRight', 'title' => 'Envia e-mail para o cliente com o código de rastreio')); 
}

?>
<br/>
<br/>
<strong>Estoque: </strong>
<?php
if($pedido['Pedido']['baixa_estoque'] == 1){
    echo 'Produtos <strong>com</strong> baixa no estoque';
}else{
    echo 'Produtos <strong>sem</strong> baixa no estoque';
}
?>
<br/>
<br/>
<strong>Data do pedido: </strong> <?php echo date('d/m/Y H:i:s', strtotime($pedido['Pedido']['created'])); ?><br>
<br/>
<strong>Itens do pedido: </strong><br/>
<table class="listagem" >
	<tr class="listagem_header">
		<td class="header_table" style="min-width: 100px">Produto</td>
		<td class="header_table" align="center">Quantidade</td>
                <td class="header_table" align="center">Valor</td>
	</tr>

	<?php
	$valor_total = $pedido['Pedido']['frete'];
	$i = 0;
	foreach($pedido['Itempedido'] as $item){
		
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="linha_impar"';
		}else{
			$class = ' class="linha_par"';
		}
		
                $modelo = '';
                if(!empty($item['produtoquantidade_id'])){
                    
                    //obter a cor e o tamanho do item do pedido, por enquanto esta longo
                    $cor_id = null;
                    $cor_nome = null;
                    $tamanho_id = null;
                    $tamanho_nome = null;

                    foreach($produtos[$item['produto_id']]['ProdutoQuantidade'] as $prod_quant){
                        if($prod_quant['id'] == $item['produtoquantidade_id']){
                            $cor_id = $prod_quant['cor_id'];
                            $tamanho_id = $prod_quant['tamanho_id'];
                        }
                    }
                    if(!empty($cor_id)){
                        foreach($produtos[$item['produto_id']]['Cor'] as $cor){
                            if($cor_id == $cor['id']){
                                $cor_nome = $cor['nome'];
                            }
                        }
                        foreach($produtos[$item['produto_id']]['Tamanho'] as $tamanho){
                            if($tamanho_id == $tamanho['id']){
                                $tamanho_nome = $tamanho['nome'];
                            }
                        }
                    }
                    if(!empty($cor_nome)){
                        $modelo = '<br/>Cor: '.$cor_nome.' <br/>Tamanho: '.$tamanho_nome.'';
                    }

                }
                
                
		
		echo '<tr '.$class.' ><td>';
		echo $this->Html->link(
			$produtos[$item['produto_id']]['Produto']['nome'],
			'/produtos/view/'.$produtos[$item['produto_id']]['Produto']['id'],
			array('target' => '_blank', 'escape'=> false));  
                echo ' '.$modelo;
		echo '</td><td align="center">';
                echo $item['quantidade'];
                echo '</td><td>R$ ';
		echo number_format($item['valor_total'], 2, ',', '.');
		echo '</td></tr>';
		
		$valor_total += $item['valor_total']; 
	}
	?>
</table>

<table class="listagem" >
	<tr >
		<td style="width: auto;min-width: 100px">
                    Frete 
                    <?php
                    if(!empty($pedido['Pedido']['tipo_correio']))
                        echo ' ('.$tipo_correio.')';
                    ?>
                </td>
		<td width="auto">R$ <?php echo number_format($pedido['Pedido']['frete'],2, ',', '.'); ?></td>
	</tr>
	<tr >
		<td>Valor Total</td>
		<td><strong>R$ <?php echo number_format($valor_total,2, ',', '.') ?></strong></td>
	</tr>
	
</table>
<br><br>
<strong>Endereço de Entrega</strong><br><br>
<strong>Destinatário:</strong> <?php echo $pedido['Pedido']['nome']; ?><br>
<strong>Endereço:</strong> <?php echo $pedido['Pedido']['endereco']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Número:</strong> <?php echo $pedido['Pedido']['numero']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Complemento:</strong> <?php echo $pedido['Pedido']['complemento']; ?> <br>
<strong>CEP:</strong> <?php echo $pedido['Pedido']['cep']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Bairro:</strong> <?php echo $pedido['Pedido']['bairro']; ?> <br>
<strong>Cidade:</strong> <?php echo $pedido['Cidade']['nome'].' - '.$estado['Estado']['nome']; ?> <br>