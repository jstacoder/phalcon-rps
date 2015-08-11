<?php
/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */


use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Select as SelectField;
use Phalcon\Forms\Element\Text as StringField;
use Phalcon\Forms\Element\Submit as SubmitField;
use Phalcon\Mvc\Model;

define('EOL','<br />');

class PlayerForm extends Form {
    public function __construct($entity=null,$attrs=null){
        parent::__construct($entity,$attrs);
        $results = array();
        $users = Users::find();
        foreach($users as $u){
            $results[$u->id] = $u->name;
        }
        $user_select = new SelectField(
                'user',
                $results,
                array('class'=>'form-control')
        );
    
        //$user_select->setId('user');
        $this->add($user_select);
    }
}

$get_quote = function($choice){
    $quotes = array(
        'rock'=>'rock smashes scissors',
        'paper'=>'paper covers rock',
        'scissors'=>'scissors cuts paper'
    );
    return $quotes[$choice];
};

$get_rock_winner = function($choice){
    $results = array(
        'rock'=>'tie',
        'paper'=>'lose',
        'scissors'=>'win'
    );
    return $results[$choice];
};
$get_paper_winner = function($choice){
    $results = array(
        'rock'=>'win',
        'paper'=>'tie',
        'scissors'=>'lose'
    );
    return $results[$choice];
};
$get_scissors_winner = function($choice){
    $results = array(
        'rock'=>'lose',
        'paper'=>'win',
        'scissors'=>'tie'
    );
    return $results[$choice];
};
$get_winner_func = function($choice) use ($get_rock_winner,$get_paper_winner,$get_scissors_winner){
    $funcs = array(
        'rock'=>$get_rock_winner,
        'paper'=>$get_paper_winner,
        'scissors'=>$get_scissors_winner
    );
    return $funcs[$choice];
};

$get_winner = function($choice_a,$choice_b) use ($get_winner_func){
    $func = $get_winner_func($choice_a);
    return $func($choice_b);
};


$start = function() use ($app){
    $app['view']->form = new PlayerForm();

    $meths = get_class_methods($app['view']->form->get('user'));
    $rtn = '';
    foreach($meths as $meth){
        $rtn .= EOL . $meth;
    }
    $app['view']->meths = $rtn;
    echo $app['view']->render('start.volt');
};

$pick = function() use ($app){
    $user_id = $app->request->getPost('user');
    $user = Users::find(array('id'=>$user_id));
    $app->getDI()->getShared('session')->user_id = $user_id;
    return $app->response->redirect('play');
};

$play = function() use ($app){
    //print_r(get_class_methods$app
    //if(!$app->getDI()->getShared('session')->has('user_id')){
    //    return $app->response->redirect('start');
    //}
    $user = 'None';
    $users = Users::find();
    $user_id = $app->getDI()->getShared('session')->user_id;
    foreach($users->toArray() as $u){
        print_r($u);
        if($u['id'] == $user_id){
            $user = $u['name'];
        }
    }   
    $app['view']->user = $user;
    echo $app['view']->render('play.volt');
};
$choices = array(
    'rock',
    'paper',
    'scissors'
);
$get_comp_choice = function() use ($choices){
    return $choices[array_rand($choices)];
};

$play_game = function($choice) use ($app,$get_comp_choice,$get_winner,$get_quote){
    $choice_b = $get_comp_choice();
    $result = $get_winner($choice,$choice_b);
    if($result=='lose'){
        $quote = $get_quote($choice_b);
    }elseif($result=='win'){
        $quote = $get_quote($choice);
    }else{
        $quote = 'Tie Game';
    }
    $app['view']->user_choice = $choice;
    $app['view']->comp_choice = $choice_b;
    $app['view']->result = $result;
    $app['view']->quote = $quote;
    echo $app['view']->render('play-game.volt');
};

/**
 * Add your routes here
 */
$app->get('/', function () use ($app) {
    echo $app['view']->render('index.volt');
});

$app->get('/start',$start);
$app->post('/pick',$pick);
$app->get('/play',$play);
$app->get('/play/{choice}',$play_game);

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});
