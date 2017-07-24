<script type="text/javascript">

	$(function() {

		$("#formulario").validate({
			rules: {
				'data[Comentario][descricao]': { 
					required: true,
					minlength: 3
				}
				
			},
			messages: {
				'data[Comentario][descricao]': { 
					required: "Campo obrigatório!",
					minlength: "Muito pequeno!"
				}
			}
		});
	});
</script>	
<?php
        echo $this->Form->create('Comentario', array('url' => array('controller' => 'comentarios', 'action' =>$action), 'class' => 'formulario', 'id' => 'formulario'));
	echo $this->Form->hidden('id', array('style' => '', 'label' => false));
        
        echo '<label class="formulario">Nome </label>';
	echo $this->Form->input('nome', array('style' => 'width:300px', 'label' => false));
	echo '<br/>';	
        
        echo '<label class="formulario">E-mail </label>';
	echo $this->Form->input('email', array('style' => 'width:300px', 'label' => false));
	echo '<br/>';	
        
        echo '<label class="formulario">Comentario </label>';
	echo $this->Form->textarea('descricao', array('style' => 'width: 400px;height: 150px;', 'label' => false));
	echo '<br/>';	
        
        echo '<label class="formulario">Aprovado</label>';
	echo $this->Form->checkbox('aprovado', array('style' => '', 'label' => false));
        echo '<br/>';	
        
	echo '<br/>';
	echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>
