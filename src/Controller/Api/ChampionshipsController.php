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
class ChampionshipsController extends ApiAppController
{

    public $publicActions = ['allForChampionshipDate'];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $championships = $this->Championships->ChampionshipUsers
            ->find()
            ->where(['ChampionshipUsers.user_id' => $this->Auth->user('sub')])
            ->contain(['Championships' => ['Users', 'ChampionshipsRankings']]);

        $this->apiResult(true, $championships);
    }
    // This method this must be private, tu get user id
    public function all()
    {
        // Allow Get
        $this->request->allowMethod(['get']);
        // Search
        $search = [];
        if ($this->request->getQuery()) {
            $search = $this->request->getQuery();
        }
        // Conditions
        $conditions = [];
        if (isset($search['q'])) {
            $q = "{$search['q']}";
            // $championships->where(['Championships.name LIKE' => "%$q%"]);
            $conditions['Championships.name LIKE'] = "%$q%";
        }
        if (isset($search['ignore'])) {
            $not = $search['ignore'];
            // $championships->where(['ChampionshipsUsersPoints.championship_id NOT IN'=> $not ]);
            $conditions['ChampionshipsUsersPoints.championship_id LIKE'] = $not;
        }

        if (isset($search['not_my'])) {
            //lopezlean 8efeea30-859a-44b2-9d0f-61b07a67a72f
            $conditions['Championships.user_id !='] = $this->Auth->user('sub');
        }
        // Query
        $queryChampionships =
            $this
            ->Championships
            // ->ChampionshipsRankings
            ->find();
        // Conditions
        $queryChampionships
            ->contain(['Users', 'ChampionshipsRankings'])
            // ->order(['Championships.created' => 'DESC'])
            ->order(['ChampionshipsRankings.position' => 'ASC'])
            ->where(['AND' => $conditions])
            // ->limit(10);
            ->limit(10);
        // debug($queryChampionships);
        $this->apiResult(true, $queryChampionships);
    }

    public function allForChampionshipDate($date_id = null)
    {

        $datesTable = \Cake\ORM\TableRegistry::get('ChampionshipDates');
        $date = $datesTable->get($date_id);


        if (!$date) {
            $this->apiResult(false, []);
            return;
        }

        $trivias = \Cake\ORM\TableRegistry::get('Trivias')
            ->find('list')
            ->where([
                'DATE(start_datetime) BETWEEN :start AND :end'
            ])
            ->bind(':start', $date->from_date, 'date')
            ->bind(':end',   $date->to_date, 'date');


        $triviaList = $trivias->toArray();

        if (empty($triviaList)) {
            $this->apiResult(false, []);
            return;
        }
        $ids = array_keys($triviaList);

        $championships = \Cake\ORM\TableRegistry::get('ChampionshipsUsersPointsTriviasSums')->find()
            ->where(['trivia_id IN' => $ids])
            ->order(['points' => 'DESC'])
            ->contain(['Championships' => ['Users']])
            ->limit(10);


        //TODO: mejorar esto
        $preRet = [];
        foreach ($championships as $c) {
            if (isset($preRet[$c->championship_id])) {
                $preRet[$c->championship_id]->points += $c->points;
            } else {
                $preRet[$c->championship_id] = $c;
            }
        }
        $ret = [];
        foreach ($preRet as $r) {
            $ret[] = $r;
        }


        $this->apiResult(true, $ret);
    }

    public function allForDate($date_id = null)
    {

        $datesTable = \Cake\ORM\TableRegistry::get('Dates');
        $date = false;
        if ($date_id) {
            $date = $datesTable->get($date_id);
        } else {
            $date = $datesTable->getCurrentDate();
        }

        if (!$date) {
            $this->apiResult(false, []);
            return;
        }

        $trivias = \Cake\ORM\TableRegistry::get('Trivias')->find('list')->where(['Trivias.date_id' => $date->id]);
        $triviaList = $trivias->toArray();
        if (empty($triviaList)) {
            $this->apiResult(false, []);
            return;
        }
        $ids = array_keys($triviaList);

        $championships = \Cake\ORM\TableRegistry::get('ChampionshipsUsersPointsTriviasSums')->find()
            ->where(['trivia_id IN' => $ids])
            ->order(['points' => 'DESC'])
            ->contain(['Championships' => ['Users']])
            ->limit(10);





        $this->apiResult(true, $championships);
    }
    public function ranking($id = null)
    {
        $type = empty($_REQUEST['type']) ? 'all' : $_REQUEST['type'];
        $items = $this->Championships->ranking($id, $type);
        //$this->getLastQuery();
        $this->apiResult(true, $items);
    }

    private function getLastQuery()
    {
        $dbo = \Cake\Datasource\ConnectionManager::get('default');
        $logs = $dbo->getLogger();
        var_dump($logs);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $championship = $this->Championships->newEmptyEntity();
        $saved = false;
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->Auth->user('sub');
            $championship = $this->Championships->patchEntity($championship, $data);

            $saved = $this->Championships->save($championship);

            if (!$saved) {
                $championship = $championship->errors();
            }
        }

        $this->apiResult($saved, $championship);
    }

    public function subscribe($id)
    {
        $saved = false;
        $championship = $this->Championships->get($id, [
            'contain' => []
        ]);
        if ($this->request->is('post')) {
            $saved = $this->Championships->subscribe($id, $this->Auth->user('sub'));
        }

        $this->apiResult($saved, $championship);
    }

    /**
     * Edit method
     *
     * @param string|null $id Championship id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $championship = $this->Championships->find()
            ->where(['id' => $id, 'user_id' => $this->Auth->user('sub')])
            ->first();
        $saved = false;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $championship = $this->Championships->patchEntity($championship, $this->request->getData());
            $saved = $this->Championships->save($championship);
        }
        $this->apiResult($saved, $championship);
    }
}
