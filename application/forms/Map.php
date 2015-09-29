<?php

class Form_Map extends Form_Abstract
{
    public function init()
    {
        $this->setAttrib('class', 'well');
        $map = $this->createElement('select', 'map_number');
        $map->setLabel('Выберите часть города в которой расположена квартира')
                ->addMultioption('1', 'Центр - м. Исторический Музей, м. Советская')
                ->addMultioption('2', 'Центр - м. Госпром, м. Научная, м. Университет')
                ->addMultioption('3', 'Пятихатки')
                ->addMultioption('4', 'Алексеевка')
                ->addMultioption('5', 'Поселок Жуковского')
                ->addMultioption('6', 'Павлово Поле, Алексеевка, Сортировка')
                ->addMultioption('7', 'Павлово Поле, Шатиловка, Сокольники')
                ->addMultioption('8', '8')
                ->addMultioption('9', 'Северная Салтовка, Салтовка')
                ->addMultioption('10', 'Холодная Гора, Лысая Гора')
                ->addMultioption('11', 'Нагорный')
                ->addMultioption('12', 'Салтовка')
                ->addMultioption('13', 'Холодная Гора, Залютино')
                ->addMultioption('14', 'Москалевка, Холодная Гора')
                ->addMultioption('15', 'Левада')
                ->addMultioption('16', 'Новая Бавария');
        
        $this->addElement($map);
        
        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => 'btn btn-primary', 'decorators' => array('ViewHelper')));    
    }
    
}

?>