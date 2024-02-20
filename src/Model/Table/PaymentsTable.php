<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Payments Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\LivesTable|\Cake\ORM\Association\HasMany $Lives
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\HasMany $Orders
 *
 * @method \App\Model\Entity\Payment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Payment newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Payment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Payment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Payment|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Payment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Payment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Payment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PaymentsTable extends Table
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

        $this->setTable('payments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Lives', [
            'foreignKey' => 'payment_id'
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'payment_id'
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
            ->scalar('method')
            ->maxLength('method', 255)
            ->requirePresence('method', 'create')
            ->notEmptyString('method');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->dateTime('m')
            ->allowEmptyString('m');

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
        $rules->add($rules->isUnique(
            ['payment_id'],
            'El ID de pago debe ser único.'
        ));

        return $rules;
    }

    public function createPayment($merchant_order_info){
        $item_id = $merchant_order_info['items'][0]['id'];
        $total = $merchant_order_info["response"]["total_amount"];
        $method = 'MercadoPago';
        $entity = $this->newEmptyEntity();
        $entity->method = $method;
        //$entity->user_id = ;
        $entity->amount = $total;
        return $this->save($entity);
    }
}
