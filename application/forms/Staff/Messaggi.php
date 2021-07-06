<?php

class Application_Form_Staff_Messaggi extends App_Form_Abstract
{
    public function init() {
        
        $this->setMethod('post');
        $this->setName('scrivimessaggio');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
   
 $iddestinatario = new Application_Model_Staff();

$iddestinatario_list = $iddestinatario->getDestinatarioIDList();
        
        $this->addElement('hidden', 'mittente', array(
           'value' => '8'
            ));
        
        $this->addElement('select', 'destinatario',array(
            'label' => 'destinatario',
            'required' =>true,
       'decorators' => $this->elementDecorators,
           //multiOption vuole un array di coppie nome-valore che verranno utilizzate come nome e valore per la Option
            'multiOptions' => $iddestinatario_list,
        ));
               // $this->addElement(new Application_Form_Staff_DestinatarioUserSelect('id'));

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
        
        
        $this->addElement('hidden', 'data', array(
           'value' => date('Y-m-d')
            ));
        $this->addElement('hidden', 'orario', array(
           'value' => date('H:m:s')
            ));
        
        //$data=date('Y-m-d');
       //echo $data;
       //echo date('H-m-s');
        //$date->get('YYYY-MM-dd');
        //echo $date;
         //$date = new Zend_Date();
         //echo $date;
        
        $this->addElement('submit', 'add', array(
            'decorators' => $this->buttonDecorators,
            'class' => 'insertstaffButton',
             'label' => 'Invia'));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }

}
