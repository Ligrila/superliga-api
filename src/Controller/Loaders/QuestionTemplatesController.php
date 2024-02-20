<?php
namespace App\Controller\Loaders;

use App\Controller\AppController;

/**
 * QuestionTemplates Controller
 *
 * @property \App\Model\Table\QuestionTemplatesTable $QuestionTemplates
 *
 * @method \App\Model\Entity\QuestionTemplate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionTemplatesController extends LoadersAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $questionTemplates = $this->paginate($this->QuestionTemplates);

        $this->set(compact('questionTemplates'));
    }

    /**
     * View method
     *
     * @param string|null $id Question Template id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionTemplate = $this->QuestionTemplates->get($id, [
            'contain' => []
        ]);

        $this->set('questionTemplate', $questionTemplate);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionTemplate = $this->QuestionTemplates->newEmptyEntity();
        if ($this->request->is('post')) {
            $questionTemplate = $this->QuestionTemplates->patchEntity($questionTemplate, $this->request->getData());
            if ($this->QuestionTemplates->save($questionTemplate)) {
                $this->Flash->success(__('The question template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question template could not be saved. Please, try again.'));
        }
        $this->set(compact('questionTemplate'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Question Template id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionTemplate = $this->QuestionTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionTemplate = $this->QuestionTemplates->patchEntity($questionTemplate, $this->request->getData());
            if ($this->QuestionTemplates->save($questionTemplate)) {
                $this->Flash->success(__('The question template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question template could not be saved. Please, try again.'));
        }
        $this->set(compact('questionTemplate'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question Template id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionTemplate = $this->QuestionTemplates->get($id);
        if ($this->QuestionTemplates->delete($questionTemplate)) {
            $this->Flash->success(__('The question template has been deleted.'));
        } else {
            $this->Flash->error(__('The question template could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
