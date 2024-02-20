<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Answers Controller
 *
 * @property \App\Model\Table\AnswersTable $Answers
 *
 * @method \App\Model\Entity\Answer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AnswersController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($user_id,$trivia_id)
    {
        $this->paginate = [
            'contain' => ['Users', 'Questions']
        ];
        $correctAnswers = $this->Answers->CorrectAnswers->find()
            ->where(['Questions.trivia_id'=>$trivia_id])
            ->where(['CorrectAnswers.user_id'=>$user_id])
            ->contain(['Users', 'Questions']);

        $wrongAnswers = $this->Answers->WrongAnswers->find()
            ->where(['Questions.trivia_id'=>$trivia_id])
            ->where(['WrongAnswers.user_id'=>$user_id])
            ->contain(['Users', 'Questions']);

        $this->set(compact('correctAnswers','wrongAnswers'));
    }

    /**
     * View method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $answer = $this->Answers->get($id, [
            'contain' => ['Users', 'Questions', 'ProcessedAnswers']
        ]);

        $this->set('answer', $answer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $answer = $this->Answers->newEmptyEntity();
        if ($this->request->is('post')) {
            $answer = $this->Answers->patchEntity($answer, $this->request->getData());
            if ($this->Answers->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The answer could not be saved. Please, try again.'));
        }
        $users = $this->Answers->Users->find('list', ['limit' => 200]);
        $questions = $this->Answers->Questions->find('list', ['limit' => 200]);
        $this->set(compact('answer', 'users', 'questions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $answer = $this->Answers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $answer = $this->Answers->patchEntity($answer, $this->request->getData());
            if ($this->Answers->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The answer could not be saved. Please, try again.'));
        }
        $users = $this->Answers->Users->find('list', ['limit' => 200]);
        $questions = $this->Answers->Questions->find('list', ['limit' => 200]);
        $this->set(compact('answer', 'users', 'questions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $answer = $this->Answers->get($id);
        if ($this->Answers->delete($answer)) {
            $this->Flash->success(__('The answer has been deleted.'));
        } else {
            $this->Flash->error(__('The answer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
