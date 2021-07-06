<?php

class Application_Model_Public extends App_Model_Abstract
{ 
    public function __construct()
    {
    }
    public function registraUser($info)
    {
    	return $this->getResource('Utenti')->registraUser($info);
    }
    public function insertUser($user)
    {
        return $this->getResource('Utenti')->insert($user);
    }
    
    public function getUser($user)
    {
        return $this->getResource('Utenti')->getUser($user);
    }
    public function getFaq()
    {
    	return $this->getResource('Faq')->getFaq();
    }
    public function selectReparti()
    {
    	return $this->getResource('Reparti')->selectReparti();
    }
    public function selectPrestazioni()
    {
    	return $this->getResource('Prestazioni')->selectPrestazioni();
    }
    public function getPrestazioniById($id)
    {
    	return $this->getResource('Prestazioni')->getPrestazioniById($id);
    }
    public function getRepartoById($id)
    {
    	return $this->getResource('Reparti')->getRepartoById($id);
    }
     public function getNomeDescReparto($id)
    {
    	return $this->getResource('Reparti')->getNomeDescReparto($id);
    }
 public function getRepartiIDList()
    {
    	return $this->getResource('Reparti')->getRepartiIDList();
    }
    public function getPrestazioniByIdReparto($idrep)
    {
        return $this->getResource('Prestazioni')->getPrestazioniByIdReparto($idrep);
    }
    public function getPrestazioniByTipo($tipo){
       return $this->getResource('Prestazioni')->getPrestazioniByTipo($tipo); 
    }
    public function getPrestazioniById2($id)
    {
    	return $this->getResource('Prestazioni')->getPrestazioniById2($id);
    }
    
    }