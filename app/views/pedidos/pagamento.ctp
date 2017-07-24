<table>
	<tr>
            <td valign="top" width="350px" style="padding-right: 15px;">
			<?php //echo 'Código do pedido: '.$pedido['Pedido']['id'] ?>
                        <table class="listagem" style="width: 100%;" >
				<tr class="listagem_header">
					<td class="header_table"  style="width: 200px">Produto</td>
					<td class="header_table"  align="center">Quant.</td>
                                        <td class="header_table"  align="center">Valor</td>
				</tr>
			
				<?php
                                
                                //echo '<pre>';
                                //print_r($pedido);
                                //echo '</pre>';
                                
				$valor_total = $pedido['Pedido']['frete'];
				$i = 0;
				foreach($pedido['Itempedido'] as $item){
					
                                    $class = null;
                                    if ($i++ % 2 == 0) {
                                            $class = ' class="linha_impar"';
                                    }else{
                                            $class = ' class="linha_par"';
                                    }

                                    echo '<tr '.$class.' ><td>';
                                    echo '<strong>'.$produtos[$item['produto_id']]['Produto']['nome'].'</strong>';
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
                                            echo '<br/>Cor: '.$cor_nome.' <br/>Tamanho: '.$tamanho_nome.'';
                                            
                                        }
                                        
                                    }
                                    echo '</td><td style="text-align: center;">';
                                    echo $item['quantidade'];
                                    echo '</td><td>R$ ';
                                    echo $item['valor_total_form'];
                                    echo '</td></tr>';
                                    $valor_total += $item['valor_total']; 
				}
				?>
			</table>
			<br>
                        <table class="listagem" style="background: white;">
				<tr >
					<td width="100px">Frete</td>
					<td>R$ <?php echo number_format($pedido['Pedido']['frete'], 2, ',', '') ?></td>
				</tr>
				<tr >
					<td>Valor Total</td>
					<td><strong>R$ <?php echo number_format($valor_total,2, ',', '.') ?></strong></td>
				</tr>
                                
                                <?php if(!empty($_SESSION['Frete']['prazo_entrega'])) : ?>
                                <tr >
                                        <td colspan="2">&nbsp;</td>
				</tr>
                                <tr >
					<td>Prazo de entrega</td>
					<td>
                                            <strong>
                                                <?php
                                                if($_SESSION['Frete']['prazo_entrega'] == 1)
                                                    echo $_SESSION['Frete']['prazo_entrega'].' dia útil';
                                                else
                                                    echo $_SESSION['Frete']['prazo_entrega'].' dias úteis';
                                                ?>
                                            </strong>
                                        </td>
				</tr>
                                <?php endif; ?>
			</table>
                        <br/><br/>
                        <?php 
                        echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'obter_endereco'), 'class' => 'formulario'));
                        //echo '<button type="submit" class="button2 large2 orange2">Voltar</button></form>';	
                        echo '</form>';
                        ?>
                        
                        <?php
                        if($login_group_id == 1){
                            //mostra as opções para o admin para associar um usuário e definir
                            //o status do pedido e da fatura.
                            if(!empty($cliente) & $cliente['User']['id'] != $user_id){
                                echo 'Clinete: '.$pedido['User']['name'];
                            }else{
                                echo $html->link('Associar cliente', '/users/associar_cliente_pedido');
                            }
                            
                            echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'concluir_pedido'), 'class' => 'formulario'));
                            
                            ?>
                            <br/><br/>
                            Status do pedido:<br/>
                            <?php
                            echo $this->Form->select('statuspedido_id', $select_statuspedido, 1,  array('empty' => false));	
                            ?>
                            <br/><br/>
                            Status da fatura:<br/>
                            
                            <?php       
                            echo $this->Form->select('statusfatura_id', $select_statusfatura, 7,  array('empty' => false));	
                            echo '<br/><br/>';
                            echo '<button style="float:center" class="button2 large2 orange2" type="submit" id="botao_adicionar_produto">Concluir pedido</button>';
                            echo '</form>';
                        }else{
                            //PAGSEGURO
                            if(true){
                                echo 'Clique no botão abaixo para realizar o pagamento e concluir o pedido<br><br>';
                                echo $this->Form->create('PagSeguro', array('url' => array('controller' => 'pedidos', 'action' =>'fazer_pagamento'), 'class' => 'formulario'));
                                echo '<button type="submit" class="button2 large2 orange2">Pagar no PagSeguro</button></form>';
                            }
                            //CIELO
                            if(false){

                                echo 'Preencha o formulário abaixo para realizar o pagamento<br><br>';
                                echo $this->Form->create('Cielo', array('url' => array('controller' => 'pedidos', 'action' =>'fazer_pagamento'), 'class' => 'formulario'));
                                echo '<strong>Forma de pagamento</strong>';
                                echo '<br><br>';
                                echo $this->Form->select('codigoBandeira', $select_bandeiras, null,  array('empty' => false));
                                echo '<br><br>';
                                foreach($select_formaspagamento as $id_forma => $nome_forma){
                                        echo '<input type="radio" checked="checked" name="data[Cielo][formaPagamento]" value="'.$id_forma.'" />';
                                        echo $nome_forma.'<br>';
                                }
                                echo '<br><br>';
                                echo '<button type="submit" class="button2 large2 orange2">Pagar na CIELO</button></form>';
                            }
                        }
			?>
		</td>
		<td valign="top">
			
			
                    
                    
                        <strong>Endereço de entrega:</strong><br/><br/>
                        <div style="border: 1px solid #999;padding: 12px;">
                            
                            <strong>Destinatário:</strong> <?php echo $pedido['Pedido']['nome']; ?><br/><br/>
                            <strong>Endereço:</strong> <?php echo $pedido['Pedido']['endereco']; ?> <br/><strong>Número:</strong> <?php echo $pedido['Pedido']['numero']; ?> <br/> <strong>Complemento:</strong> <?php echo $pedido['Pedido']['complemento']; ?> <br/><br/>
                            <strong>CEP:</strong> <?php echo $pedido['Pedido']['cep']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Bairro:</strong> <?php echo $pedido['Pedido']['bairro']; ?> <br/><br/>
                            <strong>Cidade:</strong> <?php echo $cidade_form; ?> <br>
                        </div>
                    
		</td>
	</tr>
</table>

