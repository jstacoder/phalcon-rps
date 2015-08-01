<?php
$config = require_once __DIR__.'/app/config/config.php';
require_once __DIR__.'/app/config/loader.php';
require_once __DIR__.'/app/config/services.php';

$kyle = User::get_or_create('name','jules');
$kyle->id ?: $kyle->save;
print_r($kyle->name);
echo PHP_EOL;
print_r($kyle->id);
echo PHP_EOL;
