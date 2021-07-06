<?php
class PublicController extends Zend_Controller_Action
{
	protected $_publicModel;
	protected $_authService;
	protected $_form;
        protected $_redirector;

	
    public function init()
    {
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->_publicModel = new Application_Model_Public();
        $this->view->loginForm = $this->getLoginForm();
        $this->view->userForm = $this->getUserForm();
        
    }
        public function indexAction()   
                { }
                
   
    public function registraAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index','public');
        }
	$formReg=$this->_formReg;
        if (!$formReg->isValid($_POST)) {
            return $this->render('registrazione');
        }
        $values = $formReg->getValues();
       	$this->_publicModel->registraUser($values);
        }
        public function validateuserAction() 
    {
        $this->_helper->getHelper('layout')->disableLayout();
    		$this->_helper->viewRenderer->setNoRender();

        $userform = new Application_Form_Public_User();
        $response = $userform->processAjax($_POST); 
        if ($response !== null) {
        	   $this->getResponse()->setHeader('Content-type','application/json')->setBody($response);        	
        }
    }
    
     private function getUserForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formReg = new Application_Form_Public_User();
        $this->_formReg->setAction($urlHelper->url(array(
                        'controller' => 'public',
                        'action' => 'registra'),
                        'default'
                        ));
        return $this->_formReg;
    }
    
    	
     public function insertUser() {
            
        }	
   
    public function viewstaticAction () {
    	$page = $this->_getParam('staticPage');
    	$this->render($page);
         if($page=='faq')
             {
             $faq=$this->_publicModel->getFaq();
        $this->view->assign(array('faq' => $faq));
        }
        }
             
    
    public function loginAction()
    { 
        $this->view->headTitle('Login');
    
    }

    public function authenticateAction()
	{        
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('login');
        }
        $form = $this->_form;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
        	return $this->render('login');
        }
        if (false === $this->_authService->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->ruolo);
	}

	// Validazione AJAX
	public function validateloginAction() 
    {
        $this->_helper->getHelper('layout')->disableLayout();
    		$this->_helper->viewRenderer->setNoRender();

        $loginform = new Application_Form_Public_Auth_Login();
        $response = $loginform->processAjax($_POST); 
        if ($response !== null) {
        	   $this->getResponse()->setHeader('Content-type','application/json')->setBody($response);        	
        }
    }
	
	private function getLoginForm()
    {
    	$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Public_Auth_Login();
    	$this->_form->setAction($urlHelper->url(array(
			'controller' => 'public',
			'action' => 'authenticate'),
			'default'
		));
		return $this->_form;
    } 
    public function formfaqAction()
    {
    }
     public function faqAction()
    {
        $faq=$this->_publicModel->getFaq();
        $this->view->assign(array('faq' => $faq));
    }
     
    
     //<----!!INIZIO GESTIONE PRESTAZIONI!!---->
    public function servicesAction()
    {
//        $IDlist = $this->_publicModel->getRepartiIDList();
//        foreach ($IDlist as $key=>$id) {
//            $dipartimenti[$key]=$id;
//            $this->_publicModel->getRepartoById($id);  
//        }
         $dipartimenti=$this->_publicModel->selectReparti();
        $this->view->assign(array('services' => $dipartimenti));
        
         //$IDList= $this->_publicModel->getRepartiIDList();
//         foreach($IDList as $key=>$value){
//             echo '..'.$value['value'];
//         }
       // $this->view->assign(array('ids'=> $IDList));
        
       

        
    }
     public function prestazioniAction(){
         if (!$this->getRequest()->isPost()){
             $this->_helper->redirector('services', 'public');
         }
        $idrep = intval($this->_request->getParam("id"));
    $prest= $this->_publicModel->getPrestazioniByIdReparto($idrep);
                $this->view->assign(array('prestazioni'=> $prest));
                
                $rep= $this->_publicModel->getRepartoById($idrep);
                
        $this->view->assign(array('prestaz'=> $rep));
//          $prest= $this->_publicModel->selectPrestazioni();
//                $this->view->assign(array('prestazioni'=> $prest));
    }
    public function dettagliAction() {
        if (!$this->getRequest()->isPost()){
            $this->_helper->redirector('prestazioni', 'public');
         }
      $idprest = intval($this->_request->getParam("id"));
      $det= $this->_publicModel->getPrestazioniById2($idprest);
               
       $this->view->assign(array('dettagli'=> $det));
    }
    
     //<----!!INIZIO GESTIONE RICERCA!!---->
   public function redirectorurlcercaAction()
    {
        $request = $this->getRequest();

        //arrivata una richiesta di cerca
        if ($request->isPost()) {
            $post = $request->getPost();
            $query = $post['query'];
            $this->_redirector = $this->_helper->getHelper('Redirector');

            $this->_redirector->gotoSimple('cerca',
                'public',
                null,
                array('query' => $query));
        }
    }
   
   
   
    

 }