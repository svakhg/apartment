<?php
class Model_Features extends Model_Table{
    protected $_name = 'features';
    protected $_referenceMap = array(
            'feature' => array(
                self::COLUMNS => 'ID',
                self::REF_TABLE_CLASS => 'Model_ApartmentFeature',
                self::REF_COLUMNS => 'feature_id'
            )
        );
    
    public function getAll(){
        $select = $this->select();
        $rows = $this->fetchAll($select);
        return $rows;
    }
}