<?php 
$config = require 'config/config.php';
require 'config/loader.php';
require 'config/services.php';

$score_page = function($user_id) {
    $users = Users::find();
    foreach($users as $u){
        if($u->id==$user_id){
            return array_map(function($x){ return $x->toArray(); },$u->getScores());
        }
    }
    return false;
};
$game_page = function($user_id){
    foreach(Users::find() as $u){
        if($u->id==$user_id){
            return array_map(function($x){ return $x->toArray(); },$u->getGames());
        }
    }
};


$s = new Scores();
$g = new PlayedGames();
$u = new Users();


$u->name = 'jhhh';
$u->save();

$g->users_id = $u->id;

$g->save();

$s->wins = 4;
$s->losses = 4;
$s->ties = 4;

$s->played_game_id = $g->id;
$s->save();

print_r($s->getUser()->name);
