
<?php
    
    class Model_Services extends Model_Table
    {
        protected $_name = 'services';

        public function getServicesList()
        {
            $select = $this->select();
            $select->order('sorting');
            return $this->fetchAll($select);
        }
        
        public function getByIds($ids){
            $select = $this->select();
            $select->where('ID IN (?)', $ids);
            
            return $this->fetchAll($select);
        }
        
        public function getServicesMenu(){
            $select = $this->select();
            $select->order('name_' . Model_Lang::get());
            return $this->fetchAll($select);
            
          // var_dump(Model_Lang::get());
           //exit;
            
            
        }
        
        public function getShowService($id)
        {
            $select = $this->select();
            $select->where('lang= ?', 'rus')
                    ->where('ID= ?', $id);
            return $this->fetchRow($select);
        } 
        
        public function getShowOnOrder(){
            $select = $this->select();
            $select->where('show_on_order = ?', 1);
            return $this->fetchAll($select);
        }
        
        
        public function newService($data)
        {
            return $this->insert($data);
        }
        
        public function updatePosition($id, $pos){
            $this->update(array(
                'sorting' => $pos
            ), 'ID = ' . $id);
        }

        public function edit($data, $id)
        {
            if (empty($data['photo_1'])) unset($data['photo_1']);
            if (empty($data['photo_2'])) unset($data['photo_2']);
            if (empty($data['imgic'])) unset($data['imgic']);          
            $this->update($data, 'ID= '. $id);            
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
        
        public function lefticons()
        { 
            $select = $this->select();
            $select->where('icons = ?', 1);
            $select->order('sorting');
            return $this->fetchAll($select);
            
        }
        
        public function sorting($data)
        {
            $select = $this->select();
            $select->where('icons= ?', 1);
            $row = $this->fetchRow($select);
             foreach($data as $key => $value)
            {
                $row->$key = $value;
            }
            //$row->sorting = $data['sorting'];
            $row->save();
        }
    }


?>