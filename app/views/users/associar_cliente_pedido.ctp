<?php
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'associar_cliente_pedido'), 'class' => 'formulario'));
echo $this->Form->input('busca', array('value' => $busca, 'style' => 'width:250px'));
echo '<button style="float:center" class="button2 small2 orange2" type="submit" id="botao_adicionar_produto">Buscar</button>';
echo '</form>';
?>
<br/>
<br/>
<?php
echo $this->Html->link('Cadastro rápido de cliente', '/users/cadastro_rapido');
?>
<br/>
<br/>
<table class="listagem" width="100%">
	<tr class="listagem_header">
            <td class="header_table" style="width:51px; text-align:center;" >Código</td>
            <td class="header_table" style="width:auto; text-align:center;" >Nome</td>
            <td class="header_table" style="width:86px; text-align:center;" >CPF</td>
            <td class="header_table" style="width:auto; text-align:center;" >E-mail</td>
            <td class="header_table" style="width:97px; text-align:center;"  class="actions"><?php __('Ações');?></td>
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
			&nbsp;
		</td>
		<td style="text-align:center">
			<?php 
			echo $this->Html->link(
                            $user['User']['name'],
                            '/users/view/'.$user['User']['id'],
                            array('target' => '_blank')); 
			?>
			&nbsp;
		</td>
                <td style="text-align:center">
			<?php echo $user['User']['cpf']; ?>
			&nbsp;
		</td>
		<td style="text-align:center">
			<?php echo $user['User']['email']; ?>
			&nbsp;
		</td>
		<td style="text-align:center" class="actions">
			<?php 
			echo $this->Html->link(
                            'Associar cliente',
                            '/pedidos/associar_cliente/'.$user['User']['id']
                        );   
                        ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php
if(empty($users)){
    echo 'Digite o nome, e-mail ou CPF do cliente no campo de busca';
}
?>