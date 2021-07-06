<?php

class Application_Form_Admin_Prestazioni extends App_Form_Abstract
{
    

    public function init() {
        
        $this->setMethod('post');
        $this->setName('insertprestazioni');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
   
 $idreparto = new Application_Model_Admin();

$idreparto_list = $idreparto->getRepartiIDList();
   
   $this->addElement('select', 'idreparto',array(
            'label' => 'idreparto',
            'required' =>true,
       'decorators' => $this->elementDecorators,
           //multiOption vuole un array di coppie nome-valore che verranno utilizzate come nome e valore per la Option
            'multiOptions' => $idreparto_list,
        ));

        $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione della Prestazione',
            'required' => true,
            'decorators' => $this->elementDecorators,
            'filters' => array('StringTrim'),
            ));
        
        $this->addElement('text', 'orario', array (
    'decorators' => $this->elementDecorators,
    'required' => true,
    'label' => 'Orario della prestazione',
    'validators' => array(array('regex' , true, array(
                    'pattern'=> '/(2[0-3]|[01]?[0-9]):([0-5]?[0-9])/'
                ))),
                
));
              
        $this->addElement('text', 'giorno', array(
            'label' => 'Giorno della Prestazione',
            'required' => true,
             'decorators' => $this->elementDecorators,
            'filters' => array('StringTrim'),
            
        ));
             
        $this->addElement('text', 'prescrizioni', array(
            'label' => 'Prescrizioni da Osservare',
            'required' => true,
            'decorators' => $this->elementDecorators,
            'filters' => array('StringTrim'),
            ));

        
        $this->addElement('text', 'tipoprestazione', array(
            'label' => 'Tipologia della Prestazione',
            'required' => true,
            'decorators' => $this->elementDecorators,
            'filters' => array('StringTrim'),
            ));
         $this->addElement('text', 'numapp', array(
            'label' => 'Numero di appuntamenti prenotabili',
            'required' => 'true',
            'decorators' => $this->elementDecorators,
            'filters' => array('StringTrim'),
              'validators' => array(array(
               'Digits',
                'StringLength', true, array(9,10),
                )
              )
            ));

        $this->addElement('submit', 'add', array(
            'decorators' => $this->buttonDecorators,
            'class' => 'insertButton',
             'label' => 'Inserisci'));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
        
    }

}