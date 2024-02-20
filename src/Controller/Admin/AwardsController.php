<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Awards Controller
 *
 * @property \App\Model\Table\AwardsTable $Awards
 *
 * @method \App\Model\Entity\Award[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AwardsController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $awards = $this->paginate($this->Awards);

        $this->set(compact('awards'));
    }

    /**
     * View method
     *
     * @param string|null $id Award id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $award = $this->Awards->get($id, [
            'contain' => []
        ]);

        $this->set('award', $award);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $award = $this->Awards->newEmptyEntity();
        if ($this->request->is('post')) {
            $award = $this->Awards->patchEntity($award, $this->request->getData());
            if ($this->Awards->save($award)) {
                $this->Flash->success(__('El premio fue guardado correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El premio  no pudo ser guardado. Por favor, intente nuevamente.'));
        }
        $this->set(compact('award'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Award id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $award = $this->Awards->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $award = $this->Awards->patchEntity($award, $this->request->getData());
            if ($this->Awards->save($award)) {
                $this->Flash->success(__('El premio fue guardado correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El premio  no pudo ser guardado. Por favor, intente nuevamente.'));
        }
        $this->set(compact('award'));
    }

    public function changeImage($id = null)
    {
        $award = $this->Awards->get($id, [
            'contain' => []
        ]);
        if($this->request->is('ajax')){
            $this->viewBuilder()->setLayout('ajax');
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $award = $this->Awards->patchEntity($award, $this->request->getData());
            if ($this->Awards->save($award)) {
                $this->Flash->success(__('La imagen fue cambiada correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El premio  no pudo ser guardado. Por favor, intente nuevamente.'));
        }
        $this->set(compact('award'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Award id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $award = $this->Awards->get($id);
        if ($this->Awards->delete($award)) {
            $this->Flash->success(__('The award has been deleted.'));
        } else {
            $this->Flash->error(__('The award could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
