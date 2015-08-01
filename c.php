<?php

class Base {

    public static $name;


    public function say($txt){
        echo "$txt".PHP_EOL;
    }

    public function init(){
        $this->say("class ".__CLASS__);
        $this->say("this class ".get_class($this));
        $this->say("this class name ".static::$name);
    }
    public function __construct(){
        $this->init();
        $this->setName();
    }
    public function setName(){
       static::$name = get_class($this);
    }
}

class N extends Base{
}

class A extends Base{
    public function __construct(){
        parent::__construct();
    }

}


$b = new Base();
$n = new N();
$a = new A();
