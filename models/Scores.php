<?php

class Scores extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     *
     * @var string
     */
    public $value;

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
        $this->belongsTo('user_id', 'Users', 'id', array('alias' => 'Users'));
        $this->belongsTo('played_game_id', 'PlayedGames', 'id', array('alias' => 'PlayedGames'));
        $this->belongsTo('user_id', 'Users', 'id', array('foreignKey' => true));
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
            'user_id' => 'user_id',
            'value' => 'value',
            'played_game_id' => 'played_game_id',
            'id' => 'id'
        );
    }

}
