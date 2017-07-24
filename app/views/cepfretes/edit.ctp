<script type="text/javascript">

	$(function() {

		$("#formulario_id").validate({
			rules: {
				'data[CepFrete][nome]': { 
					required: true,
					minlength: 3
				},
                                'data[CepFrete][cep_inicio]': { 
					required: true,
					minlength: 5
				},
                                'data[CepFrete][cep_fim]': { 
					required: true,
					minlength: 5
				},
                                'data[CepFrete][data_inicio]': { 
					required: true
				},
                                'data[CepFrete][data_fim]': { 
					required: true
				}
				
			},
			messages: {
				'data[CepFrete][nome]': { 
					required: "Campo obrigatório!",
					minlength: "Nome muito pequeno!"
				},
                                'data[CepFrete][cep_inicio]': { 
					required: "Campo obrigatório!",
					minlength: "CEP muito pequeno!"
				},
                                'data[CepFrete][cep_fim]': { 
					required: "Campo obrigatório!",
					minlength: "CEP muito pequeno!"
				},
                                'data[CepFrete][data_inicio]': { 
					required: "Campo obrigatório!"
				},
                                'data[CepFrete][data_fim]': { 
					required: "Campo obrigatório!"
				}
                                
			}
		});
	});
</script>	
<?php
    echo $this->Form->create('CepFrete', array('url' => array('controller' => 'cepfretes', 'action' =>'add'), 'class' => 'formulario', 'id' => 'formulario_id'));
    echo $this->Form->hidden('id', array('style' => ''));
    
    echo '<label class="formulario">Nome *</label>';
    echo $this->Form->input('nome', array('style' => 'width:300px', 'label' => false));
    echo '<br/>';	
    
    echo '<label class="formulario">Descrição </label>';
    echo $this->Form->textarea('descricao', array('style' => 'width:300px;height: 100px;', 'label' => false));
    echo '<br/>';	

    echo '<label class="formulario">CEP inicial *</label>';
    echo $this->Form->input('cep_inicio', array('style' => 'width:150px', 'label' => false));
    echo '<br/>';	
    
    echo '<label class="formulario">CEP final *</label>';
    echo $this->Form->input('cep_fim', array('style' => 'width:150px', 'label' => false));
    echo '<br/>';	
    
    echo '<label class="formulario">Validade - Data inicial *</label>';
    echo $this->Form->text('data_inicio', array('style' => 'width:150px', 'label' => false, 'value' => $this->data['CepFrete']['data_inicio_form']));
    echo '(dd/mm/aaaa)';
    echo '<br/>';	
    
    echo '<label class="formulario">Validade - Data final *</label>';
    echo $this->Form->text('data_fim', array('style' => 'width:150px', 'label' => false, 'value' => $this->data['CepFrete']['data_fim_form']));
    echo '(dd/mm/aaaa)';
    echo '<br/>';	
    
    
?>    
Escolha uma das opções abaixo para definir o desconto do valor do frente ou o valor fixo.<br/>
<br/>
<table style="width: 100%;">
    <tr>
        <td>
            <label class="formulario">Valor do frete</label>
        </td>
        <td>
            <?php
            echo $this->Form->input('valor', array('style' => 'width:150px', 'label' => false));
            echo '<br/>';	
            ?>
        </td>
        <td>
            <label class="formulario" style="width: 198px;">Porcentagem de desconto no frete (%)</label>
        </td>
        <td>
            <?php
            echo $this->Form->input('porcentagem', array('style' => 'width:50px', 'label' => false));
            echo '<br/>';	
            ?>
        </td>
    </tr>
</table>

<?php    
    echo '<br/>';
    echo '<button type="submit" class="button2 large2 orange2">Salvar</button></form>';
?>