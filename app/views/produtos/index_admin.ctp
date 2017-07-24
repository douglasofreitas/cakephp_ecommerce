<script type="text/javascript">
    $(function () {
        
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
                    data: "model=Produto&ajax=true&categoria_id="+selected+"&empty=true&add=false&onlyfield=true",   
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

                                        //$('#modelos').html(msg);   
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
    });
</script>

<div class="filtro" style="width: 100%;">
    <?php 
    echo $this->Form->create('Produto', array('url' => array('controller' => 'produtos', 'action' =>'index_admin'), 'type' => 'get', 'class' => 'formulario', 'id' => 'formvalidade', 'inputDefaults' => array('div' => false)));
    
    $select_condicao = array();
    $select_condicao['<='] = 'Menor';
    $select_condicao['='] = 'Igual';
    $select_condicao['>='] = 'Maior';
    
    ?>
    
    <table style="width:100%"> 
        <tr>
            <td colspan="2">
                <label class="formulario" >Buscar</label>
                <?php 
                if(!empty($param_filtro['busca']))
                    echo $this->Form->input('busca', array('label' => false, 'value' => $param_filtro['busca'], 'style' => 'width: 300px;')); 
                else
                    echo $this->Form->input('busca', array('label' => false, 'value' => null, 'style' => 'width: 300px;')); 
                ?>
            </td>
        </tr>
        <tr>
            <td style="">
                <label class="formulario" >Categoria</label>
                <?php 
                if(!empty($param_filtro['categoria_id']))
                    echo $this->Form->select('categoria_id', $select_categorias, $param_filtro['categoria_id'],  array('empty' => true)); 
                else
                    echo $this->Form->select('categoria_id', $select_categorias, null,  array('empty' => true)); 
                ?>
            </td>
            <td style="">
                <label class="formulario" >Subcategoria</label>
                <div id="subcategoria" style="width:80%">
                    <?php 
                    if(!empty($param_filtro['subcategoria_id']))
                        echo $this->Form->select('subcategoria_id', $select_subcategorias, $param_filtro['subcategoria_id'],  array('empty' => true)); 
                    else
                        echo $this->Form->select('subcategoria_id', $select_subcategorias, null,  array('empty' => true)); 
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td style="">
                <label class="formulario" >Marca</label>
                <?php 
                if(!empty($param_filtro['marca_id']))
                    echo $this->Form->select('marca_id', $select_marcas, $param_filtro['marca_id'],  array('empty' => true)); 
                else
                    echo $this->Form->select('marca_id', $select_marcas, null,  array('empty' => true)); 
                ?>
            </td>
        </tr>
        
        
        
        <tr>    
            <td>
                <label class="formulario" >Valor</label>
                <?php 
                if(!empty($param_filtro['valor_form'])){
                    echo $this->Form->input('valor_form', array('style' => 'width:100px', 'label' => false, 'value' => $param_filtro['valor_form']));
                    echo $this->Form->select('valor_condicao', $select_condicao, $param_filtro['valor_condicao'],  array('empty' => false));
                }else{
                    echo $this->Form->input('valor_form', array('style' => 'width:100px', 'label' => false));
                    echo $this->Form->select('valor_condicao', $select_condicao, '<=',  array('empty' => false));
                }
                ?>
                
            </td>
            
            <td>
                <label class="formulario" >Peso</label>
                <?php 
                if(!empty($param_filtro['peso_form'])){
                    echo $this->Form->input('peso_form', array('style' => 'width:100px', 'label' => false, 'value' => $param_filtro['peso_form']));
                    echo $this->Form->select('peso_condicao', $select_condicao, $param_filtro['peso_condicao'],  array('empty' => false));
                }else{
                    echo $this->Form->input('peso_form', array('style' => 'width:100px', 'label' => false));
                    echo $this->Form->select('peso_condicao', $select_condicao, '<=',  array('empty' => false));
                }
                ?>
                
            </td>
        </tr>
        
        <tr>    
            <td>
                <label class="formulario" >Ativo</label>
                <?php 
                if(!empty($param_filtro['ativo']))
                    echo $form->checkbox('ativo', array('checked' => 'checked'));
                else
                    echo $form->checkbox('ativo');
                ?>
                
            </td>
            
            <td>
                <label class="formulario" >Promoção</label>
                <?php 
                if(!empty($param_filtro['promocao']))
                    echo $form->checkbox('promocao', array('checked' => 'checked'));
                else
                    echo $form->checkbox('promocao');
                ?>
                
            </td>
        </tr>
      
    </table>
    
    <div style="float: left;">
    <?php echo '<button type="submit" class="button2 large2 orange2">Filtrar</button>'; ?>
    </div>
    
    <div style="float: right;text-align: right;">
    <?php echo $this->Html->image('icon/excel.png', array('alt' => 'Formato Excel dos dados dos produtos', 'url' => '/produtos/exportar'.$param_get, 'style' => 'width: 36px;', 'class' => 'tipHoverTop', 'title' => 'Formato Excel dos dados dos produtos'));?> 
    </div>
        
    <?php
    echo '</form>';
    ?>
</div>



<br/>


<p class="paginate" >
    <?php 
    $this->Paginator->options(array('url' => array('?' => $param_get)));
    
    echo $paginator->prev('< Anterior', array('class' => 'prev_enable'), ' ', array('class' => 'prev_disable'));
    echo ' '.$paginator->numbers().' ';
    echo $paginator->next('Próximo >', array('class' => 'next_enable'), ' ', array('class' => 'next_disable'));
    ?>
</p>
	
<?php
if(count($produtos) > 0){
	
        ?>

        Total de produtos: <?php echo $paginator->counter(array('format' => '%count%'))." (Ativos: ".$produtos_ativos." - Inativos: ".($paginator->counter(array('format' => '%count%')) - $produtos_ativos).")"; ?>  <br/>
        
        <table class="listagem" width="auto">
                <tr class="listagem_header">
                    <td class="header_table" style="width:60px; text-align:center;" ><?php echo $this->Paginator->sort('Código', 'id');?></td>
                    <td class="header_table" style="width:auto; text-align:center;" ><?php echo $this->Paginator->sort('nome');?></td>
                    <td class="header_table" style="width:150px; text-align:center;" >Categoria</td>
                    <td class="header_table" style="width:87px; text-align:center;" ><?php echo $this->Paginator->sort('desconto');?></td>
                    <td class="header_table" style="width:60px; text-align:center;" ><?php echo $this->Paginator->sort('valor');?></td>
                    <td class="header_table" style="width:87px; text-align:center;" ><?php echo $this->Paginator->sort('Modificação','modified');?></td>
                    <td class="header_table" style="width:70px; text-align:center;"  class="actions"><?php __('Ações');?></td>
                </tr>
        <?php
        $i = 0;
	foreach ($produtos as $produto){
            
            $class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="linha_impar"';
		}else{
			$class = ' class="linha_par"';
		}
	
	
            
            $categoria_nome = '';
            foreach ($categorias as $cat){
                if($cat['Categoria']['id'] == $produto['Subcategoria']['categoria_id'])
                    $categoria_nome = $cat['Categoria']['nome'];
            }
            
            ?>
                <tr<?php echo $class;?>  style="font-size: 10px;">
                    <td style="text-align: center">
                        <?php
                        echo $produto['Produto']['id'];
                        
                        if($produto['Produto']['ativo'] == 0){
                            echo $this->Html->image('icon/cross.png', array('class' => 'tipHoverBottom', 'title' => 'Destivado', 'style' => 'width: 16px;height: 16px;float:right'));
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Html->link(
                                $produto['Produto']['nome'],
                                '/produtos/view/'.$produto['Produto']['id'],
                                array('style' => 'font-weight:bold')
                        );
                        ?>
                    </td>
                    <td>
                        <?php echo $categoria_nome.' - '.$produto['Subcategoria']['nome']; ?>
                    </td>
                    <td style="text-align: center">
                        <?php 
                        if($produto['Produto']['promocao'] == 1){
                            echo $produto['Produto']['desconto'].'%';
                        }else{
                            echo '0';
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $produto['Moeda']['sigla'].' '.$produto['Produto']['valor_form'] ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y', strtotime($produto['Produto']['modified'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->image('icon/find.png', array('alt' => 'Visualizar', 'url' => '/produtos/view_admin/'.$produto['Produto']['id'], 'class' => 'tipHoverTop', 'title' => 'Visualizar detalhes'));?>
                        <?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar', 'url' => '/produtos/edit/'.$produto['Produto']['id'], 'class' => 'tipHoverTop', 'title' => 'Editar dados'));?>
                        <?php 
                        echo $this->Html->link(
                            $this->Html->image("icon/bin_closed.png", array("alt" => "Remover",'class' => 'tipHoverTop', 'title' => 'Remover produto')),
                            '/produtos/delete/'.$produto['Produto']['id'],
                            array('escape' => false),
                            'Tem certeza que deseja remover este produto?'
                        );
                        ?>
                    </td>
                </tr>    
            <?php
            
	}
        echo '</table>';
        ?>
        <p class="paginate" >
                <?php 
                        echo $paginator->prev('< Anterior', array('class' => 'prev_enable'), ' ', array('class' => 'prev_disable'));
                        echo ' '.$paginator->numbers().' ';
                        echo $paginator->next('Próximo >', array('class' => 'next_enable'), ' ', array('class' => 'next_disable'));
                ?>
                <span style="float: right;">
                        Ordenar por: <?php echo $this->Paginator->sort('nome');?>, <?php echo $this->Paginator->sort('Mais recente', 'modified');?>, <?php echo $this->Paginator->sort('Valor', 'valor');?>
                </span>
        </p>
        <?php
         
}else{
	echo 'Não há produtos disponíveis';
}
?>