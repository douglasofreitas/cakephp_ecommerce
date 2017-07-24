
<p class="paginate" >
    <?php 
            echo $paginator->prev('<< Anterior', array('class' => 'prev_enable'), ' ', array('class' => 'prev_disable'));
            echo ' '.$paginator->numbers().' ';
            echo $paginator->next('Próximo >>', array('class' => 'next_enable'), ' ', array('class' => 'next_disable'));
    ?>
</p>

<p>
    Total de pedidos: <?php echo count($pedidos) ?>
</p>

<table class="listagem" width="auto">
	<tr class="listagem_header">
			<td class="header_table" style="width:50px; ;" ><?php echo $this->Paginator->sort('Código','id');?></td>
                        <td class="header_table" style="width:auto; ;" ><?php echo $this->Paginator->sort('Cliente','User.name');?></td>
			<td class="header_table" style="width:70px; ;" >Núm. de produtos</td>
			<td class="header_table" style="width:160px; ;" ><?php echo $this->Paginator->sort('Status do pedido','Statuspedido.nome');?></td>
                        <td class="header_table" style="width:72px; ;" >Valor</td>
			<td class="header_table" style="width:156px; ;" ><?php echo $this->Paginator->sort('Data de criação', 'created');?></td>
			<td class="header_table" style="width:44px; ;"  class="actions"><?php __('Ações');?></td>
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
                                '/pedidos/view/'.$pedido['Pedido']['id'],
                                array('class' => 'tipHoverBottom', 'title' => 'Detalhes'));  
			?>
			
		</td>
                <td style="text-align:center">
			<?php 
			echo $this->Html->link(
                                $pedido['User']['name'],
                                '/users/view/'.$pedido['Pedido']['user_id'],
                                array('class' => 'tipHoverBottom', 'title' => 'Dados do cliente', 'target' => '_blank')
                        );  
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

<p class="paginate" >
    <?php 
            echo $paginator->prev('<< Anterior', array('class' => 'prev_enable'), ' ', array('class' => 'prev_disable'));
            echo ' '.$paginator->numbers().' ';
            echo $paginator->next('Próximo >>', array('class' => 'next_enable'), ' ', array('class' => 'next_disable'));
    ?>
</p>

<p class="float:right">
    <?php
    echo $this->Html->link(
        'Pedidos sem usuário associado',
        '/pedidos/listar_pedidos_sem_user',
        array('style' => 'font-weight:bold;float:right;font-size: 10px;', 'class' => 'tipHoverBottom', 'title' => '')
    );
    ?>
</p>