<?php

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $name;

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
        $this->hasMany('id', 'PlayedGamesUsers', 'users_id', array('alias' => 'PlayedGamesUsers'));
        $this->hasMany('id', 'Scores', 'user_id', array('alias' => 'Scores'));
        $this->hasMany('id', 'PlayedGamesUsers', 'users_id', NULL);
        $this->hasMany('id', 'Scores', 'user_id', NULL);
    }

    public static function _getGames($id){
        $res = array();
        foreach(PlayedGames::find() as $g){
            if($g->users_id==$id){
                $res[] = $g;
            }
        }
        return $res;
    }

    public static function _getScores($id){
        $res = array();
        foreach(static::_getGames($id) as $g){
            foreach(Scores::find() as $s){
                if($s->played_game_id==$g->id){
                    $res[] = $s;
                }
            }
        }
        return $res;
    }

    public function getGames(){
        return static::_getGames($this->id);
    }

    public function getScores(){
        return static::_getScores($this->id);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
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
            'name' => 'name',
            'id' => 'id'
        );
    }

}
