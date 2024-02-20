<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;


use Cake\Core\Configure;



/**
 * Dates Controller
 *
 * @property \App\Model\Table\DatesTable $Dates
 *
 * @method \App\Model\Entity\Date[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DatesController extends ApiAppController
{
    public $publicActions = ['calendar','view'];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index(){
        $year = Configure::read('Superliga.year');
        $dates = $this->Dates->find()
        ->where(['year'=>$year]);
        if(isset($_REQUEST['recent'])){
            
            $dates->where(['Dates.from_date <='=> new \DateTime('now')])
            ->where(['Dates.to_date >='=> new \DateTime('-1 week')]);
        }
        $this->apiResult(true,$dates);
    }
    public function calendar()
    {
        $year = Configure::read('Superliga.year');

        $date = $this->Dates->getCurrentDate();

        $dates = $this->Dates->find()
        ->where(['year'=>$year])
        ->where(['id >'=>0])
        /*->matching('Trivias',function($q){
            return $q->where(['Trivias.type'=>'normal']);

        })*/
        ->contain(['Trivias'=>['LocalTeams','VisitTeams']])
        ->order(['id'=>'ASC']);
        if($date){
            $dates->where(['Dates.id >='=>$date->id]);
        }
        $this->apiResult(true,$dates);
    }

    public function view($id)
    {
        $dates = $this->Dates->get($id,
            ['contain'=>['Trivias'=>['LocalTeams','VisitTeams']]]
        );

        $this->apiResult(true,$dates);
    }

}
