<?php
echo $this->Html->link(
    'Criar mala direta',
    '/users/mala_direta/');
?>
<br/><br/>

<table class="listagem" width="100%">
	<tr class="listagem_header">
            <td class="header_table" style="width:60px; text-align:center;" >Código</td>
            <td class="header_table" style="width:auto; text-align:center;" >Assunto</td>
            <td class="header_table" style="width:75px; text-align:center;" >Enviado</td>
            <td class="header_table" style="width:75px; text-align:center;" >Data de envio</td>
            <td class="header_table" style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($mala_diretas as $mala_direta):
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
                            $mala_direta['EmailHistorico']['id'],
                            '/users/mala_direta_view/'.$mala_direta['EmailHistorico']['id']
                        );   
                        ?>
		</td>
		<td style="text-align:center">
			<?php 
			echo $this->Html->link(
					$mala_direta['EmailHistorico']['assunto'],
					'/users/mala_direta_view/'.$mala_direta['EmailHistorico']['id']);
			?>
			
		</td>
        <td style="text-align:center">
            <?php
            if($mala_direta['EmailHistorico']['enviado'] == 1)
                echo 'Sim';
            else
                echo 'Não';
            ?>

        </td>
		<td style="text-align:center">
			<?php
            echo date('d/m/Y', strtotime($mala_direta['EmailHistorico']['modified']));
            ?>
			
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/find.png', array('alt' => 'Visualizar pedido', 'url' => '/users/mala_direta_view/'.$mala_direta['EmailHistorico']['id'], 'class' => 'tipHoverRight', 'title' => 'Visualizar detalhes'));?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

