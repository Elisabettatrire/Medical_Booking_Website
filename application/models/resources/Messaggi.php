<?php

class Application_Resource_Messaggi extends Zend_Db_Table_Abstract
{
    protected $_name    = 'Messaggi';
    protected $_primary  = 'idmex';
    protected $_rowClass = 'Application_Resource_Messaggi_Item';
    
	public function init()
    {
    }

    public function getMessaggioById($id){
        return $this->fetchRow($this->select()->where('id = ?', $id));
    }
      public function insertMessaggio($mex)
    {
        $this->insert($mex);
    }
    
     public function deleteMessaggio($id)
    {
        $this->delete('id = '.$id);
    }
    
    public function selectMessaggi() {
         $select = $this->select();
        return $this->fetchAll($select);
        
    }
    
    //$data e $ora sono 2 array!
    public function getMessaggiByDateHour($data, $ora) {
        if($data!=NULL && $ora!=NULL){
            $select = $this->select()->where('data = '.$data)
                    ->where('ora = '.$ora);
        }
        else if ($ora===NULL){
             $select = $this->select()->where('data = '.$data);
        }
        else {
            $select = $this->select()->where('ora = '.$ora);
        }
        return $this->fetchAll($select);
    }
    
    //metodo da mettere in utenti?
    
    public function getAllMessaggiByMittente($id) {
        $select= $this->select()
                ->setIntegrityCheck(false)
                 ->from('Messaggi')
                ->join('Utenti', 'Utenti.id=Messaggi.mittente')
                ->where('Messaggi.mittente = ?', $id);
               
        Zend_Registry::get('log')->log($select->__toString(),Zend_Log::DEBUG);
        
       return $this->fetchAll($select);
    }
    public function getAllMessaggiByDestinatario($id) {
        $select= $this->select()
                ->setIntegrityCheck(false)
                 ->from('Messaggi')
                ->join('Utenti', 'Utenti.id=Messaggi.destinatario')
                ->where('Messaggi.destinatario = ?', $id);
               
        Zend_Registry::get('log')->log($select->__toString(),Zend_Log::DEBUG);
        
       return $this->fetchAll($select);
    }
    
   
    
     public function updateMessaggi($values, $id)
    {
        //Fa la SELECT, essendo il risultato una sola riga, faccio fetchRow
        $old = $this->fetchRow($this->select()->where('id = ?', $id));   // (filtro) seleziona l'utente con l'id specificato

        //Aggiorno poi i campi desiderati
        foreach ($values as $key => $value) {
            $old->$key = $value;
        }

        //Aggiorna (UPDATE) la riga nel database con i nuovi valori
        $old->save($old);
    }
}

