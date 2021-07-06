<?php

class Application_Model_User extends App_Model_Abstract
{ 
    
    public function __construct()
    {
    }
    public function selectMessaggi() {
         
        return $this->getResource('Messaggi')->selectMessaggi();
        
    }
    public function insertMessaggio($mex)
    {
        return $this->getResource('Messaggi')->insertMessaggio($mex);
    }
    public function getAllMessaggiByMittente($id) 
    {
        return $this->getResource('Messaggi')->getAllMessaggiByMittente($id);
    }
    public function getAllMessaggiByDestinatario($id) 
    {
        return $this->getResource('Messaggi')->getAllMessaggiByDestinatario($id);
    }
  
     public function getMessaggioById($id){
         
    return $this->getResource('Messaggi')->getMessaggioById($id);       }

    public function registraUser($user)
    {
        return $this->getResource('Utenti')->insert($user);
    }
    public function getUserForm($id)
    {
        return $this->getResource('Utenti')->insert($id);
    }
    public function getUserByRuolo($ruolo)
    {
        return $this->getResource('Utenti')->getUserByRuolo($ruolo);
    }
     public function getUser($utente)
    {     
        return $this->getResource('Utenti')->getUser($utente);
    }
     public function getUserById($utente)
    {
        return $this->getResource('Utenti')->getUserById($utente);
    }
    public function getUserById2($utente)
    {
        return $this->getResource('Utenti')->getUserById2($utente);
    }
    public function selectUserById($id)
    {
        return $this->getResource('Utenti')->getUserById($id);
    }
    public function getUserByNomeCognome($nome, $cognome)
    {
        return $this->getResource('Utenti')->getUserByNomeCognome($nome, $cognome);
    }
    public function updateUser($utente, $id)
    {
        return $this->getResource('Utenti')->updateUser($utente,$id);
    }
    public function getPrestazioniById($id)
    {
        return $this->getResource('Utenti')->getPrestazioniById($id);
    }
    public function selectPrestazioni()
    {
        return $this->getResource('Utenti')->selectPrestazioni();
    }
     public function getPrestazioniIDList($idrep)
    {
        return $this->getResource('Prestazioni')->getPrestazioniIDList($idrep);
    }
    public function getPrestazioniIDList2($idrep)
    {
        return $this->getResource('Prestazioni')->getPrestazioniIDList2($idrep);
    }
    public function getAllPrenotazioniPaziente($idpaziente)
    {
        return $this->getResource('Utenti')->getAllPrenotazioniPaziente($idpaziente);
    }
    public function deletePrenotazione($id)
    {
        return $this->getResource('Prenotazioni')->deletePrenotazione($id);
    }
    public function getRepartiList()

        {
    return $this->getResource('Reparti')->getRepartiList();
        
        }
        public function getPrestazioniByIdReparto($idrep)
    {
        return $this->getResource('Prestazioni')->getPrestazioniByIdReparto($idrep);
    }
    public function insertPrenotazione($pr)
    {
      return $this->getResource('Prenotazioni')->insertPrenotazione($pr);  
    }
     public function getPrestazioniByGiorno($giorno)
    {
        return $this->getResource('Prestazioni')->getPrestazioniByGiorno($giorno);
    }
    public function getPrenotazioniPerPrestaCount($idprest,$next_monday) {
     return $this->getResource('Prenotazioni')->getPrenotazioniPerPrestaCount($idprest,$next_monday);  
    }
     public function selectReparti()
    {
    	return $this->getResource('Reparti')->selectReparti();
    }
    public function getNumAppPresta($id){
    return $this->getResource('Prestazioni')->getNumAppPresta($id);
    }
    public function getPrestazioniIDs($idrep){
      return $this->getResource('Prestazioni')->getPrestazioniIDs($idrep);  
    }
 }