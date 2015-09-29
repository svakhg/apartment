<?php
abstract class Form_Abstract extends Zend_Form{
    public function get($property){
        return $property . '_' . Model_Lang::get();
    }
}