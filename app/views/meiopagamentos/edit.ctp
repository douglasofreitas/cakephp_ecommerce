<div class="meiopagamentos form">
<?php echo $this->Form->create('Meiopagamento');?>
	<fieldset>
		<legend><?php __('Edit Meiopagamento'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
		echo $this->Form->input('descricao');
		echo $this->Form->input('var1');
		echo $this->Form->input('var2');
		echo $this->Form->input('var3');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Meiopagamento.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Meiopagamento.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Meiopagamentos', true), array('action' => 'index'));?></li>
	</ul>
</div>