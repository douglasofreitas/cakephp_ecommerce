<div class="subcategorias view">
<h2><?php  __('Subcategoria');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subcategoria['Subcategoria']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Categoria'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($subcategoria['Categoria']['id'], array('controller' => 'categorias', 'action' => 'view', $subcategoria['Categoria']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subcategoria['Subcategoria']['nome']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subcategoria['Subcategoria']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subcategoria['Subcategoria']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Subcategoria', true), array('action' => 'edit', $subcategoria['Subcategoria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Subcategoria', true), array('action' => 'delete', $subcategoria['Subcategoria']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subcategoria['Subcategoria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Subcategorias', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subcategoria', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categorias', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categoria', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Produtos', true), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Produto', true), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Produtos');?></h3>
	<?php if (!empty($subcategoria['Produto'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Subcategoria Id'); ?></th>
		<th><?php __('Nome'); ?></th>
		<th><?php __('Descricao'); ?></th>
		<th><?php __('Quantidade'); ?></th>
		<th><?php __('Img'); ?></th>
		<th><?php __('Img Mini'); ?></th>
		<th><?php __('Moeda Id'); ?></th>
		<th><?php __('Valor'); ?></th>
		<th><?php __('Promocao'); ?></th>
		<th><?php __('Desconto'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($subcategoria['Produto'] as $produto):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $produto['id'];?></td>
			<td><?php echo $produto['subcategoria_id'];?></td>
			<td><?php echo $produto['nome'];?></td>
			<td><?php echo $produto['descricao'];?></td>
			<td><?php echo $produto['quantidade'];?></td>
			<td><?php echo $produto['img'];?></td>
			<td><?php echo $produto['img_mini'];?></td>
			<td><?php echo $produto['moeda_id'];?></td>
			<td><?php echo $produto['valor'];?></td>
			<td><?php echo $produto['promocao'];?></td>
			<td><?php echo $produto['desconto'];?></td>
			<td><?php echo $produto['user_id'];?></td>
			<td><?php echo $produto['created'];?></td>
			<td><?php echo $produto['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'produtos', 'action' => 'view', $produto['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'produtos', 'action' => 'edit', $produto['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'produtos', 'action' => 'delete', $produto['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $produto['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Produto', true), array('controller' => 'produtos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
