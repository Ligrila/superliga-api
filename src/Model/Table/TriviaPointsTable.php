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
class TriviaPointsTable extends Table
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
        $schema = new \Cake\Database\Schema\TableSchema('correct_answers');
        $schema
            ->addColumn('position', ['type' => 'integer'])
            ->addColumn('user_id', ['type' => 'uuid'])
            ->addColumn('trivia_id', ['type' => 'uuid'])
            ->addColumn('points', ['type' => 'integer'])
            ->addColumn('avg', ['type' => 'decimal']);
        $this->setSchema($schema);

        $this->setTable('trivia_points');

        $this->belongsTo('Trivias', [
            'foreignKey' => 'trivia_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): \Cake\Validation\Validator
    {
        $validator
            ->decimal('points')
            ->allowEmptyString('points');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): \Cake\ORM\RulesChecker
    {
        $rules->add($rules->existsIn(['trivia_id'], 'Trivias'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
