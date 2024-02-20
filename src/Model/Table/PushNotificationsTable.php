<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ExponentPhpSDK\Exceptions\ExpoException;
use Spatie\Async\Pool;



class NotificationSender
{
    static private  $ch = null;
    const EXPO_API_URL = 'https://exp.host/--/api/v2/push/send';

    static private function logSend($response, $fileStart = null)
    {
        $d = date("Y-m-d");
        $fn = tempnam('/tmp', $fileStart . 'jugadasuperliga-' . $d . '-');

        file_put_contents($fn, JSON_ENCODE($response));
    }



    static private function prepareCurl()
    {
        // Create or reuse existing cURL handle
        static::$ch = static::$ch ?? curl_init();

        // Throw exception if the cURL handle failed
        if (!static::$ch) {
            throw new ExpoException('Could not initialise cURL!');
        }

        $ch = static::$ch;

        // Set cURL opts
        curl_setopt($ch, CURLOPT_URL, self::EXPO_API_URL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json',
            'accept-encoding: gzip, deflate',
            'content-type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return $ch;
    }

    static public function notify($recipients, $data)
    {
        foreach ($recipients as $token) {
            $postData[] = json_decode(json_encode($data + ['to' => trim($token)]), FALSE);
        }

        $ch = static::prepareCurl();

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        $response = static::executeCurl($ch);


        return $response;
    }

    /**
     * Executes cURL and captures the response
     *
     * @param $ch
     *
     * @return array
     */
    static private function executeCurl($ch)
    {
        $response = [
            'body' => curl_exec($ch),
            'status_code' => curl_getinfo($ch, CURLINFO_HTTP_CODE)
        ];

        return json_decode($response['body'], true)['data'];
    }


    /**
     * Determines if the request we sent has failed completely
     *
     * @param $response
     * @param array $interests
     *
     * @return bool
     */
    private function failedCompletely($response, array $interests)
    {
        $numberOfInterests = count($interests);
        $numberOfFailures = 0;

        foreach ($response as $item) {
            if ($item['status'] === 'error') {
                $numberOfFailures++;
            }
        }

        return $numberOfFailures === $numberOfInterests;
    }
}

/**
 * PushNotifications Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\PushNotification get($primaryKey, $options = [])
 * @method \App\Model\Entity\PushNotification newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PushNotification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PushNotification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PushNotification|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PushNotification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PushNotification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PushNotification findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PushNotificationsTable extends Table
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

        $this->setTable('push_notifications');
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
            ->requirePresence('token', 'create')
            ->notEmptyString('token');

        $validator
            ->allowEmptyString('user_id');

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
        //        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    // INESTABLE
    /*
    public function sendNew($title,$body,$data=[],$pushNotificationsPreSelected=[],$categoryId=null,$expire=null,$ttl=null){
        $interestDetails = ['Jugada SuperLiga'];
        if(!$pushNotificationsPreSelected){
            $pushNotifications = $this->find('list',[
                'keyField' => 'id',
                'valueField' => 'token'
            ])->where(['enabled'=>true]);
        } else{
            $pushNotifications = $pushNotificationsPreSelected;
        }
        //debug($pushNotificationsPreSelected);die;
        // You can quickly bootup an expo instance
        $expo = \ExponentPhpSDK\Expo::normalSetup();
        $_pushNotifications = array_reverse($pushNotifications->toArray());
        $chunkedPushNotifications = array_chunk($_pushNotifications, 1,true);

        $chunk=1;
        $mh = curl_multi_init();
        $allRequests = [];
        foreach($chunkedPushNotifications as $pushNotifications ){
            $notification = ['title'=>$title,'body' => $body];
            if(!empty($data)){
                $notification['data'] = $data;
            }

            if(!is_null($expire)){
                $notification['expiration']=(int)$expire;
            }
            if(!is_null($ttl)){
                $notification['ttl']=(int)$ttl;
            }
            if($categoryId){
                $notification['_category']=[$categoryId];
            }
            //$this->logSend($pushNotifications,"chunk-$chunk-ids-");
            try{

                $ch = $this->prepareNotify($pushNotifications,$notification);
                $allRequests[] = array('curl'=>$ch,'push'=>$pushNotifications);
                curl_multi_add_handle($mh, $ch);


            } catch(\Exception $e){
                debug($e);
            }

            $chunk++;
        }
        $running = null;
        do {
          curl_multi_exec($mh, $running);
        } while ($running);
        foreach($allRequests as $request){
            curl_multi_remove_handle($mh, $request['curl']);
            $response = curl_multi_getcontent($request['curl']);
            if($response[0]['status']== 'error'){
                $toDisableId = (array_keys($request['push'])[0]);
                $this->updateAll(
                    [  // fields
                        'enabled' => false,
                    ],
                    [  // conditions
                        'id' => $toDisableId
                    ]
                );

            }


        }
        curl_multi_close($mh);


    }*/

    public function send($title, $body, $data = [], $pushNotificationsPreSelected = null, $categoryId = null, $expire = null, $ttl = null)
    {
        $interestDetails = ['Jugada SuperLiga'];
        if (!$pushNotificationsPreSelected) {
            $pushNotifications = $this->find('list', [
                'keyField' => 'id',
                'valueField' => 'token'
            ])->where(['enabled' => true]);
        } else {
            $pushNotifications = $pushNotificationsPreSelected;
        }
        //debug($pushNotifications);die;
        // You can quickly bootup an expo instance
        $expo = \ExponentPhpSDK\Expo::normalSetup();
        $_pushNotifications = array_reverse($pushNotifications->toArray());
        $chunkedPushNotifications = array_chunk($_pushNotifications, 50, true);

        $chunk = 1;
        $pool = Pool::create();


        foreach ($chunkedPushNotifications as $pushNotificationsArray) {
            $data = json_decode(json_encode($data));
            //debug($data);

            $pool->add(function () use ($pushNotificationsArray, $title, $body, $data, $categoryId, $expire, $ttl) {
                $notification = ['title' => $title, 'body' => $body];
                if (!empty($data)) {
                    $notification['data'] = $data;
                }

                if (!is_null($expire)) {
                    $notification['expiration'] = (int)$expire;
                }
                if (!is_null($ttl)) {
                    $notification['ttl'] = (int)$ttl;
                }
                if ($categoryId) {
                    $notification['_category'] = [$categoryId];
                }
                //$this->logSend($pushNotifications,"chunk-$chunk-ids-");
                try {
                    $response = NotificationSender::notify($pushNotificationsArray, $notification);

                    return $response;
                } catch (\Exception $e) {
                    var_dump($e);
                }
            })->then(function ($response) use ($pool) {
                var_dump($response);
                //$this->logSend($response,"chunk-$chunk-res-");

                /*if($response[0]['status']== 'error'){
                    $toDisableId = (array_keys($pushNotifications)[0]);
                    $this->updateAll(
                        [  // fields
                            'enabled' => false,
                        ],
                        [  // conditions
                            'id' => $toDisableId
                        ]
                    );

                }*/
            });



            $chunk++;
        }
        $pool->wait();
    }



    static public function actions($id = null)
    {
        $act = [
            'navigate' => 'Ir a sección del APP',
            'link' => 'Ir a sitio web'
        ];
        if ($id) {
            return $act[$id];
        }

        return $act;
    }
    static public function actionsTargets($id = null)
    {
        $act = [
            'Home' => 'Inicio',
            'Notification' => 'Notificaciones',
            'ChampionshipHome' => 'Torneo amigos',
            'ChallengeHome' => 'Desafios',
            'AllChampionships' => 'Todos los torneos',
            'LivePacks' => 'Comprar vidas',
            'Calendar' => 'Fixture',
            'Awards' => 'Premios',
            'Statistics' => 'Estadísticas',
            'Tutorial' => 'Tutorial',
            'Ranking' => 'Ranking',
            'Contact' => 'Contacto',
            'Profile' => 'Perfil',
            'Rules' => 'Reglas del juego',
            'About' => 'Acerca app / actualizar',
        ];
        if ($id) {
            return $act[$id];
        }

        return $act;
    }
}
