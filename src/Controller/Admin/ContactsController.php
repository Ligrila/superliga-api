<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 *
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'ContactTopics']
        ];
        $contacts = $this->paginate($this->Contacts);

        $this->set(compact('contacts'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => ['Users', 'ContactTopics']
        ]);

        $this->set('contact', $contact);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $contactTopics = $this->Contacts->ContactTopics->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'users', 'contactTopics'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $contactTopics = $this->Contacts->ContactTopics->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'users', 'contactTopics'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
