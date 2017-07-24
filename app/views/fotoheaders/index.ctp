<?php 
echo $this->Html->link(
		'Inserir foto',
		'/fotoheaders/add/');  
?>
<br/><br/>

<table class="listagem" width="100%">
	<tr class="listagem_header">
			<td class="header_table" style="width:90px; text-align:center;" >Imagem</td>
			<td class="header_table" style="width:auto; text-align:center;" >Nome</td>
                        <td class="header_table" style="width:164px; text-align:center;" >Data de modificação</td>
			<td class="header_table" style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($fotoheaders as $foto):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="linha_impar"';
		}else{
			$class = ' class="linha_par"';
		}
	?>
	<tr<?php echo $class;?>>
                
                <td style="text-align:center">
			<?php echo $this->Html->image('/header/'.$foto['Fotoheader']['img_mini'], array("alt" => "[Imagem header]".$foto['Fotoheader']['nome'], 'style' => 'max-width:100px')) ?>
			
		</td>
		<td style="text-align:left">
			<?php 
			echo $this->Html->link(
					$foto['Fotoheader']['nome'],
					'/fotoheaders/view/'.$foto['Fotoheader']['id']);  
			?>
			
		</td>
		<td style="text-align:center">
			<?php echo date('d/m/Y H:i:s', strtotime($foto['Fotoheader']['modified'])); ?>
			</span>
			
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar', 'url' => '/fotoheaders/edit/'.$foto['Fotoheader']['id'], 'class' => 'tipHoverBottom', 'title' => 'Editar foto'));?>
			<?php 
			echo $this->Html->link(
			    $this->Html->image("icon/bin_closed.png", array("alt" => "Remover foto", 'class' => 'tipHoverBottom', 'title' => 'Remover foto do header')),
			    '/fotoheaders/delete/'.$foto['Fotoheader']['id'],
			    array('escape' => false),
			    'Tem certeza que deseja remover esta foto?'
			);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

