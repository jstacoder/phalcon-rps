<?php

use Phalcon\Forms\Form;

trait FormControlMixin {
    private static $_class = 'form-control ';

    protected function set_class($attrs){
        $cls = static::$_class . (isset($attrs['class']) ? $attrs['class'] : '');
        $this->setAttribute('class',$cls);
    }
}

trait AutoIdMixin {
    public function __construct($name,$attrs){
        if(!isset($attrs['id'])){
            $attrs['id'] = $name;
        }
        if(!isset($attrs['label'])){
            $attrs['label'] = ucfirst($name);
        }
        parent::__construct($name,$attrs);
    }
}

trait AddFieldMixin {
    public function add_field($field_class,$name,$id=null,$label=null,$class=null){
        $field_class = ucfirst($field_class);
        $field_class = "\Phalcon\Forms\Element\$field_class";
        if(class_exists($field_class)){
            $class = is_null($class) ? 'form-control' : "$class form-control";
            $id = is_null($id) ? $name : $id;
            $label = ucfirst(is_null($label) ? $name : $label);
            $field = new $field_class($name,array('id'=>$id,'class'=>$class));
            $field->id = $id;
            $field->setLabel($label);
            $this->add($field);
        }
    }
}

class BaseForm extends Form{
    use AddFieldMixin;
}
