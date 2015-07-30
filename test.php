<?php
error_reporting(E_ALL);
define('APP_PATH', realpath('.'));
define('HTML_EOL','<br />');
$config = include APP_PATH . "/app/config/config.php";
include APP_PATH . "/app/config/loader.php";
include APP_PATH . "/app/config/services.php";

$new_user = function($name,$pw){
    $user = new User;
    $user->setName($name);
    $user->setPassword($pw);
    return $user->save() ? $user : false;
};
$get_user = function($data) use ($new_user){
    if(is_string($data)){
        $data = array('name'=>$data);
    }
    if(!$user = User::findFirstByName($data['name'])){
        if(!isset($data['pw'])){
            throw(new Exception('Need to set pw'));
        }else{
            $user = $new_user($data['name'],$data['pw']);
        }
    }else{
        return $user;
    }
};
$print_attr = function($obj,$attr,$newline=true,$num=null){
    $attr = ucfirst($attr);
    $func = "get$attr";
    $val = $obj->{$func}();
    $len = strlen($val);
    $num = $num ?:12;
    $fmtnum = $num + $len;
    $fmt = $newline ? "%$fmtnum"."s\n" : "%-$num"."s";
    $v = printf($fmt,$val);
};
$get_line = function($size){
    $d = "-";
    while(strlen($d) < ($size*1.5)){
        $d.="-";
    }
    return $d;
};
$print_line = function($size) use ($get_line){
    printf("%s\n",$get_line($size));
};
$get_lengths = function($base){
    $b = $base*2;
    $rtn = array('base'=>$base,'high'=>$b+($base/2),'low'=>$b-($base/2));
    return $rtn;
};

$get_cols = function($table) use ($di) {
    $cols = array();
    foreach($di->get("db")->describeColumns($table) as $col){
        $cols[] = $col->getName();
    }
    return array_reverse($cols);
};

$printf_array = function($fmt,$arr) {
    call_user_func_array('printf',array_merge((array)$fmt,$arr));
};

$print_type = function($type,$fmtNum) use ($print_line,$print_attr,$get_lengths,$get_cols,$printf_array){
    $lens = $get_lengths($fmtNum);
    $low = $lens['low'];
    $cols = $get_cols($type);
    $str = "";
    $colArgs = array();
    foreach($cols as $col){
        if(array_search($col,$cols)==0){
            $str .= "%s";
        }else{
            $str .= "%$low"."s";
        }
        $colArgs[] = [$col,array_search($col,$cols)==(sizeof($cols)-1) ? true : false];
    }
    $str = $str . "\n";
    $printf_array($str,$cols);
    $print_line($lens['high']);
    $tmp = str_split($type);
    unset($tmp[sizeof($tmp)-1]);
    $clsName = implode($tmp);
    $cls = ucfirst($clsName);
    if(class_exists($cls)){
        foreach($cls::find() as $c){            
            foreach($colArgs as $args){
                $print_attr($c,$args[0],$args[1],$lens['base']);            
            }
        }
    }
};

$get_user(array('name'=>'kyle2','pw'=>'kyle3'));
$print_type('users',12);
#$print_users();
