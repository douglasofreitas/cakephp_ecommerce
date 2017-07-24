Informe a quantidade de produtos pada cada Cor e Tamanho cadastrado anteriormente. Abaixo há todas as possívels combinações, deixe em branco caso não tenha na combinação sugerida.<br/>
<br/>
<strong>Produto:</strong> <?php echo $this->data['Produto']['nome']; ?><br/>
<br/>

<?php echo $this->Form->create('Produto', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'produtos', 'action' =>'add_quantidade/'.$this->data['Produto']['id']), 'class' => 'formulario', 'id' => 'formvalidade'));?>

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
;
                echo '<td>'.$this->Form->input('Produto.'.$tamanho['id'], array('style' => 'width:50px', 'label' => false)).'</td>';
                echo '</tr>';
                
            }else{
                foreach($this->data['Cor'] as $cor){
                    echo '<tr>';
                    echo '<td>'.$tamanho['nome'].'</td>';

                    echo '<td>'.$cor['nome'].'</td>';

                    echo '<td>'.$this->Form->input('Produto.'.$tamanho['id'].'.'.$cor['id'], array('style' => 'width:50px', 'label' => false)).'</td>';
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
