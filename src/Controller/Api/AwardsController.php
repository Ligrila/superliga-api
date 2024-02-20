<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

/**
 * Awards Controller
 *
 * @property \App\Model\Table\AwardsTable $Awards
 *
 * @method \App\Model\Entity\Award[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AwardsController extends ApiAppController
{
    public $publicActions = ['index'];

    public function index(){
        $awards = $this->Awards->find();
        $this->apiResult(true,$awards);
    }

    public function changePoints(){
        $this->request->allowMethod(['post']);
        $data = $this->request->getData();
        if(empty($data['award_id'])){
            $this->apiResult(false,[]);
            return;
        }
        $id = $data['award_id'];
        // checkear puntos
        $this->loadModel('Users');
        $this->loadModel('Orders');
        $award = $this->Awards->get($id);

        $user =  $this->Users->get(
            $this->Auth->user('sub'),
            ['contain'=>['Life','Points','PlayedGames']]
        );
        $success= false;
        $order = [];

        $userPoints = $user->point->points;
        $awardPoints = $award->points;
        if($userPoints>=$awardPoints){
            $order = $this->Orders->newEmptyEntity();
            $order->user_id = $this->Auth->user('sub');
            $order->points = $awardPoints * -1;
            $order->model = 'Awards';
            $order->foreign_key	 = $award->id;
            $success = $this->Orders->save($order);

        }

        $this->apiResult($success,$order);
    }

}
