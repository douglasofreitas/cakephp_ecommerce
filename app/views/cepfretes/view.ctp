<ul>
        <?php
        echo $this->Html->link(
            $this->Html->image('icon/page_white_edit.png', array('class' => 'tipHoverBottom', 'title' => 'Editar')),
            '/cepfretes/edit/'.$cepfrete['CepFrete']['id'],
            array('escape' => false)
        );
        echo $this->Html->link(
            $this->Html->image('icon/arrow_left.png', array('class' => 'tipHoverBottom', 'title' => 'Voltar')),
            '/cepfretes',
            array('escape' => false)
        );
        ?>
</ul>

<label class="formulario">Nome</label>
<?php echo $cepfrete['CepFrete']['nome']; ?>
<br/>

<label class="formulario">Descrição</label>
<?php echo nl2br($cepfrete['CepFrete']['descricao']); ?>
<br/>

<label class="formulario">CEP inicial</label>
<?php echo $cepfrete['CepFrete']['cep_inicio']; ?>
<br/>
<label class="formulario">CEP final</label>
<?php echo $cepfrete['CepFrete']['cep_fim']; ?>
<br/>
<label class="formulario">Validade - Data inicial</label>
<?php echo $cepfrete['CepFrete']['data_inicio_form']; ?>
<br/>
<label class="formulario">Validade - Data final</label>
<?php echo $cepfrete['CepFrete']['data_fim_form']; ?>
<br/>

<label class="formulario">Valor / Desconto</label>
<?php 
if(!empty($cepfrete['CepFrete']['valor_form']))
    echo 'R$ '.$cepfrete['CepFrete']['valor_form'];  
else
    echo $cepfrete['CepFrete']['porcentagem'].' %';  
?>
<br/>