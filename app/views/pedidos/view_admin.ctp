
<ul>
    <?php
    echo $this->Html->link(
        $this->Html->image('icon/doc_pdf.png', array('class' => 'tipHoverBottom', 'title' => 'Imprimir pedido')),
        '/pedidos/imprimi_pedido/'.$pedido['Pedido']['id'],
        array('escape' => false)
    );
    ?>
</ul>

<table style="width: 100%;" class="tabela_detalhe">
    <tr>
        <td style="width: 129px;" class="destaque">
            Código do pedido
        </td>
        <td colspan="3">
            <?php echo $pedido['Pedido']['id'] ?>
        </td>
    </tr>
    <tr>
        <td  class="destaque">
            Cliente
        </td>
        <td colspan="3">
            <?php 
            echo $this->Html->link(
                    $pedido['User']['name'],
                    '/users/view/'.$pedido['User']['id'],
                    array('target' => '_blank')); 
            ?>
        </td>
    </tr>
    
    <tr>
        <td class="destaque">
            Data do pedido
        </td>
        <td colspan="3">
            <?php echo date('d/m/Y H:i:s', strtotime($pedido['Pedido']['created'])); ?>
        </td>
    </tr>
    
    <tr>
        <td class="destaque">
            Status
        </td>
        <td>
            <?php echo $pedido['Statuspedido']['nome'] ?>
        </td>
        <td class="destaque">
            Mudar status
        </td>
        <td>
            <?php 
            if($pedido['Statuspedido']['id'] != 4){

                //exibe opções para o pedido.

                echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'mudar_status_pedido/'.$pedido['Pedido']['id']), 'class' => 'formulario'));
                echo $this->Form->select('statuspedido_id', $select_statuspedido, $pedido['Statuspedido']['id'],  array('empty' => false));	
                //echo '<input type="submit" value="Salvar" style="float:right" ></form>';
                echo '<button style="float:center" class="button2 small2 orange2" type="submit" id="botao_adicionar_produto">Salvar</button>';
                echo '</form>';

                /*
                echo $this->Html->link(
                    $this->Html->image("icon/cross.png", array("alt" => "Remover",'class' => 'tipHoverTop', 'title' => 'Cancelar pedido')),
                    '/pedidos/mudar_status_pedido/'.$pedido['Pedido']['id'].'/4',
                    array('escape' => false),
                    'Tem certeza que deseja cancelar este pedido?'
                );
                 */
            }
            ?>
        </td>
    </tr>
    
    <?php
    //verifica se tem fatura no pedido
    if(!empty($fatura)){
    ?>
    
    <tr>
        <td class="destaque">
            Pagamento
        </td>
        <td>
            <?php echo $fatura['Statusfatura']['nome'] ?>
        </td>
        <td class="destaque">
            Mudar status
        </td>
        <td>
            <?php 
            //selecionar fatura
            //$fatura = $pedido['Fatura'][0];
            if($pedido['Statuspedido']['id'] != 4){
                echo $this->Form->create('Fatura', array('url' => array('controller' => 'faturas', 'action' =>'mudar_status_fatura/'.$fatura['Fatura']['id']), 'class' => 'formulario'));
                echo $this->Form->select('statusfatura_id', $select_statusfatura, $fatura['Fatura']['statusfatura_id'],  array('empty' => false));	
                echo '<button style="float:center" class="button2 small2 orange2" type="submit" id="botao_adicionar_produto">Salvar</button>';
                echo '</form>';

            }

            //CIELO
            if(false){
                if($fatura['Statusfatura']['id'] == 9){
                        //para fatura cancelada não mostra opções
                }elseif($fatura['Statusfatura']['id'] == 4){
                        echo $this->Html->image('icon/money_dollar.png', 
                                array('alt' => 'Capturar dinheiro', 
                                        'url' => '/pedidos/capturar_fatura/'.$pedido['Pedido']['id'], 'class' => 'tipHoverBottom', 'title' => 'Capturar dinheiro')
                        );
                }elseif($fatura['Statusfatura']['id'] == 6){
                        //para capturado não exibe nada
                }else{
                        echo $this->Html->image('icon/find.png', 
                                array('alt' => 'Verificar status do pagamento', 
                                        'url' => '/pedidos/consultar_pedido/'.$pedido['Pedido']['id'], 'class' => 'tipHoverBottom', 'title' => 'Verificar status do pagamento')
                        );
                }
            }
            ?>
        </td>
    </tr>
    
    <?php
    }
    ?>
    
    <tr>
        <td class="destaque">
            Código de rastreio
        </td>
        <td colspan="3">
            <?php
            echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' =>'rastreio_correio'), 'class' => 'formulario'));
            echo $this->Form->hidden('pedido_id', array('value' => $pedido['Pedido']['id']));	
            echo $this->Form->input('rastreio_correio', array('label' => false, 'style' => 'width:200px', 'value' => $pedido['Pedido']['rastreio_correio']));	
            echo '<button style="float:center" class="button2 small2 orange2" type="submit" id="botao_adicionar_produto">Salvar</button>';
            echo '</form>';

            if(!empty($pedido['Pedido']['rastreio_correio'])){
                echo $this->Html->link(
                    'Enviar e-mail para cliente',
                    '/pedidos/email_rastreio_correio/'.$pedido['Pedido']['id'],
                    array('class' => 'tipHoverRight', 'title' => 'Envia e-mail para o cliente com o código de rastreio')); 
            }

            ?>
        </td>
    </tr>
    
    <tr>
        <td class="destaque">
            Endereço
        </td>
        <td colspan="3">
            <table>
                <tr>
                    <td><strong>Destinatário</strong></td>
                    <td colspan="3"><?php echo $pedido['Pedido']['nome']; ?></td>
                </tr>
                <tr>
                    <td><strong>Endereço</strong></td>
                    <td colspan="3">
                        <?php echo $pedido['Pedido']['endereco']; ?> &nbsp;&nbsp;&nbsp;
                        <strong>Número</strong> <?php echo $pedido['Pedido']['numero']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        <strong>Complemento</strong> <?php echo $pedido['Pedido']['complemento']; ?> <br>
                    </td>
                </tr>
                <tr>
                    <td><strong>CEP</strong></td>
                    <td><?php echo $pedido['Pedido']['cep']; ?></td>
                    <td><strong>Bairro</strong></td>
                    <td><?php echo $pedido['Pedido']['bairro']; ?></td>
                </tr>
                <tr>
                    <td><strong>Cidade</strong></td>
                    <td colspan="3"><?php echo $pedido['Cidade']['nome'].' - '.$estado['Estado']['nome']; ?> </td>
                </tr>
            </table>
        </td>
    </tr>
    
    
    
    <tr>
        <td class="destaque">
            Estoque
        </td>
        <td colspan="3">
            <?php
            if($pedido['Pedido']['baixa_estoque'] == 1){
                echo '<strong>com</strong> baixa no estoque';
            }else{
                echo '<strong>sem</strong> baixa no estoque';
            }
            ?>
        </td>
    </tr>

    <tr>
        <td class="destaque">
            E-mail para depoimento
        </td>
        <td colspan="3">
            <?php
            if($pedido['Pedido']['email_avaliacao'] == 1){
                echo '<strong>E-mail enviado</strong>';
            }else{
                $link_enviar_email = $this->Html->link(
                    'Enviar',
                    '/pedidos/enviar_email_avaliacao/'.$pedido['Pedido']['id'],
                    array('target' => '_blank'));

                echo '<strong>E-mail não enviado</strong> ('.$link_enviar_email .')';
            }
            ?>
        </td>
    </tr>




    <tr>
        <td class="destaque">
            Itens 
        </td>
        <td colspan="3">
            <table class="" >
                    <tr class="">
                            <td class="header_table_simple" style="min-width: 100px">Produto</td>
                            <td class="header_table_simple" align="center">Quantidade</td>
                            <td class="header_table_simple" align="center">Valor</td>
                    </tr>

                    <?php
                    $valor_total = $pedido['Pedido']['frete'];
                    $i = 0;
                    foreach($pedido['Itempedido'] as $item){

                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="linha_impar"';
                            }else{
                                    $class = ' class="linha_par"';
                            }

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



                            echo '<tr '.$class.' ><td>';
                            echo $this->Html->link(
                                    $produtos[$item['produto_id']]['Produto']['nome'],
                                    '/produtos/view/'.$produtos[$item['produto_id']]['Produto']['id'],
                                    array('target' => '_blank', 'escape'=> false));  
                            echo ' '.$modelo;
                            echo '</td><td align="center">';
                            echo $item['quantidade'];
                            echo '</td><td>R$ ';
                            echo number_format($item['valor_total'], 2, ',', '.');
                            echo '</td></tr>';

                            $valor_total += $item['valor_total']; 
                    }
                    ?>
            </table>
        </td>
    </tr>
    <tr>
        <td class="destaque">
            Frete
            <?php
            if(!empty($pedido['Pedido']['tipo_correio']))
                echo ' ('.$tipo_correio.')';
            ?>
        </td>
        <td colspan="3">
            R$ <?php echo number_format($pedido['Pedido']['frete'],2, ',', '.'); ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
            Total
        </td>
        <td colspan="3">
            <strong>R$ <?php echo number_format($valor_total,2, ',', '.') ?></strong>
        </td>
    </tr>
</table>

<br/>
<h2>Histórico</h2>

<?php
if(count($pedido['Pedidohistorico'])){
    echo $pedidopack->exibe_historico($pedido);
}else{
    echo 'Sem histórico';
}
?>