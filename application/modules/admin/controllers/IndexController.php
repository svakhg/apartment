<?php
class Admin_IndexController extends Zend_Controller_Action
{
    public function init()
    {
        
    }
    
    public function indexAction()
    {
         
    }
    
    public function helpAction()
    {
        
    }
    
    public function langAction(){
        $this->_helper->ViewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        
        $lang = $this->_getParam('lang');   
        $backUrl = str_replace('|', '/', $this->_getParam('backUrl'));
        setcookie('lang', $lang, 0, '/');
        $this->_redirect($backUrl);
    }
}
?>