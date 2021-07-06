<?php

class Application_Model_Staff extends App_Model_Abstract
{
    public function __construct()
    {
        //$this->_logger = Zend_Registry::get('log');
    }

    public function selectMessaggi() {
         
        return $this->getResource('Messaggi')->selectMessaggi();
        
    }
    public function getDestinatarioIDList(){
         return $this->getResource('Utenti')->getDestinatarioIDList();
     }
   public function getUserByRuolo($ruolo)
    {
        return $this->getResource('Utenti')->getUserByRuolo($ruolo);
    }
    public function insertMessaggio($mex)
    {
        return $this->getResource('Messaggi')->insertMessaggio($mex);
    }
    public function selectPrestazioni()
    {
    	return $this->getResource('Prestazioni')->selectPrestazioni();
    }
     public function getAllPrenotazioniPaziente($idpaziente)
    {
        return $this->getResource('Utenti')->getAllPrenotazioniPaziente($idpaziente);
    }
    public function selectPrenotazioni() {
                 return $this->getResource('Prenotazioni')->selectPrenotazioni();   
    }
    public function getPrenotazioniByData($idpres, $data){
                 return $this->getResource('Prenotazioni')->getPrenotazioniByData($idpres, $data);   
    }
      public function getPrenotazioneById($id){
      return $this->getResource('Prenotazioni')->getPrenotazioneById($id);
      }  
      public function getPrestazioniById($id)
    {
        return $this->getResource('Utenti')->getPrestazioniById($id);
    }
     public function getPrestazioniById3($idpres)
    {
        return $this->getResource('Prestazioni')->getPrestazioniById3($idpres);
    }
    public function getAllPrenotazioni() {
return $this->getResource('Prenotazioni')->getAllPrenotazioni();
      } 
}