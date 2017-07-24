<script type="text/javascript">

	$(function() {

		$('#FotogaleriaCategoriaId').change(function()
			{
			    // selected value   
			    var selected = $(this).val();   
			       
			    //set loading image   
			    //ajax_loading_image('.ajax_loading_image');
			    
			    $('#subcategoria').html('<label>' + <?php echo "'" . $this->Html->image('ajax-loader.gif') . "'" ?> + '</label>');
			    $('#subcategoria').css("display", 'block');
			    
			    // ajax to load level and number of classes   
			    $.ajax({   
			        type: "POST",   
			        url: <?php echo "'" . $html->url('/subcategorias/ajax_subcategoria') . "'" ?>, 
			        data: "model=Fotogaleria&ajax=true&categoria_id="+selected+"&empty=true&add=true",   
			        success: function(msg){   
			            //console.log(msg);   
			            
			            $('#subcategoria').html(msg);   
			            
			            // remove loading image   
			            //ajax_remove_loading_image('.ajax_loading_image');
			            $('.dados').css("display", 'none');

			            $('#FotogaleriaSubcategoriaId').change(function()
		        			{
		        			    // selected value   
		        			    var selected = $(this).val();   
		        			       
		        			    //set loading image   
		        			    //ajax_loading_image('.ajax_loading_image');
		        			    if(selected == ''){
		        			    	$('.dados').css("display", 'none');
		        			    }else{
		        			    	$('.dados').css("display", 'block');
		        			    }
		        			}
		        		);
			            
			        }
			    });
			}
		);

		$('#FotogaleriaSubcategoriaId').change(function()
			{
			    // selected value   
			    var selected = $(this).val();   
			       
			    //set loading image   
			    //ajax_loading_image('.ajax_loading_image');
			    if(selected == ''){
			    	$('.dados').css("display", 'none');
			    }else{
			    	$('.dados').css("display", 'block');
			    }
			}
		);
		
		
		$('#adicionar_foto').click	(function()
			{
				var msg = "<input type='file' name='data[Fotogaleria][foto][]' /> <br/>";
				$('#fotos').append(msg); 
			}
		);
				
	});

</script>

<?php echo $this->Form->create('Fotogaleria', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'fotogalerias', 'action' =>'add'), 'class' => 'formulario'));?>
	<?php
	echo '<div id="categoria" >';
		echo '<label class="formulario">Categoria</label>';
		echo $this->Form->select('categoria_id', $select_categorias, null,  array('empty' => true));	
	echo '</div>';
	echo '<br/>';
	
	echo '<div id="subcategoria" style="display:none;width:80%">';
		
	echo '</div>';
	
	echo '<br/>';
	echo '<div class="dados" style="display:none">';
		echo $this->Form->input('nome', array('style' => 'width:382px'));
		echo '<br/>';
		echo '<label class="formulario">Descrição</label>';
		echo $this->Form->textarea('descricao', array('style' => 'width:380px', 'rows' => '10'));
		
		echo '<br/>';
		echo '<label class="formulario">Ativo</label>';
		echo $this->Form->checkbox('ativo', array('checked' => true));
		
		echo '<br/><br/>';
	
	
	
		?>
		<label class="formulario">Inserir Foto</label>
		<div id="fotos" style="width:100%;padding-left:220px" >
			<input type='file' name='data[Fotogaleria][foto][]' /><br/>
			
		</div>
	
		
	
	<?php echo '</div>'; ?>
	
<?php 
	echo '<br/>';
	echo '<div class="dados" style="display:none">';
		
                echo '<button type="submit" class="button2 large2 orange2">Cadastrar</button></form>';
	echo '</div>';
?>
