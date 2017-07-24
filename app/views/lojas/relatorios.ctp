<h3>Produtos</h3>
<?php 
echo $html->link('Produtos mais visualizados', '/produtos/relatorios/visualizados'); 
echo '<br/><br/>';
echo $html->link('Produtos mais vendidos', '/produtos/relatorios/vendidos');
echo '<br/><br/>';
echo $html->link('Produtos mais amados', '/produtos/relatorios/amados');
?>
