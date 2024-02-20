<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notifications Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Notification get($primaryKey, $options = [])
 * @method \App\Model\Entity\Notification newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Notification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Notification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notification|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Notification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Notification findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NotificationsTable extends Table
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

        $this->setTable('notifications');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('CounterCache', [
            'Users' => [
                'unreaded_notifications_count' => [
                    'conditions' => ['Notifications.unreaded' => true,'Notifications.visible'=>true]

                ]
            ]
        ]);
    }

    public function notify(\App\Model\Entity\Notification $entity,$categoryId=null,$expire=null){
        if($entity->notified){
            return false;
        }
        $entity->notified = true;
        $saved = $this->save($entity);
        if($saved){
            $this->PushNotifications = \Cake\ORM\TableRegistry::get('PushNotifications');
            $preselected = $this->PushNotifications->find('list',[
                'keyField' => 'token',
                'valueField' => 'token'
            ])->where(['user_id'=>$entity->user_id])
            ->where(['enabled'=>true]);

            if(!empty($preselected->toArray())){
                $entity->data['title'] = $entity->body;
                $this->PushNotifications->send($entity->title,$entity->body,$entity->data,$preselected,$categoryId,$expire);
            }
        }
        return $saved;

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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('title')
            ->allowEmptyString('title');

        $validator
            ->scalar('body')
            ->allowEmptyString('body');

        $validator
            ->allowEmptyString('data');

        $validator
            ->boolean('notified')
            ->allowEmptyString('notified');

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

        return $rules;
    }
}
