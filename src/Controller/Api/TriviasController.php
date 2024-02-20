<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

use App\Controller\AppController;

/**
 * Trivias Controller
 *
 * @property \App\Model\Table\TriviasTable $Trivias
 *
 * @method \App\Model\Entity\Trivia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TriviasController extends ApiAppController
{

    public $publicActions = ['indexBanners'];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function index()
    {
        $trivias = 
            $this->Trivias
                ->find()
                ->where(['Trivias.start_datetime >='=> new \DateTime('now')])
                ->where(['in_progress'=>false])
                ->where(['finished'=>false])
                ->contain(['LocalTeams','VisitTeams','Dates'])
                ->order(['Trivias.start_datetime'=>'ASC']);

        $this->apiResult(true,$trivias);
    }
    
    public function indexBanners()
    {
        $trivias = 
            $this->Trivias
                ->find()
                ->where(['Trivias.start_datetime >='=> new \DateTime('now')])
                ->where(['in_progress'=>false])
                ->where(['finished'=>false])
                ->contain(['LocalTeams','VisitTeams','Dates'])
                ->order(['Trivias.start_datetime'=>'ASC']);
        
        $homeBanners = \Cake\ORM\TableRegistry::get('HomeBanners')->find()
                ->where(['start_date <='=> date('Y-m-d')])
                ->where(['end_date >='=> date('Y-m-d')])->toArray();
        
        $items = [];

        foreach($trivias as $t){
            $items[] = $t;
            if(!empty($homeBanners)){
                $items[] = array_shift($homeBanners);
            }
        }
        if(!empty($homeBanners)){
	    foreach($homeBanners as $banner){
		$items[]= $banner;
	    }
        }
        
        $this->apiResult(true,$items);
    }
    

    public function next()
    {
        $trivias = $this->Trivias->find()
            ->order(['Trivias.start_datetime'=>'ASC'])
            ->where(['Trivias.start_datetime >='=> new \DateTime('now')])
            ->where(['in_progress'=>false])
            ->where(['finished'=>false])
            ->contain(['LocalTeams','VisitTeams','Dates'])
            ->first();

        $this->apiResult(true,$trivias);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function current()
    {
        $trivias = $this->Trivias->find()
            ->where(['Trivias.in_progress'=> true])
            ->where(['Trivias.finished'=> false])
            ->contain(['LocalTeams','VisitTeams'])
            ->first();

        $this->apiResult(!empty($trivias),$trivias);
    }
    
}
