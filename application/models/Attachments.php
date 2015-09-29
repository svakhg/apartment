<?php
class Model_Attachments extends Model_Table{
    protected $_name = 'attachments';
    protected $_referenceMap = array(
            'attachments' => array(
                self::COLUMNS => 'apartment_id',
                self::REF_TABLE_CLASS => 'Model_Apartments',
                self::REF_COLUMNS => 'ID'
            )
        );
    
    public static function add($apartment_id, $img, $w, $h){
        if ($img){
            $model = new self;
            $row = $model->createRow();
            $row->file = $img;
            $row->apartment_id = $apartment_id;
            $row->width = $w;
            $row->height = $h;
            return $row->save();
        }
        return false;
    }
    
    public static function get($apart_id){
        $model = new self;
        $select = $model->select();
        $select->where('apartment_id = ?', $apart_id);
        return $model->fetchAll($select);
    }
    
}