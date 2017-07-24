<script type="text/javascript" src="<?php echo $html->url('/js/slimbox/slimbox2.js') ?>"></script> 
<link rel="stylesheet" href="<?php echo $html->url('/js/slimbox/slimbox2.css') ?>" type="text/css" /> 

<script type="text/javascript">
		
$(function() {
        var flag_pedidos = 0;

        $('#link_pedidos').click(function() {
                if (flag_pedidos == 0) {
                        $('#menu_pedidos').slideDown('fast'); flag_pedidos = 1;
                        //$('#link_pedidos').html('-');  
                } else {
                        $('#menu_pedidos').slideUp('fast'); flag_pedidos = 0; 
                        //$('#link_pedidos').html('+');  
                }
                return false; 
        });
});

</script>


<script type="text/javascript">

	$(function() {
                
                $('#add_tamanho').click	(function()
			{
				var titulo = "Adicionar Tamanho";
                                var mensagem = '<?php echo $this->Form->create('Tamanho', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'tamanhos', 'action' =>'add'), 'id' => 'formvalidade'));?> \n\
                                                <label>Nome do tamanho</label> <br/> \n\
                                                <?php echo $this->Form->input('nome', array('style' => 'width:150px', 'label' => false)); ?><br/>\n\
                                                <?php echo $this->Form->hidden('produto_id', array('value' => $produto['Produto']['id'])); ?>\n\
                                                <button type="submit" class="button2 large2 orange2">Salvar</button></form><br/>\n\
                                                </form>';
                                popupMsg(titulo,mensagem);
				return false;
			}
		);
                    
                $('#add_cor').click	(function()
			{
				var titulo = "Adicionar Cor";
                                var mensagem = '<?php echo $this->Form->create('Cor', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'cors', 'action' =>'add'), 'id' => 'formvalidade'));?> \n\
                                                <label>Nome da cor</label> <br/> \n\
                                                <?php echo $this->Form->input('nome', array('style' => 'width:150px', 'label' => false)); ?><br/>\n\
                                                <?php echo $this->Form->hidden('produto_id', array('value' => $produto['Produto']['id'])); ?>\n\
                                                <button type="submit" class="button2 large2 orange2">Salvar</button></form><br/>\n\
                                                </form>';
                                popupMsg(titulo,mensagem);
				return false;
			}
		);
                    
                <?php foreach($produto['Tamanho'] as $tamanho): ?>
                
                $('#edit_tamanho_<?php echo $tamanho['id'] ?>').click	(function()
			{
				var titulo = "Editar tamanho";
                                var mensagem = '<?php echo $this->Form->create('Tamanho', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'tamanhos', 'action' =>'edit'), 'id' => 'formvalidade'));?> \n\
                                                <label>Nome do tamanho</label> <br/> \n\
                                                <?php echo $this->Form->input('nome', array('style' => 'width:150px', 'value' => $tamanho['nome'], 'label' => false)); ?><br/>\n\
                                                <?php echo $this->Form->hidden('produto_id', array('value' => $produto['Produto']['id'])); ?>\n\
                                                <?php echo $this->Form->hidden('id', array('value' => $tamanho['id'])); ?>\n\
                                                <button type="submit" class="button2 large2 orange2">Salvar</button></form><br/>\n\
                                                </form>';
                                popupMsg(titulo,mensagem);
				return false;
			}
		);
                
                <?php endforeach; ?>
                
                <?php foreach($produto['Cor'] as $cor): ?>
                
                $('#edit_cor_<?php echo $cor['id'] ?>').click	(function()
			{
				var titulo = "Editar cor";
                                var mensagem = '<?php echo $this->Form->create('Cor', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'cors', 'action' =>'edit'), 'id' => 'formvalidade'));?> \n\
                                                <label>Nome da cor</label> <br/> \n\
                                                <?php echo $this->Form->input('nome', array('style' => 'width:150px', 'value' => $cor['nome'], 'label' => false)); ?><br/>\n\
                                                <?php echo $this->Form->hidden('produto_id', array('value' => $produto['Produto']['id'])); ?>\n\
                                                <?php echo $this->Form->hidden('id', array('value' => $cor['id'])); ?>\n\
                                                <button type="submit" class="button2 large2 orange2">Salvar</button></form><br/>\n\
                                                </form>';
                                popupMsg(titulo,mensagem);
				return false;
			}
		);
                
                <?php endforeach; ?>
				
	});

</script>

<ul>
	<?php
	echo $this->Html->link(
                $this->Html->image('icon/find.png', array('class' => 'tipHoverBottom', 'title' => 'Visualizar como cliente')),
                '/produtos/view/'.$produto['Produto']['id'],
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
	?>
    
    <?php
    echo $this->Html->link(
        'Cadastrar novo produto',
        '/produtos/add/'.$produto['Produto']['id'],
        array('style' => 'font-weight:bold;float:right;font-size: 15px;', 'class' => 'tipHoverBottom', 'title' => 'Cadastrar produto na mesma subcategoria do produto abaixo')
    );
    
    ?>
</ul>
	

<table class="produto">
	<tr>
		<td style="width:250px;vertical-align: top;">
			
			<div class="fotos"  >
			<?php 
			if(count($produto['Foto']) > 0){
				foreach($produto['Foto'] as $foto){
					echo '<div class="produto_foto_view">';
                                                $class_img = '';
                                                if($foto['nome_img'] == $produto['Produto']['img']){
                                                    $class_img = 'borda_colorida';
                                                }
						echo $this->Html->link(
						    $this->Html->image('/fotos/'.$foto['nome_img'], array("alt" => "[Imagem]", 'style' => 'float:left', 'class' => $class_img)),
						    '/fotos/'.$foto['nome'],
						    array('escape' => false, 'target' => '_blank', 'rel' => 'lightbox-gallery', 'title' => $produto['Produto']['nome'])
						);
						if($foto['nome_img'] == $produto['Produto']['img']){
							echo $this->Html->link(
							    $this->Html->image('icon/star_1.png', array("alt" => "[Imagem]", 'style' => 'float:right;margin-top:5px;', 'class' => 'tipHoverBottom', 'title' => 'Foto principal')),
							    '#',
							    array('escape' => false)
							);
						}else{
							echo $this->Html->link(
							    $this->Html->image('icon/star_branca.png', array("alt" => "[Imagem]", 'style' => 'float:right;margin-top:5px;', 'class' => 'tipHoverBottom', 'title' => 'Tornar foto principal')),
							    '/produtos/foto_principal/'.$produto['Produto']['id'].'/'.$foto['id'],
							    array('escape' => false, 'style' => 'width:20px;height:20px')
							);
						}
					echo '</div>';
					echo '<br/>';
				}
			}else{
				echo 'Sem fotos deste produto';
			}
			?>
			</div>
			
		</td>
		<td style="width:auto" valign="top">

			<table style="width: 100%;" class="tabela_detalhe">
                            <tr>
                                <td class="destaque" style="width: 90px">Nome</td>
                                <td><?php echo $produto['Produto']['nome']; ?></td>
                            </tr>
                            <tr>
                                <td class="destaque">Categoria</td>
                                <td><?php echo $categoria['Categoria']['nome'].' - '.$produto['Subcategoria']['nome']; ?></td>
                            </tr>
                            <tr>
                                <td class="destaque">Modelo</td>
                                <td><?php echo $produto['Modelo']['nome']; ?></td>
                            </tr>
                            <?php if($config_sistema['Configuracao']['ativa_marcas'] == 1): ?>
    
                                <tr>
                                    <td class="destaque">Marca</td>
                                    <td><?php echo $produto['Marca']['nome']; ?></td>
                                </tr>
                            <?php endif; ?>   
                            <tr>
                                <td class="destaque">Peso</td>
                                <td><?php echo $produto['Produto']['peso_form']; ?> Kg</td>
                            </tr>
                            <tr>
                                <td class="destaque">Pacote</td>
                                <td><?php echo $produto['Produto']['medida_comprimento'].' x '.$produto['Produto']['medida_largura'].' x '.$produto['Produto']['medida_altura']; ?>  cm</td>
                            </tr>
                            <tr>
                                <td class="destaque">Desconto</td>
                                <td>
                                    <?php 
                                    if(!empty($produto['Produto']['desconto']))
                                        echo $produto['Produto']['desconto'].'%'; 
                                    else
                                        echo 'Não definido';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="destaque">Lançamento</td>
                                <td><?php 
                                if(!empty($produto['Produto']['lancamento']))
                                    echo 'SIM';
                                else
                                    echo 'NÃO';
                                ?></td>
                            </tr>
                            <tr>
                                <td class="destaque">Venda somente na loja</td>
                                <td><?php 
                                if($produto['Produto']['venda_somente_loja'] == 1){
                                    echo 'SIM';
                                }else{
                                    echo 'NÃO';
                                }
                                ?></td>
                            </tr>
                            <tr>
                                <td class="destaque">Ativo</td>
                                <td>
                                    <?php 
                                    if($produto['Produto']['ativo'] == 0){
                                            $nest_status = 'Ativar';
                                            echo '<span style="color:red">Não</span>';
                                    } else {
                                            $nest_status = 'Desativar';
                                            echo '<span style="color:blue">Sim</span>';
                                    } 
                                    ?> (<?php 
                                            echo $this->Html->link(
                                                $nest_status,
                                                '/produtos/alterar_status/'.$produto['Produto']['id']
                                            );
                                    ?>)
                                </td>
                            </tr>
                        </table>
			<br/>
                        
			
			<?php 
			
				echo '<table class="listagem" >';
				echo '<tr class="listagem_header" >
                                        <td class="header_table" style="min-width:120px" ><strong>Cor</strong>';
                                echo $this->Html->link(
                                    $this->Html->image('icon/add.png', array('class' => 'tipHoverBottom', 'title' => 'Adicionar cor', 'style' => 'float:right')),
                                    '/produtos/edit/'.$produto['Produto']['id'],
                                    array('escape' => false, 'id' => 'add_cor')
                                );
                                echo '
                                        </td><td>&nbsp;</td>
                                        <td class="header_table"><strong>Ações</strong></td>
                                      </tr>';
				if(count($produto['Cor']) > 0){
                                    foreach($produto['Cor'] as $cor){
                                            echo '<tr><td>'.$cor['nome'].'</td><td>&nbsp;</td><td style="text-align: center;">';

                                            echo $this->Html->link(
                                                $this->Html->image("icon/page_white_edit.png", array('id'=>'edit_cor_'.$cor['id'], 'class' => 'tipHoverRight', 'title' => 'Editar cor <br/><br/> Use somente para corrigir o nome, mas não mudar o contexto, pois é usado no histórico dos pedidos')),
                                                '#',
                                                array('escape' => false)
                                            );
                                            echo '&nbsp;&nbsp;';
                                            echo $this->Html->link(
                                                $this->Html->image("icon/bin_closed.png", array('class' => 'tipHoverRight', 'title' => 'Remover cor')),
                                                '/cors/delete/'.$cor['id'],
                                                array('escape' => false),
                                                'Tem certeza que deseja remover esta cor?'
                                            );
                                            echo '</td></tr>';
                                    }
                                }else{
                                    echo '<tr><td>Sem cores cadastradas</td></tr>';
                                }
                                
				echo '</table>'; 
			
			 
			?>
			<br/>
                        <?php 
			
                                echo '<table class="listagem" >';
				echo '<tr class="listagem_header" >
                                        <td class="header_table" style="min-width:120px" ><strong>Tamanho</strong>';
                                echo $this->Html->link(
                                    $this->Html->image('icon/add.png', array('class' => 'tipHoverBottom', 'title' => 'Adicionar tamanho', 'style' => 'float:right')),
                                    '#',
                                    array('escape' => false, 'id' => 'add_tamanho')
                                );
                                echo '
                                        </td><td>&nbsp;</td>
                                        <td class="header_table"><strong>Ações</strong></td>
                                      </tr>';
				if(count($produto['Tamanho']) > 0){
                                    foreach($produto['Tamanho'] as $tamanho){
                                            echo '<tr><td>'.$tamanho['nome'].'</td><td>&nbsp;</td><td style="text-align: center;">';

                                            echo $this->Html->link(
                                                $this->Html->image("icon/page_white_edit.png", array('id'=>'edit_tamanho_'.$tamanho['id'], 'class' => 'tipHoverRight', 'title' => 'Editar tamanho <br/><br/> Use somente para corrigir o nome, mas não mudar o contexto, pois é usado no histórico dos pedidos')),
                                                '#',
                                                array('escape' => false)
                                            );
                                            echo '&nbsp;&nbsp;';
                                            echo $this->Html->link(
                                                $this->Html->image("icon/bin_closed.png", array('class' => 'tipHoverRight', 'title' => 'Remover tamanho')),
                                                '/tamanhos/delete/'.$tamanho['id'],
                                                array('escape' => false),
                                                'Tem certeza que deseja remover este tamanho?'
                                            );
                                            echo '</td></tr>';
                                    }
                                }else{
                                    echo '<tr><td>Sem tamanhos cadastrados</td></tr>';
                                }
				echo '</table>';
			 
			?>
                        <br/>
			
		</td>
		<td  valign="top" style="padding-left: 11px;">
                        <table style="width: auto;margin: 2px;" class="tabela_detalhe">
                            <tr>
                                <td>
                                    <div style="width:200px; font-size:15px;margin-left: 20px;">
                                            <?php if($produto['Produto']['promocao'] == 1): ?>
                                                    <strong>De</strong>
                                                    <?php echo $produto['Moeda']['sigla'].' '.$produto['Produto']['valor_form']; ?>
                                                    <br/><br/>

                                                    <strong>Por</strong>
                                                    <strong> <?php echo $produto['Moeda']['sigla'].' '.number_format($produto['Produto']['valor']*(100-$produto['Produto']['desconto'])/100, 2, ',', '.'); ?></strong>

                                                    <br>
                                            <?php else: ?>
                                                    <strong>Por</strong>
                                                    <strong><?php echo $produto['Moeda']['sigla'].' '.$produto['Produto']['valor_form']; ?></strong>
                                                    <br/>
                                            <?php endif; ?>
                                            <br/>
                                    </div>	
                                </td>
                            </tr>
                        </table>    
                                    
                        <br/>
                        
                        <fieldset>
                            <legend>
                            Estatísticas
                            </legend>

                            <strong>Número de visualizações:</strong>
                            <?php 
                            echo $produto['Produto']['visualizacao'];
                            ?>
                            <br/><br/>
                            <strong>Número de pedidos:</strong>
                            <?php 
                            if(!empty($produto['Itempedido'])){
                                echo count($produto['Itempedido']);

                                //montar lista de pedidos
                                ?>
                                <br/><a id="link_pedidos" href="#">Detalhes</a>
                                <div id="menu_pedidos" style="display: none;width:270px; ">

                                    <fieldset>
                                        <legend>
                                        Códigos dos pedidos
                                        </legend>

                                        <?php
                                        foreach($produto['Itempedido'] as $item){
                                            echo $this->Html->link($item['pedido_id'], '/pedidos/view_admin/'.$item['pedido_id']);
                                            echo '&nbsp; ';
                                        }
                                        ?>

                                    </fieldset>
                                </div>
                                <?php

                            }else{
                                echo '0';
                            }
                            ?>

                        </fieldset>
                        
                        
                        <br/><br/>
                        <label class="formulario">
				Quantidade
				
			</label>
                        
                        <?php
                        echo $this->Html->link(
                            $this->Html->image('icon/page_white_edit.png', array('class' => 'tipHoverLeft', 'title' => 'Alterar quantidades', 'style' => 'float:right')),
                            '/produtos/edit_quantidade/'.$produto['Produto']['id'],
                            array('escape' => false, 'id' => 'add_tamanho')
                        );
                        ?>
                        
                        <table class="listagem">
                            <tr class="listagem_header">
                                <td class="header_table">Tamanho</td>
                                <td>&nbsp;</td>
                                <?php 
                                if(!empty($produto['Cor'])){
                                    echo '<td class="header_table">Cor</td>';
                                    echo '<td>&nbsp;</td>';
                                }
                                ?>
                                <td class="header_table">Quantidade</td>
                            </tr>
                        
                            <?php foreach($produto['ProdutoQuantidade'] as $produtoquantidade): ?>
                                    
                                    <?php
                                    if(!empty($tamanho_lista[$produtoquantidade['tamanho_id']]) & !empty($cor_lista[$produtoquantidade['cor_id']])):
                                    ?>
                            
                                    <?php 
                                    if(empty($produto['Cor'])){
                                        echo '<tr>';
                                        echo '<td>'.$tamanho_lista[$produtoquantidade['tamanho_id']]['nome'].'</td>';
                                        echo '<td>&nbsp;</td>';
                                        echo '<td>'.$produtoquantidade['quantidade'].'</td>';
                                        echo '</tr>';

                                    }else{
                                        echo '<tr>';
                                        echo '<td>'.$tamanho_lista[$produtoquantidade['tamanho_id']]['nome'].'</td>';
                                        echo '<td>&nbsp;</td>';
                                        echo '<td>'.$cor_lista[$produtoquantidade['cor_id']]['nome'].'</td>';
                                        echo '<td>&nbsp;</td>';
                                        echo '<td style="text-align: center;">'.$produtoquantidade['quantidade'].'</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                    
                                    <?php endif; ?>
                                    
                            <?php endforeach; ?>
                            
                        </table>
                        
                        
		</td>
		
	</tr>
	
</table>

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


<?php
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
