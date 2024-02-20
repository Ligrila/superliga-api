<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

/**
 * Championships Controller
 *
 * @property \App\Model\Table\ChampionshipsTable $Championships
 *
 * @method \App\Model\Entity\Championship[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChampionshipUsersController extends ApiAppController
{
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($championship_id)
    {

        $championships = $this->ChampionshipUsers->Championships
            ->find()
            ->where(['Championships.user_id'=>$this->Auth->user('sub')])
            ->where(['Championships.id'=>$championship_id])
            ->contain(['ChampionshipUsers'=>['Users']])
            ->first();

        $this->apiResult(true,$championships);
    }

    public function enable($user_id,$championship_id){
        $championships = $this->ChampionshipUsers->Championships
        ->find()
        ->where(['Championships.user_id'=>$this->Auth->user('sub')])
        ->where(['Championships.id'=>$championship_id])
        ->first();
        $saved=false;
        if(!empty($championships)){
            $user = $this->ChampionshipUsers->find()
            ->where(
                [  // conditions
                    'user_id' => $user_id,
                    'championship_id' => $championship_id
                ]   
            )->first();
            if(!empty($user)){
                $user->enabled = true;
                
                $saved = $this->ChampionshipUsers->save($user);
            }

        }


        $this->apiResult($saved,$championships);
    }

    public function disable($user_id,$championship_id){
        $championships = $this->ChampionshipUsers->Championships
        ->find()
        ->where(['Championships.user_id'=>$this->Auth->user('sub')])
        ->where(['Championships.id'=>$championship_id])
        ->first();
        $saved=false;
        if(!empty($championships)){
            $user = $this->ChampionshipUsers->find()
            ->where(
                [  // conditions
                    'user_id' => $user_id,
                    'championship_id' => $championship_id
                ]   
            )->first();
            if(!empty($user)){
                $user->enabled = false;
                
                $saved = $this->ChampionshipUsers->save($user);
            }

        }


        $this->apiResult($saved,$championships);
    }



}
