<div class="faturas form">
<?php echo $this->Form->create('Fatura');?>
	<fieldset>
		<legend><?php __('Add Fatura'); ?></legend>
	<?php
		echo $this->Form->input('pedido_id');
		echo $this->Form->input('statusfatura_id');
		echo $this->Form->input('valor');
		echo $this->Form->input('moeda_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Faturas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statusfaturas', true), array('controller' => 'statusfaturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Statusfatura', true), array('controller' => 'statusfaturas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Moedas', true), array('controller' => 'moedas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Moeda', true), array('controller' => 'moedas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Infopagamentos', true), array('controller' => 'infopagamentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Infopagamento', true), array('controller' => 'infopagamentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pagamentos', true), array('controller' => 'pagamentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pagamento', true), array('controller' => 'pagamentos', 'action' => 'add')); ?> </li>
	</ul>
</div>