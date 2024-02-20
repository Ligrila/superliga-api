<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Loaders Controller
 *
 * @property \App\Model\Table\LoadersTable $Loaders
 *
 * @method \App\Model\Entity\Loader[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoadersController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $loaders = $this->paginate($this->Loaders);

        $this->set(compact('loaders'));
    }

    /**
     * View method
     *
     * @param string|null $id Loader id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $loader = $this->Loaders->get($id, [
            'contain' => []
        ]);

        $this->set('loader', $loader);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loader = $this->Loaders->newEmptyEntity();
        if ($this->request->is('post')) {
            $loader = $this->Loaders->patchEntity($loader, $this->request->getData());
            if ($this->Loaders->save($loader)) {
                $this->Flash->success(__('The loader has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The loader could not be saved. Please, try again.'));
        }
        $this->set(compact('loader'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Loader id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loader = $this->Loaders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $loader = $this->Loaders->patchEntity($loader, $this->request->getData());
            if ($this->Loaders->save($loader)) {
                $this->Flash->success(__('The loader has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The loader could not be saved. Please, try again.'));
        }
        $this->set(compact('loader'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Loader id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $loader = $this->Loaders->get($id);
        if ($this->Loaders->delete($loader)) {
            $this->Flash->success(__('The loader has been deleted.'));
        } else {
            $this->Flash->error(__('The loader could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
