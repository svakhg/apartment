<?php
class Form_Photos extends Form_Abstract{
    public function init(){
        
        $this->addElement('hidden', 'id', array('decorators' => array('ViewHelper')));
        
        $file = $this->createElement('file', 'file');
        $file->setLabel('Фото:')
                ->setDestination(APPLICATION_PATH . '/../public/img/apartments/');        
        $file->setMultiFile(12);
        $this->addElement($file);
        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => 'btn btn-primary'));
    }
}

?>
