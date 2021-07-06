<?php

class Application_Form_Admin_Faqedit extends App_Form_Abstract
{
    public function init() {
        
        $this->setMethod('post');
        $this->setName('editfaq');
        $this->setAction('');
        
        $this->addElement('textarea', 'domanda', array(
            'label' => 'Domanda',
        	'cols' => '100', 'rows' => '5',
            'filters' => array('StringTrim'),
            'required' => true,
            'decorators' => $this->elementDecorators,
            'validators' => array(array('StringLength',true, array(1,2500)))
            
        ));
        
        $this->addElement('textarea', 'risposta', array(
            'label' => 'Risposta',
        	'cols' => '100', 'rows' => '10',
            'filters' => array('StringTrim'),
            'required' => true,
            'decorators' => $this->elementDecorators,
            'validators' => array(array('StringLength',true, array(1,2500)))
        ));
        
        $this->addElement('submit', 'add', array(
            'decorators' => $this->buttonDecorators,
            'class' => 'insertButton',
             'label' => 'Modifica'));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }

}

