<strong>E-mail:</strong> douglas@grupodf.com  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Site:</strong> <a href="http://www.grupodf.com" target="_blank">www.grupodf.com</a> <br>
<br>
Preencha o formulário abaixo para entrar em contato com o suporte, enviando dúvidas, comentários ou sugestões<br>
<br>


<?php
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'contato_tecnico'), 'class' => 'formulario'));
echo '<label class="formulario" >Nome completo</label>';
echo $this->Form->input('User.nome', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >E-mail</label>';
echo $this->Form->input('User.email', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Telefone</label>';
echo $this->Form->input('User.telefone', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Mensagem</label>';
echo $this->Form->textarea('User.mensagem', array('label' => false, 'rows' => 10, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<button type="submit" class="button2 large2 orange2">Enviar</button></form>';
?>