<?php

class Form_Service extends Form_Abstract
{
    public function init()
    {
        $this->setAttrib('class', 'well form');
        $this->setAttrib('entype', 'multipart/form-data');
        
        $name = $this->createElement('text', 'name_'.Model_Lang::get());
        $name->setLabel('Название:')
                ->setAttrib('width', '100')
                ->setRequired();
        $this->addElement($name);
        
        $text = $this->createElement('textarea', 'text_'.Model_Lang::get());
        $text->setLabel('Описание:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8');
        $this->addElement($text);
        
        $title = $this->createElement('textarea', 'title_'.Model_Lang::get());
        $title->setLabel('Title:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8');
        $this->addElement($title);
        
        $description = $this->createElement('textarea', 'description_'.Model_Lang::get());
        $description->setLabel('Description:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8');
        $this->addElement($description);
        
        $keywords = $this->createElement('textarea', 'keywords_'.Model_Lang::get());
        $keywords->setLabel('Keywords:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8');
        $this->addElement($keywords);
        
        $photo1 = $this->createElement('file', 'photo_1');
        $photo1->setLabel('Картинка 1:')
                ->setDestination(APPLICATION_PATH . '/../public/img/icon_service/');
        $this->addElement($photo1);
        
        $photo2 = $this->createElement('file', 'photo_2');
        $photo2->setLabel('Картинка 2:')
                ->setDestination(APPLICATION_PATH . '/../public/img/icon_service/');
        $this->addElement($photo2);
        
        $imgic = $this->createElement('file', 'imgic');
        $imgic->setLabel('Иконка:')
                ->setDestination(APPLICATION_PATH . '/../public/img/icon_service/');
        $this->addElement($imgic);
        
        $icons = $this->createElement('checkbox', 'icons');
        $icons->setLabel('Активировать услугу');
        $this->addElement($icons);
        
        
        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => 'btn btn-primary')); 
    }
}

?>