<?php

class Application_Form_User_Messaggi extends App_Form_Abstract
{
    public function init() {
        
        $this->setMethod('post');
        $this->setName('scrivimessaggio');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
   $auth = Zend_Auth::getInstance();
    $userId = $auth->getIdentity()->id;
        
        $this->addElement('hidden', 'mittente', array(
           'value' =>  $userId
            ));
        
        $this->addElement('hidden', 'destinatario',array(
            'value' => '8'
        ));
               
        $this->addElement('textarea', 'messaggio', array(
            'label' => 'Testo del messaggio',
        	'cols' => '100', 'rows' => '5',
            'filters' => array('StringTrim'),
            'required' => true,
            'autofocus'  => true,
            'decorators' => $this->elementDecorators,
            'placeholder' => 'Inserisci il testo del messaggio',
            'validators' => array(array('StringLength',true, array(1,2500)))
            
        ));
        
         $date = new Zend_Date();
       
   $time = $date->get(Zend_Date::TIME_MEDIUM);
  
        $this->addElement('hidden', 'data', array(
           'value' => date('Y-m-d')
            ));
        $this->addElement('hidden', 'orario', array(
           'value' => $time
            ));
        
        //$data=date('Y-m-d');
       //echo $data;
       //$datetime = new DateTime('tomorrow');
       //echo $datetime->format('Y-m-d');
        //date_default_timezone_set('Europe/Rome');
       //echo date('H-m-s');
        //$date->get('YYYY-MM-dd');
        //echo $date;
         //$date = new Zend_Date();
         //echo $date;
         
        
        $this->addElement('submit', 'add', array(
            'decorators' => $this->buttonDecorators,
            'class' => 'insertuserButton',
             'label' => 'Invia'));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }

}
