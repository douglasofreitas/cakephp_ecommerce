<div class="fotos form">
<?php echo $this->Form->create('Foto');?>
	<fieldset>
		<legend><?php __('Edit Foto'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('produto_id');
		echo $this->Form->input('nome');
		echo $this->Form->input('nome_img');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Foto.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Foto.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fotos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Produtos', true), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Produto', true), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
	</ul>
</div>