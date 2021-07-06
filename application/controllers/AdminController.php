<?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
	protected $_authService;
	protected $_form;
          protected $_editFaqForm;
          protected $_editUserForm;
          protected $_editPrestaForm;
          protected $_editStaffForm;
           protected $_editRepForm;
          protected $_analisitipoForm;
        protected $_analisiutenteForm;
        protected $_analisirepartoForm;
        
	
	
    public function init()
    {
        // Attivo setLayout di layout passandogli main (viewscript)
    	$this->_helper->layout->setLayout('admin');   	
        $this->_adminModel = new Application_Model_Admin(); 	
        $this->_authService = new Application_Service_Auth(); 
        //Assegno alla variabile locale quella memorizzata nello Zend_Registry
        $this->_logger = Zend_Registry::get('log');
        
        //<----!!Form associate alle viste!!---->
        $this->view->faqForm = $this->getFaqForm();
        $this->view->editFaqForm = $this->getEditFaqForm();
      
        $this->view->editUserForm = $this->getEditUserForm();
        $this->view->staffForm = $this->getStaffForm();
        $this->view->repForm = $this->getRepartiForm();
        $this->view->prestaForm= $this->getPrestaForm();
        $this->view->editPrestaForm = $this->getEditPrestaForm();
        $this->view->editStaffForm = $this->getEditStaffForm();
         $this->view->editRepForm = $this->getEditRepForm();
         $this->view->analisitipoForm = $this->getAnalisitipoForm();
         $this->view->analisiutenteForm = $this->getAnalisiutenteForm();
         $this->view->analisirepartoForm = $this->getAnalisirepartoForm();
        
       
    }

    public function indexAction()
    {}
    
     //<----!!INIZIO GESTIONE REPARTI!!---->
    public function repartiAction(){
     // Estrazione dati da DB e inserimento in righe della tabella
        
        // Definisce le variabili per il viewer
        $reparti=$this->_adminModel->selectReparti();
        $this->view->assign(array('reparti'=> $reparti)); 
        
    }
    public function modificacancellarepAction(){
        $reparti=$this->_adminModel->selectReparti();
        $this->view->assign(array('modificacancellarep' => $reparti));
    }
        
     public function cancellarepAction(){
        //recupero l'id del prodotto da rimuovere
        $id = intval($this->_request->getParam('id'));

        if ($id !== 0) {
            $this->_adminModel->deleteReparto($id);
        }
    }
 
    public function insertnewrepartoAction(){
        
    }
     private function getRepartiForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formRep = new Application_Form_Admin_Reparti();
        $this->_formRep->setAction($urlHelper->url(array(
                        'controller' => 'admin',
                        'action' => 'registrarep'),
                        'default'
                        ));
        return $this->_formRep;
    }
     public function formrepAction()
    {
         
    }
    
    public function registrarepAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('admin','formrep');
        }
	$formRep=$this->_formRep;
        if (!$formRep->isValid($this->getRequest()->getPost())) {
            $formRep->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('insertnewreparto');
        }
        $values = $formRep->getValues();
       	$this->_adminModel->insertReparto($values);
    }
    private function getEditRepForm()
    {
        $this->_editRepForm = new Application_Form_Admin_Repartiedit();
        return $this->_editRepForm;
    }
    public function updaterepAction()
    {
        $this->view->headTitle('Aggiorna Reparto');
        //recupero l'id della faq da modificare
        $id = intval($this->_request->getParam('id'));

        //se l'id non รจ valido ritorno alla lista delle faq da modificare
        if($id == null){
            $this->_helper->redirector('modificacancellarep', 'admin');
        }

        //associo l'azione alla form
        $urlHelper = $this->_helper->getHelper('url');
        $this->_editRepForm->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'modificarep',
            'id' => $id
        ),
            'default'
        ));

        //recupero la faq e la associo alla view
        $row = $this->_adminModel->getRepartoById($id);
        foreach($row as $key=>$value) {
            $vector[$key]=$value;
        }
        
        //rimuovo i campi che non ci sono nella form e popolo la form
        unset($vector['id']);
        $this->_editRepForm->populate($vector);
    }
   
    public function modificarepAction()
    {
        $this->view->headTitle('Aggiorna Reparto');
        //questa azione deve essere richiamata solo da richieste post
        //se non รจ una post faccio il redirect alla index
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('logout', 'admin');
        }

        //recupero l'id
        $id = intval($this->_request->getParam('id'));

        $form = $this->_editRepForm;

        //valida la form
        if (!$form->isValid($_POST)) {
            $form->setDescription('ATTENZIONE: alcuni dati inseriti sono errati!');

            //riassocio l'azione alla form
            $urlHelper = $this->_helper->getHelper('url');
            $this->_editRepForm->setAction($urlHelper->url(array(
                'controller' => 'admin',
                'action' => 'modificarep',
                'id' => $id
            ),
                'default'
            ));
              
            //richiamo la pagina dell'inserimento della faq
            //con return esco dal controller
            return $this->render('updaterep');
        }

        //recupero i valori e li inserisco nel db
        $values = $form->getValues();
        $this->_adminModel->updateReparto($values,$id);
    }
    
    
    //<----!!INIZIO GESTIONE STAFF!!---->
    public function staffAction(){
     $staff=$this->_adminModel->getUserByRuolo('staff');
       
        $this->view->assign(array('staff'=> $staff)); 
    }  
    
    public function modificacancellastaffAction(){
        $staff=$this->_adminModel->getUserByRuolo('staff');
        $this->view->assign(array('modificacancellastaff' => $staff));
    }
        
        public function cancellastaffAction(){
            
        //recupero l'id del prodotto da rimuovere
        $id = intval($this->_request->getParam('id'));

        if ($id !== 0) {
            $this->_adminModel->deleteUser($id);
        }
       
    }
 
        public function insertnewstaffAction(){
        
    }
     private function getStaffForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formStaff = new Application_Form_Admin_Staff();
        $this->_formStaff->setAction($urlHelper->url(array(
                        'controller' => 'admin',
                        'action' => 'registrastaff'),
                        'default'
                        ));
        return $this->_formStaff;
    }
     public function formstaffAction()
    {
    }
    public function registrastaffAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('admin','formstaff');
        }
	$formStaff=$this->_formStaff;
        if (!$formStaff->isValid($this->getRequest()->getPost())) {
            $formStaff->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('insertnewstaff');
        }
        $values = $formStaff->getValues();
        
       	$this->_adminModel->registraUser($values);
    }
    private function getEditStaffForm()
    {
        $this->_editStaffForm = new Application_Form_Admin_Staffedit();
        return $this->_editStaffForm;
    }
    public function updatestaffAction()
    {
        $this->view->headTitle('Aggiorna Staff');
        //recupero l'id della faq da modificare
        $id = intval($this->_request->getParam('id'));

        //se l'id non รจ valido ritorno alla lista delle faq da modificare
        if($id == null){
            $this->_helper->redirector('modificacancellastaff', 'admin');
        }

        //associo l'azione alla form
        $urlHelper = $this->_helper->getHelper('url');
        $this->_editStaffForm->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'modificastaff',
            'id' => $id
        ),
            'default'
        ));

        //recupero la faq e la associo alla view
        $row = $this->_adminModel->getUserById($id);
        foreach($row as $key=>$value) {
            $vector[$key]=$value;
        }
        
        //rimuovo i campi che non ci sono nella form e popolo la form
        unset($vector['id']);
        $this->_editStaffForm->populate($vector);
    }
   
    public function modificastaffAction()
    {
        $this->view->headTitle('Aggiorna Staff');
        //questa azione deve essere richiamata solo da richieste post
        //se non รจ una post faccio il redirect alla index
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('logout', 'admin');
        }

        //recupero l'id
        $id = intval($this->_request->getParam('id'));

        $form = $this->_editStaffForm;

        //valida la form
        if (!$form->isValid($_POST)) {
            $form->setDescription('ATTENZIONE: alcuni dati inseriti sono errati!');

            //riassocio l'azione alla form
            $urlHelper = $this->_helper->getHelper('url');
            $this->_editStaffForm->setAction($urlHelper->url(array(
                'controller' => 'admin',
                'action' => 'modificastaff',
                'id' => $id
            ),
                'default'
            ));
              
            //richiamo la pagina dell'inserimento della faq
            //con return esco dal controller
            return $this->render('updatestaff');
        }

        //recupero i valori e li inserisco nel db
        $values = $form->getValues();
        $this->_adminModel->updateUser($values,$id);
    }
    
    
    //<----!!INIZIO GESTIONE UTENTI!!---->
    public function utentiAction(){
        
        //invece di paziente dovrebbe esserci "user" sul DB!!!!
     $user=$this->_adminModel->getUserByRuolo('user');
       
        $this->view->assign(array('utenti'=> $user));   
    }
    
    public function cancellautenteAction(){
            
        //recupero l'id del prodotto da rimuovere
        $id = intval($this->_request->getParam('id'));

        if ($id !== 0) {
            $this->_adminModel->deleteUser($id);
        }
        }
         private function getEditUserForm()
    {
        $this->_editUserForm = new Application_Form_Admin_Useredit();
        return $this->_editUserForm;
    }
    public function modificacancellautenteAction(){
        $user=$this->_adminModel->getUserByRuolo('user');
        $this->view->assign(array('modificacancellautente' => $user));
    }
   
    public function updateutenteAction(){
        $id = intval($this->_request->getParam('id'));
        if($id == null){
            $this->_helper->redirector('modificacancellautente', 'admin');
          }  
          
         //associo l'azione alla form   
        $urlHelper = $this->_helper->getHelper('url');
        $this->_editUserForm->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'modificautente',
            'id' => $id
        ),
            'default'
        ));

        //recupero l'a faq'utente e la associo alla view
        $row = $this->_adminModel->getUserById($id);
        foreach($row as $key=>$value) {
            $data[$key]=$value;
        }

        //rimuovo i campi che non ci sono nella form e popolo la form
        unset($data['id']);
        $this->_editUserForm->populate($data);
    }
   
    public function modificautenteAction(){
        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('logout', 'admin');
        }
        
         //recupero l'id
        $id = intval($this->_request->getParam('id'));

        $form = $this->_editUserForm;
   //valida la form
        if (!$form->isValid($_POST)) {
            $form->setDescription('ATTENZIONE: alcuni dati inseriti sono errati!');

            //riassocio l'azione alla form
            $urlHelper = $this->_helper->getHelper('url');
            $this->_editUserForm->setAction($urlHelper->url(array(
                'controller' => 'admin',
                'action' => 'modificautente',
                'id' => $id
            ),
                'default'
            ));

            //richiamo la pagina dell'inserimento della faq
            //con return esco dal controller
            return $this->render('updateutente');
        }

        //recupero i valori e li inserisco nel db
        $user = $form->getValues();
        $this->_adminModel->updateUser($user,$id);
    }

    
    
    
    //<----!!INIZIO GESTIONE PRESTAZIONI!!---->
    public function prestazioniAction(){
        
     $prestazioni=$this->_adminModel->selectPrestazioni();
        $this->view->assign(array('prestazioni'=> $prestazioni)); 
        
    }
    public function modificacancellaprestaAction(){
        $prestazioni=$this->_adminModel->selectPrestazioni();
        $this->view->assign(array('modificacancellapresta' => $prestazioni));
    }
    
    private function getPrestaForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formPresta = new Application_Form_Admin_Prestazioni();
        $this->_formPresta->setAction($urlHelper->url(array(
                        'controller' => 'admin',
                        'action' => 'registraprest'),
                        'default'
                        ));
        return $this->_formPresta;
    }
    
    public function registraprestAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('admin','insertnewprestazione');
        }
	$formPresta=$this->_formPresta;
        if (!$formPresta->isValid($_POST)) {
            $formPresta->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('insertnewprestazione');
        }
        $prestazioni = $formPresta->getValues();
       	$this->_adminModel->insertPrestazioni($prestazioni);
    }
    
 public function validateaddprestaAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $addPrestaForm = new Application_Form_Admin_Prestazioni();
        $response = $addPrestaForm->processAjax($_POST);
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
        }
    }
 
    private function getEditPrestaForm()
    {
        $this->_editPrestaForm = new Application_Form_Admin_Prestazioniedit();
        return $this->_editPrestaForm;
    }
    public function updateprestaAction(){
        
        
        $id = intval($this->_request->getParam('id'));
        if($id == null){
            $this->_helper->redirector('modificacancellapresta', 'admin');
          }  
          
         //associo l'azione alla form   
        $urlHelper = $this->_helper->getHelper('url');
        $this->_editPrestaForm->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'modificapresta',
            'id' => $id
        ),
            'default'
        ));


        $row = $this->_adminModel->getPrestazioniById($id);
        foreach($row as $key=>$value) {
            $data[$key]=$value;
        }
      
        //rimuovo i campi che non ci sono nella form e popolo la form
        unset($data['id']);
        $this->_editPrestaForm->populate($data);
    }
   
    public function modificaprestaAction(){
        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('logout', 'admin');
        }
        
         //recupero l'id
        $id = intval($this->_request->getParam('id'));

        $form = $this->_editPrestaForm;
   //valida la form
        if (!$form->isValid($_POST)) {
            

            //riassocio l'azione alla form
            $urlHelper = $this->_helper->getHelper('url');
            $this->_editPrestaForm->setAction($urlHelper->url(array(
                'controller' => 'admin',
                'action' => 'modificapresta',
                'id' => $id
            ),
                'default'
            ));

            //richiamo la pagina dell'inserimento della faq
            //con return esco dal controller
            return $this->render('updatepresta');
        }

        //recupero i valori e li inserisco nel db
        $prestazioni = $form->getValues();
          print_r($prestazioni); die;
        $this->_adminModel->updatePrestazioni($prestazioni,$id);
    }
    
    public function cancellaprestaAction(){
         //recupero l'id del prodotto da rimuovere
        $id = intval($this->_request->getParam('id'));

        if ($id !== 0) {
            $this->_adminModel->deletePrestazioni($id);
        }
    }
    public function modificaprestazioneAction(){
        
    }
    public function insertnewprestazioneAction(){
        
    }
    //<----!!INIZIO GESTIONE FAQ!!---->
    
    public function selectfaqAction(){
        
    }
    public function modificacancellafaqAction(){
        $faq=$this->_adminModel->getFaq();
        $this->view->assign(array('modificacancellafaq' => $faq));
    }
     private function getEditFaqForm()
    {
        $this->_editFaqForm = new Application_Form_Admin_Faqedit();
        return $this->_editFaqForm;
    }
    public function updatefaqAction(){
        
        
        $id = intval($this->_request->getParam('id'));
        if($id == null){
            $this->_helper->redirector('modificacancellafaq', 'admin');
          }  
          
         //associo l'azione alla form   
        $urlHelper = $this->_helper->getHelper('url');
        $this->_editFaqForm->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'modificafaq',
            'id' => $id
        ),
            'default'
        ));

        //recupero la faq e la associo alla view
        $row = $this->_adminModel->getFaqById($id);
        foreach($row as $key=>$value) {
            $data[$key]=$value;
        }

        //rimuovo i campi che non ci sono nella form e popolo la form
        unset($data['id']);
        $this->_editFaqForm->populate($data);
    }
   
    public function modificafaqAction(){
        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('logout', 'admin');
        }
        
         //recupero l'id
        $id = intval($this->_request->getParam('id'));

        $form = $this->_editFaqForm;
   //valida la form
        if (!$form->isValid($_POST)) {
            $form->setDescription('ATTENZIONE: alcuni dati inseriti sono errati!');

            //riassocio l'azione alla form
            $urlHelper = $this->_helper->getHelper('url');
            $this->_editFaqForm->setAction($urlHelper->url(array(
                'controller' => 'admin',
                'action' => 'modificafaq',
                'id' => $id
            ),
                'default'
            ));

            //richiamo la pagina dell'inserimento della faq
            //con return esco dal controller
            return $this->render('updatefaq');
        }

        //recupero i valori e li inserisco nel db
        $faq = $form->getValues();
        $this->_adminModel->updateFaq($faq,$id);
    }

    public function cancellafaqAction(){
        //recupero l'id del prodotto da rimuovere
        $id = intval($this->_request->getParam('id'));

        if ($id !== 0) {
            $this->_adminModel->deleteFaq($id);
        }
    }
    public function insertnewfaqAction(){
        
    }
     public function formfaqAction()
    {
    }
     public function faqAction()
    {
        $faq=$this->_adminModel->getFaq();
        $this->view->assign(array('faq' => $faq));
    }
    
    public function registrafaqAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('admin','insertnewfaq');
        }
	$formFaq=$this->_formFaq;
        if (!$formFaq->isValid($_POST)) {
            $formFaq->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('insertnewfaq');
        }
        $values = $formFaq->getValues();
       	$this->_adminModel->insertFaq($values);
    }
	 private function getFaqForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formFaq = new Application_Form_Admin_Faq();
        $this->_formFaq->setAction($urlHelper->url(array(
                        'controller' => 'admin',
                        'action' => 'registrafaq'),
                        'default'
                        ));
        return $this->_formFaq;
    }
     public function validateaddfaqAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $addFaqForm = new Application_Form_Admin_Faq();
        $response = $addFaqForm->processAjax($_POST);
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
        }
    }
    
   
     //<----!!INIZIO GESTIONE STATISTICHE!!---->
    public function statisticheAction() {
        $users=$this->_adminModel->getUserByRuolo('user');
        $this->view->assign(array('statistiche' => $users));
    }
    public function userselectAction($data){
        $result= $this->_adminModel->getAllPrenotazioniPaziente($data);
        $this->view->assign(array('statistiche' => $result));
    }
    
    public function getAnalisitipoForm()
    {

        $id = intval($this->_request->getParam('id'));
        $urlHelper = $this->_helper->getHelper('url');
        $this->_analisitipoForm = new Application_Form_Admin_Analisitipo();
//        $data=$this->_analisitipoForm->getValues();
//        $data1=$this->_analisitipoForm->getValues();
        $this->_analisitipoForm->setAction($urlHelper->url(array(
                        'controller' => 'admin',
                        'action' => 'risultatotipoprestazione',
                         'id'=> $id
//                        'data'=> $data ,       
//                        'data1'=> $data1
                ),
                        'default'
                        ));
        return $this->_analisitipoForm;
    }

     public function getAnalisiutenteForm()
    {
        $id = intval($this->_request->getParam('id'));
        $urlHelper = $this->_helper->getHelper('url');
        $this->_analisiutenteForm = new Application_Form_Admin_Analisiutente();
        $data=$this->_analisiutenteForm->getValues();
        $this->_analisiutenteForm->setAction($urlHelper->url(array(
                        'controller' => 'admin',
                        'action' => 'risultatoutente',
                         'id'=> $id,
                         'data'=> $data        
//                        'data'=> $data
                ),
                        'default'
                        ));
        return $this->_analisiutenteForm;
    }
     public function getAnalisirepartoForm()
    {
        $id = intval($this->_request->getParam('id'));
        $urlHelper = $this->_helper->getHelper('url');
        $this->_analisirepartoForm = new Application_Form_Admin_Analisiutente();
        $data=$this->_analisirepartoForm->getValues();
        $this->_analisirepartoForm->setAction($urlHelper->url(array(
                        'controller' => 'admin',
                        'action' => 'risultatoreparto',
                         'id'=> $id,
                        'data'=> $data        
//                        'data'=> $data
                ),
                        'default'
                        ));
        return $this->_analisirepartoForm;
    }
    public function prestazioniutenteAction(){
        
    $user=$this->_adminModel->getUserByRuolo('user');
        $this->view->assign(array('prestazioniutente'=> $user)); 
        
    }
    public function analisiutenteAction(){
//         $id = intval($this->_request->getParam('id'));
//        if($id == null){
//            $this->_helper->redirector('statistiche', 'admin');
//            } 
//     $pippo=$this->_adminModel->getUtenteprestazioneCount($id);
//     $this->view->assign("pippo",$pippo);
        
    }
    public function risultatoutenteAction(){
        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('admin','statistiche');
        }
	
      $id = intval($this->_request->getParam('id'));
      $formAnalisi=$this->_analisiutenteForm;
        if (!$formAnalisi->isValid($_POST)) {
            $formAnalisi->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('analisiutente');
        }
     $data = $formAnalisi->getValues();
     $pippo=$this->_adminModel->getUtenteprestazioneCount($id, $data);
     $this->view->assign("pippo",$pippo);
     }
    public function prestazionitipoprestazioneAction(){
        
    $tipo=$this->_adminModel->selectPrestazioni();
        $this->view->assign(array('prestazionitipoprestazione' => $tipo));
        
    }
    public function analisitipoprestazioneAction(){

            }
    
    public function risultatotipoprestazioneAction(){
        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('admin','statistiche');
        }
	
      $id = intval($this->_request->getParam('id'));
      $formAnalisi=$this->_analisitipoForm;
        if (!$formAnalisi->isValid($_POST)) {
            $formAnalisi->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('analisitipoprestazione');
        }
     $data = $formAnalisi->getValues();
//     $data1 = $formAnalisi->getValues();
     $pippo=$this->_adminModel->getTipoprestazioneCount($id, $data);
     $this->view->assign("pippo",$pippo);
   
    }
    
    public function prestazionirepartoAction(){
        
     $reparto=$this->_adminModel->selectReparti();
        $this->view->assign(array('prestazionireparto'=> $reparto)); 
        
    }
    public function analisirepartoAction(){
//      $id = intval($this->_request->getParam('id'));
//        if($id == null){
//            $this->_helper->redirector('statistiche', 'admin');
//            }
//     $pippo=$this->_adminModel->getRepartoprestazioneCount($id);
////     $pippo=$this->_adminModel->getRepartoprestazioneCount1($id);
//     $this->view->assign("pippo",$pippo);
   
    }
    public function risultatorepartoAction(){
        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('admin','statistiche');
        }
	
      $id = intval($this->_request->getParam('id'));
      $formAnalisi=$this->_analisirepartoForm;
        if (!$formAnalisi->isValid($_POST)) {
            $formAnalisi->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('analisireparto');
        }
     $data = $formAnalisi->getValues();
//     $data1 = $formAnalisi->getValues();
     $pippo=$this->_adminModel->getRepartoprestazioneCount($id, $data);
     $this->view->assign("pippo",$pippo);
   

}


}
