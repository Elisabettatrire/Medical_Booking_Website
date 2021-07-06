<?php

class Application_Form_User_Prenotazione extends App_Form_Abstract
{
   
    
    public function init() {
        
        $this->setMethod('post');
        $this->setName('Prenotazione');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
     
//       $datetime = new DateTime('tomorrow');
//       $datetime->format('Y-m-d H:i:s');------>NON FUNZIONA....è UN OGGETTO!!!e non si riesce a convertire in stringa...
      // $giorno = date("Y-m-d", strtotime("+1 day"));//questo funziona!
      
     // echo $tomorrow;
       $nomereparto = new Application_Model_User();
       $nomereparto_list = $nomereparto->getRepartiList();
   
        $auth = Zend_Auth::getInstance();
    $userId = $auth->getIdentity()->id;
        
        $this->addElement('hidden', 'idpaziente', array(
           'value' =>  $userId
            ));
//        $this->addElement('hidden', 'data', array(
//           'value' =>  $giorno
//            ));
//        $this->addElement('text', 'data', array(
//           'label' => 'Scegli una data nel formato indicato',
//            'placeholder'=> 'aaaa-mm-gg',
//            'required' =>true,
//       'decorators' => $this->elementDecorators,
//            'validators' => array(array('regex' , true, array(
//                    'pattern'=> '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/'
//                ))),
//            ));
   $this->addElement('select', 'nomereparto',array(
            'label' => 'Nome Dipartimento',
            'required' =>true,
       'decorators' => $this->elementDecorators,
       //'value' => '-- Seleziona --',
           //multiOption vuole un array di coppie nome-valore che verranno utilizzate come nome e valore per la Option
            'multiOptions' => $nomereparto_list,
      
        ));
   
   $this->addElement('select', 'idprestazione[]',array(
            'label' => 'Prestazione erogata',
      // 'disable_inarray_validator' => true,
            'required' =>true,
       'decorators' => $this->elementDecorators,
       'attributes' => array(
            'multiple' => 'multiple',
        ),

        ) );
        //$this->setRegisterInArrayValidator(false);
   
 
 
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
  