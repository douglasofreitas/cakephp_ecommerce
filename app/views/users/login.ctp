<table style="width: 100%">
	<tr>
            <td valign="top" align="center">
			
			<table style="border-collapse: collapse;margin-left: 32px;" width="300px" class="listagem" >
				<tr class="listagem_header"><td class="header_table">Já sou cliente</td></tr>
				<tr>
					<td style="height: 156px;vertical-align: bottom;"><br/>
						<?php
						echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'login'), 'class' => 'formulario'));
						echo '<label class="formulario" style="width: 75px" >E-mail</label>';
						echo $this->Form->input('User.username', array('label' => false));
						echo '<br/>';
						echo '<label class="formulario" style="width: 75px" >Senha</label>';
						echo $this->Form->input('User.password', array('label' => false));
						echo '<br/>';
                                                echo $html->link('Esqueceu a senha?', '/users/remember', array('style' => 'float:right')); 
                                                echo '<br/>';
                                                echo '<button type="submit" class="button2 large2 orange2">Login</button></form>';	
						?>						
					</td>
				</tr>
			</table>
			
		</td>
                <td style="width:5px"></td>
		<td valign="top">
			
			<table style="border-collapse: collapse" width="auto" class="listagem">
				<tr class="listagem_header"><td class="header_table">Ainda não sou cliente</td></tr>
				<tr>
                                        <td style="height: 154px;vertical-align: bottom;">
						<br>Faça seu cadastro para realizar pedidos e receber novidades<br><br>
                                                <br/><br/><br/>
                                                <?php
                                                
						echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'cadastro_cliente'), 'class' => 'formulario'));
						
                                                echo '<button type="submit" class="button2 large2 orange2">Cadastra-se</button></form>';	
						?>	
					</td>
				</tr>
			</table>
			
			
		</td>
	</tr>
</table>