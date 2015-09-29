<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initView()
    {
        $view = new Zend_View();
        $view->doctype('HTML5');
        $view->headLink()->appendStylesheet('/js/fancybox/jquery.fancybox.css');
        
        $view->headScript()->appendFile('/js/jquery-1.8.2.min.js');
        $view->headScript()->appendFile('/js/jquery-ui-1.9.1.custom.min.js');
        $view->headLink()->appendStylesheet('/css/jquery-ui-1.9.1.custom.min.css');        
        $view->headScript()->appendFile('/js/jquery.mousewheel-3.0.6.pack.js');
        $view->headScript()->appendFile('/js/fancybox/jquery.fancybox.pack.js');
        $view->headScript()->appendFile('/js/spin.min.js');
        $view->headScript()->appendFile('/js/jquery.spin.js');
        
        $view->headScript()->appendFile('/js/index.js');
        $view->headScript()->appendFile('/js/user_click.js');
        
        
        return $view;
    }
    
    protected function _initAutoLoad()
    {
        
        $autoLoader = Zend_Loader_Autoloader::getInstance();
        
        $autoLoader->registerNamespace('Kh_');
        
        $resourseLoader = new Zend_Loader_Autoloader_Resource(array(
                'basePath' => APPLICATION_PATH,
                'namespace' => '',
                'resourceTypes' => array(
                    'model' => array(
                        'path'      => 'models/',
                        'namespace' => 'Model_'
                    ),
                    'form' => array(
                        'path'      => 'forms/',
                        'namespace' => 'Form_',
                    )
                ),
        ));
        $this->registerPluginResource('Kh_Application_Resource_Translate');
        return $autoLoader;
    }
}










