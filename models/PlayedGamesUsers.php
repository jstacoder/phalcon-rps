<?php

class PlayedGamesUsers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $users_id;

    /**
     *
     * @var integer
     */
    public $played_games_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('users_id', 'Users', 'id', array('alias' => 'Users'));
        $this->belongsTo('played_games_id', 'PlayedGames', 'id', array('alias' => 'PlayedGames'));
        $this->belongsTo('users_id', 'Users', 'id', array('foreignKey' => true));
        $this->belongsTo('played_games_id', 'Playedgames', 'id', array('foreignKey' => true));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'played_games_users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PlayedGamesUsers[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PlayedGamesUsers
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
            'users_id' => 'users_id',
            'played_games_id' => 'played_games_id'
        );
    }

}
