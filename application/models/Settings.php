<?php

    class Model_Settings extends Model_Table
    {
         protected $_name = 'settings';


         public function getInfo()
         {
             $select = $this->select();
             $select->where('ID= ?', 1);
             /*
            $sql = $select->__toString();
            echo $sql."\n"; exit;*/

            // return $this->fetchRow($select);
         }
         
         public function editInfo($data, $id)
         {
            if (empty($data['map'])) unset($data['map']);
            if (empty($data['photo1'])) unset($data['photo1']);
            $this->update($data, 'ID = "' . $id);
         }
    }

?>