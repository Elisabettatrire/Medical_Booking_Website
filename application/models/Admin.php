<?php

class Application_Model_Admin extends App_Model_Abstract
{ 

	public function __construct()
    {
    }

    public function getUserById($id)
    {
    	return $this->getResource('Utenti')->getUserById($id);
    }
    public function getUserByName($info)
    {
    	return $this->getResource('Utenti')->getUserByName($info);
    }
    public function updateUser($user, $id)
    {
        return $this->getResource('Utenti')->updateUser($user,$id);
    }
     public function getFaq()
    {
    	return $this->getResource('Faq')->getFaq();
    }
     public function insertFaq($faq)
    {
        return $this->getResource('Faq')->insert($faq);
    }
    public function selectReparti(){
        return $this->getResource('Reparti')->selectReparti();
    }
    public function getUserByRuolo($ruolo)
    {
        return $this->getResource('Utenti')->getUserByRuolo($ruolo);
    }
    public function selectPrestazioni()
    {
         return $this->getResource('Prestazioni')->selectPrestazioni();      
    }
        public function registraUser($user)
    {
        return $this->getResource('Utenti')->insert($user);
    }
    public function insertReparto($rep)
    {
        return $this->getResource('Reparti')->insertReparto($rep);
    }
    public function getRepartoById($id)
    {
    return $this->getResource('Reparti')->getRepartoById($id); 
    }
     public function getRepartiIDList(){
         return $this->getResource('Reparti')->getRepartiIDList();
     }
     public function getMoreUsersByRuolo($ruolo1, $ruolo2){
         return $this->getResource('Utenti')->getMoreUsersByRuolo($ruolo1, $ruolo2);
     }
     public function getNomeReparto($id) {
      return $this->getResource('Reparti')->getNomeReparto($id); 
             
    }
    public function getPrestazioniIDListById()
    {
    return $this->getResource('Prestazioni')->getPrestazioniIDListById(); 
    }
    public function getPrestazioniIDList()
    {
    return $this->getResource('Prestazioni')->getPrestazioniIDList(); 
    }
    public function getPrestazioniById($id)
    {
    return $this->getResource('Prestazioni')->getPrestazioniById($id); 
    }
    public function insertPrestazioni($prestazioni)
    {
        return $this->getResource('Prestazioni')->insertPrestazioni($prestazioni);

    }
    public function deleteUser($id)
    {
       return $this->getResource('Utenti')->deleteUser($id);
    }
     public function deleteReparto($id)
    {
       return $this->getResource('Reparti')->deleteReparto($id);
    }
     public function deleteFaq($id)
    {
        //Fa la SELECT, essendo il risultato una sola riga, faccio fetchRow
        // Elimino poi la riga
        return $this->getResource('Faq')->deleteFaq($id);
    }
    public function deletePrestazioni($id)
    {
        return $this->getResource('Prestazioni')->deletePrestazioni($id);
    }
    public function getFaqById($id)
    {
        return $this->getResource('Faq')->getFaqById($id);
    }
    public function updateFaq($faq, $id)
    {
        return $this->getResource('Faq')->updateFaq($faq,$id);
    }
    public function updatePrestazioni($prestazioni, $id)
    {
        return $this->getResource('Prestazioni')->updatePrestazioni($prestazioni,$id);
    }
    public function updateReparto($reparti, $id)
    {
        return $this->getResource('Reparti')->updateReparto($reparti,$id);
    }
    public function getTipoprestazioneCount($id, $data)
    {
        return $this->getResource('Prenotazioni')->getTipoprestazioneCount($id, $data);
    }
    public function getUtenteprestazioneCount($id, $data)
    {
        return $this->getResource('Prenotazioni')->getUtenteprestazioneCount($id, $data);
    }
     public function getRepartoprestazioneCount($id, $data)
    {
        return $this->getResource('Prenotazioni')->getRepartoprestazioneCount($id, $data);
    }
}