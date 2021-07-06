<?php
use Zend\Form\Element;
use Zend\Form\Form;
class StaffController extends Zend_Controller_Action
{	
    

    protected $_logger;
    protected $_authService;
    protected $_staffModel;
    

    public function init()
    {
        $this->_helper->layout->setLayout('staff');
        $this->_logger = Zend_Registry::get('log');
        $this->_staffModel = new Application_Model_Staff();
        $this->_authService = new Application_Service_Auth();
        
        //<----!!Form associate alle viste!!---->
        $this->view->mexForm = $this->getMexForm();
        $this->view->dateForm = $this->getDateForm();
        //$this->view->dateForm = $this->getEditPrenotazioneForm();
    }

    public function indexAction()
    {
        $this->view->headTitle('Home staff');
      
    }
 
    public function storicoAction() {
        
        $prenotazioni=$this->_staffModel->getAllPrenotazioni();
        $this->view->assign(array('storico'=> $prenotazioni));
    }
  
    public function getEditPrenotazioneForm()
    {
        $this->_editPrenotazioneForm = new Application_Form_Staff_Prenotazioneedit();
        return $this->_editPrenotazioneForm;
    }
     
    public function updateprenotazioneAction()
    {
        $id = intval($this->_request->getParam('idprenotazione'));
        if($id == null){
            $this->_helper->redirector('storico', 'staff');
            }
              
            //associo l'azione alla form   
        $urlHelper = $this->_helper->getHelper('url');
        $this->_editPrenotazioneForm->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'modificaprenotazione',
            'idprenotazione' => $id
        ),
            'default'
        ));

        //recupero l'a faq'utente e la associo alla view
        $row = $this->_staffModel->getPrenotazioneById($id);
        foreach($row as $key=>$value) {
            $data[$key]=$value;
        }

        //rimuovo i campi che non ci sono nella form e popolo la form
        unset($data['idprenotazione']);
        $this->_editPrenotazioneForm->populate($data);
    }
    
    
    public function modificaprenotazioneAction(){
        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('logout', 'staff');
        }
        
         //recupero l'id
        $id = intval($this->_request->getParam('idprenotazione'));

        $form = $this->_editPrenotazioneForm;
   //valida la form
        if (!$form->isValid($_POST)) {
            $form->setDescription('ATTENZIONE: alcuni dati inseriti sono errati!');

            //riassocio l'azione alla form
            $urlHelper = $this->_helper->getHelper('url');
            $this->_editPrenotazioneForm->setAction($urlHelper->url(array(
                'controller' => 'staff',
                'action' => 'modificaprenotazione',
                'idprenotazione' => $id
            ),
                'default'
            ));

            //richiamo la pagina dell'inserimento della faq
            //con return esco dal controller
            return $this->render('updateprenotazione');
        }
         //recupero i valori e li inserisco nel db
        $prenotazioni = $form->getValues();
        $this->_staffModel->updatePrenotazione($prenotazioni, $id);
    }
        
        
    
    public function cancellaprenotazioneAction() {
   
        //recupero l'id del prodotto da rimuovere
        $id = intval($this->_request->getParam('idprenotazione'));

        if ($id !== 0) {
            $this->_staffModel->deletePrenotazione($id);
            return $this->render('cancellaprenotazione');
            
        }
        }
 
    
    
    
    
    //<----!!INIZIO GESTIONE AGENDA!!---->
    
    public function agendaAction() {
        
        $pres= $this->_staffModel->selectPrestazioni();
                $this->view->assign(array('agenda'=> $pres));
    }
    
    
    public function prenotazioniAction() {
        //$data=date('Y-m-d');
        
       if (!$this->getRequest()->isPost()){
             $this->_helper->redirector('prenotazioni', 'staff');
         }
        $idpres = intval($this->_request->getParam("id"));
        
       $pr= $this->_staffModel->getPrestazioniById3($idpres);
        $this->view->assign(array('prenotazioni'=>$pr));
              // $this->view->assign(array('prenotazioni'=> $pren));
               
    }
    
    private function getDateForm()
    {
        $idpres = intval($this->_request->getParam("id"));
       $urlHelper = $this->_helper->getHelper('url');
        $this->_formDate = new Application_Form_Staff_Dateform();
    $data= $this->_formDate->getValues();
       
        $this->_formDate->setAction($urlHelper->url(array(
                        'controller' => 'staff',
                        'action' => 'registrapren',
                        'id'=> $idpres,
              // 'data'=> $data
                ),
                        'default'
                        ));
        return $this->_formDate;
    }
    public function registraprenAction()
    {
         $idpres = intval($this->_request->getParam("id"));
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('staff','prenotazioni');
        }
       // phpinfo();die();
         // $values = intval($this->_request->getParam("data"));
	$formDate=$this->_formDate;
        if (!$formDate->isValid($this->getRequest()->getPost())) {
            $formDate->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('prenotazioni');
        }
        $data = $formDate->getValues();
//        print_r($data); die;
         $pren= $this->_staffModel->getPrenotazioniByData($idpres, $data);
               $this->view->assign("registrapren",$pren);
             //  $this->view->assign("pippo",$pippo);
//        return $pren;
        
       
    }
    
    
    
   //<----!!INIZIO GESTIONE MESSAGGI!!---->
    public function messaggiAction() {
     // Estrazione dati da DB e inserimento in righe della tabella
        
        // Definisce le variabili per il viewer
        $mex=$this->_staffModel->selectMessaggi();
        $this->view->assign(array('messaggi'=> $mex));
        
        $user=$this->_staffModel->getUserByRuolo('user');
        $this->view->assign(array('utenti'=> $user));  
    
    }
    public function scrivimessaggioAction(){
       
    }
     private function getMexForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formMex = new Application_Form_Staff_Messaggi();
        $this->_formMex->setAction($urlHelper->url(array(
                        'controller' => 'staff',
                        'action' => 'registramex'),
                        'default'
                        ));
        return $this->_formMex;
    }
    public function registramexAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('staff','scrivimessaggio');
        }
	$formMex=$this->_formMex;
        if (!$formMex->isValid($_POST)) {
            $formMex->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('scrivimessaggio');
        }
        $values = $formMex->getValues();
      
       	$this->_staffModel->insertMessaggio($values);//che azione qui????
    }
	
    

   

    public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
	}
    
}

