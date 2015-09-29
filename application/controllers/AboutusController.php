<?php

    class AboutUsController extends Zend_Controller_Action
    {
        public function init()
        {
             
        }
        
        public function indexAction()
        {
            $mdlApart = new Model_Text();
            $this->view->text = $mdlApart->getText('contact_'.Model_Lang::get());              
            
        }
        
    }

?>
