<div class="comentarios index">
	<h2><?php __('Comentarios');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('produto_id');?></th>
			<th><?php echo $this->Paginator->sort('titulo');?></th>
			<th><?php echo $this->Paginator->sort('descricao');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('nome');?></th>
			<th><?php echo $this->Paginator->sort('e-mail');?></th>
			<th><?php echo $this->Paginator->sort('telefone');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($comentarios as $comentario):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $comentario['Comentario']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($comentario['Produto']['id'], array('controller' => 'produtos', 'action' => 'view', $comentario['Produto']['id'])); ?>
		</td>
		<td><?php echo $comentario['Comentario']['titulo']; ?>&nbsp;</td>
		<td><?php echo $comentario['Comentario']['descricao']; ?>&nbsp;</td>
		<td><?php echo $comentario['Comentario']['created']; ?>&nbsp;</td>
		<td><?php echo $comentario['Comentario']['modified']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($comentario['User']['name'], array('controller' => 'users', 'action' => 'view', $comentario['User']['id'])); ?>
		</td>
		<td><?php echo $comentario['Comentario']['nome']; ?>&nbsp;</td>
		<td><?php echo $comentario['Comentario']['e-mail']; ?>&nbsp;</td>
		<td><?php echo $comentario['Comentario']['telefone']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $comentario['Comentario']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $comentario['Comentario']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $comentario['Comentario']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comentario['Comentario']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Comentario', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Produtos', true), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Produto', true), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>