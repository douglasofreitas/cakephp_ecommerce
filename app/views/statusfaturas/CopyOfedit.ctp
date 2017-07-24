<div class="statusfaturas form">
<?php echo $this->Form->create('Statusfatura');?>
	<fieldset>
		<legend><?php __('Edit Statusfatura'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Statusfatura.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Statusfatura.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Statusfaturas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Faturas', true), array('controller' => 'faturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fatura', true), array('controller' => 'faturas', 'action' => 'add')); ?> </li>
	</ul>
</div>