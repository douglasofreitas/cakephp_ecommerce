Informe a quantidade de produtos pada cada Cor e Tamanho cadastrado anteriormente. Abaixo há todas as possívels combinações, deixe em branco caso não tenha na combinação sugerida.<br/>
<br/>
<strong>Produto:</strong> 
<?php 

echo $this->Html->link(
    $this->data['Produto']['nome'],
    '/produtos/view_admin/'.$this->data['Produto']['id']
);
?><br/>
<br/>

<?php
function getQuantidade($produto, $tamanho_id, $cor_id = null){
    if(!empty($produto['ProdutoQuantidade'])){
        foreach($produto['ProdutoQuantidade'] as $pq){
            if($pq['tamanho_id'] == $tamanho_id){
                if(!empty($cor_id)){
                    //considerar cor
                    if($pq['cor_id'] == $cor_id){
                        return $pq['quantidade'];
                    }
                }else{
                    return $pq['quantidade'];
                }
            }
        }
    }
    return 0;
}
?>

<?php echo $this->Form->create('Produto', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'produtos', 'action' =>'edit_quantidade/'.$this->data['Produto']['id']), 'class' => 'formulario', 'id' => 'formvalidade'));?>

<table class="tabela_detalhe">
    <tr >
        <td class="destaque">Tamanho</td>
        <?php 
        if(!empty($this->data['Cor'])){
            echo '<td class="destaque">Cor</td>';
        }
        ?>
        <td class="destaque">Quantidade</td>
    </tr>
    
    <?php foreach($this->data['Tamanho'] as $tamanho): ?>
            <?php 
            if(empty($this->data['Cor'])){
                echo '<tr>';
                echo '<td>'.$tamanho['nome'].'</td>';
                echo '<td>'.$this->Form->input('Produto.'.$tamanho['id'], array('style' => 'width:50px', 'label' => false, 'value' => getQuantidade($this->data, $tamanho['id']) )).'</td>';
                echo '</tr>';
                
            }else{
                foreach($this->data['Cor'] as $cor){
                    echo '<tr>';
                    echo '<td>'.$tamanho['nome'].'</td>';
                    echo '<td>'.$cor['nome'].'</td>';
                    echo '<td>'.$this->Form->input('Produto.'.$tamanho['id'].'.'.$cor['id'], array('style' => 'width:50px', 'label' => false, 'value' => getQuantidade($this->data, $tamanho['id'], $cor['id']) )).'</td>';
                    echo '</tr>';
                }
            }
            ?>
    <?php endforeach; ?>
    
</table>

<?php


echo '<br/>';
echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>
