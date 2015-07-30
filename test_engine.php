<?php

$compiler = new \Phalcon\Mvc\View\Engine\Volt\Compiler();

$template = '{{ x }}';

print_r(eval($compiler->compileString($template,array('x'=>'success'))));
