<ul>
	<?php
	echo $this->Html->link(
	    $this->Html->image('icon/page_white_edit.png', array('class' => 'tipHoverBottom', 'title' => 'Editar dados')),
	    '/users/edit_data/',
	    array('escape' => false)
	);
        echo $this->Html->link(
            $this->Html->image('icon/ui_text_field_password.png', array('class' => 'tipHoverBottom', 'title' => 'Mudar senha')),
            '/users/change_password/'.$user['User']['id'],
            array('escape' => false)
        );
	?>
</ul>
	
<table style="width: 100%;" class="tabela_detalhe">
    <tr>
        <td style="width: 129px;" class="destaque">
            Nome
        </td>
        <td colspan="3">
            <?php echo $user['User']['name']; ?>
        </td>
    </tr>
    <tr>
        <td style="width: 129px;" class="destaque">
            E-mail
        </td>
        <td colspan="3">
            <?php echo $user['User']['email']; ?>
        </td>
    </tr>
    <tr>
        <td style="width: 129px;" class="destaque">
            CPF
        </td>
        <td colspan="3">
            <?php echo $user['User']['cpf']; ?>
        </td>
    </tr>
    
    
    <tr>
        <td style="width: 129px;" class="destaque">
            Telefone
        </td>
        <td colspan="3">
            <?php echo $user['User']['telefone']; ?>
        </td>
    </tr>
    <tr>
        <td style="width: 129px;" class="destaque">
            Endereço
        </td>
        <td colspan="3">
            <?php echo $user['User']['endereco'].' '.$user['User']['numero']; ?><br/>
            Complemento: <?php echo $user['User']['complemento']; ?><br/>
            Bairro: <?php echo $user['User']['bairro']; ?><br/>
            CEP: <?php echo $user['User']['cep']; ?><br/>
            Cidade: 
            <?php  
            if(!empty($user['User']['cidade_id']))
                    echo $user['Cidade']['nome'].' - '.$user['Cidade']['estado_id'];
            else
                    echo 'Não definido'; 
            ?>
            
        </td>
    </tr>
</table>
