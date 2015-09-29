<?php 

 class Model_News extends Model_Table
{
    protected $_name = 'news';
    
    public function getNews()
    {
        $select = $this->select();
        return $this->fetchAll($select);
        
    }
    
    public function news($data)
    {
        return $this->insert($data);
    }
    public function edit($data, $id)
    {
       /* $select = $this->select();
        $select->where('ID= ?', $id);       
        $row = $this->fetchRow($select);         
        $row->head = $data['head'];
        $row->text = $data['text'];
        $row->save();
        */
        $this->update($data, 'ID= ', $id);
    }
    
    public function del($id)
    {   
        $this->delete('ID = ' . $id);            
    }
    
    public function detail($id)
    {
        $select = $this->select();
        $select->where('ID= ?', $id);
        return $this->fetchRow($select);
    } 
           
    
    
}

?>