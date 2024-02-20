<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Users->find()
            ->contain(['Life', 'Points']);
        /*foreach ($users as $key => $value) {
            debug($value);
        }*/

        $user = $this->Users->newEmptyEntity();
        if (!empty($_REQUEST['q'])) {
            $q = $_REQUEST['q'];

                $user->q = $q;
                $q = strtolower($q);

                $query->where([
                    'OR' => [
                        ['LOWER(first_name) LIKE' => "%$q%"], 
                        ['LOWER(last_name) LIKE' => "%$q%"],
                        ["CONCAT(LOWER(first_name), ' ' ,LOWER(last_name)) LIKE" => "%$q%"],
                        ['Lower(email) LIKE' => "%$q%"],
                    ],
                ]);
                // $query->orWhere(
                //     [
                //         'LOWER(first_name) LIKE' => "%$q%",
                //     ]
                // );
                // $query->orWhere(
                //     [
                //         'LOWER(last_name) LIKE' => "%$q%",
                //     ]
                // );
                // $query->orWhere(
                //     [
                //         "CONCAT(LOWER(first_name), ' ' ,LOWER(last_name)) LIKE" => "%$q%",
                //     ]
                // );
                // $query->orWhere(
                //     [
                //         'Lower(email) LIKE' => "%$q%",
                //     ]
                // );

        }
        $users = $this->paginate($query);

        $this->set(compact('users','user'));
    }

    public function indexNoLife()
    {
        $query = $this->Users->find()
            ->where(['Life.lives <' => 1])
            ->contain(['Life', 'Points']);

        /*foreach ($users as $key => $value) {
            debug($value);
        }*/

        $user = $this->Users->newEmptyEntity();
        if (!empty($_REQUEST['q'])) {
            $q = $_REQUEST['q'];

                $user->q = $q;
                $q = strtolower($q);
                $query->orWhere(
                    [
                        'LOWER(first_name) LIKE' => "%$q%",
                    ]
                );
                $query->orWhere(
                    [
                        'LOWER(last_name) LIKE' => "%$q%",
                    ]
                );
                $query->orWhere(
                    [
                        "CONCAT(LOWER(first_name), ' ' ,LOWER(last_name)) LIKE" => "%$q%",
                    ]
                );
                $query->orWhere(
                    [
                        'Lower(email) LIKE' => "%$q%",
                    ]
                );

        }
        $users = $this->paginate($query);

        $this->set(compact('users','user'));
        $this->render('index');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain'=>
                [
                'InfiniteLives',
                'Lives'
                ]
        ]);
        $allInfiniteLives =
            \Cake\ORM\TableRegistry::get('InfiniteLives')->find()->where(['user_id'=>$id])->order(['created'=>'DESC']);

        $this->set('user', $user);
        $this->set('allInfiniteLives', $allInfiniteLives);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function triviaStatistics($user_id,$trivia_id){
        $this->loadModel('TriviaUserStatistics');

        $statistics = $this->TriviaUserStatistics->find()
        ->where(['user_id'=>$user_id,'trivia_id'=>$trivia_id])->first();
        $mediaHits = $triviaHits = $correctAnswers = $wrongAnswers = $usedLives = $ranking = $generalRanking = $generalPoints = $points = 0;
        if(!empty($statistics)){
            $allCorrectAnswersCount =  $statistics->correct_answers_count;
            $allWrongAnswersCount =  $statistics->wrong_answers_count;

            $totalAnswers = $allCorrectAnswersCount + $allWrongAnswersCount;
            $totalPercent = 0;
            if($totalAnswers>0){
                $totalPercent = round(($allCorrectAnswersCount * 100) / $totalAnswers);
            }

            $correctAnswers =  $statistics->correct_answers_user_count;
            $wrongAnswers =  $statistics->wrong_answers_user_count;
            $usedLives =  $wrongAnswers;
            $totalUserAnswers = $correctAnswers + $wrongAnswers;
            $totalUserPercent = 0;
            if($totalUserAnswers>0){
                $totalUserPercent = round(($correctAnswers * 100) / $totalUserAnswers);
            }
            $mediaHits=0;
            if($totalPercent>0){
                $mediaHits = round(($totalUserPercent * 100)/$totalPercent);
            }
            $triviaHits = $totalUserPercent;

            $points = $statistics->points;
            $ranking = $statistics->position;
            $generalRanking =$statistics->general_position;
            $generalPoints = $statistics->general_points;
        }


        $data =
        compact(
            'mediaHits',
            'triviaHits',
            'correctAnswers',
            'wrongAnswers',
            'usedLives',
            'ranking',
            'generalRanking',
            'generalPoints',
            'points'
        );
        debug($data);

    }

}
