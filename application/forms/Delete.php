<?php
class Form_Delete extends Form_Abstract
{
    public function init()
    {
        $title = $this->createElement('text', 'title');
        $title->setLabel('Заголовок:');
        $this->addelement($title);
        
        $text = $this->createElement('textarea', 'text');
        $text->setLabel('Описание:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8');
        $this->addElement($text);
        
        $this->addElement('submit', 'submit', array('label' => 'Добавить')); 
    }    
}
?>