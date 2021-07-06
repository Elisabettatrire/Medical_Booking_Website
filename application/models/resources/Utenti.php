<?php

class Application_Resource_Utenti extends Zend_Db_Table_Abstract
{
    protected $_name    = 'Utenti';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Utenti_Item';

	public function init()
    {
    }
       
    public function selectUser()
    {
        $select = $this->select();
        return $this ->fetchAll($select);        
    }
    public function getUser()
    {
        //Equivalente di SELECT in SQL specificando le clausole che voglio
        $select = $this->select()
            ->order('id');//Ordinate per id
        return $this->fetchAll($select);    //Metodo predefinito che prende in input una SELECT e
        // restituisce tutte le tuple della tabella che soddisfano le condizioni(filtrate)
    }
    
   public function insertUser() {
            return $this->insertUser();
        }	
    
        public function registraUser($user)
    {
        return $this->insert($user);
    }
    public function getUserByName($username)
    {
        return $this->fetchRow($this->select()->where('username = ?', $username));
    }

    public function getUserById($id)
    {
        return $this->fetchRow($this->select()->where('id = ?', $id));
    }
    public function getUserById2($id)
    {
        return $this->fetchAll($this->select()->where('id = ?', $id));
    }

    public function getUserByRuolo($ruolo)
    {
        return $this->fetchAll($this->select()->where('ruolo = ?', $ruolo));
    }
    //non essendoci piu il medico, a sto punto serve questo metodo?
    public function getMoreUsersByRuolo($ruolo1, $ruolo2){
         $selectByRuolo1 = $this->select()
            ->from('Utenti')
            ->where('ruolo = ?', $ruolo1);
        $selectByRuolo2 = $this->select() 
            ->from('Utenti')
            ->where('ruolo = ?', $ruolo2);
        $select = $this->select()
            ->union(array($selectByRuolo1, $selectByRuolo2));
        return $this->fetchAll($select);
    }

    public function getUserByNomeCognome($nome, $cognome) //2 cose insieme
    {
        $selectByName = $this->select()
            ->from('Utenti')
            ->where('nome = ?', $nome);
        $selectByCognome = $this->select() 
            ->from('Utenti')
            ->where('cognome = ?', $cognome);
        $select = $this->select()
            ->union(array($selectByName, $selectByCognome));
        return $this->fetchAll($select);
    }
    public function getUserByNome($nome ) //2 cose insieme
    {
        $selectByName = $this->select()
            ->from('Utenti')
            ->where('nome = ?', $nome);
        return $this->fetchRow($selectByName);
    }
    
    public function getUserBySesso($ruolo, $sesso) //2 cose insieme
    {
        $selectByRuolo = $this->select()
            ->from('Utenti')
            ->where('ruolo = ?', $ruolo);
        $selectBySesso = $this->select() 
            ->from('Utenti')
            ->where('sesso = ?', $sesso);
        $select = $this->select()
            ->union(array($selectByRuolo, $selectBySesso));
        return $this->fetchAll($select);
    }
    //rimuove un utente
    public function deleteUser($id)
    {
        //Fa la SELECT, essendo il risultato una sola riga, faccio fetchRow
        // Elimino poi la riga
        $this->fetchRow($this->select()->where('id = ?', $id))->delete();
    }

    //aggiorna l'user
    public function updateUser($utente, $id)
    {
        //Fa la SELECT, essendo il risultato una sola riga, faccio fetchRow
        $old = $this->fetchRow($this->select()->where('id = ?', $id));   // (filtro) seleziona l'utente con l'id specificato

        //Aggiorno poi i campi desiderati
        foreach ($utente as $key => $value) {
            $old->$key = $value;
        }

        //Aggiorna (UPDATE) la riga nel database con i nuovi valori
        $old->save($old);

    }
    public function getDestinatarioIDList()

        {
  
        $ruolo= 'user';
        $select= $this->select()->from('Utenti',
                    array('key' => 'id','value' => 'id'))->where('ruolo = ?', $ruolo);
        $users = $this->getAdapter()->fetchAll($select);
        
        foreach($users as $key=>$value) {
            $result[$key]=$value;
        }
         unset($result['id']);

        return $result;
        }
        public function getPrestazioniById($id)
    {
        return $this->fetchRow($this->select()->where('id = ?', $id));
    }
     public function selectPrestazioni()
    {
       $select = $this->select()
        ->order('id');
        return $this->fetchAll($select);
    }
    public function getPrestazioniIDList()

        {

        $select  = $this->select()

        ->from('Prestazioni',

        array('key' => 'idreparto','value' => 'idreparto'));

        $result = $this->getAdapter()->fetchAll($select);

        return $result;
        }
       public function getAllPrenotazioniPaziente($idpaziente) {
        $select= $this->select()
                   ->setIntegrityCheck(false)
            ->from('Prenotazioni')
            ->where('Prenotazioni.idpaziente = ?', $idpaziente) 
            ->join('Prestazioni', 'Prestazioni.id  = Prenotazioni.idprestazione')
                ->join('Reparti', 'Reparti.id= Prestazioni.idReparto')
                 ->order('data');
            //->join('Reparti',  'Reparti.id = Prenotazioni.idprenotazione');
        Zend_Registry::get('log')->log($select->__toString(),Zend_Log::DEBUG);
        return $this->fetchAll($select);
        
    }

     public function deletePrenotazione($id)
    {
        $this->delete('idprenotazione = ? '.$id);
    }
   
}


