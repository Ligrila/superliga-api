<?php
namespace App\Controller\Operators;

use App\Controller\AppController;
use App\Application;
use Cake\Console\CommandRunner;

/**
 * PushNotifications Controller
 *
 * @property \App\Model\Table\PushNotificationsTable $PushNotifications
 *
 * @method \App\Model\Entity\PushNotification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PushNotificationsController extends OperatorsAppController
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
         $dataParam = null;
         if($hasAction){
            $dataParam = escapeshellarg($action== 'link' ? "{\"navigate\":\"InAppBrowser\",\"params\":{\"url\":\"$actionTargetUrl\"}}" : "{\"navigate\":\"$actionTarget\"}");
         }
         $command = dirname(dirname(dirname(__DIR__))) . "/bin/cake send_push_notification \"{$data['title']}\" \"{$data['body']}\" $dataParam > /dev/null &";

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
            $dataParam = [];
            if($hasAction){
                $dataParam = $action== 'link' ? "{\"navigate\":\"InAppBrowser\",\"params\":{\"url\":\"$actionTargetUrl\"}}" : "{\"navigate\":\"$actionTarget\"}";
                $dataParam = json_decode($dataParam,true);
            }

                         
            $this->PushNotifications->send($data['title'],$data['body'],$dataParam,$preselected);
        }

        $actions = $this->PushNotifications->actions();
        $actionTargets = $this->PushNotifications->actionsTargets();
        $this->set(compact('actions','actionTargets'));
    }
}
