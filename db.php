<?php

use Phalcon\Tag;

$config = require_once __DIR__.'/app/config/config.php';
require_once __DIR__.'/app/config/loader.php';
require_once __DIR__.'/app/config/services.php';


class MyMsg extends \Phalcon\Mvc\Model\Message {
    private $_default_type = 'warning';
    private $_types = ['danger','warning','info','success'];

    private  function _capture_content($func){
        ob_start();
        echo $func();
        return ob_get_clean();
    }

    public function __toString(){
        $type = $this->getType();
        return $this->div(function(){
            return $this->getMessage().$this->span(function(){
                return 'X';
            },array('class'=>'close'));
        },array('class'=>"alert alert-$type"));
    }

    private function _tag($name,$attrs){
        return Tag::tagHtml($name,$attrs);
    }
    private function close($name){
        return Tag::tagHtmlClose($name);
    }
    private function tag($name,$func,$attrs){
        return $this->_capture_content(function() use ($func,$attrs,$name){
            return $this->_tag($name,$attrs).$func().$this->close($name);
        });
    }
    public function div($func,$attrs=array()){
        return $this->tag('div',$func,$attrs);
    }
    public function span($func,$attrs=array()){
        return $this->tag('span',$func,$attrs);
    }
    public function setType($type){
        if(!in_array($type,$this->_types)){
            $type = $this->_default_type;
        }
        return parent::setType($type);        
    }
}


class User extends \Phalcon\Mvc\Model{
    public $name;
    public $password;
 
}

$user = new User();

$user->appendMessage(new MyMsg('Error!!!',null,'danger'));
foreach($user->getMessages() as $msg){
    echo $msg;
}

print_r(get_class_methods($user->getDI()->get('db')));
