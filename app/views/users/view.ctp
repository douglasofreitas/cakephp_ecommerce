
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
                    echo $user['Cidade']['nome'].' - '.$estado['Estado']['nome'];
            else
                    echo 'Não definido'; 
            ?>
            
        </td>
    </tr>
    <tr>
        <td style="width: 129px;" class="destaque">
            Recebe notícias
        </td>
        <td colspan="3">
            <?php
            if($user['User']['recebe_noticia'] == 1)
                echo 'Sim';
            else
                echo 'Não';
            ?>
        </td>
    </tr>
    <tr>
        <td style="width: 129px;" class="destaque">
            Data de cadastro
        </td>
        <td colspan="3">
            <?php echo date('d/m/Y H:i:s', strtotime($user['User']['created'])); ?>
        </td>
    </tr>
    <tr>
        <td style="width: 129px;" class="destaque">
            Data da ultima modificação
        </td>
        <td colspan="3">
            <?php echo date('d/m/Y H:i:s', strtotime($user['User']['modified'])); ?>
        </td>
    </tr>
    <tr>
        <td style="width: 129px;" class="destaque">
            Pedidos
        </td>
        <td colspan="3">
            <?php if(count($pedidos) == 0): ?>
                    Não há pedidos
            <?php else: ?>
                    <table class="listagem" width="auto">
                            <tr class="listagem_header">
                                            <td style="width:auto; text-align:center;" >Código</td>
                                            <td style="width:150px; text-align:center;" >Número de produtos</td>
                                            <td style="width:150px; text-align:center;" >Status do pedido</td>
                                            <td style="width:150px; text-align:center;" >Data de criação</td>
                                            <td style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($pedidos as $pedido):
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
                                                            $pedido['Pedido']['id'],
                                                            '/pedidos/view/'.$pedido['Pedido']['id']);  
                                            ?>
                                            
                                    </td>
                                    <td style="text-align:center">
                                            <?php echo count($pedido['Itempedido']); ?>
                                            
                                    </td>
                                    <td style="text-align:center">
                                            <?php echo $pedido['Statuspedido']['nome']; ?>
                                            
                                    </td>
                                    <td style="text-align:center">
                                            <?php echo date('d/m/Y H:i:s', strtotime($pedido['Pedido']['created'])); ?>
                                            
                                    </td>
                                    <td style="text-align:center" class="actions">

                                            <?php echo $this->Html->image('icon/find.png', array('alt' => 'Visualizar pedido', 'url' => '/pedidos/view/'.$pedido['Pedido']['id'], 'class' => 'tipHoverRight', 'title' => 'Visualizar detalhes'));?>
                                    </td>
                            </tr>
                            <?php endforeach; ?>
                    </table>
            <?php endif; ?>
        </td>
    </tr>
</table>
