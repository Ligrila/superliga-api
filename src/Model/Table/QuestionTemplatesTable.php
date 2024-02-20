<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QuestionTemplates Model
 *
 * @method \App\Model\Entity\QuestionTemplate get($primaryKey, $options = [])
 * @method \App\Model\Entity\QuestionTemplate newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\QuestionTemplate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\QuestionTemplate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QuestionTemplate|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QuestionTemplate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionTemplate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionTemplate findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuestionTemplatesTable extends Table
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

        $this->setTable('question_templates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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

        return $validator;
    }
}
