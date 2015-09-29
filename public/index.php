<?php
header('Content-Type: text/html; charset=UTF-8');
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap();
$router = Zend_Controller_Front::getInstance()->getRouter();

$router->addRoute(
    'loyalty',
    new Zend_Controller_Router_Route(
        '/loyalty/',
        array(
            'controller' => 'index',
            'action' => 'loyalty'
        )
    )
);

$router->addRoute(
    'about',
    new Zend_Controller_Router_Route(
        '/about/',
        array(
            'controller' => 'index',
            'action' => 'about'
        )
    )
);

$router->addRoute(
    'rules',
    new Zend_Controller_Router_Route(
        '/rules/',
        array(
            'controller' => 'index',
            'action' => 'rules'
        )
    )
);

$router->addRoute(
    'city',
    new Zend_Controller_Router_Route(
        '/city/',
        array(
            'controller' => 'index',
            'action' => 'city'
        )
    )
);


$router->addRoute(
    'apartments-rooms',
    new Zend_Controller_Router_Route(
        '/apartments/rooms/:rooms',
        array(
            'controller' => 'apartments',
            'action' => 'index'
        )
    )
);
$router->addRoute(
    'apartments',
    new Zend_Controller_Router_Route(
        '/apartments/',
        array(
            'controller' => 'apartments',
            'action' => 'index'
        )
    )
);
$router->addRoute(
    'apartment',
    new Zend_Controller_Router_Route(
        '/apartment/:id',
        array(
            'controller' => 'apartments',
            'action' => 'details'
        )
    )
);


$application->run();