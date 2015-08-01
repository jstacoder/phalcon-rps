<?php
$config = require(__DIR__.'/app/config/config.php');
require(__DIR__.'/app/config/services.php');

$tag = $di->get('tag');
$view = $di->get('view');
print_r((array)$view);
$compiler = new \Phalcon\Mvc\View\Engine\Volt\Compiler();

$s = '{{ link_to({"for":"menu/play","Play","class":"btn btn-lg btn-success"}) }}';

#print_r($tag->linkTo(array('menu/play','Play','class'=>'btn btn-lg btn-primary')));
print_r($tag->linkTo(array(array('menu/play', 'Play', 'class' => 'btn btn-lg btn-success'))));
print_r($compiler->compileString($s));
