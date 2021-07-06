<?php

class Application_Form_User_Prenotazione extends App_Form_Abstract
{
   
    
    public function init() {
        
        $this->setMethod('post');
        $this->setName('Prenotazione');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
//     
//if (!$this->getRequest()->isPost()){
//             $this->_helper->redirector('prenotazione', 'user');
//         }
//        $idrep = intval($this->_request->getParam("id"));
//       $prest = new Application_Model_User();
//       $prestlist = $prest->getPrestazioniByIdReparto($idrep);
   
        $auth = Zend_Auth::getInstance();
    $userId = $auth->getIdentity()->id;
        
        $this->addElement('hidden', 'idpaziente', array(
           'value' =>  $userId
            ));

   $this->addElement('select', 'idprestazione',array(
            'label' => 'Nome della prestazione',
            'required' =>true,
       'filters' => array('StringTrim'),
       'registerInArrayValidator' =>false,
       'decorators' => $this->elementDecorators,
       //'value' => '-- Seleziona --',
           //multiOption vuole un array di coppie nome-valore che verranno utilizzate come nome e valore per la Option
           // 'multiOptions' => $prestlist,
      
        ));
   
 $this->addElement('submit', 'add', array(
            'class' => 'insertuserButton',
            'decorators' => $this->buttonDecorators,
             'label' => 'Prenota'));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
        
    }

}
  