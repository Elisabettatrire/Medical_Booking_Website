<?php

class Application_Form_Public_Searchform extends App_Form_Abstract
{
    protected $_publicModel;
    
    public function init()
    {
        $this->_staffModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('?????');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
    
   
        
        $this->addElement('text','nomereparto', array(
            'label' => 'Scegli un dipartimento:',
            'placeholder' =>'',
             'decorators' => $this->elementDecorators,
            'required'=> true,
            'validators' => '',
            )
    );
        $this->addElement('text','tipoprestazione', array(
            'label' => 'Scegli una prestazione:',
            'placeholder' =>'',
             'decorators' => $this->elementDecorators,
            'required'=> true,
            'validators' => '',
            )
    );
         $this->addElement('submit', 'add', array(
            'decorators' => $this->buttonDecorators,
            'class' => 'insertstaffButton',
             'label' => 'Cerca'));
        
         $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
    
}