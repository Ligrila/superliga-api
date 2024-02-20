<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ChampionshipsUsersPointsTable extends Table
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
        $schema = new \Cake\Database\Schema\TableSchema('championship_users_points');
        $schema
            ->addColumn('championship_id', ['type' => 'uuid'])
            ->addColumn('user_id', ['type' => 'uuid'])
            ->addColumn('points', ['type' => 'integer'])

            ;
        $this->setSchema($schema);

        $this->setTable('championships_users_points');

        $this->belongsTo('Championships', [
            'foreignKey' => 'championship_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }
}
