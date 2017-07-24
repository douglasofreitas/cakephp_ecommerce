<?php 
echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'retorno_pagseguro'), 'class' => 'formulario'));

echo $this->Form->input('var1', array('value' => 'dado1'));
echo $this->Form->input('var2', array('value' => 'dado2'));
echo $this->Form->input('var3', array('value' => 'dado3'));
echo $this->Form->input('var4', array('value' => 'dado4'));

echo '<button type="submit" class="button2 large2 orange2">Testar retorno</button></form>';	
?>