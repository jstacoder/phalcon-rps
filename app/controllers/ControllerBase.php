<?php

use Phalcon\Mvc\Controller;

class NavLink {
    private $_text;
    private $_href;
    private $_active;
    private $_order;
    private static $_count = 0;

    public function __get($attr){
        if(in_array($attr,['text','href','active','order'])){
            return $this->{"_$attr"};
        }
    }
    public function __set($attr,$val){
        if(in_array($attr,['text','href','active','order'])){
            $this->{"_$attr"} = $val;
        }
    }
    public function __construct($text,$link=null,$active=false){
        $this->href = is_null($link) ? "/$text" : $link;
        $this->text = $text;
        $this->active = $active;
        static::$_count = self::$_count = self::$_count + 1;
        $this->order = static::$_count;
    }
    public function __invoke($active=null){
        $this->active = is_null($active) ? $this->active : $active;
        return $this;
    }
}

class ControllerBase extends Controller
{
    public static $_links = array();

    public function initalize(){
        if($this->session->has('current_player')){
            $this->view->current_player = $this->session->current_player;
        }
    }

    public static function setLinks(){
        $links = array(array('text'=>'home','url'=>'/'),array('text'=>'menu','url'=>'/menu'),array('text'=>'scores','url'=>'/scores'));
        foreach($links as $data){
            self::newLink($data['text'],$data['url']);
        }
    }

    public static function newLink($text,$href=null){
        self::addLink(new NavLink($text,$href));
    }

    public static function addLink(NavLink $link){
        self::$_links[$link->text] = $link;
    }
    public static function getLinks(){
        return self::$_links;
    }
    public static function setActive($name){
        if($link = self::getLinks()[$name]){
            self::addLink($link(true));
        }        
    }
}
//print_r($n('xxx','/rrr.com',true));
