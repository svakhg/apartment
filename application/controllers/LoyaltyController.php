<?php

    class LoyaltyController extends Zend_Controller_Action
    {
        public function init()
        {
            /* Initialize action controller here */
        }
        
        public function indexAction()
        {
            $mdlApart = new Model_Apartments();
            $this->view->apartments = $mdlApart->getLoyalty();
        }
        
    }

?>