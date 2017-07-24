<script type="text/javascript">

	$(function() {

		$('#FotogaleriaCategoriaId').change(function()
			{
			    // selected value   
			    var selected = $(this).val();   
			       
			    //set loading image   
			    //ajax_loading_image('.ajax_loading_image');
			    
			    $('#subcategoria').html('<label><img src=' + <?php echo "'" . $html->url('/img/ajax-loader.gif') . "'" ?> + '/></label>');
			    //$('#subcategoria').css("display", 'block');
			    
			    // ajax to load level and number of classes   
			    $.ajax({   
			        type: "POST",   
			        url: <?php echo "'" . $html->url('/fotogalerias/ajax_subcategoria') . "'" ?>, 
			        data: "model=Fotogaleria&ajax=true&categoria_id="+selected+"&empty=true&add=true",   
			        success: function(msg){   
			            //console.log(msg);   
			            
			            $('#subcategoria').html(msg);   
			            
			            // remove loading image   
			            //ajax_remove_loading_image('.ajax_loading_image');
			            //$('#dados').css("display", 'none');

			            
			        }
			    });
			}
		);

	});

</script>

<?php echo $this->Form->create('Fotogaleria', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'fotogalerias', 'action' =>'filtro_form'), 'class' => 'formulario'));?>
	<?php
	echo '<div id="categoria" >';
		echo '<label class="formulario">Categoria</label>';
		echo $this->Form->select('categoria_id', $select_categorias, null,  array('empty' => true));	
	echo '</div>';
	echo '<br/>';
	
	echo '<div id="subcategoria">';
		
	echo '</div>';
	
	echo '<br/>';
	echo '<div id="dados" >';
		echo $this->Form->input('busca', array('style' => 'width:382px'));
		
		echo '<br/><br/>';
                
                if($login_group_id == 1){
                    echo '<label class="formulario">Ativo</label>';
                    echo $form->checkbox('ativo', array('checked' => false));
                    echo '<br/>';
                }
                
		?>
		
	
	<?php echo '</div>'; ?>
	
<?php 
	echo '<br/>';
        echo '<button type="submit" class="button2 large2 orange2">Buscar</button></form>';
?>
