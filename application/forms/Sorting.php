<?php
class Form_Sorting extends Form_Abstract
{
    public function init()
    {

        $this->addElement('MultiCheckbox', 'sorting',
                array('multioptions' => array(
                    '1 - Аренда автомобиля с водителем',
                    '2 - Аренда авто без водителя', 
                    '3 - Встреча или сопровождение до аэропорта',
                    '4 - Купить недорогой мобильный',
                    '5 - Стирка белья, вещей',
                    '6 - Уборка квартиры',
                    '7 - Приготовление еды',
                    '8 - Экскурсия по Харькову',
                    '9 - Доставка еды',
                    '10 - Заказ билетов')));
        
        $this->addElement('submit', 'submit', array('label' => 'Обновить')); 

    }
}
?>