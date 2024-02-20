<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Dates Controller
 *
 * @property \App\Model\Table\DatesTable $Dates
 *
 * @method \App\Model\Entity\Date[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChampionshipDatesController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $championshipDates = $this->paginate($this->ChampionshipDates);

        $this->set(compact('championshipDates'));
    }

    /**
     * View method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $championshipDate = $this->ChampionshipDates->get($id, [
        ]);

        $this->set('championshipDate', $championshipDate);
    }

    public function winners($id = null)
    {
        $championshipDate = $this->ChampionshipDates->get($id, [
            'contain' => []
        ]);


        $trivias = \Cake\ORM\TableRegistry::get('Trivias')->find('list')->where(['Trivias.championshipDate_id'=>$championshipDate->id]);
        $triviaList = $trivias->toArray();
        if(empty($triviaList)){
            $this->apiResult(false,[]);
            return;
        }
        $ids = array_keys($triviaList);

        $triviaPoints = \Cake\ORM\TableRegistry::get('TriviaPoints')->find()
            ->where(['TriviaPoints.trivia_id IN'=>$ids])
            ->select(['TriviaPoints.user_id','total_points'=>'SUM(TriviaPoints.points)','Users.first_name','Users.last_name','Users.email','Users.id'])
            ->group(['TriviaPoints.user_id'])
            ->order(['total_points'=>'DESC'])
            ->contain(['Users'])
            ->limit(10)
            ;

        $this->set('championshipDate', $championshipDate);
        $this->set('triviaPoints', $triviaPoints);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $championshipDate = $this->ChampionshipDates->newEmptyEntity();
        if ($this->request->is('post')) {
            $championshipDate = $this->ChampionshipDates->patchEntity($championshipDate, $this->request->getData());
            if ($this->ChampionshipDates->save($championshipDate)) {
                $this->Flash->success(__('The championshipDate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The championshipDate could not be saved. Please, try again.'));
        }
        $this->set(compact('championshipDate'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $championshipDate = $this->ChampionshipDates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $championshipDate = $this->ChampionshipDates->patchEntity($championshipDate, $this->request->getData());
            if ($this->ChampionshipDates->save($championshipDate)) {
                $this->Flash->success(__('The championshipDate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The championshipDate could not be saved. Please, try again.'));
        }
        $this->set(compact('championshipDate'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $championshipDate = $this->ChampionshipDates->get($id);
        if ($this->ChampionshipDates->delete($championshipDate)) {
            $this->Flash->success(__('The championshipDate has been deleted.'));
        } else {
            $this->Flash->error(__('The championshipDate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
