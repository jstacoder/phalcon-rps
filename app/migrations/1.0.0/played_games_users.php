<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class PlayedGamesUsersMigration_100 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'played_games_users',
            array(
            'columns' => array(
                new Column(
                    'users_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'played_games_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'users_id'
                    )
                )
            ),
            'indexes' => array(
                new Index('users_id', array('users_id')),
                new Index('played_games_id', array('played_games_id'))
            ),
            'references' => array(
                new Reference('played_games_users_ibfk_1', array(
                    'referencedSchema' => 'rps',
                    'referencedTable' => 'users',
                    'columns' => array('users_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('played_games_users_ibfk_2', array(
                    'referencedSchema' => 'rps',
                    'referencedTable' => 'played_games',
                    'columns' => array('played_games_id'),
                    'referencedColumns' => array('id')
                ))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'latin1_swedish_ci'
            )
        )
        );
    }
}
