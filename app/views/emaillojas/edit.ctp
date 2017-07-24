<script type="text/javascript"> 
    tinyMCE.init({ 
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "table,inlinepopups",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,fontsizeselect,|,table,removeformat,code",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        
    }); 
</script> 

<ul>
	<?php
	echo $this->Html->link(
            $this->Html->image('icon/arrow_left.png', array('class' => 'tipHoverBottom', 'title' => 'Voltar')),
            'javascript:javascript:history.go(-1)',
            array('escape' => false)
        );
	?>
</ul>


<?php echo $this->Form->create('Emailloja', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'emaillojas', 'action' =>'edit/'.$this->data['Emailloja']['id']), 'class' => 'formulario'));?>
<?php

echo '<label class="formulario">Sigla</label>';
echo $this->data['Emailloja']['sigla'];
echo '<br/>';

echo '<label class="formulario">Corpo do e-mail</label>';
echo $this->Form->textarea('texto', array('style' => 'width:380px', 'rows' => '10'));
echo '<br/>';

echo '<br/>';
echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>