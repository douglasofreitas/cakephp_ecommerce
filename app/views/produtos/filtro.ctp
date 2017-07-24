
<h3>
	<?php if($login_group_id == 1): ?>
		Total de produtos: <?php echo $paginator->counter(array('format' => '%count%'))." (Ativos: ".$produtos_ativos." - Inativos: ".($paginator->counter(array('format' => '%count%')) - $produtos_ativos).")"; ?>  <br>
	<?php endif; ?>
</h3>

<p class="paginate" >
	<?php 
        $this->Paginator->options(array('url' => array('?' => $param_get)));
        
        
		echo $paginator->prev('< Anterior', array('class' => 'prev_enable'), ' ', array('class' => 'prev_disable'));
                echo ' '.$paginator->numbers().' ';
                echo $paginator->next('Próximo >', array('class' => 'next_enable'), ' ', array('class' => 'next_disable'));
	?>
	<span style="float: right;">
		Ordenar por: <?php echo $this->Paginator->sort('nome');?>, <?php echo $this->Paginator->sort('Mais recente', 'modified');?>, <?php echo $this->Paginator->sort('Valor', 'valor');?>
	</span>
</p>
<br/>
	
<?php
if(count($produtos) > 0){
	echo '<div style="width:100%">';
	foreach ($produtos as $produto){
            $this->produtopack->view_produto($produto, $side_bar, $login_group_id);
            
	}
        echo '<div style="clear:both"></div></div>';
        ?>
        <p class="paginate" >
                <?php 
                        echo $paginator->prev('< Anterior', array('class' => 'prev_enable'), ' ', array('class' => 'prev_disable'));
                        echo ' '.$paginator->numbers().' ';
                        echo $paginator->next('Próximo >', array('class' => 'next_enable'), ' ', array('class' => 'next_disable'));
                ?>
                <span style="float: right;">
                        Ordenar por: <?php echo $this->Paginator->sort('nome');?>, <?php echo $this->Paginator->sort('Mais recente', 'modified');?>, <?php echo $this->Paginator->sort('Valor', 'valor');?>
                </span>
        </p>
        <?php
        
}else{
	echo 'Ainda não há produtos nesta categoria';
}
?>


