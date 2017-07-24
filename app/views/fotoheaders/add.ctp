<script type="text/javascript">

	$(function() {
                
                $("#formvalidade").validate({
			rules: {
				'data[Fotoheader][nome]': { 
					required: true,
					minlength: 2
				}
                                
			},
			messages: {
				'data[Fotoheader][nome]': { 
					required: "Nome obrigatório!",
					minlength: "Nome muito pequeno!"
				}
			}
		});
                
				
	});

</script>

<ul>
        <?php
        echo $this->Html->link(
            $this->Html->image('icon/arrow_left.png', array('class' => 'tipHoverBottom', 'title' => 'Voltar')),
            '/fotoheaders/index/',
            array('escape' => false)
        );
        ?>
</ul>

No momento somente as fotos aparecem no header.
<br/>
<br/>

<?php
echo $this->Form->create('Fotoheader', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'fotoheaders', 'action' =>'add'), 'class' => 'formulario', 'id' => 'formvalidade'));

echo '<label class="formulario" >Nome * </label>';
echo $this->Form->input('nome', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Descrição</label>';
echo $this->Form->textarea('descricao', array('style' => 'width:380px', 'rows' => '10'));
echo '<br/>';
echo '<label class="formulario" >Link - nome</label>';
echo $this->Form->input('link_nome', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Link - URL</label>';
echo $this->Form->input('link', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';

echo '<label class="formulario" >Imagem</label>';
?>
<input type='file' name='data[Fotoheader][foto]' /><br/>
<br/>

<?php
echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>
