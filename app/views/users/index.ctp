<div class="filtro" style="width: 67%;float: left">
    <?php 
    echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'index'), 'type' => 'get', 'class' => 'formulario', 'id' => 'formvalidade', 'inputDefaults' => array('div' => false)));
    
    ?>
    
    <table style="width:100%"> 
        <tr>
            <td colspan="2">
                <label class="formulario" >Buscar</label>
                <?php 
                if(!empty($param_filtro['busca']))
                    echo $this->Form->input('busca', array('label' => false, 'value' => $param_filtro['busca'], 'style' => 'width: 300px;')); 
                else
                    echo $this->Form->input('busca', array('label' => false, 'value' => null, 'style' => 'width: 300px;')); 
                ?>
            </td>
        </tr>
        <tr>
            <td style="width: 300px">
                <label class="formulario" >Tipo de usuário</label>
                <?php 
                if(!empty($param_filtro['tipo_user']))
                    echo $this->Form->select('tipo_user', array('0' => '[TODOS]', '1' => 'Administrador', '2' => 'Cliente'), $param_filtro['tipo_user'],  array('empty' => false)); 
                else
                    echo $this->Form->select('tipo_user', array('0' => '[TODOS]', '1' => 'Administrador', '2' => 'Cliente'), null,  array('empty' => false)); 
                ?>
            </td>
            <td>
                <label class="formulario" >Receber notícias</label>
                <?php 
                if(!empty($param_filtro['recebe_noticia']))
                    echo $form->checkbox('recebe_noticia', array('checked' => 'checked'));
                else
                    echo $form->checkbox('recebe_noticia');
                ?>
                
            </td>
        </tr>
      
    </table>
    
    <?php
    
    echo '<button type="submit" class="button2 large2 orange2">Filtrar</button></form>';	 
    ?>
</div>

<div style="float: right;text-align: right;">
    <?php echo $this->Html->image('icon/email_open_3.png', array('alt' => 'Mala direta para todos os usuários abaixo', 'url' => '/users/mala_direta'.$param_get, 'style' => 'width: 30px;top: -4px;position: relative;;', 'class' => 'tipHoverTop', 'title' => 'Mala direta para todos os clientes'));?>
    <?php echo $this->Html->image('icon/excel.png', array('alt' => 'Formato Excel com todos os dados dos usuários', 'url' => '/users/exportar'.$param_get, 'style' => 'width: 36px;', 'class' => 'tipHoverTop', 'title' => 'Formato Excel com todos os dados dos usuários'));?> 
</div>

<br/>

<p class="paginate" >
    <?php 
    $this->Paginator->options(array('url' => array('?' => $param_get)));

    echo $paginator->prev('< Anterior', array('class' => 'prev_enable'), ' ', array('class' => 'prev_disable'));
    echo ' '.$paginator->numbers().' ';
    echo $paginator->next('Próximo >', array('class' => 'next_enable'), ' ', array('class' => 'next_disable'));
    ?>

    <span style="float:right">Total de usuários: <?php echo $paginator->counter(array('format' => '%count%')); ?><br/></span>
</p>

<p>
    Total de usuários: <?php echo $paginator->counter(array('format' => '%count%')) ?>
</p>

<table class="listagem" width="auto">
	<tr class="listagem_header">
            <td class="header_table" style="width:60px; text-align:center;" >Código</td>
            <td class="header_table" style="width:auto; text-align:center;" >Nome</td>
            <td class="header_table" style="width:auto; text-align:center;" >E-mail</td>
            <td class="header_table" style="width:89px; text-align:center;" >Tipo</td>
            <td class="header_table" style="width:79px; text-align:center;" >Número de pedidos</td>
            <td class="header_table" style="width:75px; text-align:center;" >Criação da conta</td>
            <td class="header_table" style="width:60px; text-align:center;"  class="actions"><?php __('Ações');?></td>
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
		</td>
		<td style="text-align:center">
			<?php 
			echo $this->Html->link(
					$user['User']['name'],
					'/users/view/'.$user['User']['id']); 
			?>
			
		</td>
		<td style="text-align:center">
			<?php echo $user['User']['email']; ?>
			
		</td>
                <td style="text-align:center">
			<?php echo $user['Group']['name']; ?>
			
		</td>
		<td style="text-align:center">
			<?php 
			echo count($user['Pedido']); 
			?>
			
		</td>
		<td style="text-align:center">
			<?php 
                        //echo date('d/m/Y H:i:s', strtotime($user['User']['created'])); 
                        echo date('d/m/Y', strtotime($user['User']['created']));
                        ?>
			
		</td>
		<td style="text-align:center" class="actions">
			
			<?php echo $this->Html->image('icon/find.png', array('alt' => 'Visualizar pedido', 'url' => '/users/view/'.$user['User']['id'], 'class' => 'tipHoverRight', 'title' => 'Visualizar detalhes'));?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

