<div class="pagamentos form">
<?php echo $this->Form->create('Pagamento');?>
	<fieldset>
		<legend><?php __('Edit Pagamento'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('valor');
		echo $this->Form->input('fatura_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Pagamento.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Pagamento.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pagamentos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Faturas', true), array('controller' => 'faturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fatura', true), array('controller' => 'faturas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>