<script type="text/javascript">

	$(function() {
		$("#formvalidade").validate({
			rules: {
				'data[User][password]': { 
					required: true,
					minlength: 3
				},
				'data[User][password2]': { 
					required: true,
                                        equalTo: "#UserPassword"
				}
			},
			messages: {
				'data[User][password]': { 
					required: "Senha obrigatória!",
					minlength: "Senha muito pequena!"
				},
				'data[User][password2]': { 
					required: "Confirmação de senha obrigatória!",
                                        equalTo: "Senhas não coincidem!"
				}
			}
		});
		
	});

</script>
<ul>
<?php 
echo $this->Html->link(
    $this->Html->image('icon/arrow_left.png', array('class' => 'tipHoverBottom', 'title' => 'Voltar')),
    'javascript:javascript:history.go(-1)',
    array('escape' => false)
);
?>
</ul>
<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'change_password'), 'class' => 'formulario', 'id' => 'formvalidade'));?>
	<?php
		echo $this->Form->hidden('id');
		echo '<label class="formulario">Nova Senha *</label>';
		echo $this->Form->password('password', array('value' => ''));
		echo '<br/>';
		echo '<label class="formulario">Confirmar Nova Senha *</label>';
		echo $this->Form->password('password2', array('value' => ''));
		echo '<br/>';
	?>
<?php 
echo '<button type="submit" class="button2 large2 orange2">Mudar senha</button></form>';
?>

