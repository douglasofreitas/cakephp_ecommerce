<?php 
echo $this->Html->link(
		'Cadastrar comentario',
		'/comentarios/add/');  
?>
<br/><br/>

<table class="listagem" width="100%">
	<tr class="listagem_header">
			<td class="header_table" style="width:20px; text-align:center;" >Código</td>
			<td class="header_table" style="width:auto; text-align:center;" >Nome</td>
                        <td class="header_table" style="width:auto; text-align:center;" >Produto</td>
                        <td class="header_table" style="width:90px; text-align:center;" >Aprovado</td>
                        <td class="header_table" style="width:90px; text-align:center;" >Data</td>
			<td class="header_table" style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($comentarios as $comentario):
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
					$comentario['Comentario']['id'],
					'/comentarios/edit/'.$comentario['Comentario']['id']);  
			?>
			
		</td>
		<td style="text-align:center">
			<?php echo $comentario['Comentario']['nome']; ?>
		</td>
                <td style="text-align:center">
                        <?php 
			echo $this->Html->link(
					$comentario['Produto']['nome'],
					'/produtos/view/'.$comentario['Produto']['id'],
                                        array('target' => '_blank'));  
			?>
		</td>
                <td style="text-align:center">
			<?php 
                        if($comentario['Comentario']['aprovado'])
                            echo '<span style="color:green">Sim</span>'; 
                        else
                            echo '<span style="color:red">Não</span>'; 
                        ?>
		</td>
                <td style="text-align:center">
			<?php echo date('d/m/Y', strtotime($comentario['Comentario']['created'])); ?>
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar', 'url' => '/comentarios/edit/'.$comentario['Comentario']['id'], 'class' => 'tipHoverBottom', 'title' => 'Editar comentario'));?>
			<?php 
			echo $this->Html->link(
			    $this->Html->image("icon/bin_closed.png", array("alt" => "Remover", 'class' => 'tipHoverBottom', 'title' => 'Remover comentario do sistema')),
			    '/comentarios/delete/'.$comentario['Comentario']['id'],
			    array('escape' => false),
			    'Tem certeza que deseja remover este comentário?'
			);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

