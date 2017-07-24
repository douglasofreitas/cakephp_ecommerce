<div class="itempedidos index">
	<h2><?php __('Itempedidos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('produto_id');?></th>
			<th><?php echo $this->Paginator->sort('pedido_id');?></th>
			<th><?php echo $this->Paginator->sort('quantidade');?></th>
			<th><?php echo $this->Paginator->sort('valor_unitario');?></th>
			<th><?php echo $this->Paginator->sort('desconto');?></th>
			<th><?php echo $this->Paginator->sort('comprado');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($itempedidos as $itempedido):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $itempedido['Itempedido']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itempedido['Produto']['id'], array('controller' => 'produtos', 'action' => 'view', $itempedido['Produto']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($itempedido['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $itempedido['Pedido']['id'])); ?>
		</td>
		<td><?php echo $itempedido['Itempedido']['quantidade']; ?>&nbsp;</td>
		<td><?php echo $itempedido['Itempedido']['valor_unitario']; ?>&nbsp;</td>
		<td><?php echo $itempedido['Itempedido']['desconto']; ?>&nbsp;</td>
		<td><?php echo $itempedido['Itempedido']['comprado']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itempedido['User']['name'], array('controller' => 'users', 'action' => 'view', $itempedido['User']['id'])); ?>
		</td>
		<td><?php echo $itempedido['Itempedido']['created']; ?>&nbsp;</td>
		<td><?php echo $itempedido['Itempedido']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $itempedido['Itempedido']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $itempedido['Itempedido']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $itempedido['Itempedido']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $itempedido['Itempedido']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Itempedido', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Produtos', true), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Produto', true), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>