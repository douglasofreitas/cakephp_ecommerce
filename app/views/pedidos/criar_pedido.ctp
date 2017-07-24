Cliente: <?php echo $user['User']['name']; ?><br/>
<br/>
Itens atuais do pedido


Selecione os produtos abaixo que deseja incluir no pedido<br/>
<br/>

<?php 
if(count($produtos)>0){
    ?>
    <table class="listagem">
        <tr>
            <td class="header_table">Código</td>
            <td class="header_table">Nome</td>
            <td class="header_table">Valor</td>
            <td class="header_table">Ação</td>
        </tr>
        
        <?php
        $i = 0;
        foreach($produtos as $produto){
            $class = null;
            if ($i++ % 2 == 0) {
                    $class = ' class="linha_impar"';
            }else{
                    $class = ' class="linha_par"';
            }
            echo '<tr '.$class.'>';
            
            //valor do produto
            $valor = $produto['Produto']['valor_form'];
            if($produto['Produto']['promocao'] == 1){
                $valor = number_format($produto['Produto']['valor']*(100-$produto['Produto']['desconto'])/100, 2, ',', '.');
            }
            
            echo '<td>'.$produto['Produto']['id'].'</td>';
            echo '<td>'.$produto['Produto']['nome'].'</td>';
            echo '<td>'.$valor.'</td>';
            
            echo '<td>';
            echo $this->Html->link(
                $this->Html->image('icon/add.png', array('class' => 'tipHoverBottom', 'title' => 'Adicionar produto no pedido')),
                '/produtos/view_avulso/'.$produto['Produto']['id'],
                array('escape' => false, 'style' => 'float:right')
            );  
            echo '</td>';
            
            echo '</tr>';
        }
        ?>
        
    </table>
    <?php
}else{
    echo 'Sem produtos cadastrados no sistema.';
}
?>