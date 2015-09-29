<?php
class Form_Home extends Form_Abstract
{
    public function init(){
        $this->setAttrib('class', 'well form');
        $title = $this->createElement('text', 'title_'.Model_Lang::get());
        $title->setLabel('Заголовок:')
                ->setAttrib('width', '100');
        $this->addelement($title);
        
        $text = $this->createElement('textarea', 'text_'.Model_Lang::get());
        $text->setLabel('Описание:')
                ->setAttrib('style', 'width: 100%');
        $this->addElement($text);
        
        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => 'btn btn-primary'));
    }    
}
?>