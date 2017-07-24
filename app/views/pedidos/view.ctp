<table style="width: 100%;" class="tabela_detalhe">
    <tr>
        <td style="width: 129px;" class="destaque">
            Código do pedido
        </td>
        <td colspan="3">
            <?php echo $pedido['Pedido']['id'] ?>
            
            <span style="float: right;display: block;width: 344px;font-weight: bold;color: #FF5C00;">
                Entre em contato conosco para solucionarmos
                qualquer dúvida sobre seu pedido
            </span>
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
        <td colspan="3">
            <?php echo $pedido['Statuspedido']['nome'] ?>
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
            echo $pedido['Pedido']['rastreio_correio'];
            ?>

            <a style="margin-left:20px" href="http://www2.correios.com.br/sistemas/rastreamento/default.cfm" target="_blank">Acompanhe o pedido</a>
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
                    foreach($itenspedido as $item){

                            $class = null;
                            if ($i++ % 2 == 0) {
                                    $class = ' class="linha_impar"';
                            }else{
                                    $class = ' class="linha_par"';
                            }

                            $modelo = '';
                            if(!empty($item['Itempedido']['produtoquantidade_id'])){

                                //obter a cor e o tamanho do item do pedido, por enquanto esta longo
                                $cor_id = null;
                                $cor_nome = null;
                                $tamanho_id = null;
                                $tamanho_nome = null;

                                foreach($produtos[$item['Itempedido']['produto_id']]['ProdutoQuantidade'] as $prod_quant){
                                    if($prod_quant['id'] == $item['Itempedido']['produtoquantidade_id']){
                                        $cor_id = $prod_quant['cor_id'];
                                        $tamanho_id = $prod_quant['tamanho_id'];
                                    }
                                }
                                if(!empty($cor_id)){
                                    foreach($produtos[$item['Itempedido']['produto_id']]['Cor'] as $cor){
                                        if($cor_id == $cor['id']){
                                            $cor_nome = $cor['nome'];
                                        }
                                    }
                                    foreach($produtos[$item['Itempedido']['produto_id']]['Tamanho'] as $tamanho){
                                        if($tamanho_id == $tamanho['id']){
                                            $tamanho_nome = $tamanho['nome'];
                                        }
                                    }
                                }
                                if(!empty($cor_nome)){
                                    $modelo = '<br/>Cor: '.$cor_nome.'<br/>Tamanho: '.$tamanho_nome.'';
                                }

                            }

                            echo '<tr '.$class.' ><td>';
                            echo $this->Html->link(
                                    $item['Produto']['nome'],
                                    '/produtos/view/'.$item['Produto']['id'].'/oculto',
                                    array('escape' => false, 'target' => '_blank'));  
                            echo ' '.$modelo;
                            echo '</td><td align="center">';
                            echo $item['Itempedido']['quantidade'];
                            echo '</td><td>R$ ';
                            echo number_format($item['Itempedido']['valor_total'], 2, ',', '.');
                            echo '</td></tr>';

                            $valor_total += $item['Itempedido']['valor_total']; 
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
