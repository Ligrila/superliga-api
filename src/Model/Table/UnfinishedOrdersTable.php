<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * UnfinishedOrders Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UnfinishedOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\UnfinishedOrder newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UnfinishedOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UnfinishedOrder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UnfinishedOrder|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UnfinishedOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UnfinishedOrder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UnfinishedOrder findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UnfinishedOrdersTable extends Table
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

        $this->setTable('unfinished_orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->uuid('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('comments')
            ->maxLength('comments', 255)
            ->allowEmptyString('comments');

        $validator
            ->integer('points')
            ->allowEmptyString('points');

        $validator
            ->scalar('model')
            ->maxLength('model', 255)
            ->allowEmptyString('model');

        $validator
            ->scalar('foreign_key')
            ->maxLength('foreign_key', 36)
            ->allowEmptyString('foreign_key');

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

    public function start($data){
        $entity = $this->newEmptyEntity();
        $this->patchEntity($entity,$data);
        $saved = $this->save($entity);
        if($saved){
            return $entity;
        }

        return $saved;
    }

    public function end($entity,$amount,$payment_id){


        $paymentsModel = \Cake\ORM\TableRegistry::get('Payments');
        $livesModel = \Cake\ORM\TableRegistry::get('Lives');

        $payment = [
            'user_id' => $entity->user_id,
            'amount' => $amount,
            'payment_id'=> $payment_id,
            'method' => 'MercadoPago',
        ];
        $paymentEntity = $paymentsModel->newEmptyEntity();
        $paymentEntity = $paymentsModel->patchEntity($paymentEntity,$payment);

        $saved = $paymentsModel->save($paymentEntity);

        if($saved){
            $livesEntity = $livesModel->newEmptyEntity();
            $livePack = \Cake\ORM\TableRegistry::get('LivePacks')->get($entity->foreign_key);
            if($livePack->infinite){
                //crear vidas infinitas desde que se recibe el pago a un mes
                $infiniteLivesModel = \Cake\ORM\TableRegistry::get('InfiniteLives');
                $infiniteLivesEntity = $infiniteLivesModel->newEmptyEntity();
                $infiniteLivesEntity->user_id = $entity->user_id;
                $infiniteLivesEntity->payment_id = $paymentEntity->id;
                $infiniteLivesEntity->until = new \Cake\I18n\Time("+1 month");
                $infiniteLivesModel->save($infiniteLivesEntity);

            } else{
                // crear vidas
                $livesEntity->payment_id = $paymentEntity->id;
                $livesEntity->user_id = $entity->user_id;
                $livesEntity->lives = $livePack->lives;
                $livesModel->save($livesEntity);
            }

            $ordersModel = \Cake\ORM\TableRegistry::get('Orders');
            $data = $entity->toArray();
            unset($data['id']); // el id es uniqid
            $data['payment_id'] = $paymentEntity->id;
            // create order
            $orderEntity = $ordersModel->newEmptyEntity();
            $orderEntity = $ordersModel->patchEntity($orderEntity,$data);
            $saved = $ordersModel->save($orderEntity);
            if($saved){
                $this->notifyLives($entity->user_id,$livePack);
                if(!$livePack->infinite){
                    // solo borramos las que no son mensuales,
                    // ya que la mensual la necesitamos para referencia de lo que paga

                    $this->delete($entity);
                }
                $connection = ConnectionManager::get('default');
                try{
                    $connection->query("REFRESH MATERIALIZED VIEW life;")->execute();

                } catch(\Exception $e){
                    debug($e);
                }
            } else{
                throw new \Cake\Network\Exception\HttpException(json_encode($entity));
            }
            return $saved;
        } else{
            throw new \Cake\Network\Exception\HttpException(json_encode($paymentEntity));
        }

        return $saved;


    }

    private function notifyLives($user_id,$livePack){
        if(!$user_id){
            return;
        }
        $pushNotificationTable =  \Cake\ORM\TableRegistry::get('PushNotifications');
        $pushNotifications = $pushNotificationTable->find(
            'list',[
                'keyField' => 'token',
                'valueField' => 'token'
                ])->where([
                    'user_id' => $user_id,
                    'enabled' => true
        ]);


        $title = "Has comprado {$livePack->lives} vidas!";
        if($livePack->infinite){
            $title = "Has comprado vidas ilimitadas!";
        }

        $body  = "Tus vidas ya están listas para ser usadas";



        $pushNotificationTable->send($title,$body,null,$pushNotifications);
    }
}
