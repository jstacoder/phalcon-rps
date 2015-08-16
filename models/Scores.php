<?php

class Scores extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $wins;

    /**
     *
     * @var integer
     */
    public $losses;

    /**
     *
     * @var integer
     */
    public $ties;

    /**
     *
     * @var integer
     */
    public $played_game_id;

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
        $this->belongsTo('played_game_id', 'PlayedGames', 'id', array('alias' => 'PlayedGames'));
        $this->belongsTo('played_game_id', 'Playedgames', 'id', array('foreignKey' => true));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'scores';
    }

    private function _make_two_digits($val){
        if(strlen($val)==2){
            return $val;
        }
        return strlen($val) == 1 ? "0$val" : false;
    }

    public function getPlayedGame(){
        return PlayedGames::getById($this->played_game_id);
    }
    public function getDate(){
        $dte = $this->getPlayedGame()->date;
        $dte = explode(' ',$dte)[0];    
        list($y,$m,$d) = explode('-',$dte);        
        $m = $this->_make_two_digits($m);
        $d = $this->_make_two_digits($d);
        return "$m-$d-$y";
    }

    public function getUser(){
        return Users::getById($this->getPlayedGame()->users_id);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Scores[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Scores
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
            'wins'=>'wins',
            'losses'=>'losses',
            'ties'=>'ties',
            'played_game_id' => 'played_game_id',
            'id' => 'id'
        );
    }

}
