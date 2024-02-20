<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dates Model
 *
 * @method \App\Model\Entity\Date get($primaryKey, $options = [])
 * @method \App\Model\Entity\Date newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Date[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Date|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Date|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Date patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Date[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Date findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DatesTable extends Table
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

        $this->setTable('dates');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');


        $this->hasMany('Trivias', [
            'foreignKey' => 'date_id',
            'className' => 'Trivias',
            'joinType' => 'LEFT',
            'sort'=>['Trivias.start_datetime'=>'ASC']
        ]);

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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->date('from_date')
            ->requirePresence('from_date', 'create')
            ->notEmptyString('from_date');

        $validator
            ->date('to_date')
            ->requirePresence('to_date', 'create')
            ->notEmptyString('to_date');

        return $validator;
    }

    public function getCurrentDate(){


        $query = $this
            ->find()
            ->where(['from_date <='=>\Cake\I18n\Time::now()])
            ->order(['from_date'=>'DESC'])
            ->first();

        if(empty($query)){
            return false;
        }

        return $query;


    }
}
