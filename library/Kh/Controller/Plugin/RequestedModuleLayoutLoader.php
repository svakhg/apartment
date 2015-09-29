<?php
    
class Kh_Controller_Plugin_RequestedModuleLayoutLoader extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $config = Zend_Controller_Front::getInstance()
                ->getParam('bootstrap')
                ->getOptions();
        $moduleName = $request->getModuleName();
        $view = new Zend_View();
        if($moduleName == 'admin'){
            $auth = Zend_Auth::getInstance();
            
            if (!$auth->hasIdentity() || $auth->getIdentity()->role !='admin'){
                $redirector = new Zend_Controller_Action_Helper_Redirector();
                $redirector->direct('login', 'user', 'default');
            }
            
            $view->headLink()->appendStylesheet('/css/bootstrap.min.css');
            $view->headLink()->appendStylesheet('/css/admin.css');
            $view->headScript()->appendFile('/js/bootstrap.min.js');
            $view->headScript()->appendFile('/js/admin.js');
            if (isset($config[$moduleName]['resources']['layout']['layout'])){
                $layoutScript = $config[$moduleName]['resources']['layout']['layout'];
                Zend_Layout::getMvcInstance()->setLayout($layoutScript);
            }
            
            if (isset($config[$moduleName]['resources']['layout']['layoutPath'])){
                $layoutPath = $config[$moduleName]['resources']['layout']['layoutPath'];
                Zend_Layout::getMvcInstance()->setLayoutPath($layoutPath);
            }       
        }else{
            $view->headLink()->appendStylesheet('/css/apartment-kharkov.css');
        }
    }
}
?>