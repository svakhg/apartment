<?php

 class Admin_WayController extends Zend_Controller_Action
{
    public function init()
    {

    }

    public function indexAction()
        {
             
             $mdlText = new Model_Text();
             $arr = $mdlText->getText('how_to_get_'.Model_Lang::get());
             $arrText = $arr->toArray();
             $frmWay = new Form_Way();
             
             $this->view->form = $frmWay;
             $frmWay->populate($arrText); 
             
             if ($this->_request->isPost())
             {
                 if ($frmWay->isValid($this->_request->getParams()))
                 {
                     $mdlText = new Model_Text();
                     $mdlText->editText($frmWay->getValues(), 'how_to_get_'.Model_Lang::get());
                     $this->view->layout()->message = 'Данные сохранены';
                 }
             }
        }
}

?>