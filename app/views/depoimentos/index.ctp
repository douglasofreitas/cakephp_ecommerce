<?php 
echo $this->Html->link(
		'Cadastrar depoimento',
		'/depoimentos/add/');  
?>
<br/><br/>




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


<table class="listagem" width="100%">
	<tr class="listagem_header">
			<td class="header_table" style="width:20px; text-align:center;" >Código</td>
			<td class="header_table" style="width:auto; text-align:center;" >Nome</td>
                        <td class="header_table" style="width:auto; text-align:center;" >E-mail</td>
                        <td class="header_table" style="width:90px; text-align:center;" >Aprovado</td>
                        <td class="header_table" style="width:90px; text-align:center;" >Data</td>
			<td class="header_table" style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($depoimentos as $depoimento):
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
					$depoimento['Depoimento']['id'],
					'/depoimentos/edit/'.$depoimento['Depoimento']['id']);  
			?>
			
		</td>
		<td style="text-align:center">
			<?php echo $depoimento['Depoimento']['nome']; ?>
		</td>
                <td style="text-align:center">
			<?php echo $depoimento['Depoimento']['email']; ?>
		</td>
                <td style="text-align:center">
			<?php 
                        if($depoimento['Depoimento']['aprovado'])
                            echo '<span style="color:green">Sim</span>'; 
                        else
                            echo '<span style="color:red">Não</span>'; 
                        ?>
		</td>
                <td style="text-align:center">
			<?php echo date('d/m/Y', strtotime($depoimento['Depoimento']['created'])); ?>
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar', 'url' => '/depoimentos/edit/'.$depoimento['Depoimento']['id'], 'class' => 'tipHoverBottom', 'title' => 'Editar depoimento'));?>
			<?php 
			echo $this->Html->link(
			    $this->Html->image("icon/bin_closed.png", array("alt" => "Remover", 'class' => 'tipHoverBottom', 'title' => 'Remover depoimento do sistema')),
			    '/depoimentos/delete/'.$depoimento['Depoimento']['id'],
			    array('escape' => false),
			    'Tem certeza que deseja remover este depoimento?'
			);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

