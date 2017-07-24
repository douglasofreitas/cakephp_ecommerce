<script type="text/javascript">
	function exibe_submenu(id_menu) {
                var sub_menu_verif = '';
                
                <?php 
                //listar as categorias e subcategorias de cada parte
                foreach ($side_bar as $categoria){
                    if(count($categoria['Subcategoria']) > 0){
                        foreach ($categoria['Subcategoria'] as $sub){
                            if($name_side_bar == 'produtos')
                                if(!empty($subcategorias[$sub['id']]['Modelo'])){
                                    foreach ($subcategorias[$sub['id']]['Modelo'] as $mod){
                                        $funcao_oculta = '
                                            
                                            if ( $("#sub_menu_'.$sub['id'].'").is(":visible") ){
                                                sub_menu_verif = "sub_menu_'.$sub['id'].'";
                                                if(sub_menu_verif != id_menu)
                                                    $("#sub_menu_'.$sub['id'].'").hide("fast");
                                            }
                                                    ';
                                        echo $funcao_oculta;
                                    }
                                }
                        }
                    }
                }
                ?>	
                
                if ($("#"+id_menu).length > 0) {
                    $("#"+id_menu).show("fast");
                }
                
                
        }
</script>



<?php 

    //para usar nos formulários de busca
    if($name_side_bar == 'fotogalerias')
        $model_busca = 'Fotogaleria';
    else
        $model_busca = 'Produto';
    
    
    if($login_group == 'Administrador'): ?>
	<?php if($nameSession == 'manage'): ?>
		
			<?php if($controller_name == 'fotogalerias'): ?>
				<?php
                                //formulário para busca rápida
                                if(false):
                                echo $this->Form->create($model_busca, array('type' => 'get', 'enctype' => 'multipart/form-data', 'url' => array('controller' => $name_side_bar, 'action' =>'filtro')));
                                echo $form->hidden('busca_flag', array('value' => 'flag'));
                                ?>
                                
                                   <?php echo $this->Form->input('busca', array('style' => 'padding: 8px 10px;border-radius: 6px;border: none;border-top: 1px solid #B9BBAF;border-left: 1px solid #B9BBAF;', 'label' => false)); ?>
                                   <?php echo '<button type="submit" class="button2 large2 yellow2" style="float:right;width: 100%;">Buscar</button>'; ?>&nbsp;
                                
                                <?php echo '</form>'; ?>
                                <?php endif; ?>


                                <h2 class="h2_side_bar"><?php echo $html->link('Galeria', '/fotogalerias/index'); ?></h2> 
				<ul >
					<li style="border-top: none;" ><?php echo $html->link('Cadastrar', '/fotogalerias/add'); ?></li>
					<li><?php echo $html->link('Listar', '/fotogalerias/index'); ?></li>
					<li><?php echo $html->link('Buscar', '/fotogalerias/filtro_form'); ?></li>
				</ul>
				
                                
                                
				<?php 
				//listar as categorias e subcategorias de cada parte
                                foreach ($side_bar as $categoria){
                                        //exibe nome da categoria
                                        echo '<h2 class="h2_side_bar">'.$html->link($categoria['Categoria']['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&categoria_id='.$categoria['Categoria']['id']).'</h2>';

                                        if(count($categoria['Subcategoria']) > 0){
                                                echo '<ul >';
                                                $count = 0;
                                                foreach ($categoria['Subcategoria'] as $sub){
                                                        if($count == 0) $borda = ' style="border-top: none;" ';
                                                        else $borda = ' ';

                                                        //verifica se aparecerá um ícone para mostrar que tem um sub-menu
                                                        if(!empty($subcategorias[$sub['id']]['Modelo']))
                                                            $tem_submenu = $this->Html->image('menu_indicador.png', array('style' => 'float:right;'));
                                                        else
                                                            $tem_submenu = '';

                                                        echo '<li id="menu_'.$sub['id'].'" '.$borda.'  >'.$html->link($sub['nome'].$tem_submenu, '/'.$name_side_bar.'/filtro?busca_flag=flag&subcategoria_id='.$sub['id'], array('escape' => false, 'onmouseover' => 'exibe_submenu(\'sub_menu_'.$sub['id'].'\')')).' </li>';
                                                        if($name_side_bar == 'produtos')

                                                            if(!empty($subcategorias[$sub['id']]['Modelo'])){
                                                                echo '<ul style="margin-left: 0px;padding-left: 12px;background: #FFF8AD;width: 154px;display:none " id="sub_menu_'.$sub['id'].'">';

                                                                foreach ($subcategorias[$sub['id']]['Modelo'] as $mod){
                                                                    echo '<li style="">'.$html->link($mod['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&modelo_id='.$mod['id']).'</li>';
                                                                }
                                                                echo '</ul>';
                                                            }
                                                        $count++;
                                                }
                                                echo '</ul>';
                                        }
                                }
				
				?>	
			<?php elseif ($controller_name == 'produtos'): ?>
				<?php
                                //formulário para busca rápida
                                if(false):
                                echo $this->Form->create($model_busca, array('type' => 'get', 'enctype' => 'multipart/form-data', 'url' => array('controller' => $name_side_bar, 'action' =>'filtro')));
                                echo $form->hidden('busca_flag', array('value' => 'flag'));
                                ?>
                                
                                   <?php echo $this->Form->input('busca', array('style' => 'padding: 8px 10px;border-radius: 6px;border: none;border-top: 1px solid #B9BBAF;border-left: 1px solid #B9BBAF;', 'label' => false)); ?>
                                   <?php echo '<button type="submit" class="button2 large2 yellow2" style="float:right;width: 100%;">Buscar</button>'; ?>&nbsp;
                                
                                <?php echo '</form>'; ?>
                                <?php endif; ?>
                                
                                <h2 class="h2_side_bar"><?php echo $html->link('> > Produtos', '/produtos/index_admin'); ?></h2> 
				<ul >
					<li style="border-top: none;" ><?php echo $html->link('Cadastrar', '/produtos/add'); ?></li>
					<li><?php echo $html->link('Lista geral', '/produtos/index_admin'); ?></li>
					<li><?php echo $html->link('Buscar', '/produtos/filtro_form'); ?></li>
				</ul>
                                
                                
                                
                                
                                <?php 
				//listar as categorias e subcategorias de cada parte
                                foreach ($side_bar as $categoria){
                                        //exibe nome da categoria
                                        echo '<h2 class="h2_side_bar">'.$html->link($categoria['Categoria']['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&categoria_id='.$categoria['Categoria']['id']).'</h2>';

                                        if(count($categoria['Subcategoria']) > 0){
                                                echo '<ul >';
                                                $count = 0;
                                                foreach ($categoria['Subcategoria'] as $sub){
                                                        if($count == 0) $borda = ' style="border-top: none;" ';
                                                        else $borda = ' ';

                                                        //verifica se aparecerá um ícone para mostrar que tem um sub-menu
                                                        if(!empty($subcategorias[$sub['id']]['Modelo']))
                                                            $tem_submenu = $this->Html->image('menu_indicador.png', array('style' => 'float:right;'));
                                                        else
                                                            $tem_submenu = '';

                                                        echo '<li id="menu_'.$sub['id'].'" '.$borda.'  >'.$html->link($sub['nome'].$tem_submenu, '/'.$name_side_bar.'/filtro?busca_flag=flag&subcategoria_id='.$sub['id'], array('escape' => false, 'onmouseover' => 'exibe_submenu(\'sub_menu_'.$sub['id'].'\')')).' </li>';
                                                        if($name_side_bar == 'produtos')

                                                            if(!empty($subcategorias[$sub['id']]['Modelo'])){
                                                                echo '<ul style="margin-left: 0px;padding-left: 12px;background: #FFF8AD;width: 154px;display:none " id="sub_menu_'.$sub['id'].'">';

                                                                foreach ($subcategorias[$sub['id']]['Modelo'] as $mod){
                                                                    echo '<li style="">'.$html->link($mod['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&modelo_id='.$mod['id']).'</li>';
                                                                }
                                                                echo '</ul>';
                                                            }
                                                        $count++;
                                                }
                                                echo '</ul>';
                                        }
                                }
				
				?>
                        <?php elseif ($controller_name == 'comentarios' || $controller_name == 'depoimentos'): ?>
                                <h2 class="h2_side_bar"><?php echo $html->link('Depoimentos', '/depoimentos'); ?></h2> 
				<ul >
					<li style="border-top: none;" ><?php echo $html->link('Cadastrar', '/depoimentos/add'); ?></li>
                                        <li><?php echo $html->link('Listar', '/depoimentos'); ?></li>
                                        
				</ul>
                                
                                
				<h2 class="h2_side_bar"><?php echo $html->link('Comentários', '/comentarios'); ?></h2> 
				<ul >
					<li style="border-top: none;" ><?php echo $html->link('Cadastrar', '/comentarios/add'); ?></li>
					<li><?php echo $html->link('Listar', '/comentarios'); ?></li>
				</ul>
			<?php else: ?>
				
				
                                
                                <h2 class="h2_side_bar"><?php echo $html->link('Pedidos', '/pedidos'); ?></h2> 
				<ul >
					<li style="border-top: none;" ><?php echo $html->link('Listar', '/pedidos'); ?></li>
                                        <li><?php echo $html->link('Calcular frete', '/pedidos/calcular_frete_form'); ?></li>
                                        
				</ul>
                                
                                
				<h2 class="h2_side_bar"><?php echo $html->link('Usuários', '/users'); ?></h2> 
				<ul >
					<li style="border-top: none;" ><?php echo $html->link('Cadastrar', '/users/add'); ?></li>
					<li><?php echo $html->link('Listar', '/users'); ?></li>
                    <li><?php echo $html->link('Malas diretas', '/users/mala_direta_geral'); ?></li>
				</ul>
				
                                
				<h2 class="h2_side_bar"><?php echo $html->link('Categorias', '/categorias'); ?></h2> 
				<ul >
					<li style="border-top: none;" ><?php echo $html->link('Cadastrar', '/categorias/add'); ?></li>
					<li><?php echo $html->link('Listar', '/categorias'); ?></li>
				</ul>
				
                                <?php if($config_sistema['Configuracao']['ativa_eventos'] == 1): ?>
                                    <h2 class="h2_side_bar"><?php echo $html->link('Eventos', '/eventos'); ?></h2> 
                                    <ul >
                                            <li style="border-top: none;" ><?php echo $html->link('Cadastrar', '/eventos/add'); ?></li>
                                            <li><?php echo $html->link('Listar', '/eventos'); ?></li>
                                    </ul>
                                <?php endif; ?>
                                
                                <h2 class="h2_side_bar"><?php echo $html->link('Marcas', '/marcas'); ?></h2> 
                                <ul >
                                        <li style="border-top: none;" ><?php echo $html->link('Cadastrar', '/marcas/add'); ?></li>
                                        <li><?php echo $html->link('Listar', '/marcas'); ?></li>
                                </ul>
                                    
                                <h2 class="h2_side_bar"><?php echo $html->link('Configurações', '/lojas/dados_gerais'); ?></h2>
                                
			<?php endif; ?>
		
	<?php elseif ($nameSession == 'manage_store'): ?>
                
			
		
        <?php elseif ($nameSession == 'usuario'): ?>
		
			<h2 class="h2_side_bar"><?php echo $html->link('Dados pessoais', '/users/view_data'); ?></h2>
			<h2 class="h2_side_bar"><?php echo $html->link('Pedidos', '/pedidos'); ?></h2>
		
	<?php else: ?>
		
			<h2 class="h2_side_bar"><?php echo $html->link('Dados pessoais', '/users/view_data'); ?></h2>
			<h2 class="h2_side_bar"><?php echo $html->link('Galeria de Fotos', '/fotogalerias'); ?></h2>
			<h2 class="h2_side_bar"><?php echo $html->link('Produtos', '/produtos'); ?></h2>
		
	
	<?php endif; ?>
<?php elseif ($login_group == 'Cliente'): ?>
	<?php if($controller_name == 'home' | $controller_name == 'pedidos'): ?>
		
			<h2 class="h2_side_bar"><?php echo $html->link('Dados pessoais', '/users/view_data'); ?></h2>
			<h2 class="h2_side_bar"><?php echo $html->link('Pedidos', '/pedidos'); ?></h2>
		
	<?php else: ?>
                        
                        <?php
                        //formulário para busca rápida
                        if(false):
                        echo $this->Form->create($model_busca, array('type' => 'get', 'enctype' => 'multipart/form-data', 'url' => array('controller' => $name_side_bar, 'action' =>'filtro')));
                        echo $form->hidden('busca_flag', array('value' => 'flag'));
                        ?>

                           <?php echo $this->Form->input('busca', array('style' => 'padding: 8px 10px;border-radius: 6px;border: none;border-top: 1px solid #B9BBAF;border-left: 1px solid #B9BBAF;', 'label' => false)); ?>
                           <?php echo '<button type="submit" class="button2 large2 yellow2" style="float:right;width: 100%;">Buscar</button>'; ?>&nbsp;

                        <?php echo '</form>'; ?>
                        <?php endif; ?>

                        
		
			<?php
			foreach ($side_bar as $categoria){
                                //exibe nome da categoria
                                echo '<h2 class="h2_side_bar">'.$html->link($categoria['Categoria']['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&categoria_id='.$categoria['Categoria']['id']).'</h2>';

                                if(count($categoria['Subcategoria']) > 0){
                                        echo '<ul >';
                                        $count = 0;
                                        foreach ($categoria['Subcategoria'] as $sub){
                                                if($count == 0) $borda = ' style="border-top: none;" ';
                                                else $borda = ' ';

                                                //verifica se aparecerá um ícone para mostrar que tem um sub-menu
                                                if(!empty($subcategorias[$sub['id']]['Modelo']))
                                                    $tem_submenu = $this->Html->image('menu_indicador.png', array('style' => 'float:right;'));
                                                else
                                                    $tem_submenu = '';

                                                echo '<li id="menu_'.$sub['id'].'" '.$borda.'  >'.$html->link($sub['nome'].$tem_submenu, '/'.$name_side_bar.'/filtro?busca_flag=flag&subcategoria_id='.$sub['id'], array('escape' => false, 'onmouseover' => 'exibe_submenu(\'sub_menu_'.$sub['id'].'\')')).' </li>';
                                                if($name_side_bar == 'produtos')

                                                    if(!empty($subcategorias[$sub['id']]['Modelo'])){
                                                        echo '<ul style="margin-left: 0px;padding-left: 12px;background: #FFF8AD;width: 154px;display:none " id="sub_menu_'.$sub['id'].'">';

                                                        foreach ($subcategorias[$sub['id']]['Modelo'] as $mod){
                                                            echo '<li style="">'.$html->link($mod['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&modelo_id='.$mod['id']).'</li>';
                                                        }
                                                        echo '</ul>';
                                                    }
                                                $count++;
                                        }
                                        echo '</ul>';
                                }
                        }
			?>	
                    
		
	<?php endif; ?>
                        
<?php else: ?>
                        
        <?php
        //formulário para busca rápida
        if(false):
			echo $this->Form->create($model_busca, array('type' => 'get', 'enctype' => 'multipart/form-data', 'url' => array('controller' => $name_side_bar, 'action' =>'filtro')));
			echo $form->hidden('busca_flag', array('value' => 'flag'));
			?>

			   <?php echo $this->Form->input('busca', array('style' => 'padding: 8px 10px;border-radius: 6px;border: none;border-top: 1px solid #B9BBAF;border-left: 1px solid #B9BBAF;', 'label' => false)); ?>
			   <?php echo '<button type="submit" class="button2 large2 yellow2" style="float:right;width: 100%;">Buscar</button>'; ?>&nbsp;

			<?php echo '</form>'; ?>
        <?php endif; ?>
        
        <?php
        foreach ($side_bar as $categoria){
                //exibe nome da categoria
                echo '<h2 class="h2_side_bar">'.$html->link($categoria['Categoria']['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&categoria_id='.$categoria['Categoria']['id']).'</h2>';

                if(count($categoria['Subcategoria']) > 0){
                        echo '<ul >';
                        $count = 0;
                        foreach ($categoria['Subcategoria'] as $sub){
                                if($count == 0) $borda = ' style="border-top: none;" ';
                                else $borda = ' ';
                                
                                //verifica se aparecerá um ícone para mostrar que tem um sub-menu
                                if(!empty($subcategorias[$sub['id']]['Modelo']))
                                    $tem_submenu = $this->Html->image('menu_indicador.png', array('style' => 'float:right;'));
                                else
                                    $tem_submenu = '';
                                
                                echo '<li id="menu_'.$sub['id'].'" '.$borda.'  >'.$html->link($sub['nome'].$tem_submenu, '/'.$name_side_bar.'/filtro?busca_flag=flag&subcategoria_id='.$sub['id'], array('escape' => false, 'onmouseover' => 'exibe_submenu(\'sub_menu_'.$sub['id'].'\')')).' </li>';
                                if($name_side_bar == 'produtos')
                                    
                                    if(!empty($subcategorias[$sub['id']]['Modelo'])){
                                        echo '<ul style="margin-left: 0px;padding-left: 12px;background: #FFF8AD;width: 154px;display:none " id="sub_menu_'.$sub['id'].'">';

                                        foreach ($subcategorias[$sub['id']]['Modelo'] as $mod){
                                            echo '<li style="">'.$html->link($mod['nome'], '/'.$name_side_bar.'/filtro?busca_flag=flag&modelo_id='.$mod['id']).'</li>';
                                        }
                                        echo '</ul>';
                                    }
                                $count++;
                        }
                        echo '</ul>';
                }
        }
        ?>	
		
<?php endif; ?>
