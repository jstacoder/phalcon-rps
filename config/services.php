<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Mvc\View\Simple as View;
use Phalcon\Mvc\View\Engine\Volt as Engine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Flash\Direct as Flash;

require __DIR__ . '/Database.php';

$di = new FactoryDefault();

$di->set('flash',function(){
    $base = 'alert alert-';
    return new Flash(array(
        'error'=>$base.'danger',
        'success'=>$base.'success',
        'notice'=>$base.'info',
        'warning'=>$base.'warning'
    ));
});

$di->setShared('session',function() use ($config){
    $conn = new DbAdapter($config->database->toArray());
    $session = new Database(array(
        'db'=>$conn,
        'table'=>'session_data'
    ));
    $session->start();
    return $session;
});

/**
 * Sets the view component
 */
$di->setShared('view', function () use ($config) {
    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    $view->registerEngines(
        array(
            ".volt"=> 'Phalcon\Mvc\View\Engine\Volt',
            ".phtml"=> 'Phalcon\Mvc\View\Engine\Php'
        )
    );
    return $view;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter($config->database->toArray());
});
