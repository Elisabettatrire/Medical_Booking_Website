<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected $_logger;
	protected $_view;

    protected function _initLogging()
    {
        $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/log/logFile.log');        
        $logger = new Zend_Log($writer);

        Zend_Registry::set('log', $logger);

        $this->_logger = $logger;
    	$this->_logger->info('Bootstrap ' . __METHOD__);
    }

    protected function _initRequest()
	// Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
	// che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
    	// Necessario solo se la Document-root di Apache non è la cartella public/
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }

    protected function _initViewSettings()
    {
        $this->bootstrap('view');
        $this->_view = $this->getResource('view');
        $this->_view->headMeta()->setCharset('UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'it-IT');
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/style.css'));
        $this->_view->headScript()->appendFile('https://code.jquery.com/jquery-1.10.2.js');
        $this->_view->headScript()->appendFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
        $this->_view->headScript()->appendFile($this->_view->baseUrl('js/functions.js'));
        $this->_view->headTitle('Grp_53 TecWeb')
            ->setSeparator(' - ');
        // $this->_view->headScript()->appendFile('http://localhost:8888/test.php');
    }
    
    protected function _initDefaultModuleAutoloader()
    {
    	$loader = Zend_Loader_Autoloader::getInstance();
		$loader->registerNamespace('App_');
        $this->getResourceLoader()
             ->addResourceType('modelResource','models/resources','Resource');  
    }

    protected function _initFrontControllerPlugin()
    {
    	$front = Zend_Controller_Front::getInstance();
    	$front->registerPlugin(new App_Controller_Plugin_Acl());
    }
    
	protected function _initDbParms()
    {
    	include_once (APPLICATION_PATH . '/../../include/connectZP(hospital).php');
		$db = new Zend_Db_Adapter_Pdo_Mysql(array(
    			'host'     => $HOST,
    			'username' => $USER,
    			'password' => $PASSWORD,
    			'dbname'   => $DB
				));  
		Zend_Db_Table_Abstract::setDefaultAdapter($db);
	}
}
$translateValidators = array(
    Zend_Validate_NotEmpty::IS_EMPTY => 'Campo obbligatorio!',
    Zend_Validate_Digits::NOT_DIGITS =>'Solo numeri interi!',
    Zend_Validate_Regex::NOT_MATCH => 'Valore invalido!',
    Zend_Validate_StringLength::TOO_SHORT => 'Min di %min% caratteri.',
    Zend_Validate_StringLength::TOO_LONG => 'Max %max% caratteri.'
);
    $translator = new Zend_Translate('array', $translateValidators);
Zend_Validate_Abstract::setDefaultTranslator($translator);
