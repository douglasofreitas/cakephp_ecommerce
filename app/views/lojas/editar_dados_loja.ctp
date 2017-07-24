Abaixo estão os recursos do sistema que podem ser habilitados.<br/>
No momento a ativação/desativação é feita somente pelo Grupo DF.<br/>
<br/>
<br/>
<?php
echo $this->Form->create('Configuracao', array('url' => array('controller' => 'lojas', 'action' =>'editar_dados'), 'class' => 'formulario'));

echo '<label class="formulario" >Exibir botão "Indicar produto"</label>';
echo $form->checkbox('exibe_botao_prod_indicar', array());
echo '<br/>';

echo '<label class="formulario" >Exibir botão "Curtir" (Facebook) </label>';
echo $form->checkbox('exibe_botao_prod_facebook', array());
echo '<br/>';



?>
Dimensão do pacote padrão do produto (cm):
<br/><br/>
<table>
    <tr>
        <td style="width: 115px;">
            <strong>Comprimento</strong>
        </td>
        <td style="width: 79px;">
            <strong>Largura</strong>
        </td>
        <td>
            <strong>Altura</strong>
        </td>
    </tr>
    <tr>
        <td style="width: 115px;">
            <?php echo $form->text('medida_comprimento', array('style' => 'width:50px;margin: 0px;')); ?>
        </td>
        <td style="width: 79px;">
            <?php echo $form->text('medida_largura', array('style' => 'width:50px;margin: 0px;')); ?>
        </td>
        <td>
            <?php echo $form->text('medida_altura', array('style' => 'width:50px;margin: 0px;')); ?>
        </td>
    </tr>
</table>
<br/>
<?php
echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>