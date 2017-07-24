Número de itens: 
<?php
if(empty($pedido['Itempedido']))
	echo '0';
else 
	echo count($pedido['Itempedido']); 
?><br />
<br>

<script type="text/javascript">

	$(function() {
		<?php foreach ($pedido['Itempedido'] as $item): ?>
				
			$('#LinkAlteraQuantidade<?php echo $item['produto_id'] ?>').click (function() {
				$('#AlteraQuantidade<?php echo $item['produto_id'] ?>').submit();
                                return false;
			});
		
		<?php endforeach; ?>
	});

</script>

<table class="listagem" width="100%">
	<tr class="listagem_header">
			<td class="header_table" style="width:auto; text-align:left;" >Produto</td>
			<td class="header_table" style="width:120px; text-align:center;" >Quantidade</td>
			<td class="header_table" style="width:118px; text-align:center;" >Valor Unitário</td>
			<td class="header_table" style="width:126px; text-align:center;" >Valor Total</td>
	</tr>
	<?php
	
	if(empty($pedido['Itempedido']))
		echo '<tr><td colspan="4" style="text-align: center;padding-top: 15px;">Não há itens no carrinho</td></tr>';
	else
	if(count($pedido['Itempedido']) > 0){
	
		$i = 0;
		$subtotal = 0.0;
		foreach ($pedido['Itempedido'] as $item){
			$class = null;
			
			$subtotal += $item['valor_total'];
			
			if ($i++ % 2 == 0) {
				$class = ' class="linha_impar" style="background-color: #fffef7" ';
			}else{
				$class = ' class="linha_par" style="background-color: #ffffd6" ';
			}
			?>
                        <tr <?php echo $class;?>>
				<td style="text-align:center;">
					
					<table width="100%">
						<tr>
							<td style="width: 112px;">
								<span style="float:left">
									<?php 
                                                                        if(empty($produtos[$item['produto_id']]['Produto']['img_mini']))
                                                                            echo $this->Html->image('/img/sem_foto.png', array("alt" => "[Imagem]".$produtos[$item['produto_id']]['Produto']['nome'], 'style' => 'max-width:100px'));
                                                                        else
                                                                            echo $this->Html->image('/fotos/'.$produtos[$item['produto_id']]['Produto']['img_mini'], array("alt" => "[Imagem]".$produtos[$item['produto_id']]['Produto']['nome'], 'style' => 'max-width:100px'));
                                                                        ?>
								</span>
							</td>
							<td align="center" valign="center" width="auto" >
								<?php 
								$modelo = '';
								if(!empty($item['produtoquantidade_id'])){

                                                                    //obter a cor e o tamanho do item do pedido, por enquanto esta longo
                                                                    $cor_id = null;
                                                                    $cor_nome = null;
                                                                    $tamanho_id = null;
                                                                    $tamanho_nome = null;

                                                                    foreach($produtos[$item['produto_id']]['ProdutoQuantidade'] as $prod_quant){
                                                                        if($prod_quant['id'] == $item['produtoquantidade_id']){
                                                                            $cor_id = $prod_quant['cor_id'];
                                                                            $tamanho_id = $prod_quant['tamanho_id'];
                                                                        }
                                                                    }
                                                                    if(!empty($cor_id)){
                                                                        foreach($produtos[$item['produto_id']]['Cor'] as $cor){
                                                                            if($cor_id == $cor['id']){
                                                                                $cor_nome = $cor['nome'];
                                                                            }
                                                                        }
                                                                        foreach($produtos[$item['produto_id']]['Tamanho'] as $tamanho){
                                                                            if($tamanho_id == $tamanho['id']){
                                                                                $tamanho_nome = $tamanho['nome'];
                                                                            }
                                                                        }
                                                                    }
                                                                    if(!empty($cor_nome)){
                                                                        
                                                                        $modelo = '<br/>Cor: '.$cor_nome.' <br/>Tamanho: '.$tamanho_nome.'';
                                                                    }

                                                                }
								echo $this->Html->link(
                                                                    $produtos[$item['produto_id']]['Produto']['nome'],
                                                                    '/produtos/view/'.$item['produto_id']); 
                                                                echo $modelo;
								?>
								
							</td>
						</tr>
					</table>
					
				</td>
				<td style="text-align:center">
					<?php
					//criar formulário para mudança de quantidade do produto
					echo $this->Form->create('Itempedido', array('id' => 'AlteraQuantidade'.$item['produto_id'] , 'url' => array('controller' => 'itempedidos', 'action' =>'alterar_quantidade')));
					echo $this->Form->hidden('produto_id', array( 'value' => $item['produto_id']));
                                        echo $this->Form->hidden('id', array( 'value' => $item['id']));
                                        echo $this->Form->hidden('produtoquantidade_id', array( 'value' => $item['produtoquantidade_id']));
					echo $this->Form->input('quantidade', array('style' => 'width:30px', 'value' => $item['quantidade'], 'label' => false));
					//echo '<br>';
					echo $this->Html->link(
							'Alterar quantidade',
							'#',
							array('id' => 'LinkAlteraQuantidade'.$item['produto_id'], 'style' => 'font-size: 10px;width: 100%;')
					);  
					?><br/><br/>
					<?php 
					echo $this->Html->link(
							$this->Html->image('icon/cross.png', array('class' => 'tipHoverTop', 'title' => 'Remover Item')),
							'/itempedidos/delete/'.$item['produto_id'],
							array('escape' => false,'style' => 'font-size: 10px;text-align:center;width: 100%;')
					);
					echo '</form>';  
					?>
					
				</td>
				
				<td style="text-align:center">
					<?php echo 'R$ '.$item['valor_unitario_form']; ?>
				</td>
				<td style="text-align:center">
					<?php echo 'R$ '.$item['valor_total_form']; ?>
				</td>
			</tr>
			<?php 
		}
		//inserir linha de subtotal
		$subtotal_form = number_format($subtotal,2, ',', '.');
		
                
                //VERIFICA SE PODE CALCULAR O FRETE
                if($config_sistema['Configuracao']['calcula_frete']):
		?>
		<tr style="background-color: #FFD781">
			<td colspan="3" align="right">
				<strong>Subtotal:</strong>
			</td>
			<td style="text-align:center" >
				<strong>R$ <?php echo $subtotal_form ?> </strong>
				
			</td>
		</tr>
		<tr style="background-color: #FFF0CF" >
                        <td colspan="3" > 
				<?php 
				
                                

                                //fornecer formulário para calculo de frete
                                echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'calcular_frete'), 'style' => 'float: left'));
                                echo '<label style="float:left" for="PedidoCep">Insira o CEP</label>';
                                echo $this->Form->input('cep', array('style' => 'margin-left: 8px;width:100px;', 'value' => $pedido['Pedido']['cep'], 'label' => false, 'div' => false));
                                if(!empty($pedido['Pedido']['tipo_correio'])){
                                    if($pedido['Pedido']['tipo_correio'] == '41106' ){
                                        echo '<input type="radio" name="data[Pedido][tipo_correio]" checked="checked" value="41106"/>PAC&nbsp;&nbsp;&nbsp; ';
                                        echo '<input type="radio" name="data[Pedido][tipo_correio]" value="40010"/>SEDEX&nbsp;&nbsp;&nbsp;';   
										echo '<input type="radio" name="data[Pedido][tipo_correio]" value="40215"/>SEDEX 10';   
                                    }
									elseif($pedido['Pedido']['tipo_correio'] == '40215' ){
										echo '<input type="radio" name="data[Pedido][tipo_correio]" value="41106"/>PAC&nbsp;&nbsp;&nbsp; ';
                                        echo '<input type="radio" name="data[Pedido][tipo_correio]" value="40010"/>SEDEX&nbsp;&nbsp;&nbsp;';   
										echo '<input type="radio" name="data[Pedido][tipo_correio]" checked="checked" value="40215"/>SEDEX 10';   
									}
                                    else{
                                        echo '<input type="radio" name="data[Pedido][tipo_correio]" value="41106"/>PAC&nbsp;&nbsp;&nbsp; ';
                                        echo '<input type="radio" name="data[Pedido][tipo_correio]" checked="checked" value="40010"/>SEDEX&nbsp;&nbsp;&nbsp;';   
										echo '<input type="radio" name="data[Pedido][tipo_correio]" value="40215"/>SEDEX 10';   
                                    }
                                }else{
                                    echo '<input type="radio" name="data[Pedido][tipo_correio]" value="41106"/>PAC&nbsp;&nbsp;&nbsp; ';
                                    echo '<input type="radio" name="data[Pedido][tipo_correio]" checked="checked" value="40010"/>SEDEX&nbsp;&nbsp;&nbsp;';   
									echo '<input type="radio" name="data[Pedido][tipo_correio]" value="40215"/>SEDEX 10';   
                                }
                                //echo $this->Form->end(__('Calcular Frete', true));					
                                
				
				?>
                                
                                <button type="submit" class="button2 small2 orange2">Calcular Frete</button>
                                </form>
                                <span style="float:right"><strong>Frete:</strong></span>
                                <?php 
                                
                                if($login_group_id == 1){
                                    echo '<br/>';
                                    echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'salvar_frete'), 'style' => 'float: left'));
                                    echo '<label style="float:left" for="PedidoCep">ou Digite o valor do frete</label>';
                                    echo $this->Form->input('valor_frete_form', array('style' => 'margin-left: 8px;width:50px;', 'value' => $pedido['Pedido']['frete_form'], 'label' => false, 'div' => false));
                                    echo '<input type="submit" value="Salvar frete" class="btn" />';
                                    echo '</form>'; 
                                }
                                
                                ?>
                                
                                
                                
				
			</td>
			<td style="text-align:center;vertical-align: top;" >
				<?php if(empty($pedido['Pedido']['frete'])): ?>
					<strong> 
                                        <?php 
                                        if($login_group_id == 1){
                                            echo 'R$ 0,00';
                                        }
                                        ?>
                                        </strong>
				<?php else: ?>
					<strong>R$ <?php echo $pedido['Pedido']['frete_form'] ?> </strong>
				<?php endif; ?>
			</td>
		</tr>
                
                <?php
                //VERIFICA SE PODE CALCULAR O FRETE - Fim
                endif;
                ?>
		
                <tr style="background-color: #FFD781">
			<td colspan="3">
                            
                            <?php if(!empty($_SESSION['Frete']['prazo_entrega'])) : ?>
                            <span style="text-align: left;float:left;color: #004DF1;">
                                <strong>Prazo de entrega: 
                                <?php
                                if($_SESSION['Frete']['prazo_entrega'] == 1)
                                    echo $_SESSION['Frete']['prazo_entrega'].' dia';
                                else
                                    echo $_SESSION['Frete']['prazo_entrega'].' dias';
                                ?>
                                </strong>
                            </span>
                            <?php endif; ?>
                            
                            <span style="text-align: right;float:right"><strong>TOTAL:</strong></span>
			</td>
			<td style="text-align:center" >
				<strong>
					<?php 
					if(empty($pedido['Pedido']['frete'])){
						$total = $subtotal;
					}else{
						$total = $subtotal + $pedido['Pedido']['frete'];
						
					}
					$total_form = 'R$ '.number_format($total, 2, ',', '.');
					
					echo $total_form;
					
					?> 
				</strong>
				
			</td>
		</tr>
		<?php

	}else{
		echo '<tr><td colspan="4" style="text-align: center;padding-top: 15px;">Não há itens no carrinho</td></tr>';
	}
	?>
	
</table>
<br />

<?php
echo $this->Form->create('Produto', array('url' => array('controller' => 'produtos', 'action' =>'index'), 'class' => 'formulario', 'style' => 'float: left;'));
echo '<button type="submit" class="button2 large2 orange2">Escolher mais produtos</button></form>';	
?>

<span style="float: right">
<?php 
echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'obter_endereco'), 'class' => 'formulario'));
echo '<button type="submit" class="button2 large2 orange2">Comprar</button></form>';	
?>
</span>

<br /><br /><br />