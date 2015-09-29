<?php

class Form_EditApart extends Form_Abstract
{ 
    public function init(){
        $this->setAttrib('class', 'well');
        $this->setAttrib('entype', 'multipart/form-data');       
         
        $town = $this->createElement('select', 'town');
        $town->setLabel('Город:')
                ->addMultioption('1', 'Kharkov')
                ->addMultioption('2', 'Kiev')
                ->addMultioption('3', 'Odessa')
                ->setRequired();
        $this->addElement($town);
        
        $rayons = $this->createElement('select', 'id_rayons');
        $rayons->setLabel('Район:')
                ->addMultioption('0', '-Выберите район-');
        $mdlRayons = new Model_Rayons();
        $rns = $mdlRayons->getRayons();
        foreach ($rns as $r){
            $rayons->addMultioption($r->ID, $r->get('name'));
        }
        $this->addElement($rayons);
        
        $floor = $this->createElement('text', 'floor');
        $floor->setLabel('Этаж:');
        $this->addElement($floor);

        $loyalty = $this->createElement('checkbox', 'loyalty');
        $loyalty->setLabel('Спец предложение');
        $this->addElement($loyalty);
        
        $mdlFeatures = new Model_Features();
        $features = $mdlFeatures->getAll();
        
        $sub = new Zend_Form_SubForm();
        foreach ($features as $feature){
            $check = $sub->createElement('checkbox', $feature->ID);
            $check->setLabel($feature->title_rus)
                    ->setValue($feature->ID);
            $sub->addElement($check);
            if ($feature->have_value){
                $value = $sub->createElement('text', 'value_' . $feature->ID);
                $value->removeDecorator('label');
                $sub->addElement($value);
            }
        }
        $sub->removeDecorator('Label');
        $this->addSubForm($sub, 'feature');
        
        $price1 = $this->createElement('text', 'cost_'.Model_Lang::get());
        $price1->setLabel('Цена-1:');
        $this->addElement($price1);
        
        $price2 = $this->createElement('text', 'cost1_'.Model_Lang::get());
        $price2->setLabel('Цена-2:');
        $this->addElement($price2);        
     
        $comment = $this->createElement('textarea', 'comment_'.Model_Lang::get());
        $comment->setLabel('Комментарий:')
                ->setAttrib('class', 'textarea1')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8'); 
        $this->addElement($comment);
        
        $adress = $this->createElement('textarea', 'adress_'.Model_Lang::get());
        $adress->setLabel('Адрес:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8');
        $this->addElement($adress);
        
        $adress2 = $this->createElement('textarea', 'adress2_'.Model_Lang::get());
       $adress2->setLabel('Адрес2:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8');
        $this->addElement($adress2);
        
        $addinfo = $this->createElement('textarea', 'addinfo_'.Model_Lang::get());
        $addinfo->setLabel('Дополнительная информация:')
                 ->setAttrib('cols', '100')
                 ->setAttrib('rows', '8');
        $this->addElement($addinfo);
        
        $how = $this->createElement('textarea', 'how_'.Model_Lang::get());
        $how->setLabel('Как добраться:')
             ->setAttrib('cols', '100')
             ->setAttrib('rows', '8');
        $this->addElement($how);
        
        $map = $this->createElement('file', 'map');
        $map->setLabel('Карта:');
        $this->addElement($map);
        
        $googlemap = $this->createElement('textarea', 'googlemapsurl');
        $googlemap->setLabel('Google map ссылка:')
                    ->setAttrib('cols', '100')
                    ->setAttrib('rows', '5');
        $this->addElement($googlemap);
        
        $yandexmap = $this->createElement('textarea', 'yandexmapcode');
        $yandexmap->setLabel('Yandex map ссылка:')
                    ->setAttrib('cols', '100')
                    ->setAttrib('rows', '5');
        $this->addElement($yandexmap);
        
        $video = $this->createElement('textarea', 'video');
        $video->setLabel('Код видео:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '5');
        $this->addElement($video);
        
        $title = $this->createElement('textarea', 'title_'.Model_Lang::get());
        $title->setLabel('META title:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '5');
        $this->addElement($title);
        
        $description = $this->createElement('textarea', 'description_'.Model_Lang::get());
        $description->setLabel('META description:')
                    ->setAttrib('cols', '100')
                    ->setAttrib('rows', '5');
        $this->addElement($description);
        
        $keywords = $this->createElement('textarea', 'keywords_'.Model_Lang::get());
        $keywords->setLabel('META keywords:')
                  ->setAttrib('cols', '100')
                  ->setAttrib('rows', '5');
        $this->addElement($keywords);
        
        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => 'btn btn-primary', 'decorators' => array('ViewHelper'))); 
        $this->addElement('submit', 'tophotos', array('label' => 'Сохранить и перейти к фотографиям', 'class' => 'btn', 'decorators' => array('ViewHelper'))); 
    }
}
?>