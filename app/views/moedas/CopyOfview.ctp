<div class="moedas view">
<h2><?php  __('Moeda');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $moeda['Moeda']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $moeda['Moeda']['nome']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sigla'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $moeda['Moeda']['sigla']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cotacao'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $moeda['Moeda']['cotacao']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $moeda['Moeda']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $moeda['Moeda']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Moeda', true), array('action' => 'edit', $moeda['Moeda']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Moeda', true), array('action' => 'delete', $moeda['Moeda']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $moeda['Moeda']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Moedas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Moeda', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Faturas', true), array('controller' => 'faturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fatura', true), array('controller' => 'faturas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Produtos', true), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Produto', true), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Faturas');?></h3>
	<?php if (!empty($moeda['Fatura'])):?>
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
		foreach ($moeda['Fatura'] as $fatura):
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
<div class="related">
	<h3><?php __('Related Produtos');?></h3>
	<?php if (!empty($moeda['Produto'])):?>
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
		foreach ($moeda['Produto'] as $produto):
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
