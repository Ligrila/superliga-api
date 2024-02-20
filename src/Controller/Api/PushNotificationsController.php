<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

/**
 * PushNotifications Controller
 *
 * @property \App\Model\Table\PushNotificationsTable $PushNotifications
 *
 * @method \App\Model\Entity\PushNotification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PushNotificationsController extends ApiAppController
{

    public $publicActions = ['add'];

    public function add()
    {
        $user = $this->Auth->identify();
        $pushNotification = $this->PushNotifications->newEmptyEntity();

        $saved = false;
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if(!empty($data['token'])){
                $pn = $this->PushNotifications->find()
                    ->where(['token'=>$data['token']])
                    ->first();
                if($pn){
                    // update
                    $pushNotification = $pn;
                }

            }
            if($user){
                $pushNotification->user_id = $user['sub'];
            }
            $pushNotification = $this->PushNotifications->patchEntity($pushNotification,$data);

            $saved = $this->PushNotifications->save($pushNotification);
        }

        $this->apiResult($saved,$pushNotification);
    }




}
