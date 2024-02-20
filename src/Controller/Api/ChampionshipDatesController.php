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
class ChampionshipDatesController extends ApiAppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index(){
        $year = Configure::read('Superliga.year');
        $dates = $this->ChampionshipDates->find()
        ->where(['year'=>$year]);
        if(isset($_REQUEST['recent'])){
            
            $dates->where(['ChampionshipDates.from_date <='=> new \DateTime('now')])
            ->where(['ChampionshipDates.to_date >='=> new \DateTime('-1 week')]);
        }
        $this->apiResult(true,$dates);
    }

}
