<?php

class Form_NewApart extends Form_Abstract
{
    
    public function init()
    {
        
        $this->setAttrib('entype', 'multipart/form-data');
        
        $town = $this->createElement('select', 'town');
        $town->setLabel('Город:')
                ->addMultioption('kharkov', 'Kharkov')
                ->addMultioption('kiev', 'Kiev')
                ->addMultioption('odessa', 'Odessa')
                ->setAttrib('class', 'zfz1');        
        $this->addElement($town);
        
        $rayons = $this->createElement('select', 'id_rayons');
        $rayons->setLabel('Район:')
                ->addMultioption('placeholder', '-Выберите район-')
                ->addMultioption('1', 'Киевский')
                ->setAttrib('class', 'zfz1');
        $this->addElement($rayons);
        
        $floor = $this->createElement('text', 'floor_');
        $floor->setLabel('Этаж:')
                ->setAttrib('class', 'zfz1');
        $this->addElement($floor);
        
        $loyalty = $this->createElement('checkbox', 'loyalty');
        $loyalty->setLabel('Спец предложение')
                ->setAttrib('class', 'zfz2');
        $this->addElement($loyalty);
     
               $this->addElement('MultiCheckbox', 'check',
                array('multioptions' => array(
                    'Стиральная машинка', 'Спутниковое ТВ', 'Кабельное ТВ', 'Авто.подогрев воды', 'Интернет',
                    'Кровать 1,5 метра', 'Кровать 2 метра', 'Микроволновка', 'Музыкальный центр', 'Классическая ванна',
                    'Душевая', 'Фен', 'Утюг', 'Чайник', 'DVD', 'Холодильник, плита', 'Электирческий камин', 
                    'Камин', 'Вход с видеонаблюдением', 'Посудомоечная машина', 'Тостер', 'Wi-fi'
                    ), 
                    'value' => array()));
        
        $condition = $this->createElement('select', 'condition');
        $condition->setLabel('Кондиционер:')
                ->addMultioption('placeholder', ' ')
                ->addMultioption('1', '1')
                ->addMultioption('2', '2')
                ->addMultioption('3', '3');
        $this->addElement($condition);
        
        $balcon = $this->createElement('select', 'balkon');
        $balcon->setLabel('Балкон(ы):')
                ->addMultioption('placeholder', ' ')
                ->addMultioption('1', '1')
                ->addMultioption('2', '2')
                ->addMultioption('3', '3');
        $this->addElement($balcon);
        
        $sleepplace = $this->createElement('select', 'sleepplace');
        $sleepplace->setLabel('Спальных мест:')
                ->addMultioption('1', '1')
                ->addMultioption('2', '2')
                ->addMultioption('3', '3')
                ->addMultioption('4', '4')
                ->addMultioption('5', '5')
                ->addMultioption('6', '6')
                ->addMultioption('7', '7')
                ->addMultioption('8', '8')
                ->addMultioption('9', '9')
                ->addMultioption('10', '10');
        $this->addElement($sleepplace);
        
        $room = $this->createElement('text', 'room');
        $room->setLabel('Кол-во комнат:');
        $this->addElement($room);
        
        $price1 = $this->createElement('text', 'price1');
        $price1->setLabel('Цена-1:');
        $this->addElement($price1);
        
        $price2 = $this->createElement('text', 'price2');
        $price2->setLabel('Цена-2:');
        $this->addElement($price2); 
        
        $comment = $this->createElement('textarea', 'comment_rus');
        $comment->setLabel('Комментарий:')
                ->setAttrib('class', 'textarea1')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8')
                ->setAttrib('class', 'zfz3');
        $this->addElement($comment);
        
        $adress = $this->createElement('textarea', 'adress_rus');
        $adress->setLabel('Адрес:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8')
                ->setAttrib('class', 'zfz3');
        $this->addElement($adress);
        
        $adress2 = $this->createElement('textarea', 'adress2_rus');
       $adress2->setLabel('Адрес2:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '8')
                ->setAttrib('class', 'zfz3');
        $this->addElement($adress2);
        
        $addinfo = $this->createElement('textarea', 'addinfo_rus');
        $addinfo->setLabel('Дополнительная информация:')
                 ->setAttrib('cols', '100')
                 ->setAttrib('rows', '8')
                ->setAttrib('class', 'zfz3');
        $this->addElement($addinfo);
        
        $how = $this->createElement('textarea', 'how_rus');
        $how->setLabel('Как добраться:')
             ->setAttrib('cols', '100')
             ->setAttrib('rows', '8')
             ->setAttrib('class', 'zfz3');
        $this->addElement($how);
        
        $map = $this->createElement('file', 'map_rus');
        $map->setLabel('Карта:');
        $this->addElement($map);
        
        $googlemap = $this->createElement('textarea', 'googlemapsurl');
        $googlemap->setLabel('Google map ссылка:')
                    ->setAttrib('cols', '100')
                    ->setAttrib('rows', '5')
                    ->setAttrib('class', 'zfz3');
        $this->addElement($googlemap);
        
        $yandexmap = $this->createElement('textarea', 'yandexmapcode');
        $yandexmap->setLabel('Yandex map ссылка:')
                    ->setAttrib('cols', '100')
                    ->setAttrib('rows', '5')
                    ->setAttrib('class', 'zfz3');
        $this->addElement($yandexmap);
        
        $video = $this->createElement('textarea', 'video');
        $video->setLabel('Код видео:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '5')
                ->setAttrib('class', 'zfz3');
        $this->addElement($video);
        
        $title = $this->createElement('textarea', 'title');
        $title->setLabel('META title:')
                ->setAttrib('cols', '100')
                ->setAttrib('rows', '5')
                ->setAttrib('class', 'zfz3');
        $this->addElement($title);
        
        $description = $this->createElement('textarea', 'description');
        $description->setLabel('META description:')
                    ->setAttrib('cols', '100')
                    ->setAttrib('rows', '5')
                    ->setAttrib('class', 'zfz3');
        $this->addElement($description);
        
        $keywords = $this->createElement('textarea', 'keywords');
        $keywords->setLabel('META keywords:')
                  ->setAttrib('cols', '100')
                  ->setAttrib('rows', '5')
                  ->setAttrib('class', 'zfz3');
        $this->addElement($keywords);
        
        $this->addElement('submit', 'submit', array('label' => 'Добавить')); 
    }
}
?>