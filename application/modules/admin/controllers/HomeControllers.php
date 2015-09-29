<?php 

class Admin_HomeController extends Zend_Controller_Action
{
    public function init()
    {
        
    }
    
    public function indexAction()
    {
        $mdlText = new Model_Text();
        $this->view->home = $mdlText->getText();
    }
}

?>