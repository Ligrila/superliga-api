<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChallengeRequests Model
 *
 * @property \App\Model\Table\ChampionshipsTable|\Cake\ORM\Association\BelongsTo $Championships
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ChallengeChampionshipsTable|\Cake\ORM\Association\BelongsTo $ChallengeChampionships
 *
 * @method \App\Model\Entity\ChallengeRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\ChallengeRequest newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ChallengeRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChallengeRequest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChallengeRequest|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChallengeRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ChallengeRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChallengeRequest findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChallengeRequestsTable extends Table
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

        $this->setTable('challenge_requests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Championships', [
            'foreignKey' => 'championship_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('ChallengeChampionships', [
            'foreignKey' => 'challenge_championship_id'
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
            ->boolean('notified')
            ->allowEmptyString('notified');

        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        $validator
            ->boolean('acepted')
            ->allowEmptyString('acepted');

        $validator
            ->dateTime('modifed')
            ->allowEmptyString('modifed');

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

        $rules->add($rules->isUnique(
            ['championship_id', 'challenge_championship_id'],
            'Ya hay una solicitud.'
        ));
        return $rules;
    }

    public function saveAndNotify($challengeRequest,$c1,$c2){
        $challengeRequest->championship_id = $c1->id;
        $challengeRequest->user_id = $c1->user_id;
        $challengeRequest->challenge_championship_id = $c2->id;
        $challengeRequest->challenge_user_id = $c2->user_id;

        $saved = $this->save($challengeRequest);
        if($saved){
            $NotificationsTable = \Cake\ORM\TableRegistry::get('Notifications');
            $entity = $NotificationsTable->newEmptyEntity();
            $entity->user_id = $challengeRequest->user_id;
            $entity->title = __('Han desafiado tu torneo {0}.',$c1->name);
            $entity->body = __('Tu torneo {0} ha sido desafiado por {1}',$c1->name,$c2->name);
            $entity->foreign_key = $challengeRequest->id;
            $entity->model = 'ChallengeRequest';
            $championship = $c1;
            $challengeChampionship = $c2;
            $entity->data = [
                'navigate' => 'ChallengeRequest',
                'params' => compact('challengeRequest','championship','challengeChampionship'),
                'payload' => $challengeRequest
            ];
            $entity->notified = false;
            $NotificationsTable->save($entity);

        }
        return $saved;
    }

    public function responseAndNotify($challengeRequest){
        if($challengeRequest->accepted){
            $ChallengesTable = \Cake\ORM\TableRegistry::get('Challenges');

            $challenge = $ChallengesTable->newEmptyEntity();
            $cKeys[$challengeRequest->championship_id] = $challengeRequest->user_id;
            $cKeys[$challengeRequest->challenge_championship_id] = $challengeRequest->challenge_user_id;
            ksort($cKeys);

            reset($cKeys);

            $championship1_id = key($cKeys);
            $user1_id = $cKeys[$championship1_id];
            end($cKeys);
            $championship2_id = key($cKeys);
            $user2_id = $cKeys[$championship2_id];

            $challengeData = compact('championship1_id','championship2_id','user1_id','user2_id');

            $challenge = $ChallengesTable->patchEntity($challenge,$challengeData);

            if(!$ChallengesTable->save($challenge)){
//                var_dump($challenge);
//                var_dump($challenge->errors());
//                die("die");
                return false;
            }

            $savedRequest = $this->save($challengeRequest);


            $NotificationsTable = \Cake\ORM\TableRegistry::get('Notifications');
            $c2 = \Cake\ORM\TableRegistry::get('Championships')->get($challengeRequest->challenge_championship_id);
            $entity = $NotificationsTable->newEmptyEntity();
            $entity->user_id = $c2->user_id;
            $entity->title = __('{0} han aceptado tu desafio.',$c2->name);
            $entity->body = __('Tu desafio ha sido aceptado');

            $entity->data = [
                'navigate' => 'ChallengeHome',
                'params' => [],
            ];
            $entity->notified = false;
            $NotificationsTable->save($entity);

            $notification = $NotificationsTable->find()->where(
                [
                    'foreign_key'=>$challengeRequest->id,
                    'model'=>'ChallengeRequest'
                ]
            )->first();
            if($notification){
                // actualizar la notificacion al usuario para cuando en la app
                // entre a notificaciones ya se muestre como notificada
                $notification->data['payload'] = $challengeRequest;
                $notification->visible = false;
                $NotificationsTable->save($notification);
            }
            return true;

        } else{

            $savedRequest = $this->save($challengeRequest);
            if($savedRequest){
                $NotificationsTable = \Cake\ORM\TableRegistry::get('Notifications');
                $notification = $NotificationsTable->find()->where(
                    [
                        'foreign_key'=>$challengeRequest->id,
                        'model'=>'ChallengeRequest'
                    ]
                )->first();
                if($notification){
                    // actualizar la notificacion al usuario para cuando en la app
                    // entre a notificaciones ya se muestre como notificada
                    $notification->data['payload'] = $challengeRequest;
                    $notification->visible = false;
                    $notification->unreaded = false;
                    $NotificationsTable->save($notification);
                }
            }
            return $savedRequest;

        }

        return false;
    }
}
