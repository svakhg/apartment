<?php
class Model_ApartmentFeature extends Model_Table{
    protected $_name = 'apartment_feature';
    protected $_dependentTables = array('Model_Features');
    protected $_referenceMap = array(
            'features' => array(
                self::COLUMNS => 'apartment_id',
                self::REF_TABLE_CLASS => 'Model_Apartments',
                self::REF_COLUMNS => 'ID'
            )
        );
    public function deleteByApartment($id){
        $this->delete('apartment_id = ' . $id);
    }
    
    public function add($data){
        return $this->insert($data);
    }
    
    public function features($apartment_id, $features){
        $res = $features;
        if (is_array($features)){
            $res = implode(',', $features);
        }
        $select = $this->select();
        $select->where('feature_id IN (?)', $res);
        $select->where('apartment_id = ?', $apartment_id);
        return $this->fetchAll($select);
        
    }
    
    
}