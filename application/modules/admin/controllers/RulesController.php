<?php

    class Admin_RulesController extends Zend_Controller_Action
    {
        public function init()
        {
         
        }
        
        public function indexAction()
        {
            $mdlText = new Model_Text();
            $arr = $mdlText->getText('rules_us_'.Model_Lang::get());
            $arrText = $arr->toArray();
            $frmRules = new Form_Rules();
            
            $this->view->form = $frmRules;
            $frmRules->populate($arrText); 
             
             if ($this->_request->isPost())
             {
                 if ($frmRules->isValid($this->_request->getParams()))
                 {
                     $mdlText = new Model_Text();
                     $mdlText->editText($frmRules->getValues(), 'rules_us_'.Model_Lang::get());
                     $this->view->layout()->message = 'Данные сохранены';
                 }
             }
        }
        
    }
?>