<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

function get_data_array($url){
    $result = array(
        'charset'=>'utf8'
    );
    $adapter = explode('://',$url)[0];
    $url = explode("$adapter://",$url)[1];
    $adapter = ucfirst($adapter);
    $auth = explode('@',$url)[0];
    $hst = explode('@',$url)[1];
    $host = explode('/',$hst)[0];
    $db = explode('/',$hst)[1];
    $db = explode('?',$db)[0];
    $_auth = explode(':',$auth);
    $result['adapter'] = $adapter;
    $result['username'] = $_auth[0];
    $result['password'] = $_auth[1];
    $result['host'] = $host;
    $result['dbname'] = $db;
    return $result;
}
$cfg = array(
        'adapter'    => 'Mysql',
        'host'       => 'localhost',
        'username'   => 'rps2',
        'password'   => 'rps2',
        'dbname'     => 'rps2',
        'charset'    => 'utf8'
);

if(isset($_SERVER['CLEARDB_DATABASE_URL'])){
    $cfg = get_data_array($_SERVER['CLEARDB_DATABASE_URL']);
}

return new \Phalcon\Config(array(

    'database' => $cfg,

    'application' => array(
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'baseUri'        => '/',
    )
));
