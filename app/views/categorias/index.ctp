<?php 
echo $this->Html->link(
		'Cadastrar categoria',
		'/categorias/add/');  
?>
<br/><br/>

<table class="listagem" width="400px">
	<tr class="listagem_header">
			<td class="header_table" style="width:auto; text-align:center;" >Nome</td>
			<td class="header_table" style="width:50%; text-align:center;" >Número de subcategorias</td>
			<td class="header_table" style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($categorias as $categoria):
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
					$categoria['Categoria']['nome'],
					'/categorias/view/'.$categoria['Categoria']['id']);  
			?>
			
		</td>
		<td style="text-align:center">
			<?php echo count($categoria['Subcategoria']); ?>
			<span style="float:right">
			<?php
			echo $this->Html->link(
			    $this->Html->image("icon/add.png", array("alt" => "Cadastrar Subcategoria", 'class' => 'tipHoverBottom', 'title' => 'Cadastrar subcategoria')),
			    '/subcategorias/add/'.$categoria['Categoria']['id'],
			    array('escape' => false)
			);
			?>
			</span>
			
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar', 'url' => '/categorias/edit/'.$categoria['Categoria']['id'], 'class' => 'tipHoverBottom', 'title' => 'Editar categoria'));?>
			<?php 
			echo $this->Html->link(
			    $this->Html->image("icon/bin_closed.png", array("alt" => "Remover", 'class' => 'tipHoverBottom', 'title' => 'Remover categoria do sistema')),
			    '/categorias/delete/'.$categoria['Categoria']['id'],
			    array('escape' => false),
			    'Tem certeza que deseja remover esta categoria?'
			);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

