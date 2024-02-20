<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Application;
use Cake\Console\CommandRunner;
use DateTime;

/**
 * PushNotifications Controller
 *
 * @property \App\Model\Table\PushNotificationsTable $PushNotifications
 *
 * @method \App\Model\Entity\PushNotification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PushNotificationsController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $pushNotifications = $this->paginate($this->PushNotifications);

        $this->set(compact('pushNotifications'));
    }

    public function send()
    {
     if($this->request->is('post')){
         $data = $this->request->getData();
         $hasAction = !empty($data['action']);
         $action = $data['action'];
         $actionTarget = $data['action_target'];
         $actionTargetUrl = $data['action_target_url'];
         $expire = null;
         if(!empty($data['expire']['day'])){
            $expireArray = $data['expire'];
            $expireObject = \Cake\Database\TypeFactory::build('datetime')->marshal($expireArray);

            $expire = $expireObject->timestamp;
         }

         $dataParam = '""';
         if($hasAction){
            $dataParam = escapeshellarg($action== 'link' ? "{\"navigate\":\"InAppBrowser\",\"params\":{\"url\":\"$actionTargetUrl\"}}" : "{\"navigate\":\"$actionTarget\"}");
         }
         $command = dirname(dirname(dirname(__DIR__))) . "/bin/cake send_push_notification \"{$data['title']}\" \"{$data['body']}\" $dataParam $expire > /dev/null &";
         exec($command);
      
  
         $this->Flash->success("Las push se están enviando correctamente");
  
         
     }

     $actions = $this->PushNotifications->actions();
     $actionTargets = $this->PushNotifications->actionsTargets();
     $this->set(compact('actions','actionTargets'));
     
    }

    public function forUser($user_id)
    {
        $user = \Cake\ORM\TableRegistry::get('Users')->get($user_id);
        $preselected = $this->PushNotifications->find('list',[
            'keyField' => 'token',
            'valueField' => 'token'
        ])->where(['user_id'=>$user_id])
        ->where(['enabled'=>true]);

        if(empty($preselected->toArray())){
            $this->Flash->error('El usuario no tiene ningun dispositivo para enviar push');
            $this->redirect($this->referer());
            return;
        }
        if($this->request->is('post')){
            $data = $this->request->getData();
            $hasAction = !empty($data['action']);
            $action = $data['action'];
            $actionTarget = $data['action_target'];
            $actionTargetUrl = $data['action_target_url'];
            // $expireObject = \Cake\Database\TypeFactory::build('datetime')->marshal(new DateTime('now'));
            // $expire = $expireObject->timestamp;
            // if(!empty($data['expire']['day'])){
            //     $expireArray = $data['expire'];
            //     $expireObject = \Cake\Database\TypeFactory::build('datetime')->marshal($expireArray);
    
            //     $expire = $expireObject->timestamp;
            //  }
    
             $dataParam = [];
            if($hasAction){
                $dataParam = $action== 'link' ? "{\"navigate\":\"InAppBrowser\",\"params\":{\"url\":\"$actionTargetUrl\"}}" : "{\"navigate\":\"$actionTarget\"}";
                $dataParam = json_decode($dataParam,true);
            }

                         
            $this->PushNotifications->send($data['title'],$data['body'],$dataParam,$preselected,null,null);
        }

        $actions = $this->PushNotifications->actions();
        $actionTargets = $this->PushNotifications->actionsTargets();
        $this->set(compact('actions','actionTargets'));
    }
}
