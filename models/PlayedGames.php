<?php

class PlayedGames extends \Phalcon\Mvc\Model
{

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
        $this->hasMany('id', 'PlayedGamesUsers', 'played_games_id', array('alias' => 'PlayedGamesUsers'));
        $this->hasMany('id', 'Scores', 'played_game_id', array('alias' => 'Scores'));
        $this->hasMany('id', 'PlayedGamesUsers', 'played_games_id', NULL);
        $this->hasMany('id', 'Scores', 'played_game_id', NULL);
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

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return array(
            'date' => 'date',
            'id' => 'id'
        );
    }

}
