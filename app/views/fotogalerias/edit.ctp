
<?php echo $this->Form->create('Fotogaleria', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'fotogalerias', 'action' =>'edit'), 'class' => 'formulario'));?>
	<?php
	echo $this->Form->input('id');
	
	echo '<div id="subcategoria" >';
		echo '<label class="formulario">Subcategoria</label>';
		echo $this->Form->select('subcategoria_id', $select_subcategorias, $this->data['Fotogaleria']['subcategoria_id'],  array('empty' => false));
	echo '</div>';
	
	echo '<br/>';
	echo '<div class="dados" >';
		echo $this->Form->input('nome', array('style' => 'width:382px'));
		echo '<br/>';
		echo '<label class="formulario">Descrição</label>';
		echo $this->Form->textarea('descricao', array('style' => 'width:380px', 'rows' => '10'));
		
		echo '<br/>';
		echo '<label class="formulario">Ativo</label>';
		echo $this->Form->checkbox('ativo');
		
		echo '<br/><br/>';
	
	
	
		?>
		<label class="formulario">Alterar Foto</label>
		<div id="fotos" style="width:100%;padding-left:220px" >
			<input type='file' name='data[Fotogaleria][foto][]' /><br/>
			
		</div>
	
		
	
	<?php echo '</div>'; ?>
	
<?php 
	echo '<br/>';
        echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>