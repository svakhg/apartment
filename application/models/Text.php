<?php

    class Model_Text extends Model_Table
    {
         protected $_name = 'text';


         public function getText($slug = 'home'){
             $select = $this->select();
             $select->where('header = ?', $slug);
             return $this->fetchRow($select);
         }
         
         public function editText($data, $slug = 'home'){
            $this->update($data, 'header = "' . $slug .'"');
         }
    }

?>