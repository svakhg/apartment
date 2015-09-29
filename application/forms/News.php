<?php

class Form_News extends Form_Abstract
{
    public function init()
    {
        $head = $this->createElement('text', 'head_'.Model_Lang::get());
        $head->setLabel('Заголовок:');
        $this->addElement($head);
        
        $news = $this->createElement('textarea', 'text_'.Model_Lang::get());
        $news->setLabel('Новость:');
        $this->addElement($news);
        $this->addElement('submit', 'submit', array('label' => 'Добавить/Обновить', 'class' => 'btn btn-primary')); 
    }
}

?>