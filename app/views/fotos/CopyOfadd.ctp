<div class="fotos form">
<?php echo $this->Form->create('Foto');?>
	<fieldset>
		<legend><?php __('Add Foto'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Fotos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Produtos', true), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Produto', true), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
	</ul>
</div>