<?php

class Application_Form_Admin_Staffedit extends App_Form_Abstract
{
   public function init() {
        
        $this->setMethod('post');
        $this->setName('editstaff');
        $this->setAction('');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'decorators' => $this->elementDecorators,
            'required' => 'true',
            'placeholder' => 'es. Mario',
            'autofocus' => 'true',
            'filters' => array('StringTrim'),
            ));
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'decorators' => $this->elementDecorators,
            'required' => 'true',
            'placeholder' => 'es. Rossi',
            'filters' => array('StringTrim'),
            ));
        
        
        $this->addElement('text', 'telefono', array(
            'label' => 'Numero di telefono',
            'decorators' => $this->elementDecorators,
            'placeholder' => 'es. 333123456',
            'value' => null,
            'filters' => array('StringTrim'),
            ));
        
        $this->addElement('text', 'email', array(
            'label' => 'Indirizzo e-mail',
            'decorators' => $this->elementDecorators,
            'required' => 'true',
            'placeholder' => 'es. example@email.it',
            'filters' => array('StringTrim'),
            'validators'=> array('EmailAddress')
            ));
        
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'decorators' => $this->elementDecorators,
            'required' => 'true',
            'filters' => array('StringTrim')
            ));
        
        $this->addElement('text', 'password', array(
            'label' => 'Password',
            'decorators' => $this->elementDecorators,
            'required' => 'true',
            'filters' => array('StringTrim'),
            'validators'=> array(array('StringLength', true, array(6,25)))
            ));
        
       
      // $this->addElement('password', '', array(
      //     'label' => 'Conferma la password',
    //       'required' => 'true'));
        $this->addElement('hidden', 'ruolo', array(
            'value' => 'staff'));
        
        $this->addElement('submit', 'add', array(
            'class' => 'insertButton',
            'decorators' => $this->buttonDecorators,
             'label' => 'Modifica'));
        
         $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }

}
