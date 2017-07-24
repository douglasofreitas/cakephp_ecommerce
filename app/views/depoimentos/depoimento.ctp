<script type="text/javascript">

	$(function() {

		$("#formulario").validate({
			rules: {
				'data[Depoimento][descricao]': { 
					required: true,
					minlength: 3
				}
				
			},
			messages: {
				'data[Depoimento][descricao]': { 
					required: "Campo obrigatório!",
					minlength: "Muito pequeno!"
				}
			}
		});

        $('#adicionar_foto').click	(function()
            {
                var msg = "<input type='file' name='data[Depoimento][foto][]' /> <br/>";
                $('#fotos').append(msg);
                return false;
            }
        );

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
        echo $this->Form->create('Depoimento', array('url' => array('controller' => 'depoimentos', 'action' =>$action), 'enctype' => 'multipart/form-data', 'class' => 'formulario', 'id' => 'formulario'));
	echo $this->Form->hidden('id', array('style' => '', 'label' => false));
        
        echo '<label class="formulario">Nome </label>';
	echo $this->Form->input('nome', array('style' => 'width:300px', 'label' => false));
	echo '<br/>';	
        
        echo '<label class="formulario">E-mail </label>';
	echo $this->Form->input('email', array('style' => 'width:300px', 'label' => false));
	echo '<br/>';	
        
        echo '<label class="formulario">Depoimento </label>';
	echo $this->Form->textarea('descricao', array('style' => 'width: 400px;height: 150px;', 'label' => false));
	echo '<br/>';	
        
        echo '<label class="formulario">Aprovado</label>';
	echo $this->Form->checkbox('aprovado', array('style' => '', 'label' => false));
        echo '<br/>';

    echo '<label class="formulario">Fotos</label>';
    ?>

    <div id="fotos" style="width:100%;margin-left: 168px;" >
        <input type='file' name='data[Depoimento][foto][]' /><br/>
    </div>
    <p style="float:left"><a href="#" id="adicionar_foto">Adicionar mais fotos</a></p>

<?php
echo '<br/>';
echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>

<?php if(!empty($this->data['DepoimentoFoto'])): ?>

    <h4>Fotos atuais</h4>

    <table>
        <tr>
            <th>Foto</th>
            <th>Ação</th>
        </tr>

        <?php
        foreach($this->data['DepoimentoFoto'] as $foto){
            ?>
            <tr>
                <td><?php echo $this->Html->image('/fotos/'.$foto['nome'], array("alt" => "[Imagem]", 'style' => 'max-width: 265px;')); ?></td>
                <td><?php echo $this->Html->link('Remover', '/depoimentos/remover_foto/'.$foto['id'], array(), 'Confirma a remoção da foto do sistema?'); ?></td>
            </tr>
            <?php
        }
        ?>

    </table>

<?php endif; ?>