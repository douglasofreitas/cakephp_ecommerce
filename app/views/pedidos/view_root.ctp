Código do pedido: <?php echo $pedido['Pedido']['id'] ?> <br>
<br>
Nome do cliente: 
<?php 
	echo $this->Html->link(
		$pedido['User']['name'],
		'/users/view/'.$pedido['User']['id'],
		array('target' => '_blank')); 
        
?><br>
<br>
<table>
	<tr>
		<td>Status do pedido:</td>
		<td>
                    <strong><?php echo $pedido['Statuspedido']['nome'] ?></strong>
		</td>
                <td style="width:260px">
                    <?php 
                    if($pedido['Statuspedido']['id'] != 4){
                        
                        //exibe opções para o pedido.
                        echo __('Mudar status do pedido para');
                        
                        echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'mudar_status_pedido/'.$pedido['Pedido']['id']), 'class' => 'formulario'));
                        echo $this->Form->select('statuspedido_id', $select_statuspedido, $pedido['Statuspedido']['id'],  array('empty' => false));	
                        echo '<input type="submit" value="Salvar" style="float:right" ></form>';
                        
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
	<tr>
		<td>
			Status do pagamento:<br>
			
		</td>
		<td>
			<strong> <?php echo $fatura['Statusfatura']['nome'] ?></strong>
		</td>
                <td>
                    <?php 
                    
                    //selecionar fatura
                    //$fatura = $pedido['Fatura'][0];
                    if($pedido['Statuspedido']['id'] != 4){
                        echo __('Mudar status do pagamento para');
                        echo $this->Form->create('Fatura', array('url' => array('controller' => 'faturas', 'action' =>'mudar_status_fatura/'.$fatura['Fatura']['id']), 'class' => 'formulario'));
                        echo $this->Form->select('statusfatura_id', $select_statusfatura, $fatura['Fatura']['statusfatura_id'],  array('empty' => false));	
                        echo '<input type="submit" value="Salvar" style="float:right" ></form>';

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
</table>
<br>
Data do pedido: <?php echo date('d/m/Y H:i:s', strtotime($pedido['Pedido']['created'])); ?><br>
<br>
<table class="listagem" >
	<tr class="listagem_header">
		<td style="min-width: 100px">Produto</td>
		<td align="center">Quantidade</td>
                <td align="center">Valor</td>
	</tr>

	<?php
	$valor_total = $pedido['Pedido']['frete'];
	$i = 0;
	foreach($itenspedido as $item){
		
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
			$item['Produto']['nome'].' '.$modelo,
			'/produtos/view/'.$item['Produto']['id'],
			array('target' => '_blank'));  
		echo '</td><td align="center">';
                echo $item['Itempedido']['quantidade'];
                echo '</td><td>R$ ';
		echo number_format($item['Itempedido']['valor_total'], 2, ',', '.');
		echo '</td></tr>';
		
		$valor_total += $item['Itempedido']['valor_total']; 
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
<strong>Rua:</strong> <?php echo $pedido['Pedido']['endereco']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Número:</strong> <?php echo $pedido['Pedido']['numero']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Complemento:</strong> <?php echo $pedido['Pedido']['complemento']; ?> <br>
<strong>CEP:</strong> <?php echo $pedido['Pedido']['cep']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Bairro:</strong> <?php echo $pedido['Pedido']['bairro']; ?> <br>
<strong>Cidade:</strong> <?php echo $pedido['Cidade']['nome'].' - '.$estado['Estado']['nome']; ?> <br>