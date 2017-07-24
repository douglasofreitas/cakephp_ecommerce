<table class="listagem" width="auto">
	<tr class="listagem_header">
			<td class="header_table" style="width:auto; text-align:center;" >Sigla</td>
                        <td class="header_table" style="width:auto; text-align:center;" >Mensagem</td>
			<td class="header_table" style="width:150px; text-align:center;" ><?php __('Data de modificação');?></td>
			<td class="header_table" style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($emaillojas as $emaill):
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
                                $emaill['Emailloja']['sigla'],
                                '/emaillojas/edit/'.$emaill['Emailloja']['id'],
                                array('class' => 'tipHoverBottom', 'title' => 'Detalhes'));  
			?>
			
		</td>
                <td style="text-align:left">
			<?php 
			echo $emaill['Emailloja']['texto'];
			?>
			
		</td>
		<td style="text-align:center">
			<?php echo date('d/m/Y H:i:s', strtotime($emaill['Emailloja']['modified'])); ?>
			
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar e-mail', 'url' => '/emaillojas/edit/'.$emaill['Emailloja']['id'], 'class' => 'tipHoverLeft', 'title' => 'Editar e-mail'));?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

