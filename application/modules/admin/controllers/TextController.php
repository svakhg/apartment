<?php
    class Admin_TextController extends Zend_Controller_Action
    {
         public function init()
         {
            
         }
        
         public function indexAction()
        {
             
             $mdlText = new Model_Text();
             $arr = $mdlText->getText('home_'.Model_Lang::get());
             $arrText = $arr->toArray();
             $form = new Form_Home();
             
             $this->view->form = $form;
             $form->populate($arrText); 
             
             if ($this->_request->isPost())
             {
                 if ($form->isValid($this->_request->getParams()))
                 {
                     $mdlText = new Model_Text();
                     $mdlText->editText($form->getValues());
                     $this->view->layout()->message = 'Данные сохранены';
                 }
             }
        }

    }
?>