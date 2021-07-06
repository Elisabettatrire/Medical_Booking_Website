<?php

class Application_Resource_Reparti extends Zend_Db_Table_Abstract
{
    protected $_name    = 'Reparti';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Reparti_Item';
    
	public function init()
    {
    }
    /*che deve inserire nella tabella faq (quindi il metodo insert prende solo
     * un parametro, l'array con le info da mettere in tabella e non anche
     * il nome della tabella in cui inserirle) lo capisce perche la classe dichiarata
     * è associata alla tabella che ha $_name='FAQ'!!!!
     */
    
    public function getRepartiIDList()

        {

        $select  = $this->select()->from('Reparti',

        array('key' => 'id','value' => 'id'));

        $result = $this->getAdapter()->fetchAll($select);

        return $result;
        }


    
    public function getRepartoById($id) {
        return $this->fetchRow($this->select()->where('id = ?', $id));
    }
    
    //questo metodo serve?
    public function getNomeDescReparto($id) {
        $select = $this->select()
             ->from('Reparti',
                    array('nomereparto', 'descrizione'))
             ->where('id = ?', $id);
        return $this->fetchRow($select);
             
    }
    //public function getNomeReparto($id) {
        //$select = $this->select()
        //     ->from('Reparti',
               //     array('nomereparto'))
            // ->where('id = ?', $id);
      //  return $this->fetchRow($select);
             
    //}
    
//    //questo metodo va in utenti
//    public function getAllMediciReparto($nomerep) {
//        $select = $this->select()
//               ->setIntegrityCheck(false)
//            ->from('Utenti', array ('nome', 'cognome'))
//            ->where('Reparti.nomereparto = ?', $nomerep) 
//            ->join('Reparti', 'Reparti.idmedico = Utenti.id');
//        Zend_Registry::get('log')->log($select->__toString(),Zend_Log::DEBUG);
//        return $this->fetchAll($select);
//    }
     public function insertReparto($rep)
    {
        $this->insert($rep);
    }
    
     public function deleteReparto($id)
    {
        $this->delete('id = '.$id);
    }
    
    public function selectReparti(){
        $select = $this->select()
        ->order('id');
        return $this->fetchAll($select);
    }
    
    public function updateReparto($values, $id)
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
    public function getRepartiList()

        {

        $select  = $this->select()

        ->from('Reparti',

        array('key' => 'id','value' => 'nomereparto'));

        $result = $this->getAdapter()->fetchAll($select);

        return $result;
        }
    
}

