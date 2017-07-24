<?php
class CieloLoggerComponent extends Object {
        var $name = 'CieloLogger';
	//called before Controller::beforeFilter()
	function initialize(&$controller, $settings = array()) {
		// saving the controller reference for later use
		$this->controller =& $controller;
	}
	//called after Controller::beforeFilter()
	function startup(&$controller) {
	}
	//called after Controller::beforeRender()
	function beforeRender(&$controller) {
	}
	//called after Controller::render()
	function shutdown(&$controller) {
	}
	//called before Controller::redirect()
	function beforeRedirect(&$controller, $url, $status=null, $exit=true) {
	}
	function redirectSomewhere($value) {
		// utilizing a controller method
		$this->controller->redirect($value);
	}
        private $log_file = "logs/cielo_xml.log";
        private $fp = null;
        public function logOpen()
        {
                $this->fp = fopen($this->log_file, 'a');
        }
        public function logWrite($strMessage, $transacao)
        {
                if(!$this->fp)
                        $this->logOpen();
                $path = $_SERVER["REQUEST_URI"];
                $data = date("Y-m-d H:i:s:u (T)");
                $log = "***********************************************" . "\n";
                $log .= $data . "\n";
                $log .= "DO ARQUIVO: " . $path . "\n"; 
                $log .= "OPERAÇÃO: " . $transacao . "\n";
                $log .= $strMessage . "\n\n"; 
                fwrite($this->fp, $log);
        }
}
?>