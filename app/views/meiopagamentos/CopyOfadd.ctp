<div class="meiopagamentos form">
<?php echo $this->Form->create('Meiopagamento');?>
	<fieldset>
		<legend><?php __('Add Meiopagamento'); ?></legend>
	<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('descricao');
		echo $this->Form->input('var1');
		echo $this->Form->input('var2');
		echo $this->Form->input('var3');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Meiopagamentos', true), array('action' => 'index'));?></li>
	</ul>
</div>