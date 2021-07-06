<?php

class Application_Form_Public_User extends App_Form_Abstract
{
    public function init() {
        
        $this->setMethod('post');
        $this->setName('registrazione');
        $this->setAction('');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome*',
            'required' => 'true',
            'placeholder' => 'es. Mario',
            'autofocus' => 'true',
            'filters' => array('StringTrim'),
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome*',
            'required' => 'true',
            'placeholder' => 'es. Rossi',
            'filters' => array('StringTrim'),
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('radio', 'sesso', array(
            'label' => 'Sesso*',
            'MultiOptions' => array('M' => 'Maschio', 'F' => 'Femmina'),
            'value' => 'M',
            'decorators' => $this->elementDecorators,
            'required' => 'true'));
        
        $this->addElement('text', 'telefono', array(
            'label' => 'Numero di telefono',
            'placeholder' => 'es. 333123456',
            'value' => null,
            'required' => 'true',
            'filters' => array('StringTrim'),
            'decorators' => $this->elementDecorators,
            'validators' => array(array(
               'Digits',
                'StringLength', true, array(9,10),
                )
              )
            ));
        
        $this->addElement('text', 'email', array(
            'label' => 'Indirizzo e-mail*',
            'required' => 'true',
            'placeholder' => 'es. example@email.it',
            'filters' => array('StringTrim'),
            'decorators' => $this->elementDecorators,
            'validators' => array(
                array('EmailAddress',  true, array(
                    'messages' => 'Email non valida.'
                )),
                array('StringLength',true, array(1,60)),
                array('Db_NoRecordExists', true, array(
                    'table' => 'Utenti',
                    'field' => 'email',
                    'messages' => array(
                        'recordFound' => "Email gia' esistente."
                    ))))
            ));
        
        $this->addElement('text', 'username', array(
            'label' => 'Username*',
            'required' => 'true',
            'decorators' => $this->elementDecorators,
            'filters' => array('StringTrim')));
        
        $this->addElement('password', 'password', array(
            'label' => 'Password*',
            'required' => 'true',
            'filters' => array('StringTrim'),
            'decorators' => $this->elementDecorators,
            'validators'=> array(array('StringLength', true, array(6,25)))
            ));
        
       
//        $this->addElement('password', '', array(
//            'label' => 'Conferma la password',
//            'required' => 'true'));
        $this->addElement('hidden', 'ruolo', array(
            'value' => 'user'));
        
        $this->addElement('submit', 'add', array(
             'label' => 'REGISTRATI'));
    
    $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
        	array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
    ));}

}
