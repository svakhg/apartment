<?php

 class Admin_ContactsController extends Zend_Controller_Action
{
    public function init()
    {

    }

    public function indexAction()
        {
             
             $mdlText = new Model_Text();
             $arr = $mdlText->getText('contact_'.Model_Lang::get());
             $arrText = $arr->toArray();
             $frmContact = new Form_Contacts();
             
             $this->view->form = $frmContact;
             $frmContact->populate($arrText); 
             
             if ($this->_request->isPost())
             {
                 if ($frmContact->isValid($this->_request->getParams()))
                 {
                     $mdlText = new Model_Text();
                     $mdlText->editText($frmContact->getValues(), 'contact_'.Model_Lang::get());
                     $this->view->layout()->message = 'Данные сохранены';
                 }
             }
        }
}

?>