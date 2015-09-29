<?php

 class Admin_HomeController extends Zend_Controller_Action
{
    public function init()
    {

    }

    public function indexAction()
        {
             
             $mdlText = new Model_Text();
             $arr = $mdlText->getText('home');
             $arrText = $arr->toArray();
             $frmHome = new Form_Home();
             
             $this->view->form = $frmHome;
             $frmHome->populate($arrText); 
             
             if ($this->_request->isPost())
             {
                 if ($frmHome->isValid($this->_request->getParams()))
                 {
                     $mdlText = new Model_Text();
                     $mdlText->editText($frmHome->getValues(), 'home');
                     $this->view->layout()->message = 'Данные сохранены';
                 }
             }
        }
}

?>