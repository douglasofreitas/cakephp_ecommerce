<div class="pedidos index">
	<h2><?php __('Pedidos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('statuspedido_id');?></th>
			<th><?php echo $this->Paginator->sort('num_cartao');?></th>
			<th><?php echo $this->Paginator->sort('num_cartao_cod_seg');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pedidos as $pedido):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $pedido['Pedido']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pedido['Statuspedido']['id'], array('controller' => 'statuspedidos', 'action' => 'view', $pedido['Statuspedido']['id'])); ?>
		</td>
		<td><?php echo $pedido['Pedido']['num_cartao']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['num_cartao_cod_seg']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['created']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['modified']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pedido['User']['name'], array('controller' => 'users', 'action' => 'view', $pedido['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $pedido['Pedido']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $pedido['Pedido']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $pedido['Pedido']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pedido['Pedido']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('action' => 'add')); ?></li>
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