<?php

class BaseModel extends \Phalcon\Mvc\Model {
    public static function get_or_create($field,$val){
        $method = "findFirstBy$field";
        $res = static::{$method}($val);
        if(!$res){
            $res = new static();
            $res->{$field} = $val;
            $res->save();
        }
        return $res;
    }
}
