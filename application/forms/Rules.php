<?php

class Form_Rules extends Form_Abstract
{
    public function init()
    {
        $this->setAttrib('class', 'well form');
        $rules = $this->createElement('textarea', 'text_'.Model_Lang::get());
        $rules->setLabel('Правила:')
                ->setAttrib('style', 'width: 100%')
                ->removeDecorator('Label');
        $this->addElement($rules);
        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => 'btn btn-primary')); 
    }
}

?>