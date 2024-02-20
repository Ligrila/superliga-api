<?php
namespace App\Controller;


use Cake\Core\Configure;

use App\Controller\AppController;

/**
 * Dates Controller
 *
 * @property \App\Model\Table\DatesTable $Dates
 *
 * @method \App\Model\Entity\Date[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TriviasController extends AppController
{
    public $publicActions = ['home'];
    public function home(){
        $year = Configure::read('Superliga.year');
        $trivia = null;
        if(empty($_GET['date_id'])){
            $trivia = $this->Trivias->find()
            ->where(['start_datetime >='=>new \DateTime('now'),'date_id >' => 0])
            ->order(['Trivias.start_datetime ASC'])
            ->first();
            if(empty($trivia)){
                $trivia = $this->Trivias->find()
                ->where(['date_id >' => 0])
                ->order(['Trivias.start_datetime DESC'])
                ->first();
            }
        } else{
            $trivia = $this->Trivias->find()
            ->where(['date_id'=>$_GET['date_id']])
            ->first();
        }

        if(!$trivia && !empty($_GET['date_id']) ){
            $this->Flash->error('No hay partidos aún');
            $this->redirect('/');
        }
        $currentDate = null;
        if($trivia){
            $currentDate = $this->Trivias->Dates->find()
            ->where(['year'=>$year])
            ->where(['id'=>$trivia->date_id])
            ->contain(['Trivias'=>['LocalTeams','VisitTeams']])
            ->first();
        } else{
            $trivia = $this->Trivias->newEmptyEntity();
        }


        $dates = $this->Trivias->Dates->find('list')
            ->where(['year'=>$year,'id >' => 0]);


        $this->set(compact('currentDate','dates','trivia'));
    }
}
