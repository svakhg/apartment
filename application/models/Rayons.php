<?php

class Model_Rayons extends Model_Table
{
    protected $_name = 'rayons';
    
    public function getRayons(){
        $select = $this->select();
        return $this->fetchAll($select);
    }
    
    public function newRayon($data)
    {
        return $this->insert($data);
    }
    
    public function edit($data, $id)
    {
        $select = $this->select();
        $select->where('ID= ?', (int)$id);
        $row = $this->fetchRow($select);            
        $row->name_rus = $data['name_rus'];
        $row->save();
    }
    
    public function del($id)
    {   
        $this->delete('ID = ' . $id);            
    }
        
    public function detal($id)
    {
        $select = $this->select();
        $select->where('ID = ?', $id);
        return $this->fetchRow($select);
    }
}

?>