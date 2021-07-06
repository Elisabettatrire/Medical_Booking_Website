<?php

class Application_Form_Admin_Reparti extends App_Form_Abstract
{
    
   public function init() {
        
        $this->setMethod('post');
        $this->setName('insertreparti');
        $this->setAction('');
        
        
     



        $this->addElement('text', 'nomereparto', array(
            'label' => 'Nome del reparto',
            'decorators' => $this->elementDecorators,
            'required' => true,
            'autofocus' => true,
            'filters' => array('StringTrim'),
            ));
        
      
        $this->addElement('text', 'recapiti', array(
            'label' => 'Recapito del reparto',
            'decorators' => $this->elementDecorators,
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(array(
               'Digits',
                'StringLength', true, array(9,10),
                )
              )
            ));
        
        $this->addElement('textarea', 'descrizionereparto', array(
            'label' => 'Descrizione del reparto',
            'decorators' => $this->elementDecorators,
            'required' => true,
            'filters' => array('StringTrim'),
            ));
        
        
        
        $this->addElement('submit', 'add', array(
            'class' => 'insertButton',
            'decorators' => $this->buttonDecorators,
             'label' => 'Inserisci'));
        
         $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
//function setPaziente_id($paziente_id)
  //  {
    //    $this->_id = $paziente_id;
    //}
}
