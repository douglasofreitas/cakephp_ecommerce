Abaixo estão os recursos do sistema que podem ser habilitados.<br/>
No momento a ativação/desativação é feita somente pelo Grupo DF.<br/>
<br/>
<br/>
<?php
echo $this->Form->create('Configuracao', array('url' => array('controller' => 'lojas', 'action' =>'editar_dados'), 'class' => 'formulario'));


echo '<label class="formulario" >Galeria de fotos</label>';
echo $form->checkbox('ativa_fotogaleria', array());
echo '<br/>';

echo '<label class="formulario" >Permissão para compras</label>';
echo $form->checkbox('ativa_compras', array());
echo '<br/>';

echo '<label class="formulario" >Módulo de eventos</label>';
echo $form->checkbox('ativa_eventos', array());
echo '<br/>';

echo '<label class="formulario" >Uso de marcas para os produtos</label>';
echo $form->checkbox('ativa_marcas', array());
echo '<br/>';

echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';

?>
