<?php

class Model_Clients extends Model_Table
{
    protected $_name = 'client_info';
    
    public function orderc($data){
        $row = $this->createRow($data);
        $row->save();
        return $row;
    }
    
    public function getInfo($id)
    {
           $select = $this->select();
           $select->where('ID = ?', $id);
           return $this->fetchRow($select);
    }
}



?>