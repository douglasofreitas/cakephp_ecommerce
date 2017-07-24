<script type="text/javascript">

	$(function() {

		$("#formulario").validate({
			rules: {
				'data[Depoimento][nome]': { 
					required: true,
					minlength: 2
				}
			},
			messages: {
				'data[Depoimento][nome]': { 
					required: "Campo obrigatório!",
					minlength: "Muito pequeno!"
				},
                                'data[Depoimento][descricao]': { 
					required: "Campo obrigatório!",
					minlength: "Muito pequeno!"
				}
			}
		});
	});
</script>



<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "table,inlinepopups",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,link,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,fontsizeselect,|,table,removeformat,code",
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
$i = 0;
foreach ($depoimentos as $depoimento):
        
?>

<table style="width: 100%;margin-top: 26px;" class="tabela_detalhe">
    <tr>
        <td class="destaque" style="height: 16px;"><?php echo $depoimento['Depoimento']['nome']; ?>
            <div style="float:right">
                Data: <?php echo date('d/m/Y', strtotime($depoimento['Depoimento']['created'])); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo '<div class="descricao">'.$depoimento['Depoimento']['descricao'].'</div>';
            ?>

            <?php if(!empty($depoimento['DepoimentoFoto'])): ?>
                <div style="text-align: left;">
                <?php
                foreach($depoimento['DepoimentoFoto'] as $foto){


                    echo $this->Html->link(
                        $this->Html->image('/fotos/'.$foto['nome'], array("alt" => "[Imagem]", 'style' => 'max-width: 190px;border: solid 4px #ECB46C;')),
                        '/fotos/'.$foto['nome'],
                        array('style' => 'margin:13px', 'escape' => false, 'target' => '_blank')
                    );
                }
                ?>
                </div>
            <?php endif; ?>

        </td>
    </tr>
</table>
    
<?php endforeach; ?>
<br/>
<p style="margin-left: 10px;">
    Faça seu depoimento sobre nossa Loja Virtual, a Showroom ou de nosso produtos!
</p>
<br/>
<?php
echo $this->Form->create('Depoimento', array('url' => array('controller' => 'depoimentos', 'action' =>'add'), 'class' => 'formulario', 'id' => 'formulario'));
echo $this->Form->hidden('id', array('style' => '', 'label' => false));

echo '<label class="formulario">Nome </label>';
echo $this->Form->input('nome', array('style' => 'width:300px', 'label' => false));
echo '<br/>';

echo '<label class="formulario">E-mail </label>';
echo $this->Form->input('email', array('style' => 'width:300px', 'label' => false));
echo '( não é exibido ao público )';
echo '<br/>';

echo '<label class="formulario">Depoimento </label>';
echo $this->Form->textarea('descricao', array('style' => 'width: 400px;height: 150px;', 'label' => false));
echo '<br/>';


echo $html->image("captcha/".$captcha_src, array('style' => 'margin-left:173px'));
echo '<br/>';
echo '<label class="formulario"  for="UserVerCode">Código de verificação *</label>';
echo $this->Form->input('ver_code', array('label' => false));
echo '<br/>';


echo '<br/>';
echo '<button type="submit" class="button2 large2 orange2" style="margin-left: 174px;" >Salvar</button></form>';
?>
