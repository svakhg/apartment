<?php

 class Admin_AboutController extends Zend_Controller_Action
{
    public function init()
    {

    }

    public function indexAction(){
             
        $mdlText = new Model_Text();
        $arr = $mdlText->getText('about_us_'.Model_Lang::get());
        $arrText = $arr->toArray();
        $frmAbout = new Form_About();

        $this->view->form = $frmAbout;
        $frmAbout->populate($arrText); 

        if ($this->_request->isPost())
        {
            if ($frmAbout->isValid($this->_request->getParams()))
            {
                $mdlText = new Model_Text();
                $mdlText->editText($frmAbout->getValues(), 'about_us_'.Model_Lang::get());
                $this->view->layout()->message = 'Данные сохранены';
            }
        }
   }
}

?>