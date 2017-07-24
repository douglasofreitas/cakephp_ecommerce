<html>
	<head>
	</head>
	<body>
		Olá <?php echo $nome; ?>,<br>
		<br>
		<br>
		Seu pedido foi concluído com sucesso.<br> 
		Após a confirmação de pagamento, será enviado um e-mail notificando o início da entrega dos itens pedidos.<br>
		<br>
		Acesse o sistema para visualizar o status de seu pedido.<br>
		<br>
		<br>
		Código do pedido:  <?php echo $pedido['Pedido']['id']; ?><br>
		Itens comprados:<br>
		<br>
		<table >
			<tr>
				<td style="width: 250px;font-weight: bold" >Produto</td>
				<td style="width: 100px;font-weight: bold" align="center">Valor</td>
			</tr>
		
			<?php
			$valor_total = $pedido['Pedido']['frete'];
			$i = 0;
			foreach($pedido['item'] as $item){
				
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="linha_impar"';
				}else{
					$class = ' class="linha_par"';
				}
				
				echo '<tr '.$class.' ><td>';
				echo $item['Produto']['nome'];
				echo '</td><td>R$ ';
				echo $item['Itempedido']['valor_total_form'];
				echo '</td></tr>';
				$valor_total += $item['Itempedido']['valor_total']; 
			}
			?>
		</table>
		<br>
		Valor do frete: R$ <?php echo $pedido['Pedido']['frete_form'] ?><br>
		Valor total: R$ <?php echo number_format($valor_total,2, ',', '.') ?><br>
		<br>
		<br>
		Obrigado!<br>		
	</body>
</html>
