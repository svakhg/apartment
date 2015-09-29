<?php
class Model_Row extends Zend_Db_Table_Row{
    public function get($property){
        $field = $property . '_' . Model_Lang::get();
        return $this->$field;
    }
}