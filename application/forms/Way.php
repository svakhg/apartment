<?php

class Form_Way extends Form_Abstract
{
    public function init()
    {
        $this->setAttrib('class', 'well form');
        $way = $this->createElement('textarea', 'text_'.Model_Lang::get());
        $way->setLabel('Как до нас добраться:')
                ->setAttrib('style', 'width: 100%')
                ->removeDecorator('Label');
        $this->addElement($way);
        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => 'btn btn-primary')); 
    }
}

?>