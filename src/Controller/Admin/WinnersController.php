<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Trivias Controller
 *
 * @property \App\Model\Table\TriviasTable $Trivias
 *
 * @method \App\Model\Entity\Trivia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WinnersController extends AdminAppController
{
    function index(){
        $this->loadModel('Trivias');
    $trivia = $this->Trivias->newEmptyEntity();
        if($this->request->is('post')){

            $data = $this->request->getData();
            /*
            $data['start_datetime']['hour'] = 0;
            $data['start_datetime']['minute'] = 0;
            $data['start_datetime']['seconds'] = 0;
            $data['end_datetime']['hour'] = 0;
            $data['end_datetime']['minute'] = 0;
            $data['end_datetime']['seconds'] = 0;
            */
            $trivia = $this->Trivias->patchEntity($trivia,$data);
            $trivias = $this->Trivias->find()
                ->where([
                'DATE(Trivias.start_datetime) >='=> $data['start_datetime'],
                'DATE(Trivias.start_datetime) <'=> $data['end_datetime']
                ]);
            $ids = [];
            foreach($trivias as $trivia){
                $ids[] = $trivia->id;
            }
            if(empty($ids)){
                return;
            }

            $triviaPoints =
                \Cake\ORM\TableRegistry::get('TriviaPoints')
                    ->find();
                    $triviaPoints->select(['Users.email','Users.first_name','Users.last_name','user_id','p' => $triviaPoints->func()->sum('points')])
                    ->where(['trivia_id IN'=>$ids])
                    ->contain(['Users'])
                    ->group(['user_id','Users.email','Users.first_name','Users.last_name'])
                    ->order(['p'=>'desc'])
                    ->limit(100);

            $this->set('trivias_ids', $ids);
            $this->set('trivia', $trivia);
            $this->set('triviaPoints', $triviaPoints);
        }

        $this->set('trivia', $trivia);

    }

}
