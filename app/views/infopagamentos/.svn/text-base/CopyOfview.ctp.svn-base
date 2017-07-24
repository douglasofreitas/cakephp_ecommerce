<div class="infopagamentos view">
<h2><?php  __('Infopagamento');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $infopagamento['Infopagamento']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome Arquivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $infopagamento['Infopagamento']['nome_arquivo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($infopagamento['User']['name'], array('controller' => 'users', 'action' => 'view', $infopagamento['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fatura'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($infopagamento['Fatura']['id'], array('controller' => 'faturas', 'action' => 'view', $infopagamento['Fatura']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $infopagamento['Infopagamento']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $infopagamento['Infopagamento']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Infopagamento', true), array('action' => 'edit', $infopagamento['Infopagamento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Infopagamento', true), array('action' => 'delete', $infopagamento['Infopagamento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $infopagamento['Infopagamento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Infopagamentos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Infopagamento', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Faturas', true), array('controller' => 'faturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fatura', true), array('controller' => 'faturas', 'action' => 'add')); ?> </li>
	</ul>
</div>
