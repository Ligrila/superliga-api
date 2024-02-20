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
class DatesController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $dates = $this->paginate($this->Dates);

        $this->set(compact('dates'));
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
        $date = $this->Dates->get($id, [
            'contain' => ['Trivias'=>['LocalTeams','VisitTeams']]
        ]);

        $this->set('date', $date);
    }

    public function winners($id = null)
    {
        $date = $this->Dates->get($id, [
            'contain' => []
        ]);


        $trivias = \Cake\ORM\TableRegistry::get('Trivias')->find('list')->where(['Trivias.date_id'=>$date->id]);
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

        $this->set('date', $date);
        $this->set('triviaPoints', $triviaPoints);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $date = $this->Dates->newEmptyEntity();
        if ($this->request->is('post')) {
            $date = $this->Dates->patchEntity($date, $this->request->getData());
            if ($this->Dates->save($date)) {
                $this->Flash->success(__('The date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }
        $this->set(compact('date'));
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
        $date = $this->Dates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $date = $this->Dates->patchEntity($date, $this->request->getData());
            if ($this->Dates->save($date)) {
                $this->Flash->success(__('The date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }
        $this->set(compact('date'));
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
        $date = $this->Dates->get($id);
        if ($this->Dates->delete($date)) {
            $this->Flash->success(__('The date has been deleted.'));
        } else {
            $this->Flash->error(__('The date could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
