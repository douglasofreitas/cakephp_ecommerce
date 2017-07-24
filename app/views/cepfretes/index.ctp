Faixas de CEP com desconto no frete<br/>
<br/>
<?php 

echo $html->link('Cadastrar faixa de CEP', '/cepfretes/add');
echo '<br/><br/><br/>';

?>


<table class="listagem" width="100%">
	<tr class="listagem_header">
			<td class="header_table" style="width:auto; text-align:center;" >Nome</td>
			<td class="header_table" style="width:auto; text-align:center;" >CEP inicial</td>
                        <td class="header_table" style="width:auto; text-align:center;" >CEP final</td>
                        <td class="header_table" style="width:auto; text-align:center;" >Data inicial</td>
                        <td class="header_table" style="width:auto; text-align:center;" >Data final</td>
                        <td class="header_table" style="width:auto; text-align:center;" >Valor</td>
			<td class="header_table" style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach($cepfretes as $cep):
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
					$cep['CepFrete']['nome'],
					'/cepfretes/view/'.$cep['CepFrete']['id']);  
			?>
			
		</td>
                <td style="text-align:center">
			<?php 
			echo $cep['CepFrete']['cep_inicio'];  
			?>
			
		</td>
                <td style="text-align:center">
			<?php 
			echo $cep['CepFrete']['cep_fim'];  
			?>
			
		</td>
                <td style="text-align:center">
			<?php 
			echo $cep['CepFrete']['data_inicio_form'];  
			?>
			
		</td>
                <td style="text-align:center">
			<?php 
			echo $cep['CepFrete']['data_fim_form'];  
			?>
			
		</td>
                <td style="text-align:center">
			<?php 
                        if(empty($cep['CepFrete']['porcentagem']))
                            echo 'R$ '.$cep['CepFrete']['valor_form'];  
                        else
                            echo $cep['CepFrete']['porcentagem'].' %';  
			?>
			
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar', 'url' => '/cepfretes/edit/'.$cep['CepFrete']['id'], 'class' => 'tipHoverBottom', 'title' => 'Editar'));?>
			<?php 
			echo $this->Html->link(
			    $this->Html->image("icon/bin_closed.png", array("alt" => "Remover", 'class' => 'tipHoverBottom', 'title' => 'Remover do sistema')),
			    '/cepfretes/delete/'.$cep['CepFrete']['id'],
			    array('escape' => false),
			    'Tem certeza que deseja remover estes CEPs do sistema?'
			);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

