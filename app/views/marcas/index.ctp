<?php 
echo $this->Html->link(
		'Cadastrar marca',
		'/marcas/add/');  
?>
<br/><br/>

<table class="listagem" style="width:80%;min-width:600px" >
	<tr class="listagem_header">
			<td style="width:auto; text-align:center;" >Nome</td>
                        <td style="width:auto;" >Descrição</td>
                        <td style="width:200px; text-align:center;" >Núm. de produtos</td>
			<td style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($marcas as $marca):
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
			echo $marca['Marca']['nome'];  
			?>
			
		</td>
                <td style="">
			<?php 
			echo $marca['Marca']['descricao'];  
			?>
			
		</td>
                <td style="text-align:center">
			<?php 
			echo count($marca['Produto']);  
			?>
			
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar', 'url' => '/marcas/edit/'.$marca['Marca']['id'], 'class' => 'tipHoverBottom', 'title' => 'Editar Marca'));?>
			<?php 
			echo $this->Html->link(
			    $this->Html->image("icon/bin_closed.png", array("alt" => "Remover", 'class' => 'tipHoverBottom', 'title' => 'Remover marca do sistema')),
			    '/marcas/delete/'.$marca['Marca']['id'],
			    array('escape' => false),
			    'Tem certeza que deseja remover esta marca?'
			);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php
if(count($marcas) == 0){
    echo 'Sem marcas cadastradas';
}
?>