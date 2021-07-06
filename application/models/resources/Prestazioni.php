<?php

class Application_Resource_Prestazioni extends Zend_Db_Table_Abstract
{
    protected $_name	 = 'Prestazioni';
    protected $_primary	 = 'id';
    protected $_rowClass = 'Application_Resource_Prestazioni_Item';
    
    public function init()
    {
    }
    
    public function selectPrestazioni()
    {
       $select = $this->select()
        ->order('idreparto');
        return $this->fetchAll($select);
    }
    
    public function insertPrestazioni($prestazioni)
    {
        $this->insert($prestazioni);
    }
    
    public function getPrestazioniById($id)
    {
        return $this->fetchRow($this->select()->where('id = ?', $id));
    }
    public function getPrestazioniById2($id)
    {
         $select= $this->select()
                   ->setIntegrityCheck(false)
            ->from('Prestazioni')
            
            ->join('Reparti', 'Reparti.id = Prestazioni.idreparto ')
                 ->where('Prestazioni.id = ?', $id);
          
        Zend_Registry::get('log')->log($select->__toString(),Zend_Log::DEBUG);
        return $this->fetchAll($select);
        
    }
     public function getPrestazioniById3($idpres)
    {
        return $this->fetchAll($this->select()->where('id = ?', $idpres));
    }
    
    public function getPrestazioniByTipo($tipo)
    {
       return $this->fetchRow($this->select()->where('tipoprestazione = ?', $tipo));
    }
    
    public function getPrestazioniByReparti($reparto)
    {
        return $this->fetchRow($this->select()->where('idreparto = ?', $reparto)); 
    }
    
    public function getPrestazioniByPrescrizioni($prescriz)
    {
        return $this->fetchRow($this->select()->where('prescrizioni = ?', $prescriz));
    }
    
    public function getPrestazioniByDescrizione($desc)
    {
        return $this->fetchRow($this->select()->where('descrizione = ?', $desc));
    }
    
    public function getPrestazioniByOra($ora)
    {
        return $this->fetchRow($this->select()->where('orario = ?', $ora));
    }
    
    public function getPrestazioniByGiorno($id)
    {
        $day= $this->fetchRow($this->select()->where('id = ?', $id))->toArray();
        return $day['giorno'];
    }
    
    public function deletePrestazioni($id)
    {
        $this->fetchRow($this->select()->where('id = ?', $id))->delete();
    }
    
    //aggiorna le Prestazioni
    public function updatePrestazioni($values, $id)
    {
        //Fa la SELECT, essendo il risultato una sola riga, faccio fetchRow
        $old = $this->fetchRow($this->select()->where('id = ?', $id));   // (filtro) seleziona la prestazione con l'id specificato

        //Aggiorno poi i campi desiderati
        foreach ($values as $key => $value) {
            $old->$key = $value;
        }

        //Aggiorna (UPDATE) la riga nel database con i nuovi valori
        $old->save($old);
    }
    public function getPrestazioniIDList()

        {

        $select  = $this->select()

        ->from('Prestazioni',

        array('key' => 'idreparto','value' => 'idreparto'));

        $result = $this->getAdapter()->fetchAll($select);

        return $result;
        }
        public function getPrestazioniIDs($idrep)

        {

        $select  = $this->select()

        ->from('Prestazioni',

        array('id'))
                ->where('idreparto= ?',$idrep);;

        $result = $this->getAdapter()->fetchAll($select);
        
        $ids_array = array(); 
        foreach ($result as $current ){ 
            array_push($ids_array, $current['id']);
        }
        
        return $ids_array;
        }
    public function getPrestazioniIDList2($idrep)

        {

        $select  = $this->select()

        ->from('Prestazioni',

        array('key' => 'id','value' => 'tipoprestazione'))
                ->where('idreparto= ?',$idrep);

        $result = $this->getAdapter()->fetchAll($select);

        return $result;
        }
//    public function getPrestazioniByIdReparto($idrep)
//    {
//        $select=$this->fetchAll($this->select()->where('idreparto = ?', $idrep))->toArray();
//        return $select;
//    }
    public function getPrestazioniByIdReparto($idrep)
    {
        return $this->fetchAll($this->select()->where('idreparto = ?', $idrep));
    }
    public function getNumAppPresta($id)
    {
        $num= $this->fetchRow($this->select()->where('id = ?', $id))->toArray();
        return $num['numapp'];
    }
    
    }
    