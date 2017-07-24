<script type="text/javascript">

	$(function() {

		$("#CategoriaAddForm").validate({
			rules: {
				'data[Categoria][nome]': { 
					required: true,
					minlength: 3
				}
				
			},
			messages: {
				'data[Categoria][nome]': { 
					required: "Campo obrigatório!",
					minlength: "Nome muito pequeno!"
				}
			}
		});
	});
</script>	
<?php
echo $html->css('mooRainbow');
echo '<script type="text/javascript" src="' . $html->url('/js/mootools-yui-compressed.js') . '"></script>';
echo '<script type="text/javascript" src="' . $html->url('/js/mootools-more.js') . '"></script>';
echo '<script type="text/javascript" src="' . $html->url('/js/mooRainbow.js') . '"></script>';

        echo $this->Form->create('Categoria', array('url' => array('controller' => 'categorias', 'action' =>'add'), 'class' => 'formulario'));
	echo '<label class="formulario">Nome *</label>';
	echo $this->Form->input('nome', array('style' => 'width:300px', 'label' => false));
	echo '<br/>';	
        
        echo '<label class="formulario">Cor</label>';
	echo $this->Form->input('cor', array('style' => 'width:100px', 'label' => false));
        echo $this->Html->image('icon/color.png', array('id' => 'CategoriaCorSelect', 'class' => 'tipHoverRight', 'title' => 'Clique para mudar a cor'));
	echo '<br/>';	
        
	echo '<br/>';
	echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>

<script type="text/javascript">
        var r = new MooRainbow('CategoriaCorSelect', {
                        startColor: [0, 0, 0],
                        imgPath: '../img/',
                        onChange: function(color) {
                                
                        },
                        onComplete: function(color) {
				
				document.getElementById('CategoriaCor').value = color.hex;
			}
                });
</script>