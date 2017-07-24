E-mail: ecoestiluz@live.com  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MSN: ecoestiluz@live.com <br>

<br>
Preencha o formulário abaixo para entrar em contato, enviando dúvidas, comentários ou sugestões<br>
<br>


<?php
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'contato'), 'class' => 'formulario'));
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
echo $this->Form->end('Enviar');
?>