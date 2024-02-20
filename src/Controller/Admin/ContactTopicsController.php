<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ContactTopics Controller
 *
 * @property \App\Model\Table\ContactTopicsTable $ContactTopics
 *
 * @method \App\Model\Entity\ContactTopic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactTopicsController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $contactTopics = $this->paginate($this->ContactTopics);

        $this->set(compact('contactTopics'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact Topic id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactTopic = $this->ContactTopics->get($id, [
            'contain' => ['Contacts']
        ]);

        $this->set('contactTopic', $contactTopic);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactTopic = $this->ContactTopics->newEmptyEntity();
        if ($this->request->is('post')) {
            $contactTopic = $this->ContactTopics->patchEntity($contactTopic, $this->request->getData());
            if ($this->ContactTopics->save($contactTopic)) {
                $this->Flash->success(__('The contact topic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact topic could not be saved. Please, try again.'));
        }
        $this->set(compact('contactTopic'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact Topic id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactTopic = $this->ContactTopics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactTopic = $this->ContactTopics->patchEntity($contactTopic, $this->request->getData());
            if ($this->ContactTopics->save($contactTopic)) {
                $this->Flash->success(__('The contact topic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact topic could not be saved. Please, try again.'));
        }
        $this->set(compact('contactTopic'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact Topic id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactTopic = $this->ContactTopics->get($id);
        if ($this->ContactTopics->delete($contactTopic)) {
            $this->Flash->success(__('The contact topic has been deleted.'));
        } else {
            $this->Flash->error(__('The contact topic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
