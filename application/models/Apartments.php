<?php
    
    class Model_Apartments extends Model_Table
    {
        protected $_name = 'apartments';
        protected $_dependentTables = array('Model_ApartmentFeature', 'Model_Attachments');
        
        
        public function getApartments($rooms = null, $price_from = null, $price_to = null){
            
            
            $select = $this->select();
            $select->order('position');
            $select->from($this->_name);
            $select->where('published= ?', 1);
            $select->columns(array(
                '*',
                'img' => '(SELECT attachments.`file` FROM attachments WHERE attachments.apartment_id = apartments.ID LIMIT 1)'
            ));
            
            if($rooms){
                $select->setIntegrityCheck(FALSE);
                $select->joinInner('apartment_feature', 'apartment_feature.apartment_id = apartments.ID AND apartment_feature.feature_id = 27 AND apartment_feature.value = '. $rooms, array('value'));
            }
          
            if ($price_from)
                $select->where('cost_'.Model_Lang::get().' >= ?', $price_from);
            if ($price_to)
                $select->where('cost_'.Model_Lang::get().' <= ?', $price_to);
            $select->where('published =? ', 1);
            return $this->fetchAll($select);
        }
        
        public function getMainApartments()
        {
            $select = $this->select();
            $select->from($this->_name);
            $select->columns(array(
                '*',
                'img' => '(SELECT attachments.`file` FROM attachments WHERE attachments.apartment_id = apartments.ID LIMIT 1)'
            ));
            $select->where('first = ?', 'on');
            $select->limit(4,0);
            return $this->fetchAll($select);
            
        }
        
        public function getDetails($id, $public = 1)
        {
            $select = $this->select();
            $select->from($this->_name);
            $select->where('ID = ?', $id);
            if ($public !== null && $public !== false)
                $select->where('published', $public);
            $select->columns(array(
                '*',
                //'img' => '(SELECT ap."ID", ap.*, apf.* FROM "apartments" AS ap JOIN "apartments_feature" AS apf ON ap.ID = apf.apartment_id)'                
            ));           
            $res =  $this->fetchRow($select);
            return $res;
        }
        
        public function getLoyalty()
        {
            $select = $this->select();
            $select->from($this->_name);
            $select->columns(array(
                '*',
                'img' => '(SELECT attachments.`file` FROM attachments WHERE attachments.apartment_id = apartments.ID LIMIT 1)'
            ));
            $select->where('loyalty = ?', 1, 'and', 'published = ?', 1);
            return $this->fetchAll($select);
        }
        
        public function getIcons()
        {
            
        }
        
        public function getTableApart()
        {
            $select = $this->select();
            $select->order('position');
            return $this->fetchAll($select);
        }
        
        public function newApart($data){
            return $this->insert($data);
        }
        
        public function del($id)
        {   
            $this->delete('ID = ' . $id);            
        }
        
        public function edit($data, $id)
        {   
            $select = $this->select();
            $select->where('ID= ?', (int)$id);
            $row = $this->fetchRow($select);            
            
            foreach($data as $key => $value)
            {
                if($key == 'file') continue;
                $row->$key = $value;
            }
            $row->save();
        }
        
        public function map($data, $id)
        {  
            $select = $this->select();
            $select->where('ID= ?', $id);       
            $row = $this->fetchRow($select);         
            $row->map_number = $data['map_number'];
            $row->map_point_x = $data['map_point_x'];
            $row->map_point_y = $data['map_point_y'];
            $row->save();
            
        /*
            $this->update($data, 'ID=? ', $id);
            */
        }        
        public function toggle($id){   
            $select = $this->select();
            $select->where('ID= ?', (int)$id);
            $row = $this->fetchRow($select);            
            $row->published = !$row->published;
            $row->save();
            return $row;
        }
        
        public function updatePosition($id, $pos)
        {
            $this->update(array(
                'position' => $pos
            ), 'ID = ' . $id);
        }
   }


?>