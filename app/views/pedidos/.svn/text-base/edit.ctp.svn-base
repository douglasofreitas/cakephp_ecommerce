<div class="pedidos form">
<?php echo $this->Form->create('Pedido');?>
	<fieldset>
		<legend><?php __('Edit Pedido'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('statuspedido_id');
		echo $this->Form->input('num_cartao');
		echo $this->Form->input('num_cartao_cod_seg');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Pedido.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Pedido.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Statuspedidos', true), array('controller' => 'statuspedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Statuspedido', true), array('controller' => 'statuspedidos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Faturas', true), array('controller' => 'faturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fatura', true), array('controller' => 'faturas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itempedidos', true), array('controller' => 'itempedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itempedido', true), array('controller' => 'itempedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>