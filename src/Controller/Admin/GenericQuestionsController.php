<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * GenericQuestions Controller
 *
 * @property \App\Model\Table\GenericQuestionsTable $GenericQuestions
 *
 * @method \App\Model\Entity\GenericQuestion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GenericQuestionsController extends AdminAppController
{


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($trivia_id=null)
    {

        $this->paginate = [
            'contain' => ['Trivias'=>['LocalTeams','VisitTeams']],
            'order' => [
                'GenericQuestions.created' => 'desc'
            ]
        ];
        $query = $this->GenericQuestions->find();
        if($trivia_id){
            $query->where(['trivia_id'=>$trivia_id]);
        }
        $genericQuestions = $this->paginate($query);

        $this->set(compact('genericQuestions','trivia_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Generic Question id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $genericQuestion = $this->GenericQuestions->get($id, [
            'contain' => ['Trivias', 'Teams']
        ]);

        $this->set('genericQuestion', $genericQuestion);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $genericQuestion = $this->GenericQuestions->newEmptyEntity();
        if ($this->request->is('post')) {
            $genericQuestion = $this->GenericQuestions->patchEntity($genericQuestion, $this->request->getData());
            if ($this->GenericQuestions->save($genericQuestion)) {
                $this->Flash->success(__('La pregunta fue guardada correctamente.'));

                return $this->redirect(['action' => 'add',$genericQuestion->trivia_id]);

            }
            $this->Flash->error(__('The generic question could not be saved. Please, try again.'));
        }
        if($id){
            $genericQuestion->trivia_id = $id;
        }
        $trivias = $this->GenericQuestions->Trivias->find('list')
            ->where(['Trivias.finished'=>false])
            ->contain(['LocalTeams','VisitTeams'])
            ->order(['Trivias.start_datetime' => 'asc']);
        $teams = $this->GenericQuestions->Teams->find('list');
        $options = $this->GenericQuestions->getOptions();
        $this->set(compact('genericQuestion', 'trivias', 'teams','options'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Generic Question id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $genericQuestion = $this->GenericQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $genericQuestion = $this->GenericQuestions->patchEntity($genericQuestion, $this->request->getData());
            if ($this->GenericQuestions->save($genericQuestion)) {
                $this->Flash->success(__('La pregunta fue guardada correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The generic question could not be saved. Please, try again.'));
        }
        $trivias = $this->GenericQuestions->Trivias->find('list', ['limit' => 200])
            ->where(['Trivias.finished'=>false])
            ->contain(['LocalTeams','VisitTeams'])
            ->order(['Trivias.start_datetime' => 'asc']);
        $teams = $this->GenericQuestions->Teams->find('list');
        $options = $this->GenericQuestions->getOptions();
        $this->set(compact('genericQuestion', 'trivias', 'teams','options'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Generic Question id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $genericQuestion = $this->GenericQuestions->get($id);
        if ($this->GenericQuestions->delete($genericQuestion)) {
            $this->Flash->success(__('The generic question has been deleted.'));
        } else {
            $this->Flash->error(__('The generic question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
