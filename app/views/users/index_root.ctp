<table class="listagem" width="auto">
	<tr class="listagem_header">
			<td style="width:auto; text-align:center;" >Código</td>
			<td style="width:150px; text-align:center;" >Nome</td>
			<td style="width:150px; text-align:center;" >E-mail</td>
                        <td style="width:150px; text-align:center;" >Tipo</td>
			<td style="width:150px; text-align:center;" >Número de pedidos</td>
			<td style="width:150px; text-align:center;" >Data de criação da conta</td>
			<td style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
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
					$user['User']['id'],
					'/users/view/'.$user['User']['id']);  
			?>
			
		</td>
		<td style="text-align:center">
			<?php 
			echo $this->Html->link(
					$user['User']['name'],
					'/users/view/'.$user['User']['id']); 
			?>
			
		</td>
		<td style="text-align:center">
			<?php echo $user['User']['email']; ?>
			
		</td>
                <td style="text-align:center">
			<?php echo $user['Group']['name']; ?>
			
		</td>
		<td style="text-align:center">
			<?php 
			echo count($user['Pedido']); 
			?>
			
		</td>
		<td style="text-align:center">
			<?php echo date('d/m/Y H:i:s', strtotime($user['User']['created'])); ?>
			
		</td>
		<td style="text-align:center" class="actions">
			
			<?php 
                        echo $this->Html->image('icon/find.png', array('alt' => 'Visualizar pedido', 'url' => '/users/view/'.$user['User']['id'], 'class' => 'tipHoverRight', 'title' => 'Visualizar detalhes'));
                        echo $this->Html->link(
                            $this->Html->image("icon/bin_closed.png", array('class' => 'icon' ,"alt" => "Remover", 'class' => 'tipHoverRight', 'title' => 'Remover usuário')),
                            '/users/delete/'.$user['User']['id'],
                            array('escape' => false),
                            'Tem certeza que deseja remover este usuário?'
                        );
                        ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

