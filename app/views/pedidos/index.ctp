<?php if(count($pedidos) > 0): ?>

<p>
    Total de pedidos: <?php echo count($pedidos) ?>
</p>

<table class="listagem" width="auto">
	<tr class="listagem_header">
			<td class="header_table" style="width:auto; ;" >Código</td>
			<td class="header_table" style="width:150px; ;" >Número de produtos</td>
			<td class="header_table" style="width:160px; ;" >Status do pedido</td>
                        <td class="header_table" style="width:auto; ;" >Valor</td>
			<td class="header_table" style="width:156px; ;" >Data de criação</td>
			<td class="header_table" style="width:60px; ;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($pedidos as $pedido):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="linha_impar"';
		}else{
			$class = ' class="linha_par"';
		}
	?>
	<tr<?php echo $class;?>>
		<td style="text-align:center">
			<?php 
			echo $this->Html->link(
					$pedido['Pedido']['id'],
					'/pedidos/view/'.$pedido['Pedido']['id']);  
			?>
			
		</td>
		<td style="text-align:center">
			<?php 
                        $quantidade = 0;
                        foreach($pedido['Itempedido'] as $itempedido){
                            $quantidade += $itempedido['quantidade'];
                        }
                        echo $quantidade; 
                        ?>
			
		</td>
		<td style="text-align:center">
			<?php echo $pedido['Statuspedido']['nome']; ?>
			
		</td>
                <td style="text-align:center">
			<?php echo 'R$ '.$pedido['Pedido']['valor_total_form']; ?>
			
		</td>
		<td style="text-align:center">
			<?php echo date('d/m/Y H:i:s', strtotime($pedido['Pedido']['created'])); ?>
			
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/find.png', array('alt' => 'Visualizar pedido', 'url' => '/pedidos/view/'.$pedido['Pedido']['id'], 'class' => 'tipHoverRight', 'title' => 'Visualizar detalhes'));?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php else: ?>

Não há pedidos cadastrados

<?php endif; ?>
