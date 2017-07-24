<div class="moedas form">
<?php echo $this->Form->create('Moeda');?>
	<fieldset>
		<legend><?php __('Edit Moeda'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
		echo $this->Form->input('sigla');
		echo $this->Form->input('cotacao');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Moeda.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Moeda.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Moedas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Faturas', true), array('controller' => 'faturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fatura', true), array('controller' => 'faturas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Produtos', true), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Produto', true), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
	</ul>
</div>