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

class AddForm extends Form {
    public function __construct($entity=null,$attrs=null){
        parent::__construct($entity,$attrs);
        $name = new \Phalcon\Forms\Element\Text('name',array('class'=>'form-control'));
        $this->add($name);
    }
}


$get_quote = function($choice){
    return array(
        'rock'=>'rock smashes scissors',
        'paper'=>'paper covers rock',
        'scissors'=>'scissors cuts paper'
    )[$choice];
};

$get_rock_winner = function($choice){
    return array(
        'rock'=>'tie',
        'paper'=>'lose',
        'scissors'=>'win'
    )[$choice];
};
$get_paper_winner = function($choice){
    return array(
        'rock'=>'win',
        'paper'=>'tie',
        'scissors'=>'lose'
    )[$choice];
};
$get_scissors_winner = function($choice){
    return array(
        'rock'=>'lose',
        'paper'=>'win',
        'scissors'=>'tie'
    )[$choice];
};
$get_winner_func = function($choice) use ($get_rock_winner,$get_paper_winner,$get_scissors_winner){
    return array(
        'rock'=>$get_rock_winner,
        'paper'=>$get_paper_winner,
        'scissors'=>$get_scissors_winner
    )[$choice];
};
$get_winner = function($choice_a,$choice_b) use ($get_winner_func){
    return call_user_func($get_winner_func($choice_a),$choice_b);
};
$choices = array(
    'rock',
    'paper',
    'scissors'
);
$get_comp_choice = function() use ($choices){
    return $choices[array_rand($choices)];
};



$start = function() use ($app){
    $app['view']->form = new PlayerForm();
    $app['view']->addform = new AddForm();
    $app['view']->flash = $app->getDI()->getShared('session')->flash;

    $meths = get_class_methods($app['view']->form->get('user'));
    $rtn = '';
    foreach($meths as $meth){
        $rtn .= EOL . $meth;
    }
    $app['view']->meths = $rtn;
    echo $app['view']->render('start.volt');
};


$reset_game = function() use($app){
    $sess = $app->getDI()->get('session');
    $sess->wins = 0;
    $sess->losses = 0;
    $sess->ties = 0;
};
$add_win = function() use ($app){
    $app->getDI()->getShared('session')->wins = $app->getDI()->getShared('session')->wins + 1;
};
$add_loss = function() use ($app){
    $app->getDI()->getShared('session')->losses = $app->getDI()->getShared('session')->losses + 1;
};
$add_tie = function() use ($app){
    $app->getDI()->getShared('session')->ties = $app->getDI()->getShared('session')->ties + 1;
};

$pick = function() use ($app,$reset_game){
    $reset_game();
    $user_id = $app->request->getPost()['user'];
    $app->getDI()->get('session')->set('user_id',(int)$user_id);
    return $app->response->redirect('play');
};

$play = function() use ($app){
    //print_r(get_class_methods$app
    //if(!$app->getDI()->getShared('session')->has('user_id')){
    //    return $app->response->redirect('start');
    //}
    $user = 'None';
    $users = Users::find();
    $user_id = $app->getDI()->get('session')->user_id;
    //echo "ID: ".$user_id."<br/>";
    foreach($users->toArray() as $u){
        if($u['id'] == $user_id){
            $user = $u['name'];
        }
    }   
    $app->getDI()->get('session')->user_name = $user;
    $app['view']->user = $user;
    $app['view']->user_id = $user_id;
    $app['view']->wins = $app->getDI()->getShared('session')->wins;
    $app['view']->losses = $app->getDI()->getShared('session')->losses;
    $app['view']->ties = $app->getDI()->getShared('session')->ties;
    $app['view']->winpanel = 'primary';
    $app['view']->losepanel = 'danger';
    $app['view']->tiepanel = 'warning';
    echo $app['view']->render('play.volt');
};
$play_game = function($choice) use ($app,$get_comp_choice,$get_winner,$get_quote,$add_win,$add_loss,$add_tie){
    $choice_b = $get_comp_choice();
    $result = $get_winner($choice,$choice_b);
    if($result=='lose'){
        $quote = $get_quote($choice_b);
        $add_loss();
        $app['view']->added = 'loss';
        $app['view']->bg = 'danger';
    }elseif($result=='win'){
        $quote = $get_quote($choice);
        $app->getDI()->getShared('session')->wins++;
        $app['view']->added = 'win';
        $app['view']->bg = 'success';
        //$add_win();
    }else{
        $quote = 'Tie Game';
        $add_tie();
        $app['view']->added = 'tie';
        $app['view']->bg = 'warning';
    }
    $app['view']->winpanel = 'primary';
    $app['view']->losepanel = 'danger';
    $app['view']->tiepanel = 'warning';
    $app['view']->wins = $app->getDI()->getShared('session')->wins;
    $app['view']->losses = $app->getDI()->getShared('session')->losses;
    $app['view']->ties = $app->getDI()->getShared('session')->ties;
    $app['view']->user_choice = $choice;
    $app['view']->comp_choice = $choice_b;
    $app['view']->result = $result;
    $app['view']->quote = $quote;
    echo $app['view']->render('play-game-content.volt');
};

$add = function() use ($app){
    $app->getDI()->getShared('session')->remove('flash');
    $users = Users::find();
    $name = $app->request->getPost()['name'];
    foreach($users as $u){
        if($u->name == $name){
            $app->getDI()->getShared('session')->flash = $app->flash->error('That name is already picked, try again');
            return $app->response->redirect('start');
        }
    }
    $u = new Users();
    $u->name = $name;
    $u->save();
    $app->getDI()->getShared('session')->flash = $app->flash->success('You added a new name');
    return $app->response->redirect('start');
};

$save = function() use ($app){
    $post = json_decode(json_encode($app->request->getPost()));
    $user_id = $post->user_id;
    $wins = $post->wins;
    $losses = $post->losses;
    $ties = $post->ties;

    $game = new PlayedGames();
    $game->user_id = $user_id;
    $game->save();
    $score = new Scores();
    $score->wins = $wins;
    $score->losses = $losses;
    $score->ties = $ties;
    $score->played_game_id = $game->id;
    $score->save();
    $app->getDI()->getShared('session')->set('score',$score->id);
    return $app->response->redirect('save_page');
};

$save_page = function() use ($app) {
    $app['view']->user = $app->getDI()->get('session')->user_name;
    //$app['view']->score = array_filter(function($x) use ($app){ return $x->id === $app->getDI()->getShared('session')->get('score'); },Scores::find());
    $scores = Scores::find();
    foreach($scores as $s){
        echo '<pre>';
        print_r(json_encode($s));
        echo '</pre>';
        if((int)$s->id===(int)$app->getDI()->getShared('session')->get('score')){
            $app['view']->score = $s;//json_encode($s);
            $app['view']->wins = $s->wins;//json_encode($s);
            $app['view']->losses = $s->losses;//json_encode($s);
            $app['view']->ties = $s->ties;//json_encode($s);
        }
    }
    //echo (int)$app->getDI()->getShared('session')->get('score');
    echo $app['view']->render('save.volt');
};

$get_score_result = function($score){
    $max = 0;
    $res = false;
    foreach(array('wins','losses','ties') as $t){
        if($score->{$t}>$max){
            $max = $score->{$t};
            $res = $t;
        }
    }
    return $res;
};

$score_page = function($user_id) use ($app,$get_score_result) {
    $users = Users::find();
    $found = false;
    foreach($users as $u){
        if($u->id==$user_id){
            $app['view']->user = $u->name;
            $app['view']->scores = array_map(
                                        function($x) use ($get_score_result){ 
                                            return array_merge(
                                                        $x->toArray(),
                                                        array(
                                                            'date' => $x->getDate(),
                                                            'highlight' => $get_score_result(
                                                                                json_decode(
                                                                                        json_encode(
                                                                                            $x->toArray()
                                                                                        )
                                                                                )
                                                            )
                                                        )
                                            );
                                        },$u->getScores()
            );
            $found = true;
        }
    }
    if(!$found){
       $app['view']->scores = 'No User By That Id';
    }
    echo $app['view']->render('score_page.volt');
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
$app->post('/add',$add);
$app->get('/play/{choice}',$play_game);
$app->post('/save',$save);
$app->get('/save_page',$save_page);
$app->get('/scores/{user_id}',$score_page);

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});
