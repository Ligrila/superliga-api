<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GenericQuestions Model
 *
 * @property \App\Model\Table\TriviasTable|\Cake\ORM\Association\BelongsTo $Trivias
 * @property \App\Model\Table\TeamsTable|\Cake\ORM\Association\BelongsTo $Teams
 *
 * @method \App\Model\Entity\GenericQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\GenericQuestion newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GenericQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GenericQuestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GenericQuestion|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GenericQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GenericQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GenericQuestion findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GenericQuestionsTable extends Table
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

        $this->setTable('generic_questions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Trivias', [
            'foreignKey' => 'trivia_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('ADmad/Sequence.Sequence', [
            'order' => 'position', // Field to use to store integer sequence. Default "position".
            'scope' => ['trivia_id'], // Array of field names to use for grouping records. Default [].
            'start' => 1, // Initial value for sequence. Default 1.
        ]);

        $this->addBehavior('CounterCache', [
            'Trivias' => [
                'generic_questions_count'
            ]
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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('question')
            ->maxLength('question', 500)
            ->requirePresence('question', 'create')
            ->notEmptyString('question');

        $validator
            ->scalar('option_1')
            ->maxLength('option_1', 255)
            ->requirePresence('option_1', 'create')
            ->notEmptyString('option_1');

        $validator
            ->scalar('option_2')
            ->maxLength('option_2', 255)
            ->requirePresence('option_2', 'create')
            ->notEmptyString('option_2');

        $validator
            ->scalar('option_3')
            ->maxLength('option_3', 255)
            ->requirePresence('option_3', 'create')
            ->notEmptyString('option_3');

        $validator
            ->scalar('correct_option')
            ->allowEmptyString('correct_option');

        $validator
            ->integer('points')
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
        $rules->add($rules->existsIn(['team_id'], 'Teams'));

        return $rules;
    }
    public function getOptions(){
        return [
            'option_1' => 'Opción 1',
            'option_2' => 'Opción 2',
            'option_3' => 'Opción 3',
        ];
    }
}
