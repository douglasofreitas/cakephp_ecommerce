<?php 
if(!isset($onlyfield))
    echo '<label class="formulario">Modelo</label>';
echo $this->Form->select($model.'ModeloId', $select_modelos, null, array('name' => 'data['.$model.'][modelo_id]', 'empty' => $empty)); 
?>
<?php if(!$empty || $add):?>
	<p style="float:right"><?php echo $html->link('Cadastrar novo modelo', '/modelos/add/'.$subcategoria_id, array('id' => 'add_modelo', 'onclick' => 'return false')); ?> </p>
<?php endif;?>

        

<script type="text/javascript">

	$(function() {
                
                //popup para mensagem
                $('#add_modelo').click(function()
			{
				var titulo = "Adicionar Modelo";
                                var mensagem = '\n\
                                    <label>Nome do modelo</label> <br/> \n\
                                    <input id="modelo_subcategoria" name="modelo_subcategoria_id" type="hidden" value="<?php echo $subcategoria_id ?>" />\n\
                                    <input id="modelo_nome" name="modelo_nome" type="text" style="width:150px" maxlength="100" /><br/><br/>\n\
                                    <button id="button_add_modelo" class="button2 large2 orange2">Salvar</button><br/>\n\
                                    <label id="loading_modelo" style="display:none"><?php echo  $this->Html->image('ajax-loader.gif')  ?></label>';
                                popupMsg(titulo,mensagem);
                                
                                $('#button_add_modelo').click(function()
                                    {
                                        // selected value   
                                        var modelo_nome = $('#modelo_nome').val();   
                                        var modelo_categoria = $('#modelo_subcategoria').val(); 

                                        $('#button_add_modelo').css("display", 'none'); 
                                        $('#loading_modelo').css("display", 'block'); 

                                        $.ajax({   
                                            type: "POST",   
                                            url: <?php echo "'" . $html->url('/modelos/ajax_add') . "'" ?>, 
                                            data: "nome="+modelo_nome+"&subcategoria_id="+modelo_categoria+"",   
                                            success: function(msg){   
                                                disablePopup();
                                                atualizaModelos();
                                                $('#button_add_modelo').css("display", 'block'); 
                                                $('#loading_modelo').css("display", 'none'); 
                                            }
                                        });
                                    }
                                );
                                
				return false;
			}
		);
                    
                
	});

</script>