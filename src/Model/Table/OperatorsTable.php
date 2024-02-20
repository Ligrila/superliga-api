<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Operators Model
 *
 * @method \App\Model\Entity\Operator get($primaryKey, $options = [])
 * @method \App\Model\Entity\Operator newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Operator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Operator|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Operator|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Operator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Operator[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Operator findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OperatorsTable extends Table
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

        $this->setTable('operators');
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
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('role')
            ->maxLength('role', 10)
            ->requirePresence('role', 'create')
            ->notEmptyString('role');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');

        $validator
            ->scalar('hash')
            ->maxLength('hash', 40)
            ->allowEmptyString('hash');

        $validator
            ->allowEmptyString('enabled');

        $validator
            ->scalar('document')
            ->maxLength('document', 55)
            ->allowEmptyString('document');

        $validator
            ->scalar('address')
            ->maxLength('address', 250)
            ->allowEmptyString('address');

        $validator
            ->scalar('postal_code')
            ->maxLength('postal_code', 50)
            ->allowEmptyString('postal_code');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 100)
            ->allowEmptyString('phone');

        $validator
            ->scalar('mobile_phone')
            ->maxLength('mobile_phone', 100)
            ->allowEmptyString('mobile_phone');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 100)
            ->allowEmptyString('fax');

        $validator
            ->scalar('dir')
            ->maxLength('dir', 255)
            ->allowEmptyString('dir');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->allowEmptyString('image');

        $validator
            ->scalar('about')
            ->allowEmptyString('about');

        $validator
            ->dateTime('last_login')
            ->allowEmptyString('last_login');

        $validator
            ->integer('login_count')
            ->allowEmptyString('login_count');

        $validator
            ->date('birth_date')
            ->allowEmptyString('birth_date');

        $validator
            ->scalar('city')
            ->maxLength('city', 300)
            ->allowEmptyString('city');

        $validator
            ->scalar('province')
            ->maxLength('province', 300)
            ->allowEmptyString('province');

        $validator
            ->scalar('nationality')
            ->maxLength('nationality', 255)
            ->allowEmptyString('nationality');

        $validator
            ->allowEmptyString('deleted');

        $validator
            ->boolean('receive_emails')
            ->allowEmptyString('receive_emails');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
