<div class="statuspedidos view">
<h2><?php  __('Statuspedido');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statuspedido['Statuspedido']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statuspedido['Statuspedido']['nome']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statuspedido['Statuspedido']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statuspedido['Statuspedido']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Statuspedido', true), array('action' => 'edit', $statuspedido['Statuspedido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Statuspedido', true), array('action' => 'delete', $statuspedido['Statuspedido']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statuspedido['Statuspedido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuspedidos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Statuspedido', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Pedidos');?></h3>
	<?php if (!empty($statuspedido['Pedido'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Statuspedido Id'); ?></th>
		<th><?php __('Num Cartao'); ?></th>
		<th><?php __('Num Cartao Cod Seg'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($statuspedido['Pedido'] as $pedido):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pedido['id'];?></td>
			<td><?php echo $pedido['statuspedido_id'];?></td>
			<td><?php echo $pedido['num_cartao'];?></td>
			<td><?php echo $pedido['num_cartao_cod_seg'];?></td>
			<td><?php echo $pedido['created'];?></td>
			<td><?php echo $pedido['modified'];?></td>
			<td><?php echo $pedido['user_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'pedidos', 'action' => 'view', $pedido['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'pedidos', 'action' => 'edit', $pedido['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'pedidos', 'action' => 'delete', $pedido['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pedido['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
