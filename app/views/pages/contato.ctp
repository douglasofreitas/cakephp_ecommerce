<script type="text/javascript">

	$(function() {
		$("#UserDisplayForm").validate({
			rules: {
				'data[User][nome]': { 
					required: true,
					minlength: 3
				},
				'data[User][mensagem]': { 
					required: true,
					minlength: 3
				},
				'data[User][ver_code]': { 
					required: true
				}
			},
			messages: {
				'data[User][nome]': { 
					required: "Campo obrigatório!",
					minlength: "Nome muito pequeno!"
				},
				'data[User][mensagem]': { 
					required: "Campo obrigatório!",
					minlength: "Mensagem muito pequena!"
				},
				'data[User][ver_code]': { 
					required: "Campo obrigatório!",
				}
			}
		});
	});

</script>

Preencha o formulário abaixo ou o contato abaixo para fazer encomendas, enviar dúvidas, comentários ou sugestões<br>
<br/>
<strong>E-mail:</strong> contato@homesample.com.br  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <br>
<br/>
<strong>Telefone:</strong> (16) 3413-2482 (atendimento das 9h as 18h)<br/>
<br/><br/><br/>



<?php
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'contato'), 'class' => 'formulario'));
echo '<label class="formulario" >Nome completo</label>';
echo $this->Form->input('User.nome', array('label' => false, 'style' => 'width: 360px;'));

if(!empty($produto))
    echo $this->Form->hidden('User.produto', array('label' => false, 'value' => $produto));

echo '<br/>';
echo '<label class="formulario" >E-mail</label>';
echo $this->Form->input('User.email', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Telefone</label>';
echo $this->Form->input('User.telefone', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Mensagem</label>';
echo $this->Form->textarea('User.mensagem', array('label' => false, 'style' => 'width: 360px;height: 200px;'));
echo '<br/>';

echo $html->image("captcha/".$captcha_src, array('style' => 'margin-left:173px'));
echo '<br/>';
echo '<label class="formulario"  for="UserVerCode">Código de verificação *</label>';
echo $this->Form->input('ver_code', array('label' => false));
echo '<br/>';


echo '<button type="submit" class="button2 large2 orange2">Enviar</button></form>';
?>