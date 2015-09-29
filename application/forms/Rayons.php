<?php

class Form_Rayons extends Form_Abstract
{
    public function init()
    {
        $this->setAttrib('class', 'well form');
        $rayon = $this->createElement('text', 'name_'.Model_Lang::get());
        $rayon->setLabel('Район:')
                ->setRequired()
                ->setAttrib('width', '100');
        $this->addElement($rayon);
        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => 'btn btn-primary')); 
    }
}

?>