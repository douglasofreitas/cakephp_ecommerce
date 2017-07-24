<script type="text/javascript">

	$(function() {

		$("#SubcategoriaAddForm").validate({
			rules: {
				'data[Marca][nome]': { 
					required: true,
					minlength: 3
				}
			
			},
			messages: {
				'data[Marca][nome]': { 
					required: "Campo obrigatório!",
					minlength: "Nome muito pequeno!"
				}
			}
		});
		
	});

</script>		

<?php echo $this->Form->create('Marca', array('url' => array('controller' => 'marcas', 'action' =>'edit'), 'class' => 'formulario'));
	echo $this->Form->input('id');
	
	echo '<label class="formulario">Nome *</label>';
	echo $this->Form->input('nome', array('style' => 'width:300px', 'label' => false));
	echo '<br/>';	
 
        echo '<label class="formulario">Descrição</label>';
        echo $this->Form->textarea('descricao', array('style' => 'width:380px', 'rows' => '10'));
        echo '<br/>';
        
	echo '<br/>';
	echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';	
?>