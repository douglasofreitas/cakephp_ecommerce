<script type="text/javascript">

	$(function() {
		$("#formvalidade").validate({
			rules: {
				'data[Produto][nome]': { 
					required: true,
					minlength: 3
				},
                                'data[Produto][email]': { 
					required: true,
					minlength: 3
				},
                                'data[Produto][telefone]': { 
					required: true,
					minlength: 3
				},
				'data[Produto][mensagem]': { 
					required: true,
                                        minlength: 3
				}
			},
			messages: {
				'data[Produto][nome]': { 
					required: "Campo obrigatório!",
                                        minlength: "Nome muito pequeno!"
				},
                                'data[Produto][email]': { 
					required: "Campo obrigatório!",
                                        minlength: "Nome muito pequeno!"
				},
                                'data[Produto][telefone]': { 
					required: "Campo obrigatório!",
                                        minlength: "Nome muito pequeno!"
				},
				'data[Produto][mensagem]': { 
					required: "Campo obrigatório!",
                                        minlength: "Mensagem muito pequena!"
				}
			}
		});
	});

</script>

Preencha o formulário abaixo para fazer encomendas ou tirar suas dúvidas sobre o produto.<br/>
Se tivermos o produto, enviaremos um link para fazer o pagamento e enviaremos o produto por correio.<br/>
<br/>
<strong>E-mail:</strong> contato@homesample.com.br  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <br>
<br/>
<strong>Telefone:</strong> (16) 3413-0380 (atendimento das 9h as 18h)<br/>
<br/>

<?php 

if(!empty($produto)){
    echo $produtopack->view_produto_simples($produto);
}

?>
<br/><br/>

<?php
echo $this->Form->create('Produto', array('url' => array('controller' => 'produtos', 'action' =>'encomenda/'.$produto['Produto']['id']), 'class' => 'formulario', 'id' => 'formvalidade'));
echo '<label class="formulario" >Nome completo</label>';
echo $this->Form->input('Produto.nome', array('label' => false, 'style' => 'width: 360px;'));

if(!empty($produto['Produto']['id']))
    echo $this->Form->hidden('Produto.produto', array('label' => false, 'value' => $produto['Produto']['id']));

echo '<br/>';
echo '<label class="formulario" >E-mail</label>';
echo $this->Form->input('Produto.email', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Telefone</label>';
echo $this->Form->input('Produto.telefone', array('label' => false, 'style' => 'width: 360px;'));
echo '<br/>';
echo '<label class="formulario" >Mensagem</label>';
echo $this->Form->textarea('Produto.mensagem', array('label' => false, 'style' => 'width: 360px;height: 200px;'));
echo '<br/>';
echo '<button type="submit" class="button2 large2 orange2">Enviar</button></form>';
?>