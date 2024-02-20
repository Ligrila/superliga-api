<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Championships Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ChampionshipUsersTable|\Cake\ORM\Association\HasMany $ChampionshipUsers
 *
 * @method \App\Model\Entity\Championship get($primaryKey, $options = [])
 * @method \App\Model\Entity\Championship newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Championship[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Championship|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Championship|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Championship patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Championship[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Championship findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChampionshipsTable extends Table
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

        $this->setTable('championships');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');


        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasOne('ChampionshipsRankings', [
            'foreignKey' => 'championship_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('ChampionshipUsers', [
            'foreignKey' => 'championship_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('ChampionshipsUsersPoints', [
            'foreignKey' => 'championship_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasOne('ChampionshipsUsersPointsSums', [
            'foreignKey' => 'championship_id',
            'joinType' => 'LEFT'
        ]);

        $this->addBehavior('S3', [
            'fields' => [
                'picture'
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
            ->scalar('id')
            ->maxLength('id', 36)
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');


        $validator
            ->allowEmptyString('picture');

        $validator
            ->allowEmptyString('picture_dir');

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

    public function afterSave(\Cake\Event\EventInterface $event, $entity, $options){
        if($entity->isNew()){
            //
            $championshipUser = $this->ChampionshipUsers->newEmptyEntity();
            $championshipUser->user_id = $entity->user_id;
            $championshipUser->championship_id = $entity->id;

            $this->ChampionshipUsers->save($championshipUser);

        }
    }

    public function subscribe($id,$user_id){
        $championshipUser = $this->ChampionshipUsers->newEmptyEntity();
        $championshipUser->user_id = $user_id;
        $championshipUser->championship_id = $id;

        $saved = $this->ChampionshipUsers->save($championshipUser);

        if($saved){
            $user =  $this->ChampionshipUsers->Users->get($user_id);
            $championship = $this->ChampionshipUsers->Championships->get($id);
           $NotificationsTable = \Cake\ORM\TableRegistry::get('Notifications');
           $entity = $NotificationsTable->newEmptyEntity();
           $entity->user_id = $championship->user_id;
           $entity->title = 'Un nuevo amigo ha ingresado al torneo.';
           $entity->body = __('{0} se a unido a tu torneo de amigos',$user->first_name);
           $entity->data = [
            'navigate' => 'ChampionshipView',
            'params' => compact('championship'),
            'payload' => $championshipUser
           ];
           $entity->notified = false;
           $NotificationsTable->save($entity);
        }
        return $saved;
    }

    public function ranking($id,$type=null){
        $championship = $this->get($id, [
            'contain' => ['ChampionshipUsers']
        ]);

        $userIds = \Cake\Utility\Hash::extract($championship, 'championship_users.{n}.user_id');

        $types = ['day','all','week','month','trivia'];


        if(!in_array($type,$types)){
            $type = 'day';
        }

        $minDate = null;
        $maxDate = null;

        $dateCast = false;
        $now  = \Cake\I18n\Date::now()->format('Y-m-d');

        $week = \Cake\I18n\Date::parse("-1 weeks")/*->format('Y-m-d')*/;
        $month = \Cake\I18n\Date::parse("-1 months")/*->format('Y-m-d')*/;


        switch($type){
            case 'day':
                $dateCast = true;
                $maxDate = $minDate = $now;break;
            case 'week':
                $minDate = $week; break;
            case 'month':
                $minDate = $month;break;
            case 'all':
                $minDate = $championship->created;
                break;
            default:break;
        }

        if($minDate<$championship->created){
            $minDate = $championship->created;
        }

        $items = \Cake\ORM\TableRegistry::get('TriviaPoints')
            ->find();
            $items->select(['TriviaPoints.user_id','points' => $items->func()->sum('TriviaPoints.points'),'Users.first_name','Users.last_name'])
                ->where(
                ['TriviaPoints.user_id IN'=>$userIds]
            )
                ->group(['TriviaPoints.user_id','Users.first_name','Users.last_name'])
                ->order(['points'=>'DESC']);

        if($type=='trivia'){
            $trivia = \Cake\ORM\TableRegistry::get('Trivias')->find()
                ->where([
                    'finished'=>true,
                    'created >=' => $championship->created
                ])
                ->select(['id'])
                ->order(
                    ['Trivias.start_datetime'=>'DESC']
                )->first();


            if($minDate&&$maxDate){
                $trivia->where(
                    [
                        ['DATE(Trivias.start_datetime) >=' => $minDate],
                        ['DATE(Trivias.start_datetime) <=' => $maxDate],
                    ]
                    );
            }


                $trivia_id = '00000000-0000-0000-0000-000000000000';
                if(!empty($trivia)){
                    $trivia_id = $trivia->id;
                }
                $items->contain(['Users']);
                $items->where(
                    [
                        ['trivia_id =' => $trivia_id],
                    ]
                    );


        } else{
            $items->contain(['Trivias','Users']);
            if($minDate&&$maxDate){
                $items
                    ->where([
                        ['DATE(Trivias.start_datetime) >=' => $minDate],
                        ['DATE(Trivias.start_datetime) <=' => $maxDate],
                        ]
                    );
            }
            if($minDate&&!$maxDate){
                $items
                ->where([
                    ['Trivias.start_datetime >=' => $minDate]
                    ]
                );
            }
        }
        return $items;
    }
}
