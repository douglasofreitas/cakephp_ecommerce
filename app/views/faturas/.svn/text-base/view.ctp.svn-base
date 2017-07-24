<div class="faturas view">
<h2><?php  __('Fatura');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fatura['Fatura']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pedido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fatura['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $fatura['Pedido']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Statusfatura'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fatura['Statusfatura']['id'], array('controller' => 'statusfaturas', 'action' => 'view', $fatura['Statusfatura']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fatura['Fatura']['valor']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Moeda'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fatura['Moeda']['id'], array('controller' => 'moedas', 'action' => 'view', $fatura['Moeda']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fatura['Fatura']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fatura['Fatura']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fatura', true), array('action' => 'edit', $fatura['Fatura']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fatura', true), array('action' => 'delete', $fatura['Fatura']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fatura['Fatura']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Faturas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fatura', true), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php __('Related Infopagamentos');?></h3>
	<?php if (!empty($fatura['Infopagamento'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Nome Arquivo'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Fatura Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($fatura['Infopagamento'] as $infopagamento):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $infopagamento['id'];?></td>
			<td><?php echo $infopagamento['nome_arquivo'];?></td>
			<td><?php echo $infopagamento['user_id'];?></td>
			<td><?php echo $infopagamento['fatura_id'];?></td>
			<td><?php echo $infopagamento['created'];?></td>
			<td><?php echo $infopagamento['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'infopagamentos', 'action' => 'view', $infopagamento['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'infopagamentos', 'action' => 'edit', $infopagamento['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'infopagamentos', 'action' => 'delete', $infopagamento['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $infopagamento['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Infopagamento', true), array('controller' => 'infopagamentos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Pagamentos');?></h3>
	<?php if (!empty($fatura['Pagamento'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Valor'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Fatura Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($fatura['Pagamento'] as $pagamento):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pagamento['id'];?></td>
			<td><?php echo $pagamento['valor'];?></td>
			<td><?php echo $pagamento['created'];?></td>
			<td><?php echo $pagamento['modified'];?></td>
			<td><?php echo $pagamento['fatura_id'];?></td>
			<td><?php echo $pagamento['user_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'pagamentos', 'action' => 'view', $pagamento['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'pagamentos', 'action' => 'edit', $pagamento['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'pagamentos', 'action' => 'delete', $pagamento['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pagamento['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pagamento', true), array('controller' => 'pagamentos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
