<div class="categorias form">
<?php echo $this->Form->create('Categoria');?>
	<fieldset>
		<legend><?php __('Edit Categoria'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Categoria.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Categoria.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Categorias', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Subcategorias', true), array('controller' => 'subcategorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subcategoria', true), array('controller' => 'subcategorias', 'action' => 'add')); ?> </li>
	</ul>
</div>