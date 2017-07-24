<ul>
        <?php
        echo $this->Html->link(
            $this->Html->image('icon/page_white_edit.png', array('class' => 'tipHoverBottom', 'title' => 'Editar subcategoria')),
            '/subcategorias/edit/'.$subcategoria['Subcategoria']['id'],
            array('escape' => false)
        );
        ?>
</ul>


<label class="formulario">Nome</label>
<?php echo $subcategoria['Subcategoria']['nome']; ?>
<br/>

<?php 
echo $this->Html->link(
		'Cadastrar modelo',
		'/modelos/add/'.$subcategoria['Subcategoria']['id']);  
?>
<br/><br/>

<table class="listagem" width="70%">
	<tr class="listagem_header">
			<td class="header_table" style="width:auto; text-align:center;" >Modelo</td>
			<td class="header_table" style="width:50%; text-align:center;" >Número de produtos</td>
			<td class="header_table" style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	
	<?php
	$i = 0;
	foreach ($modelos as $modelo):
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
			echo $modelo['Modelo']['nome'];  
			?>
			
		</td>
		<td style="text-align:center"><?php echo count($modelo['Produto']); ?></td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar', 'url' => '/modelos/edit/'.$modelo['Modelo']['id'], 'class' => 'tipHoverBottom', 'title' => 'Editar modelo'));?>
			<?php 
			echo $this->Html->link(
			    $this->Html->image("icon/bin_closed.png", array("alt" => "Remover", 'class' => 'tipHoverBottom', 'title' => 'Remover modelo do sistema')),
			    '/modelos/delete/'.$modelo['Modelo']['id'],
			    array('escape' => false),
			    'Tem certeza que deseja remover este modelo?'
			);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
	
</table>

