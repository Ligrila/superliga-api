<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ChampionshipsUsersPointsTriviasSumsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {

        parent::initialize($config);
        $schema = new \Cake\Database\Schema\TableSchema('championship_users_points_trivias_sums');
        $schema
            ->addColumn('championship_id', ['type' => 'uuid'])
            ->addColumn('trivia_id', ['type' => 'uuid'])
            ->addColumn('points', ['type' => 'integer'])

            ;
        $this->setSchema($schema);

        $this->setTable('championships_users_points_trivias_sums');

        $this->belongsTo('Championships', [
            'foreignKey' => 'championship_id',
            'joinType' => 'INNER'
        ]);

    }
}
