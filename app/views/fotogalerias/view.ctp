<?php if($login_group_id == 1): ?>
	<ul>
		<?php
		echo $this->Html->link(
		    $this->Html->image('icon/page_white_edit.png', array('class' => 'tipHoverBottom', 'title' => 'Editar dados')),
		    '/fotogalerias/edit/'.$foto['Fotogaleria']['id'],
		    array('escape' => false)
		);
		?>
	</ul>
	
<?php endif; ?>	

<label class="formulario">Nome</label>
<?php echo $foto['Fotogaleria']['nome']; ?>
<br/>

<label class="formulario">Descrição</label>
<?php echo '<p class="descricao">'.nl2br($foto['Fotogaleria']['descricao']).'</p>'; ?>
<br/>

<label class="formulario">Subcategoria</label>
<?php echo $foto['Subcategoria']['nome']; ?>
<br/>

<label class="formulario">Foto</label>

<?php 
		echo '<div id="fotos" style="float:left;padding-bottom:30px" >';
		
		echo $this->Html->image('/fotos/'.$foto['Fotogaleria']['nome_img'], array("alt" => "[Imagem]".$foto['Fotogaleria']['nome'], 'width' => '500px'));
		echo '<br/>';
		echo '</div>';
?>
<br>

