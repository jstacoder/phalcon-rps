<?php

class PlayerForm extends BaseForm {
    public function __construct(){
        $txt = new \Phalcon\Forms\Element\Text('name',array('id'=>'name','class'=>'form-control'));
        $txt->setLabel('Name');
        $this->add($txt);
        $pw = new \Phalcon\Forms\Element\Password('password',array('class'=>'form-control','id'=>'password'));
        $pw->setLabel('Password');
        $this->add($pw);
        $c = new \Phalcon\Forms\Element\Password('confirm',array('class'=>'form-control','id'=>'confirm'));
        $c->setLabel('Confirm');
        $this->add($c);
        $sub = new \Phalcon\Forms\Element\Submit('play',array('class'=>'btn btn-primary','id'=>'play'));
        $sub->setAttribute('value','Play');
        $this->add($sub);
    }
}
