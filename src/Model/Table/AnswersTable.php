<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;


/**
 * Answers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\QuestionsTable|\Cake\ORM\Association\BelongsTo $Questions
 * @property \App\Model\Table\ProcessedAnswersTable|\Cake\ORM\Association\HasMany $ProcessedAnswers
 *
 * @method \App\Model\Entity\Answer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Answer newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Answer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Answer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Answer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Answer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Answer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Answer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AnswersTable extends Table
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

        $this->setTable('answers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('WrongAnswers', [
            'foreignKey' => 'answer_id'
        ]);
        $this->hasMany('CorrectAnswers', [
            'foreignKey' => 'answer_id'
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('selected_option')
            ->requirePresence('selected_option', 'create')
            ->notEmptyString('selected_option');

        $validator
            ->scalar('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmptyString('user_id');

        $validator
        ->add('selected_option', 'validOption', [
            'rule' => 'isValidOption',
            'message' => __('Respuesta invalida'),
            'provider' => 'table',
        ]);


        $validator
        ->add('user_id', 'validLives', [
            'rule' => 'userHasLives',
            'message' => __('No tienes vidas disponibles para responder'),
            'last' => true,
            'provider' => 'table'
        ]);


        $validator
        ->add('created', 'responseInTime', [
            'rule' => 'responseInTime',
            'message' => __('La respuesta no llegó a tiempo'),
            'last' => true,
            'provider' => 'table'
        ]);



        return $validator;
    }

    public function responseInTime($value, array $context){
        return true;
        $question = $this->Questions->find()
            ->select(['finished','created'])
            ->where(['id'=>$context['data']['question_id']])
            ->first();
        if(!$question){
            return false;
        }
        if($question->finished){
            //finalizada manualmente
            return false;
        }
        $diff = $value->timestamp - $question->created->timestamp;
        // 10 segundas desde que se lanza la respuesta
        // + 4 de compensación de retrazos
        $comp = 4;

        return ($diff >= 0) && ($diff <= (10 + $comp));
    }

    public function userHasLives($value, array $context){
        //$context['data']['lives']
        return true;
        // query lives table and check for error
        $user = $this->Users->get($value,[
            'contain'=>['Life','InfiniteLives']
        ]);

        /*$life = $this->Users->Life->find()
        ->where(['user_id'=>$value])
        ->first();*/
        if(!empty($user->infinite_lives)){
            return true;
        }

        if(empty($user->life)){
            return false;
        }

        return $user->life->lives >= $context['data']['lives'] ;
    }

    public function isValidOption($value, array $context)
    {
        return  in_array($value, ['option_1', 'option_2', 'option_3'], true);
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
        //$rules->add($rules->existsIn(['user_id'], 'Users','Usuario inválido'));
        //$rules->add($rules->existsIn(['question_id'], 'Questions','Pregunta inválida'));
        /*$rules->add($rules->isUnique(
            ['question_id', 'user_id'],
            'Ya has respondido a esta pregunta.'
        ));*/
        return $rules;
    }
}
