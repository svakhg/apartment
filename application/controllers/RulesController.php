<?php

    class RulesController extends Zend_Controller_Action
    {
        public function init()
        {
            /* Initialize action controller here */
        }
        
        public function indexAction()
        {
            $mdlApart = new Model_Text();
            $this->view->text = $mdlApart->getText('rules_us_'.Model_Lang::get());           
        }
        
    }

?>