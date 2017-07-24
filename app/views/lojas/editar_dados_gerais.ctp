<script type="text/javascript"> 
    tinyMCE.init({ 
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "table,inlinepopups",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,link,unlink,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,fontsizeselect,|,table,removeformat,code",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
    }); 
</script> 

<?php
echo $this->Form->create('Configuracao', array('url' => array('controller' => 'lojas', 'action' =>'editar_dados'), 'class' => 'formulario'));
echo '<label class="formulario" >Nome da empresa</label>';
echo $this->Form->input('nome_empresa', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Nome do responsável</label>';
echo $this->Form->input('nome_responsavel', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Endereço</label>';
echo $this->Form->input('logradouro', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Número</label>';
echo $this->Form->input('numero', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Bairro</label>';
echo $this->Form->input('bairro', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >CEP</label>';
echo $this->Form->input('cep', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';


echo '<label class="formulario" >E-mail</label>';
echo $this->Form->input('email', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >URL do Site</label>';
echo $this->Form->input('site_url', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';

echo '<label class="formulario" >Quem Somos</label>';
echo $this->Form->textarea('quem_somos', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';

echo '<label class="formulario" >Trocas e devoluções</label>';
echo $this->Form->textarea('troca_devolucao', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';

echo '<label class="formulario" >Politica de privacidade e segurança</label>';
echo $this->Form->textarea('politica_privacidade', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';

echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>
