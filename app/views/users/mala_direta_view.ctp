

<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "table,inlinepopups",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,fontsizeselect,|,table,removeformat,code,|,link,unlink",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true


    });
</script>

<ul>
    <?php
    echo $this->Html->link(
        $this->Html->image('icon/page_white_edit.png', array('class' => 'tipHoverBottom', 'title' => 'Editar dados')),
        '/users/mala_direta_editar/'.$mala_direta['EmailHistorico']['id'],
        array('escape' => false , 'style' => '', 'class' => 'tipHoverBottom', 'title' => 'Editar e-mail')
    );
    ?>
</ul>


<?php

echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'mala_direta_enviar/'.$mala_direta['EmailHistorico']['id']), 'class' => 'formulario', 'id' => 'formvalidade'));
echo $this->Form->hidden('condition', array( 'value' => json_encode($condition)));
echo '<strong>Assunto *</strong>';
echo '<br/>';
echo '<div style="background: #FFF;padding: 6px;">'.$mala_direta['EmailHistorico']['assunto'].'</div>';
echo '<br/><br/>';
echo '<strong>Mensagem*</strong>';
echo '<br/>';
echo '<div style="background: #FFF;padding: 6px;">'.$mala_direta['EmailHistorico']['corpo'].'</div>';
echo '<br/>';

if($mala_direta['EmailHistorico']['enviado'] == 0)
echo '<button type="submit" style="float:right" class="button2 large2 orange2">Enviar e-mail</button></form>';

?>	
<br/>
<p>Destinatários: <span style="font-weight: bold"> <?php echo count($users) ?></span> (os destinatários serão enviados em cópia oculta) </p>

<table class="listagem" width="100%">
	<tr class="listagem_header">
            <td class="header_table" style="width:60px; text-align:center;" >Código</td>
            <td class="header_table" style="width:auto; text-align:center;" >Nome</td>
            <td class="header_table" style="width:202px; text-align:center;" >E-mail</td>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="linha_impar"';
		}else{
			$class = ' class="linha_par"';
		}
	?>
	<tr<?php echo $class;?>>
		<td style="text-align:center">
			<?php 
			echo $this->Html->link(
                            $user['User']['id'],
                            '/users/view/'.$user['User']['id']
                        );   
                        ?>
		</td>
		<td style="text-align:center">
			<?php 
			echo $this->Html->link(
					$user['User']['name'],
					'/users/view/'.$user['User']['id']); 
			?>
			
		</td>
		<td style="text-align:center">
			<?php echo $user['User']['email']; ?>
			
		</td>
	</tr>
	<?php endforeach; ?>
</table>

