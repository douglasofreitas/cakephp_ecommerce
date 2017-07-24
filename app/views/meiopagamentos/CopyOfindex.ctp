<div class="meiopagamentos index">
	<h2><?php __('Meiopagamentos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nome');?></th>
			<th><?php echo $this->Paginator->sort('descricao');?></th>
			<th><?php echo $this->Paginator->sort('var1');?></th>
			<th><?php echo $this->Paginator->sort('var2');?></th>
			<th><?php echo $this->Paginator->sort('var3');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($meiopagamentos as $meiopagamento):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $meiopagamento['Meiopagamento']['id']; ?>&nbsp;</td>
		<td><?php echo $meiopagamento['Meiopagamento']['nome']; ?>&nbsp;</td>
		<td><?php echo $meiopagamento['Meiopagamento']['descricao']; ?>&nbsp;</td>
		<td><?php echo $meiopagamento['Meiopagamento']['var1']; ?>&nbsp;</td>
		<td><?php echo $meiopagamento['Meiopagamento']['var2']; ?>&nbsp;</td>
		<td><?php echo $meiopagamento['Meiopagamento']['var3']; ?>&nbsp;</td>
		<td><?php echo $meiopagamento['Meiopagamento']['created']; ?>&nbsp;</td>
		<td><?php echo $meiopagamento['Meiopagamento']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $meiopagamento['Meiopagamento']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $meiopagamento['Meiopagamento']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $meiopagamento['Meiopagamento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $meiopagamento['Meiopagamento']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Meiopagamento', true), array('action' => 'add')); ?></li>
	</ul>
</div>