<?php
class Pagseguronotification extends AppModel {
	var $name = 'Pagseguronotification';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	function verificar_e_save($evento){
            if(!empty($evento['notificationCode'])){
                $notificacao = array();
                $notificacao['id'] = $evento['notificationCode'];
                $notificacao['notificationtype'] = $evento['notificationType'];
                $this->save($notificacao);
                return true;
            }else{
                return false;
            }
        }
}
?>