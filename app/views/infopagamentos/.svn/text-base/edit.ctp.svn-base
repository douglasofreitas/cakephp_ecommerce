<div class="infopagamentos form">
<?php echo $this->Form->create('Infopagamento');?>
	<fieldset>
		<legend><?php __('Edit Infopagamento'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome_arquivo');
		echo $this->Form->input('user_id');
		echo $this->Form->input('fatura_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Infopagamento.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Infopagamento.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Infopagamentos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Faturas', true), array('controller' => 'faturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fatura', true), array('controller' => 'faturas', 'action' => 'add')); ?> </li>
	</ul>
</div>