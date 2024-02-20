<?php
namespace App\Controller\Operators;

use App\Controller\AppController;


/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 *
 * @method \App\Model\Entity\Question[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionsController extends OperatorsAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($trivia_id)
    {
        $this->paginate = [
            'contain' => ['Trivias']
        ];
        $questions = $this->paginate($this->Questions);

        $this->set(compact('questions'));
    }
    
    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['Trivias', 'Answers']
        ]);

        $this->set('question', $question);
    }

    public function finish($question_id,$correct_option){
        $saved = $this->Questions->setCorrectOption($question_id,$correct_option);
        if($saved){
            $this->Flash->success(__('Pregunta finalizada correctamente.'));
        } else{
            $this->Flash->error(__('La pregunta no pudo ser finalizada. Por favor intente nuevamente.'));
        }
        $this->redirect(['controller'=>'trivias','action'=>'current']);
        return;
    }
    public function cancel($question_id){
        $saved = $this->Questions->cancel($question_id);
        if($saved){
            $this->Flash->success(__('Pregunta cancelada correctamente.'));
        } else{
            $this->Flash->error(__('La pregunta no pudo ser cancelada. Por favor intente nuevamente.'));
        }
        $this->redirect($this->referer());
        return;
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($trivia_id,$team_id,$question_template_id)
    {
        $trivia = $this->Questions->Trivias
            ->find()
            ->where(['Trivias.id'=>$trivia_id])
            ->where(['Trivias.in_progress'=>true])
            ->where(['Trivias.finished'=>false])
            ->first();
        if(empty($trivia)){
            $this->Flash->error(__('La pregunta no pudo ser creada porque no corresponde a un trivia en curso. Por favor intente nuevamente.'));
            $this->redirect($this->referer());
            return;
        }

        $saved = $this->Questions->add($trivia_id,$team_id,$question_template_id);

        if($saved){
            $this->Flash->success(__('Pregunta guardada correctamente.'));
        } else{
            $this->Flash->error(__('La pregunta no pudo ser creada. Por favor intente nuevamente.'));
        }
        $this->redirect($this->referer());
    }

    public function addGeneric($trivia_id,$team_id,$generic_question_id)
    {
        $trivia = $this->Questions->Trivias
            ->find()
            ->where(['Trivias.id'=>$trivia_id])
            ->where(['Trivias.in_progress'=>true])
            ->where(['Trivias.finished'=>false])
            ->first();
        if(empty($trivia)){
            $this->Flash->error(__('La pregunta no pudo ser creada porque no corresponde a un trivia en curso. Por favor intente nuevamente.'));
            $this->redirect($this->referer());
            return;
        }

        $saved = $this->Questions->addGeneric($trivia_id,$team_id,$generic_question_id);

        if($saved){
            $this->Flash->success(__('Pregunta guardada correctamente.'));
        } else{
            $this->Flash->error(__('La pregunta no pudo ser creada. Por favor intente nuevamente.'));
        }
        $this->redirect($this->referer());
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $trivias = $this->Questions->Trivias->find('list', ['limit' => 200]);
        $this->set(compact('question', 'trivias'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
