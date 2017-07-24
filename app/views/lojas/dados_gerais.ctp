<h3>
    Dados gerais
    <?php
    echo '<span style="float:right">';
    echo $this->Html->image('icon/page_white_edit.png', 
            array('alt' => 'Editar', 
                'url' => '/lojas/editar_dados/editar_dados_gerais', 
                'class' => 'tipHoverRight', 'title' => 'Editar')
    );
    echo '</span>';
    ?>
</h3>
       
<table style="width: 100%;" class="tabela_detalhe">
    <tr>
        <td style="width: 129px;" class="destaque">
            Nome da empresa
        </td>
        <td >
            <?php echo $this->data['Configuracao']['nome_empresa']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
            Nome do responsável
        </td>
        <td >
            <?php echo $this->data['Configuracao']['nome_responsavel']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
            Endereço
        </td>
        <td >
            <?php echo $this->data['Configuracao']['logradouro']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
            Número
        </td>
        <td >
            <?php echo $this->data['Configuracao']['numero']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
            Bairro
        </td>
        <td >
            <?php echo $this->data['Configuracao']['bairro']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
            CEP
        </td>
        <td >
            <?php echo $this->data['Configuracao']['cep']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
            E-mail
        </td>
        <td >
            <?php echo $this->data['Configuracao']['email']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           URL do Site
        </td>
        <td >
            <?php echo $this->data['Configuracao']['site_url']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Quem Somos
        </td>
        <td >
            <?php echo $html->link('Visualizar', '/lojas/quem_somos', array('target' => '_blank')); ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Trocas e devoluções
        </td>
        <td >
            <?php echo $html->link('Visualizar', '/lojas/troca_devolucao', array('target' => '_blank')); ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Politica de Privacidade e Segurança
        </td>
        <td >
            <?php echo $html->link('Visualizar', '/lojas/politica_privacidade', array('target' => '_blank')); ?>
        </td>
    </tr>

</table>

<h3>
    Configurações gerais
    <?php
    echo '<span style="float:right">';
    echo $this->Html->image('icon/page_white_edit.png', 
            array('alt' => 'Editar', 
                'url' => '/lojas/editar_dados/editar_dados_loja', 
                'class' => 'tipHoverRight', 'title' => 'Editar')
    );
    echo '</span>';
    ?>
</h3>


<table style="width: 100%;" class="tabela_detalhe">
    <tr>
        <td style="width: 129px;" class="destaque">
           Botão "Indicar a um amigo"
        </td>
        <td >
            <?php 
            if($this->data['Configuracao']['exibe_botao_prod_indicar'] == 1)
                echo 'Habilitado';
            else
                echo 'Não habilitado'; 
            ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Botão "Facebook"
        </td>
        <td >
            <?php 
            if($this->data['Configuracao']['exibe_botao_prod_facebook'] == 1)
                echo 'Habilitado';
            else
                echo 'Não habilitado';
            ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Pacote correio
        </td>
        <td >
            <?php 
            echo $this->data['Configuracao']['medida_comprimento'].' x '.
                $this->data['Configuracao']['medida_largura'].' x '.
                $this->data['Configuracao']['medida_altura'].' cm';
            ?>
        </td>
    </tr>

</table>
<br/>
<?php
echo $html->link('Editar fotos do header', '/fotoheaders', array()); 
echo '<br/><br/>';
echo $html->link('Configurar valores de frete por faixa de CEP', '/cepfretes', array());
echo '<br/><br/>';
?>

<h3>
    Configuração de E-mail
    <?php
    echo '<span style="float:right">';
    echo $this->Html->image('icon/page_white_edit.png', 
            array('alt' => 'Editar', 
                'url' => '/lojas/editar_dados/editar_dados_email/', 
                'class' => 'tipHoverLeft', 'title' => 'Editar')
    );
    echo '</span>';
    ?>
</h3>

<table style="width: 100%;" class="tabela_detalhe">
    <tr>
        <td style="width: 129px;" class="destaque">
           Host
        </td>
        <td >
            <?php echo $this->data['Configuracao']['mail_host']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Porta
        </td>
        <td >
            <?php echo $this->data['Configuracao']['mail_port']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Usuário
        </td>
        <td >
            <?php echo $this->data['Configuracao']['mail_username']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Senha
        </td>
        <td >
            <?php echo $this->data['Configuracao']['mail_password']; ?>
        </td>
    </tr>
    <tr>
        <td class="destaque" >
           Assinatura do e-mail
        </td>
        <td>
            <?php echo $this->data['Configuracao']['email_assinatura']; ?>
        </td>
    </tr>
</table>
<br/>
<?php
echo $this->Html->link(
    'Enviar e-mail de teste',
    '/lojas/teste_email/',
    array('class' => 'tipHoverBottom', 'title' => 'Faz um envio de teste, podendo levar alguns minutos para receber'));  
?>
<br/><br/>
<?php echo $html->link('Configurar templates de e-mails', '/emaillojas'); ?>
<br/>
<h3>
    Recursos
    <?php
    echo '<span style="float:right">';
    echo $this->Html->image('icon/page_white_edit.png', 
            array('alt' => 'Editar configurações', 
                'url' => '#', 
                'style' => 'float:right', 'class' => 'tipHoverLeft', 'title' => 'Entre em contato com o Grupo DF para que estas opções possam ser ativadas')
    );
    echo '</span>';
    ?>
</h3>
<table style="width: 100%;" class="tabela_detalhe">
    <tr>
        <td style="width: 129px;" class="destaque">
           Galeria de fotos
        </td>
        <td >
            <?php 
            if($this->data['Configuracao']['ativa_fotogaleria'] == 1)
                echo 'Ativado';
            else
                echo 'Desativado';
            ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Permissão para compras
        </td>
        <td >
            <?php 
            if($this->data['Configuracao']['ativa_compras'] == 1)
                echo 'Ativado';
            else
                echo 'Desativado';
            ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Módulo de eventos
        </td>
        <td >
            <?php 
            if($this->data['Configuracao']['ativa_eventos'] == 1)
                echo 'Ativado';
            else
                echo 'Desativado';
            ?>
        </td>
    </tr>
    <tr>
        <td class="destaque">
           Uso de marcas para os produtos
        </td>
        <td >
            <?php 
            if($this->data['Configuracao']['ativa_marcas'] == 1)
                echo 'Ativado';
            else
                echo 'Desativado';
            ?>
        </td>
    </tr>
</table>