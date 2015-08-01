<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Flash\Session as FlashSession;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

$classes = array(
            "error"=>"alert alert-danger",
            "success"=>"alert alert-success",
            "notice"=>"alert alert-info",
            "warning"=>"alert alert-warning"
);

$di->set('flash',function() use ($classes){
   $flash = new Flash(
        $classes
    );
   return $flash;
});
$di->set('flashsession',function() use ($classes){
   $flash = new FlashSession(
        $classes
    );
   return $flash;
});



/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);


$volt_engine = function ($view, $di) use ($config) {

    $volt = new VoltEngine($view, $di);

    $volt->setOptions(array(
        'compiledPath' => $config->application->cacheDir,
        'compiledSeparator' => '_'
    ));
    return $volt;
};


/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($config,$volt_engine,$di) {
    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    $volt = $volt_engine($view,$di);
    $view->registerEngines(array(
                '.volt' => $volt,
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
            ));
    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter($config->database->toArray());
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});


return $di;
