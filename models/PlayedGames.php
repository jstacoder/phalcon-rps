<?php

class PlayedGames extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $users_id;

    /**
     *
     * @var string
     */
    public $date;

    /**
     *
     * @var integer
     */
    public $id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Scores', 'played_game_id', array('alias' => 'Scores'));
        $this->belongsTo('users_id', 'Users', 'id', array('alias' => 'Users'));
    }


    public static function getById($id){
        $rtn = null;
        foreach(parent::find() as $g){
            if($g->id == $id){
                return $g;
            }
        }
        return $rtn;
    }

    public function getUser(){
        $users = Users::find();
        foreach($users as $u){
            if((int)$u->id===(int)$this->users_id){
                return $u;
            }
        }
        return false;
    }
    public function getScores(){
        $scores = Scores::find();
        $results = array();
        foreach($scores as $s){
            if($s->played_game_id==$this->id){
                $results[] = $s;
            }
        }
        return !empty($results) ? $results : false;
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PlayedGames[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PlayedGames
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    public function save($data=null,$whiteList=null){
        $this->date = date("Y-m-d H:i:s");
        parent::save($data,$whiteList);
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return array(
            'users_id'=>'users_id',
            'date' => 'date',
            'id' => 'id'
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'played_games';
    }

}
