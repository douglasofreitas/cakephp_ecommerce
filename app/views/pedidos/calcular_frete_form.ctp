<script type="text/javascript">

	$(function() {
                
                $("#formulario").validate({
			rules: {
				'data[Correio][cep_destino]': { 
					required: true
				},
				'data[Correio][peso]': { 
					required: true
				},
				'data[Correio][tipo_correio]': { 
					required: true
				},
				'data[Correio][comprimento]': { 
					required: true
				},
				'data[Correio][largura]': { 
					required: true
				},
				'data[Correio][altura]': { 
					required: true
				}
			},
			messages: {
				'data[Correio][cep_destino]': { 
					required: "Campo obrigatório!"
				},
				'data[Correio][peso]': { 
					required: "Campo obrigatório!"
				},
				'data[Correio][tipo_correio]': { 
					required: "Campo obrigatório!"
				},
				'data[Correio][comprimento]': { 
					required: "Campo obrigatório!"
				},
				'data[Correio][largura]': { 
					required: "Campo obrigatório!"
				},
				'data[Correio][altura]': { 
					required: "Campo obrigatório!"
				}
			}
		});
                
				
	});

</script>
<table>
    <tr>
        <td>
            <?php
            echo $this->Form->create('Correio', array('url' => array('controller' => 'pedidos', 'action' =>'calcular_frete_form'), 'style' => 'float: left', 'id' => 'formulario'));
            echo '<label style="float:left" for="ContatoCepOrigem">Insira o CEP de destino</label>';
            echo '<br>';
            echo $this->Form->input('cep_destino', array('style' => 'margin-left: 8px;width:100px;', 'value' => $correio['cep_destino'], 'label' => false, 'div' => false));
            echo '<br>';echo '<br>';

            echo '<label style="float:left" for="ContatoPeso">Peso - Kg (Ex: 0.7) </label>';
            echo '<br>';
            echo $this->Form->input('peso', array('style' => 'margin-left: 8px;width:100px;', 'value' => $correio['peso'], 'label' => false, 'div' => false));
            echo '<br>';echo '<br>';

            echo '<label style="float:left" for="ContatoPeso">Valor - R$ (Ex: 10.50) </label>';
            echo '<br>';
            echo $this->Form->input('valor', array('style' => 'margin-left: 8px;width:100px;', 'value' => $correio['valor'], 'label' => false, 'div' => false));
            echo '<br>';echo '<br>';


            echo '<label style="float:left" for="ContatoPeso">Tipo de envio</label>';
            echo '<br>';
            if(!empty($correio['tipo_correio'])){
                if($correio['tipo_correio'] == '41106' ){
                    echo '<input type="radio" name="data[Correio][tipo_correio]" checked="checked" value="41106"/>PAC&nbsp;&nbsp;&nbsp; ';
                    echo '<input type="radio" name="data[Correio][tipo_correio]" value="40010"/>SEDEX';
                }
                else{
                    echo '<input type="radio" name="data[Correio][tipo_correio]"  value="41106"/>PAC&nbsp;&nbsp;&nbsp; ';
                    echo '<input type="radio" name="data[Correio][tipo_correio]" checked="checked" value="40010"/>SEDEX';    
                }
            }else{
                echo '<input type="radio" name="data[Correio][tipo_correio]"  value="41106"/>PAC&nbsp;&nbsp;&nbsp; ';
                echo '<input type="radio" name="data[Correio][tipo_correio]" checked="checked" value="40010"/>SEDEX';    
            }
            //echo $this->Form->end(__('Calcular Frete', true));					


            ?>
            <br/><br/>
            <table>
                <tr>
                    <td style="width: 115px;">
                        <strong>Comprimento</strong><br/>
                        <input type="text" name="data[Correio][comprimento]"  value="<?php if(!empty($correio['comprimento'])) echo $correio['comprimento']; else echo $config_sistema['Configuracao']['medida_comprimento'] ?>" style="width: 42px;" />
                        (cm)
                    </td>
                    <td style="width: 101px;">
                        <strong>Largura</strong><br/>
                        <input type="text" name="data[Correio][largura]"  value="<?php if(!empty($correio['largura'])) echo $correio['largura']; else  echo $config_sistema['Configuracao']['medida_largura'] ?>" style="width: 42px;" />
                        (cm)
                    </td>
                    <td>
                        <strong>Altura</strong><br/>
                        <input type="text" name="data[Correio][altura]"  value="<?php if(!empty($correio['altura'])) echo $correio['altura']; else  echo $config_sistema['Configuracao']['medida_altura'] ?>" style="width: 42px;" />
                        (cm)
                    </td>
                </tr>
            </table>
            
            <br/><br/>
            
            
            
            <button type="submit" class="button2 small2 orange2">Calcular Frete</button>
            </form>
        </td>
        <td style="vertical-align: top;padding-left: 84px;">
            <div style="font-size: 18px; font-weight: bold;color: #925E00;">
            <?php 
            if(!empty($correio['frete'])){
                echo 'Valor do frete: R$ '.$correio['frete'];
            }
            ?>
            &nbsp;
            </div>
        </td>
    </tr>
</table>