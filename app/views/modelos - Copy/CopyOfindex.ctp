<div class="modelos index">
	<h2><?php __('Modelos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('produto_id');?></th>
			<th><?php echo $this->Paginator->sort('nome');?></th>
			<th><?php echo $this->Paginator->sort('descricao');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($modelos as $modelo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $modelo['Modelo']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($modelo['Produto']['id'], array('controller' => 'produtos', 'action' => 'view', $modelo['Produto']['id'])); ?>
		</td>
		<td><?php echo $modelo['Modelo']['nome']; ?>&nbsp;</td>
		<td><?php echo $modelo['Modelo']['descricao']; ?>&nbsp;</td>
		<td><?php echo $modelo['Modelo']['created']; ?>&nbsp;</td>
		<td><?php echo $modelo['Modelo']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $modelo['Modelo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $modelo['Modelo']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $modelo['Modelo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $modelo['Modelo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Modelo', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Produtos', true), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Produto', true), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
	</ul>
</div>