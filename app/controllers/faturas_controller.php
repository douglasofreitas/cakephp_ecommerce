<?php
class FaturasController extends AppController {
	var $name = 'Faturas';
	function index() {
		$this->Fatura->recursive = 0;
		$this->set('faturas', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fatura', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fatura', $this->Fatura->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Fatura->create();
			if ($this->Fatura->save($this->data)) {
				$this->Session->setFlash(__('The fatura has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fatura could not be saved. Please, try again.', true));
			}
		}
		$pedidos = $this->Fatura->Pedido->find('list');
		$statusfaturas = $this->Fatura->Statusfatura->find('list');
		$moedas = $this->Fatura->Moeda->find('list');
		$this->set(compact('pedidos', 'statusfaturas', 'moedas'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fatura', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Fatura->save($this->data)) {
				$this->Session->setFlash(__('The fatura has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fatura could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fatura->read(null, $id);
		}
		$pedidos = $this->Fatura->Pedido->find('list');
		$statusfaturas = $this->Fatura->Statusfatura->find('list');
		$moedas = $this->Fatura->Moeda->find('list');
		$this->set(compact('pedidos', 'statusfaturas', 'moedas'));
	}
	function delete($id = null) {
            if (!$id) {
                $this->Session->setFlash(__('Invalid id for fatura', true));
                $this->redirect(array('action'=>'index'));
            }
            if ($this->Fatura->delete($id)) {
                $this->Session->setFlash(__('Fatura deleted', true));
                $this->redirect(array('action'=>'index'));
            }
            $this->Session->setFlash(__('Fatura was not deleted', true));
            $this->redirect(array('action' => 'index'));
	}
        function mudar_status_fatura($id = null){
            if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Fatura inválida', true));
                $this->redirect('/pedidos');
            }
            $status_id = $this->data['Fatura']['statusfatura_id'];
            $fatura = $this->Fatura->find('first', array('conditions' => array('Fatura.id' => $id), 
                                                                            'recursive' => '0'));
            $fatura['Fatura']['statusfatura_id'] = $status_id;
            if($this->Fatura->save($fatura)){
                $this->Fatura->Faturahistorico->grava_historico($fatura['Fatura']['id']);
                $this->Session->setFlash(__('Status da fatura modificado', true));
            }else{
                $this->Session->setFlash(__('Não foi possível mudar o status, tente novamente.', true));
            }
            $this->redirect('/pedidos/view_admin/'.$fatura['Fatura']['pedido_id']);
        }
        //----
        //Métodos PAGSEGURO
        //----
        /*
        function retorno_pagseguro(){
            $evento = $_POST;
            $this->layout = null;
            $this->render = null;
            echo "<br/>Teste...<br/>\n";
            //enviar e-mail para admin do sistema - BKP
            if(isset($_POST)){
		$array_mesclagem = array();
		$array_mesclagem['variavel'] = '<pre>'.print_r($_POST, true).'</pre>';
		$this->envia_email('Administrador DF', 'douglas@grupodf.com', 'Retorno PagSeguro' ,'teste_variavel', $array_mesclagem);
            }
            //verificar se é notificação ou transação
            if(!empty($evento['notificationCode'])){
                //notificação
                echo 'Notificação<br/>';
                $this->loadModel('Pagseguronotification');
                $this->Pagseguronotification->verificar_e_save($evento);
            }elseif(!empty($evento['TransacaoID'])){
                //transação
                echo "Transação\n";
                //salvar transação
                $transacao = $this->Pedido->Pagsegurotransacao->verificar_e_save($evento);
                // TODO grupodf: variável ainda não utilizada, pois ainda possui o true na condição
                if ($transacao['Pagsegurotransacao']['verificacao'] == "VERIFICADO" | true){
                    //atualizar status da fatura do pedido
                    $fatura_id = $transacao['Pagsegurotransacao']['fatura_id'];
                    echo "Fatura: $fatura_id\n";
                    echo "Status do pedido (form): ".$transacao['Pagsegurotransacao']['statustransacao']."\n";
                    $novo_statusfatura_id = $this->Pedido->Fatura->Statusfatura->getStatusIdPagseguro($transacao['Pagsegurotransacao']['statustransacao']);
                    echo "Novo Status: $novo_statusfatura_id\n";
                    if(!empty($novo_statusfatura_id)){
                        $fatura = $this->Fatura->find('first', array('conditions' => array('Fatura.id' => $fatura_id, 'Fatura.ativo' => 1), 
                                                                'recursive' => '0'));
                        $pedido = $this->Fatura->Pedido->find('first', array('conditions' => array('Pedido.id' => $fatura['Fatura']['pedido_id']), 
                                                                'recursive' => '1'));
                        echo 'Status atual da fatura: '.$fatura['Fatura']['statusfatura_id']."\n";
                        //verifica se teve mudança de status
                        if($novo_statusfatura_id != $fatura['Fatura']['statusfatura_id']){
                            //verifica se precisa precisa retirar do estoque (status = 7)
                            if($fatura['Fatura']['statusfatura_id'] == 7 & $novo_statusfatura_id != 9){
                                echo "Remover produtos do estoque...";
                                //remover do estoque os produtos do pedido
                                $this->Fatura->Pedido->retiraEstoque($pedido);
                            }
                            //verifica se esta diferente de cancelado/criado e novo status é cancelado, colocar no estoque
                            if($fatura['Fatura']['statusfatura_id'] != 9 & $fatura['Fatura']['statusfatura_id'] != 7 & $novo_statusfatura_id == 9){
                                //coloca produto no estoque
                                echo "Colocar Produto no estoque...";
                                $this->Fatura->Pedido->colocaEstoque($pedido);
                            }
                            //gravar histórico da fatura
                            $faturahistorico = array();
                            $faturahistorico['Faturahistorico'] = $fatura['Fatura'];
                            $faturahistorico['Faturahistorico']['fatura_id'] = $fatura['Fatura']['id'];
                            $this->Fatura->Faturahistorico->create();
                            $this->Fatura->Faturahistorico->save($faturahistorico);
                            //salva novo status da fatura
                            $fatura['Fatura']['statusfatura_id'] = $novo_statusfatura_id;
                            $this->Fatura->create();
                            $this->Fatura->save($fatura);
                            //cria Pagamento da fatura
                            $pagamento = array();
                            $pagamento['Pagamento']['fatura_id'] = $fatura['Fatura']['id'];
                            $pagamento['Pagamento']['valor'] = $transacao['Pagsegurotransacao']['valor_total'];
                            $this->Fatura->Pagamento->create();
                            $this->Fatura->Pagamento->save($pagamento);
                            //atualiza status do pedido
                            $novo_statuspedido_id = $this->Pedido->atualizaStatusByFaturaPagseguro($pedido_id, $novo_statusfatura_id);
                            //envio de e-mails
                            if($novo_statusfatura_id == 6){
                                //pagamento completado, que esta liberado no pagseguro
                                $array_mesclagem = array();
                                $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_responsavel'];
                                $array_mesclagem['pedido'] = $this->Fatura->Pedido->obtemInfo($pedido);
                                $this->envia_email($this->config_sistema['Configuracao']['nome_responsavel'], $this->config_sistema['Configuracao']['email'], 'Pedido '.$pedido['Pedido']['id'].': pagamento PagSeguro concluído' ,'pagseguro_concluido', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                            }
                            if($novo_statusfatura_id == 1){
                                //aguardando pagamento 
                                $array_mesclagem = array();
                                $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_responsavel'];
                                $array_mesclagem['pedido'] = $this->Fatura->Pedido->obtemInfo($pedido);
                                $this->envia_email($this->config_sistema['Configuracao']['nome_responsavel'], $this->config_sistema['Configuracao']['email'], 'Pedido '.$pedido['Pedido']['id'].': aguardando pagamento PagSeguro' ,'pagseguro_analise', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                            }
                            if($novo_statusfatura_id == 4){  //Autorizado
                                //pagamento aprovado, pode mandar pelo correio
                                $array_mesclagem = array();
                                $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_responsavel'];
                                $array_mesclagem['pedido'] = $this->Fatura->Pedido->obtemInfo($pedido);
                                $array_mesclagem['endereco'] = $this->Fatura->Pedido->obtemEndereco($pedido);
                                $this->envia_email($this->config_sistema['Configuracao']['nome_responsavel'], $this->config_sistema['Configuracao']['email'], 'Pedido: pagamento PagSeguro aprovado' ,'pagseguro_aprovado', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                                //enviar e-mail para cliente avisando da autorização
                                $array_mesclagem['nome'] = $pedido['User']['name'];
                                $this->envia_email($pedido['User']['name'], $pedido['User']['email'], 'Pedido: pagamento aprovado' ,'pedido_aprovado_cliente', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                            }
                            if($novo_statusfatura_id == 9){
                                //pagamento cancelado
                                $array_mesclagem = array();
                                $array_mesclagem['nome'] = $this->config_sistema['Configuracao']['nome_responsavel'];
                                $array_mesclagem['pedido'] = $this->Fatura->Pedido->obtemInfo($pedido);
                                $this->envia_email($this->config_sistema['Configuracao']['nome_responsavel'], $this->config_sistema['Configuracao']['email'], 'Pedido '.$pedido['Pedido']['id'].': Pagamento PagSeguro cancelado' ,'pagseguro_cancelado', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                                //enviar e-mail para cliente para notificar do cancelamento
                                $array_mesclagem['nome'] = $pedido['User']['name'];
                                $this->envia_email($pedido['User']['name'], $pedido['User']['email'], 'Pedido: pagamento cancelado' ,'pedido_cancelado_cliente', $array_mesclagem, 'pedido', $pedido['Pedido']['id']);
                            }
                        }
                    }
                }else{
                    // TODO grupodf: erro na verificação, notificar Grupo DF da tentativa de fraude
                }
            }
        }
        */
	function beforeFilter() {
            parent::beforeFilter(); 
            //$this->Auth->allow(array('*'));
            $this->set('nameSession', 'usuario');
	}
}
?>