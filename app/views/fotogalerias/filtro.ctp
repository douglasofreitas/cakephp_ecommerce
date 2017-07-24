<script type="text/javascript" src="<?php echo $html->url('/js/slimbox/slimbox2.js') ?>"></script> 
<link rel="stylesheet" href="<?php echo $html->url('/js/slimbox/slimbox2.css') ?>" type="text/css" /> 

<h3>
	<?php if($login_group_id == 1): ?>
		Total de fotos: <?php echo $paginator->counter(array('format' => '%count%')); ?><br>
	<?php endif; ?>
	<?php echo $paginator->counter(array('format' => 'Total de páginas: %pages%')); ?>
</h3>

<p class="paginate" >
	<?php 
		echo $paginator->prev(' << Anterior ', array('class' => 'prev_enable'), ' ', array('class' => 'prev_disable'));
                echo $paginator->numbers();
                echo $paginator->next(' Próximo >> ', array('class' => 'next_enable'), ' ', array('class' => 'next_disable'));
	?>
	<span style="float: right;">
		Ordenar por: <?php echo $this->Paginator->sort('nome');?>, <?php echo $this->Paginator->sort('Mais recente', 'modified');?>
	</span>
</p>
<br/>
	
<?php
if(count($fotos) > 0){
	echo '<div style="width:100%">';
	foreach ($fotos as $foto){
	?>
	
		<div class="foto_galeria" >
			<?php if($login_group_id == 1): ?>
				<span class="icons" style="float:center;width:77px">
					<?php echo $this->Html->image('icon/find.png', array('alt' => 'Visualizar', 'url' => '/fotogalerias/view/'.$foto['Fotogaleria']['id'], 'class' => 'tipHoverTop', 'title' => 'Visualizar detalhes'));?>
                                        <?php echo $this->Html->image('icon/page_white_edit.png', array('alt' => 'Editar', 'url' => '/fotogalerias/edit/'.$foto['Fotogaleria']['id'], 'class' => 'tipHoverTop', 'title' => 'Editar dados'));?>
                                        <?php 
                                        echo $this->Html->link(
                                            $this->Html->image("icon/bin_closed.png", array("alt" => "Remover", 'class' => 'tipHoverTop', 'title' => 'Remover foto')),
                                            '/fotogalerias/delete/'.$foto['Fotogaleria']['id'],
                                            array('escape' => false),
                                            'Tem certeza que deseja remover esta foto?'
                                        );
                                        ?>
				</span>
				<br>
			<?php endif; ?>
			<div class="foto" >
				<?php
				if(empty($foto['Fotogaleria']['descricao']))
					$text_lightbox = $foto['Fotogaleria']['nome'];
				else
					$text_lightbox = $foto['Fotogaleria']['nome'].': '.$foto['Fotogaleria']['descricao'];
				echo $this->Html->link(
					$this->Html->image('/fotos/'.$foto['Fotogaleria']['mini_img'], array("alt" => $foto['Fotogaleria']['nome'])),
					'/fotos/'.$foto['Fotogaleria']['nome_img'],
					array('escape' => false, 'rel' => 'lightbox-gallery', 'title' => $text_lightbox )
				);
				?>
	        </div>
			<p>
				<?php echo $foto['Fotogaleria']['nome']; ?>
			</p>
		</div>
	
	<?php
	}
        echo '</div>';
        ?>
        <p class="paginate" >
                <?php 
                        echo $paginator->prev(' << Anterior ', array('class' => 'prev_enable'), ' ', array('class' => 'prev_disable'));
                        echo $paginator->numbers();
                        echo $paginator->next(' Próximo >> ', array('class' => 'next_enable'), ' ', array('class' => 'next_disable'));
                ?>
                <span style="float: right;">
                        Ordenar por: <?php echo $this->Paginator->sort('nome');?>, <?php echo $this->Paginator->sort('Mais recente', 'modified');?>
                </span>
        </p>
        <?php
        
}else{
	echo 'Não há fotos com este filtro';
}
?>


