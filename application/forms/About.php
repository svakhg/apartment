<?php

class Form_About extends Form_Abstract
{
    public function init(){
        $this->setAttrib('class', 'well form');
        $about = $this->createElement('textarea', 'text_'.Model_Lang::get());
        $about->setLabel('О нас:')
                ->setAttrib('style', 'width: 100%')
                ->removeDecorator('Label');
        $this->addElement($about);
        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => 'btn btn-primary')); 
    }
}

?>