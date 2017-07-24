<?php 
if(!isset($onlyfield))
    echo '<label class="formulario">Subcategoria</label>';
echo $this->Form->select($model.'SubcategoriaId', $select_subcategorias, null, array('name' => 'data['.$model.'][subcategoria_id]', 'empty' => $empty)); 
?>
<?php if($add):?>
	<p style="float:right"><?php echo $html->link('Cadastrar nova subcategoria', '/subcategorias/add', array('id' => 'add_subcategoria', 'onclick' => 'return false')); ?> </p>
<?php endif;?>

<script type="text/javascript">

	$(function() {
                
                //popup para mensagem
                $('#add_subcategoria').click(function()
			{
				var titulo = "Adicionar Subcategoria";
                                var mensagem = '\n\
                                    <label>Nome da subcategoria</label> <br/> \n\
                                    <input id="subcategoria_categoria" name="subcategoria_categoria_id" type="hidden" value="<?php echo $categoria_id ?>" />\n\
                                    <input id="subcategoria_nome" name="subcategoria_nome" type="text" style="width:150px" maxlength="100" /><br/><br/>\n\
                                    <button id="button_add_subcategoria" class="button2 large2 orange2">Salvar</button><br/>\n\
                                    <label id="loading_subcategoria" style="display:none"><?php echo  $this->Html->image('ajax-loader.gif')  ?></label>';
                                popupMsg(titulo,mensagem);
                                
                                $('#button_add_subcategoria').click(function()
                                    {
                                        // selected value   
                                        var subcategoria_nome = $('#subcategoria_nome').val();   
                                        var subcategoria_categoria = $('#subcategoria_categoria').val(); 

                                        $('#button_add_subcategoria').css("display", 'none'); 
                                        $('#loading_subcategoria').css("display", 'block'); 

                                        $.ajax({   
                                            type: "POST",   
                                            url: <?php echo "'" . $html->url('/subcategorias/ajax_add') . "'" ?>, 
                                            data: "nome="+subcategoria_nome+"&categoria_id="+subcategoria_categoria+"",   
                                            success: function(msg){   
                                                disablePopup();
                                                atualizaSubcategorias();
                                                $('#button_add_subcategoria').css("display", 'block'); 
                                                $('#loading_subcategoria').css("display", 'none'); 
                                            }
                                        });
                                    }
                                );
                                
				return false;
			}
		);
                    
                
	});

</script>