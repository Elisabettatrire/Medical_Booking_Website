<?php

class Application_Form_User_Secondselectform extends App_Form_Abstract
{
    public function init() {
        
        $this->setMethod('post');
        $this->setName('secondselectform');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
  
       
  
        $this->addElement('Select','TipoPresta',array(
            //'value' => '<a class="tipopresta" href="'.$url.'">Scegli il tipo di prestazione</a>',
            'decorators' => $this->elementDecorators,
            'class' => 'tipopresta',
            
        ));

       
         
        
      
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
        
    }

}
  