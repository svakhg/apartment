<?php

class Form_Contacts extends Form_Abstract
{
    public function init(){
        $this->setAttrib('class', 'well form');
        $contact = $this->createElement('textarea', 'text_'.Model_Lang::get());
        $contact->setLabel('Наши контакты:')
                ->setAttrib('style', 'width: 100%')
                ->removeDecorator('Label');
        $this->addElement($contact);
        $this->addElement('submit', 'submit', array('label' => 'Сохранить','class' => 'btn btn-primary')); 
    }
}

?>