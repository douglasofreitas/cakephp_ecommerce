<?php 
if($tipo == 'visualizados'){
    echo '';
}elseif($tipo == 'vendidos'){
    echo 'Apenas pedidos aprovados<br/><br/>';
}
?>

<?php if(count($produtos) > 0): ?>

<table class="listagem" width="100%">
	<tr class="listagem_header">
			<td class="header_table" style="width:50px; ;" >Código</td>
			<td class="header_table" style="width:auto; ;" >Nome</td>
			<td class="header_table" style="width:30px; ;" >Ativo</td>
                        <td class="header_table" style="width:88px; ;" >Valor</td>
                        <?php 
                        if($tipo == 'visualizados'){
                            echo '<td class="header_table" style="width:110px;" >Visualizações</td>';
                        }elseif($tipo == 'vendidos'){
                            echo '<td class="header_table" style="width:57px; ;" >Pedidos</td>';
                        }elseif($tipo == 'amados'){
                            echo '<td class="header_table" style="width:100px; ;" >Pessoas que amaram</td>';
                        }
                        ?>
			<td class="header_table" style="width:156px; ;" >Últ. modificação</td>
			<td class="header_table" style="width:60px; ;"  class="actions"><?php __('Ações');?></td>
	</tr>
	<?php
	$i = 0;
	foreach ($produtos as $produto):
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
					$produto['Produto']['id'],
					'/produtos/view/'.$produto['Produto']['id']);  
			?>
			
		</td>
		<td style="text-align:center">
			<?php echo $produto['Produto']['nome']; ?>
			
		</td>
		<td style="text-align:center">
			<?php 
                        if($produto['Produto']['ativo'] == 1){
                            echo '<span style="color:green">SIM</span>';
                        }else{
                            echo '<span style="color:red">NÃO</span>';
                        }
                        ?>
			
		</td>
                <td style="text-align:center">
			<?php 
                        echo 'R$ '.$produto['Produto']['valor_form']; ?>
			
		</td>
                
                <?php 
                if($tipo == 'visualizados'){
                        ?>
                        <td style="text-align:center">
                                <?php 
                                echo $produto['Produto']['visualizacao']; ?>
                                
                        </td>
                        <?php
                }elseif($tipo == 'vendidos'){
                        ?>
                        <td style="text-align:center">
                                <?php 
                                echo $produtos_count[$produto['Produto']['id']]; ?>
                                
                        </td>
                        <?php
                }elseif($tipo == 'amados'){
                    ?>
                    <td style="text-align:center">
                        <?php
                        echo $produto['Produto']['count_amei']; ?>

                    </td>
                <?php
                }
                ?>
                
                
		<td style="text-align:center">
			<?php echo date('d/m/Y H:i:s', strtotime($produto['Produto']['modified'])); ?>
			
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/find.png', array('alt' => 'Visualizar produto', 'url' => '/produtos/view/'.$produto['Produto']['id'], 'class' => 'tipHoverRight', 'title' => 'Visualizar detalhes'));?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php else: ?>

Não há produtos 

<?php endif; ?>
