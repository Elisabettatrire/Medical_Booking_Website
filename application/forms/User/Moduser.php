<?php

class Application_Form_User_Moduser extends App_Form_Abstract
{
    protected $_userModel;
    
    public function init()
    {
        $this->_userModel = new Application_Model_User();
        $this->setMethod('post');
        $this->setName('modprofuser');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
    }
    
    public function setValues($values){
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'value' => $values['nome'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alpha',array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
		));
        
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'value' => $values['cognome'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alpha',array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('select', 'genere', array(
            'label' => 'Genere',
            'value' => $values['genere'],
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                        'M' => 'Maschio',
                        'F' => 'Femmina',
                        ),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'natoil', array(
            'label' => 'Nato il ',
             'class' => 'datepicker',
            'value' => $values['natoil'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('date', false, array('yyyy/MM/dd'))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'email', array(
            'label' => 'Email',
            'value' => $values['email'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('EmailAddress',array('StringLength',true, array(1,30))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('password', 'password', array(
            'label' => 'Password',
            'value' => $values['password'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(1,15))),
            'decorators' => $this->elementDecorators,
		));
         
        $this->addElement('hidden', 'username', array(
            'value' => $values['username'],
            
            ));
        
        $this->addElement('hidden', 'ruolo', array(
            'value' => $values['ruolo'],
            
            ));
        
        $this->addElement('submit', 'modifica', array(
            'label' => 'Salva Modifiche',
            'decorators' => $this->buttonDecorators,
		)); 
        $this->addElement('hidden', 'id_U', array(
            'value' => $values['id_U'],));
        
        $this->setDecorators(array(
			'FormElements',
			array('HtmlTag', array('tag' => 'table')),
			array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
			'Form'
		));
    }
    
}