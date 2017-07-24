<script type="text/javascript" src="<?php echo $html->url('/js/slimbox/slimbox2.js') ?>"></script>
<link rel="stylesheet" href="<?php echo $html->url('/js/slimbox/slimbox2.css') ?>" type="text/css" />

<?php
function sem_estoque($produto){
    $sem_estoque = true;
    foreach($produto['ProdutoQuantidade'] as $prod_quant){
        if($prod_quant['quantidade'] > 0)
            $sem_estoque = false;
    }
    return $sem_estoque;
}
?>


<script type="text/javascript">

    $(function() {





        function isArray(obj) {
            return obj.constructor == Array;
        }

        //gerenciar quantidades de produtos de cada tamnho/cor
        var quantidade_produto = [];
        <?php
        foreach($produto['Cor'] as $cor){
            echo ' quantidade_produto['.$cor['id'].'] = [] '."; \n";
        }
        foreach($produto['ProdutoQuantidade'] as $prod_quant){
            if($prod_quant['quantidade'] > 0)
                echo ' quantidade_produto['.$prod_quant['cor_id'].'].push('.$prod_quant['tamanho_id']."); \n";
        }
        ?>



        $('#indicar_produto').click(function()
            {
                var titulo = "Indicar a um amigo";
                var mensagem = '<?php echo $this->Form->create('Contato', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'produtos', 'action' =>'indicar_produto'), 'id' => 'formvalidade'));?> \n\
                                        <?php echo $this->Form->hidden('produto_id', array('value' => $produto['Produto']['id'])); ?>\n\
                                        <label>De (nome)</label> \n\
                                        <?php echo $this->Form->input('email_de', array('style' => 'width:97%', 'label' => false)); ?><br/>\n\
                                        <label>Para (e-mail)</label>  \n\
                                        <?php echo $this->Form->input('email_para', array('style' => 'width:97%', 'label' => false)); ?><br/>\n\
                                        <label>Mensagem (opcional)</label>  \n\
                                        <?php echo $this->Form->textarea('mensagem', array('style' => 'width:97%;height:88px', 'label' => false)); ?><br/>\n\
                                        <button type="submit" class="button2 large2 orange2">Enviar</button></form><br/>\n\
                                        </form>';
                popupMsg(titulo,mensagem);
                return false;
            }
        );


        $('#botao_adicionar_produto').click(function()
            {
                //valida formulário
                if($('input:radio[name=corid]:checked').val() > 0)
                    if($('input:radio[name=tamanhoid]:checked').val() > 0){
                        $('#ItempedidoViewForm').submit();
                        return true;
                    }
                alert('Selecione uma cor e tamanho para adicionar no carrinho.');
                return false;
            }
        );

        $('#calcula_frete').click(function()
            {
                return false;
            }
        );


        $('#botao_compartilhar').click(function()
            {
                $('#compartilhar').show();
                return false;
            }
        );
        $('#botao_fechar_compartilhar').click(function()
            {
                $('#compartilhar').hide();
                return false;
            }
        );



        $('#adicionar_produto').click(function()
            {
                //valida formulário
                if($('input:radio[name=corid]:checked').val() > 0)
                    if($('input:radio[name=tamanhoid]:checked').val() > 0){
                        $('#ItempedidoViewForm').submit();
                        return true;
                    }
                alert('Selecione uma cor e tamanho para adicionar no carrinho.');
                return false;
            }
        );

        $('#calcula_frete_button').click(function()
            {
                var cep_destino = $('#CorreioCepDestino').val();
                var tipo_correio = $('input[name=TipoCorreio]:checked', '#formulario').val();

                if(cep_destino != ''){
                    //set loading image
                    $('#calcula_frete_valor').html('<label>' + <?php echo "'" . $this->Html->image('ajax-loader.gif') . "'" ?> + '</label><br/>');
                    $('#calcula_frete_valor').show();

                    // ajax
                    $.ajax({
                        type: "POST",
                        url: <?php echo "'" . $html->url('/pedidos/calcular_frete_ajax/'.$produto['Produto']['id']) . "'" ?>,
                        data: 'cep_destino='+cep_destino+'&tipo_correio='+tipo_correio,
                        success: function(msg){
                            $('#calcula_frete_valor').html(''+msg+'<br/><br/>');

                        }
                    });
                }
                return false;
            }
        );

        <?php

        foreach($produto['Cor'] as $cor ){
        ?>

        $('#campo_cor_<?php echo $cor['id'] ?>').click(function()
            {
                var sem_estoque = true;
                <?php
                foreach($produto['Tamanho'] as $tamanho ){
                ?>
                $('#tamanho_<?php echo $tamanho['id'] ?>').css('display', 'none');


                <?php
                }
                ?>

                if(quantidade_produto[<?php echo $cor['id'] ?>].length > 0){

                    $.each(quantidade_produto[<?php echo $cor['id'] ?>], function(index, tamanho_id) {
                        $('#tamanho_'+tamanho_id).css('display', 'block');
                        sem_estoque = false;
                    });

                }
                if(sem_estoque){
                    $('#area_compra').css('display', 'none');
                    $('#produto_sem_estoque').css('display', 'block');
                }else{
                    $('#area_compra').css('display', 'block');
                    $('#produto_sem_estoque').css('display', 'none');
                }

            }
        );

        <?php
        }
        ?>

    });

</script>

<script type="text/javascript">
    function exibe_comentario() {
        if ( $("#comentario_form").is(":visible") )
            $("#comentario_form").hide("fast");
        else
            $("#comentario_form").show("fast");
        return false;
    }
</script>

<ul>
    <?php
    if($login_group_id == 1){
        echo $this->Html->link(
            $this->Html->image('icon/find.png', array('class' => 'tipHoverBottom', 'title' => 'Visualizar dados completos do produto')),
            '/produtos/view_admin/'.$produto['Produto']['id'],
            array('escape' => false)
        );
        echo $this->Html->link(
            $this->Html->image('icon/image_1.png', array('class' => 'tipHoverBottom', 'title' => 'Editar fotos')),
            '/produtos/edit_photos/'.$produto['Produto']['id'],
            array('escape' => false)
        );
        echo $this->Html->link(
            $this->Html->image('icon/page_white_edit.png', array('class' => 'tipHoverBottom', 'title' => 'Editar dados')),
            '/produtos/edit/'.$produto['Produto']['id'],
            array('escape' => false)
        );
    }
    ?>

</ul>

<?php

echo '<script type="text/javascript" src="' . $html->url('/js/jquery.jqzoom-core.js') . '"></script>';
echo $html->css('jquery.jqzoom');
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false,
            zoomWidth: 350,
            zoomHeight: 310,
            xOffset:0,
            yOffset:0,
            yOffset:0
        });
    });
</script>
<script type="text/javascript" >
    function toggleFrete() {
        if ( $("#calcula_frete_check").is(":visible") ){
            $("#calcula_frete_box").hide("fast");
            //$("#calcula_frete").show("");
        }else{
            $("#calcula_frete_box").show("fast");
            //$("#calcula_frete").hide("");
        }
        return false;
    }
</script>

<table class="produto">
<tr>
<td style="width:auto" valign="top">

    <div class="produto_foto_principal"  >

        <?php
        //verifica se esta em lançamento
        if($produto['Produto']['lancamento'] == 1){
            ?>
            <div class="lancamento" style="z-index: 100;">
                New
            </div>
        <?php
        }
        ?>

        <?php
        if(empty($produto['Produto']['img_mini']))
            $url_imagem = $this->Html->image('/img/sem_foto.png', array("alt" => "[Imagem]".$produto['Produto']['nome']));
        else{
            //$url_imagem = $this->Html->image('/fotos/'.$produto['Produto']['img_mini'], array("alt" => "[Imagem]".$produto['Produto']['nome']));
            $url_imagem = $this->Html->link(
                $this->Html->image('/fotos/'.$produto['Produto']['img_mini'], array("alt" => "[Imagem]".$produto['Produto']['nome'])),
                '/fotos/'.$produto['Produto']['img'],
                array('escape' => false, 'class' => 'jqzoom', 'rel' => 'gal1', 'title' => $produto['Produto']['nome'])
            );
        }
        echo $url_imagem;

        ?>
        <div style="clear:both"></div>
    </div>

    <div class="produto_foto_detalhe" >
        <?php
        if(count($produto['Foto']) > 0){
            $count = 1;
            foreach($produto['Foto'] as $foto){
                echo $this->Html->link(
                    $this->Html->image('/fotos/'.$foto['nome_img'], array("alt" => "[Imagem]")),
                    '/fotos/'.$foto['nome'],
                    array('escape' => false, 'rel' => 'lightbox-gallery', 'title' => $produto['Produto']['nome'])
                );
                $count++;
            }
        }else{
            echo 'Sem fotos deste produto';
        }
        ?>
    </div>

</td>
<td style="width:350px;text-align: left;padding-top: 17px;position: relative;" valign="top">


    <?php
    //verifica se esta em promoção
    if($produto['Produto']['promocao'] == 1){
        echo '<div style="height: 78px;">';
        ?>
        <div class="promocao_view">
            <?php echo intval($produto['Produto']['desconto']) ?>%
        </div>
        <?php

        if($produto['Produto']['venda_somente_loja'] == 1){
            ?>
            <div class="venda_loja_aviso">
                Produto em exposição!
            </div>
        <?php
        }

        echo '<div style="clear:both"></div></div>';
    }

    ?>

    <?php if($produto['Produto']['promocao'] == 1): ?>

        <div class="PrecoProduto">
                                    <span style="font-size: 12px;">
                                        <strong>De</strong>
                                        <span style="text-decoration:line-through;"><?php echo $produto['Moeda']['sigla'].' '.$produto['Produto']['valor_form']; ?></span>
                                    </span>
            <br/>
            <label style="font-weight: bold;">Por</label>
            <strong> <?php echo $produto['Moeda']['sigla'].' '.number_format($produto['Produto']['valor']*(100-$produto['Produto']['desconto'])/100, 2, ',', '.'); ?></strong>
        </div>

        <br>
    <?php else: ?>
        <div class="PrecoProduto"
            <?php
            //verificar se possui opção de cor na categoria selecionada
            if(!empty($categorias[$produto['Subcategoria']['categoria_id']]['Categoria']['cor'])){
                //echo 'style="color: '.$categorias[$produto['Subcategoria']['categoria_id']]['Categoria']['cor'].';moz-box-shadow: 0px 0px 22px '.$categorias[$produto['Subcategoria']['categoria_id']]['Categoria']['cor'].';-webkit-box-shadow: 0px 0px 22px '.$categorias[$produto['Subcategoria']['categoria_id']]['Categoria']['cor'].';box-shadow: 0px 0px 22px '.$categorias[$produto['Subcategoria']['categoria_id']]['Categoria']['cor'].';"';
            }
            ?>
            >
            <label style="font-weight: bold;">Por</label>
            <strong><?php echo $produto['Moeda']['sigla'].' '.$produto['Produto']['valor_form']; ?></strong>
        </div>
        <br/>
    <?php endif; ?>

    <br/>

    <?php if(count($produto['Tamanho']) == 0): ?>

        <?php if($produto['Produto']['quantidade'] > 0): ?>
            <label class="formulario">Estoque</label>
            <?php echo $produto['Produto']['quantidade']; ?> unidades
            <br/>
        <?php else: ?>
            <label class="formulario">Tempo de produção</label>
            <?php echo $produto['Produto']['tempo_producao']; ?> dias
            <br/>
        <?php endif; ?>

    <?php endif; ?>

    <?php if($config_sistema['Configuracao']['ativa_marcas'] == 1): ?>
        <?php if(!empty($produto['Marca']['nome'])): ?>

            <label class="formulario">Marca</label>
            <?php echo $produto['Marca']['nome']; ?>
            <br />

        <?php endif; ?>
    <?php endif; ?>

    <?php if(!empty($produto['Modelo']['nome'])): ?>
        <?php if(!empty($produto['Modelo']['nome'])): ?>

            <label class="formulario">Modelo</label>
            <?php echo $produto['Modelo']['nome']; ?>
            <br/>

        <?php endif; ?>
    <?php endif; ?>

    <?php if(false): ?>
        <label class="formulario">Peso</label>
        <?php echo $produto['Produto']['peso_form']; ?> Kg
        <br />
    <?php endif; ?>

    <div style="height: 2px;background: #F8D750;width: 237px;margin-left: 46px;"></div>
    <div class="comprar">

        <?php
        echo $this->Form->create('Itempedido', array('url' => array('controller' => 'itempedidos', 'action' =>'add/'.$produto['Produto']['id']), 'id' => 'formvalidade' ));
        $count_cors = count($produto['Cor']);
        if($count_cors > 0){
            echo '<label class="formulario" style="padding-top: 12px;margin-bottom: 10px;">Cor</label> ';
            $count = 0;
            echo '<div style="float:left"><table style="width:auto">';

            foreach($produto['Cor'] as $cor){
                echo '<tr><td>';
                echo '<input type="radio" style="float:left"  name="corid" id="campo_cor_'.$cor['id'].'"  value="'.$cor['id'].'" />';
                echo '</td><td>';
                echo '<span style="float:left;" class="select_radio_produto" for="campo_cor_'.$cor['id'].'" >'.$cor['nome'].'</span>';

                $count++;
                echo '</td></tr>';
            }
            echo '</table></div>';
            echo '<br><br>';
        }
        $count_tamanhos = count($produto['Tamanho']);
        if($count_tamanhos > 0){
            echo '<label class="formulario" style="padding-top: 12px;margin-bottom: 10px;">Tamanho</label> ';
            $count = 0;

            echo '<div style="padding-left: 126px;">';
            foreach($produto['Tamanho'] as $tamanho){
                echo '<table style="width:auto; float:left; margin-right: 10px;" id="tamanho_'.$tamanho['id'].'"><tr>';

                echo '<td><input type="radio" name="tamanhoid" id="campo_tamanho_'.$tamanho['id'].'" value="'.$tamanho['id'].'" /></td>';
                echo '<td><span style="float:left;width:auto" class="select_radio_produto">'.$tamanho['nome'].'</span></td>';

                $count++;
                echo '</tr></table>';
            }
            echo '</div>';
            echo '<br><br>';
        }






        if($produto['Produto']['venda_somente_loja'] == 1){
            if($login_group_id == 1){
                echo '<div id="area_compra">';

                echo '<br/><button style="float:center;padding-left: 10px;" class="button2 large2 orange2" type="submit" id="botao_adicionar_produto" >';
                echo $this->Html->image('icon/shopping-cart-add-icon.png', array('style' => 'width: 21px;padding-right: 11px;'));
                echo '<span style="float: right;padding-top: 2px;">Adicionar no carrinho</span></button>';
                echo '</div><div id="produto_sem_estoque" style="display:none">Sem estoque</div>';

            }else{
                if(sem_estoque($produto))
                    echo '<div id="produto_sem_estoque">Sem estoque</div>';
                else{
                    echo '<div class="venda_somente_loja">';
                    echo $this->Html->link(
                        'Faça sua encomenda!',
                        '/produtos/encomenda/'.$produto['Produto']['id'],
                        array('style' => '', 'target' => '_blank')
                    );
                    echo '</div>';
                }
            }
        }else{

            if(empty($opcao)){
                echo '<div id="area_compra">';
                echo '<br/><button style="float:center;padding-left: 10px;" class="button2 large2 orange2" type="submit" id="botao_adicionar_produto" >';
                echo $this->Html->image('icon/shopping-cart-add-icon.png', array('style' => 'width: 21px;padding-right: 11px;'));
                echo '<span style="float: right;padding-top: 2px;">Adicionar no carrinho</span></button>';
                echo '</div><div id="produto_sem_estoque" style="display:none">Sem estoque</div>';
            }
        }
        echo '</form>';

        ?>

    </div>
</td>
<td style="float:right;width: 229px">




    <?php

    //exibir botão "Amei"
    if($config_sistema['Configuracao']['exibe_botao_prod_amei'] == 1){
        ?>
        <div style="float:left">
            <?php

            $url_image = 'package_favourite.png';
            $text_amei = 'Amou o produto?';
            $amei_url = '/produtos/registra_preferencia/'.$produto['Produto']['id'];
			$cor_item = '#D61818';
            if($produto['Subcategoria']['categoria_id'] == 6){
                $url_image = 'facebook_like_icon.png';
                $text_amei = 'Curtiu o produto?';
                $amei_url = '/produtos/registra_preferencia/'.$produto['Produto']['id'].'/masculino';
				$cor_item = '#0B22D1';
            }


            $margem_direita = 'margin-right: 20px';
            if($produto['Produto']['count_amei'] > 0){
                echo '<span style="color: '.$cor_item.';font-size: 14px;font-weight: bold;margin-top: 17px;padding-bottom: 0px;display: block;float: right;width: 23px;margin-right: 2px">'.$produto['Produto']['count_amei'].'</span>';
                if($produto['Produto']['count_amei'] == 1){
                    if($produto['Subcategoria']['categoria_id'] == 6)
                        $text_amei = $produto['Produto']['count_amei']. ' curtiu o produto. Clique se você curtiu também!';
                    else
                        $text_amei = $produto['Produto']['count_amei']. ' amou o produto. Clique se você amou também!';

                }else{
                    if($produto['Subcategoria']['categoria_id'] == 6)
                        $text_amei = $produto['Produto']['count_amei']. ' curitram o produto. Clique se você curtiu também!';
                    else
                        $text_amei = $produto['Produto']['count_amei']. ' amaram o produto. Clique se você amou também!';
                }
                $margem_direita = '';
            }




            echo $this->Html->link(
                $this->Html->image($url_image, array('style' => 'max-width:40px;'.$margem_direita,'class' => 'tipHoverTop', 'title' => $text_amei)),
                $amei_url,
                array('escape' => false, 'style' => 'float: left;')
            );
            ?>
        </div>
        <div style="float:left">
            <?php
            $text_quero = 'Quer o produto?';
            $margem_direita = 'margin-right: 20px';
            if($produto['Produto']['count_quero'] > 0){
                echo '<span style="color: #DA7A00;font-size: 14px;font-weight: bold;margin-top: 17px;padding-bottom: 0px;display: block;float: right;width: 23px;margin-right: 2px">'.$produto['Produto']['count_quero'].'</span>';
                if($produto['Produto']['count_quero'] == 1)
                    $text_quero = $produto['Produto']['count_quero']. ' pessoa quer o produto. Clique se você quer também!';
                else
                    $text_quero = $produto['Produto']['count_quero']. ' querem o produto. Clique se você quer também!';

                $margem_direita = '';
            }

            echo $this->Html->link(
                $this->Html->image('package_gift.png', array('style' => 'max-width:40px;'.$margem_direita,'class' => 'tipHoverTop', 'title' => $text_quero)),
                '/produtos/registra_desejo/'.$produto['Produto']['id'],
                array('escape' => false, 'style' => 'float: left;')
            );
            ?>
        </div>

    <?php
    }

    //exibir botão "Facebook"
    if($config_sistema['Configuracao']['exibe_botao_prod_facebook'] == 1){
        ?>
        <div style="float:left">


            <a href="#"
               onclick="
                                window.open(
                                  'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),
                                  'facebook-share-dialog',
                                  'width=626,height=436');
                                return false;">
                <?php echo $this->Html->image('facebook.png', array('style' => 'max-width:40px;margin-right: 5px;','class' => 'tipHoverTop', 'title' => 'Compartilhe com seus amigos!')); ?>
            </a>
            <?php

            ?>
        </div>
    <?php
    }

    //exibir botão "Indicar a um amigo"
    if($config_sistema['Configuracao']['exibe_botao_prod_indicar'] == 1){
        echo '<div style="float:left">';
        echo $this->Html->link(
            $this->Html->image('email.png', array('style' => 'width: 38px;','class' => 'tipHoverTop', 'title' => 'Indique a um amigo')),
            '#',
            array('id' => 'indicar_produto', 'escape' => false)
        );
        echo '</div>';
    }

    ?>
    <br/><br/>

    <div style="padding-top: 20px;">
        <a id="calcula_frete" href="#" onclick="toggleFrete()" style="">
            <?php
            echo $this->Html->image('delivery.png', array('style' => 'width: 53px;float: left;'));
            ?>
            <span style="font-weight: bold;font-size: 15px;display: block;float: left;padding-top: 21px;color: #AC6E00;margin-left: 12px;">
                                Calcular frete
                            </span>
        </a>
        <br/>
        <div id="calcula_frete_box" style="width: 230px;">

            <?php
            echo $this->Form->create('Correio', array('url' => array('controller' => 'pedidos', 'action' =>''), 'style' => 'float: left', 'id' => 'formulario'));

            echo '<input type="checkbox" id="calcula_frete_check" value="1" style="display: none;" />';
            echo '<label style="float:left" for="ContatoCepOrigem">Insira o CEP de destino</label>';
            echo '<br>';
            echo $this->Form->input('cep_destino', array('style' => 'margin-left: 8px;width:100px;', 'value' => '', 'label' => false, 'div' => false));
            echo '<br>';echo '<br>';

            echo '<label style="float:left" for="ContatoPeso">Tipo de envio</label>';
            echo '<br>';
            echo '<input type="radio" name="TipoCorreio"  value="41106"/>PAC&nbsp;&nbsp;&nbsp; ';
            echo '<input type="radio" name="TipoCorreio" checked="checked" value="40010"/>SEDEX';
            echo '<input type="radio" name="TipoCorreio" value="40215"/>SEDEX 10';

            echo '</form>';
            ?>
            <br/><br/>
            <div id="calcula_frete_valor" style="display: none;">
            </div>

            <button id="calcula_frete_button" class="button2 small2 orange2">Calcular Frete</button>

            <div style="clear: both"></div>
        </div>
    </div>
</td>
</tr>
</table>
<br/>

<table style="width: 100%;" class="tabela_detalhe">
    <tr>
        <td class="destaque">Descrição</td>
    </tr>
    <tr>
        <td><?php echo '<div class="descricao">'.$produto['Produto']['descricao'].'</div>'; ?></td>
    </tr>
</table>

<br/>
<h2>Comentários</h2>


<script type="text/javascript">

    $(function() {

        $("#formulario_comentario").validate({
            rules: {
                'data[Comentario][nome]': {
                    required: true,
                    minlength: 2
                },
                'data[Comentario][descricao]': {
                    required: true,
                    minlength: 2
                },
                'data[Comentario][nota]': {
                    required: true
                }
            },
            messages: {
                'data[Comentario][nome]': {
                    required: "Campo obrigatório!",
                    minlength: "Muito pequeno!"
                },
                'data[Comentario][descricao]': {
                    required: "Campo obrigatório!",
                    minlength: "Muito pequeno!"
                },
                'data[Comentario][nota]': {
                    required: "Campo obrigatório!"
                }
            }
        });
    });
</script>
<p style="margin-left: 10px;display: none">
    <a id="inserir_comentario" href="#" onclick="exibe_comentario(); return false;">Dê sua opnião sobre o produto!</a>
</p>

<div id="comentario_form" style="display: none;">
    <?php
    echo $this->Form->create('Comentario', array('url' => array('controller' => 'comentarios', 'action' =>'add'), 'class' => 'formulario', 'id' => 'formulario_comentario'));
    echo $this->Form->hidden('produto_id', array('value' => $produto['Produto']['id']));

    echo '<label class="formulario">Nota </label>';
    ?>
    <table>
        <tr>
            <td><input name="data[Comentario][nota]" type="radio" value="1"></td>
            <td style="background: #FFA479;width: 17px;text-align: center;font-weight: bold;-moz-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;">1</td>
            <td><input name="data[Comentario][nota]" type="radio" value="2"></td>
            <td style="background: #FDE63A;width: 17px;text-align: center;font-weight: bold;-moz-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;">2</td>
            <td><input name="data[Comentario][nota]" type="radio" value="3"></td>
            <td style="background: #FFFF79;width: 17px;text-align: center;font-weight: bold;-moz-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;">3</td>
            <td><input name="data[Comentario][nota]" type="radio" value="4" checked="checked"></td>
            <td style="background: #BCFF88;width: 17px;text-align: center;font-weight: bold;-moz-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;">4</td>
            <td><input name="data[Comentario][nota]" type="radio" value="5"></td>
            <td style="background: #0F3;width: 17px;text-align: center;font-weight: bold;-moz-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;">5</td>
        </tr>
    </table>
    <?php
    echo '<br/>';

    echo '<label class="formulario">Nome </label>';
    echo $this->Form->input('nome', array('style' => 'width:300px', 'label' => false));
    echo '<br/>';

    echo '<label class="formulario">E-mail </label>';
    echo $this->Form->input('email', array('style' => 'width:300px', 'label' => false));
    echo '( não é exibido ao público )';
    echo '<br/>';

    echo '<label class="formulario">Comentário </label>';
    echo $this->Form->textarea('descricao', array('style' => 'width: 400px;height: 150px;', 'label' => false));
    echo '<br/>';

    echo '<br/>';
    echo '<button type="submit" class="button2 large2 orange2" style="margin-left: 174px;" >Salvar</button></form>';
    ?>
</div>

<div class="fb-comments" data-href="<?php echo $selfURL; ?>" data-width="700"></div>

<?php
if(false)
if(!empty($produto['Comentario'])){
    foreach ($produto['Comentario'] as $comentario){
        if($comentario['aprovado']){
            ?>
            <table style="width: 100%;margin-top: 26px;" class="tabela_detalhe">
                <tr>
                    <td class="destaque" style="height: 16px;"><?php echo $comentario['nome']; ?>
                        <div style="float:right">
                            Data: <?php echo date('d/m/Y', strtotime($comentario['created'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Nota: <?php echo $comentario['nota']; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td ><?php echo '<div class="descricao">'.nl2br($comentario['descricao']).'</div>'; ?></td>
                </tr>
            </table>
        <?php
        }
    }
}else{
    ?>
    <table style="width: 100%;" class="tabela_detalhe">
        <tr>
            <td>Sem comentários. Seja o primeiro!</td>
        </tr>
    </table>
<?php
}
?>
