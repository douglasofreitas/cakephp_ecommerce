<?php if(count($produtos_lancamento) > 0): ?>

    <h2>
        Lançamentos
        <?php echo $html->link('Ver mais', '/produtos/filtro?busca_flag=flag&lancamento=1', array('style' => 'float: right;font-size: 14px;color: #945300;margin-top: 5px;text-decoration: underline;')); ?>
    </h2>

    <?php
    echo '<div style="width:100%">';
    foreach ($produtos_lancamento as $produto){
        $this->produtopack->view_produto($produto, $side_bar, $login_group_id);
    }
    echo '<div style="clear:both"></div></div>';
    ?>

<?php endif; ?>


<h2>
    Produtos do site
    <?php echo $html->link('Ver mais', '/produtos/filtro?busca_flag=flag&somente_loja=nao', array('style' => 'float: right;font-size: 14px;color: #945300;margin-top: 5px;text-decoration: underline;')); ?>
</h2>

<?php
echo '<div style="width:100%">';
foreach ($produtos_venda as $produto){
    $this->produtopack->view_produto($produto, $side_bar, $login_group_id);
}
echo '<div style="clear:both"></div></div>';
?>


<h2>
    Produtos no showroom <span style="font-size: 14px">(faça sua encomenda)</span>
    <?php echo $html->link('Ver mais', '/produtos/filtro?busca_flag=flag&somente_loja=sim', array('style' => 'float: right;font-size: 14px;color: #945300;margin-top: 5px;text-decoration: underline;')); ?>
</h2>

<?php
echo '<div style="width:100%">';
foreach ($produtos_showroow as $produto){
    $this->produtopack->view_produto($produto, $side_bar, $login_group_id);
}
echo '<div style="clear:both"></div></div>';
?>