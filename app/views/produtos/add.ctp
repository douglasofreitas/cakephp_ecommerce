<script type="text/javascript">

	$(function() {
                
                $("#formvalidade").validate({
			rules: {
				'data[Produto][nome]': { 
					required: true,
					minlength: 3
				},
				'data[Produto][peso_form]': { 
					required: true
				},
				'data[Produto][valor_form]': { 
					required: true
				},
				'data[Cor][]': { 
					required: true
				},
				'data[Tamanho][]': { 
					required: true
				},
				'data[Produto][medida_comprimento]': { 
					required: true
				},
				'data[Produto][medida_largura]': { 
					required: true
				},
				'data[Produto][medida_altura]': { 
					required: true
				}
                                
                                
                                
			},
			messages: {
				'data[Produto][nome]': { 
					required: "Obrigatório!",
					minlength: "Nome muito pequeno!"
				},
				'data[Produto][peso_form]': { 
					required: "Obrigatório!"
				},
				'data[Produto][valor_form]': { 
					required: "Obrigatório!"
				},
				'data[Cor][]': { 
					required: "Obrigatório!"
				},
				'data[Tamanho][]': { 
					required: "Obrigatório!"
				},
				'data[Produto][medida_comprimento]': { 
					required: "Obrigatório!"
				},
				'data[Produto][medida_largura]': { 
					required: "Obrigatório!"
				},
				'data[Produto][medida_altura]': { 
					required: "Obrigatório!"
				}
			}
		});
                
		$('#ProdutoCategoriaId').change(function()
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
			        data: "model=Produto&ajax=true&categoria_id="+selected+"&empty=true&add=true&onlyfield=true",   
			        success: function(msg){   
			            //console.log(msg);   
			            
			            $('#subcategoria').html(msg);   
			            
			            // remove loading image   
			            //ajax_remove_loading_image('.ajax_loading_image');
			            $('.dados').css("display", 'none');

			            $('#ProdutoSubcategoriaId').change(function()
                                        {
                                            // selected value   
                                            var selected = $(this).val();   

                                            $('#modelos').html('<label>' + <?php echo "'" . $this->Html->image('ajax-loader.gif') . "'" ?> + '</label>');
                                            $('#modelos').css("display", 'block'); 

                                            $.ajax({   
                                                type: "POST",   
                                                url: <?php echo "'" . $html->url('/modelos/ajax_modelo') . "'" ?>, 
                                                data: "model=Produto&ajax=true&subcategoria_id="+selected+"&empty=true&add=true&onlyfield=true",   
                                                success: function(msg){   
                                                    
                                                    $('#modelos').html(msg);   
                                                }
                                            });

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

		$('#ProdutoSubcategoriaId').change(function()
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
                            
                            //buscar modelos da subcategoria
                            $('#modelos').html('<label>' + <?php echo "'" . $this->Html->image('ajax-loader.gif') . "'" ?> + '</label>');
                            $('#modelos').css("display", 'block'); 

                            $.ajax({   
                                type: "POST",   
                                url: <?php echo "'" . $html->url('/modelos/ajax_modelo') . "'" ?>, 
                                data: "model=Produto&ajax=true&subcategoria_id="+selected+"&empty=true&add=true&onlyfield=true",   
                                success: function(msg){   

                                    $('#modelos').html(msg);   
                                }
                            });

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
				var msg = "<input type='file' name='data[Produto][foto][]' /> <br/>";
				$('#fotos').append(msg); 
				return false;
			}
		);
		$('#adicionar_cor').click	(function()
			{
				var msg = "<input type='text' name='data[Cor][]' /> <br/>";
				$('#cores').append(msg); 
				return false;
			}
		);
                
                var quantidade_tamanho = 2;
                $('#adicionar_tamanho').click	(function()
			{
				var msg = "<input type='text' name='data[Tamanho][]' /> <br/>";
				$('#tamanhos').append(msg); 
                                quantidade_tamanho = quantidade_tamanho + 1;
				return false;
			}
		);
                    
                $('#calcula_desconto').click(function()
			{
				var valor_final = " "+$('#valor_final_produto').val();
                                var valor_produto = " "+$('#ProdutoValorForm').val();
                                valor_final = parseFloat( valor_final.replace(",",".") );
                                valor_produto = parseFloat( valor_produto.replace(",",".") );
                                
                                if($('#ProdutoValorForm').val() == "" | $('#valor_final_produto').val() == "")
                                    alert('Insira o valor do produto e o valor final desejado para o cliente.');
                                
                                if(valor_final > 0 & valor_produto > 0 & valor_final <= valor_produto){
                                    var desconto = 100 - ( (100*valor_final) / valor_produto );
                                    $('#ProdutoDesconto').val(desconto);   
                                }
                                
				return false;
			}
		);
                    
				
	});

</script>

<script>
    /***
    function atualizaSubcategorias(){
        // selected value   
        var selected = $("#ProdutoCategoriaId").val();   

        //set loading image   
        //ajax_loading_image('.ajax_loading_image');

        $('#subcategoria').html('<label>' + <?php echo "'" . $this->Html->image('ajax-loader.gif') . "'" ?> + '</label>');
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
                $('.dados').css("display", 'none');
                
                $('#ProdutoSubcategoriaId').change(function()
                    {
                        // selected value   
                        var selected = $(this).val();   

                        $('#modelos').html('<label>' + <?php echo "'" . $this->Html->image('ajax-loader.gif') . "'" ?> + '</label>');
                        $('#modelos').css("display", 'block'); 

                        $.ajax({   
                            type: "POST",   
                            url: <?php echo "'" . $html->url('/modelos/ajax_modelo') . "'" ?>, 
                            data: "model=Produto&ajax=true&subcategoria_id="+selected+"&empty=true&add=false",   
                            success: function(msg){   

                                $('#modelos').html(msg);   
                            }
                        });

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
    ***/
    function atualizaModelos(){
        var selected = $("#ProdutoSubcategoriaId").val();   

        $('#modelos').html('<label>' + <?php echo "'" . $this->Html->image('ajax-loader.gif') . "'" ?> + '</label>');
        $('#modelos').css("display", 'block'); 

        $.ajax({   
            type: "POST",   
            url: <?php echo "'" . $html->url('/modelos/ajax_modelo') . "'" ?>, 
            data: "model=Produto&ajax=true&subcategoria_id="+selected+"&empty=true&add=true&onlyfield=true",   
            success: function(msg){   

                $('#modelos').html(msg);   
            }
        });

        //set loading image   
        //ajax_loading_image('.ajax_loading_image');
        if(selected == ''){
            $('.dados').css("display", 'none');
        }else{
            $('.dados').css("display", 'block');
        }
    }

</script>

<script type="text/javascript"> 
    tinyMCE.init({ 
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "table,inlinepopups",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,fontsizeselect,|,table,removeformat,code",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true

        
    }); 
</script> 


<?php echo $this->Form->create('Produto', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'produtos', 'action' =>'add'), 'class' => 'formulario', 'id' => 'formvalidade'));?>
	
    <table style="width: 100%;" class="tabela_detalhe">
        <tr>
            <td style="width: 130px;" class="destaque">
                Categoria
            </td>
            <td colspan="3">
                <?php
                if(!empty($produto))
                    echo $this->Form->select('categoria_id', $select_categorias, $produto['Subcategoria']['categoria_id'],  array('empty' => true));	
                else
                    echo $this->Form->select('categoria_id', $select_categorias, null,  array('empty' => true));	
                ?>
            </td>
        </tr>

        <tr>
            <td class="destaque">
                Subcategoria
            </td>
            <td colspan="3">
                <div id="subcategoria" style="width:100%">
                <?php 
                if(!empty($produto)){
                    echo $this->Form->select('subcategoria_id', $select_subcategorias, $produto['Subcategoria']['id'],  array('empty' => true));
                }
                
                
                ?>
                </div>
            </td>
        </tr>

        <tr>
            <td class="destaque">
                Modelo
            </td>
            <td colspan="3">
                <div id="modelos" style="width:100%">
                    <?php if(!empty($select_modelos)): ?>
                        <?php echo $this->Form->select('modelo_id', $select_modelos, null,  array('empty' => true));  ?>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    
    </table>
    
    <p style="font-weight: bold">Dados Gerais</p>
    
    <div class="dados" <?php if(empty($produto)) echo 'style="display:none"'; ?> >
        <table style="width: 100%;" class="tabela_detalhe">
            <tr>
                <td style="width: 130px;" class="destaque">
                    Nome *
                </td>
                <td colspan="3">
                    <?php echo $this->Form->input('nome', array('style' => 'width:382px', 'label' => false));  ?>
                </td>
            </tr>
            <tr>
                <td class="destaque">
                    Descrição 
                </td>
                <td colspan="3" class="no_padding">
                    <?php echo $this->Form->textarea('descricao', array('style' => 'width:620px', 'rows' => '10'));  ?>
                </td>
            </tr>
            <tr>
                <td class="destaque">
                    Peso *
                </td>
                <td colspan="3">
                    <?php 
                    echo $this->Form->input('peso_form', array('style' => 'width:50px', 'label' => false));
                    echo '(em Kg. ex: "1,5")';  
                    ?>
                </td>
            </tr>

            <?php
            if($config_sistema['Configuracao']['ativa_marcas'] == 1){
            ?>
            <tr>
                <td class="destaque">
                    Marca
                </td>
                <td colspan="3">
                    <?php 
                    echo $this->Form->select('marca_id', $select_marcas, null,  array('empty' => true));
                    ?>
                </td>
            </tr>
            <?php
            }
            ?>
            <tr>
                <td class="destaque">
                    Moeda padrão
                </td>
                <td colspan="3">
                    <?php 
                    echo $this->Form->select('moeda_id', $select_moedas, null,  array('empty' => false));
                    ?>
                </td>
            </tr>
            <tr>
                <td class="destaque">
                    Preço de custo
                </td>
                <td colspan="3">
                    <?php 
                    echo $this->Form->input('valor_custo_form', array('style' => 'width:60px', 'label' => false));
                    ?>
                </td>
            </tr>
            <tr>
                <td class="destaque">
                    Valor do produto
                </td>
                <td colspan="3">
                    <?php 
                    echo $this->Form->input('valor_form', array('style' => 'width:60px', 'label' => false));  
                    ?>
                </td>
            </tr>
        </table>
        
        
        
        <table style="width:100%">
            <tr>
                <td style="width:50%;vertical-align: top">
                    <p style="font-weight: bold">Detalhes</p>
                    <table style="width: 100%;" class="tabela_detalhe">
                        <tr>
                            <td style="width: 196px;" class="destaque">
                                Desconto (%)
                            </td>
                            <td colspan="3">
                                <?php 
                                echo $this->Form->input('desconto', array('style' => 'width:50px', 'label' => false));
                                echo $this->Html->image('icon/exclamation.png', array('class' => 'tipHoverBottom', 'title' => 'Use o campo ao lado para auxíliar no calculo do desconto do produto em %'));
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="destaque">
                                Esta em promoção?
                            </td>
                            <td colspan="3">
                                <?php 
                                echo $form->checkbox('promocao');
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="destaque">
                                É lançamento?
                            </td>
                            <td colspan="3">
                                <?php 
                                echo $form->checkbox('lancamento');
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="destaque">
                                Compra somente na loja?
                            </td>
                            <td colspan="3">
                                <?php 
                                echo $form->checkbox('venda_somente_loja');
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="destaque">
                                Ativo
                            </td>
                            <td colspan="3">
                                <?php 
                                echo $form->checkbox('ativo');
                                ?>
                            </td>
                        </tr>
                    </table>                    
                </td>
                <td style="vertical-align: top">
                    <p style="font-weight: bold">Calcular desconto</p>
                    <table style="width: 100%;" class="tabela_detalhe">
                        <tr>
                            <td style="width: 112px;" class="destaque">
                                Valor final
                            </td>
                            <td>
                                <input id="valor_final_produto" name="valor_final_produto" type="text" style="width:83px" />
                                <a href="#" id="calcula_desconto">Calcular desconto</a>
                            </td>
                        </tr>
                        
                    </table> 
                    
                    
                    <p style="font-weight: bold;margin-top: 30px;">Tamanho do pacote</p>
                    <table style="width: 100%;" class="tabela_detalhe">
                        <tr>
                            <td style="width: 112px;" class="destaque">
                                Comprimento *
                            </td>
                            <td>
                                <?php echo $this->Form->input('medida_comprimento', array('style' => 'width:60px', 'label' => false)); ?>
                                (cm)
                            </td>
                        </tr>
                        <tr>
                            <td class="destaque">
                                Largura *
                            </td>
                            <td>
                                <?php echo $this->Form->input('medida_largura', array('style' => 'width:60px', 'label' => false)); ?>
                                (cm)
                            </td>
                        </tr>
                        <tr>
                            <td class="destaque">
                                Altura *
                            </td>
                            <td>
                                <?php echo $this->Form->input('medida_altura', array('style' => 'width:60px', 'label' => false)); ?>
                                (cm)
                            </td>
                        </tr>
                    </table> 
                    
                    
                    
                </td>
            </tr>
        </table>

        <p style="font-weight: bold">
            Cores
            <?php 
                echo $this->Html->image('icon/exclamation.png', array('alt' => 'Visualizar',  'class' => 'tipHoverTop', 'title' => 'A quantidade do produto será informada na próxima página'));
            ?>
        </p>
        <table style="width: 50%;" class="tabela_detalhe">
            <tr>
                <td class="destaque">
                    Cor
                </td>
                <td>
                    <div id="cores" style="width:100%" >
                        <input type='text' name='data[Cor][]' /><br/>
                    </div>
                    <a href="#" id="adicionar_cor">Adicionar cor</a>
                </td>
            </tr>
            <tr>
                <td class="destaque">
                    Tamanhos
                </td>
                <td>
                    <div id="tamanhos" style="width:100%" >
                        <input type='text' name='data[Tamanho][]' /><br/>
                    </div>
                    <a href="#" id="adicionar_tamanho">Adicionar tamanho</a><br/>
                </td>
            </tr>
        </table>
        
        
        <p style="font-weight: bold" >
            Inserir Fotos
        </p>
        <div id="fotos" style="width:100%;" >
                <input type='file' name='data[Produto][foto][]' /><br/>

        </div>
        <p style="float:left"><a href="#" id="adicionar_foto">Adicionar mais fotos</a></p>

    </div>

	
<?php 
	echo '<br/>';
        if(!empty($produto))
            echo '<div class="dados" style="">';    
        else
            echo '<div class="dados" style="display:none">';
                echo '<button type="submit" class="button2 large2 orange2">Avançar</button></form>';
	echo '</div>';
?>
