<?php

class Application_Resource_Prenotazioni extends Zend_Db_Table_Abstract
{
    protected $_name    = 'Prenotazioni';
    protected $_primary  = 'idprenotazione';
    protected $_rowClass = 'Application_Resource_Prenotazioni_Item';
    
	public function init()
    {
    }

  public function getPrenotazioneById($id){
        return $this->fetchRow($this->select()->where('id = ?', $id));
    }
    public function getPrenotazioniByData($idpres, $data){
        
     
        $select= $this->select()
                   ->setIntegrityCheck(false)
            ->from(array('pn'=>'Prenotazioni'))
           ->joinLeft(array('ut' => 'Utenti'),  'ut.id = pn.idpaziente')
           ->joinRight(array('pr' => 'Prestazioni'), 'pr.id =pn.idprestazione ')
           
                  ->where('pn.data=?',$data)
                 ->where('pr.id=?',$idpres);
                
        Zend_Registry::get('log')->log($select->__toString(),Zend_Log::DEBUG);
        return $this->fetchAll($select);
        
    
        //return $this->fetchAll($this->select()->where('data = ?', $data));
    }
      public function insertPrenotazione($pr)
    {
        $this->insert($pr);
    }
    
     public function deletePrenotazione($id)
    {
        $this->delete('idprenotazione = '.$id);
    }
  
    
    public function selectPrenotazioni() {
         $select = $this->select();
        return $this->fetchAll($select);
        
    }
     public function updatePrenotazione($values, $id)
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
    
    //metodo che va in prestazioni??? ...rivedere se corretto...
   // public function getAllPrenotazioniPaziente($idpaziente) {
        //$select= $this->select()
        //           ->setIntegrityCheck(false)
          //  ->from('Prenotazioni')
           // ->where('Prenotazioni.idpaziente = ?', $idpaziente) 
           // ->join('Prestazioni', 'Prestazioni.id = Prenotazioni.idprestazione');
            //  ->join('Reparti', 'Reparti.id= Prestazioni.idReparto');
            //->join('Reparti',  'Reparti.id = Prenotazioni.id');
        //Zend_Registry::get('log')->log($select->__toString(),Zend_Log::DEBUG);
        //return $this->fetchAll($select);
        
    //}
    
    public function getTipoprestazioneCount($id, $data){
//        $from_date = date('Y-m-d', strtotime($data->from_date ));
//        $to_date = date('Y-m-d', strtotime($data->to_date ));
//
//  $select->where->between('Prenotazioni.data', $from_date . ' 00:00:00', $to_date . ' 23:59:59');
        
//        $start = new Zend_Date($start);
//        $end = new Zend_Date($end);
        $checkquery = $this->select()
                ->setIntegrityCheck(false)
                ->from("Prenotazioni", array("num"=>"COUNT(*)"))
                ->where("Prenotazioni.idprestazione = ? ", $id)
                ->where("Prenotazioni.data = ?", $data);
//                ->where("Prenotazioni.data1 = ?", $data1);
//                 ->where('Prenotazioni.data', $data . ' 00:00:00', $data1 . ' 23:59:59');


         $checkrequest = $this->fetchRow($checkquery);
         return $checkrequest["num"]; 
         
         //echo 'Il numero di prestazioni erogato per la prestazione selezionata è '. $checkrequest["num"];
 }
 public function getUtenteprestazioneCount($id, $data){
         
        $checkquery = $this->select()
                ->from("Prenotazioni", array("num"=>"COUNT(*)"))
                ->where("Prenotazioni.idpaziente = ? ", $id)
                ->where("Prenotazioni.data = ?", $data);


         $checkrequest = $this->fetchRow($checkquery);
         return $checkrequest["num"];
//         echo 'Il numero di prestazioni erogato per lo user selezionato è '. $checkrequest["num"];
 }
 public function getRepartoprestazioneCount($id, $data){
         
        $checkquery = $this->select()
                ->from("Prenotazioni",  array("num"=>"COUNT(*)"))
                ->where('Prenotazioni.idreparto = ?', $id)
                ->where("Prenotazioni.data = ?", $data);
                
         $checkrequest = $this->fetchRow($checkquery);
        return $checkrequest["num"];
//         echo 'Il numero di prestazioni erogato per il reparto selezionato è '. $checkrequest["num"];
}
public function getPrenotazioniPerPrestaCount($idprest,$next_monday) {
    //conta il numero di prenotazioni per quella data per quella prestazione
  
    $query = $this->select()
                ->from("Prenotazioni",  array("num"=>"COUNT(*)"))
                ->where('Prenotazioni.idprestazione = ?', $idprest)
                ->where("Prenotazioni.data = ?", $next_monday);
    $numero= $this->fetchRow($query);
return $numero["num"];
}
public function getAllPrenotazioni() {
        $select= $this->select()
                  ->setIntegrityCheck(false)
            ->from('Prenotazioni')
            //->where('Prenotazioni.idprenotazione = ?') 
            ->join('Prestazioni', 'Prestazioni.id  = Prenotazioni.idprestazione')
             ->join('Reparti', 'Reparti.id= Prestazioni.idReparto')
            ->join('Utenti',  'Utenti.id = Prenotazioni.idpaziente');
        Zend_Registry::get('log')->log($select->__toString(),Zend_Log::DEBUG);
        return $this->fetchAll($select);
        
    }
    
    
    
}

