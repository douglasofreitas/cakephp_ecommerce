<div class="statusfaturas view">
<h2><?php  __('Statusfatura');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statusfatura['Statusfatura']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statusfatura['Statusfatura']['nome']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statusfatura['Statusfatura']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statusfatura['Statusfatura']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Statusfatura', true), array('action' => 'edit', $statusfatura['Statusfatura']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Statusfatura', true), array('action' => 'delete', $statusfatura['Statusfatura']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statusfatura['Statusfatura']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Statusfaturas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Statusfatura', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Faturas', true), array('controller' => 'faturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fatura', true), array('controller' => 'faturas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Faturas');?></h3>
	<?php if (!empty($statusfatura['Fatura'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Pedido Id'); ?></th>
		<th><?php __('Statusfatura Id'); ?></th>
		<th><?php __('Valor'); ?></th>
		<th><?php __('Moeda Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($statusfatura['Fatura'] as $fatura):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $fatura['id'];?></td>
			<td><?php echo $fatura['pedido_id'];?></td>
			<td><?php echo $fatura['statusfatura_id'];?></td>
			<td><?php echo $fatura['valor'];?></td>
			<td><?php echo $fatura['moeda_id'];?></td>
			<td><?php echo $fatura['created'];?></td>
			<td><?php echo $fatura['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'faturas', 'action' => 'view', $fatura['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'faturas', 'action' => 'edit', $fatura['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'faturas', 'action' => 'delete', $fatura['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fatura['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Fatura', true), array('controller' => 'faturas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
