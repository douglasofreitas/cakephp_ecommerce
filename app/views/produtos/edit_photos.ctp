<ul>
	<?php
	echo $this->Html->link(
	    $this->Html->image('icon/find.png', array('class' => 'tipHoverBottom', 'title' => 'Visualizar Produto')),
	    '/produtos/view_admin/'.$this->data['Produto']['id'],
	    array('escape' => false)
	);
	echo $this->Html->link(
	    $this->Html->image('icon/page_white_edit.png', array('class' => 'tipHoverBottom', 'title' => 'Editar dados')),
	    '/produtos/edit/'.$this->data['Produto']['id'],
	    array('escape' => false)
	);
	?>
</ul>

Clique nas fotos para visualizar em tamanho real. <br/>
<br/>
<br/>
<?php echo $this->Form->create('Produto', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'produtos', 'action' =>'edit_photos/'.$produto_id), 'class' => 'formulario'));?>
	
	

	<input type="hidden" name='data[Produto][produto_id]' value="<?php echo $produto_id; ?>" />
	<input type='file' name='data[Produto][foto][]' style='width:400px' />
		
	
<?php echo '<button type="submit" class="button2 large2 orange2">Enviar foto</button></form>'; ?>

<br/><br/>
<br/><br/>

<?php 
if(isset($this->data['Foto'])){
	foreach($this->data['Foto'] as $foto){
		?>
		<div style="width:100%;padding-left:20px;padding-bottom:30px" >
			
			<table>
				<tr>
					<td>
						<?php 
						echo $this->Html->link(
						    $this->Html->image('/fotos/'.$foto['nome_img'], array("alt" => "[Imagem]", 'style' => 'max-width:500px')),
						    '/fotos/view/'.$foto['id'],
						    array('escape' => false, 'target' => '_blank')
						);
						?>
					</td>
					<td width="200px" align="right">
						<?php echo $html->link('Remover foto', '/fotos/delete/'.$foto['id'].'/'.$this->data['Produto']['id'], null, 'Tem certeza que deseja excluir esta foto?'); ?>
					</td>
				</tr>
			</table>
		
		</div>
		<?php 
	}
}
?>


