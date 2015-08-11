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

    public function getPlayedGame(){
        return PlayedGames::getById($this->played_game_id);
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
