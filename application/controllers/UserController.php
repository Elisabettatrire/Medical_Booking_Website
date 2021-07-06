<?php
//use Zend\Mvc\Controller\AbstractActionController;
//use Zend\View\Model\JsonModel;
use Zend\Form\Element;
use Zend\Form\Form;

class UserController extends Zend_Controller_Action
{
    protected $_userModel;
    protected $_form;
    protected $_profilouserForm;

    public function init()
    {
        $this
            ->_helper
            ->layout
            ->setLayout('user');
        $this->_logger = Zend_Registry::get('log');
        $this->_userModel = new Application_Model_User();
        $this->_authService = new Application_Service_Auth();
        $this
            ->view->profilouserForm = $this->getProfilouserForm();
        $this
            ->view->prenotazioneForm = $this->getPrestaForm();
        $this
            ->view->mexForm = $this->getMexForm();
        //                      $contextSwitch = $this->_helper->getHelper('contextSwitch');
        //         $contextSwitch->addActionContext('prestazioniajax', 'json')->initContext();
        //                      $action = $this->_getParam('action');
        //    $this->_helper->getHelper('contextSwitch')
        //         ->addActionContext($action, 'json')
        //         ->initContext();
        

        
    }

    public function indexAction()
    {

        $this
            ->view
            ->headTitle('Home user');
    }
    
    public function cancellaprestaAction()
    {

        //recupero l'id del prodotto da rimuovere
        $id = intval($this
            ->_request
            ->getParam('idprenotazione'));

        if ($id !== 0)
        {
            $this
                ->_userModel
                ->deletePrenotazione($id);

        }

    }

    public function getProfilouserForm()
    {

        $this->_profilouserForm = new Application_Form_User_Profilouser();
        return $this->_profilouserForm;
    }
    public function profiloAction()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity())
        {

            $utente = $auth->getIdentity();
            $id = $this
                ->view
                ->escape(ucfirst($utente->id));
        }
        $utente = $this
            ->_userModel
            ->getUserById2($id);
        $this
            ->view
            ->assign(array(
            'profilo' => $utente
        ));

    }

    public function updateprofiloAction()
    {
        $id = intval($this
            ->_request
            ->getParam('id'));
        if ($id == null)
        {
            $this
                ->_helper
                ->redirector('profilo', 'user');
        }

        //associo l'azione alla form
        $urlHelper = $this
            ->_helper
            ->getHelper('url');
        $this
            ->_profilouserForm
            ->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'modificaprofilo',
            'id' => $id
        ) , 'default'));

        //recupero l'id dell'utente e la associo alla view
        $row = $this
            ->_userModel
            ->getUserById($id);
        foreach ($row as $key => $value)
        {
            $data[$key] = $value;
        }

        //rimuovo i campi che non ci sono nella form e popolo la form
        unset($data['id']);
        $this
            ->_profilouserForm
            ->populate($data);

    }

    public function modificaprofiloAction()
    {
        if (!$this->getRequest()
            ->isPost())
        {
            $this
                ->_helper
                ->redirector('logout', 'user');
        }
        //recupero l'id
        $id = intval($this
            ->_request
            ->getParam('id'));

        $form = $this->_profilouserForm;
        //valida la form
        if (!$form->isValid($_POST))
        {
            $form->setDescription('ATTENZIONE: alcuni dati inseriti sono errati!');

            //riassocio l'azione alla form
            $urlHelper = $this
                ->_helper
                ->getHelper('url');
            $this
                ->_profilouserForm
                ->setAction($urlHelper->url(array(
                'controller' => 'user',
                'action' => 'modificaprofilo',
                'id' => $id
            ) , 'default'));

            //richiamo la pagina dell'inserimento dei dati profilo
            //con return esco dal controller
            return $this->render('updateprofilo');
        }

        //recupero i valori e li inserisco nel db
        $utente = $form->getValues();
        $this
            ->_userModel
            ->updateUser($utente, $id);

    }

    //<----!!INIZIO GESTIONE MESSAGGI!!---->
    public function messaggiAction()
    {
        // Estrazione dati da DB e inserimento in righe della tabella
        

        // Definisce le variabili per il viewer
        //           $mex=$this->_userModel->selectMessaggi();
        //        $this->view->assign(array('messaggi'=> $mex));
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity())
        {

            $user = $auth->getIdentity();
            $id = $this
                ->view
                ->escape(ucfirst($user->id));
        }
        $mex = $this
            ->_userModel
            ->getAllMessaggiByMittente($id);
        $mex2 = $this
            ->_userModel
            ->getAllMessaggiByDestinatario($id);

        $this
            ->view
            ->assign(array(
            'messaggi' => $mex
        ));
        $this
            ->view
            ->assign(array(
            'messagg' => $mex2
        ));

    }
    public function scrivimessaggioAction()
    {

    }
    private function getMexForm()
    {
        $urlHelper = $this
            ->_helper
            ->getHelper('url');
        $this->_formMex = new Application_Form_User_Messaggi();
        $this
            ->_formMex
            ->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'registramex'
        ) , 'default'));
        return $this->_formMex;
    }
    public function registramexAction()
    {
        if (!$this->getRequest()
            ->isPost())
        {
            $this
                ->_helper
                ->redirector('user', 'scrivimessaggio');
        }
        $formMex = $this->_formMex;
        if (!$formMex->isValid($_POST))
        {
            $formMex->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('scrivimessaggio');
        }
        $values = $formMex->getValues();
        $this
            ->_userModel
            ->insertMessaggio($values);
    }

    //<----!!INIZIO GESTIONE PRESTAZIONI!!---->
    public function storicoprestaAction()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity())
        {

            $user = $auth->getIdentity();
            $idpaziente = $this
                ->view
                ->escape(ucfirst($user->id));
        }
        $storico = $this
            ->_userModel
            ->getAllPrenotazioniPaziente($idpaziente);

        $this
            ->view
            ->assign(array(
            'storicopresta' => $storico
        ));

    }


    public function prenotazioneAction()
    {
        $p = $this
            ->_userModel
            ->selectReparti();
        $this
            ->view
            ->assign(array(
            'prenotazione' => $p
        ));
    }

    private function getPrestaForm() {
      
        $this->_formPrenotazione = new Application_Form_User_Prenotazione();
       
        return $this->_formPrenotazione;
    } 
    public function prestazioniAction()
    {
                if (!$this->getRequest()->isPost()){
                     $this->_helper->redirector('prenotazione', 'user');
                 }
        $idrep = intval($this
            ->_request
            ->getParam("id"));
        $urlHelper = $this
            ->_helper
            ->getHelper('url');
        $prestlist = $this
            ->_userModel
            ->getPrestazioniIDList2($idrep);

     
        $formPrenotazione = $this->_formPrenotazione;

        $select = $formPrenotazione->getElement('idprestazione');

        $select->setMultiOptions($prestlist);
      
        $this
            ->_formPrenotazione
            ->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'registraprenotazione',
            'id' => $idrep
            ) , 'default'));
//        return $this->_formPrenotazione;
    }
    public function registraprenotazioneAction()
    {

        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('storicopresta');
        }
        $idrep = intval($this
            ->_request
            ->getParam("id"));
        $formPrenotazione = $this->_formPrenotazione;
        
        // prendo i valori della form
        $values = $formPrenotazione->getValues();
        $values['idprestazione'] = $_POST['idprestazione'];
        // controllo che sia stato passato un id valido
        $listaPrestazioni = $this->_userModel->getPrestazioniIDs($idrep);
        
        if (!$formPrenotazione->isValid($_POST) || !in_array($values['idprestazione'], $listaPrestazioni)) {
            $formPrenotazione->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('prestazioni');
        }
      
        $giorni = ["lunedì" => "monday", "martedì" => "tuesday", "mercoledì" => "wednesday", "giovedì" => "thursday", "venerdì" => "friday","sabato" => "saturday", "domenica" => "sunday" ];
        //dalla prestazione devo trovare il giorno:passo l'id della prestazione al metodo del model che mi estrae il giorno di quella prestazione
        $giornoDalDatabase = $this
            ->_userModel
            ->getPrestazioniByGiorno($values['idprestazione']); //ad es"martedi";

        $dataLibera= null;
        $myDate = date('Y-m-d');
       $numapp=$this->_userModel->getNumAppPresta($values['idprestazione']);

        while( $dataLibera== null){
            $next_monday = date('Y-m-d', strtotime("next " . $giorni[$giornoDalDatabase], strtotime($myDate)));
             $numPrenotazioni=$this->_userModel->getPrenotazioniPerPrestaCount($values['idprestazione'], $next_monday);
             if($numPrenotazioni<$numapp){
                 $dataLibera=$next_monday;
                
             }
             else{
                $myDate= $next_monday;
             }
        }
      
         $values['idreparto']=$idrep;
        $values['data'] = $dataLibera;
       
        print_r($values); 
        $this
            ->_userModel
            ->insertPrenotazione($values);
        
    }

    public function logoutAction()
    {
        $this
            ->_authService
            ->clear();
        return $this
            ->_helper
            ->redirector('index', 'public');
    }


    
}

