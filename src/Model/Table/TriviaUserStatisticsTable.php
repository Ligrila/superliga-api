<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TriviaPoints Model
 *
 * @property \App\Model\Table\TriviasTable|\Cake\ORM\Association\BelongsTo $Trivias
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\TriviaPoint get($primaryKey, $options = [])
 * @method \App\Model\Entity\TriviaPoint newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TriviaPoint[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TriviaPoint|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TriviaPoint|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TriviaPoint patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TriviaPoint[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TriviaPoint findOrCreate($search, callable $callback = null, $options = [])
 */
class TriviaUserStatisticsTable extends Table
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
        $schema = new \Cake\Database\Schema\TableSchema('trivia_user_statistics');
        $schema
            ->addColumn('position', ['type' => 'integer'])
            ->addColumn('points', ['type' => 'integer'])
            ->addColumn('trivia_id', ['type' => 'uuid'])
            ->addColumn('user_id', ['type' => 'uuid'])
            ->addColumn('correct_answers_count', ['type' => 'integer'])
            ->addColumn('wrong_answers_count', ['type' => 'integer'])
            ->addColumn('correct_answers_user_count', ['type' => 'integer'])
            ->addColumn('wrong_answers_user_count', ['type' => 'integer'])
            ->addColumn('general_position', ['type' => 'integer'])
            ->addColumn('general_points', ['type' => 'integer'])
            ;
        $this->setSchema($schema);

        $this->setTable('trivia_user_statistics');

        $this->belongsTo('Trivias', [
            'foreignKey' => 'trivia_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }
}
