
<table class="listagem" style="width:80%;min-width:600px" >
	<tr class="listagem_header">
			<td class="header_table" style="width:auto; text-align:center;" >Nome</td>
			<td class="header_table" style="width:20%; text-align:center;" >Categoria</td>
                        <?php if($config_sistema['Configuracao']['ativa_fotogaleria'] == 1): ?>
                            <td class="header_table" style="width:20%; text-align:center;" >Núm. de Fotos</td>
                        <?php endif; ?>
			<td class="header_table" style="width:20%; text-align:center;" >Núm. de Produtos</td>
			<td class="header_table" style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($subcategorias as $subcategoria):
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
                            $subcategoria['Subcategoria']['nome'],
                            '/subcategorias/view/'.$subcategoria['Subcategoria']['id']);  
			?>
			
		</td>
		<td style="text-align:center">
			<?php 
			echo $this->Html->link(
                            $subcategoria['Categoria']['nome'],
                            '/categorias/view/'.$subcategoria['Categoria']['id']);  
			?>
			
		</td>
                <?php if($config_sistema['Configuracao']['ativa_fotogaleria'] == 1): ?>
                    <td style="text-align:center">
                            <?php 
                            echo $html->link(count($subcategoria['Fotogaleria']), 
                                    '/fotogalerias/filtro_subcategoria/'.$subcategoria['Subcategoria']['id']);
                            ?>
                            
                    </td>
                <?php endif; ?>
		<td style="text-align:center"><?php echo count($subcategoria['Produto']); ?></td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar', 'url' => '/subcategorias/edit/'.$subcategoria['Subcategoria']['id'], 'class' => 'tipHoverBottom', 'title' => 'Editar subcategoria'));?>
			<?php 
			echo $this->Html->link(
			    $this->Html->image("icon/bin_closed.png", array("alt" => "Remover", 'class' => 'tipHoverBottom', 'title' => 'Remover subcategoria do sistema')),
			    '/subcategorias/delete/'.$subcategoria['Subcategoria']['id'],
			    array('escape' => false),
			    'Tem certeza que deseja remover esta subcategoria?'
			);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

