<?php

class Form_AdminForm extends Form_Abstract
{
    
    public function init()
    {
        $town = $this->createElement('select', 'town');
        $town->setLabel('Город:')
                ->addMultioption('kharkov', 'Kharkov')
                ->addMultioption('kiev', 'Kiev')
                ->addMultioption('odessa', 'Odessa');
        $this->addElement($town);
        
        $rayons = $this->createElement('select', 'rayons');
        $rayons->setLabel('Район:')
                ->addMultioption('id', 'Киевский');
        $this->addElement($rayons);
        
        $floor = $this->createElement('text', 'floor_');
        $floor->setLabel('Этаж:')
                ->addFilter('StripTags')
                ->addFilter('StringTrim');
        $this->addElement($floor);
        
        //$option = $this-createElement('text', 'option');
       
        $loyalty = $this->createElement('checkbox', '1');
        $loyalty->setLabel('Спец предложение');
        $this->addElement($lyalty);
        /*
        $comment = $this->createElement('textarea', 'comment_rus');
        $comment->setLabel('Комментарий:')
                ->addFilter('StringTrim');
        $this->addElement($comment);
        
        $adress = $this->createElement('textarea', 'adress_rus');
        $adress->setLabel('Адрес:')
                ->addFilter('StringTrim');
        $this->addElement($adress);
        */
               
    }
}



























?>