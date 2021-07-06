<?php

class Application_Form_Staff_Dateform extends App_Form_Abstract
{
    protected $_staffModel;
    
    public function init()
    {
        $this->_staffModel = new Application_Model_Staff();
        $this->setMethod('post');
        $this->setName('registrapren');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
    
   
        
        $this->addElement('text','data', array(
            'label' => 'Scegli una data nel formato indicato:',
            'placeholder' =>'aaaa-mm-gg',
             'decorators' => $this->elementDecorators,
            'required'=> true,
            'validators' => array(array('regex' , true, array(
                    'pattern'=> '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/'
                ))),
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