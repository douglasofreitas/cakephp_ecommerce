<script type="text/javascript">

	$(function() {

		$("#formulario").validate({
			rules: {
				'data[Modelo][nome]': { 
					required: true,
					minlength: 2
				}
				
			},
			messages: {
				'data[Modelo][nome]': { 
					required: "Campo obrigatório!",
					minlength: "Nome muito pequeno!"
				}
			}
		});
		
	});

</script>		

<?php echo $this->Form->create('Modelo', array('url' => array('controller' => 'modelos', 'action' =>'add'), 'class' => 'formulario', 'id' => 'formulario'));
	echo $this->Form->input('id');
	echo $this->Form->hidden('subcategoria_id', array('value' => $subcategoria['Subcategoria']['id']));
        
	echo '<label class="formulario">Categoria</label>';
	echo $subcategoria['Subcategoria']['nome'];
	echo '<br/>';
	
	echo '<label class="formulario">Nome *</label>';
	echo $this->Form->input('nome', array('style' => 'width:300px', 'label' => false));
	echo '<br/>';	
 
	echo '<br/>';
	echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';	
?>