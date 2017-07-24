<?php 
echo '<label class="formulario">Modelo</label>';
echo $this->Form->select($model.'ModeloId', $select_modelos, null, array('name' => 'data['.$model.'][modelo_id]', 'empty' => $empty)); 
?>
<?php if(!$empty || $add):?>
	<p style="float:right"><?php echo $html->link('Cadastrar novo modelo', '/modelos/add'); ?> </p>
<?php endif;?>