<ul>
    <?php if($login_group == 'Administrador'): ?>
    
            <li ><?php echo $html->link('HOME', '/pages/home'); ?> </li>
            <li ><?php echo $html->link('MEU CADASTRO', '/users/view_data'); ?></li>
            <li class="level1" ><?php echo $html->link('MARCAS', '/produtos'); ?>
                <ul style="">
                    <?php

                    foreach ($marcas as $marca){
                            //exibe nome da categoria
                            echo '<li>'.$html->link($marca['Marca']['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&marca_id='.$marca['Marca']['id']);

                            echo '</li>';
                    }
                    ?>
                </ul>
            </li>
            <li class="level1"><?php echo $html->link('PRODUTOS', '/produtos'); ?>
            <ul style="">
                <li ><?php echo $html->link('PROMOÇÕES', '/produtos/filtro?busca_flag=flag&promocao=1'); ?></li>
                <li ><?php echo $html->link('LANÇAMENTOS', '/produtos/filtro?busca_flag=flag&lancamento=1'); ?></li>
                <li><?php echo $html->link('Venda no Site', '/produtos/filtro?busca_flag=flag&somente_loja=nao'); ?></li>
                <li style="border-bottom: 1px solid #DDD;"><?php echo $html->link('Venda no ShowRoom', '/produtos/filtro?busca_flag=flag&somente_loja=sim'); ?></li>
                
                <?php
                
                foreach ($side_bar as $categoria){
                        //exibe nome da categoria
                        echo '<li>'.$html->link($categoria['Categoria']['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&categoria_id='.$categoria['Categoria']['id']);

                        if(count($categoria['Subcategoria']) > 0){
                                echo '<ul >';
                                echo '<li>'.$html->link('PROMOÇÃO', '/'.$name_side_bar.'/filtro?busca_flag=flag&promocao=1&categoria_id='.$categoria['Categoria']['id']).'</li>';
                                echo '<li>'.$html->link('LANÇAMENTO', '/'.$name_side_bar.'/filtro?busca_flag=flag&lancamento=1&categoria_id='.$categoria['Categoria']['id']).'</li>';
                                    
                                foreach ($categoria['Subcategoria'] as $sub){
                                        echo '<li>'.$html->link($sub['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&subcategoria_id='.$sub['id']).'</li>';
                                        
                                }
                                echo '</ul>';
                        }
                        
                        echo '</li>';
                }
                ?>
            </ul>
            </li>
            
            
            <?php if($config_sistema['Configuracao']['ativa_fotogaleria'] == 1): ?>
                <li ><?php echo $html->link('GALERIA', '/fotogalerias'); ?></li>
            <?php endif; ?>

            <li class="level1"><?php echo $html->link('SISTEMA', '/lojas'); ?>
                <ul style="">
                    <li ><?php echo $html->link('Pedidos', '/pedidos'); ?></li>
                    <li ><?php echo $html->link('Usuários', '/users'); ?></li>
                    <li ><?php echo $html->link('Relatórios', '/lojas/relatorios'); ?></li>
                    <li ><?php echo $html->link('Configurações', '/lojas/dados_gerais'); ?></li>
                </ul>
            </li>
            <li ><?php echo $html->link('DEPOIMENTOS', '/depoimentos'); ?></li>
            <li ><?php echo $html->link('CONTATO TÉCNICO', '/pages/contato_tecnico'); ?></li>
            
    <?php elseif($login_group == 'Cliente'): ?>
            <li ><?php echo $html->link('HOME', '/pages/home'); ?> </li>
            <li class="level1"><?php echo $html->link('PRODUTOS', '/produtos'); ?>
                
            <ul style="">
		<li><?php echo $html->link('Venda no Site', '/produtos/filtro?busca_flag=flag&somente_loja=nao'); ?></li>
                <li style="border-bottom: 1px solid #DDD;"><?php echo $html->link('Venda no ShowRoom', '/produtos/filtro?busca_flag=flag&somente_loja=sim'); ?></li>
                
                <?php
                
                foreach ($side_bar as $categoria){
                        //exibe nome da categoria
                        echo '<li>'.$html->link($categoria['Categoria']['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&categoria_id='.$categoria['Categoria']['id']);

                        if(count($categoria['Subcategoria']) > 0){
                                echo '<ul >';
                                echo '<li>'.$html->link('PROMOÇÃO', '/'.$name_side_bar.'/filtro?busca_flag=flag&promocao=1&categoria_id='.$categoria['Categoria']['id']).'</li>';
                                echo '<li>'.$html->link('LANÇAMENTO', '/'.$name_side_bar.'/filtro?busca_flag=flag&lancamento=1&categoria_id='.$categoria['Categoria']['id']).'</li>';
                                    
                                foreach ($categoria['Subcategoria'] as $sub){
                                        echo '<li>'.$html->link($sub['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&subcategoria_id='.$sub['id']).'</li>';
                                        
                                }
                                echo '</ul>';
                        }
                        
                        echo '</li>';
                }
                ?>
            </ul>
            </li>

            <?php if($config_sistema['Configuracao']['ativa_fotogaleria'] == 1): ?>
                <li ><?php echo $html->link('GALERIA', '/fotogalerias'); ?></li>
            <?php endif; ?>
            <li class="level1"><?php echo $html->link('PROMOÇÕES', '/produtos/filtro?busca_flag=flag&promocao=1'); ?>
                <ul style="">
                    <li ><?php echo $html->link('FEMININO', '/produtos/filtro?busca_flag=flag&categoria_id=5&promocao=1'); ?></li>
                    <li ><?php echo $html->link('MASCULINO', '/produtos/filtro?busca_flag=flag&categoria_id=6&promocao=1'); ?></li>
                </ul>    
            </li>
            <li class="level1"><?php echo $html->link('LANÇAMENTOS', '/produtos/filtro?busca_flag=flag&lancamento=1'); ?>
                <ul style="">
                    <li ><?php echo $html->link('FEMININO', '/produtos/filtro?busca_flag=flag&categoria_id=5&lancamento=1'); ?></li>
                    <li ><?php echo $html->link('MASCULINO', '/produtos/filtro?busca_flag=flag&categoria_id=6&lancamento=1'); ?></li>
                </ul>    
            </li>
            <li ><?php echo $html->link('MEUS PEDIDOS', '/pedidos'); ?></li>
            <li ><?php echo $html->link('MEU CADASTRO', '/users/view_data'); ?></li>
            <li ><?php echo $html->link('DEPOIMENTOS', '/depoimentos'); ?></li>
            <li ><?php echo $html->link('CONTATO', '/pages/contato'); ?></li>
    <?php else: ?>
            <li ><?php echo $html->link('HOME', '/pages/home'); ?> </li>
            <li class="level1" ><?php echo $html->link('PRODUTOS', '/produtos'); ?>
                <ul style="">
                    <li><?php echo $html->link('Venda no Site', '/produtos/filtro?busca_flag=flag&somente_loja=nao'); ?></li>
                    <li style="border-bottom: 1px solid #DDD;"><?php echo $html->link('Venda no ShowRoom', '/produtos/filtro?busca_flag=flag&somente_loja=sim'); ?></li>

                    <?php

                    foreach ($side_bar as $categoria){
                            //exibe nome da categoria
                            echo '<li>'.$html->link($categoria['Categoria']['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&categoria_id='.$categoria['Categoria']['id']);

                            if(count($categoria['Subcategoria']) > 0){
                                    echo '<ul >';
                                    echo '<li>'.$html->link('PROMOÇÃO', '/'.$name_side_bar.'/filtro?busca_flag=flag&promocao=1&categoria_id='.$categoria['Categoria']['id']).'</li>';
                                    echo '<li>'.$html->link('LANÇAMENTO', '/'.$name_side_bar.'/filtro?busca_flag=flag&lancamento=1&categoria_id='.$categoria['Categoria']['id']).'</li>';
                                    foreach ($categoria['Subcategoria'] as $sub){
                                            echo '<li>'.$html->link($sub['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&subcategoria_id='.$sub['id']).'</li>';

                                    }
                                    echo '</ul>';
                            }

                            echo '</li>';
                    }
                    ?>
                </ul>
            </li>

            <li class="level1" ><?php echo $html->link('MARCAS', '/produtos'); ?>
                <ul style="">
                    <?php

                    foreach ($marcas as $marca){
                            //exibe nome da categoria
                            echo '<li>'.$html->link($marca['Marca']['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&marca_id='.$marca['Marca']['id']);

                            echo '</li>';
                    }
                    ?>
                </ul>
            </li>
            
            
            <?php if($config_sistema['Configuracao']['ativa_fotogaleria'] == 1): ?>
                <li ><?php echo $html->link('GALERIA', '/fotogalerias'); ?></li>
            <?php endif; ?>

            <li class="level1"><?php echo $html->link('PROMOÇÕES', '/produtos/filtro?busca_flag=flag&promocao=1'); ?>
                <ul style="">
                    <li ><?php echo $html->link('FEMININO', '/produtos/filtro?busca_flag=flag&categoria_id=5&promocao=1'); ?></li>
                    <li ><?php echo $html->link('MASCULINO', '/produtos/filtro?busca_flag=flag&categoria_id=6&promocao=1'); ?></li>
                </ul>    
            </li>
            <li class="level1"><?php echo $html->link('LANÇAMENTOS', '/produtos/filtro?busca_flag=flag&lancamento=1'); ?>
                <ul style="">
                    <li ><?php echo $html->link('FEMININO', '/produtos/filtro?busca_flag=flag&categoria_id=5&lancamento=1'); ?></li>
                    <li ><?php echo $html->link('MASCULINO', '/produtos/filtro?busca_flag=flag&categoria_id=6&lancamento=1'); ?></li>
                </ul>    
            </li>
            <li ><?php echo $html->link('DEPOIMENTOS', '/depoimentos'); ?></li>
            
            <li ><?php echo $html->link('CONTATO', '/pages/contato'); ?></li>
    <?php endif; ?>

        
</ul>