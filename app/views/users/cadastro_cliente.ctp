<script type="text/javascript">

	$(function() {
            
            $("#formvalidade").validate({
                    rules: {
                            'data[User][name]': { 
                                    required: true,
                                    minlength: 3
                            },
                            'data[User][email]': { 
                                    required: true,
                                    email: true
                            },
                            'data[User][password]': { 
                                    required: true
                            },
                            'data[User][password2]': { 
                                    required: true,
                                    equalTo: "#UserPassword"
                            },
                            'data[User][cpf]': { 
                                    required: true
                            },
                            'data[User][cep]': { 
                                    required: true
                            },
                            'data[User][telefone]': { 
                                    required: true
                            },
                            'data[User][ver_code]': { 
                                    required: true
                            },
                            'data[User][estado_id]': { 
                                    required: true
                            },
                            'data[User][cidade_id]': { 
                                    required: true
                            }
                    },
                    messages: {
                            'data[User][name]': { 
                                    required: "Nome obrigatório!",
                                    minlength: "Nome muito pequeno!"
                            },
                            'data[User][email]': { 
                                    required: "E-mail obrigatório!",
                                    email: "E-mail inválido"
                            },
                            'data[User][password]': { 
                                    required: "Senha obrigatório!"
                            },
                            'data[User][password2]': { 
                                    required: "Confirmação de senha obrigatório!",
                                    equalTo: "Senhas não são iguais"
                            },
                            'data[User][cpf]': { 
                                    required: "CPF obrigatório!"
                            },
                            'data[User][cep]': { 
                                    required: "CEP obrigatório!"
                            },
                            'data[User][telefone]': { 
                                    required: "Telefone obrigatório!"
                            },
                            'data[User][ver_code]': { 
                                    required: "Código de verificação obrigatório!"
                            },
                            'data[User][estado_id]': { 
                                    required: "Estado obrigatório!"
                            },
                            'data[User][cidade_id]': { 
                                    required: "Cidade obrigatório!"
                            }
                    }
            });
            
            $('#UserCadastroClienteForm').submit(function() {
                    $('.error-message').css("display", 'none');
            });
            
            $('#UserEstadoId').change(function()
                { 
                    var selected = $(this).val();   

                    if(selected != ''){
                        //set loading image
                        $('#cidade').html('<label>' + <?php echo "'" . $this->Html->image('ajax-loader.gif') . "'" ?> + '</label>');

                        // ajax   
                        $.ajax({   
                            type: "POST",   
                            url: <?php echo "'" . $html->url('/cidades/ajax_cidades') . "'" ?>, 
                            data: "model=User&estado_id="+selected ,   
                            success: function(msg){   

                                $('#cidade').html(msg);
                            }
                        });
                    }
                }
            );		
	});

</script>
<?php
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'cadastro_cliente'), 'class' => 'formulario', 'id' => 'formvalidade'));
echo '<label class="formulario"  for="UserName">Nome completo*</label>';
echo $this->Form->input('name', array('label' => false, 'style' => 'width: 300px;'));
echo '<br/>';
echo '<label class="formulario"  for="UserEmail">E-mail*</label>';
echo $this->Form->input('email', array('label' => false, 'style' => 'width: 300px;'));
echo '<br/>';
echo '<label class="formulario"  for="UserPassword">Senha*</label>';
echo $this->Form->input('password', array('label' => false, 'value' => ''));
echo '<br/>';
echo '<label class="formulario"  for="UserPassword2">Confirmar Senha</label>';
echo $this->Form->password('password2', array('label' => false, 'value' => ''));
echo '<br/>';

echo '<label class="formulario"  for="UserCpf">CPF*(somente números)</label>';
echo $this->Form->input('cpf', array('label' => false));
echo '<br/>';
echo '<label class="formulario"  for="UserTelefone" >Telefone*</label>';
echo $this->Form->input('telefone', array('label' => false));
echo '<br/>';

echo '<br/><br/><br/>';
echo '<label class="formulario"  for="UserEndereco" >Endereço</label>';
echo $this->Form->input('endereco', array('label' => false, 'style' => 'width: 300px;'));
echo '<br/>';
echo '<label class="formulario"  for="UserNumero">Número</label>';
echo $this->Form->input('numero', array('label' => false));
echo '<br/>';
echo '<label class="formulario"  for="UserComplemento">Complemento</label>';
echo $this->Form->input('complemento', array('label' => false));
echo '<br/>';
echo '<label class="formulario"  for="UserCep">CEP (somente números)*</label>';
echo $this->Form->input('cep', array('label' => false));
echo '<br/>';
echo '<label class="formulario"  for="UserBairro">Bairro</label>';
echo $this->Form->input('bairro', array('label' => false));
echo '<br/>';



echo '<label class="formulario"  for="UserEstadoId">Estado *</label>';
echo $this->Form->select('estado_id', $select_estados, $estado_id,  array('empty' => true));
echo '<br/>';

echo '<div id="cidade" >';
echo '<label class="formulario"  for="UserCidadeId">Cidade *</label>';
echo $this->Form->select('cidade_id', $select_cidades, $cidade_id,  array('empty' => true));
echo '</div>';
echo '<br/>';

echo $html->image("captcha/".$captcha_src, array('style' => 'margin-left:173px'));
echo '<br/>';
echo '<label class="formulario"  for="UserVerCode">Código de verificação *</label>';
echo $this->Form->input('ver_code', array('label' => false));
echo '<br/>';

echo '<label class="formulario" for="UserRecebeNoticia">&nbsp;</label>';
echo $this->Form->checkbox('recebe_noticia', array('value' => 1, 'checked' => 'checked'));
echo '<strong>Receber novidades por e-mail?</strong>';
echo '<br/>';


echo '<button type="submit" class="button2 large2 orange2">Criar Conta</button></form>';	
?>	
		