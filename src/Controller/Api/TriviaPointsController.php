<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

/**
 * TriviaPoints Controller
 *
 * @property \App\Model\Table\TriviaPointsTable $TriviaPoints
 *
 * @method \App\Model\Entity\TriviaPoint[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TriviaPointsController extends ApiAppController
{
    public $publicActions = ['forDate','week'];


    public function general(){
        $users = $this->TriviaPoints->find()
        ->select(['Users.id','Users.first_name','Users.last_name','TriviaPoints.user_id','total_points'=>'SUM(TriviaPoints.points)'])
        ->group(['TriviaPoints.user_id','Users.id'])
        ->order(['total_points'=>'DESC'])
        ->contain(['Users'])
        ->limit(30)->toArray();


        $date = [
            'id'=> 'general'
        ];
        $this->apiResult(true,compact('date','users'));
    }
    public function week(){
        $weekObject = new \DateTime('-1 week');
        $users = $this->TriviaPoints->find()
        ->where(['DATE(TriviaPoints.created) >='=>$weekObject->format('Y-m-d')])
        ->select(['Users.id','Users.first_name','Users.last_name','TriviaPoints.user_id','total_points'=>'SUM(TriviaPoints.points)'])
        ->group(['TriviaPoints.user_id','Users.id'])
        ->order(['total_points'=>'DESC'])
        ->contain(['Users'])
        ->limit(30)->toArray();


        $date = [
            'id'=> 'week'
        ];
        $this->apiResult(true,compact('date','users'));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function forDate($date_id=null)
    {
        $datesTable = \Cake\ORM\TableRegistry::get('Dates');
        $date = false;
        if($date_id){
            $date = $datesTable->get($date_id);
        } else{
            $date = $datesTable->getCurrentDate();
        }

        if(!$date){
            $this->apiResult(false,[]);
            return;
        }
        
        $trivias = \Cake\ORM\TableRegistry::get('Trivias')->find('list')->where(['Trivias.date_id'=>$date->id]);
        $triviaList = $trivias->toArray();
        if(empty($triviaList)){
            $this->apiResult(false,[]);
            return;       
        }
        $ids = array_keys($triviaList);

        $users = $this->TriviaPoints->find()
            ->where(['TriviaPoints.trivia_id IN'=>$ids])
            ->select(['Users.id','Users.first_name','Users.last_name','TriviaPoints.user_id','total_points'=>'SUM(TriviaPoints.points)'])
            ->group(['TriviaPoints.user_id','Users.id'])
            ->order(['total_points'=>'DESC'])
            ->contain(['Users'])
            ->limit(30)->toArray();

       

        $this->apiResult(true,compact('date','users'));
        
    }

}
