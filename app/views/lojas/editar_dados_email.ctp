<script type="text/javascript"> 
    tinyMCE.init({ 
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "table,inlinepopups",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,link,unlink,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,fontsizeselect,|,table,removeformat,code,|,link,unlink",
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

echo '<label class="formulario" >Host</label>';
echo $this->Form->input('mail_host', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Porta</label>';
echo $this->Form->input('mail_port', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Usuário</label>';
echo $this->Form->input('mail_username', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Senha</label>';
echo $this->Form->password('mail_password', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Assinatura do e-mail</label>';
echo $this->Form->textarea('email_assinatura', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';

echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>
