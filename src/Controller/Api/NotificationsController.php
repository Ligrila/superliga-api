<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 *
 * @method \App\Model\Entity\Notification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotificationsController extends ApiAppController
{
    public $publicActions = array('all');
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $notifications = $this->Notifications
            ->find()
            ->where(['Notifications.user_id'=>$this->Auth->user('sub')])
            ->where(['Notifications.visible'=>true])
            ->where(['Notifications.created >=' => date('Y-m-d',strtotime('-1 months'))])
            ->limit(30)
            ->order(['id'=>'DESC']);
        $user = $this->Notifications->Users->get($this->Auth->user('sub'));
        if($user->unreaded_notifications_count>0){
            $user->unreaded_notifications_count = 0;
            $this->Notifications->Users->save($user);
        }
        $this->apiResult(true,$notifications);
    }
}