<div class="faturas index">
	<h2><?php __('Faturas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('pedido_id');?></th>
			<th><?php echo $this->Paginator->sort('statusfatura_id');?></th>
			<th><?php echo $this->Paginator->sort('valor');?></th>
			<th><?php echo $this->Paginator->sort('moeda_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($faturas as $fatura):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fatura['Fatura']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fatura['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $fatura['Pedido']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fatura['Statusfatura']['id'], array('controller' => 'statusfaturas', 'action' => 'view', $fatura['Statusfatura']['id'])); ?>
		</td>
		<td><?php echo $fatura['Fatura']['valor']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fatura['Moeda']['id'], array('controller' => 'moedas', 'action' => 'view', $fatura['Moeda']['id'])); ?>
		</td>
		<td><?php echo $fatura['Fatura']['created']; ?>&nbsp;</td>
		<td><?php echo $fatura['Fatura']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fatura['Fatura']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fatura['Fatura']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fatura['Fatura']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fatura['Fatura']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fatura', true), array('action' => 'add')); ?></li>
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