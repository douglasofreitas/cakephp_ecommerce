<ul>
        <?php
        echo $this->Html->link(
            $this->Html->image('icon/arrow_left.png', array('class' => 'tipHoverBottom', 'title' => 'Voltar')),
            '/fotoheaders/index/',
            array('escape' => false)
        );
        ?>
        
        <?php
        echo $this->Html->link(
            $this->Html->image('icon/page_white_edit.png', array('class' => 'tipHoverBottom', 'title' => 'Editar foto')),
            '/fotoheaders/edit/'.$fotoheader['Fotoheader']['id'],
            array('escape' => false)
        );
        ?>
</ul>

<?php echo $this->Html->image('/header/'.$fotoheader['Fotoheader']['img'], array("alt" => "[Imagem header]".$fotoheader['Fotoheader']['nome'], 'style' => 'max-width:300px')) ?>
<br/>
<br/>

<label class="formulario">Nome</label>
<?php echo $fotoheader['Fotoheader']['nome']; ?>
<br/>

<label class="formulario">Link - Nome</label>
<?php echo $fotoheader['Fotoheader']['link_nome']; ?>
<br/>

<label class="formulario">Link - URL</label>
<?php echo $fotoheader['Fotoheader']['link']; ?>
<br/>

<label class="formulario">Descrição</label><br/>
<?php echo '<div class="descricao">'.$fotoheader['Fotoheader']['descricao'].'</div>'; ?>
<br/>