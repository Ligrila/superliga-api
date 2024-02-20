<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * InfiniteLives Controller
 *
 * @property \App\Model\Table\InfiniteLivesTable $InfiniteLives
 *
 * @method \App\Model\Entity\InfiniteLife[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InfiniteLivesController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($user_id=null)
    {
        $this->paginate = [
            'contain' => ['Users', 'Payments']
        ];
        $query = $this->InfiniteLives->find();
        if($user_id){
            $query->where(['InfiniteLives.user_id'=>$user_id]);
        }
        $infiniteLives = $this->paginate($query);

        $this->set(compact('infiniteLives'));
    }

    /**
     * View method
     *
     * @param string|null $id Infinite Life id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $infiniteLife = $this->InfiniteLives->get($id, [
            'contain' => ['Users', 'Payments']
        ]);

        $this->set('infiniteLife', $infiniteLife);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($user_id)
    {
        $infiniteLife = $this->InfiniteLives->newEmptyEntity();
        $user = $this->InfiniteLives->Users->get($user_id);
        $infiniteLife->user_id = $user_id;
        if ($this->request->is('post')) {
            $infiniteLife = $this->InfiniteLives->patchEntity($infiniteLife, $this->request->getData());
            if ($this->InfiniteLives->save($infiniteLife)) {
                $this->Flash->success(__('La vida infinita fue guardada correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La vida infinita no pudo ser guardada'));
        }

        $this->set(compact('infiniteLife', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Infinite Life id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $infiniteLife = $this->InfiniteLives->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $infiniteLife = $this->InfiniteLives->patchEntity($infiniteLife, $this->request->getData());
            if ($this->InfiniteLives->save($infiniteLife)) {
                $this->Flash->success(__('La vida infinita fue guardada correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La vida infinita no pudo ser guardada'));
        }

        $this->set(compact('infiniteLife'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Infinite Life id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $infiniteLife = $this->InfiniteLives->get($id);
        if ($this->InfiniteLives->delete($infiniteLife)) {
            $this->Flash->success(__('The infinite life has been deleted.'));
        } else {
            $this->Flash->error(__('The infinite life could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
