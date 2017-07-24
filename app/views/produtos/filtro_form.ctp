<script type="text/javascript">

	$(function() {

		$('#ProdutoCategoriaId').change(function()
			{
			    // selected value   
			    var selected = $(this).val();   
			       
			    //set loading image   
			    //ajax_loading_image('.ajax_loading_image');
			    
			    $('#subcategoria').html('<label>' + <?php echo "'" . $html->image('/img/ajax-loader.gif') . "'" ?> + '</label>');
			    $('#subcategoria').css("display", 'block');
			    
			    // ajax to load level and number of classes   
			    $.ajax({   
			        type: "POST",   
			        url: <?php echo "'" . $html->url('/subcategorias/ajax_subcategoria') . "'" ?>, 
			        data: "model=Produto&ajax=true&categoria_id="+selected+"&empty=true&add=true",   
			        success: function(msg){   
			            //console.log(msg);   
			            
			            $('#subcategoria').html(msg);   
			            
			            // remove loading image   
			            //ajax_remove_loading_image('.ajax_loading_image');
			            //$('.dados').css("display", 'none');

			            $('#ProdutoSubcategoriaId').change(function()
		        			{
		        			    // selected value   
		        			    var selected = $(this).val();   
		        			       
		        			    //set loading image   
		        			    //ajax_loading_image('.ajax_loading_image');
		        			    if(selected == ''){
		        			    	//$('.dados').css("display", 'none');
		        			    }else{
		        			    	//$('.dados').css("display", 'block');
		        			    }
		        			}
		        		);
			            
			        }
			    });
			}
		);

		$('#ProdutoSubcategoriaId').change(function()
			{
			    // selected value   
			    var selected = $(this).val();   
			       
			    //set loading image   
			    //ajax_loading_image('.ajax_loading_image');
			    if(selected == ''){
			    	//$('.dados').css("display", 'none');
			    }else{
			    	//$('.dados').css("display", 'block');
			    }
			}
		);
		
		
	});

</script>

<?php echo $this->Form->create('Produto', array('type' => 'get', 'enctype' => 'multipart/form-data', 'url' => array('controller' => 'produtos', 'action' =>'filtro'), 'class' => 'formulario'));?>
	<?php
	echo $form->hidden('busca_flag', array('value' => 'flag'));
                
        
        
	$select_condicao = array();
	$select_condicao['<='] = 'Menor';
	$select_condicao['='] = 'Igual';
	$select_condicao['>='] = 'Maior';
	
	echo '<div id="categoria" >';
		echo '<label class="formulario">Categoria</label>';
		echo $this->Form->select('categoria_id', $select_categorias, null,  array('empty' => true));	
	echo '</div>';
	echo '<br/>';
	
	echo '<div id="subcategoria" style="width:80%">';
		
	echo '</div>';
	
	echo '<br/>';
	echo '<div class="dados" >';
		echo '<label class="formulario">Busca</label>';
		echo $this->Form->input('busca', array('style' => 'width:382px', 'label' => false));
		echo '<br/>';
		
                if($login_group_id == 1){
                    echo '<label class="formulario">Quantidade</label>';
                    echo $this->Form->input('quantidade', array('style' => 'width:50px', 'label' => false));
                    echo '<br/>';
                }
                
		echo '<label class="formulario">Valor</label>';
		echo $this->Form->input('valor_form', array('style' => 'width:100px', 'label' => false));
		echo $this->Form->select('valor_condicao', $select_condicao, '<=',  array('empty' => false));
		echo '<br/>';
		
                if($login_group_id == 1){
                    echo '<label class="formulario">Peso</label>';
                    echo $this->Form->input('peso_form', array('style' => 'width:100px', 'label' => false));
                    echo $this->Form->select('peso_condicao', $select_condicao, '<=',  array('empty' => false));
                    echo '<br/>';
                }
                
		echo '<label class="formulario">Promoção</label>';
		echo $form->checkbox('promocao', array('checked' => false));
		echo '<br/>';
		
                if($login_group_id == 1){
                    echo '<label class="formulario">Ativo</label>';
                    echo $form->checkbox('ativo', array('checked' => false));
                    echo '<br/>';
                }
	
	echo '</div>'; 
	 ?>
	
<?php 
	echo '<br/>';
	echo '<div class="dados">';
                echo '<button type="submit" class="button2 large2 orange2">Buscar</button></form>';
	echo '</div>';
?>
