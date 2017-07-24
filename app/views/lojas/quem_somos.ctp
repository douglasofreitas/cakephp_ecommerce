<style>
.imagedropshadow {
	padding: 5px;
	border: solid 1px #EFEFEF;
        background: #d79f0c;
}
a:hover img.imagedropshadow {
	border: solid 1px #CCC;
	-moz-box-shadow: 1px 1px 5px #999;
	-webkit-box-shadow: 1px 1px 5px #999;
        box-shadow: 1px 1px 5px #999;
}
</style>

<table style="width: 100%">
    <tr>
        <td style="vertical-align: top">
            <?php
            echo $this->data['Configuracao']['quem_somos'];
            echo '<br/><br/>';
            
            
            //imagem da Cravo&Canela e West Coast
            echo '<table style="width: 100%;"><tr><td>';
            echo $this->Html->image('cravo_canela.jpg', array('style' => ''));
            echo '</td><td>';
            echo $this->Html->image('west_coast.jpg', array('style' => ''));
            echo '</td></tr></table>';
            
            ?>            
        </td>
        <td style="vertical-align: top; width: 290px">
            <?php
            echo $this->Html->image('loja_homesample.jpg', array('style' => 'float:right;', 'class' => 'imagedropshadow'));
            echo '<br/><br/>';
            echo $this->Html->image('loja_homesample_3.jpg', array('style' => 'float:right;', 'class' => 'imagedropshadow'));
            echo '<br/><br/>';
            echo $this->Html->image('loja_homesample_2.jpg', array('style' => 'float:right;', 'class' => 'imagedropshadow'));
            ?>            
        </td>
    </tr>
</table>
