<?php

class Application_Form_Admin_Useredit extends App_Form_Abstract
{
   public function init() {
        
        $this->setMethod('post');
        $this->setName('edituser');
        $this->setAction('');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'required' => 'true',
            'placeholder' => 'es. Mario',
            'autofocus' => 'true',
            'filters' => array('StringTrim'),
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'required' => 'true',
            'placeholder' => 'es. Rossi',
            'filters' => array('StringTrim'),
            'decorators' => $this->elementDecorators,
            ));
        
        
        $this->addElement('text', 'telefono', array(
            'label' => 'Numero di telefono',
            'placeholder' => 'es. 333123456',
            'value' => null,
            'filters' => array('StringTrim'),
            'validators' => array(array(
               'Digits',
                'StringLength', true, array(9,10),
                )
              ),
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('text', 'email', array(
            'label' => 'Indirizzo e-mail',
            'required' => 'true',
            'placeholder' => 'es. example@email.it',
            'filters' => array('StringTrim'),
            'validators' => array(
                array('EmailAddress',  true, array(
                    'messages' => 'Email non valida.'
                )),
                array('StringLength',true, array(1,60)),
                ),
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'required' => 'true',
            'decorators' => $this->elementDecorators,
            'filters' => array('StringTrim')));
        
        $this->addElement('text', 'password', array(
            'label' => 'Password',
            'required' => true,
            'filters' => array('StringTrim'),
            'decorators' => $this->elementDecorators,
            'validators'=> array(array('StringLength', true, array(6,25)))
            ));
        
       
//        $this->addElement('password', '', array(
//            'label' => 'Conferma la password',
//            'required' => 'true'));
   //     $this->addElement('hidden', 'ruolo', array(
   //         'value' => 'medico'));
        
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
