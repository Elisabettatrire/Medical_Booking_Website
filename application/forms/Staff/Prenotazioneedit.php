<?php



class Application_Form_Staff_Prenotazioneedit extends App_Form_Abstract
{
    public function init() {
        
        $this->setMethod('post');
        $this->setName('editprenotazione');
        $this->setAction('');
//        $this->setAttrib('enctype', 'multipart/form-data');
       
     

  
   $this->addElement('text', 'data',array(
            'label' => 'Data',
             'placeholder'=> 'yyyy-mm-dd',
            'required' =>true,
       'decorators' => $this->elementDecorators,
       'validators' => array(array('date', true, array(
                'yyyy-mm-dd', 
                'messages'  =>  'Formato Invalido!')))
       //                      array('Db_NoRecordExists', true, array(
//                    'table' => 'Prenotazioni',
//                    'field' => 'data',
//                    'messages' => array(
//                    'recordFound' => "Data gia' prenotata.")))));
       
       
        ));
    $this->addElement('text', 'orario', array (
    'decorators' => $this->elementDecorators,
    'required' => 'true',
    'label' => 'Orario',
    'validators' => array(array('regex' , true, array(
                    'pattern'=> '/(2[0-3]|[01]?[0-9]):([0-5]?[0-9])/'
                ))),
                
));
              
         $this->addElement('text', 'giorno', array(
            'label' => 'Giorno',
            'required' => true,
             'decorators' => $this->elementDecorators,
            'filters' => array('StringTrim'),

 ));
        
        $this->addElement('submit', 'add', array(
            'decorators' => $this->buttonDecorators,
            'class' => 'prenotazionestaffButton',
             'label' => 'Invia'));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
        
    }

}
  