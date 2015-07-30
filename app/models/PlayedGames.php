<?php

class PlayedGame extends BaseModel
{

    /**
     *
     * @var string
     */
    protected $date;

    /**
     *
     * @var integer
     */
    protected $id;

    public function getSource(){
            return 'played_games';
    }

    /**
     * Method to set the value of field date
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Returns the value of field date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'PlayedGamesUsers', 'played_games_id', array('alias' => 'PlayedGamesUsers'));
        $this->hasMany('id', 'Scores', 'played_game_id', array('alias' => 'Scores'));
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

}
