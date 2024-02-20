<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WrongAnswers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\QuestionsTable|\Cake\ORM\Association\BelongsTo $Questions
 * @property \App\Model\Table\TriviasTable|\Cake\ORM\Association\BelongsTo $Trivias
 *
 * @method \App\Model\Entity\WrongAnswer get($primaryKey, $options = [])
 * @method \App\Model\Entity\WrongAnswer newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WrongAnswer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WrongAnswer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WrongAnswer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WrongAnswer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WrongAnswer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WrongAnswer findOrCreate($search, callable $callback = null, $options = [])
 */
class WrongAnswersTable extends Table
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

        $this->setTable('wrong_answers');
        $schema = new \Cake\Database\Schema\TableSchema('wrong_answers');
        $schema
            ->addColumn('id', ['type' => 'uuid'])
            ->addColumn('user_id', ['type' => 'uuid'])
            ->addColumn('question_id', ['type' => 'uuid'])
            ->addColumn('trivia_id', ['type' => 'uuid'])
            ->addColumn('lives', ['type' => 'integer'])
            ->addColumn('created', ['type' => 'datetime']);
        $this->setSchema($schema);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Trivias', [
            'foreignKey' => 'trivia_id',
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
            ->uuid('id')
            ->requirePresence('id', 'create')
            ->notEmptyString('id');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['question_id'], 'Questions'));
        $rules->add($rules->existsIn(['trivia_id'], 'Trivias'));

        return $rules;
    }
}
