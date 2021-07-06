
<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name = 'FAQ';
    protected $_primary = 'id';
    protected $_rowClass = 'Application_Resource_Faq_Item';

    public function init()
    {
    }
    
    
    public function insertFaq($faq)
    {
        $this->insert($faq);
    }

    // Estrae tutte le faq
    public function getFaq()
    {
        //Equivalente di SELECT in SQL specificando le clausole che voglio
        $select = $this->select()
            ->order('id');//Ordinate per id
        return $this->fetchAll($select);    //Metodo predefinito che prende in input una SELECT e
        // restituisce tutte le tuple della tabella che soddisfano le condizioni(filtrate)
    }
    
    public function getFaqById($id)
    {
        //Usa una SELECT con una clausola where
        //fetchRow: estrae SOLO la prima riga della select (se ha trovato qualcosa)
        return $this->fetchRow($this->select()->where('id = ?', $id));
    }
    
    public function getFaqByName($name)
    {
       //Usa una SELECT con una clausola where
        //fetchRow: estrae SOLO la prima riga della select (se ha trovato qualcosa)
        return $this->fetchRow($this->select()->where('id = ?', $name));
    }

    //rimuove una faq
    public function deleteFaq($id)
    {
        //Fa la SELECT, essendo il risultato una sola riga, faccio fetchRow
        // Elimino poi la riga
        $this->fetchRow($this->select()->where('id = ?', $id))->delete();
    }

    //aggiorna la faq
    public function updateFaq($faq, $id)
    {
        //Fa la SELECT, essendo il risultato una sola riga, faccio fetchRow
        $old = $this->fetchRow($this->select()->where('id = ?', $id));   // (filtro) seleziona la faq con l'id specificato

        //Aggiorno poi i campi desiderati
        foreach ($faq as $key => $value) {
            $old->$key = $value;
        }

        //Aggiorna (UPDATE) la riga nel database con i nuovi valori
        $old->save($old);
    }
 }
