<?php

class Application_Form_Admin_Analisitipo extends App_Form_Abstract
{
    

    public function init() {
        
        $this->setMethod('post');
        $this->setName('editprestazioni');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
   
 
   
   $this->addElement('text', 'data',array(
            'label' => 'Data Inizio',
             'placeholder'=> 'yyyy-mm-dd',
            'required' =>true,
       'decorators' => $this->elementDecorators,
       'validators' => array(array('date', true, array(
                'yyyy-mm-dd', 
                'messages'  =>  'Formato Invalido!')))));
   
//    $this->addElement('text', 'data1',array(
//            'label' => 'Data Fine',
//             'placeholder'=> 'yyyy-mm-dd',
//            'required' =>true,
//       'decorators' => $this->elementDecorators,
//       'validators' => array(array('date', true, array(
//                'yyyy-mm-dd', 
//                'messages'  =>  'Formato Invalido!')))));
        
        $this->addElement('submit', 'add', array(
            'decorators' => $this->buttonDecorators,
            'class' => 'insertButton',
             'label' => 'Scegli'));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
        
    }

}